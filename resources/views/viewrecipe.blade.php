@extends('mainafterlogin')
@section('content')
    
        <h2>Recipe By Chef Username</h2>
        @foreach ($recipedata as $recd )
            
        @endforeach
        <h4>Recipe Description : {!!$recd->recipeDescription!!}</h4>
        <!-- <h4>Cooking for :  <input type="text" id="numofperson" name="numofperson" placeholder="Number of Person"> </h4> -->
        <?php 
            $total = $recd->preparationTime * $recd->cookingTime;
            $imagename=$recd->recipeImage; 
        ?>
        <img src="/public/Image/<?=$imagename?>" alt="" height="200px" width="200px">
        <h4>Total minutes : {!! $total!!}
        <br>   
        Preparation Time : {!!$recd->preparationTime!!}
        <br>
        Cooking Time : {!!$recd->cookingTime!!}
        <br>
        Ingredients Required : {!!$recd->ingredients!!}
        </h4>
        <br>
        <button><a href="{{url('recipesteps',$recd->id)}}">I have All ingredients</a></button>
        <button><a href="">I dont have all ingredients</a></button>
            
            
        
    
@endsection