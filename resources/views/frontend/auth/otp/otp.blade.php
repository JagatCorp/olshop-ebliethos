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
            font-size: 20px;

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
        <h1>Silahkan Pilih Kirim OTP Melalui</h1>
        <form action="{{ route('send.otp') }}" method="POST" class="form">
            @csrf
            <label for="otpMethodEmail">Email:</label>
            <input type="hidden" name="otp_method" value="email" class="input">
            <button type="submit" class="btn">Kirim Kode Verifikasi ke Email</button>
        </form>

        <form action="{{ route('send.otp') }}" method="POST" class="form">
            @csrf
            <label for="otpMethodPhone">No HP:</label>
            <input type="hidden" name="otp_method" value="phone">
            <button type="submit" class="btn">Kirim Kode Verifikasi ke WhatsApp</button>
        </form>
    </div>
@endsection
