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
        /* Small, self-contained styles for the login page visual polish */
        .login-left {
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(180deg, #ffffff 0%, #f7fbff 100%);
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(28, 50, 78, 0.08);
            padding: 32px;
            background: #fff;
            border: 1px solid rgba(15, 38, 70, 0.03);
        }

        .brand-logo {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            overflow: hidden;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #fff 0%, #f3f7ff 100%);
            box-shadow: 0 6px 18px rgba(37, 78, 188, 0.08);
            border: 3px solid #fff;
        }

        .login-title {
            font-size: 22px;
            font-weight: 700;
            margin: 0 0 6px 0;
        }

        .login-sub {
            color: #6b7280;
            margin-bottom: 18px;
        }

        .input-group .input-group-text {
            background: transparent;
            border: none;
            color: #6b7280;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #5563f7;
        }

        .btn-cta {
            background: linear-gradient(90deg, #5563f7 0%, #7b5cff 100%);
            border: none;
            color: #fff;
            font-weight: 600;
            padding: 12px 18px;
            border-radius: 10px;
        }

        .small-muted {
            color: #9aa3b2;
            font-size: 13px;
        }

        @media (max-width: 991px) {
            .background-walk-y {
                min-height: 260px;
            }
        }
    </style>
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="d-flex align-items-stretch flex-wrap">
                <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 login-left">
                    <div class="login-card m-3 p-0">
                        <div class="p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="brand-logo mr-3">
                                    <img src="{{ asset('img/logo-lms.svg') }}" alt="Sikola"
                                        style="width:56px;height:56px;" />
                                </div>
                                <div>
                                    <h1 class="login-title">Sikola App</h1>
                                    <div class="login-sub">SMK TKJ • Platform pembelajaran digital yang rapi & cepat
                                    </div>
                                </div>
                            </div>

                            <form method="post" action="/login-action" class="needs-validation" novalidate="">
                                @csrf

                                <div class="form-group">
                                    <label for="email" class="small-muted">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                        </div>
                                        <input id="email" type="email" class="form-control" name="email"
                                            tabindex="1" required autofocus placeholder="contoh: nama@sekolah.sch.id">
                                    </div>
                                    <div class="invalid-feedback">Mohon isi email Anda</div>
                                </div>

                                <div class="form-group">
                                    <label for="password" class="small-muted">Password</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                        </div>
                                        <input id="password" type="password" class="form-control" name="password"
                                            tabindex="2" required placeholder="Masukkan password">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="togglePassword" style="cursor:pointer;">
                                                <i class="fa fa-eye" id="togglePasswordIcon"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">Mohon isi password Anda</div>
                                </div>

                                {{-- <div class="form-group d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                            id="remember-me">
                                        <label class="form-check-label small-muted" for="remember-me">Ingat saya</label>
                                    </div>
                                    <a href="/forgot-password" class="small-muted">Lupa password?</a>
                                </div> --}}

                                <div class="form-group">
                                    <button type="submit" class="btn btn-cta btn-cta-block w-100" tabindex="4"
                                        name="submit">
                                        Masuk ke Sikola
                                    </button>
                                </div>

                                <div class="text-center small-muted mt-3">Belum punya akun? Minta kode akses dari Guru
                                    BK / Tata Usaha.</div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-12 order-lg-2 min-vh-100 background-walk-y position-relative overlay-gradient-bottom order-1"
                    data-background="{{ asset('img/unsplash/login-bg.png') }}">
                    {{-- <div class="absolute-bottom-left index-2">
                        <div class="text-light p-5 pb-2">
                            <div class="mb-5 pb-3">
                                <h1 class="display-4 font-weight-bold mb-2">{{ __('Good Morning') }}</h1>
                                <h5 class="font-weight-normal text-muted-transparent">{{ __('Bali, Indonesia') }}</h5>
                            </div>
                            Photo by <a class="text-light bb" target="_blank"
                                href="https://unsplash.com/photos/a8lTjWJJgLA">{{ __('Justin Kauffman') }}</a> on <a
                                class="text-light bb" target="_blank" href="https://unsplash.com">{{ __('Unsplash') }}</a>
                        </div>
                    </div> --}}
                </div>
            </div>
        </section>
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
