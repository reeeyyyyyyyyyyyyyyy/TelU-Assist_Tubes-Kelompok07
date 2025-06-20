<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportCategoryRequest;
use App\Http\Requests\UpdateReportCategoryRequest;
use App\Models\ReportCategory;

class ReportCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reportCategories = ReportCategory::orderBy('name')->get();
        return view('report-category.index', compact('reportCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('report-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReportCategoryRequest $request)
    {
        try {
            $validated = $request->validated();

            ReportCategory::create($validated);

            return redirect()->route('reportcategory.index')->with('success', 'Report category created successfully.');
        } catch (\Throwable $th) {
            return redirect()->route('reportcategory.create')->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reportCategory = ReportCategory::find($id);
        return view('report-category.show', compact('reportCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reportCategory = ReportCategory::find($id);
        return view('report-category.edit', compact('reportCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReportCategoryRequest $request, string $id)
    {
        try {
            $validated = $request->validated();

            $reportCategory = ReportCategory::find($request->id);
            $reportCategory->update($validated);

            return redirect()->route('reportcategory.index')->with('success', 'Report category updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->route('reportcategory.edit', ['id' => $id])->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reportCategory = ReportCategory::find($id);
        $reportCategory->delete();
        return redirect()->route('reportcategory.index')->with('success', 'Report category deleted successfully.');
    }
}
