<x-guest-layout>
    <style>
        .auth-page {
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            background: #fff8f2;
        }

        .auth-card {
            width: min(100%, 440px);
            padding: 36px;
            background: white;
            border: 3px solid #ffb8e3;
            border-radius: 24px;
            box-shadow: 0 7px 0 #f5d6e8;
        }

        .auth-card h1 {
            margin-bottom: 8px;
            color: #75172d;
            font-size: 32px;
            text-align: center;
        }

        .auth-subtitle {
            margin-bottom: 28px;
            color: #ce4a4a;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            color: #75172d;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 12px 14px;
            border: 2px solid #f3b2d5;
            border-radius: 10px;
            font-size: 15px;
            outline: none;
        }

        .form-group input:focus {
            border-color: #ce4a4a;
        }

        .remember-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 22px;
            color: #75172d;
        }

        .login-button {
            width: 100%;
            padding: 13px;
            border: 0;
            border-radius: 10px;
            background: #ce4a4a;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .login-button:hover {
            background: #a93636;
        }

        .auth-links {
            margin-top: 22px;
            text-align: center;
        }

        .auth-links a {
            color: #ce4a4a;
            font-weight: bold;
            text-decoration: none;
        }

        .auth-links a:hover {
            color: #75172d;
        }

        .error-message {
            margin-top: 6px;
            color: #c0392b;
            font-size: 14px;
        }
    </style>

    <div class="auth-page">
        <div class="auth-card">
            <h1>Welcome Back</h1>
            <p class="auth-subtitle">Log in to manage your tasks</p>

            <x-auth-session-status
                class="mb-4"
                :status="session('status')"
            />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    >

                    @error('email')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                    >

                    @error('password')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <label class="remember-row">
                    <input type="checkbox" name="remember">
                    Remember me
                </label>

                <button class="login-button" type="submit">
                    Log In
                </button>
            </form>

            <div class="auth-links">
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">
                        Create an account
                    </a>
                @endif
            </div>
        </div>
    </div>
</x-guest-layout>