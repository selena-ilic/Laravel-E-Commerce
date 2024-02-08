@extends('layouts.front')

@section('title')
    My Cart
@endsection

@section('content')

    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{ url('/') }}">Home</a>
                /
                <a href="{{ url('/cart') }}">Cart</a>
            </h6>
        </div>
    </div>

    <div class="container my-5">
        <div class="card shadow product_data">
            <div class="card-body">
                @php $total = 0; @endphp
                @foreach($cart_items as $item)
                    <div class="row product_data">
                        <div class="col-md-2 my-auto">
                            <img src="{{ asset('assets/uploads/product/' . $item->product->image) }}" height="70px" alt="Image here">
                        </div>
                        <div class="col-md-2 my-auto">
                            <h6>{{ $item->product->name }}</h6>
                        </div>
                        <div class="col-md-2 my-auto">
                            <h6>${{ $item->product->selling_price }}</h6>
                        </div>
                        <div class="col-md-3 my-auto">
                            <input type="hidden" value="{{ $item->product_id }}" class="product_id">
                            <label for="Quantity">Quantity</label>
                            <div class="input-group text-center mb-3" style="width:130px">
                                <button class="input-group-text change-quantity decrement-btn">-</button>
                                <input type="text" name="quantity" class="form-control qty-input text-center" value="{{ $item->product_qty }}">
                                <button class="input-group-text change-quantity increment-btn">+</button>
                            </div>
                        </div>
                        <div class="col-md-2 my-auto">
                            <button class="btn btn-danger delete-cart-item"> <i class="fa fa-trash"></i> Remove</button>
                        </div>
                    </div>
                    @php $total += $item->product->selling_price * $item->product_qty; @endphp
                @endforeach
            </div>
            <div class="card-footer">
                <h6>
                    Total Price ${{ $total }}
                    <a href="{{ url('checkout') }}" class="btn btn-outline-success float-end">Proceed to Checkout</a>
                </h6>
            </div>
        </div>
    </div>

@endsection



