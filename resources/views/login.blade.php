<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Form</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body>
    <div class="flex items-center justify-center min-h-screen bg-gradient-to-r from-blue-500 to-blue-100">
      <div class="relative flex flex-col m-6 space-y-8 bg-white shadow-2xl rounded-2xl md:flex-row md:space-y-0">
        <!-- left side -->
        <div class="flex flex-col justify-center p-8 md:p-14">
                    <!-- Bagian Header: Nama Aplikasi dan Logo Dinamis -->
                    @php
                        // Ambil data setting dari SettingService
                        $settings = app(App\Services\SettingService::class)->getAllSettings();
                        $appName = $settings['app_name'] ?? 'My Application';
                        $logo = $settings['logo'] ?? 'default-logo.svg';
                    @endphp
                    <div class="flex justify-center items-center space-x-4">
                        <span class="text-2xl font-bold text-gray-900">{{ $appName }}</span>
                        <img src="{{ asset('storage/' . $logo) }}" alt="{{ $appName }} Logo" class="h-16 w-16 object-contain">
                    </div>
                    <!-- Akhir Bagian Header -->

                    @if ($errors->any())
                        <ul>
                            @foreach($errors->all() as $item)
                                <li class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                    </svg>
                                    {{ $item }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
          <div class="py-4">
          <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('login') }}">
          @csrf
            <span class="mb-2 text-md">Email</span>
            <input
              type="email"
              class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500"
              name="email"
              id="email"
              value="{{ old('email') }}"
            />
          </div>
          <div class="py-4">
            <span class="mb-2 text-md">Password</span>
            <input
              type="password"
              name="password"
              id="password"
              class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500"
            />
          </div>
          <div class="flex justify-between w-full py-4">
            <div class="mr-24">
              <input type="checkbox" name="remember" id="remember" class="mr-2" />
              <label for="remember" class="text-md">Remember for 30 days</label>
            </div>
            <span class="font-bold text-md">Forgot password</span>
          </div>
          <button
            class="w-full bg-black text-white p-2 rounded-lg mb-6 hover:bg-white hover:text-black hover:border hover:border-gray-300"
          >
            Sign in
          </button>
        </div>
        <!-- {/* right side */} -->
        <div class="relative">
          <img
            src="{{ asset('image (2).jpg') }}"
            alt="img"
            class="w-[400px] h-full hidden rounded-r-2xl md:block object-cover"
          />
          <!-- text on image  -->
          <div
            class="absolute hidden bottom-10 right-6 p-6 bg-white bg-opacity-30 backdrop-blur-sm rounded drop-shadow-lg md:block"
          >
            <span class="text-white text-xl"
              >We've been uesing Untitle to kick"<br />start every new project
              and can't <br />imagine working without it."
            </span>
          </div>
        </div>
      </div>
    </div>
    </form>
  </body>
</html>