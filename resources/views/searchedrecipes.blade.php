@extends('mainafterlogin')
@section('content')

    @foreach ($mtres as $sd )
    <?php $imagename=$sd->recipeImage; ?>
    <h3>Searched Recipes</h3>
    <div class="sd">
        <div class="prr images">
            <a href="{{url('viewrecipe',$sd->id)}}"> <img src="/public/Image/<?=$imagename?>" alt="" height="200px" width="200px"> </a>
            <p>{{$sd->recipeName}}</p>
        </div>
    </div>
    @endforeach
@endsection