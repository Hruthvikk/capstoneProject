@extends('mainafterlogin')
@section('content')
    <div class="recipeform">
        <h2>Ask a question to chef</h2>
        <br>
        <h2>Question?</h2>
            <form>
                @csrf
                <div class="form-group col-md-3">
                    <textarea cols="100" rows="10" name="memquestion"></textarea>
                    <br>
                    <input type="submit" value="Send Question">
                </div>
            </form>
        </div>
    </div>
@endsection
