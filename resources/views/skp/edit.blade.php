<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body class="font-poppins h-screen bg-gray-100">
  <div class="max-w-6xl mx-auto pt-4 px-4 lg:px-8 mt-6">
    <div class="flex justify-end">
      <a href="{{route('skp.index')}}" class="bg-gray-800 rounded-md px-4 py-2 text-base font-medium hover:bg-gray-700 text-white transition-colors">
        Kembali
      </a>
    </div>
  </div>

  <div class="max-w-6xl mx-auto mt-4 px-4 lg:px-8 pb-12">
    <div class="bg-white rounded-lg  shadow-lg overflow-hidden">

      <div class="bg-gray-800 text-white text-base font-semibold px-6 py-3">
        Edit data pegawai
      </div>

      <div class="px-6 py-8">
        <form action="{{route('skp.update', $skp->id)}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3">
              <label for="nama" class="block text-sm font-semibold text-gray-900">
                Nama
              </label>
              <div class="mt-2">
                <div class="relative">
                  <select name="pegawai_id" id="nama-dropdown" class="block w-full py-1.5 pl-3 pr-10 text-gray-900 bg-white rounded-md outline outline-1 outline-gray-300 focus:outline-2 focus:outline-indigo-600 text-sm appearance-none">
                    @foreach ($pegawai as $nama)
                    <option value="{{$nama->id}}" {{ $skp->pegawai_id == $nama->id ? 'selected' : '' }}>
                      {{$nama->nama}}
                    </option>
                    @endforeach
                  </select>
                  <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04L10 14.148l2.7-1.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z" clip-rule="evenodd" />
                    </svg>
                  </div>
                </div>
              </div>
            </div>

            <div class="sm:col-span-3">
              <label for="tahun" class="block text-sm font-semibold text-gray-900">
                Tahun
              </label>
              <div class="mt-2">
                <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 outline-gray-300 focus-within:outline-2 focus-within:outline-indigo-600">
                  <input type="text" name="tahun" id="tahun" value="{{$skp->tahun}}"
                    class="block w-full py-1.5 pl-1 pr-3 text-gray-900 placeholder-gray-400 focus:outline-none text-sm"
                    placeholder="2017" />
                </div>
              </div>
            </div>

            <div class="sm:col-span-3">
              <label for="skp" class="block text-sm font-semibold text-gray-900">
                SKP
              </label>
              <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                <div class="text-center">
                  @if ($skp->file_skp)
                  <img src="{{ asset('storage/' . $skp->file_skp) }}" alt="skp_lama"
                    class="mx-auto w-auto h-40">
                  @else
                  <svg class="mx-auto size-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
                  </svg>
                  @endif
                  <input type="hidden" name="skp_lama" value="{{$skp->file_skp}}">
                  <div class="mt-4 flex text-sm text-gray-600">
                    <label for="skp-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                      <span>Upload a file</span>
                      <input id="skp-upload" name="file_skp" type="file" class="sr-only" accept="image/*" />
                    </label>
                    <p class="pl-1">or drag and drop</p>
                  </div>

                  <!-- Menampilkan nama file -->
                  <p id="file-name-skp" class="mt-2 text-sm text-gray-800 font-medium"></p>

                  <p class="text-xs/5 text-gray-600">PNG, JPG, JPEG up to 10MB</p>
                </div>
              </div>
            </div>
            <script>
              document.addEventListener('DOMContentLoaded', function() {
                const input = document.getElementById('skp-upload');
                const nameEl = document.getElementById('file-name-skp');
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
              Edit
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