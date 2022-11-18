@extends('mainafterlogin')
@section('content')
    @foreach ($userFavourites as $uf )  
    <div class="prr images">
                <?php 
                    $imagename=$uf->recipeImage; 
                ?>
                <a href="{{url('viewrecipe',$uf->id)}}"><img src="/public/Image/<?=$imagename?>" alt="" height="200px" width="200px"></a>
                <p>{{$uf->recipeName}}</p>
            </div>
    @endforeach
@endsection