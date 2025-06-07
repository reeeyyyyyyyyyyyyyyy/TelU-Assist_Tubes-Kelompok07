<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Tel-U Assist</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <!-- Sidebar -->
    <div class="flex h-screen">
        <div class="w-64 bg-blue-800 text-white p-4">
            <h1 class="text-2xl font-bold mb-8">Tel-U Assist</h1>
            <nav>
                <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 rounded hover:bg-blue-700 mb-2">
                    <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                </a>
                <a href="#" class="block py-2 px-4 rounded hover:bg-blue-700 mb-2">
                    <i class="fas fa-users mr-2"></i> Manage Users
                </a>
                <a href="#" class="block py-2 px-4 rounded hover:bg-blue-700 mb-2">
                    <i class="fas fa-broom mr-2"></i> Kebersihan
                </a>
                <a href="#" class="block py-2 px-4 rounded hover:bg-blue-700 mb-2">
                    <i class="fas fa-search mr-2"></i> Barang Hilang
                </a>
                <form method="POST" action="{{ route('logout') }}" class="mt-8">
                    @csrf
                    <button type="submit" class="w-full text-left block py-2 px-4 rounded hover:bg-blue-700">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            @yield('content')
        </div>
    </div>
</body>
</html>
