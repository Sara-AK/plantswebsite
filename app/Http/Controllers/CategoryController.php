<?php

namespace App\Http\Controllers;

use App\Models\PlantCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = PlantCategory::all();
        return view('admin.categories.index', compact('categories'));
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

    public function destroy(PlantCategory $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }

    public function edit(PlantCategory $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, PlantCategory $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
    }

}
