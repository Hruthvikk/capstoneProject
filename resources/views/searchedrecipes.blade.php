@extends('mainafterlogin')
@section('content')
<h3>Searched Recipes</h3>
    @foreach ($mtres as $sd )
    <?php $imagename=$sd->recipeImage; ?>
    <div class="grid-cointainer">
        <div class="grid-item">
            <div class="pr">
            <div class="prr images">
                <a href="{{url('viewrecipe',$sd->id)}}"> <img src="/public/Image/<?=$imagename?>" alt="" height="200px" width="200px"> </a>
                <p>{{$sd->recipeName}}</p>
            </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection