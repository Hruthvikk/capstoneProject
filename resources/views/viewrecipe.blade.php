@extends('mainafterlogin')
@section('content')
    <div class="gridviewrecip">
        <div class="gridv1">
            <h2>Recipe By Chef Username</h2>
            @foreach ($recipedata as $recd)
            @endforeach
            <h4>Recipe Description : {!! $recd->recipeDescription !!}</h4>
            <?php
            $total = $recd->preparationTime + $recd->cookingTime + 5;
            $imagename = $recd->recipeImage;
            ?>
            <img src="https://softwarecapstone000813765.s3.us-east-2.amazonaws.com/images/<?= $imagename ?>" alt=""
                height="200px" width="200px">
            <br>
            <script language="javascript">
                function getv() {
                    var terf = document.getElementById('terf');
                    var terf1 = ""
                    terf1 = document.getElementById('numofperson').value;
                    var firstChilds = terf.querySelectorAll("td:first-child");
                    var allName = [];
                    var j = 0;
                    if(j==0){
                        for(i=0; i<firstChilds.length; ++i){
                            allName.push(firstChilds[i].innerHTML);
                        }
                        for(i=0; i<firstChilds.length; ++i){
                        firstChilds[i].innerHTML=allName[i];
                        console.log(allName[i]);
                        }
                        for(i=0; i<firstChilds.length; ++i){
                            firstChilds[i].innerHTML*=terf1;
                        }
                        j++;
                    }
                    else{
                        for(i=0; i<firstChilds.length; ++i){
                            firstChilds[i].innerHTML=allName[i]*terf1;
                        }
                    }

                }
            </script>
            <h4>Cooking for : <input type="text" id="numofperson" name="numofperson" placeholder="Number of Person"
                    defaultvalue="1" placeholder="1"> </h4>
            <input type="button" id="getVal" onclick="getv()" value="Update Ingredients"/>

            <h4>Total minutes : {!! $total !!}
                <br>
                Preparation Time : {!! $recd->preparationTime !!}
                <br>
                Cooking Time : {!! $recd->cookingTime !!}
                <br>
                Ingredients Required :
                <table id="numppl">
                    <tr>
                        <td>Measurement</td>
                        <td>Unit</td>
                        <td>Ingredients</td>
                    </tr>

                    <?php
                    $m = explode(',', $recd->measurement);
                    $u = explode(',', $recd->unitName);
                    $in = explode(',', $recd->ingredients);
                    $i = 0;
                    ?>
                    <tbody id="terf">
                    @foreach ($m as $m1)
                        <tr>

                            <td id="measurementnum">
                                {!! $m1 !!}
                            </td>
                            <td>{!! $u[$i] !!}</td>
                            <td>{!! $in[$i] !!}</td>
                            <?php $i++; ?>
                    @endforeach

                    </tr>
                    </tbody>
                </table>

            </h4>
            <br>
            <button><a href="{{ url('recipesteps', $recd->id) }}">I have All ingredients</a></button>
            <button><a href="">I dont have all ingredients</a></button>
        </div>

        <div class="gridv2">



            <form method="post" action="{{ route('added-rate') }}">
                @csrf
                @foreach ($arf as $af)
                    <span>Your Rating:{{ $af->starNum }}</span>
                @endforeach


                <input type="hidden" name="recipe_id" value="{{ $recd->id }}">
                @if (Session::has('loginUserId'))
                    <input type="hidden" name="user_id" value="{{ Session::get('loginUserId') }}">
                @endif

                <span class="heading">User Rating</span> &nbsp&nbsp&nbsp&nbsp&nbsp
                <input type="hidden" id="fav" name="fav" value="no">
                <input type="checkbox" id="fav" name="fav" value="yes">
                <label for="fav" name="fav">Make it your favourite</label>&nbsp&nbsp&nbsp&nbsp&nbsp
                <input type="submit" value="Submit Rating" class="btn btn-danger">
                <div class="rate">

                    <br>
                    <input type="hidden" name="rate" value="0">
                    <input type="radio" id="star5" name="rate" value="5" />
                    <label for="star5">5 stars</label>
                    <input type="radio" id="star4" name="rate" value="4" />
                    <label for="star4">4 stars</label>
                    <input type="radio" id="star3" name="rate" value="3" />
                    <label for="star3">3 stars</label>
                    <input type="radio" id="star2" name="rate" value="2" />
                    <label for="star2">2 stars</label>
                    <input type="radio" id="star1" name="rate" value="1" />
                    <label for="star1">1 star</label>
                </div>


                <?php
                $avg = 0;
                $num1 = 0;
                $num2 = 0;
                $num3 = 0;
                $num4 = 0;
                $num5 = 0;
                if ($allstar != 0) {
                    $calavg = (1 * $ones + 2 * $twos + 3 * $threes + 4 * $fours + 5 * $fives) / $allstar;
                    $avg = round($calavg, 2);
                    $num5 = ($fives * 100) / $allstar;
                    $num4 = ($fours * 100) / $allstar;
                    $num3 = ($threes * 100) / $allstar;
                    $num2 = ($twos * 100) / $allstar;
                    $num1 = ($ones * 100) / $allstar;
                }
                ?>

                <p>{{ $avg }} average based on {{ $allstar }} reviews.</p>
                <hr style="border:3px solid #f1f1f1">

                <div class="row">
                    <div class="side">
                        <div>5 star</div>
                    </div>
                    <div class="middle">
                        <div class="bar-container">
                            <div class="bar-5" style="width:<?= $num5 ?>%;"></div>
                        </div>
                    </div>
                    <div class="side right">
                        <div>{{ $fives }}</div>
                    </div>
                    <div class="side">
                        <div>4 star</div>
                    </div>
                    <div class="middle">
                        <div class="bar-container">
                            <div class="bar-4" style="width:<?= $num4 ?>%;"></div>
                        </div>
                    </div>
                    <div class="side right">
                        <div>{{ $fours }}</div>
                    </div>
                    <div class="side">
                        <div>3 star</div>
                    </div>
                    <div class="middle">
                        <div class="bar-container">
                            <div class="bar-3" style="width:<?= $num3 ?>%;"></div>
                        </div>
                    </div>
                    <div class="side right">
                        <div>{{ $threes }}</div>
                    </div>
                    <div class="side">
                        <div>2 star</div>
                    </div>
                    <div class="middle">
                        <div class="bar-container">
                            <div class="bar-2" style="width:<?= $num2 ?>%;"></div>
                        </div>
                    </div>
                    <div class="side right">
                        <div>{{ $twos }}</div>
                    </div>
                    <div class="side">
                        <div>1 star</div>
                    </div>
                    <div class="middle">
                        <div class="bar-container">
                            <div class="bar-1" style="width:<?= $num1 ?>%;">
                            </div>
                        </div>
                        <br>
                        <br>


                    </div>

                    <div class="side right">
                        <div>{{ $ones }}</div>
                    </div>
                </div>
        </div>
    </div>
    </form>
@endsection
