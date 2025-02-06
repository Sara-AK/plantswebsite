<?php
namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\PlantCategory;
use App\Models\Region;
use Illuminate\Http\Request;

class PlantController extends Controller
{
    // Public-facing plants list
    public function publicIndex()
    {
        $plants = Plant::paginate(6); // Public view with pagination
        return view('public.plants.index', compact('plants'));
    }


    public function index()
    {
        $plants = Plant::with(['categories', 'regions'])->get();
        $allCategories = PlantCategory::all();
        $allRegions = Region::all();

        return view('admin.plants.index', compact('plants', 'allCategories', 'allRegions'));
    }






    public function show($id)
    {
        $plant = Plant::findOrFail($id); // Fetch plant by ID, return 404 if not found

        // Fetch related products (products linked to this plant)
        $relatedProducts = $plant->products ?? collect(); // Ensures it's never null

        return view('public.plants.show', compact('plant', 'relatedProducts'));
    }

    public function showSingle($id)
    {
        $plant = Plant::findOrFail($id); // Fetch plant by ID, return 404 if not found

        // Fetch related products (products linked to this plant)
        $relatedProducts = $plant->products ?? collect(); // Ensures it's never null

        return view('plants.show', compact('plant', 'relatedProducts'));
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
