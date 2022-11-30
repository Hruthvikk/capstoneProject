@extends('mainafterlogin')
@section('content')

<div class="container">
    <div class="row">
        <h2 style="text-align: center;">Popular Recipe</h2>
        <div class="pr">
            
            @foreach ($rndrec as $rr )
                <?php    
                    $imagename=$rr->recipeImage; 
                ?>
                <div class="prr images">
                    <img src="https://softwarecapstone000813765.s3.us-east-2.amazonaws.com/images/<?=$imagename?>"  alt="" height="200px" width="200px">
                    <p>$rr->recipeName</p>    
                </div>    
            @endforeach
        </div>
    </div>
    <br>
    <div class="row">
    <h2 style="text-align: center;">Meals</h2>
    <div class="pr">
            <div class="prr images">
            
                @foreach($brkfst as $bf)
                <?php 
                    $imagename=$bf->recipeImage; 
                ?>
                    <img src="https://softwarecapstone000813765.s3.us-east-2.amazonaws.com/images/<?=$imagename?>"  alt="" height="200px" width="200px">
                @endforeach
                <p>Breakfast</p>
            </div>
            <div class="prr images">
                @foreach($lunch as $lch)
                    <?php 
                        $imagename=$lch->recipeImage; 
                    ?>
                    <img src="https://softwarecapstone000813765.s3.us-east-2.amazonaws.com/images/<?=$imagename?>"  alt="" height="200px" width="200px">
                @endforeach
                <p>Lunch</p>
            </div>
            <div class="prr images">
                @foreach($dine as $dn)
                    <?php 
                        $imagename=$dn->recipeImage; 
                    ?>
                <img src="https://softwarecapstone000813765.s3.us-east-2.amazonaws.com/images/<?=$imagename?>"  alt="" height="200px" width="200px">
                @endforeach
                <p>Dinner</p>               
            </div>
        </div>
    </div>
</div>
@endsection