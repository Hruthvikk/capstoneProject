@extends('mainafterlogin')
@section('content')
    <div class="pr">
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
