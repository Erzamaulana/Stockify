<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    @include('layouts.partials.navbar')

    <!-- Sidebar berdasarkan role -->
    @auth
        @if(auth()->user()->role === 'Admin')
            @include('layouts.partials.sidebar')
        @elseif(auth()->user()->role === 'Manajer Gudang')
            @include('manajer.partials.sidebar')
        @elseif(auth()->user()->role === 'Staff Gudang')
            @include('staff.partials.sidebar')
        @else
            @include('layouts.partials.sidebar')
        @endif
    @endauth

    <!-- Main Content -->
<div class="p-4 sm:ml-64">
    @yield('content')
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session("success") }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
@endif

@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session("error") }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
@endif


<script>
document.addEventListener('DOMContentLoaded', function() {
    // Cek preferensi pengguna dari localStorage dan set mode awal
    if (localStorage.getItem('theme') === 'dark') {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }

    const themeToggle = document.getElementById('theme-toggle');

    themeToggle.addEventListener('click', () => {
        // Toggle kelas 'dark' pada elemen root (biasanya <html>)
        document.documentElement.classList.toggle('dark');

        // Simpan preferensi ke localStorage
        if(document.documentElement.classList.contains('dark')){
            localStorage.setItem('theme', 'dark');
        } else {
            localStorage.setItem('theme', 'light');
        }
    });
});
</script>
@stack('scripts')
</body>
</html>
