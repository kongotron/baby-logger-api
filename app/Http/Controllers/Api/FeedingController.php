<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Feeding;
use Illuminate\Http\Request;

class FeedingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feedings = Feeding::orderBy('feeding_time', 'desc')->get();
        
        return response()->json([
            'data' => $feedings
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'time' => 'required|date',
            'type' => 'required|string',
            'amount' => 'nullable|numeric',
            'duration' => 'nullable|integer',
            'notes' => 'nullable|string',
        ]);

        $feeding = Feeding::create([
            'feeding_time' => $validated['time'],
            'feeding_type' => $validated['type'],
            'amount_ml' => $validated['amount'] ?? null,
            'duration_minutes' => $validated['duration'] ?? null,
            'notes' => $validated['notes'] ?? null,
        ]);

        return response()->json([
            'data' => $feeding
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $feeding = Feeding::findOrFail($id);
        
        return response()->json([
            'data' => $feeding
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $feeding = Feeding::findOrFail($id);
        
        $validated = $request->validate([
            'time' => 'sometimes|date',
            'type' => 'sometimes|string',
            'amount' => 'nullable|numeric',
            'duration' => 'nullable|integer',
            'notes' => 'nullable|string',
        ]);

        if (isset($validated['time'])) {
            $feeding->feeding_time = $validated['time'];
        }
        if (isset($validated['type'])) {
            $feeding->feeding_type = $validated['type'];
        }
        if (isset($validated['amount'])) {
            $feeding->amount_ml = $validated['amount'];
        }
        if (isset($validated['duration'])) {
            $feeding->duration_minutes = $validated['duration'];
        }
        if (isset($validated['notes'])) {
            $feeding->notes = $validated['notes'];
        }

        $feeding->save();

        return response()->json([
            'data' => $feeding
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $feeding = Feeding::findOrFail($id);
        $feeding->delete();

        return response()->json(null, 204);
    }
}
