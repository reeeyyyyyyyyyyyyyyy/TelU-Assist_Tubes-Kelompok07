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

@section('title', 'Detail Barang Hilang/Temuan')

@section('content')
<div class="mx-auto px-4 py-8 w-full">
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-800">Detail Barang</h1>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Informasi Barang</h2>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-500">Nama Barang</p>
                            <p class="text-gray-800">{{ $item->item_name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Jenis</p>
                            <p class="text-gray-800">{{ $item->type === 'lost' ? 'Hilang' : 'Temuan' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Kategori</p>
                            <p class="text-gray-800">{{ $item->category }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tanggal</p>
                            <p class="text-gray-800">{{ \Carbon\Carbon::parse($item->date)->format('d F Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Status</p>
                            @if($item->type === 'lost')
                                <span class="px-2 py-1 text-xs rounded-full {{ $item->lost_status === 'not_found' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $item->lost_status === 'not_found' ? 'Belum Ditemukan' : 'Sudah Ditemukan' }}
                                </span>
                            @else
                                <span class="px-2 py-1 text-xs rounded-full {{ $item->found_status === 'not_claimed' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $item->found_status === 'not_claimed' ? 'Belum Diambil' : 'Sudah Diambil' }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Detail Pemilik/Penemu</h2>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-500">Nama</p>
                            <p class="text-gray-800">{{ $item->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Dibuat Pada</p>
                            <p class="text-gray-800">{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Deskripsi</h2>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-gray-800">{{ $item->description }}</p>
                </div>
            </div>

            @if($item->photo)
            <div class="mt-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Foto</h2>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <img src="{{ filter_var($item->photo, FILTER_VALIDATE_URL) ? $item->photo : asset('storage/' . $item->photo) }}" alt="Foto Barang" class="max-w-full h-auto rounded-lg">
                </div>
            </div>
            @endif

            <div class="mt-6 flex justify-end space-x-4">
                <a href="{{ route('lostfound.index') }}" class="btn-secondary px-4 py-2 rounded-lg font-medium">
                    Kembali
                </a>
                @if(auth()->user()->role === 'admin' || auth()->user()->id === $item->user_id)
                <a href="{{ route('lostfound.edit', $item->id) }}" class="btn-primary px-4 py-2 bg-gradient-to-r from-primary to-primaryDark text-white rounded-lg font-medium">
                    Edit
                </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
