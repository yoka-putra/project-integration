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
        <a href="{{ route('masterUser') }}" class="flex items-center text-white p-2 rounded-lg hover:bg-orange-400">
            <span class="mr-2"><i class="bi bi-people"></i></span>
            <span>User</span>
        </a>
        <a href="{{ route('masterAset') }}" class="flex items-center text-white p-2 rounded-lg hover:bg-orange-400">
            <span class="mr-2"><i class="bi bi-folder"></i></span>
            <span>Aset</span>
        </a>
    </div>
</details>
                    <form class="inline">
                        <button type="submit" class="flex items-center text-white p-3 rounded-lg mb-2" id="logout">
                            <span class="mr-2"><i class="bi bi-box-arrow-right"></i></span>
                            <span>Logout</span>
                        </button>
                    </form>
                </ul>
            </div>
        </div>

        <!-- Content -->
        <div class="grow p-6" id="content">
    <!-- Kartu Pembungkus -->
    <div class="p-6">
    <div class="bg-white rounded-xl p-6 flex items-center justify-between mb-4">
            <div class="flex items-center">
                <ion-icon id="menuToggleBtn" name="menu" class="text-3xl cursor-pointer mr-2"></ion-icon>
                   <h1 class="text-xl font-semibold">Asset Pos Manager</h1>
            </div>
            <div class="flex items-center">
                <i class="bi bi-person-fill mr-2"></i>
                <span id="user_name" class="text-xl font-semibold"></span>
            </div>
        </div>
    <div class="flex-1">
</div>

<form id="resetPwForm">
  <div class="space-y-12">
    <div class="border-b border-gray-900/10 pb-12">
    <div class="bg-gray-200 p-6 rounded-lg shadow-md">
        <h2 class="text-base font-semibold leading-7 text-gray-900">Formulir reset password</h2>
      </div>

      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2">
        <div class="sm:col-span-1">
          <label for="new_password" class="block text-sm font-medium leading-6 text-gray-900">Password baru</label>
          <div class="mt-2">
            <input type="password" name="new_password" id="new_password" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 p-2" placeholder="masukkan password baru">
          </div>
        </div>

        <div class="sm:col-span-1">
          <label for="new_password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">Konfirmasi password</label>
          <div class="mt-2">
            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 p-2" placeholder="masukkan konfirmasi password">
          </div>
        </div>

      </div>
    </div>

    <div class="flex items-center justify-end gap-x-3">
  <button type="submit" class="bg-yellow-500 text-white p-2 rounded">Simpan</button>
</div>

  </div>
</form>

    </div>
</div>
        <div class="overflow-x-auto">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <script>
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
    //menyembunyikan menu
}
document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('resetPwForm');
  const user_id = window.location.pathname.split('/').pop(); 

  if (form) {
    form.addEventListener('submit', async function(event) {
      event.preventDefault(); 

      const formData = new FormData(form);
      const token = localStorage.getItem('token'); 

      try {
        const response = await fetch(`http://127.0.0.1:8000/api/users/reset-password/${user_id}`, { 
          method: 'POST',
          headers: {
            'Authorization': `Bearer ${token}`,
          },
          body: formData, 
        });
        //post form data ke endpoint

        if (response.ok) {
          const jsonResponse = await response.json();
          alert('Password berhasil diubah'); 
          console.log(jsonResponse); 
          form.reset();

          window.location.href = '/masterUser'; 
        } else {
          const errorResponse = await response.json();
          alert('Gagal reset: ' + errorResponse.message); 
        }
      } catch (error) {
        console.error('Terjadi kesalahan:', error);
        alert('Terjadi kesalahan saat reset.');
      }
    });
  }
});

document.querySelectorAll('.logout').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault(); 
        e.stopPropagation(); 
        
        const token = localStorage.getItem('token');
        fetch('http://127.0.0.1:8000/api/logout', {
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + token,
                'Content-Type': 'application/json'
            }
        })
        //logout berhasil ke halaman login kembali
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
//ambil nama di local storage dan hapus ketika logout
     document.addEventListener('DOMContentLoaded', function() {
    const user_name = localStorage.getItem('user_name') || 'Pengguna';
    document.getElementById('user_name').innerText = user_name;

    let toggleButton = document.querySelector('#menuToggleBtn');
    let sidebar = document.querySelector('#sidebar');

    toggleButton.addEventListener('click', () => {
        sidebar.classList.toggle('sidebar-open');
        sidebar.classList.toggle('sidebar-closed');
    });
});

    </script>
</body>
</html>