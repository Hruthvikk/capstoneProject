@extends('mainafterlogin')
@section('content')
    @foreach ($recipeingredata as $rs)
        <div class="displaysteps">
            <h2>Grocery List for Recipe Name: {{ $rs->recipeName }} </h2><br>
            <h4>You need following ingredients to make this recipe:</h4>
            <h2>Ingredients:</h2> <br>
            <h4 class="steps">{{ $rs->ingredients }}</h4>
        </div>
    @endforeach
@endsection
