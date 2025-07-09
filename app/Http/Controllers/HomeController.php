<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get featured products (limit to 4 for the featured section)
        $featuredProducts = Product::active()
            ->featured()
            ->inStock()
            ->take(4)
            ->get();

        return view('home', compact('featuredProducts'));
    }
}