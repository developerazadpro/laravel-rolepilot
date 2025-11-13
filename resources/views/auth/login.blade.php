<x-guest-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #1e3a8a, #9333ea, #ec4899);
            background-size: 400% 400%;
            animation: gradientShift 10s ease infinite;
            margin: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Overlay */
        .overlay {
            position: fixed;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
        }

        /* Popup card */
        .popup-card {
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(25px);
            padding: 50px 40px;
            border-radius: 20px;
            width: 400px;
            box-shadow: 0 12px 30px rgba(0,0,0,0.6);
            color: #fff;
            position: relative;
            animation: popupIn 0.4s ease forwards;
            transition: box-shadow 0.4s ease;
        }

        .popup-card:hover {
            box-shadow: 0 0 35px rgba(236,72,153,0.6);
        }

        @keyframes popupIn {
            0% { transform: scale(0.5); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }

        /* Close button */
        .close-btn {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 1.5rem;
            color: #fff;
            cursor: pointer;
        }

        /* Input boxes */
        .input-box {
            position: relative;
            margin-bottom: 30px;
        }

        .input-box input {
            width: 100%;
            padding: 14px 16px;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 12px;
            color: #fff;
            font-size: 1rem;
            outline: none;
            transition: all 0.3s ease;
        }

        .input-box input::placeholder {
            color: rgba(255,255,255,0.6);
        }

        .input-box input:focus {
            background: rgba(255,255,255,0.15);
            border-color: #ec4899;
            box-shadow: 0 0 15px rgba(236,72,153,0.7);
        }

        .input-box label {
            display: block;
            margin-bottom: 6px;
            color: rgba(255,255,255,0.8);
            font-weight: 500;
        }

        /* Remember & Forgot */
        .remember {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.9rem;
            margin-bottom: 30px;
        }

        .remember a {
            color: #f9a8d4;
            text-decoration: none;
        }

        .remember a:hover {
            text-decoration: underline;
        }

        /* Submit button */
        .btn {
            width: 100%;
            padding: 16px;
            border-radius: 30px;
            border: none;
            background: linear-gradient(to right, #ec4899, #8b5cf6);
            color: #fff;
            font-weight: 600;
            font-size: 1.05rem;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            transform: scale(1.05);
            box-shadow: 0 0 25px rgba(236,72,153,0.7);
        }

        /* Status message */
        .status-message {
            background-color: rgba(236,72,153,0.2);
            padding: 12px;
            border-radius: 12px;
            color: #fff;
            text-align: center;
            margin-bottom: 25px;
            font-size: 0.95rem;
        }

        .bg-gray-100 {
            background: none!important;
        }
    </style>

    <div class="overlay" id="loginPopup">
        <div class="popup-card">
            <h2 style="text-align:center; margin-bottom:40px;">Login</h2>

            @if (session('status'))
                <div class="status-message">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="input-box">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required autofocus>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-pink-200 text-sm" />
                </div>

                <div class="input-box">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" placeholder="Enter your password" required autocomplete="current-password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-pink-200 text-sm" />
                </div>

                <div class="remember">
                    <label><input type="checkbox" name="remember"> Remember Me</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Forgot Password?</a>
                    @endif
                </div>

                <button type="submit" class="btn">Login</button>
            </form>
        </div>
    </div>

</x-guest-layout>
