<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
  @vite('resources/css/app.css')
</head>

<body class="font-poppins bg-gray-100">
  <!-- Mobile Menu Button (Only visible on mobile) -->
  <div class="md:hidden absolute top-4 left-4 z-50">
    <button id="mobile-menu-btn" class="bg-gray-800 text-white px-2 py-1 rounded-md hover:bg-gray-700">
      <i class="ri-menu-line text-xl"></i>
    </button>
  </div>

  <!-- Mobile Overlay -->
  <div id="mobile-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden"></div>

  <!-- Sidebar -->
  <div id="sidebar" class="fixed left-0 top-0 w-[260px] h-full bg-gray-900 text-white flex flex-col transition-all duration-300 z-50 md:translate-x-0 -translate-x-full">
    <!-- Header -->
    <div class="p-4 border-b border-b-gray-800">
      <div class="flex items-center">
        <img id="sidebar-logo" src="{{ asset('images/lambang.png') }}" alt="" class="w-14 h-14 object-cover mr-1 ml-1 transition-all duration-300">
        <span id="sidebar-title" class="text-sm font-bold transition-all duration-300 overflow-hidden whitespace-nowrap">DATA KARYAWAN</span>
        <button id="toggle-sidebar" class="ml-auto p-1 hover:bg-gray-700 rounded transition-colors hidden md:block">
          <i id="toggle-arrow" class="ri-arrow-left-double-line text-lg transition-transform duration-300"></i>
        </button>
      </div>
    </div>

    <!-- Navigation Menu -->
    <div class="flex-1 p-4 overflow-y-auto">
      <ul class="space-y-1">
        <li>
          <a href="{{route ('pegawai.index')}}" id="nav-item-1" class="flex items-center rounded-lg py-2 px-4 text-white hover:bg-gray-800 hover:text-gray-300 transition-colors group relative">
            <i class="ri-user-line mr-3 text-lg flex-shrink-0"></i>
            <span class="sidebar-text text-sm font-medium transition-all duration-300 overflow-hidden whitespace-nowrap">Data Utama</span>
          </a>
        </li>
        <li>
          <a href="{{route ('riwayat.index')}}" id="nav-item-2" class="flex items-center rounded-lg py-2 px-4 text-white hover:bg-gray-800 hover:text-gray-300 transition-colors group relative">
            <i class="ri-calendar-schedule-fill mr-3 text-lg flex-shrink-0"></i>
            <span class="sidebar-text text-sm font-medium transition-all duration-300 overflow-hidden whitespace-nowrap">Riwayat</span>
          </a>
        </li>
        <li>
          <a href="{{route ('administrasi.index')}}" id="nav-item-3" class="flex items-center rounded-lg py-2 px-4 text-white hover:bg-gray-800 hover:text-gray-300 transition-colors group relative">
            <i class="ri-archive-stack-line mr-3 text-lg flex-shrink-0"></i>
            <span class="sidebar-text text-sm font-medium transition-all duration-300 overflow-hidden whitespace-nowrap">Administrasi & kerja</span>
          </a>
        </li>
        <li>
          <a href="{{route ('skp.index')}}" id="nav-item-4" class="flex items-center rounded-lg py-2 px-4 text-white {{ request()->routeIs('skp.index') ? 'bg-gray-800' : 'hover:bg-gray-800 hover:text-gray-300' }} transition-colors group relative">
            <i class="ri-bar-chart-2-line mr-3 text-lg flex-shrink-0"></i>
            <span class="sidebar-text text-sm font-medium transition-all duration-300 overflow-hidden whitespace-nowrap">SKP</span>
          </a>
        </li>
        <li class="group">
          <a href="" id="nav-item-5" class="flex items-center rounded-lg py-2 px-4 text-white hover:bg-gray-800 hover:text-gray-300 group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle transition-colors">
            <i class="ri-file-list-3-line mr-3 text-lg flex-shrink-0"></i>
            <span class="sidebar-text text-sm font-medium transition-all duration-300 overflow-hidden whitespace-nowrap flex-1">SK</span>
            <i class="ri-arrow-right-s-line text-lg flex-shrink-0 group-[.selected]:rotate-90 transition-transform sidebar-dropdown-arrow"></i>
          </a>
          <ul class="sidebar-dropdown pl-7 mt-2 hidden group-[.selected]:block space-y-2">
            <li>
              <a href="{{route ('sk.index')}}" class="text-gray-300 text-sm flex items-center hover:text-white transition-colors before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">
                SK GOL III
              </a>
            </li>
            <li>
              <a href="{{route ('skiv.index')}}" class="text-gray-300 text-sm flex items-center hover:text-white transition-colors before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">
                SK GOL IV
              </a>
            </li>
          </ul>
        </li>
        <li>
          <a href="{{route ('file-manager')}}" id="nav-item-6" class="flex items-center rounded-lg py-2 px-4 text-white hover:bg-gray-800 hover:text-gray-300 transition-colors group relative">
            <i class="ri-donut-chart-fill mr-3 text-lg flex-shrink-0"></i>
            <span class="sidebar-text text-sm font-medium transition-all duration-300 overflow-hidden whitespace-nowrap">File Manager</span>
          </a>
        </li>
      </ul>
    </div>

    <!-- User Authentication Section -->
    @auth
    <div class="p-4 bg-gray-900">
      <div class="flex flex-col space-y-3">
        <!-- User Info -->
        <div class="flex items-center space-x-3">
          <div class="w-8 h-8 bg-gray-600 rounded-full flex items-center justify-center flex-shrink-0">
            <i class="ri-group-fill"></i>
          </div>
          <div class="flex-1 min-w-0">
            <p class="sidebar-text text-sm font-medium text-white truncate transition-all duration-300 overflow-hidden whitespace-nowrap">
              {{ Auth::user()->name }}
            </p>
          </div>
        </div>

        <!-- Logout Button -->
        <form action="{{ route('logout') }}" method="POST" class="w-full">
          @csrf
          <button type="submit" class="w-full bg-white hover:bg-gray-400 text-gray-900 rounded-lg px-3 py-2 text-sm font-medium transition-colors flex items-center justify-center space-x-2">
            <i class="ri-logout-box-r-line text-sm"></i>
            <span class="sidebar-text transition-all duration-300 overflow-hidden whitespace-nowrap">Logout</span>
          </button>
        </form>
      </div>
    </div>
    @else
    <div class="p-4 bg-gray-900">
      <div class="flex flex-col space-y-3">
        <!-- User Info -->
        <div class="flex items-center space-x-3">
          <div class="w-8 h-8 bg-gray-600 rounded-full flex items-center justify-center flex-shrink-0">
            <i class="ri-group-fill"></i>
          </div>
          <div class="flex-1 min-w-0">
            <p class="sidebar-text text-sm font-medium text-white truncate transition-all duration-300 overflow-hidden whitespace-nowrap">
              User Name
            </p>
          </div>
        </div>

        <!-- Logout Button -->
        <form action="#" method="POST" class="w-full">
          <button type="submit" class="w-full bg-white hover:bg-gray-400 text-gray-900 rounded-lg px-3 py-2 text-sm font-medium transition-colors flex items-center justify-center space-x-2">
            <i class="ri-logout-box-r-line text-sm"></i>
            <span class="sidebar-text transition-all duration-300 overflow-hidden whitespace-nowrap">Logout</span>
          </button>
        </form>
      </div>
    </div>
    @endauth
  </div>
  <!-- end of sidebar -->

  <!-- Main Content -->
  <div id="main-content" class="transition-all duration-300 md:ml-[260px] pt-16 md:pt-0">
    <!-- table -->
    <div class="p-5 mt-5">

      <div class="flex justify-between items-center mb-4 max-w-full overflow-x-auto hidden sm:flex">
        <a class="bg-gray-800 rounded-md px-4 py-2 text-base font-medium hover:bg-gray-700 text-white h-10" href="{{route ('skp.create')}}">

          Tambah
        </a>
        <form action="{{ route('skp.index') }}" method="GET" class="mb-1">
          <!-- Search Bar -->
          <div class="relative">
            <input type="text" name="nama" autocomplete="off" id="search" placeholder="Cari Data" class="w-64 pl-10 pr-3 py-2 border border-gray-300 rounded-full focus:outline-none focus:border-transparent">
            <i class="ri-search-line absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
          </div>
        </form>
      </div>

      <div class="max-h-[84vh] overflow-y-auto rounded-lg shadow hidden md:block">
        <table class="w-full ">
          <thead class="bg-gray-50 border-b-2 border-gray-200">
            <tr>
              <th class="sticky top-0 bg-gray-50 z-10 w-10 p-3 text-sm font-semibold tracking-wide text-center">No.</th>
              <th class="sticky top-0 bg-gray-50 z-10 w-48 p-3 text-sm font-semibold tracking-wide text-center truncate">Nama</th>
              <th class="sticky top-0 bg-gray-50 z-10 w-48 p-3 text-sm font-semibold tracking-wide text-center truncate">TAHUN</th>
              <th class="sticky top-0 bg-gray-50 z-10 w-48 p-3 text-sm font-semibold tracking-wide text-center truncate">FILE SKP</th>
              <th class="sticky top-0 bg-gray-50 z-10 w-48 p-3 text-sm font-semibold tracking-wide text-center">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100 ">
            @foreach ($allSkp as $key => $skp)
            <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }}">
              <td class="p-3 text-sm font-bold text-blue-500 whitespace-nowrap text-center">{{$key + 1}}
              </td>

              <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                {{$skp->pegawai->nama}}
              </td>

              <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                {{$skp->tahun}}
              </td>

              <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center align-middle relative">
                @if ($skp->file_skp)
                <img src="{{ asset('storage/' . $skp->file_skp) }}" alt="Kartu" width="100" class="mx-auto">

                <a href="{{ asset('storage/' . $skp->file_skp) }}" download
                  class="absolute bottom-2 right-2">
                  <img src="{{ asset('images/download.png') }}" alt="Download" width="20">
                </a>
                @else
                <span class="p-1.5 text-red-800 bg-red-200 rounded-lg bg-opacity-50 text-sm italic font-medium">
                  Tidak ada file
                </span>
                @endif
              </td>

              <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                <form action="{{route ('skp.destroy', $skp->id)}}" method="POST" class="flex space-x-2  justify-center">
                  <a href="{{route ('skp.edit', $skp->id)}}" class="inline-flex items-center justify-center bg-blue-500 rounded-md px-2 py-2 text-[12px] font-medium hover:bg-blue-400 text-white">Edit</a>
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="inline-flex items-center justify-center bg-blue-500 rounded-md px-2 py-2 text-[12px] font-medium hover:bg-blue-400 text-white">Hapus</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="grid grid-cols-1 gap-4 md:hidden">
        <div class="flex justify-between items-center mb-2 max-w-full overflow-x-auto sm:hidden">
          <a class="bg-gray-800 rounded-md px-4 py-2 text-base font-medium hover:bg-gray-700 text-white h-10" href="{{route ('skp.create')}}">
            Tambah
          </a>
          <form action="{{ route('skp.index') }}" method="GET" class="mb-1">
          <!-- Search Bar -->
          <div class="relative">
            <input type="text" name="nama" autocomplete="off" id="search" placeholder="Cari Data" class="w-64 pl-10 pr-3 py-2 border border-gray-300 rounded-full focus:outline-none focus:border-transparent">
            <i class="ri-search-line absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
          </div>
        </form>
        </div>

        @foreach ($allSkp as $key => $skp)
        <div class="bg-white p-4 space-y-4 rounded-lg shadow mt-0">
          <!-- No -->
          <div class="flex items-center justify-between w-full text-base">
            <div class="font-semibold text-gray-400">NO.</div>
            <div class="font-semibold text-blue-500 text-right">{{$key + 1}}</div>
          </div>
          <!-- NAMA -->
          <div class="flex items-center justify-between w-full  text-base">
            <div class="font-semibold text-gray-400">Nama</div>
            <div class="text-sm text-gray-700 text-right">{{$skp->pegawai->nama}}</div>
          </div>
          <!-- TAHUN -->
          <div class="flex items-center justify-between w-full text-base">
            <div class="font-semibold text-gray-400">TAHUN</div>
            <div class="text-sm text-gray-700 text-right">{{$skp->tahun}}</div>
          </div>
          <!-- FILE SKP -->
          <div class="flex items-center justify-between w-full  text-base">
            <div class="font-semibold text-gray-400">SKP</div>
            <div class="text-sm text-gray-700 text-right">
              @if ($skp->file_skp)
              <div class="flex flex-col items-center space-y-2">
                <img src="{{ asset('storage/' . $skp->file_skp) }}" alt="Kartu" class="w-24 h-auto">
                <a href="{{ asset('storage/' . $skp->file_skp) }}" download class="inline-flex items-center space-x-1 text-blue-600 hover:underline text-xs">
                  <img src="{{ asset('images/download.png') }}" alt="Download" class="w-4 h-4">
                  <span>Download</span>
                </a>
              </div>
              @else
              <span class="inline-block p-1.5 text-red-800 bg-red-200 rounded-lg bg-opacity-50 text-sm italic font-medium">
                Tidak ada file
              </span>
              @endif
            </div>
          </div>
          <!-- AKSI -->
          <div class="flex items-center justify-center w-full">
            <form action="{{route('skp.destroy', $skp->id)}}" method="POST" class="flex space-x-2">
              <a href="{{route('skp.edit', $skp->id)}}" class="inline-flex items-center justify-center bg-blue-500 rounded-md px-2 py-2 text-[12px] font-medium hover:bg-blue-400 text-white">Edit</a>
              @csrf
              @method('DELETE')
              <button type="submit" class="inline-flex items-center justify-center bg-blue-500 rounded-md px-2 py-2 text-[12px] font-medium hover:bg-blue-400 text-white">Hapus</button>
            </form>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    <!-- endtable -->
  </div>
</body>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');
    const toggleBtn = document.getElementById('toggle-sidebar');
    const toggleArrow = document.getElementById('toggle-arrow');
    const logo = document.getElementById('sidebar-logo');
    const title = document.getElementById('sidebar-title');
    const sidebarTexts = document.querySelectorAll('.sidebar-text');
    const dropdownArrows = document.querySelectorAll('.sidebar-dropdown-arrow');
    const dropdowns = document.querySelectorAll('.sidebar-dropdown');
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileOverlay = document.getElementById('mobile-overlay');

    let isCollapsed = false;

    // Desktop sidebar toggle functionality
    if (toggleBtn) {
      toggleBtn.addEventListener('click', function() {
        isCollapsed = !isCollapsed;

        if (isCollapsed) {
          // Collapse sidebar
          sidebar.classList.remove('w-[260px]');
          sidebar.classList.add('w-[70px]');

          // Update main content margin
          if (mainContent) {
            mainContent.classList.remove('md:ml-[260px]');
            mainContent.classList.add('md:ml-[70px]');
          }

          // Rotate arrow to right
          toggleArrow.classList.remove('ri-arrow-left-double-line');
          toggleArrow.classList.add('ri-arrow-right-double-line');

          // Hide logo and title
          if (logo) {
            logo.classList.add('w-0', 'opacity-0');
            logo.classList.remove('w-14', 'mr-1');
          }
          if (title) {
            title.classList.add('w-0', 'opacity-0');
          }

          // Hide all text elements
          sidebarTexts.forEach(text => {
            text.classList.add('w-0', 'opacity-0');
          });

          // Hide dropdown arrows and dropdowns
          dropdownArrows.forEach(arrow => {
            arrow.classList.add('hidden');
          });
          dropdowns.forEach(dropdown => {
            dropdown.classList.add('hidden');
          });
          // Remove selected state from all groups to close dropdowns
          document.querySelectorAll('.group').forEach(group => {
            group.classList.remove('selected');
          });

          // Fix hover area - ubah padding dan positioning
          document.querySelectorAll('#nav-item-1, #nav-item-2, #nav-item-3, #nav-item-4, #nav-item-5, #nav-item-6').forEach(item => {
            item.classList.remove('px-4', 'py-2');
            item.classList.add('p-2', 'justify-center', 'w-fit', 'mx-auto');
            const icon = item.querySelector('i');
            if (icon) {
              icon.classList.remove('mr-3');
            }
          });

          // Fix logout button
          const logoutBtn = document.querySelector('button[type="submit"]');
          if (logoutBtn) {
            logoutBtn.classList.remove('px-3', 'py-2', 'space-x-2');
            logoutBtn.classList.add('p-2', 'justify-center');
            const logoutIcon = logoutBtn.querySelector('i');
            if (logoutIcon) {
              logoutIcon.classList.remove('text-sm');
              logoutIcon.classList.add('text-lg');
            }
          }

        } else {
          // Expand sidebar
          sidebar.classList.add('w-[260px]');
          sidebar.classList.remove('w-[70px]');

          // Update main content margin
          if (mainContent) {
            mainContent.classList.remove('md:ml-[70px]');
            mainContent.classList.add('md:ml-[260px]');
          }

          // Rotate arrow to left
          toggleArrow.classList.remove('ri-arrow-right-double-line');
          toggleArrow.classList.add('ri-arrow-left-double-line');

          // Show logo and title
          if (logo) {
            logo.classList.remove('w-0', 'opacity-0');
            logo.classList.add('w-14', 'mr-1');
          }
          if (title) {
            title.classList.remove('w-0', 'opacity-0');
          }

          // Show all text elements
          sidebarTexts.forEach(text => {
            text.classList.remove('w-0', 'opacity-0');
          });

          // Show dropdown arrows
          dropdownArrows.forEach(arrow => {
            arrow.classList.remove('hidden');
          });
          // Show dropdowns that should be visible (selected state)
          dropdowns.forEach(dropdown => {
            const parent = dropdown.closest('.group');
            if (parent && parent.classList.contains('selected')) {
              dropdown.classList.remove('hidden');
            }
          });

          // Restore normal padding dan positioning
          document.querySelectorAll('#nav-item-1, #nav-item-2, #nav-item-3, #nav-item-4, #nav-item-5, #nav-item-6').forEach(item => {
            item.classList.add('px-4', 'py-2');
            item.classList.remove('p-2', 'justify-center', 'w-fit', 'mx-auto');
            const icon = item.querySelector('i');
            if (icon) {
              icon.classList.add('mr-3');
            }
          });

          // Restore logout button
          const logoutBtn = document.querySelector('button[type="submit"]');
          if (logoutBtn) {
            logoutBtn.classList.add('px-3', 'py-2', 'space-x-2');
            logoutBtn.classList.remove('p-2');
            const logoutIcon = logoutBtn.querySelector('i');
            if (logoutIcon) {
              logoutIcon.classList.add('text-sm');
              logoutIcon.classList.remove('text-lg');
            }
          }
        }
      });
    }
    // Mobile menu toggle
    if (mobileMenuBtn) {
      mobileMenuBtn.addEventListener('click', function() {
        const isMobileHidden = sidebar.classList.contains('-translate-x-full');

        if (isMobileHidden) {
          sidebar.classList.remove('-translate-x-full');
          sidebar.classList.add('translate-x-0');
          if (mobileOverlay) {
            mobileOverlay.classList.remove('hidden');
          }
          document.body.style.overflow = 'hidden';
        } else {
          sidebar.classList.add('-translate-x-full');
          sidebar.classList.remove('translate-x-0');
          if (mobileOverlay) {
            mobileOverlay.classList.add('hidden');
          }
          document.body.style.overflow = '';
        }
      });
    }

    // Close mobile menu when overlay is clicked
    if (mobileOverlay) {
      mobileOverlay.addEventListener('click', function() {
        sidebar.classList.add('-translate-x-full');
        sidebar.classList.remove('translate-x-0');
        mobileOverlay.classList.add('hidden');
        document.body.style.overflow = '';
      });
    }

    // Sidebar dropdown functionality
    document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function(item) {
      item.addEventListener('click', function(e) {
        e.preventDefault();

        // Don't allow dropdown when collapsed
        if (isCollapsed) {
          return;
        }

        const parent = item.closest('.group');

        if (parent.classList.contains('selected')) {
          parent.classList.remove('selected');
        } else {
          // Close all other dropdowns first
          document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function(i) {
            i.closest('.group').classList.remove('selected');
          });
          // Open current dropdown
          parent.classList.add('selected');
        }
      });
    });
  });
</script>

</html>