@extends('mainafterlogin')
@section('content')
    <div class="editformm">
        <h2>Account</h2>

        <br>
        @if (Session::has('loginUserId'))
            <?php $uid = session('loginUserId'); ?>
            <!-- {{ url('editUserProfile/<?= $uid ?>') }} -->
            <a href="{{ url('editUserProfile', $uid) }}" class="btn btn-info">Edit Profile</a>
            <a href="{{ url('/viewfavourites') }}" class="btn btn-info">View Favourites</a>
        @endif
    </div>
    <br><br>
    <div style="overflow-x:auto;">
        <h2 style="margin-left: 40%;">Recipes Added by you</h2>
        <table class=".table-responsive">
            <thead>
                <th>Recipe Name</th>
                <th>Recipe Description</th>
                <th>Preparation Time</th>
                <th>Cooking Time</th>
                <th>Ingredients</th>
                <th>Eating Style</th>
                <th>Occasion</th>
                <th>Meal Time</th>
                <th>Recipe Image</th>
                <th>Update</th>
            </thead>
            <tbody>
                @foreach ($editr as $r)
                    <tr>

                        <td>{{ $r->recipeName }}</td>
                        <td>{{ $r->recipeDescription }}</td>
                        <td>{{ $r->preparationTime }} Minutes</td>
                        <td>{{ $r->cookingTime }} Minutes</td>
                        <td>{{ $r->ingredients }}</td>
                        <td>{{ $r->editStyleName }}</td>
                        <td>{{ $r->occassionName }}</td>
                        <td>{{ $r->mealTimeName }}</td>
                        <?php $imagename = $r->recipeImage;
                        $rena = $r->recipeName;
                        ?>
                        <td><img src="https://softwarecapstone000813765.s3.us-east-2.amazonaws.com/images/<?= $imagename ?>"
                                alt="" height="125px" width="125px"></td>
                        <td>
                            <a href="{{ url('memviewsteps', $r->id) }}" class="stylbtn">View Steps</a>
                            <a href="{{ url('updateRecipe', $r->id) }}" class="stylbtnedit">Update Recipe</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
