<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .sidebar-open {
            max-width: 800px; /* Lebar sidebar saat dibuka */
            transform: translateX(0); /* Muncul di layar */
            visibility: visible; /* Sidebar terlihat */
        }
        .sidebar-closed {
            max-width: 0; /* Sidebar tersembunyi */
            transform: translateX(-100%); /* Geser keluar layar */
            visibility: hidden; /* Tidak terlihat */
        }
        .transition-all {
            transition: all 0.3s ease;
        }
    </style>
</head>

<body class="bg-gray-100 h-screen text-black">
    <div class="flex w-screen h-screen">
        <!-- Sidebar -->
        <div id="sidebar" class="h-screen bg-orange-500 transition-all sidebar-closed">
            <div class="p-4">
                <h1 class="text-white text-2xl font-bold">SSB</h1>
                <h2 class="text-white text-lg mt-2">Spesial Soto Boyolali</h2>
               <h2 class="text-white text-lg">Hj. Hesti Widodo</h2>
                <hr class="border-white my-4">
                <ul class="mt-4 text-white">
                    <form class="inline">
                    <form class="inline">                         <a href="{{ route('daftarAset') }}" class="flex items-center text-white p-2 rounded-lg hover:bg-orange-400">             <span class="mr-2"><i class="bi bi-list-task"></i></span>             <span>Daftar Aset</span>         </a>                     </form>                     <form class="inline">     <a class="flex items-center text-white p-2 rounded-lg hover:bg-orange-400">         <span class="mr-2"><i class="bi bi-camera"></i></span>          <span>Scan Qr Code</span>     </a> </form>
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

    <button type="button" class="flex items-center text-white p-3 rounded-lg mb-2 logout">
    <span class="mr-2"><i class="bi bi-box-arrow-right"></i></span>
    <span>Logout</span>
</button>


                </ul>
            </div>
        </div>

        <!-- Content -->
  <div class="grow p-6" id="content">
          <div>
    <div class="bg-white rounded-xl p-6 flex items-center justify-between mb-4">
            <div class="flex items-center">
                <ion-icon id="menuToggleBtn" name="menu" class="text-3xl cursor-pointer mr-2"></ion-icon>
                   <h1 class="text-xl font-semibold">Asset Pos Manager</h1>
            </div>
            <div class="flex items-center">
                <i class="bi bi-person-fill mr-2"></i>
                <span id="user_name" class="text-xl font-semibold"></span>
            </div>
        </div>
    <div class="overflow-hidden bg-white shadow sm:rounded-lg mt-4">
    <div class="p-6 flex justify-between items-center">
    <div class="flex-1">
</div>

<form id="searchAset" class="flex items-center space-x-2">
    <input type="text" name="search" placeholder="Cari disini..." class="border border-gray-300 rounded-lg p-2">
</form>

    </div>
</div>
        <div class="overflow-x-auto">
        <table class="min-w-full">
    <thead>
        <tr class="bg-gray-100">
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">No.</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Aset</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Merk</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Kondisi</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">PIC</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Jadwal Maintenance</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Outlet</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200" id="asetTableBody">
    </tbody>
</table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <script>

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

function viewAset(asetId) {
    window.location.href = `/viewAset/${asetId}`;
}
function updateAset(asetId) {
    window.location.href = `/updateAset/${asetId}`;
}

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

    const searchInput = document.querySelector('input[name="search"]');
const tableBody = document.querySelector('#asetTableBody');

function getToken() {
    return localStorage.getItem('token');
}

async function fetchAsets() {
    const token = getToken();
    console.log('JWT Token:', token);

    try {
        const response = await fetch('http://127.0.0.1:8000/api/asets/get', {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json'
            }
        });

        if (!response.ok) {
            const errorText = await response.text(); 
            console.error(`Error fetching asets: ${response.status} - ${errorText}`);
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const asets = await response.json();
        console.log('Fetched asets:', asets);
        renderAset(asets);
    } catch (error) {
        console.error('Error fetching asets:', error);
    }
}

function renderAset(asets) {
    tableBody.innerHTML = ''; 
    asets.forEach((aset, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-center">${index + 1}</td>
            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 user-id text-center" style="display:none;">${aset.aset_id || 'N/A'}</td>
            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 user-full-name text-center">${aset.aset_name || 'N/A'}</td>
            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 user-name text-center">${aset.aset_merk || 'N/A'}</td>
            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 user-email text-center">${aset.aset_kondisi || 'N/A'}</td>
            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 user-level text-center">${aset.aset_pic || 'N/A'}</td>
            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 user-level text-center">${aset.aset_tgl_maintenance || 'N/A'}</td>
            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 user-level text-center">${aset.outlet ? aset.outlet.outlet_name : 'N/A'}</td>
            <td class="whitespace-nowrap px-4 py-2 text-center">
                <button class="bg-red-500 text-white p-2 rounded" onclick="viewAset(${aset.aset_id})">View</button>
            </td>
        `;
        tableBody.appendChild(row);
    });
}

function viewAset(asetId) {
    console.log(`View asset with ID: ${asetId}`);
}

function updateAset(asetId) {
    console.log(`Edit asset with ID: ${asetId}`);
}

document.addEventListener('DOMContentLoaded', () => {
    fetchAsets();
});
searchInput.addEventListener('input', async function () {
    const searchValue = searchInput.value;
    const token = getToken();

    if (searchValue.trim() === '') {
        fetchAsets();
    } else {
        try {
            const response = await fetch(`http://127.0.0.1:8000/api/asets/search?query=${searchValue}`, {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json'
                }
            });

            if (!response.ok) {
                const errorText = await response.text(); 
                console.error(`Error searching asets: ${response.status} - ${errorText}`);
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const asets = await response.json();
            console.log('Searched asets:', asets); 
            
            if (Array.isArray(asets.data)) {
                renderAset(asets.data); 
            } else {
                console.error('Expected asets.data to be an array but got:', asets.data);
                tableBody.innerHTML = '<tr><td colspan="8">No results found</td></tr>'; 
            }
        } catch (error) {
            console.error('Error searching aset:', error);
        }
    }
});

    fetchAsets();
    tableBody.addEventListener('click', (e) => {
    if (e.target.classList.contains('edit-button')) {
        const user_id = e.target.dataset.user_id;
        const user_full_name = e.target.dataset.user_full_name;
        const user_name = e.target.dataset.user_name;
        const user_email = e.target.dataset.user_email;
        const user_level = e.target.dataset.user_level;
        const user_outlet_id = e.target.dataset.user_outlet_id;

        document.getElementById('edit_user_id').value = user_id;
        document.getElementById('edit_user_full_name').value = user_full_name;
        document.getElementById('edit_user_email').value = user_email;
        document.getElementById('edit_user_level').value = user_level;
        document.getElementById('edit_user_name').value = user_name;
        document.getElementById('edit_user_outlet_id').value = user_outlet_id;
        document.getElementById('editUserModal').classList.remove('hidden');
    }
});

function closeEditModal() {
    document.getElementById('editUserModal').classList.add('hidden');
}

document.getElementById('closeModalEdit').addEventListener('click', closeEditModal);

    document.getElementById('editUserForm').addEventListener('submit', async (e) => {
        e.preventDefault();

        const token = localStorage.getItem('token');
    if (!token) {
        alert('Token tidak ditemukan. Harap login kembali.');
        return;
    }
        const user_id = document.getElementById('edit_user_id').value;
        const user_full_name = document.getElementById('edit_user_full_name').value;
        const user_email = document.getElementById('edit_user_email').value;
        const user_level = document.getElementById('edit_user_level').value;
        const user_name = document.getElementById('edit_user_name').value;
        const user_outlet_id = document.getElementById('edit_user_outlet_id').value;

        try {
            const response = await fetch(`http://127.0.0.1:8000/api/users/edit/${user_id}`, {
                method: 'PUT',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    user_full_name: user_full_name,
                    user_email: user_email,
                    user_level: user_level,
                    user_outlet_id: user_outlet_id,
                    user_name: user_name,
                })
            });
            if (!response.ok) {
    const errorData = await response.json();
    console.error('Error updating user:', errorData);
    alert('Gagal memperbarui pengguna: ' + errorData.message);
}
            if (response.ok) {
                await fetchUsers();
                closeEditModal();
            } else {
                console.error('Error updating user');
                alert('Gagal memperbarui pengguna.');
            }
        } catch (error) {
            console.error('Error updating user:', error);
        }
    });

function openModal() {
    document.getElementById('addUserModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('addUserModal').classList.add('hidden');
}

document.getElementById('closeModalButton').addEventListener('click', closeModal);

document.getElementById('addUserForm').addEventListener('submit', async function (event) {
    event.preventDefault();

    const password = document.getElementById('user_password').value;
    const passwordConfirmation = document.getElementById('password_confirmation').value;

    if (password !== passwordConfirmation) {
        alert('Password dan Konfirmasi Password tidak sama.');
        return; 
    }

    const formData = new FormData(this);
    const token = getToken(); 

    try {
        const response = await fetch('http://127.0.0.1:8000/api/register', {
            method: 'POST',
            body: formData,
            headers: {
                'Authorization': `Bearer ${token}`, 
                'X-Requested-With': 'XMLHttpRequest'
            },
        });
        const data = await response.json();

        if (data.success) {
            alert(data.message);
            closeModal(); 
            fetchUsers();
        } else {
            alert(data.message);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menambahkan user.');
    }
});

document.getElementById('addUserBtn').addEventListener('click', openModal);
});


    </script>
</body>
</html>