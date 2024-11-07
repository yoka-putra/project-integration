<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Parameter Kesehatan Asset</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .sidebar-open {
      max-width: 800px;
      transform: translateX(0);
      visibility: visible;
    }
    .sidebar-closed {
      max-width: 0;
      transform: translateX(-100%);
      visibility: hidden;
    }
    .transition-all {
      transition: all 0.3s ease;
    }

    .modal {
      display: none; /* Hidden by default */
      position: fixed; /* Stay in place */
      z-index: 50; /* Sit on top */
      left: 0;
      top: 0;
      width: 100%; /* Full width */
      height: 100%; /* Full height */
      overflow: auto; /* Enable scroll if needed */
      background-color: rgba(0, 0, 0, 0.5); /* Black w/ opacity */
    }
    .modal-content {
      background-color: #fff;
      margin: 15% auto; /* 15% from the top and centered */
      padding: 20px;
      border: 1px solid #888;
      width: 50%; /* Could be more or less, depending on screen size */
    }
  </style>
</head>
<body class="bg-gray-100 h-screen flex text-black">

  <!-- Sidebar -->
  <div id="sidebar" class="h-screen bg-orange-500 transition-all sidebar-closed">
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
        <a  href="{{ route('scanQr') }}" class="flex items-center text-white p-2 rounded-lg hover:bg-orange-400">
          <span class="mr-2"><i class="bi bi-camera"></i></span>
          <span>Scan Qr Code</span>
        </a>
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

  <!-- Main Content -->
  <div class="grow p-6" id="content">
    <!-- Content Header -->
    <div class="bg-white rounded-xl p-6 flex items-center justify-between mb-4">
      <div class="flex items-center">
        <ion-icon id="menuToggleBtn" name="menu" class="text-3xl cursor-pointer mr-2"></ion-icon>
        <h1 class="text-xl font-semibold">Parameter Kesehatan Asset</h1>
      </div>
      <div class="flex items-center">
        <i class="bi bi-person-fill mr-2"></i>
        <span id="user_name" class="text-xl font-semibold"></span>
      </div>
    </div>

    <!-- Parameter Kesehatan Section -->
    <div class="space-y-12">
      <div class="border-b border-gray-900/10 pb-12">
        <!-- <h1 class="text-lg font-semibold mb-4">Parameter Kesehatan Asset</h1> -->
        
        <div class="bg-gray-200 p-4 rounded-md">
          <div class="mb-4">
            <h2 class="text-lg font-semibold">Parameter Kesehatan:</h2>
            <p id="parameterKesehatan" class="mt-2 text-gray-700 whitespace-pre-line">
            </p>
          </div>
        </div>

        <div class="flex justify-end gap-4 mt-4">
          <button class="bg-yellow-500 text-white py-1 px-4 rounded-md" onclick="openModal()">Kondisi Baik</button>
          <button class="bg-red-600 text-white py-1 px-4 rounded-md" onclick="openModalKKB()">Kondisi Kurang Baik</button>
        </div>

        <div id="confirmationModal" class="modal">
          <div class="modal-content">
            <h2 class="text-lg font-semibold">Apakah Anda yakin?</h2>
            <p class="mt-2">Apakah Anda ingin menandai aset ini dalam kondisi baik bulan ini?</p>
            <div class="flex justify-end gap-4 mt-4">
              <button class="bg-yellow-500 text-white py-1 px-4 rounded-md" onclick="confirmYes(assetId)">Ya</button>
              <button class="bg-red-600 text-white py-1 px-4 rounded-md" onclick="closeModal()">Tidak</button>
            </div>
          </div>
        </div>


        <div id="confirmationModalKKB" class="modal">
          <div class="modal-content">
            <h2 class="text-lg font-semibold">Apakah Anda kondisi aset kurang baik?</h2>
            <p class="mt-2">Setelah menandai aset ini kurang baik anda harus mengisi alasan mengabaikan kondisi aset!</p>
            <div class="flex justify-end gap-4 mt-4">
            <button class="bg-yellow-500 text-white py-1 px-4 rounded-md" onclick="formPermintaanServiceGanti(assetId)">Ajuan Service/Ganti</button>
              <button class="bg-red-600 text-white py-1 px-4 rounded-md" onclick="confirmNo(assetId)">Batal</button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>  
  <script>
function formPermintaanServiceGanti(asetId) {
    window.location.href = `/formPermintaanServiceGanti/${asetId}`;
}
const currentUrl = window.location.href;
const assetId = currentUrl.substring(currentUrl.lastIndexOf('/') + 1);
const token = localStorage.getItem('token');

        function openModal() {
      document.getElementById('confirmationModal').style.display = 'block';
    }

    // Function to close the modal
    function closeModal() {
      document.getElementById('confirmationModal').style.display = 'none';
    }

    // Function to handle confirmation (Ya)
    function confirmYes(assetId) {
        const payload = {
            aset_status: 'Baik' 
        };

        fetch(`http://127.0.0.1:8000/api/asets/update/status/${assetId}`, {
            method: 'PUT',
            headers: {
                'Authorization': `Bearer ${token}`, 
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(payload)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            alert('Aset telah ditandai dalam kondisi baik.');
            closeModal();
            console.log(data);
            window.location.href = '/scanQr';
        })
        .catch(error => {
            console.error('There was a problem with your fetch operation:', error);
        });
    }

    function openModalKKB() {
      document.getElementById('confirmationModalKKB').style.display = 'block';
    }

    function closeModalKKB() {
      document.getElementById('confirmationModalKKB').style.display = 'none';
    }

    function confirmNo() {
      closeModalKKB(); 
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

    async function fetchAssetData(assetId) {
      try {
        const response = await fetch(`http://127.0.0.1:8000/api/asets/get/${assetId}`, {
          method: 'GET',
          headers: {
            'Authorization': `Bearer ${token}`, 
            'Content-Type': 'application/json'
          }
        });

        if (!response.ok) {
          throw new Error(`Error: ${response.status}`);
        }

        const data = await response.json();

        const parameterKesehatan = data.aset.klasifikasi.parameter_kesehatan_aset;

        document.getElementById('parameterKesehatan').textContent = parameterKesehatan;
      } catch (error) {
        console.error('Error fetching asset data:', error);
        document.getElementById('parameterKesehatan').textContent = 'Failed to load asset data.';
      }
    }

    fetchAssetData(assetId);
  </script>

</body>
</html>
