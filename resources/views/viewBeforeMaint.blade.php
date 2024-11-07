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
            max-width: 800px;
            margin: auto;
        }
        .image-section {
            width: 200px;
            text-align: center;
        }
        .image-section img {
            width: 200px;
            height: auto;
            padding: 10px;
        }
        .specs {
            font-size: 0.9em;
            color: #555;
            margin-top: 10px;
        }
        .data-section {
            border: 1px solid #007bff;
            padding: 10px;
            flex-grow: 1;
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
            width: 40%;
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
        <!-- Content -->
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
    <div class="overflow-hidden bg-white shadow sm:rounded-lg mt-4">
    <div class="p-6 flex justify-between items-center">
    <div class="flex-1">
        <h1 class="text-xl font-bold">Detail Aset</h1>
    </div>
</div>

<div class="container">
    <div class="image-section">
        <img id="asset-image" alt="Asset Image">
        <div class="specs">
            <p class="text-left list-none p-0 m-0">Spesifikasi:</p>
            <ul id="asset-spesifikasi" class="text-left list-none p-0 m-0">
                <li>Loading specifications...</li>
            </ul>
        </div>
    </div>
    <div class="data-section">
        <table>
        <tr><th>Nama Asset</th><td id="asset-name">-</td></tr>
            <tr><th>Merk Aset</th><td id="asset-merk">-</td></tr>
            <tr><th>Nama Outlet</th><td id="asset-outlet">-</td></tr>
            <tr><th>PIC</th><td id="aset-pic">-</td></tr>
            <tr><th>Kondisi Awal</th><td id="aset-kondisi">-</td></tr>
            <tr><th>Tanggal Pembelian</th><td id="aset-tgl-beli">-</td></tr>
            <tr><th>Umur aset</th><td id="data-umur-aset">-</td></tr>
            <tr><th>Jadwal Maintenance</th><td id="jadwal-maintenance">-</td></tr>
            <tr><th>Jenis Maintenance</th><td id="jenis_maintenance">-</td></tr>
            <tr><th>Riwayat Perubahan</th><td id="aset-riwayat">-</td></tr>
            <tr><th>Nilai Perolehan</th><td id="klasifikasi-nilai-perolehan">-</td></tr>
            <tr><th>Nilai Buku Terakhir</th><td id="klasifikasi-nilai-buku-terakhir">-</td></tr>
            <tr><th>Nilai Ekonomis (Satuan Bulan)</th><td id="klasifikasi-nilai-ekonomis">-</td></tr>
            <tr><th>Nilai Penyusutan</th><td id="nilai-penyusutan">-</td></tr>
            <tr><th>Parameter Kesehatan</th><td id="parameter-kesehatan-aset">-</td></tr>
            
        </table>
    </div>
</div>

<div class="text-right mt-6 mb-6 pr-6">
    <button class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-red-500" onclick="formBarangHilang(assetId)">
        Request Barang Hilang
    </button>
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

    toggleButton.addEventListener('click', () => {
        sidebar.classList.toggle('sidebar-open');
        sidebar.classList.toggle('sidebar-closed');
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

        if (aset.aset_image) {
            document.getElementById('asset-image').src = `http://127.0.0.1:8000/storage/${aset.aset_image}`;
        } else {
            document.getElementById('asset-image').src = ''; 
            document.getElementById('asset-image').alt = 'Image not available';
        }
        document.getElementById('aset-tgl-beli').innerText = aset.aset_tgl_pembelian || '-';
        document.getElementById('asset-name').innerText = aset.aset_name || '-';
        document.getElementById('asset-merk').innerText = aset.aset_merk || '-';
        document.getElementById('asset-outlet').innerText = aset.outlet ? aset.outlet.outlet_name : '-';
        document.getElementById('aset-pic').innerText = aset.aset_pic || '-';
        document.getElementById('aset-kondisi').innerText = aset.aset_kondisi || '-';
        document.getElementById('jadwal-maintenance').innerText = aset.klasifikasi.jadwal_maintenance || '-';
        document.getElementById('jenis_maintenance').innerText = aset.klasifikasi.jenis_maintenance || '-';
        document.getElementById('aset-riwayat').innerText = aset.aset_status || '-';
        document.getElementById('klasifikasi-nilai-perolehan').innerText = aset.klasifikasi_nilai_perolehan || '-';
        document.getElementById('klasifikasi-nilai-buku-terakhir').innerText = aset.klasifikasi_nilai_buku_terakhir || '-';
        document.getElementById('klasifikasi-nilai-ekonomis').innerText = aset.klasifikasi.klasifikasi_nilai_ekonomis || '-';
        document.getElementById('asset-spesifikasi').innerText = aset.aset_spesifikasi || '-';
        document.getElementById('nilai-penyusutan').innerText = aset.nilai_penyusutan || '-';
        document.getElementById('parameter-kesehatan-aset').innerText = aset.klasifikasi.parameter_kesehatan_aset || '-';
        const maintenanceElement = document.getElementById('jadwal-maintenance');

// Check if there's a jadwal_maintenance array and if it has items
if (aset.jadwal_maintenance && aset.jadwal_maintenance.length > 0) {
    // Extract the dates from the jadwal_maintenance array
    const maintenanceDates = aset.jadwal_maintenance.map(jadwal => jadwal.tanggal_maintenance).join(', ');
    maintenanceElement.innerText = maintenanceDates;
} else {
    maintenanceElement.innerText = '-'; // Display '-' if there are no maintenance records
}
        const umurAsetElement = document.getElementById('data-umur-aset'); 
        if (umurAsetElement) {
            umurAsetElement.innerText = data.usia_aset_in_months || '-'; 
        } else {
            console.error('Element with ID "umur-aset" not found.');
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

