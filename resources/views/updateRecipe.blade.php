@extends('mainafterlogin')
@section('content')
    @foreach ($uprecipeData as $updata)
        <div class="gridviewrecip">
            <div class="gridv1">
                <form method="POST" action="{{ route('update-recipe') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ $updata->id }}" name="rid">

                    <div class="form-group col-md-3">
                        @if (Session::has('successupre'))
                            <div class="alert alert-success">{{ Session::get('successupre') }}</div>
                        @endif
                        @if (Session::has('unsuccessupre'))
                            <div class="alert alert-danger">{{ Session::get('unsuccessupre') }}</div>
                        @endif
                    </div>
                    @if (Session::has('loginUserId'))
                        <input type="hidden" name="user_id" value="{{ Session::get('loginUserId') }}">
                    @endif
                    <label class="form-label">Recipe Name: </label>
                    <input type="text" name="recipename" class="form-control" value="{!! $updata->recipeName !!}"
                        placeholder="Recipe Name" />
                    <span class="text-danger">
                        @error('recipename')
                            {{ $message }}
                        @enderror
                    </span>
            </div>
            <br>
            <div class="form-group col-md-3">
                <label class="form-label">Recipe Description: </label>
                <input type="text" name="recipedescription" class="form-control" value="{!! $updata->recipeDescription !!}"
                    placeholder="Recipe Description" />
                <span class="text-danger">
                    @error('recipedescription')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <br>
            <div class="form-group col-md-3">
                <label class="form-label">Preparation Time: </label>
                <input type="text" name="preparationtime" class="form-control" value="{{ $updata->preparationTime }}"
                    placeholder="Preparation Time In Minutes" />
                <span class="text-danger">
                    @error('preparationtime')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <br>
            <div class="form-group col-md-3">
                <label class="form-label">Cooking Time: </label>
                <input type="text" name="cookingtime" class="form-control" value="{{ $updata->cookingTime }}"
                    placeholder="Cooking Time In Minute" />
                <span class="text-danger">
                    @error('cookingtime')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <br>
            <div class="form-group col-md-3">
                <label class="form-label" for="mealtime">Meal Time: </label>
                <select id="mealtime" name="mealtime">
                    <option disabled selected>{{ $updata->mealTimeName }}</option>
                    @foreach ($mealtime as $mt)
                        <option value="{{ $mt->id }}" name="mealtime" selected>{{ $mt->mealTimeName }}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <div class="form-group col-md-3">
                <label class="form-label" for="eatingstyle">Eating style: </label>
                <select id="eatingstyle" name="eatingstyle">
                    <option disabled selected>{{ $updata->editStyleName }}</option>
                    @foreach ($eatingstyle as $es)
                        <option value="{{ $es->id }}" name="eatingstyle" selected>{{ $es->editStyleName }}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <div class="form-group col-md-3">
                <label class="form-label" for="occasion">Occasion: </label>

                <select id="occasion" name="occasion">
                    <option disabled selected>{{ $updata->occassionName }}</option>
                    @foreach ($occasions as $occ)
                        <option value="{{ $occ->id }}" name="occasion" selected>{{ $occ->occassionName }}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <div class="form-group col-md-3">
                <label class="form-label">Recipe Image: </label>
                <input type="file" name="recipeimage" value="{{ $updata->recipeImage }}">
            </div>
            <br>
            <div class="form-group col-md-3">
                Ingredients Required :
                <table>
                    <tr>
                        <td>Measurement</td>
                        <td>Unit</td>
                        <td>Ingredients</td>
                    </tr>

                    <?php
                    $m = explode(',', $updata->measurement);
                    $u = explode(',', $updata->unitName);
                    $in = explode(',', $updata->ingredients);
                    $i = 0;
                    ?>
                    @foreach ($m as $m1)
                        <tr>

                            <td>
                                {!! $m1 !!}
                            </td>
                            <td>{!! $u[$i] !!}</td>
                            <td>{!! $in[$i] !!}</td>
                            <?php $i++; ?>
                    @endforeach

                    </tr>

                </table>
            </div>

            <br>
            <div class="form-group col-md-3">
                <label class="form-label">Steps: </label> <br>
                <textarea name="steps">{{ $updata->steps }}</textarea>
            </div>
            <div class="form-group col-md-3">
                <br>
                <input type="submit" class="btn btn-primary" value="UPDATE RECIPE">
            </div>

            </form>
    @endforeach
    </div>
    </div>
@endsection
