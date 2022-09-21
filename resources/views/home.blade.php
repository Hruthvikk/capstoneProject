@extends('main')
@section('content')
<div class="container">
    <div class="row">
        <h2 style="text-align: center;">Popular Recipe</h2>
        <div class="pr">
            <div class="prr images">
                <img src="/images/Food1.jpg" alt="" height="200px" width="200px">
                <p>Roti Sabji</p>
            </div>
            <div class="prr images">
                <img src="/images/Food4.jpg" alt=""  height="150px" width="150px">
                <p>Chai</p>
            </div>
            <div class="prr images">
                <img src="/images/Food6.jpg" alt=""  height="150px" width="150px">
                <p>Samosa</p>               
            </div>
        </div>
    </div>
    <br>
    <div class="row">
    <h2 style="text-align: center;">Meals</h2>
    <div class="pr">
            <div class="prr images">
                <img src="/images/Food1.jpg" alt="" height="200px" width="200px">
                <p>Breakfast</p>
            </div>
            <div class="prr images">
                <img src="/images/Food4.jpg" alt=""  height="150px" width="150px">
                <p>Lunch</p>
            </div>
            <div class="prr images">
                <img src="/images/Food6.jpg" alt=""  height="150px" width="150px">
                <p>Dinner</p>               
            </div>
        </div>
    </div>
</div>
@endsection