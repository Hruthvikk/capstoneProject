@extends('main')
@section('content')
    <div class="registerform">
        <h2>Sign Up</h2>
        <form action="{{ route('register-user') }}" method="post">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-3">
                    @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                    @if (Session::has('fail'))
                        <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                    @endif
                </div>
                <div class="form-group col-md-3">
                    <label class="form-label">First Name</label>
                    <input type="text" name="firstname" class="form-control" value="{{ old('firstname') }}"
                        placeholder="first name" />
                    <span class="text-danger">
                        @error('firstname')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-3">
                    <label class="form-label">Last Name</label>
                    <input type="text" name="lastname" class="form-control" value="{{ old('lastname') }}"
                        placeholder="last name" />
                    <span class="text-danger">
                        @error('lastname')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                        placeholder="email" />
                    <span class="text-danger">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-3">
                    <label class="form-label">Phone Number</label>
                    <input type="text" name="phonenum" class="form-control" value="{{ old('phonenum') }}"
                        placeholder="phone number" />
                    <span class="text-danger">
                        @error('phonenum')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label class="form-label">Password</label>
                    <input type="password" id="inputValidationEx2" name="password" class="form-control validate"
                        placeholder="password" />

                    <span class="text-danger">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="confirmpassword" class="form-control" placeholder="confirmpassword" />
                    <span class="text-danger">
                        @error('confirmpassword')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
            </div>
            <br>
            <input type="submit" class="signinupbtn" value="Sign Up">
        </form>
    </div>
@endsection
