@extends('frontend.layout')

@section('content')
    <!-- register-area start -->
    <div class="register-area ptb-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-12 col-lg-12 col-xl-6 ml-auto mr-auto">
                    <div class="login">
                        <div class="login-form-container">
                            <div class="text-center mb-3">
                                <h3><strong>Reset Password</strong></h3>
                            </div>
                            <div class="login-form">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <input id="email" type="email"
                                                class="form-control mb-3 @error('email') is-invalid @enderror"
                                                name="email" value="{{ $email ?? old('email') }}" required
                                                autocomplete="email" autofocus placeholder="{{ __('E-Mail Address') }}">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <input id="password" type="password"
                                                class="form-control mb-3 @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="new-password"
                                                placeholder="{{ __('Password') }}">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <input id="password-confirm" type="password" class="form-control mb-3"
                                                name="password_confirmation" required autocomplete="new-password"
                                                placeholder="{{ __('Confirm Password') }}">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-12">
                                            <div class="button-box">
                                                <button type="submit" class="btn btn-block mb-3"
                                                    style="background-color: #B42225; color: white; border-radius: 0; font-size: x-large">{{ __('Reset Password') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- register-area end -->
@endsection
