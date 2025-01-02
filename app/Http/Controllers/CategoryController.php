<?php

namespace App\Http\Controllers;

use App\Models\PlantCategory; // Replace with your actual model name
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of all categories.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = PlantCategory::all(); // Fetch all categories
        return view('categories.index', compact('categories'));
    }

    /**
     * Display the specified category with its related plants.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $category = PlantCategory::with('plants')->findOrFail($id); // Find category and load related plants
        return view('categories.show', compact('category'));
    }
}
