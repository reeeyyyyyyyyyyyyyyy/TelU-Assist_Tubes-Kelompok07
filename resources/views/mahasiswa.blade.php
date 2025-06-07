<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Tel-U Assist</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#E30613',
                        primaryDark: '#C10510',
                        secondary: '#2D3748',
                        accent: '#FFD700',
                        campus: '#1E3A8A'
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
        }

        .sidebar {
            width: 250px;
            transition: all 0.3s;
        }

        .main-content {
            margin-left: 250px;
            transition: all 0.3s;
        }

        .active {
            background-color: #E30613;
            color: white;
        }

        .active:hover {
            background-color: #C10510;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #E30613, #C10510);
            color: white;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(227, 6, 19, 0.3);
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar fixed h-full bg-blue-800 text-white">
        <div class="p-4">
            <h1 class="text-2xl font-bold">Tel-U <span class="text-yellow-400">Assist</span></h1>
            <p class="text-sm text-gray-300">Sistem Pelaporan Terpadu</p>
        </div>
        <nav class="mt-6">
            <a href="{{ route('mahasiswa.dashboard') }}" class="block py-3 px-6 hover:bg-blue-700 {{ request()->routeIs('mahasiswa.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
            </a>
            <a href="{{ route('mahasiswa.kebersihan.index') }}" class="block py-3 px-6 hover:bg-blue-700 {{ request()->routeIs('mahasiswa.kebersihan.*') ? 'active' : '' }}">
                <i class="fas fa-broom mr-3"></i> Laporan Kebersihan
            </a>
            <a href="{{ route('mahasiswa.barang.index') }}" class="block py-3 px-6 hover:bg-blue-700 {{ request()->routeIs('mahasiswa.barang.*') ? 'active' : '' }}">
                <i class="fas fa-search mr-3"></i> Barang Hilang/Temuan
            </a>
            <a href="#" class="block py-3 px-6 hover:bg-blue-700">
                <i class="fas fa-history mr-3"></i> Riwayat Laporan
            </a>
            <a href="#" class="block py-3 px-6 hover:bg-blue-700">
                <i class="fas fa-user mr-3"></i> Profil
            </a>
            <form method="POST" action="{{ route('logout') }}" class="py-3 px-6 hover:bg-blue-700 cursor-pointer">
                @csrf
                <button type="submit">
                    <i class="fas fa-sign-out-alt mr-3"></i> Logout
                </button>
            </form>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        <header class="bg-white shadow-sm py-4 px-6 flex justify-between items-center">
            <div>
                <h1 class="text-xl font-semibold">@yield('title')</h1>
            </div>
            <div class="flex items-center">
                <div class="mr-4">
                    <span class="text-gray-700">Selamat datang,</span>
                    <span class="font-semibold">{{ auth()->user()->name }}</span>
                </div>
                <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                    <i class="fas fa-user text-red-600"></i>
                </div>
            </div>
        </header>

        <!-- Content -->
        <div class="p-6">
            @yield('content')
        </div>
    </div>
</body>
</html>
