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
<form id="addAssetForm">
  <div class="space-y-12">
    <div class="border-b border-gray-900/10 pb-12">
      <div class="bg-gray-200 p-6 rounded-lg shadow-md">
        <h2 class="text-base font-semibold leading-7 text-gray-900">Formulir Tambah Aset</h2>
      </div>

      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2">
        <div class="sm:col-span-1">
          <label for="aset_name" class="block text-sm font-medium leading-6 text-gray-900">Nama Aset</label>
          <div class="mt-2">
            <input type="text" name="aset_name" id="aset_name" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 p-2" placeholder="masukkan nama aset" required>
          </div>
        </div>

        <div class="sm:col-span-1">
          <label for="aset_merk" class="block text-sm font-medium leading-6 text-gray-900">Merk Aset</label>
          <div class="mt-2">
            <input type="text" name="aset_merk" id="aset_merk" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 p-2" placeholder="masukkan merk aset" required>
          </div>
        </div>

        <div class="sm:col-span-1 flex items-center">
          <div class="w-24 h-24 border border-gray-300 rounded-md overflow-hidden mr-4">
            <img id="aset_image_preview" src="" alt="Preview Gambar" class="w-full h-full object-cover hidden">
          </div>
          <div class="flex-grow">
            <label for="aset_image" class="block text-sm font-medium leading-6 text-gray-900">Upload Gambar Aset</label>
            <div class="mt-2">
              <input type="file" name="aset_image" id="aset_image" accept="image/*" class="block w-full text-gray-900 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-yellow-600 file:text-white hover:file:bg-yellow-700">
            </div>
          </div>
        </div>

        <div class="sm:col-span-2"> 
          <label for="aset_spesifikasi" class="block text-sm font-medium leading-6 text-gray-900">Spesifikasi Aset</label>
          <div class="mt-2">
            <textarea name="aset_spesifikasi" id="aset_spesifikasi" rows="4" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 p-2" placeholder="masukkan spesifikasi aset" required></textarea>
          </div>
        </div>

        <div class="sm:col-span-1">
          <label for="aset_klasifikasi" class="block text-sm font-medium leading-6 text-gray-900">Type Klasifikasi</label>
          <div class="mt-2">
            <select name="aset_klasifikasi" id="aset_klasifikasi" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 p-2" required>
              <option value="" disabled selected>Pilih Klasifikasi</option>
            </select>
          </div>
        </div>

        <div class="sm:col-span-1">
          <label class="block text-sm font-medium leading-6 text-gray-900">Aset Kondisi Awal</label>
          <div class="mt-2">
            <div class="flex items-center">
              <input type="radio" id="kondisi_baru" name="aset_kondisi" value="Baru" class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500" required>
              <label for="kondisi_baru" class="ml-2 block text-sm text-gray-900">Baru</label>
            </div>
            <div class="flex items-center mt-2">
              <input type="radio" id="kondisi_bekas" name="aset_kondisi" value="Bekas" class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500" required>
              <label for="kondisi_bekas" class="ml-2 block text-sm text-gray-900">Bekas</label>
            </div>
          </div>
        </div>

        <div class="sm:col-span-1">
          <label for="aset_tgl_pembelian" class="block text-sm font-medium leading-6 text-gray-900">Tanggal Pembelian Aset</label>
          <div class="mt-2">
            <input type="date" name="aset_tgl_pembelian" id="aset_tgl_pembelian" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 p-2" placeholder="masukkan tanggal pembelian aset" required>
          </div>
        </div>

        <div class="sm:col-span-1">
          <label class="block text-sm font-medium leading-6 text-gray-900">Status Aset</label>
          <div class="mt-2">
            <div class="flex items-center">
              <input type="radio" id="status_baik" name="aset_status" value="Baik" class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500" required>
              <label for="status_baik" class="ml-2 block text-sm text-gray-900">Baik</label>
            </div>
            <div class="flex items-center mt-2">
              <input type="radio" id="status_buruk" name="aset_status" value="Buruk" class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500" required>
              <label for="status_buruk" class="ml-2 block text-sm text-gray-900">Buruk</label>
            </div>
          </div>
        </div>

        <div class="sm:col-span-1">
          <label for="klasifikasi_nilai_perolehan" class="block text-sm font-medium leading-6 text-gray-900">Klasifikasi Nilai Perolehan</label>
          <div class="mt-2">
            <input type="number" name="klasifikasi_nilai_perolehan" id="klasifikasi_nilai_perolehan" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 p-2" placeholder="masukkan nilai perolehan" required>
          </div>
        </div>

        <div class="sm:col-span-1">
          <label for="outlet_id" class="block text-sm font-medium leading-6 text-gray-900">Area Kerja</label>
          <div class="mt-2">
            <select name="outlet_id" id="outlet_id" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 p-2" required>
              <option value="" disabled selected>Pilih Area Kerja</option>
              <option value="Non-Outlet" >Non Outlet</option>
            </select>
          </div>
        </div>

        <div class="sm:col-span-1">
          <label for="aset_pic" class="block text-sm font-medium leading-6 text-gray-900">PIC</label>
          <div class="mt-2">
            <select name="aset_pic" id="aset_pic" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 p-2" required>
              <option value="" disabled selected>Pilih PIC</option>
              <option value="IT">IT</option>
              <option value="GA Pusat">GA Pusat</option>
              <option value="GA Area">GA Area</option>
              <option value="Keuangan">Keuangan</option>
              <option value="Outlet">Outlet</option>
              <!-- <option value="MA">MA</option> -->
            </select>
          </div>
        </div>

        <div class="sm:col-span-1">
          <label for="penanggungjawab" class="block text-sm font-medium leading-6 text-gray-900">Penanggung Jawab</label>
          <div class="mt-2">
            <select name="penanggungjawab" id="penanggungjawab" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 p-2" required>
              <option value="" disabled selected>Pilih Penanggung Jawab</option>
              <option value="DM">DM</option>
              <option value="Kasir">Kasir</option>
              <option value="IT">IT</option>
              <option value="GA Pusat">GA Pusat</option>
              <option value="GA Area">GA Area</option>
            </select>
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


    <script>


async function fetchOutlets() {
  const token = localStorage.getItem('token'); 
  
  if (!token) {
    console.error('Token tidak tersedia. Pastikan Anda sudah login.');
    return;
  }

  try {
    const response = await fetch('http://127.0.0.1:8000/api/outlets/getAll', {
      method: 'GET',
      headers: {
        'Authorization': `Bearer ${token}`, 
        'Accept': 'application/json'
      }
    });

    if (!response.ok) {
      throw new Error('Gagal mengambil data outlet. Cek token atau izin akses.');
    }

    const data = await response.json();
    
    const outlets = Array.isArray(data) ? data : data.data;

    if (!Array.isArray(outlets)) {
      console.error('Data outlet tidak valid');
      return;
    }

    const outletSelect = document.getElementById('outlet_id');
    outlets.forEach(outlet => {
      const option = document.createElement('option');
      option.value = outlet.outlet_id; 
      option.textContent = outlet.outlet_name;
      outletSelect.appendChild(option);
    });
  } catch (error) {
    console.error('Error:', error);
  }
}

document.addEventListener('DOMContentLoaded', fetchOutlets);
// async function fetchpic() {
//   const token = localStorage.getItem('token'); 
  
//   if (!token) {
//     console.error('Token tidak tersedia. Pastikan Anda sudah login.');
//     return;
//   }

//   try {
//     const response = await fetch('http://127.0.0.1:8000/api/users/get', {
//       method: 'GET',
//       headers: {
//         'Authorization': `Bearer ${token}`, 
//         'Accept': 'application/json'
//       }
//     });

//     if (!response.ok) {
//       throw new Error('Gagal mengambil data user. Cek token atau izin akses.');
//     }

//     const data = await response.json();
    
//     const pics = Array.isArray(data) ? data : data.data;

//     if (!Array.isArray(pics)) {
//       console.error('Data user tidak valid');
//       return;
//     }

//     const picSelect = document.getElementById('aset_pic'); 
//     pics.forEach(user => {
//       const option = document.createElement('option');
//       option.value = user.user_id; 
//       option.textContent = user.user_level; 
//       picSelect.appendChild(option);
//     });
//   } catch (error) {
//     console.error('Error:', error);
//   }
// }

// document.addEventListener('DOMContentLoaded', fetchpic);

async function fetchKlasifikasi() {
  const token = localStorage.getItem('token');

  if (!token) {
    console.error('Token tidak tersedia. Pastikan Anda sudah login.');
    return;
  }

  try {
    const response = await fetch('http://127.0.0.1:8000/api/klasifikasi/getAll', {
      method: 'GET',
      headers: {
        'Authorization': `Bearer ${token}`, 
        'Accept': 'application/json'
      }
    });

    if (!response.ok) {
      throw new Error('Gagal mengambil data klasifikasi. Cek token atau izin akses.');
    }

    const data = await response.json();

    const klasifikasiList = Array.isArray(data) ? data : data.data;

    if (!Array.isArray(klasifikasiList)) {
      console.error('Data klasifikasi tidak valid');
      return;
    }

    const klasifikasiSelect = document.getElementById('aset_klasifikasi');
    klasifikasiList.forEach(klasifikasi => {
      const option = document.createElement('option');
      option.value = klasifikasi.klasifikasi_id;
      option.textContent = klasifikasi.klasifikasi_nama;
      klasifikasiSelect.appendChild(option);
    });
  } catch (error) {
    console.error('Error:', error);
  }
}

document.getElementById('aset_image').addEventListener('change', function (event) {
        const file = event.target.files[0];
        const preview = document.getElementById('aset_image_preview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result; 
                preview.classList.remove('hidden'); 
            }
            reader.readAsDataURL(file); 
        } else {
            preview.classList.add('hidden'); 
        }
    });


document.addEventListener('DOMContentLoaded', fetchKlasifikasi);

document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('addAssetForm');

  if (form) {
    form.addEventListener('submit', async function(event) {
      event.preventDefault(); 

      // Membuat FormData baru untuk menampung data
      const dataToSend = new FormData();

      // Menambahkan field non-file ke FormData
      dataToSend.append('aset_name', form.aset_name.value);
      dataToSend.append('aset_merk', form.aset_merk.value);
      dataToSend.append('aset_spesifikasi', form.aset_spesifikasi.value);
      dataToSend.append('aset_klasifikasi', form.aset_klasifikasi.value);
      dataToSend.append('aset_kondisi', form.aset_kondisi.value);
      dataToSend.append('aset_tgl_pembelian', form.aset_tgl_pembelian.value);
      dataToSend.append('aset_status', form.aset_status.value);
      dataToSend.append('klasifikasi_nilai_perolehan', form.klasifikasi_nilai_perolehan.value);
      dataToSend.append('outlet_id', form.outlet_id.value);
      dataToSend.append('aset_pic', form.aset_pic.value);
      dataToSend.append('penanggungjawab', form.penanggungjawab.value);

      // Menambahkan file hanya jika dipilih
      if (form.aset_image.files.length > 0) {
        dataToSend.append('aset_image', form.aset_image.files[0]);
      }

      const token = localStorage.getItem('token'); 

      try {
        const response = await fetch('http://127.0.0.1:8000/api/asets/create', {
          method: 'POST',
          headers: {
            'Authorization': `Bearer ${token}`,
          },
          body: dataToSend, 
        });

        if (response.ok) {
          const jsonResponse = await response.json();
          alert('Aset berhasil ditambahkan!'); 
          console.log(jsonResponse); 
          form.reset();

          window.location.href = '/masterAset'; 
        } else {
          const errorResponse = await response.json();
          alert('Gagal menambahkan aset: ' + errorResponse.message); 
        }
      } catch (error) {
        console.error('Terjadi kesalahan:', error);
        alert('Terjadi kesalahan saat menambahkan aset.');
      }
    });
  }
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

    </script>
</body>
</html>