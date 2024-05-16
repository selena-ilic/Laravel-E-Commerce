<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $old_cart_items = Cart::where('user_id', Auth::id())->get();

        foreach ($old_cart_items as $item)
        {
            if ( ! Product::where('id', $item->product_id)->where('qty', '>=', $item->product_qty)->exists() )
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

    public function placeorder(Request $request)
    {
        $order = new Order();
        $order->user_id = Auth::id();
        $order->name = $request->input('name');
        $order->last_name = $request->input('last_name');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->address1 = $request->input('address1');
        $order->address2 = $request->input('address2');
        $order->city = $request->input('city');
        $order->state = $request->input('state');
        $order->country = $request->input('country');
        $order->pin_code = $request->input('pin_code');

        // To calculate the total price
        $total = 0;
        $cart_items_total = Cart::where('user_id', Auth::id())->get();

        foreach ($cart_items_total as $item) {
            $total += $item->product->selling_price * $item->product_qty;
        }

        $order->total_price = $total;
        $order->tracking_no = 'selena' . rand(1111, 9999);
        $order->save();

        $cart_items = Cart::where('user_id', Auth::id())->get();

        foreach ( $cart_items as $item ) {
            OrderItem::create( [
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'qty' => $item->product_qty,
                'price' => $item->product->selling_price
            ] );

            $product = Product::where('id', $item->product_id)->first();

            $product->qty = $product->qty - $item->product_qty;
            $product->update();
        }

        if ( Auth::user()->address1 == null)
        {
            $user = User::where('id', Auth::id())->first();
            $user->name = $request->input('name');
            $user->last_name = $request->input('last_name');
            $user->phone = $request->input('phone');
            $user->address1 = $request->input('address1');
            $user->address2 = $request->input('address2');
            $user->city = $request->input('city');
            $user->state = $request->input('state');
            $user->country = $request->input('country');
            $user->pin_code = $request->input('pin_code');
            $user->update();
        }

        $cart_items = Cart::where('user_id', Auth::id())->get();
        Cart::destroy( $cart_items );

        return redirect('/')->with('status', 'Order placed Successfully');
    }
}


