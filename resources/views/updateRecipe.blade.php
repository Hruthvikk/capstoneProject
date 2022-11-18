@extends('mainafterlogin')
@section('content')
<form method="POST" action="{{route('added-recipe')}}" enctype="multipart/form-data">
       @csrf        
       @foreach ( $upr as $up1 )
           
       @endforeach
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
       <option  hidden disabled selected>Select An Option</option>
            @foreach ($mealtime as $mt )
                
                <option value="{{$mt->id}}" name="mealtime" selected>{{$mt->mealTimeName}}</option>    
            @endforeach
       </select>
       </div>
       <br>
       <div class="form-group col-md-3">
       <label class="form-label" for="eatingstyle">Eating style: </label>
       <select id="eatingstyle" name="eatingstyle">
       <option  hidden disabled selected>Select An Option</option>
            @foreach ($eatingstyle as $es )
                
                <option value="{{$es->id}}" name="eatingstyle" selected>{{$es->editStyleName}}</option>    
            @endforeach
       </select>
       </div>
       <br>
       <div class="form-group col-md-3">
       <label class="form-label" for="occasion">Occasion: </label>
       
       <select id="occasion" name="occasion">
       <option  hidden disabled selected>Select An Option</option>
            @foreach ($occasions as $occ )
                <option value="{{$occ->id}}" name="occasion" selected>{{$occ->occassionName}}</option>    
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
       <label class="form-label">Ingredients:  </label> <br>
       <textarea name="ingredients"></textarea>
       </div>
       <br>
       <div class="form-group col-md-3">
       <label class="form-label">Steps: </label> <br>
       <textarea name="steps" ></textarea>
       </div>
        <br>
        <input type="submit" class="btn btn-primary" value="Submit">
    </form>
@endsection