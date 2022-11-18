@extends('adminmain')
@section('content')
     <div>
        <table>
            <thead>
                <th>Recipe Name
                <span>
                    <a href="{{url('displayallRecipedesc')}}"><i class="bi bi-arrow-up"></i></a>
                    <a href="{{url('admindar')}}"><i class="bi bi-arrow-down"></i></a>
                    </span>
                </th>
                <th>Recipe Description</th>
                <th>Preparation Time
                <span>
                    <a href="{{url('displayallRecipeptdesc')}}"><i class="bi bi-arrow-up"></i></a>
                    <a href="{{url('displayallRecipeptasc')}}"><i class="bi bi-arrow-down"></i></a>
                    </span>
                </th>
                <th>Cooking Time
                <span>
                    <a href="{{url('displayallRecipectdesc')}}"><i class="bi bi-arrow-up"></i></a>
                    <a href="{{url('displayallRecipectasc')}}"><i class="bi bi-arrow-down"></i></a>
                    </span>
                </th>
                <th>Ingredients</th>
                <th>Steps</th>
                <th>Username</th>
                <th>Eating Style</th>
                <th>Occasion</th>
                <th>Meal Time</th>
                <th>Recipe Image</th>
                <th>Delete</th>
            </thead>
            <tbody>
                @foreach ( $dar as $dr )    
                
                <tr>
                    <td>{{$dr->recipeName}}</td>
                    <td>{{$dr->recipeDescription}}</td>
                    <td>{{$dr->preparationTime}} Minutes</td>
                    <td>{{$dr->cookingTime}} Minutes</td>
                    <td>{{$dr->ingredients}}</td>
                    <td>{{$dr->steps}}</td>
                    <td>{{$dr->userFirstName}}</td>
                    <td>{{$dr->editStyleName}}</td>
                    <td>{{$dr->occassionName}}</td>
                    <td>{{$dr->mealTimeName}}</td>
                    <?php $imagename=$dr->recipeImage; ?>
                    <td><img src="/public/Image/<?=$imagename?>" alt="" height="125px" width="125px"></td>
                    <td><a href="{{url('deleteRecipe',$dr->id)}}" class="btn btn-danger">Delete Recipe</a></td>
                </tr>      

                @endforeach     
            </tbody>
        </table>
     </div>
@endsection