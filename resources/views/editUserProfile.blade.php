@extends('mainafterlogin')
@section('content')
    <div class="editformm">
    
    <form method="POST" action="">
        @csrf
        @method('PUT')
        <div class="form-group col-md-3">
        @if(Session::has('success2'))
        <div class="alert alert-info">{{Session::get('success2')}}</div>
        @endif
            <label class="form-label">First Name:</label> 
            <input type="text" name="firstname" class="form-control" placeholder="{{$userdata->userFirstName}}"  disabled readonly/>
            </div>
            <div class="form-group col-md-3">
            <label class="form-label">Last Name:</label> 
            <input type="text" name="lastname" class="form-control" placeholder="{{$userdata->userLastName}}" disabled readonly />
            </div>
            <div class="form-group col-md-3">
            <label class="form-label">Email :</label> 
            <input type="email" name="email" class="form-control" placeholder="{{$userdata->userEmail}}" value="{{$userdata->userEmail}}" />
            <span class="text-danger">@error('email'){{$message}}@enderror</span>
            </div>
            <div class="form-group col-md-3">
            <label class="form-label">Phone Number:</label> 
            <input type="text" name="phonenumber" class="form-control" placeholder="{{$userdata->userPhoneNumber}}"  value="{{$userdata->userPhoneNumber}}"/>
            <span class="text-danger">@error('phonenumber'){{$message}}@enderror</span>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    

@endsection