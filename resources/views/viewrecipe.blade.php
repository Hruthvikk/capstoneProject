@extends('mainafterlogin')
@section('content')
    <h2>Recipe By Chef Username</h2>
    <h4>Recipe Description : </h4>
    <h4>Cooking for :  <input type="text" id="numofperson" name="numofperson" placeholder="Number of Person"> </h4>
    <h4>Total minutes : 
     <br>   
    Preparation Time :
    <br>
    Cooking Time : 
    <br>
    Ingredients Required :
    </h4>

    <button>I have All ingredients</button>
    <button>I dont have all ingredients</button>
    
@endsection