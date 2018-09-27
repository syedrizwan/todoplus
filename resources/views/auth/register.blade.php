@extends('layouts.guest')

@section('content')
    <div class="login-body">
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                {{ $errors->first() }}
            </div>
        @endif
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="login-title"><strong>Register</strong> your account</div>
        <form method="POST" action="{{ route('register') }}" class="form-horizontal">
            @csrf
            <div class="form-group">
                <div class="col-md-12">
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                           name="name" value="{{ old('name') }}" required autofocus placeholder="Name">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
                </div>
            </div>
            {{--<div class="form-group">
                <div class="col-md-12">
                    <input type="text" class="form-control" placeholder="E-mail"/>
                </div>
            </div>--}}
            <div class="form-group">
                <div class="col-md-12">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                           name="password" required placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                           required placeholder="Confirm Password">
                </div>
            </div>
            {{--<div class="form-group">
                <div class="col-md-12">
                    <input type="password" class="form-control" placeholder="Password"/>
                </div>
            </div>--}}
            <div class="form-group">
                <div class="col-md-6">

                </div>
                <div class="col-md-6">
                    <button class="btn btn-info btn-block">Register</button>
                </div>
            </div>
            <div class="login-subtitle">
                Already have an account? <a href="{{ route('login') }}" class="btn btn-link" style="color: #fff;">Log In</a>
            </div>
        </form>
    </div>
{{--<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>--}}
@endsection