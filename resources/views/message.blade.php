@extends('mainafterlogin')
@section('content')
<div class="recipeform">
    <h2>Ask a question to chef</h2>
    <br>
    <h2>Question?</h2>
    <div>
        <form>
            @csrf
            <textarea cols="100" rows="25"></textarea>
        </form>
    </div>
@endsection
