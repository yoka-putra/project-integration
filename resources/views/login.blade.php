<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .footer-text {
            position: absolute;
            bottom: 20px; /* Jarak dari bawah */
            right: 20px; /* Jarak dari kanan */
            color: white; /* Warna font */
            padding: 10px; /* Padding untuk memberikan jarak di dalam elemen */
            border-radius: 5px; /* Sudut membulat */
            font-weight: bold; /* Bold text */
            display: flex; /* Menggunakan flexbox */
            flex-direction: column; /* Susun kolom */
            align-items: flex-end; /* Rata kanan */
            text-align: right; /* Rata kanan untuk teks */
        }

        .ssb {
            font-size: 2rem; /* Ukuran font untuk SSB */
        }

        .footer-text div {
            margin-top: 2px; /* Jarak antar baris */
        }
    </style>
</head>
<body class="flex justify-center items-center h-screen" style="background-color: #FF8A00;">
    <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-lg bg-white rounded-lg shadow-lg p-6 sm:p-8"> 
            <h1 class="text-center text-2xl font-bold text-gray-600 sm:text-3xl">Asset Pos Manager</h1>
            <p class="mx-auto mt-4 max-w-md text-center text-gray-500">
                Kelola aset dengan lebih baik, pantau kinerja, dan maksimalkan nilai aset perusahaan
            </p>

            <!-- Notifikasi -->
            <div id="alert" class="rounded-xl border border-gray-100 bg-white p-4 hidden">
              <div class="flex items-start gap-4">
                <span class="text-green-600">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="size-6"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                  </svg>
                </span>

                <div class="flex-1">
                  <strong class="block font-medium text-gray-900">Login successful</strong>
                  <p class="mt-1 text-sm text-gray-700">You have successfully logged in.</p>
                </div>

                <button class="text-gray-500 transition hover:text-gray-600" id="dismiss-alert">
                  <span class="sr-only">Dismiss popup</span>
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="size-6"
                  >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                </button>
              </div>
            </div>

            <!-- Form Login -->
            <form id="LoginForm" class="mb-0 mt-6 space-y-4 rounded-lg p-4 shadow-lg sm:p-6 lg:p-8">
                <div>
                    <label for="user_name" class="sr-only">Username</label>
                    <div class="relative">
                        <input
                            type="text"
                            id="user_name"
                            name="user_name"
                            required
                            class="w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm focus:outline-none focus:ring focus:border-blue-500"
                            placeholder="Masukkan username"
                        />
                    </div>
                </div>

                <div>
                    <label for="user_password" class="sr-only">Password</label>
                    <div class="relative">
                        <input
                            type="password"
                            id="user_password"
                            name="user_password"
                            required
                            class="w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm focus:outline-none focus:ring focus:border-blue-500"
                            placeholder="Masukkan password" 
                        />
                    </div>
                </div>

                <button
                    type="submit"
                    class="block w-full rounded-lg bg-red-600 px-5 py-3 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring focus:ring-red-500"
                >
                    Login
                </button>
            </form>
        </div>
    </div>
    <div class="footer-text">
        <div class="ssb">SSB</div>
        <div>Spesial Soto Boyolali</div>
        <div>Hj. Hesti Widodo</div>
    </div>

    <script>
        document.getElementById('LoginForm').addEventListener('submit', function(event) {
            event.preventDefault();
            
            const userName = document.getElementById('user_name').value;
            const userPassword = document.getElementById('user_password').value;

            fetch('http://127.0.0.1:8000/api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    user_name: userName,
                    user_password: userPassword
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Login failed');
                }
                return response.json();
            })
            .then(data => {
                // Simpan token ke localStorage jika login berhasil
                localStorage.setItem('token', data.token);
                localStorage.setItem('user_name', data.user.user_name);
                localStorage.setItem('user_level', data.user.user_level);
                const alertDiv = document.getElementById('alert');
                alertDiv.classList.remove('hidden');
                setTimeout(() => {
                    window.location.href = '/daftarAset';
                }, 2000);
            })
            .catch(error => {
                const alertDiv = document.getElementById('alert');
                alertDiv.innerText = error.message;
                alertDiv.classList.remove('hidden');
            });
        });
        document.getElementById('dismiss-alert').addEventListener('click', function() {
            const alertDiv = document.getElementById('alert');
            alertDiv.classList.add('hidden');
        });
    </script>

</body>
</html>
