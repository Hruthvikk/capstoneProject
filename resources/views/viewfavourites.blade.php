@extends('mainafterlogin')
@section('content')
    <h4>My Favourites:</h4>
    <div class="prfav">
        @foreach ($userFavourites as $uf)
            <div class="prr images">
                <?php
                $imagename = $uf->recipeImage;
                ?>
                <a href="{{ url('viewrecipe', $uf->id) }}"><img
                        src="https://softwarecapstone000813765.s3.us-east-2.amazonaws.com/images/<?= $imagename ?>"
                        alt="" height="200px" width="200px"></a>
                <p>{{ $uf->recipeName }}</p>
            </div>
        @endforeach
    </div>
@endsection
