@php
if (auth()->user()->role === "admin") {
    $layout_view = "admin";
} elseif (auth()->user()->role === "petugas") {
    $layout_view = "officer";
}
@endphp
@extends("layouts.$layout_view")

@section('title', 'Edit Lokasi')

@section('content')
<div class="mx-auto px-4 py-8 w-full max-w-4xl">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Lokasi</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('location.update', $location->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lokasi</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $location->name) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Kode Lokasi</label>
                    <input type="text" name="code" id="code" value="{{ old('code', $location->code) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="description" id="description" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $location->description) }}</textarea>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <a href="{{ route('location.index') }}" class="btn-secondary px-4 py-2 rounded-lg mr-3">Batal</a>
                <button type="submit" class="btn-primary px-4 py-2 rounded-lg bg-gradient-to-r from-primary to-primaryDark text-white py-3 rounded-lg font-semibold shadow-md">Update Lokasi</button>
            </div>
        </form>
    </div>
</div>
@endsection