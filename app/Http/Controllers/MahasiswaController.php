<?php

namespace App\Http\Controllers;

use App\Models\LostFoundItem;
use App\Models\Report;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function dashboard()
    {
        $userId = auth()->user()->id;
    
        // Data statistik laporan kebersihan
        $totalReports = Report::where('user_id', $userId)->count();
        $processedReports = Report::where('user_id', $userId)
            ->where('status', 'diproses')
            ->count();
        $completedReports = Report::where('user_id', $userId)
            ->where('status', 'selesai')
            ->count();

        // Laporan kebersihan terbaru (max 2)
        $latestCleanlinessReports = Report::where('user_id', $userId)
            ->latest()
            ->take(2)
            ->get();

        // Data laporan barang terbaru (max 2)
        $latestLostFoundItems = LostFoundItem::where('user_id', $userId)
            ->latest()
            ->take(2)
            ->get();

        return view('mahasiswa.dashboard', [
            'totalReports' => $totalReports,
            'processedReports' => $processedReports,
            'completedReports' => $completedReports,
            'latestCleanlinessReports' => $latestCleanlinessReports,
            'latestLostFoundItems' => $latestLostFoundItems,
        ]);
    }

    public function kebersihanIndex()
    {
        return view('mahasiswa.kebersihan.index');
    }

    public function kebersihanCreate()
    {
        return view('mahasiswa.kebersihan.create');
    }

    public function barangIndex()
    {
        return view('mahasiswa.barang.index');
    }

    public function barangCreate()
    {
        return view('mahasiswa.barang.create');
    }
}
