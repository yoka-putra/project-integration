<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Parameter Kesehatan Asset</title>
 
  <style>
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

<body class="bg-gray-100 h-screen text-black">
    <div class="flex w-screen h-screen">
   @include('components.sidenav', ['isOpen' => true])

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
