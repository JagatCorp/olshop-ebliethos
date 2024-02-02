@extends('frontend.layout')
@section('title', 'Login')
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

    <div class="pb-5 mt-4">
        <div class="bg order-1 order-md-2" style="background-image: url('images/bg_1.jpg');"></div>
        <div class="contents order-2 order-md-1">

            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-6">
                        <div class="form-block">
                            <div class="text-center mb-5">
                                <h3><strong>Masuk Sebagai</strong></h3>
                            </div>
                            <form id="login-form" name="login-form" class="row mb-0" action="{{ route('login') }}"
                                method="POST">
                                @csrf
                                <?php if (session('msg_status')) : ?>
                                <div class="col-12 mx-auto">
                                    <div class="alert text-white alert-<?= session('msg_status') ?> alert-dismissible fade show"
                                        role="alert" style="background-color: #B42225">
                                        <?= session('msg') ?>
                                        <button type="button" class="btn-close text-white" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                                <?php endif; ?> <div class="form-group first mb-4">
                                    <label class="text-muted" style="margin-bottom: -5px">Email</label>
                                    <input type="text" class="form-control  @error('email') is-invalid @enderror"
                                        id="login-form-username" name="email" value="{{ old('email') }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group last mb-4">
                                    <label class="text-muted" style="margin-bottom: -5px">Password</label>
                                    <div class="input-container">
                                        <input type="password" class="form-control  @error('password') is-invalid @enderror"
                                            id="passwordInput" name="password" value="{{ old('password') }}">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <img src="/assets-auth/eye-slash.png" id="togglePassword" alt="Toggle Password">
                                    </div>
                                </div>
                                <div class="form-group last">
                                    <button type="submit" class="btn btn-block mb-3" id="login-form-submit"
                                        style="background-color: #B42225; color: white; border-radius: 0; font-size: x-large"
                                        value="login">Masuk</button>
                                </div>
                                <a href="register">
                                    <p class="mb-4 text-center font-weight-bold text-decoration-underline"
                                        style="color: #B42225;">Daftar</p>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"
        integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
