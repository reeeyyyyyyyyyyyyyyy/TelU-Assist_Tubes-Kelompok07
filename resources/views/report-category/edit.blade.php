@php
if (auth()->user()->role === "admin") {
    $layout_view = "admin";
} elseif (auth()->user()->role === "petugas") {
    $layout_view = "officer";
}
@endphp
@extends("layouts.$layout_view")

@section('title', 'Edit Report Category')

@section('content')
<div class="mx-auto px-4 py-8 w-full max-w-4xl">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Report Category</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('reportcategory.update', $reportCategory->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $reportCategory->name) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $reportCategory->slug) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" id="description" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $reportCategory->description) }}</textarea>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <a href="{{ route('reportcategory.index') }}" class="btn-secondary px-4 py-2 rounded-lg mr-3">Cancel</a>
                <button type="submit" class="btn-primary px-4 py-2 rounded-lg bg-gradient-to-r from-primary to-primaryDark text-white py-3 rounded-lg font-semibold shadow-md">Update Category</button>
            </div>
        </form>
    </div>
</div>
@endsection