<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::active()->with('orderItems');

        // Filter by category if provided
        if ($request->has('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('short_description', 'like', '%' . $request->search . '%');
            });
        }

        // Sort functionality
        $sort = $request->get('sort', 'default');
        switch ($sort) {
            case 'price-low':
                $query->orderByRaw('COALESCE(sale_price, price) ASC');
                break;
            case 'price-high':
                $query->orderByRaw('COALESCE(sale_price, price) DESC');
                break;
            case 'name':
                $query->orderBy('name', 'ASC');
                break;
            case 'popular':
                $query->withCount('orderItems')->orderBy('order_items_count', 'DESC');
                break;
            default:
                $query->orderBy('featured', 'DESC')->orderBy('created_at', 'DESC');
        }

        $products = $query->paginate(12);

        // Get categories for filter
        $categories = [
            'all' => 'Semua Produk',
            'satin' => 'Bucket Satin',
            'money' => 'Bucket Money',
            'kawat' => 'Bucket Kawat',
            'glitter' => 'Bucket Glitter',
            'custom' => 'Bucket Custom',
            'special' => 'Bucket Special',
        ];

        return view('shop', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::active()->findOrFail($id);
        
        // Get related products from the same category
        $relatedProducts = Product::active()
            ->where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('product-details', compact('product', 'relatedProducts'));
    }
}