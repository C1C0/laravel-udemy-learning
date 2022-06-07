@extends('layouts.app')

@section('content')

    <form action="{{route('login')}}" method="POST">
        @csrf

        <div class="form-group">
            <label>E-mail</label>
            <input type="email" name="email" value="{{old('email')}}" required
                   class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}">

            @if($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{$errors->first('email')}}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required
                   class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}">
        </div>

        <div class="form-group">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="remember"
                       value="{{ old('remember') ? 'checked' : '' }}">
                <label for="remember" class="form-check-label">
                    Remember me
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Register</button>
    </form>
@endsection
