<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    @extends('layouts.app')
    <style>
        body {
            background: linear-gradient(to right, #22b2b2, #ffffff);
            font-family: 'Segoe UI', sans-serif;

            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Styling untuk card login */
        .card {
            background: linear-gradient(135deg, #ffffff);
            border: none;
            display: flex;
            margin-left: 500px;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 500px;
        }

        /* Styling untuk header card */
        .card-header {
            background-color: #117979;
            color: #fff;
            text-align: center;
            font-weight: bold;
            border-radius: 15px 15px 0 0;
        }

        /* Styling untuk label */
        .form-label {
            color: #117979;
            font-weight: bold;
        }

        /* Styling untuk input field */
        .form-control {
            border: none;
            border-bottom: 2px solid #117979;
            border-radius: 0;
            background-color: #f8f8f8;
            color: #333;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #22adb2;
        }

        /* Styling untuk tombol "Login" */
        .btn-primary {
            background: #22adb2;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .btn-primary:hover {
            background: #117979;
        }

        /* Styling untuk link "Forgot Your Password?" */
        .btn-link {
            color: #117979;
            text-decoration: none;
        }

        /* Styling untuk pesan kesalahan */
        .invalid-feedback {
            color: #ff0000;
        }
        .fancy-text {
        font-size: 2.9em;
        color: #117979;
        text-transform: uppercase;
        font-weight: bold;
        text-shadow: 2px 2px 0px rgba(255, 255, 255, 0.5),
            3px 3px 0px rgba(0, 0, 0, 0.2),
            8px 8px 10px rgba(0, 0, 0, 0.3);
    }

    .fancy-text:hover {
        transform: rotateY(20deg);
        transition: transform 0.5s ease;
    }
    .btn-primary {
            background-color: #070f3e;
            /* Warna latar belakang tombol */
            color: #ffffff;
            /* Warna teks tombol */
            transition: box-shadow 0.3s, transform 0.3s, color 0.3s;
            /* Efek transisi untuk bayangan, transformasi, dan warna teks */
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
            /* Bayangan awal */
        }

        .btn-primary:hover {
            background-color: #ffffff;
            /* Warna latar belakang saat dihover */
            color: #343a40;
            /* Warna teks saat dihover */
            transform: scale(1.1);
            /* Perubahan ukuran saat dihover */
            box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.5);
            /* Bayangan saat dihover */
        }
    </style>

    @section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="mb-4 fancy-text" style=" font-weight: 100px;">Login</h1>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" class="form-control" name="email" autocomplete="email" autofocus>

                    @if($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" class="form-control" name="password"  autocomplete="current-password">

                    {{-- @error('password')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror --}}
                    <div>
                        @if($errors->has('password'))
                        <span
                            class="text-danger">{{ $errors->first('password') }}
                        </span>
                        @endif
                    </div>
                </div>


                <div class="mb-4">
                    <button type="submit" class="btn btn-primary btn-block">
                        Login
                    </button>
                </div>
            </form>

            <p class="text-center mb-0">Belum punya akun? <a href="{{ url('register') }}">Daftar sekarang</a></p>
        </div>
    </div>
    @endsection

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
