<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tel-U Assist - Sistem Pelaporan Terpadu Kampus</title>
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

        .hero-section {
            background: linear-gradient(135deg, rgba(227, 6, 19, 0.9) 0%, rgba(193, 5, 16, 0.9) 100%);
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .feature-card {
            transition: transform 0.3s ease;
            border-left: 4px solid #E30613;
            background-color: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(4px);
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #E30613, #C10510);
            color: white;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(227, 6, 19, 0.2);
            position: relative;
            z-index: 10;
            pointer-events: auto;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 14px rgba(227, 6, 19, 0.3);
        }

        .btn-outline {
            border: 2px solid #E30613;
            color: #E30613;
            transition: all 0.3s;
        }

        .btn-outline:hover {
            background: #E30613;
            color: white;
            transform: translateY(-3px);
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(227, 6, 19, 0.4); }
            70% { box-shadow: 0 0 0 12px rgba(227, 6, 19, 0); }
            100% { box-shadow: 0 0 0 0 rgba(227, 6, 19, 0); }
        }
    </style>
</head>
<body class="campus-bg">
    <!-- Header Navigation -->
    <header class="py-4 px-6 flex justify-between items-center bg-white z-50 relative shadow">
        <div class="flex items-center">
            <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center mr-3">
                <a href="/" class="fas fa-hands-helping text-white text-xl"></a>
            </div>
            <h1 class="text-2xl font-bold text-campus">Tel-U <span class="text-primary">Assist</span></h1>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('login') }}" class="text-secondary hover:text-primary font-medium z-10">Masuk</a>
            <a href="{{ route('register') }}" class="bg-primary text-white py-2 px-4 rounded-lg font-medium hover:bg-primaryDark transition z-10">Daftar</a>
        </div>
    </header>


    <!-- Hero Section -->
    <section class="container mx-auto px-4 py-12">
        <div class="hero-section flex flex-col md:flex-row items-center p-8 md:p-12">
            <div class="w-full md:w-1/2 text-white mb-8 md:mb-0">
                <h1 class="text-3xl md:text-4xl font-bold mb-4">Selamat Datang di Tel-U Assist</h1>
                <p class="text-xl mb-6">Sistem Terpadu Pelaporan Kebersihan & Barang Hilang di Lingkungan Kampus Telkom University</p>
                <p class="mb-8">Bergabunglah dengan komunitas kampus yang peduli untuk menciptakan lingkungan belajar yang lebih bersih, aman, dan nyaman.</p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('register') }}" class="btn-primary py-3 px-6 rounded-lg text-center font-semibold">
                        <i class="fas fa-user-plus mr-2"></i> Daftar Sekarang
                    </a>
                    <a href="{{ route('login') }}" class="btn-outline py-3 px-6 rounded-lg text-center font-semibold">
                        <i class="fas fa-sign-in-alt mr-2"></i> Masuk ke Akun
                    </a>
                </div>
            </div>
            <div class="w-full md:w-1/2 flex justify-center">
                <div class="w-64 h-64 md:w-80 md:h-80 rounded-full bg-white bg-opacity-20 flex items-center justify-center floating">
                    <div class="w-48 h-48 md:w-60 md:h-60 rounded-full bg-white bg-opacity-30 flex items-center justify-center">
                        <div class="w-32 h-32 md:w-40 md:h-40 rounded-full bg-white flex items-center justify-center pulse">
                            <i class="fas fa-hands-helping text-primary text-4xl md:text-5xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="container mx-auto px-4 py-12">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-campus mb-4">Fitur Unggulan Tel-U Assist</h2>
            <p class="text-lg text-gray-700 max-w-2xl mx-auto">Kami menyediakan solusi terintegrasi untuk semua kebutuhan pelaporan di lingkungan kampus</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="feature-card p-6 rounded-lg">
                <div class="w-14 h-14 rounded-full bg-red-100 flex items-center justify-center mb-4">
                    <i class="fas fa-broom text-primary text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-campus mb-2">Laporan Kebersihan</h3>
                <p class="text-gray-600">Laporkan masalah kebersihan seperti ruangan kotor, tumpahan, atau sampah menumpuk di lingkungan kampus dengan mudah dan cepat.</p>
            </div>

            <div class="feature-card p-6 rounded-lg">
                <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center mb-4">
                    <i class="fas fa-search text-primary text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-campus mb-2">Barang Hilang/Temuan</h3>
                <p class="text-gray-600">Laporkan barang yang hilang atau temukan barang milik orang lain. Sistem kami akan membantu menghubungkan penemu dengan pemilik.</p>
            </div>

            <div class="feature-card p-6 rounded-lg">
                <div class="w-14 h-14 rounded-full bg-green-100 flex items-center justify-center mb-4">
                    <i class="fas fa-chart-line text-primary text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-campus mb-2">Pantau Status Laporan</h3>
                <p class="text-gray-600">Lacak perkembangan laporan Anda secara real-time. Ketahui kapan laporan Anda ditangani dan diselesaikan.</p>
            </div>

            <div class="feature-card p-6 rounded-lg">
                <div class="w-14 h-14 rounded-full bg-yellow-100 flex items-center justify-center mb-4">
                    <i class="fas fa-map-marker-alt text-primary text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-campus mb-2">Lokasi Kampus</h3>
                <p class="text-gray-600">Temukan dan laporkan masalah berdasarkan lokasi spesifik di kampus Telkom University.</p>
            </div>

            <div class="feature-card p-6 rounded-lg">
                <div class="w-14 h-14 rounded-full bg-purple-100 flex items-center justify-center mb-4">
                    <i class="fas fa-bell text-primary text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-campus mb-2">Notifikasi Real-time</h3>
                <p class="text-gray-600">Dapatkan pemberitahuan instan ketika laporan Anda ditanggapi atau ketika ada perkembangan baru.</p>
            </div>

            <div class="feature-card p-6 rounded-lg">
                <div class="w-14 h-14 rounded-full bg-pink-100 flex items-center justify-center mb-4">
                    <i class="fas fa-shield-alt text-primary text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-campus mb-2">Keamanan Data</h3>
                <p class="text-gray-600">Data pribadi Anda dilindungi dengan sistem keamanan terbaik dan enkripsi tingkat tinggi.</p>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="container mx-auto px-4 py-12 bg-white rounded-2xl shadow-lg">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-campus mb-4">Cara Kerja Tel-U Assist</h2>
            <p class="text-lg text-gray-700 max-w-2xl mx-auto">Hanya dalam 3 langkah sederhana, Anda dapat berkontribusi menciptakan kampus yang lebih baik</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-20 h-20 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4">
                    <span class="text-3xl font-bold text-primary">1</span>
                </div>
                <h3 class="text-xl font-semibold text-campus mb-2">Buat Akun</h3>
                <p class="text-gray-600">Daftar sebagai mahasiswa Telkom University dengan NIM dan email kampus Anda.</p>
            </div>

            <div class="text-center">
                <div class="w-20 h-20 rounded-full bg-blue-100 flex items-center justify-center mx-auto mb-4">
                    <span class="text-3xl font-bold text-primary">2</span>
                </div>
                <h3 class="text-xl font-semibold text-campus mb-2">Laporkan Masalah</h3>
                <p class="text-gray-600">Pilih jenis laporan (kebersihan atau barang), isi formulir, dan kirim laporan Anda.</p>
            </div>

            <div class="text-center">
                <div class="w-20 h-20 rounded-full bg-green-100 flex items-center justify-center mx-auto mb-4">
                    <span class="text-3xl font-bold text-primary">3</span>
                </div>
                <h3 class="text-xl font-semibold text-campus mb-2">Pantau & Selesai</h3>
                <p class="text-gray-600">Lacak status laporan Anda dan dapatkan notifikasi ketika masalah selesai ditangani.</p>
            </div>
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('register') }}" class="btn-primary py-3 px-8 rounded-lg inline-block text-lg">
                Mulai Sekarang <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="container mx-auto px-4 py-12">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-campus mb-4">Apa Kata Pengguna Kami</h2>
            <p class="text-lg text-gray-700 max-w-2xl mx-auto">Dengarkan pengalaman langsung dari Mahasiswa Telkom University</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center mr-4">
                        <i class="fas fa-user text-primary"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold">Muhammad Rayhan Ramadhan</h4>
                        <p class="text-sm text-gray-600">Mahasiswa Sistem Informasi</p>
                    </div>
                </div>
                <p class="text-gray-700">"Saya kehilangan dompet di kantin, dan berkat Tel-U Assist, dompet saya ditemukan dalam waktu 2 hari! Sistem ini sangat membantu."</p>
                <div class="flex text-yellow-400 mt-4">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mr-4">
                        <i class="fas fa-user text-primary"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold">Zahra Anisa Inayah</h4>
                        <p class="text-sm text-gray-600">Mahasiswa Sistem Informasi</p>
                    </div>
                </div>
                <p class="text-gray-700">"Setelah melaporkan tumpahan minuman di lab, petugas datang dalam waktu 30 menit. Respons yang sangat cepat dan memuaskan!"</p>
                <div class="flex text-yellow-400 mt-4">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="container mx-auto px-4 py-12 z-10 relative">
        <div class="bg-gradient-to-r from-red-600 to-red-700 rounded-2xl p-8 md:p-12 text-center text-white shadow-md">
            <h2 class="text-2xl md:text-3xl font-bold mb-4">Siap Membuat Perubahan di Kampus?</h2>
            <p class="text-lg mb-6 max-w-2xl mx-auto">
                Bergabunglah dengan ribuan mahasiswa Telkom University yang sudah menggunakan <strong>Tel-U Assist</strong> untuk menciptakan lingkungan kampus yang lebih baik.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <!-- Tombol Daftar -->
                <a href="{{ route('register') }}"
                class="bg-white text-red-600 py-3 px-8 rounded-lg font-semibold shadow hover:bg-gray-100 transition duration-300 ease-in-out z-20 relative">
                    Daftar Gratis Sekarang
                </a>

                <!-- Tombol Masuk -->
                <a href="{{ route('login') }}"
                class="bg-transparent border-2 border-white text-white py-3 px-8 rounded-lg font-semibold hover:bg-white hover:text-red-600 transition duration-300 ease-in-out z-20 relative">
                    Masuk ke Akun
                </a>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer class="py-8 bg-gradient-to-r from-primary to-primaryDark">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-white mb-6 md:mb-0">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center mr-3">
                            <i class="fas fa-hands-helping text-primary text-xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold">Tel-U Assist</h3>
                    </div>
                    <p class="text-white text-opacity-80 mt-2">Membantu menjaga kebersihan dan keamanan kampus</p>
                </div>
                <div class="flex flex-col items-center md:items-end">
                    {{-- <div class="flex space-x-6 mb-4">
                        <a href="#" class="text-white text-opacity-80 hover:text-white"><i class="fab fa-instagram text-xl"></i></a>
                        <a href="#" class="text-white text-opacity-80 hover:text-white"><i class="fab fa-twitter text-xl"></i></a>
                        <a href="#" class="text-white text-opacity-80 hover:text-white"><i class="fab fa-facebook text-xl"></i></a>
                        <a href="#" class="text-white text-opacity-80 hover:text-white"><i class="fab fa-youtube text-xl"></i></a>
                    </div> --}}
                    <p class="text-white text-opacity-80 text-sm">© 2025 Tel-U Assist. Sistem Pelaporan Terpadu Telkom University</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
