@extends('layouts.front')

@section('title')
    Category
@endsection

@section('content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>All Categories</h2>
                    <div class="row">
                        @foreach($categories as $category)
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <img src="{{ asset('assets/uploads/category/' . $category->image) }}" alt="Category Image">
                                    <div class="card-body">
                                        <h5>{{ $category->name }}</h5>
                                        <p>{{ $category->description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

