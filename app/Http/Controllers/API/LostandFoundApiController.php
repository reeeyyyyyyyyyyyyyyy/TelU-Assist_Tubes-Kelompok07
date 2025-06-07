<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\LostFoundItem;

class LostandFoundApiController extends Controller
{
    public function index()
    {
        $lostfound = LostFoundItem::limit(15)->with(['user'])->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $lostfound->toArray(),
        ]);
    }
}
