<!DOCTYPE html>
<html lang="en" data-theme="corporate">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="min-h-screen bg-base-200">
    <div class="drawer lg:drawer-open">
        <input id="my-drawer" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col">
            <!-- Navbar -->
            <div class="navbar bg-base-100 shadow">
                <div class="flex-none lg:hidden">
                    <label for="my-drawer" class="btn btn-square btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </label>
                </div>
                <div class="flex-1 px-2 font-bold">Sistem Laporan Keuangan</div>
                <div class="flex-none px-4">
                    <span class="mr-4">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button class="btn btn-sm btn-error">Logout</button>
                    </form>
                </div>
            </div>

            <!-- Halaman konten -->
            <main class="bg-base-100 m-10 p-10 rounded-lg">
                @yield('content')
            </main>
        </div>

        <!-- Sidebar -->
        <div class="drawer-side">
            <label for="my-drawer" class="drawer-overlay"></label>
            <ul class="menu p-4 w-64 min-h-full bg-base-100 text-base-content">
                <li class="mb-4"><a href="/dashboard" class="font-bold text-lg">Dashboard</a></li>

                {{-- Menu Berdasarkan Role --}}
                @if (auth()->user()->role === 'operator')
                    <li><a href="/dashboard/users">Kelola Pengguna</a></li>
                    <li><a href="#">Backup Data</a></li>
                @endif

                @if (auth()->user()->role === 'bendahara')
                    <li><a href="/dashboard/activity">Data Kegiatan</a></li>
                    <li><a href="#">Data Pemasukan</a></li>
                    <li><a href="#">Data Pengeluaran</a></li>
                    <li><a href="#">Laporan Keuangan</a></li>
                @endif

                @if (auth()->user()->role === 'kepala_sekolah')
                    <li><a href="#">Laporan Bulanan</a></li>
                @endif

                @if (auth()->user()->role === 'yayasan')
                    <li><a href="#">Arsip Laporan Tahunan</a></li>
                @endif
            </ul>
        </div>
    </div>
</body>

</html>
