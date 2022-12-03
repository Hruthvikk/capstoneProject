@extends('adminmain')
@section('content')
    <div style="width: 300px; margin: 0 auto;">
        <a href="{{ url('admindalu') }}" class="btn btn-primary">Display all Users Added</a>
        <br><br>
        <a href="{{ url('admindar') }}" class="btn btn-primary">Display all Recipes Added</a>
        <br><br>
        <form action="{{ route('timefil') }}">
            <label>New users and recipes added within this time range</label>
            <select id="timefil" name="timefil">
                <option value="today">Today</option>
                <option value="week">Week</option>
                <option value="month">Month</option>
            </select>
            <input type="submit" value="Search">
        </form>
    </div>
@endsection
