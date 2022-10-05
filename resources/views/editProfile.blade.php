@extends('mainafterlogin')
@section('content')
<div class="editformm">
    <h2>Edit Profile</h2>
    <form>
       @csrf
       <div class="form-group col-md-3">
       <label class="form-label">First Name:</label> 
       <input type="text" name="firstname" class="form-control" placeholder="firstname" />
       </div>
       <div class="form-group col-md-3">
       <label class="form-label">Last Name:</label> 
       <input type="text" name="lastname" class="form-control" placeholder="lastname" />
       </div>
       <div class="form-group col-md-3">
       <label class="form-label">Email :</label> 
       <input type="email" name="email" class="form-control" placeholder="email" />
       </div>
       <div class="form-group col-md-3">
       <label class="form-label">Phone Number:</label> 
       <input type="text" name="phonenumber" class="form-control" placeholder="phonenumber" />
       </div>
        <br>
       <button><a href="{{url('/homeafterlogin')}}">Update</a></button>
    </form>
</div>
@endsection