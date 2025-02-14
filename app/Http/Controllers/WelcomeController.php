<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\PlantProduct;
use App\Models\Article;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        // Fetch all plants and plant products
        $plants = Plant::all();
        $plantProducts = PlantProduct::all();
        $articles = Article::with('author')->latest()->take(4)->get();


        // Pass both to the welcome view
        return view('welcome', compact('plants', 'plantProducts', 'articles'));

    }
}
