<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - BookHouse</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #1a1410;
            color: #f4e4c1;
            position: relative;
            min-height: 100vh;
        }

        /* Background */
        .background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            background: linear-gradient(135deg, #2d1810 0%, #1a1410 50%, #0f0a08 100%);
        }

        .bookshelf-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.1;
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

        /* Navigation */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 20px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            background: rgba(26, 20, 16, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(210, 180, 140, 0.2);
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 50px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #d2b48c;
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
        }

        .logo-icon {
            font-size: 28px;
        }

        .back-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #d2b48c;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .back-btn:hover {
            background: rgba(210, 180, 140, 0.15);
            color: #f4e4c1;
        }

        /* Main Content */
        .main-content {
            position: relative;
            z-index: 1;
            padding-top: 120px;
            max-width: 800px;
            margin: 0 auto;
            padding-left: 60px;
            padding-right: 60px;
            padding-bottom: 60px;
        }

        .profile-card {
            background: rgba(42, 35, 28, 0.95);
            border: 2px solid rgba(210, 180, 140, 0.3);
            border-radius: 20px;
            padding: 50px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.5);
        }

        .profile-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .profile-title {
            font-size: 32px;
            font-weight: 700;
            color: #f4e4c1;
            margin-bottom: 10px;
            font-family: 'Georgia', serif;
        }

        .profile-subtitle {
            font-size: 14px;
            color: #d2b48c;
        }

        /* Photo Upload Section */
        .photo-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 40px;
            padding-bottom: 40px;
            border-bottom: 1px solid rgba(210, 180, 140, 0.2);
        }

        .photo-preview {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: linear-gradient(135deg, #d2b48c 0%, #c9a872 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1a1410;
            font-size: 48px;
            font-weight: bold;
            margin-bottom: 20px;
            border: 4px solid rgba(210, 180, 140, 0.3);
            overflow: hidden;
            position: relative;
        }

        .photo-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .photo-buttons {
            display: flex;
            gap: 15px;
        }

        .upload-btn,
        .remove-btn {
            padding: 10px 25px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: none;
        }

        .upload-btn {
            background: linear-gradient(135deg, #d2b48c 0%, #c9a872 100%);
            color: #1a1410;
        }

        .upload-btn:hover {
            background: linear-gradient(135deg, #f4e4c1 0%, #d2b48c 100%);
            transform: translateY(-2px);
        }

        .remove-btn {
            background: rgba(255, 107, 107, 0.2);
            color: #ff6b6b;
            border: 2px solid rgba(255, 107, 107, 0.3);
        }

        .remove-btn:hover {
            background: rgba(255, 107, 107, 0.3);
            color: #ff4757;
        }

        #profile_photo {
            display: none;
        }

        /* Form Section */
        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #d2b48c;
            font-size: 14px;
            font-weight: 600;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 14px 15px;
            border: 2px solid rgba(210, 180, 140, 0.3);
            border-radius: 10px;
            font-size: 15px;
            background: rgba(26, 20, 16, 0.6);
            transition: all 0.3s;
            color: #f4e4c1;
        }

        input:focus {
            outline: none;
            border-color: #d2b48c;
            background: rgba(26, 20, 16, 0.8);
        }

        input:disabled {
            opacity: 0.5;
            cursor: not-allowed;
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
        }

        .submit-btn:hover {
            background: linear-gradient(135deg, #f4e4c1 0%, #d2b48c 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(210, 180, 140, 0.3);
        }

        .alert {
            padding: 12px 15px;
            margin-bottom: 20px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
        }

        .alert-success {
            background: rgba(76, 175, 80, 0.1);
            color: #4caf50;
            border: 1px solid rgba(76, 175, 80, 0.3);
        }

        .alert-danger {
            background: rgba(255, 107, 107, 0.1);
            color: #ff6b6b;
            border: 1px solid rgba(255, 107, 107, 0.3);
        }

        .error {
            color: #ff6b6b;
            font-size: 13px;
            margin-top: 8px;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            nav {
                padding: 20px 30px;
            }

            .main-content {
                padding-left: 30px;
                padding-right: 30px;
            }

            .profile-card {
                padding: 30px;
            }
        }
    </style>
</head>
<body>
    <!-- Background -->
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
            </div>
            <div class="book-row row-3">
                <div class="mini-book color-3"></div>
                <div class="mini-book color-1"></div>
                <div class="mini-book color-4"></div>
                <div class="mini-book color-2"></div>
                <div class="mini-book color-3"></div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav>
        <div class="nav-left">
            <a href="{{ url('/dashboard') }}" class="logo">
                <span class="logo-icon">📚</span>
                <span>BookHouse</span>
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="profile-card">
            <div class="profile-header">
                <h1 class="profile-title">My Profile</h1>
                <p class="profile-subtitle">Manage your account information</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    Please check the form for errors.
                </div>
            @endif

            <!-- Photo Upload Section -->
            <div class="photo-section">
                <div class="photo-preview" id="photoPreview">
                    @if($user->profile_photo)
                        <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile Photo">
                    @else
                        {{ substr($user->name, 0, 1) }}
                    @endif
                </div>
                <div class="photo-buttons">
                    <button type="button" class="upload-btn" onclick="document.getElementById('profile_photo').click()">
                        📷 Upload Photo
                    </button>
                    @if($user->profile_photo)
                        <form method="POST" action="{{ route('profile.remove-photo') }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="remove-btn" onclick="return confirm('Are you sure you want to remove your profile photo?')">
                                🗑️ Remove Photo
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <!-- Profile Form -->
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="file" id="profile_photo" name="profile_photo" accept="image/*" onchange="previewImage(event)">

                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" value="{{ $user->email }}" disabled>
                    <small style="color: #8b7355; font-size: 12px; display: block; margin-top: 5px;">Email cannot be changed</small>
                </div>

                <button type="submit" class="submit-btn">Save Changes</button>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('photoPreview');
                    preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview" style="width: 100%; height: 100%; object-fit: cover;">';
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>