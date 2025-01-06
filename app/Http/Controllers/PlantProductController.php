<?php

namespace App\Http\Controllers;

use App\Models\PlantProduct;
use Illuminate\Http\Request;

class PlantProductController extends Controller
{
    // Display a paginated list of plant products for public view
    public function publicIndex()
    {
        $products = PlantProduct::paginate(6); // Public view with pagination
        return view('public.products.index', compact('products'));
    }

    // Display details of a specific product, including its associated plant
    public function publicShow(PlantProduct $product)
    {
        $product->load('plant'); // Eager load the associated plant
        return view('public.products.show', compact('product'));
    }

    // Display a listing of all resources
    public function index()
    {
        $plantProducts = PlantProduct::all();
        return view('welcome', compact('plantProducts'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('plant_products.create');
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'plant_id' => 'nullable|exists:plants,id', // Ensure plant ID is valid
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('uploads', 'public');
            $validated['picture'] = $path;
        }

        PlantProduct::create($validated);

        return redirect()->route('plant-products.index')->with('success', 'Product created successfully.');
    }

    // Display the specified resource
    public function show(PlantProduct $plantProduct)
    {
        return view('plant_products.show', compact('plantProduct'));
    }

    // Show the form for editing the specified resource
    public function edit(PlantProduct $plantProduct)
    {
        return view('plant_products.edit', compact('plantProduct'));
    }

    // Update the specified resource in storage
    public function update(Request $request, PlantProduct $plantProduct)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'plant_id' => 'nullable|exists:plants,id', // Ensure plant ID is valid
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('uploads', 'public');
            $validated['picture'] = $path;
        }

        $plantProduct->update($validated);

        return redirect()->route('plant-products.index')->with('success', 'Product updated successfully.');
    }

    // Remove the specified resource from storage
    public function destroy(PlantProduct $plantProduct)
    {
        $plantProduct->delete();
        return redirect()->route('plant-products.index')->with('success', 'Product deleted successfully.');
    }
}
