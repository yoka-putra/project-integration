<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Generator</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f9f9f9;
        }
        #qrcode {
            margin: 20px;
        }
    </style>
</head>

<body class="bg-gray-100 h-screen text-black">
    <div class="flex w-screen h-screen">
   @include('components.sidenav', ['isOpen' => true])


        <!-- Main Container with Responsive Grid -->
        <div class="flex justify-center items-center">
            <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-3xl">
                <h1 class="text-xl font-bold mb-4 text-center">QR Code for Asset</h1>

                <!-- Grid Layout for QR code and Asset Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <!-- Asset Details Section -->
                    <div id="assetDetails" class="bg-gray-200 p-4 rounded w-full">
                        <p><strong>Nama Aset:</strong> <span id="assetName"></span></p>
                        <p><strong>Merk:</strong> <span id="Merk"></span></p>
                        <p><strong>Outlet:</strong> <span id="outlet"></span></p>
                        <div class="mt-4">
                            <img id="assetImage" src="" alt="Asset Image" class="rounded w-full h-50 object-cover">
                        </div>      
                    </div>

                    <!-- QR Code Section -->
                    <div id="qrcode" class="flex justify-center items-center rounded w-full" style="height: 256px;"></div>
                </div>

                <!-- Download Button -->
                <div class="flex justify-end mt-4">
                    <button id="downloadBtn" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-red-500">
                        Download QR Code
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


    <script>
    document.getElementById('downloadBtn').addEventListener('click', function() {
    const qrCodeElement = qrCodeContainer.querySelector('img');
    if (qrCodeElement) {
        const link = document.createElement('a');
        link.href = qrCodeElement.src;
        link.download = `qr_${asetId}.png`; 
        document.body.appendChild(link);
        link.click(); 
        document.body.removeChild(link);
    } else {
        alert('QR Code is not available for download.');
    }
});

        const path = window.location.pathname;
        const asetId = path.split('/').pop();

        const qrCodeContainer = document.getElementById("qrcode");
        const qrCode = new QRCode(qrCodeContainer, {
            text: asetId, 
            width: 256,
            height: 256,
        });

        fetch(`http://127.0.0.1:8000/api/asets/get/${asetId}`, {
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data) {
                document.getElementById('assetName').innerText = data.aset.aset_name || 'N/A';
                document.getElementById('Merk').innerText = data.aset.aset_merk || 'N/A';
                document.getElementById('outlet').innerText = data.aset.outlet.outlet_name || 'N/A';
                if (data.aset.aset_image) {
                document.getElementById('assetImage').src = `http://127.0.0.1:8000/storage/${data.aset.aset_image}`;
            } else {
            document.getElementById('assetImage').src = '';
            document.getElementById('assetImage').alt = 'Image not available';
            }
            }
        })
        .catch(error => console.error('Error fetching asset data:', error));

    </script>
</body>
</html>
