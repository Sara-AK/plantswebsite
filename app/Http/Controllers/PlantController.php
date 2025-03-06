<?php
namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\PlantCategory;
use App\Models\Region;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PlantController extends Controller
{
    // Public-facing plants list
    public function publicIndex(Request $request)
    {
        $query = Plant::query();

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by category
        if ($request->has('category') && !empty($request->category)) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('plantcategories.id', $request->category); // ✅ Explicit table name
            });
        }

        // Sort by name (A-Z or Z-A)
        if ($request->has('sort') && in_array($request->sort, ['asc', 'desc'])) {
            $query->orderBy('name', $request->sort);
        }

        $plants = $query->paginate(6);

        // Fetch all categories for the filter dropdown
        $categories = PlantCategory::all();

        return view('public.plants.index', compact('plants', 'categories'));
    }



    public function index()
    {
        $plants = Plant::with(['categories', 'regions'])->get();
        $allCategories = PlantCategory::all(); // Load all categories
        $allRegions = Region::all(); // Load all regions

        return view('admin.plants.index', compact('plants', 'allCategories', 'allRegions'));
    }



    public function publicShow($id)
    {
        $plant = Plant::findOrFail($id);
        $relatedProducts = $plant->products ?? collect();
        $comments = $plant->comments()->latest()->get();

        return view('public.plants.show', compact('plant', 'relatedProducts', 'comments'));
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

    public function store(Request $request)
    {
        // Validate input fields
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'caredifficulty' => 'required|string|max:255',
            'caretips' => 'nullable|string',
            'pictures' => 'required|url',
            'categories' => 'required|array',
            'categories.*' => 'exists:plantcategories,id',
            'regions' => 'required|array',
            'regions.*' => 'exists:regions,id',
        ]);


        // Create the plant
        $plant = Plant::create($validated);

        // Sync categories and regions
        $plant->categories()->sync($validated['categories']);
        $plant->regions()->sync($validated['regions']);

        return redirect()->route('admin.plants.index')->with('success', 'Plant created successfully.');
    }

    public function destroy(Plant $plant)
    {

        $plant->delete();
        return redirect()->route('admin.plants.index')->with('success', 'Plant deleted successfully.');
    }

    public function edit($id)
    {
        $plant = Plant::with(['categories', 'regions'])->findOrFail($id);
        $allCategories = PlantCategory::all();
        $allRegions = Region::all();

        return view('admin.plants.edit', compact('plant', 'allCategories', 'allRegions'));
    }

    public function update(Request $request, $id)
    {
        $plant = Plant::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'caredifficulty' => 'required|string|max:255',
            'description' => 'required|string',
            'caretips' => 'nullable|string',
            'pictures' => 'required|string',
            'categories' => 'array|required',
            'regions' => 'array|required',
        ]);

        $plant->update([
            'name' => $request->name,
            'caredifficulty' => $request->caredifficulty,
            'description' => $request->description,
            'caretips' => $request->caretips,
            'pictures' => $request->pictures,
        ]);

        $plant->categories()->sync($request->categories);
        $plant->regions()->sync($request->regions);

        return redirect()->route('admin.plants.index')->with('success', 'Plant updated successfully.');
    }

    public function addComment(Request $request, $plantId)
    {
        $request->validate([
            'content' => 'required|string|max:500'
        ]);

        Comment::create([
            'plant_id' => $plantId,
            'user_id' => Auth::id(),
            'content' => $request->content
        ]);

        return back()->with('success', 'Comment added!');
    }


}
