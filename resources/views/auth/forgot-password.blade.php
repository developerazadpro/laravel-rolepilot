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

        .popup-card {
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(25px);
            padding: 50px 40px;
            border-radius: 20px;
            width: 420px;
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

        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .description {
            color: rgba(255,255,255,0.8);
            font-size: 0.95rem;
            text-align: center;
            margin-bottom: 25px;
            line-height: 1.5;
        }

        .input-box {
            margin-bottom: 30px;
        }

        .input-box label {
            display: block;
            margin-bottom: 6px;
            color: rgba(255,255,255,0.85);
            font-weight: 500;
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

        .btn {
            width: 100%;
            padding: 15px;
            border-radius: 30px;
            border: none;
            background: linear-gradient(to right, #ec4899, #8b5cf6);
            color: #fff;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            transform: scale(1.05);
            box-shadow: 0 0 25px rgba(236,72,153,0.7);
        }

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

    <div class="overlay">
        <div class="popup-card">
            <h2>Forgot Password</h2>

            <p class="description">
                No problem! Enter your email below and we’ll send you a password reset link.
            </p>

            <!-- Session Status -->
            <x-auth-session-status class="status-message" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="input-box">
                    <label for="email">Email Address</label>
                    <input id="email" type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required autofocus>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-pink-200 text-sm" />
                </div>

                <button type="submit" class="btn">Send Reset Link</button>
            </form>
        </div>
    </div>
</x-guest-layout>
