@extends('mainafterlogin')
@section('content')

    @foreach ($recip as $r)
        <span>{{$r->recipeImage}}</span>
        <img src="{{asset('storage/app/public/images/'. $r->recipeImage) }}">
    @endforeach

@endsection