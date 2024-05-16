@extends('layouts.front')

@section('title')
    My Orders
@endsection

@section('content')
    <div class="container py-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="text-white">
                        Order View <a href="{{ url('my-orders') }}" class="btn btn-warning float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 order-details">
                            <h4>Shipping Details</h4>
                            <hr>
                            <label for="">First Name</label>
                            <div class="border">{{ $order->name }}</div>
                            <label for="">Last Name</label>
                            <div class="border">{{ $order->last_name }}</div>
                            <label for="">Email</label>
                            <div class="border">{{ $order->email }}</div>
                            <label for="">Contact Number</label>
                            <div class="border">{{ $order->phone }}</div>
                            <label for="">Shipping Address</label>
                            <div class="border">
                                {{ $order->address1 }}, <br>
                                {{ $order->address2 }}, <br>
                                {{ $order->city }}, <br>
                                {{ $order->state }},
                                {{ $order->country }}
                            </div>
                            <label for="">Zip Code</label>
                            <div class="border">{{ $order->pin_code }}</div>
                        </div>
                        <div class="col-md-6">
                            <h4>Order Details</h4>
                            <hr>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->orderItems as $item)
                                    <tr>
                                        <td>{{ $item->products->name }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>
                                            <img src="{{ asset('assets/uploads/product/' . $item->products->image) }}" width="50px" alt="Product Image">
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <h4 class="px-2">Grand Total: <span class="float-end">{{ $order->total_price }}</span></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
