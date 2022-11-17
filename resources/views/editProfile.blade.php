@extends('mainafterlogin')
@section('content')
<div class="editformm">
    <h2>Account</h2>

    <br>
    @if(Session::has('loginUserId'))
        <?php $uid=session('loginUserId') ?>
        <!-- {{url('editUserProfile/<?=$uid?>')}} -->
        <a href="{{url('editUserProfile',$uid)}}" class="btn btn-info">Edit Profile</a>
        <a href="{{url('/editRecipe')}}" class="btn btn-info">Edit Recipe</a>
    @endif
</div>
@endsection