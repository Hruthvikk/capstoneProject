@extends('main')
@section('content')
<div class="loginform">
    <h2>Sign in</h2>
    <form>
       @csrf
       <div class="form-group col-md-3">
       <label class="form-label">Email</label> 
       <input type="email" name="email" class="form-control" placeholder="email" />
       </div>
       <div class="form-group col-md-3">
       <label class="form-label">Password</label> 
       <input type="password" name="password" class="form-control" placeholder="password" />
       </div>
        <br>
       <button><a href="{{url('/homeafterlogin')}}">Login</a></button>
    </form>
</div>
@endsection