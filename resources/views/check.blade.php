@extends('mainafterlogin')
@section('content')

    @foreach ($recip as $r)
        <?php $imagename=$r->recipeImage; ?>
        
        <img src="/public/Image/<?=$imagename?>" alt="" height="100px" width="150px">
    @endforeach

@endsection