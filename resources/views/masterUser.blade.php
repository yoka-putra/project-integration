<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .sidebar-open {
            max-width: 800px; /* Lebar sidebar saat dibuka */
            transform: translateX(0); /* Muncul di layar */
            visibility: visible; /* Sidebar terlihat */
        }
        .sidebar-closed {
            max-width: 0; /* Sidebar tersembunyi */
            transform: translateX(-100%); /* Geser keluar layar */
            visibility: hidden; /* Tidak terlihat */
        }
        .transition-all {
            transition: all 0.3s ease;
        }
    </style>
</head>

<body class="bg-gray-100 h-screen text-black">
    <div class="flex w-screen h-screen">
        <!-- Sidebar -->
        <div id="sidebar" class="h-screen bg-orange-500 transition-all sidebar-closed">
            <div class="p-4">
                <h1 class="text-white text-2xl font-bold">SSB</h1>
                <h2 class="text-white text-lg mt-2">Spesial Soto Boyolali</h2>
               <h2 class="text-white text-lg">Hj. Hesti Widodo</h2>
                <hr class="border-white my-4">
                <ul class="mt-4 text-white">
                    <form class="inline">
                    <form class="inline">                         <a href="{{ route('daftarAset') }}" class="flex items-center text-white p-2 rounded-lg hover:bg-orange-400">             <span class="mr-2"><i class="bi bi-list-task"></i></span>             <span>Daftar Aset</span>         </a>                     </form>                     <form class="inline">     <a class="flex items-center text-white p-2 rounded-lg hover:bg-orange-400">         <span class="mr-2"><i class="bi bi-camera"></i></span>          <span>Scan Qr Code</span>     </a> </form>
                    <details id="masterMenu" class="group hidden">
    <summary class="flex items-center cursor-pointer bg-orange-600 p-3 rounded-lg mb-2">
        <span class="mr-2"><i class="bi bi-wrench"></i></span>
        <span>Master</span>
        <i class="bi bi-chevron-down ml-auto transition-transform transform group-open:rotate-180"></i>
    </summary>
    <div class="pl-6 mt-2">
        <a class="flex items-center text-white p-2 bg-red-600 rounded-lg hover:bg-orange-400">
            <span class="mr-2"><i class="bi bi-people"></i></span>
            <span>User</span>
        </a>
        <a href="{{ route('masterAset') }}" class="flex items-center text-white p-2 rounded-lg hover:bg-orange-400">
            <span class="mr-2"><i class="bi bi-folder"></i></span>
            <span>Aset</span>
        </a>
    </div>
</details>

    <button type="button" class="flex items-center text-white p-3 rounded-lg mb-2 logout">
    <span class="mr-2"><i class="bi bi-box-arrow-right"></i></span>
    <span>Logout</span>
</button>
                </ul>
            </div>
        </div>

        <!-- Content -->
  <div class="grow p-6" id="content">
          <div>
    <div class="bg-white rounded-xl p-6 flex items-center justify-between mb-4">
  <div class="flex items-center">
    <ion-icon id="menuToggleBtn" name="menu" class="text-4xl cursor-pointer mr-4"></ion-icon>
       <h1 class="text-xl font-semibold">Asset Pos Manager</h1>
  </div>
  <div class="flex items-center">
    <i class="bi bi-person-fill mr-3 text-xl"></i>
    <span id="user_name" class="font-semibold text-l"></span>
  </div>
</div>

    <div class="overflow-hidden bg-white shadow sm:rounded-lg mt-4">
    <div class="p-6 flex justify-between items-center">
    <div class="flex-1">
    <button id="addUserBtn" class="bg-yellow-500 text-white p-2 rounded ml-4 flex items-center">
        <i class="fas fa-plus mr-2"></i> 
        Tambah Data
    </button>
</div>

<form id="searchUsers" class="flex items-center space-x-2">
    <input type="text" name="search" placeholder="Cari disini..." class="border border-gray-300 rounded-lg p-2">
</form>

    </div>
</div>
        <div class="overflow-x-auto">
        <table class="min-w-full">
    <thead>
        <tr class="bg-gray-100">
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lengkap</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pengguna</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Level</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200" id="userTableBody">
    </tbody>
</table>

<!-- Modal add user -->
<div id="addUserModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-2xl w-full">
        <h2 class="text-xl font-bold mb-4">Tambah User</h2>
        <form id="addUserForm">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4 col-span-1 md:col-span-2">
                    <label for="user_full_name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" id="user_full_name" name="user_full_name" required class="border border-gray-300 rounded-lg p-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="user_name" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" id="user_name" name="user_name" required class="border border-gray-300 rounded-lg p-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="user_email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="user_email" name="user_email" required class="border border-gray-300 rounded-lg p-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="user_password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="user_password" name="user_password" required class="border border-gray-300 rounded-lg p-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required class="border border-gray-300 rounded-lg p-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="user_level" class="block text-sm font-medium text-gray-700">Role</label>
                    <select id="user_level" name="user_level" required class="border border-gray-300 rounded-lg p-2 w-full">
                        <option>Pilih Role</option>
                        <option value="Outlet">Outlet</option>
                        <option value="GA Pusat">GA Pusat</option>
                        <option value="GA Area">GA Area</option>
                        <option value="IT">IT</option>
                        <option value="Keuangan">Keuangan</option>
                    </select>
                </div>
                <p class="text-sm text-gray-600 mb-4">
            <strong>Catatan:</strong> Masukkan data salah satu: jika user dari outlet tertentu maka masukkan outlet, 
            jika user mewakili area tertentu maka masukkan area, dan jika semua area pilih "All Area".
        </p>
                <div class="mb-4">
                    <label for="user_outlet_id" class="block text-sm font-medium text-gray-700">Masukkan Outlet (Opsional)</label>
                    <select id="user_outlet_id" name="user_outlet_id" class="border border-gray-300 rounded-lg p-2 w-full">
                        <option value="">Pilih Outlet</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="user_area_id" class="block text-sm font-medium text-gray-700">Masukkan Area (Opsional)</label>
                    <select id="user_area_id" name="user_area_id" class="border border-gray-300 rounded-lg p-2 w-full">
                        <option value="">Pilih Area</option>
                        <option value="true">All Area</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-end mt-4">
                <button id="closeModalButton" type="button" class="mr-2 bg-red-500 text-white p-2 rounded">Batal</button>
                <button type="submit" class="bg-yellow-500 text-white p-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="editUserModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-2xl w-full">
        <h2 class="text-xl font-bold mb-4">Edit User</h2>
        <form id="editUserForm">
            <input type="hidden" id="edit_user_id" name="user_id" required>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4 col-span-1 md:col-span-2">
                    <label for="edit_user_full_name" class="block text-sm font-medium text-gray-700">Update Nama Lengkap</label>
                    <input type="text" id="edit_user_full_name" name="user_full_name" required class="border border-gray-300 rounded-lg p-2 w-full">
                </div>
                <div class="mb-4 col-span-1 md:col-span-2">
                    <label for="edit_user_email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="edit_user_email" name="user_email" required class="border border-gray-300 rounded-lg p-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="edit_user_name" class="block text-sm font-medium text-gray-700">Update Username</label>
                    <input type="text" id="edit_user_name" name="user_name" required class="border border-gray-300 rounded-lg p-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="edit_user_level" class="block text-sm font-medium text-gray-700">Role</label>
                    <select id="edit_user_level" name="user_level" required class="border border-gray-300 rounded-lg p-2 w-full">
                        <option value="">Pilih</option>
                        <option value="Outlet">Outlet</option>
                        <option value="GA Pusat">GA Pusat</option>
                        <option value="GA Area">GA Area</option>
                        <option value="IT">IT</option>
                        <option value="Keuangan">Keuangan</option>
                    </select>
                </div>
                <p class="text-sm text-gray-600 mb-4 col-span-1 md:col-span-2">
                    <strong>Catatan:</strong> Masukkan data salah satu: jika user dari outlet tertentu maka masukkan outlet, 
                    jika user mewakili area tertentu maka masukkan area, dan jika semua area pilih "All Area".
                </p>
                <div class="mb-4">
                    <label for="edit_user_outlet_id" class="block text-sm font-medium text-gray-700">Update Outlet (Opsional)</label>
                    <select id="edit_user_outlet_id" name="user_outlet_id" class="border border-gray-300 rounded-lg p-2 w-full">
                        <option value="">Pilih Outlet</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="edit_user_area_id" class="block text-sm font-medium text-gray-700">Update Area (Opsional)</label>
                    <select id="edit_user_area_id" name="user_area_id" class="border border-gray-300 rounded-lg p-2 w-full">
                        <option value="">Pilih Area</option>
                        <option value="true">All Area</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-end mt-4">
                <button id="closeModalEdit" type="button" class="mr-2 bg-red-500 text-white p-2 rounded">Batal</button>
                <button type="submit" class="bg-yellow-500 text-white p-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <script>

function resetPw(userId) {
    window.location.href = `/resetPw/${userId}`;
}

// Ambil user_level dari localStorage
const userLevel = localStorage.getItem('user_level');

// Ambil elemen menu
const masterMenu = document.getElementById('masterMenu');

// Cek apakah user_level adalah 'IT' atau 'GA Pusat'
if (userLevel === 'IT' || userLevel === 'GA Pusat') {
    // Jika ya, tampilkan menu
    masterMenu.classList.remove('hidden');
} else {
    // Jika tidak, sembunyikan menu
    masterMenu.classList.add('hidden');
}

document.querySelectorAll('.logout').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault(); // Mencegah submit form
        e.stopPropagation(); // Menghentikan event bubbling
        
        const token = localStorage.getItem('token');
        fetch('http://127.0.0.1:8000/api/logout', {
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + token,
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.message === 'Successfully logged out') {
                localStorage.removeItem('user_name');
                localStorage.removeItem('token');
                localStorage.removeItem('user_level');
                alert('Anda berhasil logout!');
                window.location.href = '/login';
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const token = localStorage.getItem('token');
    fetch('http://127.0.0.1:8000/api/outlets/getAll', {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success && data.data) {
            const outletSelect = document.getElementById('user_outlet_id');
            data.data.forEach(outlet => {
                const option = document.createElement('option');
                option.value = outlet.outlet_id;  
                option.textContent = outlet.outlet_name;  
                outletSelect.appendChild(option);
            });
        } else {
            console.error('Error fetching outlet data');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const token = localStorage.getItem('token');
    fetch('http://127.0.0.1:8000/api/area/get/all', {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success && data.data) {
            const areaSelect = document.getElementById('user_area_id');
            data.data.forEach(area => {
                const option = document.createElement('option');
                option.value = area.area_id;  
                option.textContent = area.area_name;  
                areaSelect.appendChild(option);
            });
        } else {
            console.error('Error fetching area data');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const token = localStorage.getItem('token');
    
    // Fetching outlets
    fetch('http://127.0.0.1:8000/api/outlets/getAll', {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log("Outlet Data:", data); 
        if (data.success && data.data) {
            const outletSelect = document.getElementById('edit_user_outlet_id');
            data.data.forEach(outlet => {
                const option = document.createElement('option');
                option.value = outlet.outlet_id;  
                option.textContent = outlet.outlet_name;  
                outletSelect.appendChild(option);
            });
        } else {
            console.error('Error fetching outlet data');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });

    fetch('http://127.0.0.1:8000/api/area/get/all', {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log("Area Data:", data);
        if (data.success && data.data) {
            const areaSelect = document.getElementById('edit_user_area_id');
            data.data.forEach(area => {
                const option = document.createElement('option');
                option.value = area.area_id;  
                option.textContent = area.area_name;  
                areaSelect.appendChild(option);
            });
        } else {
            console.error('Error fetching area data');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
     document.addEventListener('DOMContentLoaded', function() {
    const user_name = localStorage.getItem('user_name') || 'Pengguna';
    document.getElementById('user_name').innerText = user_name;

    let toggleButton = document.querySelector('#menuToggleBtn');
    let sidebar = document.querySelector('#sidebar');

    toggleButton.addEventListener('click', () => {
        sidebar.classList.toggle('sidebar-open');
        sidebar.classList.toggle('sidebar-closed');
    });
    
    const searchInput = document.querySelector('input[name="search"]');
    const tableBody = document.querySelector('#userTableBody'); 
    function getToken() {
        return localStorage.getItem('token');
    }

    async function fetchUsers() {
        const token = getToken();

        try {
            const response = await fetch('http://127.0.0.1:8000/api/users/get', {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json'
                }
            });
            const users = await response.json();
            renderUsers(users);
        } catch (error) {
            console.error('Error fetching users:', error);
        }
    }
    function renderUsers(users) {
        tableBody.innerHTML = '';
        users.forEach((user, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">${index + 1}</td>
                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 user-id" style="display:none;">${user.user_id}</td>
                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 user-full-name">${user.user_full_name}</td>
                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 user-name">${user.user_name}</td>
                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 user-email">${user.user_email}</td>
                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 user-level">${user.user_level}</td>
                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                     <button class="bg-yellow-500 text-white p-2 rounded edit-button" 
                data-user_id="${user.user_id}" 
                data-user_full_name="${user.user_full_name}" 
                data-user_email="${user.user_email}" 
                data-user_level="${user.user_level}" 
                data-user_name="${user.user_name}" 
                data-user_outlet_id="${user.user_outlet_id}"
                data-user_area_id="${user.user_area_id}">
            Edit
        </button>
        <button class="bg-red-500 text-white p-2 rounded" onclick="resetPw(${user.user_id})">Reset Password</button>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }

    searchInput.addEventListener('input', async function () {
        const searchValue = searchInput.value;
        const token = getToken();

        if (searchValue.trim() === '') {
            fetchUsers();
        } else {
            try {
                const response = await fetch(`http://127.0.0.1:8000/api/users/search?query=${searchValue}`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`, 
                        'Content-Type': 'application/json'
                    }
                });
                const users = await response.json();
                renderUsers(users);
            } catch (error) {
                console.error('Error searching users:', error);
            }
        }
    });

    fetchUsers();
    tableBody.addEventListener('click', (e) => {
    if (e.target.classList.contains('edit-button')) {
        const user_id = e.target.dataset.user_id;
            const user_full_name = e.target.dataset.user_full_name;
            const user_email = e.target.dataset.user_email;
            const user_level = e.target.dataset.user_level;
            const user_name = e.target.dataset.user_name;
            const user_outlet_id = e.target.dataset.user_outlet_id; 
            const user_area_id = e.target.dataset.user_area_id; 

            document.getElementById('edit_user_id').value = user_id;
            document.getElementById('edit_user_full_name').value = user_full_name;
            document.getElementById('edit_user_email').value = user_email;
            document.getElementById('edit_user_level').value = user_level;
            document.getElementById('edit_user_name').value = user_name; 
            document.getElementById('edit_user_outlet_id').value = user_outlet_id;
            document.getElementById('edit_user_area_id').value = user_area_id;

        document.getElementById('editUserModal').classList.remove('hidden');
    }
});
function closeEditModal() {
    document.getElementById('editUserModal').classList.add('hidden');
}

document.getElementById('closeModalEdit').addEventListener('click', closeEditModal);

    document.getElementById('editUserForm').addEventListener('submit', async (e) => {
        e.preventDefault();

        const token = localStorage.getItem('token');
    if (!token) {
        alert('Token tidak ditemukan. Harap login kembali.');
        return;
    }
       
    const user_id = document.getElementById('edit_user_id').value;
        const user_full_name = document.getElementById('edit_user_full_name').value;
        const user_email = document.getElementById('edit_user_email').value;
        const user_level = document.getElementById('edit_user_level').value;
        const user_name = document.getElementById('edit_user_name').value;
        const user_outlet_id = document.getElementById('edit_user_outlet_id').value;
        const user_area_id = document.getElementById('edit_user_area_id').value;

        // Determine has_full_access based on area selection
        const has_full_access = user_area_id === 'true' ? '1' : '0';
        try {
            const response = await fetch(`http://127.0.0.1:8000/api/users/edit/${user_id}`, {
                method: 'PUT',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    user_full_name: user_full_name,
                    user_email: user_email,
                    user_level: user_level,
                    user_outlet_id: user_outlet_id,
                    user_area_id: user_area_id,
                    user_name: user_name,
                    has_full_access: has_full_access
                })
            });
            if (!response.ok) {
    const errorData = await response.json();
    console.error('Error updating user:', errorData);
    alert('Gagal memperbarui pengguna: ' + errorData.message);
}
            if (response.ok) {
                await fetchUsers();
                closeEditModal();
            } else {
                console.error('Error updating user');
                alert('Gagal memperbarui pengguna.');
            }
        } catch (error) {
            console.error('Error updating user:', error);
        }
    });

function openModal() {
    document.getElementById('addUserModal').classList.remove('hidden');
}
function closeModalAdd() {
    document.getElementById('addUserModal').classList.add('hidden');
}

document.getElementById('closeModalButton').addEventListener('click', closeModalAdd);
document.getElementById('addUserForm').addEventListener('submit', async function (event) {
    event.preventDefault();

    const password = document.getElementById('user_password').value;
    const passwordConfirmation = document.getElementById('password_confirmation').value;

    // Cek kesesuaian password
    if (password !== passwordConfirmation) {
        alert('Password dan Konfirmasi Password tidak sama.');
        return;
    }

    const formData = new FormData(this);

const areaSelect = document.getElementById('user_area_id');
if (areaSelect.value === 'true') {
    formData.append('has_full_access', '1'); // Gunakan string '1' untuk true
} else {
    formData.append('has_full_access', '0'); // Gunakan string '0' untuk false
}

    const token = localStorage.getItem('token');

    try {
        const response = await fetch('http://127.0.0.1:8000/api/register', {
            method: 'POST',
            body: formData,
            headers: {
                'Authorization': `Bearer ${token}`,
                'X-Requested-With': 'XMLHttpRequest',
            },
        });
        console.log('Payload yang dikirim:', Array.from(formData.entries()));

        const data = await response.json();
        if (response.ok) {
            closeModalAdd();
            alert(data.message);
            window.location.reload();
            fetchUsers();
        } else {
            // Tampilkan pesan kesalahan jika ada
            alert(data.message || 'Terjadi kesalahan saat menambahkan user.');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menambahkan user.');
    }
});

// Event listener untuk tombol buka modal
document.getElementById('addUserBtn').addEventListener('click', openModal);
});

function openModal(userId) {
    const resetPasswordModal = document.getElementById('resetPasswordModal');
    resetPasswordModal.classList.remove('hidden'); 

    const resetPasswordForm = document.getElementById('resetPasswordForm');
    resetPasswordForm.setAttribute('data-user_id', userId);
}

function closeModal() {
    const resetPasswordModal = document.getElementById('resetPasswordModal');
    resetPasswordModal.classList.add('hidden');
}
document.querySelectorAll('.riset-button').forEach(button => {
    button.addEventListener('click', function () {
        console.log('Reset Password clicked');
        const userId = this.getAttribute('data-user_id'); 
        openModal(userId);
    });
});

document.getElementById('closeModalReset').addEventListener('click', function () {
    
    closeModal();
});

const resetPasswordForm = document.getElementById('resetPasswordForm');
resetPasswordForm.addEventListener('submit', function (e) {
    e.preventDefault();
    
    const userId = resetPasswordForm.getAttribute('data-user_id'); 
    const password = document.getElementById('password').value;
    const passwordConfirmation = document.getElementById('password_confirmation').value;
    const data = {
        new_password: password,
        new_password_confirmation: passwordConfirmation
    };

    fetch(`http://127.0.0.1:8000/api/users/reset-password/${userId}`, {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${localStorage.getItem('token')}`
    },
    body: JSON.stringify(data)
})

    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Password reset successfully');
        } else {
            alert('Failed to reset password');
        }
        
        closeModal();
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while resetting the password');
    });
});

    </script>
</body>
</html>