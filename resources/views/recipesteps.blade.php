@extends('mainafterlogin')
@section('content')
        @foreach ($recipestepdata as $rs )
        <div class="gridviewrecip">
        <div class="gridv1">
            <h2>Recipe Name: {{$rs->recipeName}} </h2><br>
            <h2>Steps:</h2> <br>       
            <h4 class="steps">{{$rs->steps}}</h4>
        </div>
        </div>
        @endforeach
    
@endsection