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
   @include('components.sidenav', ['isOpen' => true])

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
            <tr><th>Umur aset / Bulan</th><td id="data-umur-aset">-</td></tr>
            <tr><th>Jadwal Maintenance</th><td id="jadwal-maintenance">-</td></tr>
            <tr><th>Jenis Maintenance</th><td id="jenis_maintenance">-</td></tr>
            <tr><th>Riwayat Perubahan</th><td id="aset-riwayat">-</td></tr>
            <tr><th>Nilai Perolehan</th><td id="klasifikasi-nilai-perolehan">-</td></tr>
            <tr><th>Nilai Buku Terakhir</th><td id="klasifikasi-nilai-buku-terakhir">-</td></tr>
            <tr><th>Nilai Ekonomis (Satuan Bulan)</th><td id="klasifikasi-nilai-ekonomis">-</td></tr>
            <tr><th>Nilai Penyusutan</th><td id="nilai-penyusutan">-</td></tr>
            <!-- <tr><th>Parameter Kesehatan</th><td id="parameter-kesehatan-aset">-</td></tr> -->
            
        </table>
    </div>
</div>

<div class="text-right mt-6 mb-6 pr-6">
    <button 
        id="btn-maintenance" 
        class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-red-500 hidden"
        onclick="parameterKesehatan(assetId)"
    >
        Maintenance Aset
    </button>
</div>
     
       
            <script>

       
const currentUrl = window.location.href;
const asetId = currentUrl.substring(currentUrl.lastIndexOf('/') + 1);

function parameterKesehatan(asetId) {
    window.location.href = `/parameterKesehatan/${asetId}`;
}
            

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
        
        document.getElementById('jenis_maintenance').innerText = aset.klasifikasi.jenis_maintenance || '-';
        document.getElementById('aset-riwayat').innerText = aset.aset_status || '-';
        document.getElementById('klasifikasi-nilai-perolehan').innerText = aset.klasifikasi_nilai_perolehan || '-';
        document.getElementById('klasifikasi-nilai-buku-terakhir').innerText = aset.klasifikasi_nilai_buku_terakhir || '-';
        document.getElementById('klasifikasi-nilai-ekonomis').innerText = aset.klasifikasi.klasifikasi_nilai_ekonomis || '-';
        document.getElementById('asset-spesifikasi').innerText = aset.aset_spesifikasi || '-';
        document.getElementById('nilai-penyusutan').innerText = aset.nilai_penyusutan || '-';
        
        const maintenanceElement = document.getElementById('jadwal-maintenance');
        if (aset.jadwal_maintenance && aset.jadwal_maintenance.length > 0) {
            const maintenanceDates = aset.jadwal_maintenance.map(jadwal => jadwal.tanggal_maintenance).join(', ');
            maintenanceElement.innerText = maintenanceDates;
        } else {
            maintenanceElement.innerText = '-'; 
        }

        const umurAsetElement = document.getElementById('data-umur-aset'); 
        if (umurAsetElement) {
            umurAsetElement.innerText = data.usia_aset_in_months || '-'; 
        } else {
            console.error('Element with ID "umur-aset" not found.');
        }

        // Show button if aset_status is neither "Baik" nor "Non-maintenance"
// Show button only if aset_status is "Baik" or "Non-maintenance"
if (aset.aset_status === 'Baik' || aset.aset_status === 'Non-maintenance'|| aset.aset_status === 'baik') {
    document.getElementById('btn-maintenance').classList.remove('hidden');
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

