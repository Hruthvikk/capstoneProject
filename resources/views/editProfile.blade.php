@extends('mainafterlogin')
@section('content')
<div class="editformm">
    <h2>Account</h2>

    <br>
    @if(Session::has('loginUserId'))
        <?php $uid=session('loginUserId') ?>
        <!-- {{url('editUserProfile/<?=$uid?>')}} -->
        <a href="{{url('editUserProfile',$uid)}}" class="btn btn-info">Edit Profile</a>
        <a href="{{url('/viewfavourites')}}" class="btn btn-info">View Favourites</a>
    @endif
</div>
@endsection