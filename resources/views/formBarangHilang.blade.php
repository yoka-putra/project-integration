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

<form id="pengajuanServiceGantiForm">
  <div class="space-y-12">
    <div class="border-b border-gray-900/10 pb-12">
      <div class="bg-gray-200 p-6 rounded-lg shadow-md">
        <h2 class="text-base font-semibold leading-7 text-gray-900">Formulir Laporan Barang Hilang</h2>
      </div>

      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2">
        <div class="sm:col-span-1">
          <label for="permintaan_aset" class="block text-sm font-medium leading-6 text-gray-900">Nama Aset Diajukan</label>
          <div class="mt-2">
            <input type="text" name="permintaan_aset" id="permintaan_aset" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 p-2 bg-gray-200" placeholder="masukkan nama aset" required readonly>
          </div>
        </div>

        <div class="sm:col-span-1">
          <label for="permintaan_nama_pengaju" class="block text-sm font-medium leading-6 text-gray-900">Nama Pengaju</label>
          <div class="mt-2">
            <input type="text" name="permintaan_nama_pengaju" id="permintaan_nama_pengaju" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 p-2 bg-gray-200" placeholder="masukkan nama pengaju/penanggung jawab" required readonly>
          </div>
        </div>

        <div class="sm:col-span-1">
          <label for="permintaan_nama_outlet" class="block text-sm font-medium leading-6 text-gray-900">Nama Outlet Pengaju</label>
          <div class="mt-2">
            <input type="text" name="permintaan_nama_outlet" id="permintaan_nama_outlet" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 p-2 bg-gray-200" placeholder="masukkan nama outlet pengajuan aset" required readonly>
          </div>
        </div>

        <div class="sm:col-span-1">
          <label for="permintaan_tgl_pengajuan" class="block text-sm font-medium leading-6 text-gray-900">Tanggal Pengajuan Aset</label>
          <div class="mt-2">
            <input type="date" name="permintaan_tgl_pengajuan" id="permintaan_tgl_pengajuan" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 p-2 bg-gray-200" required readonly>
          </div>
        </div>

        <div class="sm:col-span-1"> 
  <label for="permintaan_kategori" class="block text-sm font-medium leading-6 text-gray-900">Kategori Pengajuan</label>
  <div class="mt-2">
    <input type="text" name="permintaan_kategori" id="permintaan_kategori" value="Laporan Barang Hilang" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 p-2 bg-gray-200" readonly>
  </div>
</div>

<div class="sm:col-span-1">
          <label for="permintaan_lampiran" class="block text-sm font-medium leading-6 text-gray-900">Lampiran (Bukti Barang Hilang)</label>
          <div class="mt-2">
            <input type="file" name="permintaan_lampiran" id="permintaan_lampiran" class="block w-full text-gray-900 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-yellow-600 file:text-white hover:file:bg-yellow-700" accept=".jpg,.jpeg,.png,.pdf">
          </div>
        </div>

        <div class="sm:col-span-2"> 
          <label for="permintaan_tujuan" class="block text-sm font-medium leading-6 text-gray-900">Tujuan Ajuan</label>
          <div class="mt-2">
            <textarea name="permintaan_tujuan" id="permintaan_tujuan" rows="4" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 p-2 " placeholder="masukkan tujuan atau keterangan barang hilang" required></textarea>
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

document.addEventListener("DOMContentLoaded", function () {
  const currentUrl = window.location.href;
  const assetId = currentUrl.substring(currentUrl.lastIndexOf('/') + 1);
  const token = localStorage.getItem('token');
  
  const url = `http://127.0.0.1:8000/api/asets/get/${assetId}`;
  
  fetch(url, {
    method: 'GET',
    headers: {
      'Authorization': `Bearer ${token}`,
      'Content-Type': 'application/json'
    }
  })
  .then(response => response.json())
  .then(data => {
    // Menyisipkan data yang diterima ke dalam form
    document.getElementById('permintaan_aset').value = data.aset.aset_name || '';
    document.getElementById('permintaan_nama_outlet').value = data.aset.outlet.outlet_name || '';
    // document.getElementById('permintaan_nama_area').value = data.aset_area || '';
    document.getElementById('permintaan_tgl_pengajuan').value = new Date().toISOString().split('T')[0]; // Set tanggal hari ini
  })
  .catch(error => {
    console.error('Error fetching asset data:', error);
  });

  const namaPengaju = localStorage.getItem('user_full_name');
  if (namaPengaju) {
    document.getElementById('permintaan_nama_pengaju').value = namaPengaju;
  }

  // Mengatur tanggal hari ini
  const today = new Date().toISOString().split('T')[0];  // Format: YYYY-MM-DD
  document.getElementById('permintaan_tgl_pengajuan').value = today;
  
  document.getElementById('pengajuanServiceGantiForm').addEventListener('submit', function(event) {
    event.preventDefault();  

    // Mengumpulkan data form
    const formData = new FormData(event.target);
    const data = {
      permintaan_aset: formData.get('permintaan_aset'),
      permintaan_nama_pengaju: formData.get('permintaan_nama_pengaju'),
      permintaan_nama_outlet: formData.get('permintaan_nama_outlet'),
      permintaan_tgl_pengajuan: formData.get('permintaan_tgl_pengajuan'),
      permintaan_kategori: formData.get('permintaan_kategori'),
      permintaan_status: formData.get('permintaan_status'), 
      permintaan_tujuan: formData.get('permintaan_tujuan'),
      permintaan_kuantitas: formData.get('permintaan_kuantitas'), 
      
    };

    fetch('http://127.0.0.1:8000/api/request/create', {
        method: 'POST',
        headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.json();
    })
    .then(result => {
        console.log('Request successfully submitted:', result);

       
        const selectedCategory = document.getElementById('permintaan_kategori').value;
        const updateUrl = `http://127.0.0.1:8000/api/asets/update/status/${assetId}`;
        const updateData = {
            aset_status: selectedCategory 
        };

        fetch(updateUrl, {
            method: 'PUT',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(updateData)
        })
        .then(updateResponse => {
            if (!updateResponse.ok) {
                throw new Error('Failed to update asset status: ' + updateResponse.statusText);
            }
            return updateResponse.json();
        })
        .then(updateResult => {
            console.log('Asset status updated:', updateResult);
            
            window.location.href = '/daftarAset'; 
        })
        .catch(error => {
            console.error('Error updating asset status:', error);
        });
    })
    .catch(error => {
        console.error('Error submitting request:', error);
    });
});
});

  const userLevel = localStorage.getItem('user_level');

  const masterMenu = document.getElementById('masterMenu');

if (userLevel === 'IT' || userLevel === 'GA Pusat') {
    masterMenu.classList.remove('hidden');
} else {
    masterMenu.classList.add('hidden');
}

document.querySelectorAll('.logout').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault(); 
        e.stopPropagation(); 
        
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
    </script>
</body>
</html>