@extends('frontend.layout')

@section('content')
    <!-- register-area start -->
    <div class="register-area ptb-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-12 col-lg-12 col-xl-6 ml-auto mr-auto">
                    <div class="login">
                        <div class="login-form-container">
                            <div class="login-form">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="form-group first mb-4">
                                        <label class="text-muted" style="margin-bottom: -5px">Email</label>
                                        <input type="text" class="form-control  @error('email') is-invalid @enderror"
                                            id="login-form-username" name="email" value="{{ old('email') }}" required
                                            autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-12">
                                            <div class="button-box">
                                                <button type="submit"
                                                    class="btn btn-primary rounded-5 ">{{ __('Send Password Reset Link') }}</button>
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
