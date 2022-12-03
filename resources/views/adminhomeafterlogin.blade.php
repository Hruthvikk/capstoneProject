@extends('adminmain')
@section('content')
    <h2>
        <a href="{{ url('admindalu') }}" class="btn btn-primary">Display all Users Added</a>
        <br><br>
        <a href="{{ url('admindar') }}" class="btn btn-primary">Display all Recipes Added</a>
    </h2>
@endsection
