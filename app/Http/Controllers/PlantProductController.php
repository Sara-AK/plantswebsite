<?php

namespace App\Http\Controllers;
use App\Models\PlantProduct;
use Illuminate\Http\Request;

class PlantProductController extends Controller
{

    public function publicIndex()
    {
        $products = PlantProduct::paginate(6); // Public view with pagination
        return view('public.products.index', compact('products'));
    }

    public function publicShow(PlantProduct $product)
    {
        return view('public.products.show', compact('product')); // Details page for a product
    }


    //Display a listing of the resource.
    public function index()
    {
        // Fetch all plant products
        $plantProducts = PlantProduct::all();

        // Pass the data to the welcome view
        return view('welcome', compact('plantProducts'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('plant_products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('uploads', 'public');
            $validated['picture'] = $path;
        }

        PlantProduct::create($validated);

        return redirect()->route('plant-products.index')->with('success', 'Product created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(PlantProduct $plantProduct)
    {
        return view('plant_products.show', compact('plantProduct'));
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PlantProduct $plantProduct)
    {
        return view('plant_products.edit', compact('plantProduct'));
    }

    public function update(Request $request, PlantProduct $plantProduct)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('uploads', 'public');
            $validated['picture'] = $path;
        }

        $plantProduct->update($validated);

        return redirect()->route('plant-products.index')->with('success', 'Product updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlantProduct $plantProduct)
    {
        $plantProduct->delete();
        return redirect()->route('plant-products.index')->with('success', 'Product deleted successfully.');
    }

}
