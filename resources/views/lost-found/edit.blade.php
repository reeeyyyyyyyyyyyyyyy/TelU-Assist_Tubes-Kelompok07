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

@section('title', 'Edit Barang Hilang/Temuan')

@section('content')
<div class="mx-auto px-4 py-8 w-full max-w-4xl">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Barang Hilang/Temuan</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('lostfound.update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Tipe</label>
                    <select name="type" id="type" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="lost" {{ $item->type == 'lost' ? 'selected' : '' }}>Hilang</option>
                        <option value="found" {{ $item->type == 'found' ? 'selected' : '' }}>Temuan</option>
                    </select>
                </div>

                <div>
                    <label for="item_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Barang</label>
                    <input type="text" name="item_name" id="item_name" value="{{ old('item_name', $item->item_name) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <input type="text" name="category" id="category" value="{{ old('category', $item->category) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                    <input type="date" name="date" id="date" value="{{ old('date',  $item->date ? \Carbon\Carbon::parse($item->date)->format('Y-m-d') : '') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div class="col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="description" id="description" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ old('description', $item->description) }}</textarea>
                </div>

                <div class="col-span-2">
                    <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">Foto (Opsional)</label>
                    <input type="file" name="photo" id="photo" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @if($item->photo)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $item->photo) }}" alt="Current Photo" class="h-32">
                            <p class="text-sm text-gray-500 mt-1">Foto saat ini</p>
                        </div>
                    @endif
                </div>

                @if ($item->type === 'found')
                <div>
                    <label for="lost_status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="lost_status" id="lost_status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" {{ auth()->user()->role === 'mahasiswa' ? 'disabled' : '' }}>
                        <option value="not_found" {{ $item->lost_status == 'not_found' ? 'selected' : '' }}>Hilang</option>
                        <option value="found" {{ $item->lost_status == 'found' ? 'selected' : '' }}>Ditemukan</option>
                    </select>
                </div>
                @elseif ($item->type === 'lost')
                <div>
                    <label for="found_status" class="block text-sm font-medium text-gray-700 mb-1">Status Temuan</label>
                    <select name="found_status" id="found_status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" {{ auth()->user()->role === 'mahasiswa' ? 'disabled' : '' }}>
                        <option value="not_claimed" {{ $item->found_status == 'not_claimed' ? 'selected' : '' }}>Belum Diambil</option>
                        <option value="claimed" {{ $item->found_status == 'claimed' ? 'selected' : '' }}>Diambil</option>
                    </select>
                </div>
                @endif
            </div>

            <div class="mt-6 flex justify-end">
                <a href="{{ route('lostfound.index') }}" class="btn-secondary px-4 py-2 rounded-lg mr-3">Batal</a>
                <button type="submit" class="btn-primary px-4 py-2 rounded-lg bg-gradient-to-r from-primary to-primaryDark text-white py-3 rounded-lg font-semibold shadow-md">Update Barang</button>
            </div>
        </form>
    </div>
</div>
@endsection
