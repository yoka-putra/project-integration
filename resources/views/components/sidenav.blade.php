<!-- resources/views/components/sidebar.blade.php -->
<script src="https://cdn.jsdelivr.net/npm/ionicons@5.4.0/dist/ionicons/ionicons.esm.js" type="module"></script>
    <script nomodule src="https://cdn.jsdelivr.net/npm/ionicons@5.4.0/dist/ionicons/ionicons.js"></script>

    <!-- Pustaka lainnya -->
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
        #menuToggleBtn {
    z-index: 1000; /* Pastikan tombol berada di atas elemen lain */
}
    </style>

<div class="h-screen bg-orange-500 transition-all {{ $isOpen ? 'sidebar-open' : 'sidebar-closed' }}">
    <div class="p-4">
        <h1 class="text-white text-2xl font-bold">SSB</h1>
        <h2 class="text-white text-lg mt-2">Spesial Soto Boyolali</h2>
        <h2 class="text-white text-lg">Hj. Hesti Widodo</h2>
        <hr class="border-white my-4">
        <ul class="mt-4 text-white">
            <a href="{{ route('daftarAset') }}" class="flex items-center text-white p-2 rounded-lg hover:bg-orange-400">
                <span class="mr-2"><i class="bi bi-list-task"></i></span>
                <span>Daftar Aset</span>
            </a>
            <a href="{{ route('scanQr') }}" class="flex items-center text-white p-2 rounded-lg hover:bg-orange-400">
                <span class="mr-2"><i class="bi bi-camera"></i></span>
                <span>Scan Qr Code</span>
            </a>
            <details id="masterMenu" class="group">
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
            <button type="button" class="flex items-center text-white p-3 rounded-lg mb-2 logout">
                <span class="mr-2"><i class="bi bi-box-arrow-right"></i></span>
                <span>Logout</span>
            </button>
        </ul>
    </div>
</div>
<div class="grow p-6" id="content">
<div>
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
</div>

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
                localStorage.removeItem('user_full_name');
                alert('Anda berhasil logout!');
                window.location.href = '/login';
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const user_name = localStorage.getItem('user_name') || 'Pengguna';
    document.getElementById('user_name').innerText = user_name;

    const toggleButton = document.querySelector('#menuToggleBtn');
    const sidebar = document.querySelector('#sidebar');

    toggleButton.addEventListener('click', () => {
        sidebar.classList.toggle('sidebar-open');
        sidebar.classList.toggle('sidebar-closed');
    });
});

    
</script>