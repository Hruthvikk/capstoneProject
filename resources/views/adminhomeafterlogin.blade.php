@extends('adminmain')
@section('content')
    <div style="width: 300px; margin: 0 auto;">
        <a href="{{ url('admindalu') }}" class="btn btn-primary">Display all Users Added</a>
        <br><br>
        <a href="{{ url('admindar') }}" class="btn btn-primary">Display all Recipes Added</a>
        <br><br>
        <form action="{{ route('timefil') }}" method="post">
            @csrf
            <label>New users and recipes added within this time range</label>
            <select id="timefil" name="timefil">
                <option value="today">Today</option>
                <option value="week">Week</option>
                <option value="month">Month</option>
            </select>
            <button class="signinupbtn" type="submit">search</button>
        </form>
            <div class="form-group col-md-3">
                @if (Session::has('numus'))
                    <div class="alert alert-success">Users: {{ Session::get('success') }}</div>
                @endif
                @if (Session::has('numre'))
                    <div class="alert alert-success">Recipes: {{ Session::get('success') }}</div>
                @endif
            </div>

    </div>
@endsection
