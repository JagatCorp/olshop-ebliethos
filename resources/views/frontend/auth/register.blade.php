@extends('frontend.layout')
@section('title', 'Register')
@section('content')
    <style>
        .input-container {
            position: relative;
            display: block;
        }

        #passwordInput {
            padding-right: 60px;
            /* Adjust the padding as needed to create space for the icon */
        }

        #togglePassword {
            position: absolute;
            right: 20px;
            /* Adjust the right position as needed */
            top: 50%;
            transform: translateY(-50%);
            width: 25px;
            /* Adjust the width as needed */
            height: 25px;
            /* Adjust the height as needed */
            cursor: pointer;
        }

        @media (max-width: 767px) {
            .col-3.col-md {
                width: 100%;
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
    </style>

    <div class="pb-5">
        <div class="bg order-1 order-md-2" style="background-image: url('images/bg_1.jpg');"></div>
        <div class="contents order-2 order-md-1">

            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-6">
                        <div class="form-block">
                            <div class="text-center mb-5">
                                <h3><strong>Buat Akun</strong></h3>
                            </div>

                            <form id="register-form" name="register-form" class="row mb-0" action="{{ route('register') }}"
                                method="POST">
                                @csrf
                                <div class="form-group first mb-4">
                                    <label class="text-muted" style="margin-bottom: -5px">First Name</label>
                                    <input type="text" class="form-control  @error('first_name') is-invalid @enderror"
                                        id="register-form-first_name" name="first_name" value="{{ old('first_name') }}">
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group first mb-4">
                                    <label class="text-muted" style="margin-bottom: -5px">Last Name</label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                        id="register-form-username" name="last_name" value="{{ old('last_name') }}">
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group first mb-4">
                                    <label class="text-muted" style="margin-bottom: -5px">Email</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                        id="register-form-email" name="email" value="{{ old('email') }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group last mb-4">
                                    <label class="text-muted" style="margin-bottom: -5px">Password</label>
                                    <div class="input-container">
                                        <input type="password" value="{{ old('password') }}"
                                            class="form-control @error('password') is-invalid @enderror" id="passwordInput"
                                            name="password">
                                        <img src="assets-auth/eye-slash.png" id="togglePassword" alt="Toggle Password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="form-group first mb-4">
                                    <label class="text-muted" style="margin-bottom: -5px">Confirm Password</label>
                                    <input type="text"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        id="register-form-email" name="password_confirmation"
                                        value="{{ old('password_confirmation') }}">
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group first">
                                    <button class="btn btn-block mb-3"
                                        style="background-color: #B42225; color: white; border-radius: 0; font-size: x-large"
                                        id="register-form-submit" name="register-form-submit"
                                        value="register">Register</button>
                                </div>
                                <a href="{{ url('login') }}">
                                    <p class="mb-4 text-center font-weight-bold text-decoration-underline"
                                        style="color: #B42225;">Login</p>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById("passwordInput");
        // const eyeIcon = document.getElementById("eyeIcon");
        const togglePassword = document.getElementById("togglePassword");

        togglePassword.addEventListener("click", () => {
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                // eyeIcon.classList.remove("fa-eye");
                // eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                // eyeIcon.classList.remove("fa-eye-slash");
                // eyeIcon.classList.add("fa-eye");
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
@endsection
