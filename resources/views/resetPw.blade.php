<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Aset</title>
  
</head>

<body class="bg-gray-100 h-screen text-black">
    <div class="flex w-screen h-screen">
   @include('components.sidenav', ['isOpen' => true])

    <div class="flex-1">
</div>

<form id="resetPwForm">
  <div class="space-y-12">
    <div class="border-b border-gray-900/10 pb-12">
    <div class="bg-gray-200 p-6 rounded-lg shadow-md">
        <h2 class="text-base font-semibold leading-7 text-gray-900">Formulir reset password</h2>
      </div>

      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2">
        <div class="sm:col-span-1">
          <label for="new_password" class="block text-sm font-medium leading-6 text-gray-900">Password baru</label>
          <div class="mt-2">
            <input type="password" name="new_password" id="new_password" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 p-2" placeholder="masukkan password baru">
          </div>
        </div>

        <div class="sm:col-span-1">
          <label for="new_password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">Konfirmasi password</label>
          <div class="mt-2">
            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 p-2" placeholder="masukkan konfirmasi password">
          </div>
        </div>

      </div>
    </div>

    <div class="flex items-center justify-end gap-x-3">
  <button type="submit" class="bg-yellow-500 text-white p-2 rounded">Simpan</button>
</div>

  </div>
</form>

    </div>
</div>
        <div class="overflow-x-auto">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <script>
   
document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('resetPwForm');
  const user_id = window.location.pathname.split('/').pop(); 

  if (form) {
    form.addEventListener('submit', async function(event) {
      event.preventDefault(); 

      const formData = new FormData(form);
      const token = localStorage.getItem('token'); 

      try {
        const response = await fetch(`http://127.0.0.1:8000/api/users/reset-password/${user_id}`, { 
          method: 'POST',
          headers: {
            'Authorization': `Bearer ${token}`,
          },
          body: formData, 
        });
        //post form data ke endpoint

        if (response.ok) {
          const jsonResponse = await response.json();
          alert('Password berhasil diubah'); 
          console.log(jsonResponse); 
          form.reset();

          window.location.href = '/masterUser'; 
        } else {
          const errorResponse = await response.json();
          alert('Gagal reset: ' + errorResponse.message); 
        }
      } catch (error) {
        console.error('Terjadi kesalahan:', error);
        alert('Terjadi kesalahan saat reset.');
      }
    });
  }
});


    </script>
</body>
</html>