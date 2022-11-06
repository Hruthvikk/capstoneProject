@extends('mainafterlogin')
@section('content')

    @foreach ($recip as $r)
        <span>{{$r->recipeImage}}</span>        
    @endforeach

@endsection