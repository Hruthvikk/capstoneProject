@extends('mainafterlogin')
@section('content')
<div class="recipeform">
    <h2>Ask a question to chef</h2>
    <br>
    <h2>Question?</h2>
    <form>
        @csrf
        <textarea cols="100" rows="50"></textarea>
    </form>
@endsection
