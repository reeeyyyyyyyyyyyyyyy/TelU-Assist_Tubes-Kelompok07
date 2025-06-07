<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Tel-U Assist Mahasiswa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/mahasiswa.css') }}">
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

        .sidebar {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .nav-link {
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .nav-link:hover, .nav-link.active {
            background-color: rgba(227, 6, 19, 0.05);
            border-left-color: #E30613;
            color: #E30613;
        }

        .admin-content {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }
    </style>
</head>
<body>
    <div class="flex min-h-screen">
    <!-- Sidebar -->
        <div class="sidebar w-64 min-h-screen py-6 px-4">
            <div class="flex items-center mb-8 pl-3">
                <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center mr-3">
                    <i class="fas fa-hands-helping text-white text-xl"></i>
        </div>
                <h1 class="text-xl font-bold text-campus">Tel-U <span class="text-primary">Assist</span> Mahasiswa</h1>
            </div>

            <nav class="space-y-1">
                <a href="{{ route('mahasiswa.dashboard') }}" class="nav-link {{ request()->routeIs('mahasiswa.dashboard') ? 'active' : '' }} block py-3 px-4 rounded-lg">
                    <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                </a>
                <a href="{{ route('report.index') }}" class="nav-link {{ request()->routeIs('report.index') ? 'active' : '' }} block py-3 px-4 rounded-lg">
                    <i class="fas fa-broom mr-3"></i> Kebersihan Reports
                </a>
                <a href="{{ route('lostfound.index') }}" class="nav-link {{ request()->routeIs('lostfound.index') ? 'active' : '' }} block py-3 px-4 rounded-lg">
                    <i class="fas fa-search mr-3"></i> Lost & Found
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link w-full text-left block py-3 px-4 rounded-lg mt-8">
                        <i class="fas fa-sign-out-alt mr-3"></i> Logout
                    </button>
            </form>
        </nav>
    </div>

    <!-- Main Content -->
        <div class="flex-1 flex flex-col " style="width: 50%">
            <!-- Header -->
            <header class="bg-white py-4 px-6 flex justify-between items-center shadow">
            <div>
                    <h2 class="text-xl font-semibold text-campus">@yield('title', 'Dashboard')</h2>
            </div>
            <div class="flex items-center">
                <div class="mr-4">
                        <p class="text-sm font-medium">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-600">{{ auth()->user()->email }}</p>
                </div>
                    <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center">
                        <i class="fas fa-user-cog text-white"></i>
                </div>
            </div>
        </header>

            <!-- Content Area -->
            <main class="admin-content flex-1 p-6">
            @yield('content')
            </main>

            <!-- Footer -->
            <footer class="py-4 px-6 bg-white border-t">
                <div class="flex justify-between items-center">
                    <p class="text-sm text-gray-600">© 2023 Tel-U Assist. Sistem Pelaporan Terpadu Telkom University</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-primary"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-400 hover:text-primary"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-primary"><i class="fab fa-facebook"></i></a>
    </div>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>
