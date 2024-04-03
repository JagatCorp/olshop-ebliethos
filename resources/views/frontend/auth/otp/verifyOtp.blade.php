@extends('frontend.layout')

@section('content')
    <style>
        @media only screen and (min-width: 768px) {
            .containe {
                width: 100%;
                max-width: 500px;
                margin: 0 auto;
                padding: 20px;
            }

        }

        h1 {
            text-align: center;
        }

        .form {
            background-color: #f2f2f2;
            border-radius: 5px;
            padding: 20px;
        }

        .input {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn {
            background-color: #B42225;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            /* padding-top: 10px; */
            padding-bottom: 50px;

        }

        .button:hover {
            background-color: #B42225;
        }
    </style>
    @include('sweetalert::alert')
    <div class="containe">
        <h1>Silahkan Verifikasi</h1>
        <form action="{{ route('verify.otp') }}" method="POST" class="form" enctype="multipart/form-data">
            @csrf
            <label for="otpCode">Masukkan Kode OTP:</label>
            <input type="number" id="otpCode" name="otpCode" class="input" maxlength="4">
            <button type="submit" class="btn">Verifikasi</button>
        </form>

    </div>
@endsection
