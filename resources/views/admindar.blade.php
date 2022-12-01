@extends('adminmain')
@section('content')
    <h4>
        <div class="form-group row">
            <form method="POST" action="{{ route('searchdate-recipe') }}">
                @csrf
                <label for="fromDate">Recipes added from :</label>
                <div class="col-sm-3"><input type="date" class="form-control input-sm" name="fromDate" required></div>
                <label for="toDate">Recipes added to :</label>
                <div class="col-sm-3"><input type="date" class="form-control input-sm" name="toDate" required></div>
                <br>
                <div class="col-sm-3"><input type="submit" class="btn btn-primary" value="Search"></div>
            </form>
        </div>

    </h4>
    <div>
        @if (Session::has('successdel'))
            <div class="alert alert-success">{{ Session::get('successdel') }}</div>
        @endif
        @if (Session::has('faildel'))
            <div class="alert alert-danger">{{ Session::get('faildel') }}</div>
        @endif

        <table>
            <thead>

                <th>Recipe Name
                    <span>
                        <a href="{{ url('displayallRecipedesc') }}"><i class="bi bi-arrow-up"></i></a>
                        <a href="{{ url('admindar') }}"><i class="bi bi-arrow-down"></i></a>
                    </span>
                </th>
                <th>Recipe Description</th>
                <th>Preparation Time
                    <span>
                        <a href="{{ url('displayallRecipeptdesc') }}"><i class="bi bi-arrow-up"></i></a>
                        <a href="{{ url('displayallRecipeptasc') }}"><i class="bi bi-arrow-down"></i></a>
                    </span>
                </th>
                <th>Cooking Time
                    <span>
                        <a href="{{ url('displayallRecipectdesc') }}"><i class="bi bi-arrow-up"></i></a>
                        <a href="{{ url('displayallRecipectasc') }}"><i class="bi bi-arrow-down"></i></a>
                    </span>
                </th>
                <th>Ingredients</th>

                <th>Username</th>
                <th>Eating Style</th>
                <th>Occasion</th>
                <th>Meal Time</th>
                <th>Recipe Image</th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($displayar as $dr)
                    <tr>

                        <td>{{ $dr->recipeName }}</td>
                        <td>{{ $dr->recipeDescription }}</td>
                        <td>{{ $dr->preparationTime }} Minutes</td>
                        <td>{{ $dr->cookingTime }} Minutes</td>
                        <td>{{ $dr->ingredients }}</td>

                        <td>{{ $dr->userFirstName }}</td>
                        <td>{{ $dr->editStyleName }}</td>
                        <td>{{ $dr->occassionName }}</td>
                        <td>{{ $dr->mealTimeName }}</td>
                        <?php $imagename = $dr->recipeImage; ?>
                        <td><img src="https://softwarecapstone000813765.s3.us-east-2.amazonaws.com/images/<?= $imagename ?>"
                                alt="" height="125px" width="125px"></td>
                        <td>
                            <a href="{{ url('adminviewsteps', $dr->id) }}" class="stylbtn">View Steps</a>
                            <br>
                            <a href="{{ url('deleteRecipe', $dr->id) }}" class="signinupbtndel"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                              </svg>Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <div class="pagi" style="margin-left:645px">
            {{ $displayar->links() }}
        </div>
    </div>
@endsection
