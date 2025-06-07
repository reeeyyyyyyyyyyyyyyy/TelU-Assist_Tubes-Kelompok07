<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tel-U Assist</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
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
    </style>
</head>

<body class="campus-bg">
    <!-- Header -->
    <header class="py-4 px-6 flex justify-between items-center z-10 relative">
        <div class="flex items-center">
            <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center mr-3">
                <a href="/" class="block w-full h-full flex items-center justify-center">
                    <i class="fas fa-hands-helping text-white text-xl"></i>
                </a>
            </div>
            <h1 class="text-2xl font-bold text-campus">Tel-U <span class="text-primary">Assist</span></h1>
        </div>
        <div>
            <a href="#" class="text-secondary hover:text-primary font-medium">Tentang Kami</a>
            <a href="#" class="ml-4 text-secondary hover:text-primary font-medium">Bantuan</a>
        </div>
    </header>

    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row items-center justify-center gap-10">
            <!-- Left Column - Features & Description -->
            <div class="w-full md:w-5/12">
                <h1 class="text-4xl font-bold text-campus mb-4">Sistem Terpadu Pelaporan <span
                        class="text-primary">Tel-U Assist</span></h1>
                <p class="text-lg text-gray-700 mb-8">Laporkan masalah kebersihan dan barang hilang di lingkungan kampus
                    dengan mudah dan cepat. Bersama kita wujudkan kampus yang lebih baik!</p>

                <div class="space-y-5 mb-8">
                    <div class="feature-card p-5 rounded-lg shadow-md">
                        <div class="flex items-center">
                            <div class="feature-icon">
                                <i class="fas fa-broom text-primary text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg text-campus">Lapor Kebersihan</h3>
                                <p class="text-gray-600 mt-1">Laporkan area kampus yang memerlukan perhatian kebersihan
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="feature-card p-5 rounded-lg shadow-md">
                        <div class="flex items-center">
                            <div class="feature-icon">
                                <i class="fas fa-search text-primary text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg text-campus">Cari Barang Hilang</h3>
                                <p class="text-gray-600 mt-1">Temukan barang yang hilang atau laporkan penemuan barang
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="feature-card p-5 rounded-lg shadow-md">
                        <div class="flex items-center">
                            <div class="feature-icon">
                                <i class="fas fa-chart-line text-primary text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg text-campus">Pantau Status Laporan</h3>
                                <p class="text-gray-600 mt-1">Lacak perkembangan laporan yang telah Anda kirimkan</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center text-gray-600">
                    <div class="flex items-center mr-6">
                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        <span>Aman & Terpercaya</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-bolt text-yellow-500 mr-2"></i>
                        <span>Respon Cepat</span>
                    </div>
                </div>
            </div>

            <!-- Right Column - Login Form -->
            <div class="w-full md:w-5/12">
                <div class="login-card bg-white relative overflow-hidden">
                    <!-- Decorative Elements -->
                    <div
                        class="absolute -top-10 -right-10 w-20 h-20 rounded-full bg-red-100 opacity-50 pointer-events-none">
                    </div>
                    <div
                        class="absolute -bottom-10 -left-10 w-24 h-24 rounded-full bg-red-100 opacity-50 pointer-events-none">
                    </div>


                    <div class="p-8 relative z-10">
                        <div class="text-center mb-8">
                            <div
                                class="w-20 h-20 rounded-full bg-gradient-to-r from-primary to-primaryDark mx-auto flex items-center justify-center mb-4 floating pulse">
                                <i class="fas fa-user-lock text-white text-3xl"></i>
                            </div>
                            <h2 class="text-3xl font-bold text-gray-800">Masuk ke Akun Anda</h2>
                            <p class="text-gray-600 mt-2">Gunakan akun Tel-U untuk mengakses sistem</p>
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-5">
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email
                                    Tel-U</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-envelope text-gray-400"></i>
                                    </div>
                                    <input type="email" id="email" value="admin@telkomuniversity.ac.id"
                                        name="email"
                                        class="input-field pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                        placeholder="email@student.telkomuniversity.ac.id" required>
                                </div>
                            </div>

                            <div class="mb-5">
                                <label for="password"
                                    class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-lock text-gray-400"></i>
                                    </div>
                                    <input type="password" value="password123" id="password" name="password"
                                        class="input-field pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                        placeholder="Masukkan password" required>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <i class="fas fa-eye-slash text-gray-400 cursor-pointer hover:text-gray-600"
                                            id="togglePassword"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center">
                                    <input type="checkbox" id="remember" name="remember"
                                        class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                                    <label for="remember" class="ml-2 block text-sm text-gray-700">Ingat saya</label>
                                </div>
                                <a href="#" class="text-sm text-primary hover:text-primaryDark font-medium">Lupa
                                    password?</a>
                            </div>

                            <button type="submit"
                                class="btn-primary w-full bg-gradient-to-r from-primary to-primaryDark text-white py-3 rounded-lg font-semibold shadow-md">Masuk</button>

                            {{-- <div class="divider my-6">atau</div>

                            <div class="flex justify-center space-x-4 mb-6">
                                <button class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center hover:bg-gray-200 transition">
                                    <i class="fab fa-google text-red-500 text-xl"></i>
                                </button>
                                <button class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center hover:bg-gray-200 transition">
                                    <i class="fab fa-microsoft text-blue-500 text-xl"></i>
                                </button>
                                <button class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center hover:bg-gray-200 transition">
                                    <i class="fab fa-apple text-gray-800 text-xl"></i>
                                </button>
                            </div> --}}
                        </form>

                        <div class="text-center text-sm text-gray-600">
                            <p class="text-center text-sm text-gray-500 mt-6">
                                Belum punya akun? <a href="{{ route('register') }}"
                                    class="text-red-600 hover:underline">Daftar sekarang</a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-6 text-center text-sm text-gray-600">
                    <p>© 2025 Tel-U Assist. Sistem Pelaporan Terpadu Telkom University</p>
                    <p class="mt-1">Jl. Telekomunikasi No. 1, Terusan Buahbatu, Bandung 40257</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="py-6 bg-gradient-to-r from-primary to-primaryDark mt-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-white mb-4 md:mb-0">
                    <h3 class="text-xl font-semibold">Tel-U Assist</h3>
                    <p class="text-white text-opacity-80">Membantu menjaga kebersihan dan keamanan kampus</p>
                </div>
                {{-- <div class="flex space-x-6">
                    <a href="#" class="text-white text-opacity-80 hover:text-white"><i class="fab fa-instagram text-xl"></i></a>
                    <a href="#" class="text-white text-opacity-80 hover:text-white"><i class="fab fa-twitter text-xl"></i></a>
                    <a href="#" class="text-white text-opacity-80 hover:text-white"><i class="fab fa-facebook text-xl"></i></a>
                    <a href="#" class="text-white text-opacity-80 hover:text-white"><i class="fab fa-youtube text-xl"></i></a>
                </div> --}}
            </div>
        </div>
    </footer>

    <script>
        // Toggle password visibility
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        // Simulate form submission
        // document.querySelector('form').addEventListener('submit', function(e) {
        //     e.preventDefault();
        //     const email = document.getElementById('email').value;
        //     const password = document.getElementById('password').value;

        //     // Simple validation
        //     if(email && password) {
        //         // Show loading state
        //         const btn = document.querySelector('.btn-primary');
        //         btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...';
        //         btn.disabled = true;

        //         // Simulate API call
        //         setTimeout(() => {
        //             alert('Login berhasil! Mengarahkan ke dashboard...');
        //             btn.innerHTML = 'Masuk';
        //             btn.disabled = false;
        //         }, 1500);
        //     } else {
        //         alert('Harap isi email dan password');
        //     }
        // });
    </script>
</body>

</html>
