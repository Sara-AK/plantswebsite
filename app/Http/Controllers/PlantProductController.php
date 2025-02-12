<?php

namespace App\Http\Controllers;

use App\Models\PlantProduct;
use App\Models\Plant;
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

    public function index()
    {
        $plantProducts = PlantProduct::with('plant')->get(); // Get products with associated plants
        $allPlants = Plant::all(); // Get all plants for dropdown

        return view('admin.products.index', compact('plantProducts', 'allPlants'));
    }




    // Show the form for creating a new resource
    public function create()
    {
        // Ensure only sellers and admins can access
        if (auth()->user()->role !== 'admin' && auth()->user()->role !== 'seller') {
            abort(403, 'Unauthorized action.');
        }

        $plants = \App\Models\Plant::all();

        return view('public.products.create', compact('plants'));
    }

    public function store(Request $request)
    {
        if (!auth()->check() || !in_array(auth()->user()->role, ['admin', 'seller'])) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'plant_id' => 'nullable|exists:plants,id',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('uploads', 'public');
            $validated['picture'] = $path;
        }

        // ✅ Assign the logged-in user's ID as the seller_id
        $validated['seller_id'] = auth()->id();

        PlantProduct::create($validated);

        return redirect()->route('admin.products.manage')->with('success', 'Product created successfully.');
    }


    // Display the specified resource
    public function show(PlantProduct $plantProduct)
    {
        return view('public.products.show', compact('plantProduct'));
    }

    // Show the form for editing the specified resource
    public function edit(PlantProduct $product)
    {
        // Allow only admins and the product's seller to edit
        if (auth()->user()->role !== 'admin' && auth()->id() !== $product->seller_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('public.products.edit', compact('product'));
    }


    // Update the specified resource in storage
    public function update(Request $request, PlantProduct $product)
    {
        // Allow only admins and the product's seller to update
        if (auth()->user()->role !== 'admin' && auth()->id() !== $product->seller_id) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'plant_id' => 'nullable|exists:plants,id',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('uploads', 'public');
            $validated['picture'] = $path;
        }

        $product->update($validated);

        return redirect()->route('admin.products.manage')->with('success', 'Product updated successfully.');
    }


    // Remove the specified resource from storage
    public function destroy(PlantProduct $product)
    {
        // Allow only admins and the product's seller to delete
        if (auth()->user()->role !== 'admin' && auth()->id() !== $product->seller_id) {
            abort(403, 'Unauthorized action.');
        }

        $product->delete();
        return redirect()->route('admin.products.manage')->with('success', 'Product deleted successfully.');
    }


    public function manageProducts()
    {
        if (!auth()->check() || !in_array(auth()->user()->role, ['admin', 'seller'])) {
            abort(403, 'Unauthorized action.');
        }

        // Admins see all products, Sellers see only their own products
        $products = auth()->user()->role === 'admin'
            ? PlantProduct::paginate(10)
            : PlantProduct::where('seller_id', auth()->id())->paginate(10);

        return view('public.products.manage', compact('products'));
    }



}
