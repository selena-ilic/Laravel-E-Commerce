@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1>{{Auth::user()->name}} coder</h1>
        </div>
    </div>
@endsection
