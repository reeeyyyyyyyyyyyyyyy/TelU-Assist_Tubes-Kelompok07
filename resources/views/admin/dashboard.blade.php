@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>

    <!-- Grafik -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Grafik Laporan Bulanan -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Laporan Bulan Ini</h2>
            <div class="h-64">
                <canvas id="monthlyReportsChart"></canvas>
            </div>
        </div>

        <!-- Grafik Barang Hilang/Temuan -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Barang Hilang/Ditemukan</h2>
            <div class="h-64">
                <canvas id="lostFoundChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Statistik Utama -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Total Laporan -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-2">Total Laporan</h2>
            <p class="text-3xl font-bold text-blue-600">{{ $totalReports }}</p>
        </div>

        <!-- Laporan Pending -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-2">Pending</h2>
            <p class="text-3xl font-bold text-yellow-600">{{ $pendingReports }}</p>
        </div>

        <!-- Laporan Diproses -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-2">Diproses</h2>
            <p class="text-3xl font-bold text-purple-600">{{ $inProgressReports }}</p>
        </div>

        <!-- Laporan Selesai -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-2">Selesai</h2>
            <p class="text-3xl font-bold text-green-600">{{ $completedReports }}</p>
        </div>
    </div>

    <!-- Statistik Pengguna -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Pengguna -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-2">Total Pengguna</h2>
            <p class="text-3xl font-bold text-indigo-600">{{ $totalUsers }}</p>
        </div>

        <!-- Mahasiswa -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-2">Mahasiswa</h2>
            <p class="text-3xl font-bold text-cyan-600">{{ $mahasiswaUsers }}</p>
        </div>

        <!-- Petugas -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-2">Petugas</h2>
            <p class="text-3xl font-bold text-orange-600">{{ $petugasUsers }}</p>
        </div>
    </div>

    <!-- Statistik Barang Hilang/Temuan -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Total Barang Hilang -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-2">Barang Hilang</h2>
            <p class="text-3xl font-bold text-red-600">{{ $totalLostItems }}</p>
        </div>

        <!-- Total Barang Ditemukan -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-2">Barang Ditemukan</h2>
            <p class="text-3xl font-bold text-green-600">{{ $totalFoundItems }}</p>
        </div>

        <!-- Barang Belum Dikembalikan -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-2">Belum Dikembalikan</h2>
            <p class="text-3xl font-bold text-yellow-600">{{ $unclaimedItems }}</p>
        </div>

        <!-- Barang Hilang Ditemukan -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-2">Telah Ditemukan</h2>
            <p class="text-3xl font-bold text-blue-600">{{ $foundLostItems }}</p>
        </div>
    </div>

    <!-- Statistik Kategori -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Kategori Barang -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Barang per Kategori</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($itemCategories as $category)
                <div class="border rounded p-4">
                    <h3 class="font-medium">{{ $category->category ?? 'Lainnya' }}</h3>
                    <p class="text-2xl mt-2">{{ $category->count }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>


</div>
<!-- Sertakan Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Grafik Laporan Bulanan
        const reportCtx = document.getElementById('monthlyReportsChart').getContext('2d');
        new Chart(reportCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($monthlyLabels) !!},
                datasets: [{
                    label: 'Jumlah Laporan',
                    data: {!! json_encode($monthlyData) !!},
                    backgroundColor: 'rgba(59, 130, 246, 0.5)',
                    borderColor: 'rgb(59, 130, 246)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

        // Grafik Barang Hilang/Temuan
        const lostFoundCtx = document.getElementById('lostFoundChart').getContext('2d');
        new Chart(lostFoundCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($monthlyLabels) !!},
                datasets: [
                    {
                        label: 'Barang Hilang',
                        data: {!! json_encode($monthlyLostItems) !!},
                        backgroundColor: 'rgba(239, 68, 68, 0.2)',
                        borderColor: 'rgb(239, 68, 68)',
                        borderWidth: 2,
                        tension: 0.1
                    },
                    {
                        label: 'Barang Ditemukan',
                        data: {!! json_encode($monthlyFoundItems) !!},
                        backgroundColor: 'rgba(16, 185, 129, 0.2)',
                        borderColor: 'rgb(16, 185, 129)',
                        borderWidth: 2,
                        tension: 0.1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
