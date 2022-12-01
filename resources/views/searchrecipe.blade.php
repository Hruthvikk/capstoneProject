@extends('mainafterlogin')
@section('content')
    <div class="container">

        <br>
        <div class="row">
            <h2 style="text-align: center;">Search Recipe</h2>
            <div class="sr">



                <div>

                    <form action="{{ route('searched-recipes') }}" method="post">
                        @csrf
                        @method('PUT')

                        <h5>Meal Time</h5>
                        @foreach ($mealtime as $mt)
                            <input type="radio" name="mealtime" value="<?= $mt->id ?>">
                            <label for="mealtime"><?= $mt->mealTimeName ?></label><br>
                        @endforeach
                </div>
                <div>
                    <h5>Eating Style</h5>
                    @foreach ($eatingstyle as $es)
                        <input type="radio" name="eatingstyle" value="<?= $es->id ?>">
                        <label for="eatingStyle"><?= $es->editStyleName ?></label><br>
                    @endforeach
                </div>
                <div>
                    <h5>Occassion</h5>
                    @foreach ($occasions as $o)
                        <input type="radio" name="occasion" value="<?= $o->id ?>">
                        <label for="occasion"><?= $o->occassionName ?></label><br>
                    @endforeach
                </div>
                <div>
                    <button class="stylbtn" type="submit"  id="srecipe" name="srecipe">Search</button>
                    </form>
                    <BR><BR>
                    @if (Session::has('notsel'))
                        <div class="alert alert-danger">{{ Session::get('notsel') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
