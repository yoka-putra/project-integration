<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }     

    public function masterUserPage()
    {
        return view('masterUser');
    }     
    public function resetPwPage()
    {
        return view('resetPw');
    }
    
    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'user_full_name' => 'required|string|max:255',
            'user_name' => 'required|string|max:100|unique:users',
            'user_email' => 'required|string|email|max:255|unique:users',
            'user_password' => 'required|string|min:6',
            'user_level' => 'required|string|max:50',
            'user_area_id' => 'nullable|integer|exists:area,area_id',
            'user_outlet_id' => 'nullable|integer|exists:outlet,outlet_id',
            'has_full_access' => 'nullable|boolean',
            'user_area_id' => 'required_without_all:user_outlet_id,has_full_access', // Aturan validasi
            'user_outlet_id' => 'required_without_all:user_area_id,has_full_access', // Aturan validasi
            'has_full_access' => 'required_without_all:user_area_id,user_outlet_id', // Aturan validasi
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        $user_area_id = $request->has_full_access ? null : $request->user_area_id;
        $user_outlet_id = $request->has_full_access ? null : $request->user_outlet_id;
    
        // Buat pengguna baru
        $user = User::create([
            'user_full_name' => $request->user_full_name,
            'user_name' => $request->user_name,
            'user_email' => $request->user_email,
            'user_password' => Hash::make($request->user_password),
            'user_level' => $request->user_level,
            'user_area_id' => $user_area_id,
            'user_outlet_id' => $user_outlet_id,
            'has_full_access' => filter_var($request->has_full_access, FILTER_VALIDATE_BOOLEAN), // Mengonversi ke boolean
        ]);
    
        // Generate token JWT untuk pengguna baru
        // $token = JWTAuth::fromUser($user);
    
        // Kembalikan respons JSON dengan data pengguna dan token JWT
        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
            // 'token' => $token,
        ]);
    }
    
    public function login(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string',
            'user_password' => 'required|string',
        ]);
    
        $credentials = [
            'user_name' => $request->user_name,
            'password' => $request->user_password
        ];
    
        // Pastikan Laravel menggunakan kolom 'user_password' untuk hashing.
        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => Auth::user(),
        ]);
    }

    public function getAllUsers(Request $request)
    {
        $user = Auth::guard('api')->user();
    
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: Invalid token',
            ], 401);
        }
    
        // Ambil parameter sortOrder dari query
        $sortOrder = $request->query('sortOrder', 'asc'); // default ke 'asc'
    
        // Validasi nilai sortOrder
        if (!in_array($sortOrder, ['asc', 'desc'])) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid sort order. Use "asc" or "desc".',
            ], 400);
        }
    
        // Mengambil pengguna dengan outlet yang terkait, diurutkan berdasarkan user_id dan dengan pagination
        $users = User::with('outlet')
            ->orderBy('user_id', $sortOrder) // Mengurutkan berdasarkan user_id
            ->paginate(10); // Menggunakan pagination dengan 10 data per halaman
    
        // Menghapus password dari setiap pengguna
        foreach ($users as $user) {
            $user->makeHidden(['user_password']);
        }
    
        return response()->json($users);
    }    
    

public function getUsers($id)
{
    $user = Auth::guard('api')->user();
    
    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized: Invalid token',
        ], 401);
    }
    $user = User::find($id);

    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }

    $user->makeHidden(['user_password']);

    return response()->json($user);
}

public function searchUsers(Request $request)
{
    $authenticatedUser = Auth::guard('api')->user();
    
    if (!$authenticatedUser) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized: Invalid token',
        ], 401);
    }

    $request->validate([
        'query' => 'required|string|max:100',
    ]);

    $query = $request->input('query');

    $users = User::where('user_name', 'LIKE', "%{$query}%")
                ->orWhere('user_full_name', 'LIKE', "%{$query}%")
                ->get();

    $users->makeHidden(['password']); 

    if ($users->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => 'No users found',
        ], 404);
    }

    return response()->json($users);
}

public function updateUsers(Request $request, $id)
{
    // Find user by ID
    $user = User::find($id);
    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    // Validate input
    $validator = Validator::make($request->all(), [
        'user_full_name' => 'required|string|max:255',
        'user_name' => 'required|string|max:100|unique:users,user_name,' . $user->user_id . ',user_id',
        'user_email' => 'required|string|email|max:255|unique:users,user_email,' . $user->user_id . ',user_id',
        'user_level' => 'required|string|max:50',
        'user_area_id' => 'nullable|integer|exists:area,area_id',
        'user_outlet_id' => 'nullable|integer|exists:outlet,outlet_id',
        'has_full_access' => 'nullable|boolean',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    try {
        // Update user data based on input
        $user->user_full_name = $request->user_full_name;
        $user->user_name = $request->user_name;
        $user->user_email = $request->user_email;
        $user->user_level = $request->user_level;

        // Determine if full access is required based on the role
        if (in_array($user->user_level, ['IT', 'Keuangan', 'GA Pusat'])) {
            $user->has_full_access = true; // Set full access
            $user->user_area_id = null; // Reset area ID
            $user->user_outlet_id = null; // Reset outlet ID
        } else {
            $user->has_full_access = filter_var($request->has_full_access, FILTER_VALIDATE_BOOLEAN);

            // Set user_area_id and user_outlet_id based on provided data
            $user->user_area_id = $request->user_area_id ?? $user->user_area_id; 
            $user->user_outlet_id = $request->user_outlet_id ?? $user->user_outlet_id; 
        }

        // Save changes if there are any
        if ($user->isDirty()) {
            $user->save();
            return response()->json(['message' => 'User updated successfully'], 200);
        } else {
            return response()->json(['message' => 'No changes made to the user.'], 200);
        }
    } catch (\Exception $e) {
        Log::error('Update user error: ' . $e->getMessage());
        return response()->json(['message' => 'Internal server error'], 500);
    }
}


public function resetPassword(Request $request, $id)
{
    $authenticatedUser = Auth::guard('api')->user();

    if (!$authenticatedUser) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized: Invalid token',
        ], 401);
    }

    $request->validate([
        'new_password' => 'required|string|min:6|confirmed', 
    ]);

    $user = User::find($id);

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    $user->user_password = Hash::make($request->new_password);

    if ($user->save()) {
        return response()->json(['message' => 'Password reset successfully'], 200);
    } else {
        return response()->json(['message' => 'Error resetting password'], 500);
    }
}


// public function deleteUsers($id)
// {
//     // Mendapatkan ID pengguna dari token JWT
//     $user = Auth::guard('api')->user();
    
//     // Memeriksa apakah pengguna terautentikasi
//     if (!$user) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Unauthorized: Invalid token',
//         ], 401);
//     }

//     // Mencari pengguna berdasarkan ID
//     $userToDelete = User::find($id);

//     // Memeriksa apakah pengguna ditemukan
//     if (!$userToDelete) {
//         return response()->json([
//             'success' => false,
//             'message' => 'User not found',
//         ], 404);
//     }

//     // Menghapus pengguna
//     $userToDelete->delete();

//     // Kembalikan respons sukses
//     return response()->json([
//         'success' => true,
//         'message' => 'User deleted successfully',
//     ]);
// }

public function logout(Request $request)
{
    // Invalidate the token

    // Optionally, you can also blacklist the token here if you want to manage logged-out tokens
    return response()->json(['message' => 'Successfully logged out']);
}

    public function me()
    {
        return response()->json(Auth::user());
    }
}


// namespace App\Http\Controllers;

// use App\Models\User;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Auth;

// class AuthController extends Controller
// {
//     // Menghilangkan middleware auth
//     public function __construct()
//     {
//         // Anda bisa menghapus middleware sepenuhnya
//         // atau membiarkan ini kosong jika tidak ingin ada middleware di constructor
//     }

//     public function register(Request $request)
//     {
//         // Validasi input
//         $request->validate([
//             'user_full_name' => 'required|string|max:255',
//             'user_name' => 'required|string|max:100|unique:user',
//             'user_email' => 'required|string|email|max:255|unique:user',
//             'user_password' => 'required|string|min:6',
//             'user_level' => 'required|string|max:50',
//             'user_outlet_id' => 'required|integer|exists:outlets,id',
//         ]);

//         // Buat user baru
//         $user = User::create([
//             'user_full_name' => $request->user_full_name,
//             'user_name' => $request->user_name,
//             'user_email' => $request->user_email,
//             'user_password' => Hash::make($request->user_password), // Hash password
//             'user_level' => $request->user_level,
//             'user_outlet_id' => $request->user_outlet_id,
//         ]);

//         // Token generate
//         $token = JWTAuth::fromUser($user);

//         // Return response dengan token
//         return response()->json([
//             'user' => $user,
//             'token' => $token,
//         ]);
//     }

//     public function login(Request $request)
//     {
//         // Validasi input
//         $request->validate([
//             'user_name' => 'required|string',
//             'user_password' => 'required|string',
//         ]);

//         $credentials = [
//             'user_name' => $request->user_name,
//             'password' => $request->user_password,
//         ];
    
//         try {
//             if (!$token = JWTAuth::attempt($credentials)) {
//                 return response()->json(['error' => 'Unauthorized'], 401);
//             }
//         } catch (JWTException $e) {
//             return response()->json(['error' => 'Could not create token'], 500);
//         }
    
//         // Mendapatkan user yang login
//         $user = Auth::user();
    
//         return response()->json([
//             'user' => $user,
//             'token' => $token,
//         ]);
//     }

//     public function logout()
//     {
//         // Invalidate the token
//         JWTAuth::invalidate(JWTAuth::getToken());

//         return response()->json(['message' => 'Successfully logged out']);
//     }

//     public function refresh()
//     {
//         try {
//             $token = JWTAuth::refresh(JWTAuth::getToken());
//         } catch (JWTException $e) {
//             return response()->json(['error' => 'Could not refresh token'], 500);
//         }

//         return $this->respondWithToken($token);
//     }

//     public function me()
//     {
//         return response()->json(auth()->user());
//     }

//     protected function respondWithToken($token)
//     {
//         return response()->json([
//             'status' => 'success',
//             'authorisation' => [
//                 'token' => $token,
//                 'type' => 'bearer',
//             ]
//         ]);
//     }
// }

    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'user_name' => 'required|string',
    //         'user_password' => 'required|string',
    //     ]);
        
    //     $credentials = $request->only('user_name', 'user_password');
    
    //     // Gunakan JWTAuth untuk mencoba membuat token
    //     try {
    //         if (!$token = JWTAuth::attempt($credentials)) {
    //             return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
    //         }
    //     } catch (JWTException $e) {
    //         return response()->json(['status' => 'error', 'message' => 'Could not create token'], 500);
    //     }
    
    //     $user = JWTAuth::user();
    //     return response()->json([
    //         'status' => 'success',
    //         'user' => $user,
    //         'authorisation' => [
    //             'token' => $token,
    //             'type' => 'bearer',
    //         ]
    //     ]);
    // }
    
    // public function logout()
    // {
    //     JWTAuth::invalidate(JWTAuth::getToken());
    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Successfully logged out',
    //     ]);
    // }

    // public function refresh()
    // {
    //     try {
    //         $token = JWTAuth::refresh(JWTAuth::getToken());
    //     } catch (JWTException $e) {
    //         return response()->json(['status' => 'error', 'message' => 'Could not refresh token'], 500);
    //     }

    //     return response()->json([
    //         'status' => 'success',
    //         'authorisation' => [
    //             'token' => $token,
    //             'type' => 'bearer',
    //         ]
    //     ]);
    // }

