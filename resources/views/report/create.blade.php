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

@section('title', 'Buat Laporan Baru')

@section('content')
@if(session('error'))
<div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4">
    <div class="flex items-center">
        <i class="fas fa-exclamation-circle mr-2"></i>
        <p>{{ session('error') }}</p>
    </div>
</div>
@endif
<div class="mx-auto px-4 py-8 w-full max-w-4xl">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Buat Laporan Baru</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('report.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-2">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Laporan</label>
                    <input type="text" name="title" value="{{ old('title') }}" id="title" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div>
                    <label for="report_category_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori Laporan</label>
                    <select name="report_category_id" id="report_category_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('report_category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="location_id" class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                    <select name="location_id" id="location_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="description" id="description" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ old('description') }}</textarea>
                </div>

                <div class="col-span-2">
                    <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">Foto (Opsional)</label>
                    <input type="file" name="photo" id="photo" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <a href="{{ route('report.index') }}" class="btn-secondary px-4 py-2 rounded-lg mr-3">Batal</a>
                <button type="submit" class="btn-primary px-4 py-2 rounded-lg bg-gradient-to-r from-primary to-primaryDark text-white py-3 rounded-lg font-semibold shadow-md">Simpan Laporan</button>
            </div>
        </form>
    </div>
</div>
@endsection