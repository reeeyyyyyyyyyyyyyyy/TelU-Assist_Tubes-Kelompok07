
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

@section('title', 'Laporan Kebersihan')

@section('content')
<div class="mx-auto px-4 py-8 w-full">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Laporan Kebersihan</h1>
        <a href="{{ route('report.create') }}" class="btn-primary px-2 bg-gradient-to-r from-primary to-primaryDark text-white py-3 rounded-lg font-semibold shadow-md">
            <i class="fas fa-plus mr-2"></i> Buat Laporan
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelapor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($reports as $report)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $report->title }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{ $report->location->name ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{ $report->user->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($report->status === 'pending')
                                <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                            @elseif($report->status === 'diproses')
                                <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">Diproses</span>
                            @else
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Selesai</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{ $report->reported_at ? \Carbon\Carbon::parse($report->reported_at)->diffForHumans() : '' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('report.show', $report->id) }}" class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('report.edit', $report->id) }}" class="text-yellow-600 hover:text-yellow-900 mr-3"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('report.destroy', $report->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection