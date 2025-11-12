<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DiaperChange;
use Illuminate\Http\Request;

class DiaperChangeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diapers = DiaperChange::orderBy('change_time', 'desc')->get();
        
        return response()->json([
            'data' => $diapers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'time' => 'required|date',
            'wet' => 'boolean',
            'dirty' => 'boolean',
            'notes' => 'nullable|string',
        ]);

        $diaper = DiaperChange::create([
            'change_time' => $validated['time'],
            'is_wet' => $validated['wet'] ?? false,
            'is_dirty' => $validated['dirty'] ?? false,
            'notes' => $validated['notes'] ?? null,
        ]);

        return response()->json([
            'data' => $diaper
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $diaper = DiaperChange::findOrFail($id);
        
        return response()->json([
            'data' => $diaper
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $diaper = DiaperChange::findOrFail($id);
        
        $validated = $request->validate([
            'time' => 'sometimes|date',
            'wet' => 'boolean',
            'dirty' => 'boolean',
            'notes' => 'nullable|string',
        ]);

        if (isset($validated['time'])) {
            $diaper->change_time = $validated['time'];
        }
        if (isset($validated['wet'])) {
            $diaper->is_wet = $validated['wet'];
        }
        if (isset($validated['dirty'])) {
            $diaper->is_dirty = $validated['dirty'];
        }
        if (isset($validated['notes'])) {
            $diaper->notes = $validated['notes'];
        }

        $diaper->save();

        return response()->json([
            'data' => $diaper
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $diaper = DiaperChange::findOrFail($id);
        $diaper->delete();

        return response()->json(null, 204);
    }
}
