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
   @include('components.sidenav', ['isOpen' => true])
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

