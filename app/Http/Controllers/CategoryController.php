<?php

namespace App\Http\Controllers;

use App\Models\PlantCategory; // Replace with your actual model name
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = PlantCategory::all();
        return view('admin.plants.categories', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:plantcategories,name',
            'description' => 'nullable|string',
        ]);


        PlantCategory::create($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'Category added successfully.');
    }

    public function edit(PlantCategory $category)
    {
        return view('admin.plants.edit_category', compact('category'));
    }

    public function update(Request $request, PlantCategory $category)
    {
        $request->validate([
            'name' => 'required|string|unique:plantcategories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);


        $category->update($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(PlantCategory $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
