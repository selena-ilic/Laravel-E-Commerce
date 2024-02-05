<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addProduct(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');

        if (Auth::check()) {
            $product = Product::where('id', $product_id)->first();

            if ($product) {
                if ( Cart::where('product_id', $product_id)->where('user_id', Auth::id())->exists() ) {
                    return response()->json(['status' => $product->name . ' is Already in the Cart.']);
                } else {
                    $cartItem = new Cart();
                    $cartItem->product_id = $product_id;
                    $cartItem->user_id = Auth::id();
                    $cartItem->product_qty = $product_qty;
                    $cartItem->save();

                    return response()->json(['status' => $product->name . ' Added to Cart.']);
                }
            }
        } else {
            return response()->json(['status' => 'Login to Continue.']);
        }
    }
}
