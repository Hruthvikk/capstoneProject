@extends('adminmain')
@section('content')
    <div style="width: 300px; margin: 0 auto;">
        <a href="{{ url('admindalu') }}" class="btn btn-primary">Display all Users Added</a>
        <br><br>
        <a href="{{ url('admindar') }}" class="btn btn-primary">Display all Recipes Added</a>
    </div>
@endsection
