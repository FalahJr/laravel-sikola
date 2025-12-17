<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ __('Login Sikola App') }}</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <!-- Favicon: SVG with PNG fallback -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('img/logo-lms.svg') }}">
    <link rel="shortcut icon" href="{{ asset('img/logo-lms.png') }}">
    <style>
        /* Futuristic Login Design */
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        .login-wrapper {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }

        /* Animated background elements */
        .login-wrapper::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -250px;
            right: -250px;
            animation: float 20s ease-in-out infinite;
        }

        .login-wrapper::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            bottom: -200px;
            left: -200px;
            animation: float 15s ease-in-out infinite reverse;
        }

        @keyframes float {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            50% {
                transform: translate(30px, 30px) scale(1.1);
            }
        }

        .login-container {
            position: relative;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            padding: 20px;
        }

        .login-glass-card {
            width: 100%;
            max-width: 1100px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            display: flex;
            flex-direction: row;
        }

        .login-left-panel {
            flex: 1;
            padding: 20px 50px;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .login-illustration {
            width: 100%;
            max-width: 400px;
            /* margin-bottom: 30px; */
            animation: pulse 3s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .feature-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(102, 126, 234, 0.1);
            padding: 8px 16px;
            border-radius: 20px;
            margin: 5px;
            font-size: 13px;
            color: #667eea;
            font-weight: 500;
        }

        .login-right-panel {
            flex: 1;
            padding: 50px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand-header {
            text-align: center;
            /* margin-bottom: 40px; */
        }

        .brand-logo-futuristic {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
            transform: rotate(-5deg);
            transition: transform 0.3s ease;
        }

        .brand-logo-futuristic:hover {
            transform: rotate(0deg) scale(1.05);
        }

        .brand-logo-futuristic img {
            width: 50px;
            height: 50px;
            filter: brightness(0) invert(1);
        }

        .login-heading {
            font-size: 32px;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 10px;
        }

        .login-subheading {
            color: #6b7280;
            font-size: 15px;
            margin-bottom: 30px;
        }

        .modern-form-group {
            margin-bottom: 25px;
        }

        .modern-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }

        .modern-input-wrapper {
            position: relative;
        }

        .modern-input {
            width: 100%;
            padding: 15px 20px 15px 50px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #f9fafb;
        }

        .modern-input:focus {
            outline: none;
            border-color: #667eea;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 18px;
        }

        .toggle-password {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #9ca3af;
            transition: color 0.3s ease;
        }

        .toggle-password:hover {
            color: #667eea;
        }

        .btn-futuristic {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
            position: relative;
            overflow: hidden;
        }

        .btn-futuristic::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transition: left 0.5s ease;
        }

        .btn-futuristic:hover::before {
            left: 100%;
        }

        .btn-futuristic:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.5);
        }

        .login-footer-text {
            text-align: center;
            margin-top: 25px;
            color: #6b7280;
            font-size: 14px;
        }

        .stats-row {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 28px;
            font-weight: 800;
            color: #667eea;
            display: block;
        }

        .stat-label {
            font-size: 12px;
            color: #6b7280;
            margin-top: 5px;
        }

        @media (max-width: 991px) {
            .login-glass-card {
                flex-direction: column;
            }

            .login-left-panel {
                padding: 40px 30px;
            }

            .login-right-panel {
                padding: 40px 30px;
            }

            .login-illustration {
                max-width: 300px;
            }
        }

        @media (max-width: 576px) {
            .login-heading {
                font-size: 26px;
            }

            .brand-logo-futuristic {
                width: 70px;
                height: 70px;
            }

            .login-right-panel,
            .login-left-panel {
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>
    <div id="app">
        <div class="login-wrapper">
            <div class="login-container">
                <div class="login-glass-card">
                    <!-- Left Panel - Illustration & Features -->
                    <div class="login-left-panel">
                        <div class="login-illustration">
                            <svg viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg">
                                <!-- Computer Screen -->
                                <rect x="100" y="120" width="300" height="200" rx="10" fill="#667eea"
                                    opacity="0.2" />
                                <rect x="110" y="130" width="280" height="170" rx="5" fill="#fff" />

                                <!-- Monitor Stand -->
                                <rect x="220" y="320" width="60" height="30" fill="#667eea" opacity="0.3" />
                                <rect x="180" y="350" width="140" height="10" rx="5" fill="#667eea"
                                    opacity="0.3" />

                                <!-- Play Button / Video Icon -->
                                <circle cx="250" cy="215" r="30" fill="#667eea" />
                                <path d="M 240 200 L 265 215 L 240 230 Z" fill="#fff" />

                                <!-- Floating Elements -->
                                <circle cx="380" cy="150" r="15" fill="#764ba2" opacity="0.6">
                                    <animateTransform attributeName="transform" type="translate"
                                        values="0 0; 0 -10; 0 0" dur="3s" repeatCount="indefinite" />
                                </circle>
                                <circle cx="120" cy="280" r="12" fill="#667eea" opacity="0.5">
                                    <animateTransform attributeName="transform" type="translate" values="0 0; 0 10; 0 0"
                                        dur="4s" repeatCount="indefinite" />
                                </circle>

                                <!-- Books Stack -->
                                <rect x="320" y="340" width="60" height="8" rx="2" fill="#764ba2"
                                    opacity="0.7" />
                                <rect x="325" y="332" width="50" height="8" rx="2" fill="#667eea"
                                    opacity="0.7" />
                                <rect x="330" y="324" width="40" height="8" rx="2" fill="#764ba2"
                                    opacity="0.5" />

                                <!-- Graduation Cap -->
                                <circle cx="140" cy="100" r="20" fill="#667eea" opacity="0.8" />
                                <rect x="120" y="95" width="40" height="8" fill="#667eea" opacity="0.8" />
                                <rect x="138" y="87" width="4" height="20" fill="#764ba2" />

                                <!-- Light Bulb -->
                                <circle cx="370" cy="280" r="18" fill="#fbbf24" opacity="0.7" />
                                <rect x="365" y="298" width="10" height="15" rx="2" fill="#fbbf24"
                                    opacity="0.5" />
                                <path d="M 360 298 L 380 298" stroke="#fbbf24" stroke-width="2" />
                            </svg>
                        </div>

                        <h3 style="color: #374151; font-weight: 700; margin-bottom: 15px; text-align: center;">
                            Platform Pembelajaran Digital
                        </h3>
                        <p style="color: #6b7280; text-align: center; margin-bottom: 25px; font-size: 14px;">
                            Akses materi, tugas, dan quiz kapan saja, dimana saja
                        </p>



                        <div style="margin-top: 0px; text-align: center;">

                            <span class="feature-badge">
                                <i class="fa fa-tasks"></i> Tugas Online
                            </span>
                            <span class="feature-badge">
                                <i class="fa fa-chart-line"></i> Tracking Progress
                            </span>
                        </div>
                    </div>

                    <!-- Right Panel - Login Form -->
                    <div class="login-right-panel">
                        <div class="brand-header">
                            <div class="brand-logo-futuristic">
                                <img src="{{ asset('img/logo-lms.svg') }}" alt="Sikola">
                            </div>
                            <h1 class="login-heading">Selamat Datang</h1>
                            <p class="login-subheading">Masuk ke Sikola App - SMK TKJ</p>
                        </div>

                        @if (Session::has('failed'))
                            <div class="alert alert-danger alert-dismissible fade show modern-alert" role="alert"
                                style="border-radius: 12px; border: none; background: linear-gradient(135deg, #f87171 0%, #dc2626 100%); color: white; box-shadow: 0 4px 15px rgba(220, 38, 38, 0.3); margin-bottom: 25px;">
                                <i class="fa fa-exclamation-circle" style="margin-right: 8px;"></i>
                                <strong>Error!</strong> {{ Session::get('failed') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                    style="color: white; opacity: 0.9;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <form method="post" action="/login-action" class="needs-validation">
                            @csrf

                            <div class="modern-form-group">
                                <label for="email" class="modern-label">Alamat Email</label>
                                <div class="modern-input-wrapper">
                                    <i class="fa fa-envelope input-icon"></i>
                                    <input id="email" type="email" class="modern-input" name="email"
                                        tabindex="1" required autofocus placeholder="nama@sekolah.sch.id">
                                </div>
                            </div>

                            <div class="modern-form-group">
                                <label for="password" class="modern-label">Password</label>
                                <div class="modern-input-wrapper">
                                    <i class="fa fa-lock input-icon"></i>
                                    <input id="password" type="password" class="modern-input" name="password"
                                        tabindex="2" required placeholder="Masukkan password Anda">
                                    <i class="fa fa-eye toggle-password" id="togglePassword"></i>
                                </div>
                            </div>

                            <button type="submit" class="btn-futuristic" tabindex="3" name="submit">
                                <i class="fa fa-sign-in-alt" style="margin-right: 8px;"></i>
                                Masuk ke Sikola
                            </button>

                            <p class="login-footer-text">
                                Belum punya akun? Hubungi <strong>Guru BK</strong> atau <strong>Tata Usaha</strong>
                                untuk mendapatkan akses.
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('library/popper.js/dist/umd/popper.js') }}"></script>
    <script src="{{ asset('library/tooltip.js/dist/umd/tooltip.js') }}"></script>
    <script src="{{ asset('library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('library/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('js/stisla.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script>
        // Toggle password visibility on login page
        (function() {
            var toggle = document.getElementById('togglePassword');
            if (!toggle) return;
            var pwd = document.getElementById('password');
            var icon = document.getElementById('togglePasswordIcon');
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                if (pwd.type === 'password') {
                    pwd.type = 'text';
                    if (icon) {
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    }
                } else {
                    pwd.type = 'password';
                    if (icon) {
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                }
            });
        })();
    </script>
</body>

</html>
