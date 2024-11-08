<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asset Display</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
    body {
        font-family: Arial, sans-serif;
    }
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
    .container {
        display: flex;
        align-items: flex-start;
        padding: 20px;
        border: 1px solid #ccc;
        max-width: 1200px;
        margin: auto;
        flex-wrap: wrap;
    }
    .image-section {
        width: 250px;
        text-align: center;
        padding-right: 20px;
    }
    .image-section img {
        width: 100%;
        height: auto;
        padding: 10px;
        border-radius: 8px;
    }
    .specs {
        font-size: 0.9em;
        color: #555;
        margin-top: 10px;
    }
    .data-section {
        border: 1px solid #007bff;
        padding: 20px;
        flex-grow: 1;
        min-width: 400px;
    }
    .data-section table {
        width: 100%;
        border-collapse: collapse;
    }
    .data-section th, .data-section td {
        padding: 8px;
        text-align: left;
        border: 1px solid #ddd;
    }
    .data-section th {
        background-color: #f0f8ff;
        color: #333;
        font-weight: bold;
    }
    .text-right {
        text-align: right;
    }
    .mt-6 {
        margin-top: 1.5rem;
    }
    .mb-6 {
        margin-bottom: 1.5rem;
    }
    .px-4 {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    .py-2 {
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
    }
    .bg-yellow-500 {
        background-color: #fbbf24;
    }
    .text-white {
        color: white;
    }
    .rounded {
        border-radius: 0.375rem;
    }
    .hover\:bg-red-500:hover {
        background-color: #ef4444;
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
                    <form class="inline">                         <a href="{{ route('daftarAset') }}" class="flex items-center text-white p-2 rounded-lg hover:bg-orange-400">             <span class="mr-2"><i class="bi bi-list-task"></i></span>             <span>Daftar Aset</span>         </a>                     </form>                  
                    <form class="inline">
    <a href="{{ route('scanQr') }}" class="flex items-center text-white p-2 rounded-lg hover:bg-orange-400">
        <span class="mr-2"><i class="bi bi-camera"></i></span> 
        <span>Scan Qr Code</span>
    </a>
</form>
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
                <ion-icon id="menuToggleBtn" name="menu" class="text-xl cursor-pointer mr-2"></ion-icon>
                <h1 class="text-xl font-semibold">Asset Pos Manager</h1>
            </div>
            <div class="flex items-center">
                <i class="bi bi-person-fill mr-2"></i>
                <span id="user_name" class="text-xl font-semibold"></span>
            </div>
        </div>
        <div class="overflow-hidden bg-white shadow sm:rounded-lg mt-4 p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">Detail Aset</h1>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <!-- Image Section with Specification -->
        <div class="col-span-1 flex flex-col items-center justify-center">
            <img id="asset-image" src="" alt="Asset Image" class="h-50 w-50 object-cover rounded-lg border mb-4">
            
            <!-- Spesifikasi Aset -->
            <div class="w-full p-3 bg-gray-50 rounded-lg text-sm">
                <dt class="font-medium text-gray-900">Spesifikasi Aset</dt>
                <dd class="text-gray-700" id="asset-spesifikasi">-</dd>
            </div>
        </div>

        <!-- Details Section -->
        <div class="col-span-2">
            <div class="flow-root rounded-lg border border-gray-100 py-3 shadow-sm">
                <dl class="-my-3 divide-y divide-gray-100 text-sm">
                    <!-- Nama Outlet -->
                    <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Nama Outlet</dt>
                        <dd class="text-gray-700 sm:col-span-2" id="asset-outlet">-</dd>
                    </div>
                    <!-- Nama Asset -->
                    <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Nama Asset</dt>
                        <dd class="text-gray-700 sm:col-span-2" id="asset-name">-</dd>
                    </div>

                    <!-- Merk Aset -->
                    <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Merk Aset</dt>
                        <dd class="text-gray-700 sm:col-span-2" id="asset-merk">-</dd>
                    </div>

                    <!-- Tanggal Pembelian -->
                    <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Tanggal Pembelian</dt>
                        <dd class="text-gray-700 sm:col-span-2" id="tgl-pembelian">-</dd>
                    </div>

                    <!-- PIC -->
                    <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">PIC</dt>
                        <dd class="text-gray-700 sm:col-span-2" id="aset-pic">-</dd>
                    </div>

                    <!-- Penanggung Jawab -->
                    <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Penanggung Jawab</dt>
                        <dd class="text-gray-700 sm:col-span-2" id="aset-penanggungjawab">-</dd>
                    </div>

                    <!-- Kondisi Awal -->
                    <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Kondisi Awal</dt>
                        <dd class="text-gray-700 sm:col-span-2" id="aset-kondisi">-</dd>
                    </div>

                    <!-- Riwayat -->
                    <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Riwayat Kondisi</dt>
                        <dd class="text-gray-700 sm:col-span-2" id="aset-riwayat">-</dd>
                    </div>

                    <!-- Jadwal Maintenance -->
                    <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Jadwal Maintenance</dt>
                        <dd class="text-gray-700 sm:col-span-2" id="jadwal-maintenance">-</dd>
                    </div>

                    <!-- Jenis Maintenance -->
                    <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Jenis Maintenance</dt>
                        <dd class="text-gray-700 sm:col-span-2" id="jenis_maintenance">-</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>


<div class="text-right mt-6 mb-6 pr-6">
    <button 
        id="btn-formBarangHilang" 
        class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-red-500 hidden"
        onclick="formBarangHilang(assetId)"
    >
        Laporkan Barang Hilang
    </button>
</div>
        </div>
    </div>
</div>

            <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
            <script>
  function formBarangHilang(asetId) {
        window.location.href = `/formBarangHilang/${asetId}`;
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

document.addEventListener('DOMContentLoaded', function() {
    const user_name = localStorage.getItem('user_name') || 'Pengguna';
    document.getElementById('user_name').innerText = user_name;

    let toggleButton = document.querySelector('#menuToggleBtn');
    let sidebar = document.querySelector('#sidebar');

    document.getElementById('menuToggleBtn').addEventListener('click', function () {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('sidebar-closed');
    sidebar.classList.toggle('sidebar-open');
});
});

function getAssetIdFromPath() {
    const path = window.location.pathname; 
    const segments = path.split('/');      
    return segments[segments.length - 1];  
}

const assetId = getAssetIdFromPath(); 

if (assetId) {
    const token = localStorage.getItem('token'); 

    fetch(`http://127.0.0.1:8000/api/asets/get/${assetId}`, {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${token}`, 
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`); 
        }
        return response.json(); 
    })
    .then(data => {
        const aset = data.aset; 

        // Update the asset information on the page
        if (aset.aset_image) {
            document.getElementById('asset-image').src = `http://127.0.0.1:8000/storage/${aset.aset_image}`;
        } else {
            document.getElementById('asset-image').src = ''; 
            document.getElementById('asset-image').alt = 'Image not available';
        }

        // document.getElementById('aset-tgl-beli').innerText = aset.aset_tgl_pembelian || '-';
        document.getElementById('asset-name').innerText = aset.aset_name || '-';
        document.getElementById('asset-merk').innerText = aset.aset_merk || '-';
        document.getElementById('asset-outlet').innerText = aset.outlet ? aset.outlet.outlet_name : '-';
        document.getElementById('aset-pic').innerText = aset.aset_pic || '-';
        document.getElementById('aset-penanggungjawab').innerText = aset.penanggungjawab || '-';
        document.getElementById('aset-kondisi').innerText = aset.aset_kondisi || '-';
        document.getElementById('jadwal-maintenance').innerText = aset.klasifikasi.jadwal_maintenance || '-';
        document.getElementById('jenis_maintenance').innerText = aset.klasifikasi.jenis_maintenance || '-';
        document.getElementById('aset-riwayat').innerText = aset.aset_status || '-';
        document.getElementById('tgl-pembelian').innerText = aset.aset_tgl_pembelian || '-';
        // document.getElementById('klasifikasi-nilai-buku-terakhir').innerText = aset.klasifikasi_nilai_buku_terakhir || '-';
        // document.getElementById('klasifikasi-nilai-ekonomis').innerText = aset.klasifikasi.klasifikasi_nilai_ekonomis || '-';
        document.getElementById('asset-spesifikasi').innerText = aset.aset_spesifikasi || '-';
        // document.getElementById('nilai-penyusutan').innerText = aset.nilai_penyusutan || '-';
        // document.getElementById('parameter-kesehatan-aset').innerText = aset.klasifikasi.parameter_kesehatan_aset || '-';

        // Check if there is a maintenance schedule
        const maintenanceElement = document.getElementById('jadwal-maintenance');
        if (aset.jadwal_maintenance && aset.jadwal_maintenance.length > 0) {
            const maintenanceDates = aset.jadwal_maintenance.map(jadwal => jadwal.tanggal_maintenance).join(', ');
            maintenanceElement.innerText = maintenanceDates;
        } else {
            maintenanceElement.innerText = '-';
        }

        // Calculate and display the asset's age
        // const umurAsetElement = document.getElementById('data-umur-aset'); 
        // if (umurAsetElement) {
        //     umurAsetElement.innerText = data.usia_aset_in_months || '-'; 
        // } else {
        //     console.error('Element with ID "umur-aset" not found.');
        // }

        if (aset.aset_status === 'Baik' || aset.aset_status === 'Non-maintenance') {
    // Show the button if the status is either "Baik" or "Non-maintenance"
    document.getElementById('btn-formBarangHilang').classList.remove('hidden');
} else {
    // Hide the button if the status is not one of the allowed statuses
    document.getElementById('btn-formBarangHilang').classList.add('hidden');
}


    })
    .catch(error => console.error('Error fetching asset data:', error)); 
} else {
    console.error('Asset ID not found in URL parameters.'); 
    alert('Asset ID is missing in the URL. Please provide a valid ID.'); 
}

</script>
        </div>
    </div>
</body>
</html>

