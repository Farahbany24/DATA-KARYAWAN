<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body class="font-poppins h-screen bg-gray-100">
  <div class="max-w-6xl mx-auto pt-4 px-4 lg:px-8 mt-6">
    <div class="flex justify-end">
      <a href="{{route('pegawai.index')}}" class="bg-gray-800 rounded-md px-4 py-2 text-base font-medium hover:bg-gray-700 text-white transition-colors">
        Kembali
      </a>
    </div>
  </div>

  <div class="max-w-6xl mx-auto mt-4 px-4 lg:px-8 pb-12">
    <div class="bg-white rounded-lg  shadow-lg overflow-hidden">

      <div class="bg-gray-800 text-white text-base font-semibold px-6 py-3">
        Tambah Data Pegawai
      </div>

      <div class="px-6 py-8">
        <form action="{{route('pegawai.store')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3">
              <label for="nip" class="block text-sm font-semibold text-gray-900">
                NIP
              </label>
              <div class="mt-2">
                <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 outline-gray-300 focus-within:outline-2 focus-within:outline-indigo-600">
                  <input type="text" name="nip" id="nip"
                    class="block w-full py-1.5 pl-1 pr-3 text-gray-900 placeholder-gray-400 focus:outline-none text-sm"
                    placeholder="19860926 201505 1 001" />
                </div>
              </div>
            </div>

            <div class="sm:col-span-3">
              <label for="nama" class="block text-sm font-semibold text-gray-900">
                Nama
              </label>
              <div class="mt-2">
                <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 outline-gray-300 focus-within:outline-2 focus-within:outline-indigo-600">
                  <input type="text" name="nama" id="nama"
                    class="block w-full py-1.5 pl-1 pr-3 text-gray-900 placeholder-gray-400 focus:outline-none text-sm"
                    placeholder="Anies Baswedan" />
                </div>
              </div>
            </div>

            <div class="sm:col-span-3">
              <label for="jabatan" class="block text-sm font-semibold text-gray-900">
                Jabatan
              </label>
              <div class="mt-2">
                <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 outline-gray-300 focus-within:outline-2 focus-within:outline-indigo-600">
                  <input type="text" name="jabatan" id="jabatan"
                    class="block w-full py-1.5 pl-1 pr-3 text-gray-900 placeholder-gray-400 focus:outline-none text-sm"
                    placeholder="Kepala Kecamatan" />
                </div>
              </div>
            </div>

            <div class="sm:col-span-3">
              <label for="pangkat" class="block text-sm font-semibold text-gray-900">
                Pangkat GOL
              </label>
              <div class="mt-2">
                <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 outline-gray-300 focus-within:outline-2 focus-within:outline-indigo-600">
                  <input type="text" name="pangkat_gol" id="pangkat"
                    class="block w-full py-1.5 pl-1 pr-3 text-gray-900 placeholder-gray-400 focus:outline-none text-sm"
                    placeholder="ESELON IV B" />
                </div>
              </div>
            </div>

            <div class="sm:col-span-3">
              <label for="karpeg" class="block text-sm font-semibold text-gray-900">
                KARPEG
              </label>
              <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                <div class="text-center">
                  <svg class="mx-auto size-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
                  </svg>

                  <div class="mt-4 flex text-sm text-gray-600">
                    <label for="karpeg-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                      <span>Upload a file</span>
                      <input id="karpeg-upload" name="karpeg" type="file" class="sr-only" accept="image/*" />
                    </label>
                    <p class="pl-1">or drag and drop</p>
                  </div>

                  <!-- Menampilkan nama file -->
                  <p id="file-name-karpeg" class="mt-2 text-sm text-gray-800 font-medium"></p>

                  <p class="text-xs/5 text-gray-600">PNG, JPG, JPEG up to 10MB</p>
                </div>
              </div>
            </div>

            <script>
              document.addEventListener('DOMContentLoaded', function() {
                const input = document.getElementById('karpeg-upload');
                const nameEl = document.getElementById('file-name-karpeg');
                if (!input) return;
                let dropArea = input;
                while (dropArea && dropArea !== document.body) {
                  if (dropArea.classList && dropArea.classList.contains('border-dashed')) break;
                  dropArea = dropArea.parentElement;
                }
               if (!dropArea || dropArea === document.body) return; // gagal ketemu, ya sudah
                function showName(file) {
                  if (nameEl && file) {
                    nameEl.textContent = file.name;
                  } else if (nameEl) {
                    nameEl.textContent = '';
                  }
                }
                // Sudah ada listener change di kode kamu; nggak masalah kalau kita tambah
                input.addEventListener('change', function() {
                  if (input.files.length > 0) showName(input.files[0]);
                });
                // Highlight saat drag masuk
                ['dragenter', 'dragover'].forEach(evt => {
                  dropArea.addEventListener(evt, e => {
                    e.preventDefault();
                    e.stopPropagation();
                    dropArea.classList.add('ring-2', 'ring-indigo-600');
                  });
                });
                // Hilangkan highlight
                ['dragleave', 'drop'].forEach(evt => {
                  dropArea.addEventListener(evt, e => {
                    e.preventDefault();
                    e.stopPropagation();
                    dropArea.classList.remove('ring-2', 'ring-indigo-600');
                  });
                });
                // Saat file dijatuhkan
                dropArea.addEventListener('drop', e => {
                  const files = e.dataTransfer.files;
                  if (!files || !files.length) return;
                  // Assign file ke input (pakai DataTransfer supaya kompatibel)
                  const dt = new DataTransfer();
                  dt.items.add(files[0]); // kalau mau multi, loop
                  input.files = dt.files;
                  showName(files[0]);
                });
              });
            </script>

            <div class="sm:col-span-3">
              <label for="karis_karsu" class="block text-sm font-semibold text-gray-900">
                KARPEG
              </label>
              <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                <div class="text-center">
                  <svg class="mx-auto size-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
                  </svg>

                  <div class="mt-4 flex text-sm text-gray-600">
                    <label for="karis-karsu-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                      <span>Upload a file</span>
                      <input id="karis-karsu-upload" name="karis_karsu" type="file" class="sr-only" accept="image/*" />
                    </label>
                    <p class="pl-1">or drag and drop</p>
                  </div>

                  <!-- Menampilkan nama file -->
                  <p id="file-name-karis" class="mt-2 text-sm text-gray-800 font-medium"></p>

                  <p class="text-xs/5 text-gray-600">PNG, JPG, JPEG up to 10MB</p>
                </div>
              </div>
            </div>
            <script>
              document.addEventListener('DOMContentLoaded', function() {
                const input = document.getElementById('karis-karsu-upload');
                const nameEl = document.getElementById('file-name-karis');
                if (!input) return;
                let dropArea = input;
                while (dropArea && dropArea !== document.body) {
                  if (dropArea.classList && dropArea.classList.contains('border-dashed')) break;
                  dropArea = dropArea.parentElement;
                }
               if (!dropArea || dropArea === document.body) return; // gagal ketemu, ya sudah
                function showName(file) {
                  if (nameEl && file) {
                    nameEl.textContent = file.name;
                  } else if (nameEl) {
                    nameEl.textContent = '';
                  }
                }
                // Sudah ada listener change di kode kamu; nggak masalah kalau kita tambah
                input.addEventListener('change', function() {
                  if (input.files.length > 0) showName(input.files[0]);
                });
                // Highlight saat drag masuk
                ['dragenter', 'dragover'].forEach(evt => {
                  dropArea.addEventListener(evt, e => {
                    e.preventDefault();
                    e.stopPropagation();
                    dropArea.classList.add('ring-2', 'ring-indigo-600');
                  });
                });
                // Hilangkan highlight
                ['dragleave', 'drop'].forEach(evt => {
                  dropArea.addEventListener(evt, e => {
                    e.preventDefault();
                    e.stopPropagation();
                    dropArea.classList.remove('ring-2', 'ring-indigo-600');
                  });
                });
                // Saat file dijatuhkan
                dropArea.addEventListener('drop', e => {
                  const files = e.dataTransfer.files;
                  if (!files || !files.length) return;
                  // Assign file ke input (pakai DataTransfer supaya kompatibel)
                  const dt = new DataTransfer();
                  dt.items.add(files[0]); // kalau mau multi, loop
                  input.files = dt.files;
                  showName(files[0]);
                });
              });
            </script>
          </div>

          <div class="flex mt-8 justify-end">
            <button type="submit" class="bg-gray-800 rounded-md px-4 py-2 text-base font-medium hover:bg-gray-700 text-white transition-colors">
              Tambah
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  </form>
  </div>
  </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const menuButton = document.querySelector('[aria-controls="mobile-menu"]');
      const mobileMenu = document.getElementById('mobile-menu');
      const iconOpen = menuButton.querySelector('svg.block');
      const iconClose = menuButton.querySelector('svg.hidden');

      menuButton.addEventListener('click', function() {
        const isExpanded = menuButton.getAttribute('aria-expanded') === 'true';

        // Toggle aria-expanded
        menuButton.setAttribute('aria-expanded', String(!isExpanded));

        // Toggle menu visibility
        mobileMenu.classList.toggle('hidden');

        // Toggle icons
        iconOpen.classList.toggle('hidden');
        iconClose.classList.toggle('hidden');
      });
    });
  </script>

</body>

</html>