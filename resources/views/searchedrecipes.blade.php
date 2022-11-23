@extends('mainafterlogin')
@section('content')

    
    <div class="cointainer">
        <div class="row">
        <h2 style="text-align: center;">Searched Recipes</h2>
            <div class="pr">
            
                <div class="prr images">
                @foreach ($mtres as $sd )
                <?php $imagename=$sd->recipeImage; ?>
                    <a href="{{url('viewrecipe',$sd->id)}}"> <img src="/public/Image/<?=$imagename?>" alt="" height="200px" width="200px"> </a>
                    <p>{{$sd->recipeName}}</p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection