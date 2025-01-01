<?php
namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;

class PlantController extends Controller
{
    // Public-facing plants list
    public function publicIndex()
    {
        $plants = Plant::paginate(6); // Public view with pagination
        return view('public.plants.index', compact('plants'));
    }

    // Admin-facing plants list
    public function adminIndex()
    {
        $plants = Plant::all(); // Fetch all plants for admin
        return view('admin.plants.index', compact('plants'));
    }

    // Public-facing single plant details
    public function show(Plant $plant)
    {
        return view('public.plants.show', compact('plant'));
    }

    // Admin-facing plant editing
    public function adminEdit(Plant $plant)
    {
        return view('admin.plants.edit', compact('plant'));
    }

    // Store or Update plant (used by admin)
    public function storeOrUpdate(Request $request, Plant $plant = null)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'picture_url' => 'nullable|url',
        ]);

        if ($plant) {
            $plant->update($validated); // Update existing plant
        } else {
            Plant::create($validated); // Create new plant
        }

        return redirect()->route('admin.plants.index')->with('success', 'Plant saved!');
    }
}
