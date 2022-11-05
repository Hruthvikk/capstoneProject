@extends('mainafterlogin')
@section('content')
<div class="recipeform">
    <h2>Enter a recipe:</h2>
    <form action="{{route('addrecipe')}}" method="post" enctype="multipart/form-data">
       @csrf
       <div class="form-group col-md-3">
       @if(Session::has('success1'))
        <div class="alert alert-success">{{Session::get('success1')}}</div>
        @endif
        @if(Session::has('fail1'))
        <div class="alert alert-danger">{{Session::get('fail1')}}</div>
        @endif
        </div>

        
        <div class="form-group col-md-3">
        @if(Session::has('loginUserId'))
        <input type="hidden" name="user_id" value="{{Session::get('loginUserId')}}">
        @endif
       <label class="form-label">Recipe Name: </label> 
       <input type="text" name="recipename" class="form-control" value="{{old('recipename')}}" placeholder="Recipe Name" />
       <span class="text-danger">@error('recipename'){{$message}}@enderror</span>
       </div>
        <br>
       <div class="form-group col-md-3">
       <label class="form-label">Recipe Description: </label> 
       <input type="text" name="recipedescription" class="form-control" value="{{old('recipedescription')}}" placeholder="Recipe Description" />
       <span class="text-danger">@error('recipedescription'){{$message}}@enderror</span>
       </div>
       <br>
       <div class="form-group col-md-3">
       <label class="form-label">Preparation Time: </label> 
       <input type="text" name="preparationtime" class="form-control" value="{{old('preparationtime')}}" placeholder="Preparation Time In Minutes" />
       <span class="text-danger">@error('preparationtime'){{$message}}@enderror</span>
       </div>
       <br>
       <div class="form-group col-md-3">
       <label class="form-label">Cooking Time: </label> 
       <input type="text" name="cookingtime" class="form-control" value="{{old('cookingtime')}}" placeholder="Cooking Time In Minute" />
       <span class="text-danger">@error('cookingtime'){{$message}}@enderror</span>
       </div>
       <br>
       <div class="form-group col-md-3">
       <label class="form-label" for="mealtime">Meal Time: </label>
       <select id="mealtime" name="mealtime">
       
            @foreach ($mealtime as $mt )
                <option selected disabled hidden>Select An Option</option>
                <option value="{{$mt->id}}">{{$mt->mealTimeName}}</option>    
            @endforeach
       </select>
       </div>
       <br>
       <div class="form-group col-md-3">
       <label class="form-label" for="eatingstyle">Eating style: </label>
       <select id="eatingstyle" name="eatingstyle">
       
            @foreach ($eatingstyle as $es )
                <option value="0" selected disabled hidden>Select An Option</option>
                <option value="{{$es->id}}">{{$es->editStyleName}}</option>    
            @endforeach
       </select>
       </div>
       <br>
       <div class="form-group col-md-3">
       <label class="form-label" for="occasion">Occasion: </label>
       
       <select id="occasion" name="occasion">
            @foreach ($occasions as $occ )
                <option selected disabled hidden>Select An Option</option>
                <option value="{{$occ->id}}">{{$occ->occassionName}}</option>    
            @endforeach
       </select>
       </div>
       <br>
       <div class="form-group col-md-3">
       <label class="form-label">Recipe Image: </label> 
       <input type="file" name="recipeimage">
       </div>
       <br>
       <div class="form-group col-md-3">
       <label class="form-label">Ingredients:  </label> 
       <textarea  name="ingredients" rows="12" cols="30"> </textarea>
       </div>
       <br>
       <div class="form-group col-md-3">
       <label class="form-label">Steps: </label> 
       <textarea  name="steps" rows="12" cols="50"> </textarea>
       </div>
        <br>
        <input type="submit" class="btn btn-primary" value="Sign Up">
    </form>
</div>
@endsection