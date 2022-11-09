@extends('mainafterlogin')
@section('content')
    
        <h2>Recipe By Chef Username</h2>
        @foreach ($recipedata as $recd )
            
        @endforeach
        <h4>Recipe Description : {!!$recd->recipeDescription!!}</h4>
        <!-- <h4>Cooking for :  <input type="text" id="numofperson" name="numofperson" placeholder="Number of Person"> </h4> -->
        <?php 
            $total = $recd->preparationTime * $recd->cookingTime
        ?>
        <h4>Total minutes : {!! $total!!}
        <br>   
        Preparation Time : {!!$recd->preparationTime!!}
        <br>
        Cooking Time : {!!$recd->cookingTime!!}
        <br>
        Ingredients Required : {!!$recd->ingredients!!}
        </h4>
        <form method="POST" action="">
            <input type="hidden" value="{{$recd->id">
            <button type="submit" formaction="{{route('login-user')}}">I have All ingredients</button>
            <button type="submit" formaction="{{route('login-user')}}">I dont have all ingredients</button>
        </form>
    
@endsection