<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - BookStore</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Georgia', 'Times New Roman', serif;
            overflow-x: hidden;
            background: #1a1410;
            min-height: 100vh;
        }

        /* Navigation */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 25px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            background: rgba(26, 20, 16, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(210, 180, 140, 0.2);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #d2b48c;
            font-size: 26px;
            font-weight: bold;
            letter-spacing: 2px;
            text-decoration: none;
        }

        .logo-icon {
            font-size: 32px;
        }

        .nav-links {
            display: flex;
            gap: 40px;
            align-items: center;
        }

        .nav-links a {
            color: #d2b48c;
            text-decoration: none;
            font-size: 15px;
            transition: all 0.3s;
            font-weight: 500;
            font-family: 'Segoe UI', sans-serif;
        }

        .nav-links a:hover {
            color: #f4e4c1;
        }

        .nav-links .login-btn {
            padding: 10px 28px;
            border: 2px solid #d2b48c;
            border-radius: 25px;
            background: transparent;
        }

        .nav-links .login-btn:hover {
            background: #d2b48c;
            color: #1a1410;
        }

        /* Background */
        .background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            background: linear-gradient(135deg, #2d1810 0%, #1a1410 50%, #0f0a08 100%);
        }

        .bookshelf-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.15;
        }

        .book-row {
            position: absolute;
            width: 100%;
            display: flex;
            gap: 8px;
            padding: 0 30px;
        }

        .row-1 { top: 20%; }
        .row-2 { top: 50%; }
        .row-3 { bottom: 15%; }

        .mini-book {
            width: 45px;
            height: 140px;
            border-radius: 2px;
            box-shadow: inset 0 0 15px rgba(0,0,0,0.3);
        }

        .color-1 { background: linear-gradient(to right, #8b4513 0%, #a0522d 100%); }
        .color-2 { background: linear-gradient(to right, #2f4f4f 0%, #3d5f5f 100%); height: 120px; }
        .color-3 { background: linear-gradient(to right, #8b0000 0%, #a52a2a 100%); height: 150px; }
        .color-4 { background: linear-gradient(to right, #1e3a5f 0%, #2e4a6f 100%); }

        /* Register Modal */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            padding: 20px;
            padding-top: 100px;
            overflow-y: auto;
        }

        .modal {
            background: rgba(42, 35, 28, 0.98);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            border: 2px solid rgba(210, 180, 140, 0.3);
            padding: 50px 45px;
            width: 100%;
            max-width: 440px;
            position: relative;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            margin: auto;
        }

        .close-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background: transparent;
            color: #d2b48c;
            border: none;
            font-size: 28px;
            cursor: pointer;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s;
        }

        .close-btn:hover {
            background: rgba(210, 180, 140, 0.1);
            color: #f4e4c1;
        }

        h2 {
            text-align: center;
            color: #f4e4c1;
            margin-bottom: 35px;
            font-size: 32px;
            font-weight: 700;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #d2b48c;
            font-size: 14px;
            font-weight: 600;
            font-family: 'Segoe UI', sans-serif;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 14px 45px 14px 15px;
            border: 2px solid rgba(210, 180, 140, 0.3);
            border-radius: 10px;
            font-size: 15px;
            background: rgba(26, 20, 16, 0.6);
            transition: all 0.3s;
            color: #f4e4c1;
            font-family: 'Segoe UI', sans-serif;
        }

        input:focus {
            outline: none;
            border-color: #d2b48c;
            box-shadow: 0 0 0 3px rgba(210, 180, 140, 0.1);
            background: rgba(26, 20, 16, 0.8);
        }

        .icon {
            position: absolute;
            right: 15px;
            top: 45px;
            font-size: 18px;
            color: #d2b48c;
        }

        .submit-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #d2b48c 0%, #c9a872 100%);
            color: #1a1410;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 10px;
            font-family: 'Segoe UI', sans-serif;
        }

        .submit-btn:hover {
            background: linear-gradient(135deg, #f4e4c1 0%, #d2b48c 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(210, 180, 140, 0.3);
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: #d2b48c;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-link a {
            color: #f4e4c1;
            text-decoration: none;
            font-weight: 700;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .error {
            color: #ff6b6b;
            font-size: 13px;
            margin-top: 8px;
            font-weight: 500;
            font-family: 'Segoe UI', sans-serif;
        }

        .alert {
            padding: 12px 15px;
            margin-bottom: 20px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            font-family: 'Segoe UI', sans-serif;
        }

        .alert-danger {
            background: rgba(255, 107, 107, 0.1);
            color: #ff6b6b;
            border: 1px solid rgba(255, 107, 107, 0.3);
        }

        @media (max-width: 768px) {
            nav {
                padding: 20px 30px;
            }

            .nav-links {
                gap: 15px;
                font-size: 14px;
            }

            .modal {
                padding: 40px 30px;
            }
        }
    </style>
</head>
<body>
    <div class="background">
        <div class="bookshelf-bg">
            <div class="book-row row-1">
                <div class="mini-book color-1"></div>
                <div class="mini-book color-2"></div>
                <div class="mini-book color-3"></div>
                <div class="mini-book color-4"></div>
                <div class="mini-book color-1"></div>
                <div class="mini-book color-3"></div>
                <div class="mini-book color-2"></div>
                <div class="mini-book color-4"></div>
            </div>
            <div class="book-row row-2">
                <div class="mini-book color-4"></div>
                <div class="mini-book color-2"></div>
                <div class="mini-book color-1"></div>
                <div class="mini-book color-3"></div>
                <div class="mini-book color-4"></div>
                <div class="mini-book color-1"></div>
                <div class="mini-book color-2"></div>
                <div class="mini-book color-3"></div>
            </div>
            <div class="book-row row-3">
                <div class="mini-book color-3"></div>
                <div class="mini-book color-1"></div>
                <div class="mini-book color-4"></div>
                <div class="mini-book color-2"></div>
                <div class="mini-book color-3"></div>
                <div class="mini-book color-4"></div>
                <div class="mini-book color-1"></div>
                <div class="mini-book color-2"></div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav>
        <a href="/" class="logo">
            <span class="logo-icon">📚</span>
            <span>BookHouse</span>
        </a>
        <div class="nav-links">
            <a href="{{ route('login') }}" class="login-btn">Login</a>
        </div>
    </nav>

    <!-- Register Modal -->
    <div class="modal-overlay">
        <div class="modal">
            <a href="/" class="close-btn">×</a>
            <h2>Join Our Story</h2>
            
            @if($errors->any())
                <div class="alert alert-danger">
                    Please check the form for errors.
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Enter your name">
                    <span class="icon">👤</span>
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="your@email.com">
                    <span class="icon">📧</span>
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required placeholder="Create a password">
                    <span class="icon">🔒</span>
                    @error('password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Confirm your password">
                    <span class="icon">🔒</span>
                </div>

                <button type="submit" class="submit-btn">Create Account</button>

                <div class="login-link">
                    Already have an account? <a href="{{ route('login') }}">Login</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>