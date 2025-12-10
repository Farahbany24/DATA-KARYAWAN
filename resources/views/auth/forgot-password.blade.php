<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <title>DATA KARYAWAN</title>
</head>

<body class="min-h-screen flex items-center justify-center p-4 bg-gray-100">


    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div class="w-full p-8 bg-white rounded-2xl shadow-lg sm:max-w-md">
            <h1 class="mb-1 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl items-center justify-center">
                Lupa kata sandi Anda?
            </h1>
            <p class="text-gray-500 dark:text-gray-500">Silakan masukkan email Anda, dan kami akan mengirimkan tautan untuk pemulihan kata sandi.</p>
            <form class="mt-4 space-y-4 lg:mt-5 md:space-y-5" action="/forgot-password" method="POST">
                @csrf
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email Anda</label>
                    <input type="email" name="email" id="email" autocomplete="current-password" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Kecamatan@gmail.com" />
                </div>
                <button type="submit"
                    class="w-full text-white bg-gray-800 hover:bg-gray-700 focus:ring-4
    focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Send Link
                </button>
            </form>
        </div>
        @if ($errors->any())
        <div class="mt-3 max-w-sm px-4 py-3 rounded-lg bg-red-100 border border-red-300 text-red-600">
            <ul class="list-disc pl-4">
                @foreach ($errors->all() as $error)
                <li class="my-1">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (session('status'))
        <div class="mt-3 max-w-sm px-4 py-3 rounded-lg bg-green-100 border border-green-300 text-green-600">
            {{ session('status') }}
        </div>
        @endif
    </div>

</body>

</html>