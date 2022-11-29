@extends('mainafterlogin')
@section('content')

    
    <div class="cointainer">
        <div class="row">
        <h2 style="text-align: center;">Searched Recipes</h2>
        
            <div class="pr">
            @foreach ($mtres as $sd )
            <?php $imagename=$sd->recipeImage; ?>
                <div class="prr images">
                    <a href="{{url('viewrecipe',$sd->id)}}"> <img src="]public/Image/<?=$imagename?>" alt="" height="200px" width="200px"> </a>
                    <p>{{$sd->recipeName}}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    
@endsection