<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $featured_products = Product::where('trending', 1)->take(15)->get();
        $trending_categories = Category::where('popular', 1)->take(15)->get();
        return view('frontend.index', compact('featured_products', 'trending_categories'));
    }

    public function category()
    {
        $categories = Category::where('status', 0)->get();
        return view('frontend.category', compact('categories'));
    }

    public function viewcategory($slug)
    {
        if ( Category::where('slug', $slug)->exists() ) {
            $category = Category::where('slug', $slug)->first();
            $products = Product::where('category_id', $category->id)->where('status', 0)->get();
            return view('frontend.products.index', compact('category', 'products'));
        } else {
            return redirect('/' )->with('status', 'Slug does not exist.');
        }
    }
}
