<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLostFoundItemRequest;
use App\Http\Requests\UpdateLostFoundItemRequest;
use App\Models\LostFoundItem;
use DB;
use Storage;

class LostFoundItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = LostFoundItem::with(['user'])
            ->whereHas('user', function ($q) {
                if (auth()->user()->role === 'mahasiswa') {
                    $q->where('id', auth()->user()->id);
                }
            })
            ->orderBy('date','desc')
            ->get();
        return view('lost-found.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lost-found.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLostFoundItemRequest $request)
    {
        try {
            $validated = $request->validated();
            $validated['user_id'] = auth()->user()->id;

            if ($request->hasFile('photo')) {
                $validated['photo'] = $request->file('photo')->store('lost-found-photos', 'public');
            }

            LostFoundItem::create($validated);

            return redirect()->route('lostfound.index')->with('success', 'Item created successfully.');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->route('lostfound.create')->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = LostFoundItem::with(['user'])->find($id);
        return view('lost-found.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = LostFoundItem::with(['user'])->find($id);


        return view('lost-found.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLostFoundItemRequest $request, string $id)
    {
        try {
            $validated = $request->validated();
            $validated['user_id'] = auth()->user()->id;

            $item = LostFoundItem::with(['user'])->find($id);

            if ($request->hasFile('photo')) {
                if ($item->photo) {
                    Storage::disk('public')->delete($item->photo);
                }
                $validated['photo'] = $request->file('photo')->store('lost-found-photos', 'public');
            }

            $item->update($validated);

            return redirect()->route('lostfound.index')->with('success', 'Item updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->route('lostfound.edit', ['id' => $id])->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lostFoundItem = LostFoundItem::find($id);

        if ($lostFoundItem->photo) {
            Storage::disk('public')->delete($lostFoundItem->photo);
        }

        $lostFoundItem->delete();

        return redirect()->route('lostfound.index')->with('success', 'Item deleted successfully.');
    }
}
