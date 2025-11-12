<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sleep;
use Illuminate\Http\Request;

class SleepController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sleeps = Sleep::orderBy('start_time', 'desc')->get();
        
        return response()->json([
            'data' => $sleeps
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'start_time' => 'required|date',
            'end_time' => 'nullable|date',
            'duration' => 'nullable|integer',
            'quality' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $sleep = Sleep::create([
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'] ?? null,
            'duration_minutes' => $validated['duration'] ?? null,
            'sleep_quality' => $validated['quality'] ?? null,
            'notes' => $validated['notes'] ?? null,
        ]);

        return response()->json([
            'data' => $sleep
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sleep = Sleep::findOrFail($id);
        
        return response()->json([
            'data' => $sleep
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sleep = Sleep::findOrFail($id);
        
        $validated = $request->validate([
            'start_time' => 'sometimes|date',
            'end_time' => 'nullable|date',
            'duration' => 'nullable|integer',
            'quality' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        if (isset($validated['start_time'])) {
            $sleep->start_time = $validated['start_time'];
        }
        if (isset($validated['end_time'])) {
            $sleep->end_time = $validated['end_time'];
        }
        if (isset($validated['duration'])) {
            $sleep->duration_minutes = $validated['duration'];
        }
        if (isset($validated['quality'])) {
            $sleep->sleep_quality = $validated['quality'];
        }
        if (isset($validated['notes'])) {
            $sleep->notes = $validated['notes'];
        }

        $sleep->save();

        return response()->json([
            'data' => $sleep
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sleep = Sleep::findOrFail($id);
        $sleep->delete();

        return response()->json(null, 204);
    }
}
