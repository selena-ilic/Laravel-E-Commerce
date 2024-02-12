<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $old_cart_items = Cart::where('user_id', Auth::id())->get();

        foreach ($old_cart_items as $item)
        {
            $product = Product::where('id', $item->product_id)
                ->where('qty', '>=', $item->product_qty)
                ->first();

            if ( $product->qty <= $item->product_qty )
            {
                $remove_item = Cart::where('user_id', Auth::id())
                    ->where('product_id', $item->product_id)
                    ->first();

                $remove_item->delete();
            }
        }

        $cart_items = Cart::where('user_id', Auth::id())->get();

        return view('frontend.checkout', compact('cart_items'));
    }
}
