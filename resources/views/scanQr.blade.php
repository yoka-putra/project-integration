<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Reader</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.min.js"></script>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
        }
        #video {
            width: 100%;
            max-width: 600px;
            border: 2px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
       
    </style>
</head>

<body class="bg-gray-100 h-screen text-black">
    <div class="flex w-screen h-screen">
   @include('components.sidenav', ['isOpen' => true])

        <!-- Centered QR Code Reader section -->
        <h1 class="text-2xl font-semibold mb-4">QR Code Reader</h1>
<video id="video" autoplay class="w-full max-w-md rounded-lg shadow-lg"></video>

<div class="mt-4 bg-yellow-100 text-yellow-800 p-4 rounded-lg shadow-lg">
    <p class="font-semibold">Petunjuk Penggunaan:</p>
    <ul class="list-disc list-inside">
        <li>Pastikan QR Code berada dalam bingkai kamera.</li>
        <li>Jaga jarak agar QR Code tidak terlalu dekat atau terlalu jauh.</li>
        <li>Pastikan pencahayaan cukup untuk hasil yang lebih baik.</li>
    </ul>
</div>

    </div>
</div>


    <script>
  const video = document.getElementById('video');

// Request access camera
navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } })
    .then((stream) => {
        video.srcObject = stream;
        video.setAttribute("playsinline", true); // for iOS Safari
        scanQRCode();
    })
    .catch((error) => {
        console.error("Error accessing the camera: ", error);
        alert("Error accessing the camera. Please check permissions.");
    });

function scanQRCode() {
    const canvas = document.createElement("canvas");
    const context = canvas.getContext("2d");

    function scan() {
        if (video.readyState === video.HAVE_ENOUGH_DATA) {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            const imgData = context.getImageData(0, 0, canvas.width, canvas.height);
            const code = jsQR(imgData.data, imgData.width, imgData.height);

            if (code) {
                console.log("QR Code detected:", code.data);
                window.location.href = `/viewAset/${code.data}`;
                return;
            }
        }
        requestAnimationFrame(scan);
    }

    scan();
}

    </script>
</body>
</html>
