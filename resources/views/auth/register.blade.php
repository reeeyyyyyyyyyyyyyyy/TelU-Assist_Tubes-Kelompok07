<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Tel-U Assist</title>
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
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        .campus-bg {
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 200 200"><rect width="100%" height="100%" fill="%23f0f0f0"/><path d="M50,30 L70,50 L50,70 L30,50 Z M130,30 L150,50 L130,70 L110,50 Z M90,90 L110,110 L90,130 L70,110 Z" fill="%23e3061310" stroke="%23e3061320" stroke-width="1"/></svg>');
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .campus-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(245,245,245,0.95) 100%); */
            z-index: 0;
        }

        .register-card {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border-radius: 16px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .register-card:hover {
            transform: translateY(-5px);
        }

        .input-field:focus {
            box-shadow: 0 0 0 3px rgba(227, 6, 19, 0.2);
        }

        .btn-primary {
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(227, 6, 19, 0.3);
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 16px;
            background: linear-gradient(135deg, rgba(227, 6, 19, 0.1) 0%, rgba(227, 6, 19, 0.05) 100%);
        }
    </style>
</head>
<body class="campus-bg">
    <!-- Header -->
    <header class="py-4 px-6 flex justify-between items-center">
        <div class="flex items-center">
            <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center mr-3">
                <i class="fas fa-hands-helping text-white text-xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-campus">Tel-U <span class="text-primary">Assist</span></h1>
        </div>
        <div>
            <a href="{{ route('login') }}" class="text-secondary hover:text-primary font-medium">Masuk</a>
            <a href="#" class="ml-4 text-secondary hover:text-primary font-medium">Bantuan</a>
        </div>
    </header>

    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row items-center justify-center gap-10">
            <!-- Left Column - Features & Description -->
            <div class="w-full md:w-5/12">
                <h1 class="text-4xl font-bold text-campus mb-4">Bergabung dengan <span class="text-primary">Tel-U Assist</span></h1>
                <p class="text-lg text-gray-700 mb-8">Daftar sekarang untuk mulai melaporkan masalah kebersihan dan barang hilang di lingkungan kampus. Bersama kita wujudkan kampus yang lebih baik!</p>

                <div class="space-y-5 mb-8">
                    <div class="p-5 rounded-lg shadow-md bg-white">
                        <div class="flex items-center">
                            <div class="feature-icon">
                                <i class="fas fa-user-check text-primary text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg text-campus">Akun Mahasiswa</h3>
                                <p class="text-gray-600 mt-1">Daftar menggunakan email Telkom University Anda</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-5 rounded-lg shadow-md bg-white">
                        <div class="flex items-center">
                            <div class="feature-icon">
                                <i class="fas fa-shield-alt text-primary text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg text-campus">Keamanan Terjamin</h3>
                                <p class="text-gray-600 mt-1">Data pribadi Anda terlindungi dengan sistem keamanan terbaik</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-5 rounded-lg shadow-md bg-white">
                        <div class="flex items-center">
                            <div class="feature-icon">
                                <i class="fas fa-bolt text-primary text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg text-campus">Proses Cepat</h3>
                                <p class="text-gray-600 mt-1">Laporan Anda akan segera diproses oleh petugas kami</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center text-gray-600">
                    <div class="flex items-center mr-6">
                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        <span>Verifikasi Email</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-lock text-yellow-500 mr-2"></i>
                        <span>Data Terenkripsi</span>
                    </div>
                </div>
            </div>

            <!-- Right Column - Register Form -->
            <div class="w-full md:w-5/12">
                <div class="register-card bg-white relative overflow-hidden">
                    <!-- Decorative Elements -->
                    <div class="absolute -top-10 -right-10 w-20 h-20 rounded-full bg-red-100 opacity-50"></div>
                    <div class="absolute -bottom-10 -left-10 w-24 h-24 rounded-full bg-red-100 opacity-50"></div>

                    <div class="p-8 relative z-10">
                        <div class="text-center mb-8">
                            <div class="w-20 h-20 rounded-full bg-gradient-to-r from-primary to-primaryDark mx-auto flex items-center justify-center mb-4">
                                <i class="fas fa-user-plus text-white text-3xl"></i>
                            </div>
                            <h2 class="text-3xl font-bold text-gray-800">Buat Akun Baru</h2>
                            <p class="text-gray-600 mt-2">Isi form berikut untuk mendaftar</p>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-5">
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-user text-gray-400"></i>
                                    </div>
                                    <input type="text" id="name" name="name" required autofocus
                                        class="input-field pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                        placeholder="Nama lengkap Anda">
                                </div>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Tel-U</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-envelope text-gray-400"></i>
                                    </div>
                                    <input type="email" id="email" name="email" required
                                        class="input-field pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                        placeholder="email@student.telkomuniversity.ac.id">
                                </div>
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-lock text-gray-400"></i>
                                    </div>
                                    <input type="password" id="password" name="password" required
                                        class="input-field pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                        placeholder="Buat password yang kuat">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <i class="fas fa-eye-slash text-gray-400 cursor-pointer hover:text-gray-600" id="togglePassword"></i>
                                    </div>
                                </div>
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-lock text-gray-400"></i>
                                    </div>
                                    <input type="password" id="password_confirmation" name="password_confirmation" required
                                        class="input-field pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                        placeholder="Ketik ulang password">
                                </div>
                            </div>

                            <div class="mb-5">
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon (Opsional)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-phone text-gray-400"></i>
                                    </div>
                                    <input type="tel" id="phone" name="phone"
                                        class="input-field pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                        placeholder="0812-3456-7890">
                                </div>
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="nim" class="block text-sm font-medium text-gray-700 mb-2">NIM (Opsional)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-id-card text-gray-400"></i>
                                    </div>
                                    <input type="text" id="nim" name="nim"
                                        class="input-field pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                        placeholder="NIM Anda">
                                </div>
                                @error('nim')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center mb-6">
                                <input type="checkbox" id="terms" name="terms" required class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                                <label for="terms" class="ml-2 block text-sm text-gray-700">
                                    Saya menyetujui <a href="#" class="text-primary hover:underline">Syarat & Ketentuan</a> serta <a href="#" class="text-primary hover:underline">Kebijakan Privasi</a>
                                </label>
                            </div>

                            <button type="submit" class="btn-primary w-full bg-gradient-to-r from-primary to-primaryDark text-white py-3 rounded-lg font-semibold shadow-md">Daftar Sekarang</button>
                        </form>

                        <div class="text-center text-sm text-gray-600 mt-6">
                            <p>Sudah punya akun? <a href="{{ route('login') }}" class="text-primary font-medium hover:underline">Masuk disini</a></p>
                        </div>
                    </div>
                </div>

                <div class="mt-6 text-center text-sm text-gray-600">
                    <p>© 2023 Tel-U Assist. Sistem Pelaporan Terpadu Telkom University</p>
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
                <div class="flex space-x-6">
                    <a href="#" class="text-white text-opacity-80 hover:text-white"><i class="fab fa-instagram text-xl"></i></a>
                    <a href="#" class="text-white text-opacity-80 hover:text-white"><i class="fab fa-twitter text-xl"></i></a>
                    <a href="#" class="text-white text-opacity-80 hover:text-white"><i class="fab fa-facebook text-xl"></i></a>
                    <a href="#" class="text-white text-opacity-80 hover:text-white"><i class="fab fa-youtube text-xl"></i></a>
                </div>
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
    </script>
</body>
</html>
