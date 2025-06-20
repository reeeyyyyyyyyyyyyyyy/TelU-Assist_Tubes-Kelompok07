@php
if (auth()->user()->role === "admin") {
    $layout_view = "admin";
} elseif (auth()->user()->role === "mahasiswa") {
    $layout_view = "mahasiswa";
} elseif (auth()->user()->role === "petugas") {
    $layout_view = "officer";
}
@endphp
@extends("layouts.$layout_view")

@section('title', 'Detail Laporan')

@section('content')
<div class="mx-auto px-4 py-8 w-full">
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-800">Detail Laporan</h1>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Informasi Laporan</h2>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-500">Judul</p>
                            <p class="text-gray-800">{{ $report->title }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Kategori</p>
                            <p class="text-gray-800">{{ $report->reportCategory->name ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Lokasi</p>
                            <p class="text-gray-800">{{ $report->location->name ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Status</p>
                            @if($report->status === 'pending')
                                <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                            @elseif($report->status === 'diproses')
                                <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">Diproses</span>
                            @else
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Selesai</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Detail Pelapor</h2>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-500">Nama Pelapor</p>
                            <p class="text-gray-800">{{ $report->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Waktu Laporan</p>
                            <p class="text-gray-800">{{ \Carbon\Carbon::parse($report->reported_at)->format('d F Y H:i') }}</p>
                        </div>
                        @if($report->handled_at)
                        <div>
                            <p class="text-sm text-gray-500">Waktu Selesai</p>
                            <p class="text-gray-800">{{ \Carbon\Carbon::parse($report->handled_at)->format('d F Y H:i') }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Deskripsi</h2>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-gray-800">{{ $report->description }}</p>
                </div>
            </div>

            @if($report->photo)
            <div class="mt-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Foto</h2>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <img src="{{ filter_var($report->photo, FILTER_VALIDATE_URL) ? $report->photo : asset('storage/' . $report->photo) }}" alt="Foto Laporan" class="max-w-full h-auto rounded-lg">
                </div>
            </div>
            @endif

            <div class="mt-6 flex justify-end space-x-4">
                <a href="{{ route('report.index') }}" class="btn-secondary px-4 py-2 rounded-lg font-medium">
                    Kembali
                </a>
                @if(auth()->user()->role === 'admin' || auth()->user()->id === $report->user_id)
                <a href="{{ route('report.edit', $report->id) }}" class="btn-primary px-4 py-2 bg-gradient-to-r from-primary to-primaryDark text-white rounded-lg font-medium">
                    Edit
                </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
