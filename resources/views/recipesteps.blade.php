@extends('mainafterlogin')
@section('content')
        @foreach ($recipestepdata as $rs )
    <div>
            <h2>Recipe Name: {{$rs->recipeName}} </h2><br>
            <h2>Steps:</h2> <br>       
            <h4>{{$rs->steps}}</h4>
    </div>
        @endforeach
    
@endsection