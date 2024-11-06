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
                    <form class="inline">                         <a href="{{ route('daftarAset') }}" class="flex items-center text-white p-2 rounded-lg hover:bg-orange-400">            
                       <span class="mr-2">
                        <i class="bi bi-list-task"></i>
                      </span>             
                      <span>Daftar Aset</span>         </a>                     </form>                     <form class="inline">     <a class="flex items-center text-white p-2 rounded-lg hover:bg-orange-400">         <span class="mr-2"><i class="bi bi-camera"></i></span>          <span>Scan Qr Code</span>     </a> </form>
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

<form id="addAssetForm">
  <div class="space-y-12">
    <div class="border-b border-gray-900/10 pb-12">
      <div class="bg-gray-200 p-6 rounded-lg shadow-md">
        <h2 class="text-base font-semibold leading-7 text-gray-900">Formulir Pengajuan Service/ganti</h2>
      </div>

      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2">
        <div class="sm:col-span-1">
          <label for="permintaan_nama_pengaju" class="block text-sm font-medium leading-6 text-gray-900">Nama Pengaju</label>
          <div class="mt-2">
            <input type="text" name="permintaan_nama_pengaju" id="permintaan_nama_pengaju" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 p-2" placeholder="masukkan nama aset" required>
          </div>
        </div>

        <div class="sm:col-span-1">
          <label for="permintaan_nama_outlet" class="block text-sm font-medium leading-6 text-gray-900">Nama Outlet Pangaju</label>
          <div class="mt-2">
            <input type="text" name="permintaan_nama_outlet" id="permintaan_nama_outlet" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 p-2" placeholder="masukkan merk aset" required>
          </div>
        </div>

        <div class="sm:col-span-1">
          <label for="permintaan_tgl_pengajuan" class="block text-sm font-medium leading-6 text-gray-900">Tanggal Pengajuan Aset</label>
          <div class="mt-2">
            <input type="date" name="permintaan_tgl_pengajuan" id="permintaan_tgl_pengajuan" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 p-2" placeholder="masukkan tanggal pembelian aset" required>
          </div>
        </div>

        <div class="sm:col-span-2"> 
          <label for="permintaan_nama_area" class="block text-sm font-medium leading-6 text-gray-900">Nama Area Pengaju</label>
          <div class="mt-2">
            <textarea name="permintaan_nama_area" id="permintaan_nama_area" rows="4" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 p-2" placeholder="masukkan spesifikasi aset" required></textarea>
          </div>
        </div>


        <div class="sm:col-span-2"> 
          <label for="permintaan_nama_area" class="block text-sm font-medium leading-6 text-gray-900">Nama Area Pengaju</label>
          <div class="mt-2">
            <textarea name="permintaan_nama_area" id="permintaan_nama_area" rows="4" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 p-2" placeholder="masukkan spesifikasi aset" required></textarea>
          </div>
        </div>

        <div class="sm:col-span-1">
          <label class="block text-sm font-medium leading-6 text-gray-900">Kategori Pengajuan</label>
          <div class="mt-2">
            <div class="flex items-center">
              <input type="radio" id="kondidi_serviceGanti" name="permintaan_kategori" value="Pengajuan Service/Ganti Aset" class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500" required>
              <label for="kondidi_serviceganti" class="ml-2 block text-sm text-gray-900">Pengajuan Service/Ganti Aset</label>
            </div>
            <div class="flex items-center mt-2">
              <input type="radio" id="kondisi_barangHilang" name="permintaan_kategori" value="Pengajuan Barang Hilang" class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500" required>
              <label for="kondisi_barangHilang" class="ml-2 block text-sm text-gray-900">Pengajuan Aset Hilang</label>
            </div>
            <div class="flex items-center mt-2">
              <input type="radio" id="kondisi_Abaikan" name="permintaan_kategori" value="Barang Kondisi Tidak Baik Diabaikan" class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500" required>
              <label for="kondisi_bekas" class="ml-2 block text-sm text-gray-900">Aset Kondisi Kurang Baik Diabaikan</label>
            </div>
          </div>
        </div>

        <div class="sm:col-span-1">
          <label class="block text-sm font-medium leading-6 text-gray-900">Status Aset</label>
          <div class="mt-2">
            <div class="flex items-center">
              <input type="radio" id="status_baik" name="aset_status" value="baik" class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500" required>
              <label for="status_baik" class="ml-2 block text-sm text-gray-900">Baik</label>
            </div>
            <div class="flex items-center mt-2">
              <input type="radio" id="status_buruk" name="aset_status" value="buruk" class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500" required>
              <label for="status_buruk" class="ml-2 block text-sm text-gray-900">Buruk</label>
            </div>
          </div>
        </div>

        <div class="sm:col-span-1">
          <label for="klasifikasi_nilai_perolehan" class="block text-sm font-medium leading-6 text-gray-900">Klasifikasi Nilai Perolehan</label>
          <div class="mt-2">
            <input type="number" name="klasifikasi_nilai_perolehan" id="klasifikasi_nilai_perolehan" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 p-2" placeholder="masukkan nilai perolehan" required>
          </div>
        </div>

        <div class="sm:col-span-1">
          <label for="outlet_id" class="block text-sm font-medium leading-6 text-gray-900">Area Kerja</label>
          <div class="mt-2">
            <select name="outlet_id" id="outlet_id" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 p-2" required>
              <option value="" disabled selected>Pilih Area Kerja</option>
              <option value="Non-Outlet" >Non Outlet</option>
            </select>
          </div>
        </div>

        <div class="sm:col-span-1">
          <label for="aset_pic" class="block text-sm font-medium leading-6 text-gray-900">PIC</label>
          <div class="mt-2">
            <select name="aset_pic" id="aset_pic" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 p-2" required>
              <option value="" disabled selected>Pilih PIC</option>
              <option value="IT">IT</option>
              <option value="GA Pusat">GA Pusat</option>
              <option value="GA Area">GA Area</option>
              <option value="Keuangan">Keuangan</option>
              <option value="Outlet">Outlet</option>
              <!-- <option value="MA">MA</option> -->
            </select>
          </div>
        </div>

        <div class="sm:col-span-1">
          <label for="penanggungjawab" class="block text-sm font-medium leading-6 text-gray-900">Penanggung Jawab</label>
          <div class="mt-2">
            <select name="penanggungjawab" id="penanggungjawab" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 p-2" required>
              <option value="" disabled selected>Pilih Penanggung Jawab</option>
              <option value="DM">DM</option>
              <option value="Kasir">Kasir</option>
              <option value="IT">IT</option>
              <option value="GA Pusat">GA Pusat</option>
              <option value="GA Area">GA Area</option>
            </select>
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