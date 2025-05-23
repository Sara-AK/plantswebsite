<?php

namespace App\Http\Controllers;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::all();
        return view('admin.regions.index', compact('regions'));
    }

    public function create()
    {
        return view('regions.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:regions']);
        Region::create($request->all());
        return redirect()->route('admin.regions.index')->with('success', 'Region added!');
    }

    public function destroy(Region $region)
    {
        $region->delete();
        return redirect()->route('admin.regions.index')->with('success', 'Region deleted!');
    }

    public function edit(Region $region)
    {
        return view('admin.regions.edit', compact('region'));
    }

    public function update(Request $request, Region $region)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $region->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.regions.index')->with('success', 'Region updated successfully!');
    }

}
