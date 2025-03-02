<?php

namespace App\Http\Controllers;

use App\Models\PlantProduct;
use App\Models\Plant;
use App\Models\ProductCategory;
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
                $q->where('product_categories.id', $request->category);
            });
        }

        // 🔽 Sorting (Name A-Z or Z-A)
        if ($request->filled('sort')) {
            $query->orderBy('name', $request->sort);
        }

        // ✅ Paginate (6 per page)
        $products = $query->paginate(6);

        // Fetch all categories for the filter dropdown
        $categories = ProductCategory::all();

        return view('public.products.index', compact('products', 'categories'));
    }


    // Display details of a specific product, including its associated plant
    public function publicShow(PlantProduct $product)
    {
        $product->load('plant'); // Eager load the associated plant
        return view('public.products.show', compact('product'));
    }

    // Display all plant products for admins
    public function index()
    {
        $plantProducts = PlantProduct::with('plant')->get(); // Get products with associated plants
        $allPlants = Plant::all(); // Get all plants for dropdown

        return view('admin.products.index', compact('plantProducts', 'allPlants'));
    }

    // Show the form for creating a new product
    public function create()
    {
        $plants = Plant::all();
        $categories = ProductCategory::all(); // Fetch all categories

        return view('public.products.create', compact('plants', 'categories'));
    }

    // Store a newly created product
    public function store(Request $request)
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

        // ✅ Assign the logged-in user's ID as the seller_id
        $validated['seller_id'] = auth()->id();

        PlantProduct::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    // Display a single product
    public function show(PlantProduct $plantProduct)
    {
        return view('public.products.show', compact('plantProduct'));
    }

    // Show the form for editing an existing product
    public function edit(PlantProduct $product)
    {
        $categories = ProductCategory::all();

        return view('public.products.edit', compact('product', 'categories'));
    }

    // Update a product
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

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    // Remove a product from storage
    public function destroy(PlantProduct $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    // Manage products for admins and sellers
    public function manageProducts()
    {
        $products = auth()->user()->role === 'admin'
            ? PlantProduct::paginate(10)
            : PlantProduct::where('seller_id', auth()->id())->paginate(10);

        return view('admin.products.index', compact('products'));
    }
}
