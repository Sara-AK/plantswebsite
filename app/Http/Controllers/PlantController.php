<?php
namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;

class PlantController extends Controller
{
    public function publicIndex()
    {
        $plants = Plant::all(); // Fetch all plants for users.
        return view('plants.index', compact('plants')); // User-facing view
    }

    public function publicShow(Plant $plant)
    {
        return view('plants.show', compact('plant')); // Details page for a plant
    }



    public function index()
    {
        $plants = Plant::all();
        return view('plants.index', compact('plants'));
    }

    public function create()
    {
        return view('plants.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'pictures' => 'nullable|string',
            'caredifficulty' => 'nullable|string',
            'caretips' => 'nullable|string',
        ]);

        Plant::create($validated);

        return redirect()->route('plants.index')->with('success', 'Plant added successfully!');
    }

    public function edit(Plant $plant)
    {
        return view('plants.edit', compact('plant'));
    }

    public function update(Request $request, Plant $plant)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'pictures' => 'nullable|string',
            'caredifficulty' => 'nullable|string',
            'caretips' => 'nullable|string',
        ]);

        $plant->update($validated);

        return redirect()->route('plants.index')->with('success', 'Plant updated successfully!');
    }

    public function destroy(Plant $plant)
    {
        $plant->delete();

        return redirect()->route('plants.index')->with('success', 'Plant deleted successfully!');
    }
}
