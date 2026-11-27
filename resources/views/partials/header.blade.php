<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Tasks for Today' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background: #fff8f2;
            color: #75172d;
        }

        .site-shell {
            width: min(92%, 1100px);
            margin: 0 auto;
        }

        .site-header {
            margin-top: 28px;
            padding: 24px 32px;
            background: #fef9b7;
            border-radius: 25px;
            box-shadow: 0 7px 0 #fbdd95;
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .brand {
            color: #75172d;
            font-size: 28px;
            font-weight: bold;
            text-decoration: none;
        }

        .site-nav {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .site-nav a,
        .logout-button {
            border: 0;
            background: none;
            color: #ce4a4a;
            font-family: inherit;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
        }

        .site-nav a:hover,
        .logout-button:hover {
            color: #75172d;
        }

        .form-page {
            max-width: 650px;
            margin: 0 auto;
            padding: 55px 0;
        }

        .form-card {
            padding: 34px;
            background: white;
            border: 3px solid #ffb8e3;
            border-radius: 24px;
            box-shadow: 0 7px 0 #f5d6e8;
        }

        .form-card h1 {
            margin: 0 0 8px;
            color: #75172d;
            font-size: 32px;
            font-weight: 700;
        }

        .form-description {
            margin-bottom: 28px;
            color: #ce4a4a;
        }

        .form-group {
            margin-bottom: 21px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #75172d;
            font-weight: bold;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 13px 14px;
            border: 2px solid #f3b2d5;
            border-radius: 10px;
            background: white;
            color: #75172d;
            font-family: inherit;
            font-size: 15px;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #ce4a4a;
            outline: none;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 28px;
        }

        .submit-button,
        .cancel-button {
            padding: 12px 19px;
            border: 0;
            border-radius: 10px;
            font-family: inherit;
            font-size: 15px;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
        }

        .submit-button {
            background: #ce4a4a;
            color: white;
        }

        .submit-button:hover {
            background: #a93636;
        }

        .cancel-button {
            background: #f7c95c;
            color: #5f4310;
        }

        .cancel-button:hover {
            background: #eab83e;
        }

        .error-list {
            margin-bottom: 22px;
            padding: 14px 18px;
            border-radius: 10px;
            background: #ffe0e0;
            color: #a93636;
        }

        .error-list ul {
            margin: 0;
            padding-left: 20px;
        }

        .site-footer {
            padding: 30px 0 40px;
            color: #ce4a4a;
            text-align: center;
        }

        @media (max-width: 700px) {
            .header-content {
                align-items: flex-start;
                flex-direction: column;
            }

            .site-nav {
                flex-wrap: wrap;
                gap: 12px;
            }

            .form-card {
                padding: 25px;
            }
        }
    </style>
</head>

<body>
    <div class="site-shell">
        <header class="site-header">
            <div class="header-content">
                <a class="brand" href="{{ route('home') }}">
                    Astrelyx
                </a>

                <nav class="site-nav">
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ route('tasks.index') }}">Tasks</a>
                    <a href="{{ route('about') }}">About</a>

                    @auth
                        <a href="{{ url('/profile') }}">Profile</a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button class="logout-button" type="submit">
                                Log out
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}">Log in</a>
                    @endauth
                </nav>
            </div>
        </header>

        <main>