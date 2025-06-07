@extends('layouts.mahasiswa')

@section('title', 'Dashboard Mahasiswa')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Statistik Laporan -->
    <div class="card bg-white p-6">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Total Laporan</h2>
                <p class="text-3xl font-bold mt-2">{{ $totalReports }}</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                <i class="fas fa-file-alt text-red-600 text-xl"></i>
            </div>
        </div>
    </div>

    <div class="card bg-white p-6">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Laporan Diproses</h2>
                <p class="text-3xl font-bold mt-2">{{ $processedReports }}</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center">
                <i class="fas fa-spinner text-yellow-600 text-xl"></i>
            </div>
        </div>
    </div>

    <div class="card bg-white p-6">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Laporan Selesai</h2>
                <p class="text-3xl font-bold mt-2">{{ $completedReports }}</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                <i class="fas fa-check-circle text-green-600 text-xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Laporan Terbaru -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Laporan Kebersihan Terbaru -->
    <div class="card bg-white p-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Laporan Kebersihan Terbaru</h2>
        <div class="space-y-4">
            @foreach($latestCleanlinessReports as $report)
            <div class="border-b pb-4">
                <div class="flex justify-between">
                    <h3 class="font-medium text-gray-800">{{ $report->title }}</h3>
                    <span class="px-2 py-1 text-xs rounded-full 
                        @if($report->status == 'pending') bg-yellow-100 text-yellow-800
                        @elseif($report->status == 'diproses') bg-blue-100 text-blue-800
                        @else bg-green-100 text-green-800 @endif">
                        {{ ucfirst($report->status) }}
                    </span>
                </div>
                <p class="text-sm text-gray-600 mt-1">{{ $report->location->name }}</p>
                <p class="text-sm text-gray-500 mt-2">{{ $report->reported_at ? \Carbon\Carbon::parse($report->reported_at)->diffForHumans() : '' }}</p>
            </div>
            @endforeach
        </div>
        <a href="{{ route('report.index') }}" class="btn-primary mt-4 py-2 px-4 rounded-lg inline-block">
            Lihat Semua <i class="fas fa-arrow-right ml-2"></i>
        </a>
    </div>

    <!-- Laporan Barang Terbaru -->
    <div class="card bg-white p-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Laporan Barang Terbaru</h2>
        <div class="space-y-4">
            @foreach($latestLostFoundItems as $item)
            <div class="border-b pb-4">
                <div class="flex justify-between">
                    <h3 class="font-medium text-gray-800">{{ $item->item_name }}</h3>
                    <span class="px-2 py-1 text-xs rounded-full 
                        @if($item->type == 'lost' && $item->lost_status == 'not_found') bg-yellow-100 text-yellow-800
                        @elseif($item->type == 'lost' && $item->lost_status == 'found') bg-green-100 text-green-800
                        @elseif($item->type == 'found' && $item->found_status == 'not_claimed') bg-blue-100 text-blue-800
                        @else bg-green-100 text-green-800 @endif">
                        @if($item->type == 'lost')
                            {{ $item->lost_status == 'not_found' ? 'Belum Ditemukan' : 'Ditemukan' }}
                        @else
                            {{ $item->found_status == 'not_claimed' ? 'Belum Dikembalikan' : 'Dikembalikan' }}
                        @endif
                    </span>
                </div>
                <p class="text-sm text-gray-600 mt-1">{{ $item->description }}</p>
                <p class="text-sm text-gray-500 mt-2">{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->diffForHumans() : '' }}</p>
            </div>
            @endforeach
        </div>
        <a href="{{ route('lostfound.index') }}" class="btn-primary mt-4 py-2 px-4 rounded-lg inline-block">
            Lihat Semua <i class="fas fa-arrow-right ml-2"></i>
        </a>
    </div>
</div>

<!-- Quick Actions -->
<div class="mt-8">
    <h2 class="text-xl font-semibold mb-4 text-gray-800">Aksi Cepat</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <a href="{{ route('report.create') }}" class="card bg-white p-6 flex items-center hover:shadow-lg transition">
            <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center mr-4">
                <i class="fas fa-broom text-red-600 text-xl"></i>
            </div>
            <div>
                <h3 class="font-semibold text-gray-800">Buat Laporan Kebersihan</h3>
                <p class="text-sm text-gray-600">Laporkan masalah kebersihan di kampus</p>
            </div>
        </a>

        <a href="{{ route('lostfound.create') }}" class="card bg-white p-6 flex items-center hover:shadow-lg transition">
            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mr-4">
                <i class="fas fa-search text-blue-600 text-xl"></i>
            </div>
            <div>
                <h3 class="font-semibold text-gray-800">Laporkan Barang Hilang/Temuan</h3>
                <p class="text-sm text-gray-600">Laporkan barang yang hilang atau ditemukan</p>
            </div>
        </a>
    </div>
</div>
@endsection
