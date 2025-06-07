<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Report;

class ReportApiController extends Controller
{
    public function index()
    {
        $report = Report::limit(15)->with(['user', 'reportCategory', 'location'])->latest()->get();
        
        return response()->json([
            'success' => true,
            'data' => $report->toArray(),
        ]);
    }
}