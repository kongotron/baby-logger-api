<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GrowthMetric;
use Illuminate\Http\Request;

class GrowthMetricController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metrics = GrowthMetric::orderBy('measurement_time', 'desc')->get();
        
        return response()->json([
            'data' => $metrics
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'time' => 'required|date',
            'weight' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'head_circumference' => 'nullable|numeric',
            'notes' => 'nullable|string',
        ]);

        $metric = GrowthMetric::create([
            'measurement_time' => $validated['time'],
            'weight_kg' => $validated['weight'] ?? null,
            'height_cm' => $validated['height'] ?? null,
            'head_circumference_cm' => $validated['head_circumference'] ?? null,
            'notes' => $validated['notes'] ?? null,
        ]);

        return response()->json([
            'data' => $metric
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $metric = GrowthMetric::findOrFail($id);
        
        return response()->json([
            'data' => $metric
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $metric = GrowthMetric::findOrFail($id);
        
        $validated = $request->validate([
            'time' => 'sometimes|date',
            'weight' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'head_circumference' => 'nullable|numeric',
            'notes' => 'nullable|string',
        ]);

        if (isset($validated['time'])) {
            $metric->measurement_time = $validated['time'];
        }
        if (isset($validated['weight'])) {
            $metric->weight_kg = $validated['weight'];
        }
        if (isset($validated['height'])) {
            $metric->height_cm = $validated['height'];
        }
        if (isset($validated['head_circumference'])) {
            $metric->head_circumference_cm = $validated['head_circumference'];
        }
        if (isset($validated['notes'])) {
            $metric->notes = $validated['notes'];
        }

        $metric->save();

        return response()->json([
            'data' => $metric
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $metric = GrowthMetric::findOrFail($id);
        $metric->delete();

        return response()->json(null, 204);
    }
}
