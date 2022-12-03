@extends('mainafterlogin')
@section('content')
    <div class="recipeform">
        <h2>Ask a question to chef</h2>
        <br>
        <h2>Question?</h2>

            <form action="{{ route('msg-sent') }}">
                @csrf
                <div class="form-group col-md-3">
                    @if (Session::has('msg'))
                        <div class="alert alert-success">{{ Session::get('msg') }}</div>
                    @endif
                </div>
                <div class="form-group col-md-3">
                    <textarea cols="100" rows="10" name="memquestion"></textarea>
                    <br>
                    <br>
                    <input type="submit" value="Send Question" class="vfbtn">
                </div>
            </form>
    </div>
@endsection
