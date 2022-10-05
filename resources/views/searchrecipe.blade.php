@extends('mainafterlogin')
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
    <h2 style="text-align: center;">Search Recipe</h2>
    <div class="sr">
            <div>
                <h5>Meal Time</h5>
                <input type="checkbox" id="breakfast" name="breakfast" value="breakfast">
                <label for="breakfast">breakfast</label><br>
                <input type="checkbox" id="lunch" name="lunch" value="lunch">
                <label for="lunch">lunch</label><br>
                <input type="checkbox" id="dinner" name="dinner" value="dinner">
                <label for="dinner">dinner</label>
            </div>
            <div>
                <h5>Eating Style</h5>
                <input type="checkbox" id="vegeterian" name="vegeterian" value="vegeterian">
                <label for="vegeterian">vegeterian</label><br>
                <input type="checkbox" id="non-vegeterian" name="non-vegeterian" value="non-vegeterian">
                <label for="non-vegeterian">non-vegeterian</label><br>
                <input type="checkbox" id="vegan" name="vegan" value="vegan">
                <label for="vegan">vegan</label><br>
                
            </div>
            <div>
                <h5>Occassion</h5>
                <input type="checkbox" id="datenight" name="datenight" value="datenight">
                <label for="datenight">date-night</label><br>
                <input type="checkbox" id="familygettogether" name="familygettogether" value="familygettogether">
                <label for="familygettogether">family-get-together</label><br>
                <input type="checkbox" id="festival" name="festival" value="festival">
                <label for="festival">festival</label><br>
                               
            </div>
            <div>
            <input type="submit" value="Submit" id="srecipe" name="srecipe">
            </div>
        </div>
    </div>
</div>
@endsection