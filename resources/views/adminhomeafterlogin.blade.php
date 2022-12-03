@extends('adminmain')
@section('content')
    <div style="width: 300px; margin: 0 auto;">
        <a href="{{ url('admindalu') }}" class="btn btn-primary">Display all Users Added</a>
        <br><br>
        <a href="{{ url('admindar') }}" class="btn btn-primary">Display all Recipes Added</a>
        <br><br>
        <a href="">
        <select id="timefil" name="timefil">
            <option value="today">Today</option>
            <option value="week">Week</option>
            <option value="month">Month</option>
        </select>
        </a>
    </div>
@endsection
