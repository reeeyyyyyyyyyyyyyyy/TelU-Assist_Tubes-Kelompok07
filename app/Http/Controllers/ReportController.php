<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Report;
use App\Models\ReportCategory;
use Illuminate\Http\Request;
use Storage;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = Report::with(['user', 'reportCategory', 'location'])
            ->whereHas('user', function ($q) {
                if (auth()->user()->role === 'mahasiswa') { 
                    $q->where('id', auth()->user()->id);
                }
            })
            ->orderBy('reported_at','desc')
            ->get();
        return view('report.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ReportCategory::all();
        $locations = Location::all();
        return view('report.create', compact('categories', 'locations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            //code...
            $validated = $request->validate([
                'report_category_id' => 'required|exists:report_categories,id',
                'location_id' => 'required|exists:locations,id',
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'status' => 'sometimes|in:pending,diproses,selesai'
            ]);

            $validated['user_id'] = auth()->user()->id;
            
            if ($request->hasFile('photo')) {
                $validated['photo'] = $request->file('photo')->store('report-photos', 'public');
            }
            
            Report::create($validated);
            
            return redirect()->route('report.index')->with('success', 'Report created successfully.');
        } catch (\Throwable $th) {
            return redirect()->route('report.create')->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $report = Report::with(['user', 'reportCategory', 'location'])->find($id);
        return view('report.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $report = Report::with(['user', 'reportCategory', 'location'])->find($id);
        $categories = ReportCategory::all();
        $locations = Location::all();
        return view('report.edit', compact('report', 'categories', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            //code...
            $validated = $request->validate([
                'report_category_id' => 'sometimes|exists:report_categories,id',
                'location_id' => 'sometimes|exists:locations,id',
                'title' => 'sometimes|string|max:255',
                'description' => 'sometimes|string',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'status' => 'sometimes|in:pending,diproses,selesai'
            ]);

            $validated['user_id'] = auth()->user()->id;
            
            $report = Report::with(['user', 'reportCategory', 'location'])->find($id);
            
            if ($request->hasFile('photo')) {
                // Delete old photo if exists
                if ($report->photo) {
                    Storage::disk('public')->delete($report->photo);
                }
                $validated['photo'] = $request->file('photo')->store('report-photos', 'public');
            }
            
            $report->update($validated);
            
            return redirect()->route('report.index')->with('success', 'Report updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->route('report.edit', ['id' => $id])->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        if ($report->photo) {
            Storage::disk('public')->delete($report->photo);
        }

        $report->delete();

        return redirect()->route('report.index')->with('success', 'Report deleted successfully.');
    }
}
