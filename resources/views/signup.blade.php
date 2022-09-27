@extends('main')
@section('content')
<div class="registerform">
    <h2>Sign Up</h2>
    <form>
       @csrf
       <div class="form-row">
        <div class="form-group col-md-3">
            <label class="form-label">First Name</label> 
            <input type="text" name="firstname" class="form-control" placeholder="first name" />
        </div>
        <div class="form-group col-md-3">
            <label class="form-label">Last Name</label> 
            <input type="text" name="lastname" class="form-control" placeholder="last name" />
        </div>
       </div>
       <div class="form-row">
            <div class="form-group col-md-3">
            <label class="form-label">Email</label> 
            <input type="email" name="email" class="form-control" placeholder="email" />
            </div>
            <div class="form-group col-md-3">
            <label class="form-label">Phone Number</label> 
            <input type="text" name="phonenum" class="form-control" placeholder="phone number" />
            </div>
       </div>
       <div class="form-row">
            <div class="form-group col-md-3">
            <label class="form-label">Password</label> 
            <input type="password" name="password" class="form-control" placeholder="password" />
            </div>
            <div class="form-group col-md-3">
            <label class="form-label">Confirm Password</label> 
            <input type="password" name="confirmpassword" class="form-control" placeholder="confirmpassword" />
            </div>
       </div>
        <br>
       <input type="submit" class="btn btn-primary" value="login">
    </form>
</div>
@endsection