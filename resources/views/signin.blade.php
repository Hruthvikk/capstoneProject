@extends('main')
@section('content')
    <div class="loginform">
        <h2>Sign in</h2>
        <form action="{{ route('login-user') }}" method="post">
            @csrf
            <div class="form-group col-md-3">
                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('fail'))
                    <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                @endif
            </div>
            <div class="form-group col-md-3">
                <label class="form-label">Email</label>
                <input type="email" name="userEmail" class="form-control" value="{{ old('userEmail') }}"
                    placeholder="email" />
                <span class="text-danger">
                    @error('userEmail')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group col-md-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
              </div>
            <div class="form-group col-md-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="password" />
                <span class="text-danger">
                    @error('password')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <br>
            <button class="signinupbtn" type="submit">Login</button>
        </form>
    </div>
@endsection
