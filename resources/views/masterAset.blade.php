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

    <div class="overflow-hidden bg-white shadow sm:rounded-lg mt-4">
    <div class="p-6 flex justify-between items-center">
    <div class="flex-1">
    <a href="{{ route('addAset') }}" class="bg-yellow-500 text-white p-2 rounded ml-4 flex items-center w-40">
        <i class="fas fa-plus mr-2"></i> 
        Tambah Data
    </a>

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
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            No.
            <a href="#" id="sortAsc" class="text-gray-500 hover:text-gray-700" title="Urutkan Ascending">
                ↑
            </a>
            <a href="#" id="sortDesc" class="text-gray-500 hover:text-gray-700" title="Urutkan Descending">
                ↓
            </a>
        </th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Aset</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Klasifikasi</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Penanggung Jawab</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Area Kerja</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">PIC</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Jadwal Maintenance</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Kondisi</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200" id="asetTableBody">
    </tbody>
</table>

<!-- Pagination Component -->
<div class="flex justify-end items-center fixed bottom-4 right-4">
  <div id="pagination" class="inline-flex items-center justify-center rounded bg-blue-600 py-1 text-white">
    <a href="#" id="prevPage" class="inline-flex size-8 items-center justify-center">
      <span class="sr-only">Prev Page</span>
      <svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
      </svg>
    </a>

    <span class="h-4 w-px bg-white/25" aria-hidden="true"></span>

    <div>
      <label for="PaginationPage" class="sr-only">Page</label>
      <input
        type="number"
        id="PaginationPage"
        class="h-8 w-12 rounded border-none bg-transparent p-0 text-center text-xs font-medium focus:outline-none focus:ring-inset focus:ring-white"
        min="1"
        value="1"  
      />
    </div>

    <a href="#" id="nextPage" class="inline-flex size-8 items-center justify-center">
      <span class="sr-only">Next Page</span>
      <svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
      </svg>
    </a>
  </div>
</div>
                    </div>
                </div>
            </div>
    <script>

function viewAset(asetId) {
    console.log(`Navigating to /viewAset/${asetId}`);
    window.location.href = `/viewAset/${asetId}`;
}

function updateAset(asetId) {
    console.log(`Navigating to /updateAset/${asetId}`);
    window.location.href = `/updateAset/${asetId}`;
}

function qrGenerate(asetId) {
    console.log(`Navigating to /qrGenerate/${asetId}`);
    window.location.href = `/qrGenerate/${asetId}`;
}

function renderAset(asets) {
    tableBody.innerHTML = ''; 
    asets.forEach((aset, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-center">${(currentPage - 1) * 10 + (index + 1)}</td>
            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 user-id text-center" style="display:none;">${aset.aset_id || 'N/A'}</td>
            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 user-full-name text-center">${aset.aset_name || 'N/A'}</td>
            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 user-name text-center">${aset.klasifikasi.klasifikasi_nama || 'N/A'}</td>
            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 user-email text-center">${aset.penanggungjawab || 'N/A'}</td>
            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 user-email text-center">${aset.outlet.outlet_name || 'N/A'}</td>
            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 user-level text-center">${aset.aset_pic || 'N/A'}</td>
           <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 user-level text-center">
    
    ${aset.jadwal_maintenance.length > 0 ? 
        aset.jadwal_maintenance.map(jadwal => jadwal.tanggal_maintenance).join(', ') 
        : 'N/A'}
</td>

            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 user-level text-center">${aset.aset_status || 'N/A'}</td>
            <td class="whitespace-nowrap px-4 py-2 text-center">
              <button class="bg-red-500 text-white p-2 rounded" onclick="viewAset(${aset.aset_id})">View</button>
<button class="bg-yellow-500 text-white p-2 rounded" onclick="updateAset(${aset.aset_id})">Edit</button>
<button class="bg-yellow-500 text-white p-2 rounded" onclick="qrGenerate(${aset.aset_id})">QR Generate</button>

            </td>
        `;
        tableBody.appendChild(row);
    });
}


    const searchInput = document.querySelector('input[name="search"]');
const tableBody = document.querySelector('#asetTableBody');

function getToken() {
    return localStorage.getItem('token');
}

let currentPage = 1; 
const asetsPerPage = 10; 

function getToken() {
    return localStorage.getItem('token');
}

async function fetchAsets(sortOrder = '', page = 1) {
    const token = getToken();
    const url = `http://127.0.0.1:8000/api/asets/get?sortOrder=${sortOrder}&page=${page}`;
    console.log('Fetching from URL:', url);

    try {
        const response = await fetch(url, {
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

        const result = await response.json();
        console.log('Fetched asets:', result);

        if (result && result.data && result.last_page !== undefined) {
            renderAset(result.data); 
            updatePagination(result); 
        } else {
            console.error('Unexpected response structure:', result);
        }
    } catch (error) {
        console.error('Error fetching asets:', error);
    }
}

function updatePagination(meta) {
    if (meta && meta.last_page) {
        document.getElementById('PaginationPage').value = currentPage; // Update current page number
        document.getElementById('prevPage').classList.toggle('opacity-50', currentPage === 1); // Disable Prev if on first page
        document.getElementById('nextPage').classList.toggle('opacity-50', currentPage >= meta.last_page); // Disable Next if on last page
    } else {
        console.error('Meta data is not defined or does not have last_page:', meta);
    }
}


document.getElementById('prevPage').addEventListener('click', function(e) {
    e.preventDefault();
    if (currentPage > 1) {
        currentPage--;
        fetchAsets('', currentPage);
    }
});

document.getElementById('nextPage').addEventListener('click', function(e) {
    e.preventDefault();
    currentPage++;
    fetchAsets('', currentPage);
});


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
   


    </script>
</body>
</html>