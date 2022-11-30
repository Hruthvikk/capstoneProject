@extends('mainafterlogin')
@section('content')

<div class="container">
    <div class="row">
        <h2 style="text-align: center;">Popular Recipe</h2>
        <div class="pr">
            <div class="prr images">
                
                <a href=""> <img src="https://softwarecapstone000813765.s3.us-east-2.amazonaws.com/images/WzS7bwtky72PGOwbuuV1eHQPJlgwaCenFnh6gXif.jpg" alt="" height="200px" width="200px"> </a>
                <p>Roti Sabji</p>
            </div>
            <div class="prr images">
                <img src="https://softwarecapstone000813765.s3.us-east-2.amazonaws.com/istockphoto-693220794-612x612.jpg" alt=""  height="200px" width="200px">
                <p>Chai</p>
            </div>
            <div class="prr images">
                <img src="/images/Food6.jpg" alt=""  height="200px" width="200px">
                <p>Samosa</p>               
            </div>
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
                <img src="/images/Food8.jpg" alt=""  height="150px" width="150px">
                <p>Lunch</p>
            </div>
            <div class="prr images">
                <img src="/images/Food11.jpg" alt=""  height="150px" width="150px">
                <p>Dinner</p>               
            </div>
        </div>
    </div>
</div>
@endsection