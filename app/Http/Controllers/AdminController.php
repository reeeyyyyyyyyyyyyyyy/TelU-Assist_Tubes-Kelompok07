<?php

namespace App\Http\Controllers;

use App\Models\LostFoundItem;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalReports' => Report::count(),
            'pendingReports' => Report::where('status', 'pending')->count(),
            'inProgressReports' => Report::where('status', 'diproses')->count(),
            'completedReports' => Report::where('status', 'selesai')->count(),

            'totalUsers' => User::count(),
            'mahasiswaUsers' => User::where('role', 'mahasiswa')->count(),
            'petugasUsers' => User::where('role', 'petugas')->count(),

            'monthlyData' => Report::whereMonth('reported_at', now()->month)
                ->selectRaw('DATE_FORMAT(reported_at, "%d %b") as day, COUNT(*) as count')
                ->groupBy('day')
                ->get()
                ->pluck('count', 'day')
                ->toArray(),
            'totalLostItems' => LostFoundItem::where( 'type', 'lost')->count(),
            'totalFoundItems' => LostFoundItem::where('type', 'found')->count(),
            'unclaimedItems' => LostFoundItem::where('type', 'found')
                ->where('found_status', 'not_claimed')->count(),
            'foundLostItems' => LostFoundItem::where('type', 'lost')
                ->where('lost_status', 'found')->count(),

            // Data kategori barang hilang/temuan
            'itemCategories' => LostFoundItem::select('category')
                ->selectRaw('count(*) as count')
                ->groupBy('category')
                ->orderByDesc('count')
                ->limit(5)
                ->get(),

            // Data bulanan untuk chart
            'monthlyLostItems' => LostFoundItem::where('type', 'lost')
                ->whereMonth('date', now()->month)
                ->selectRaw('DATE_FORMAT(date, "%d %b") as day, COUNT(*) as count')
                ->groupBy('day')
                ->get()
                ->pluck('count', 'day')
                ->toArray(),

            'monthlyFoundItems' => LostFoundItem::where('type', 'found')
                ->whereMonth('date', now()->month)
                ->selectRaw('DATE_FORMAT(date, "%d %b") as day, COUNT(*) as count')
                ->groupBy('day')
                ->get()
                ->pluck('count', 'day')
                ->toArray(),
            'monthlyLabels' => array_map(
                fn($day) => now()->startOfMonth()->addDays($day - 1)->format('d M'),
                range(1, now()->endOfMonth()->day)
            )
        ]);
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return back()->with('success', 'Role updated successfully');
    }
}
