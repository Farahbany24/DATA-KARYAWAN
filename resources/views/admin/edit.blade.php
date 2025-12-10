<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Document</title>
</head>

<body class="font-poppins bg-gray-100">
    <div class="flex min-h-screen flex-col items-center justify-center px-6 py-12 lg:px-8">


        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-sm">
            <form action="{{ route('admin.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div>
                    <label for="name" class="block text-sm/6 font-medium text-gray-900">Name</label>
                    <div class="mt-2">
                        <input type="text" name="name" id="email" autocomplete="name" required
                            value="{{ $user->name }}" disabled class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mt-5">
                        <label for="email" class="block text-sm/6 font-medium text-gray-900">Email</label>
                    </div>
                    <div class="mt-2">
                        <input type="email" name="email" id="email" autocomplete="email" required
                            value="{{ $user->email }}" disabled
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                    </div>
                </div>

                <div class="mt-5">
                    <label for="role" class="block text-sm/6 font-medium text-gray-900">Role</label>
                    <div class="mt-2">
                        <select name="role" id="role" required
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1
                   -outline-offset-1 outline-gray-300 focus:outline focus:outline-2
                   focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            <option value="">-- Pilih Role --</option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->name }}"
                                {{ $user->roles->pluck('name')->contains($role->name) ? 'selected' : '' }}>
                                {{ strtoupper($role->name) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-8">
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
                </div>


                <!-- validation error -->
                @if ($errors->any())
                <ul class="px-4 py-2 bg-red-100">
                    @foreach ($errors->all() as $error)
                    <li class="my-2 text-red-500">{{ $error }}</li>
                    @endforeach
                </ul>
                @endif

            </form>
        </div>
    </div>
</body>

</html>