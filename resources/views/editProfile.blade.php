@extends('mainafterlogin')
@section('content')
<div class="editformm">
    <h2>Edit Profile</h2>

    
    @if(Session::has('loginUserId'))
        <?php $uid=session('loginUserId') ?>
        <!-- {{url('editUserProfile/<?=$uid?>')}} -->
        <a href="{{url('editUserProfile',$uid)}}">Edit Profile</a>
        <a href="{{url('/editRecipe')}}">Edit Recipe</a>
    @endif
</div>
@endsection