@extends('mainafterlogin')
@section('content')
    @if (Session::has('loginUserId'))
        <div class="container">
            <div class="row">
                <h2 style="text-align: center;">Popular Recipe</h2>
                <div class="pr">
                    @foreach ($rndrec as $rr)
                        <?php
                        $imagename = $rr->recipeImage;
                        ?>
                        <div class="prr images">
                            <a href="{{ url('viewrecipe', $rr->id) }}"><img
                                    src="https://softwarecapstone000813765.s3.us-east-2.amazonaws.com/images/<?= $imagename ?>"
                                    alt="" height="200px" width="200px"></a>
                            <p>{{ $rr->recipeName }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            <br>
            <div class="row">
                <h2 style="text-align: center;">Meals</h2>
                <div class="pr">
                    <div class="prr images">
                        @foreach ($brkfst as $bf)
                            <p>Breakfast</p>
                            <?php
                            $imagename = $bf->recipeImage;
                            ?>
                            <a href="{{ url('viewrecipe', $bf->id) }}"><img
                                    src="https://softwarecapstone000813765.s3.us-east-2.amazonaws.com/images/<?= $imagename ?>"
                                    alt="" height="200px" width="200px"></a>
                            <p>{{ $bf->recipeName }}</p>
                        @endforeach
                    </div>
                    <div class="prr images">
                        @foreach ($lunch as $lch)
                            <p>Lunch</p>
                            <?php
                            $imagename = $lch->recipeImage;
                            ?>
                            <a href="{{ url('viewrecipe', $lch->id) }}"><img
                                    src="https://softwarecapstone000813765.s3.us-east-2.amazonaws.com/images/<?= $imagename ?>"
                                    alt="" height="200px" width="200px"></a>
                            <p>{{ $lch->recipeName }}</p>
                        @endforeach

                    </div>
                    <div class="prr images">
                        <p>Dinner</p>
                        @foreach ($dine as $dn)
                            <?php
                            $imagename = $dn->recipeImage;
                            ?>
                            <a href="{{ url('viewrecipe', $dn->id) }}"><img
                                    src="https://softwarecapstone000813765.s3.us-east-2.amazonaws.com/images/<?= $imagename ?>"
                                    alt="" height="200px" width="200px"></a>
                            <p>{{ $dn->recipeName }}</p>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    @else
        <?php return view('signin'); ?>
    @endif
@endsection
