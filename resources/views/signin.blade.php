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
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="bi bi-envelope-at"></i></div>
                    </div>
                    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Username">
                  </div>
                <input type="email" name="userEmail" class="form-control" value="{{ old('userEmail') }}"
                    placeholder="email" />
                <span class="text-danger">
                    @error('userEmail')
                        {{ $message }}
                    @enderror
                </span>
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
