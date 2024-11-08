<!-- resources/views/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen text-black">
    <div class="flex w-screen h-screen">
        <!-- Include Sidebar Component -->
        @include('components.sidenav', ['isOpen' => true])
        

        <!-- Main Content -->
        <!-- <div class="grow p-6" id="content">
            <h1 class="text-xl font-semibold">Selamat Datang di Dashboard</h1>
        </div> -->
    </div>
</body>
</html>
