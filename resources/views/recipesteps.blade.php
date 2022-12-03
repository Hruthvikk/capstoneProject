@extends('mainafterlogin')
@section('content')
    @foreach ($recipestepdata as $rs)
        <div class="displaysteps">
            <h2>Recipe Name: {{ $rs->recipeName }} </h2><br>
            <h2>Steps:</h2> <br>
            <h4 class="steps">{{ $rs->steps }}</h4>
        </div>
        <div style="margin-left:10%;">
            <br>
            <a href="{{url('message')}}" class="edbtn">Ask a question to chef?</a>
        </div>
    @endforeach
@endsection
