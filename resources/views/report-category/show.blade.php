@php
if (auth()->user()->role === "admin") {
    $layout_view = "admin";
} elseif (auth()->user()->role === "petugas") {
    $layout_view = "officer";
}
@endphp
@extends("layouts.$layout_view")

@section('title', 'Detail Kategori Laporan')

@section('content')
<div class="mx-auto px-4 py-8 w-full">
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-800">Detail Kategori Laporan</h1>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Informasi Kategori</h2>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-500">Nama</p>
                            <p class="text-gray-800">{{ $reportCategory->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Slug</p>
                            <p class="text-gray-800">{{ $reportCategory->slug }}</p>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Detail Tambahan</h2>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-500">Dibuat Pada</p>
                            <p class="text-gray-800">{{ \Carbon\Carbon::parse($reportCategory->created_at)->format('d F Y H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Diperbarui Pada</p>
                            <p class="text-gray-800">{{ \Carbon\Carbon::parse($reportCategory->updated_at)->format('d F Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            @if($reportCategory->description)
            <div class="mt-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Deskripsi</h2>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-gray-800">{{ $reportCategory->description }}</p>
                </div>
            </div>
            @endif

            <div class="mt-6 flex justify-end space-x-4">
                <a href="{{ route('reportcategory.index') }}" class="btn-secondary px-4 py-2 rounded-lg font-medium">
                    Kembali
                </a>
                <a href="{{ route('reportcategory.edit', $reportCategory->id) }}" class="btn-primary px-4 py-2 bg-gradient-to-r from-primary to-primaryDark text-white rounded-lg font-medium">
                    Edit
                </a>
            </div>
        </div>
    </div>
</div>
@endsection