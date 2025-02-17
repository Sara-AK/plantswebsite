<?php

namespace App\Http\Controllers;

use App\Models\PlantProduct;
use App\Models\Plant;
use Illuminate\Http\Request;

class PlantProductController extends Controller
{
    // Display a paginated list of plant products for public view
    public function publicIndex(Request $request)
    {
        $query = PlantProduct::query();

        // 🔍 Search by product name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 🔹 Filter by Category (if selected)
        if ($request->filled('category')) {
            $query->whereHas('productCategories', function ($q) use ($request) {
                $q->where('productcategory.id', $request->category); 
            });
        }

        // 🔽 Sorting (Name A-Z or Z-A)
        if ($request->filled('sort')) {
            $query->orderBy('name', $request->sort);
        }

        // ✅ Paginate (6 per page)
        $products = $query->paginate(6);

        // Fetch all categories for the filter dropdown
        $categories = \App\Models\ProductCategory::all();

        return view('public.products.index', compact('products', 'categories'));
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
        // if (auth()->user()->role !== 'admin' && auth()->user()->role !== 'seller') {
        //     abort(403, 'Unauthorized action.');
        // }

        $plants = Plant::all();

        return view('public.products.create', compact('plants'));
    }

    public function store(Request $request)
    {
        // if (!auth()->check() || !in_array(auth()->user()->role, ['admin', 'seller'])) {
        //     abort(403, 'Unauthorized action.');
        // }

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

        return redirect()->route('admin.products')->with('success', 'Product created successfully.');
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
        // if (auth()->user()->role !== 'admin' && auth()->id() !== $product->seller_id) {
        //     abort(403, 'Unauthorized action.');
        // }

        return view('public.products', compact('product'));
    }


    // Update the specified resource in storage
    public function update(Request $request, PlantProduct $product)
    {

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

        return redirect()->route('admin.products')->with('success', 'Product updated successfully.');
    }


    // Remove the specified resource from storage
    public function destroy(PlantProduct $product)
    {
        // Allow only admins and the product's seller to delete
        // if (auth()->user()->role !== 'admin' && auth()->id() !== $product->seller_id) {
        //     abort(403, 'Unauthorized action.');
        // }

        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Product deleted successfully.');
    }


    public function manageProducts()
    {
        // Admins see all products, Sellers see only their own products
        $products = auth()->user()->role === 'admin'
            ? PlantProduct::paginate(10)
            : PlantProduct::where('seller_id', auth()->id())->paginate(10);

        return view('public.products', compact('products'));
    }



}
