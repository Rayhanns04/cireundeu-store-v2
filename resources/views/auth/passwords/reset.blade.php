<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OurLife</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href={{ asset('assets/css/bootstrap.css') }}>
    <link rel="stylesheet" href={{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/app.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/pages/auth.css') }}>
    <script src="https://kit.fontawesome.com/dbe540109d.js" crossorigin="anonymous"></script>
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.html"><img src={{ asset('assets/images/logo/logo.png') }} alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Reset Password</h1>
                    <p class="auth-subtitle mb-5">Input your data to reset your password on our website.</p>

                    <form method="POST" action="/reset-password">
                        @csrf

                        <input type="hidden" name="token" value="{{ request()->route('token') }}">

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" placeholder="Email" name="email"
                                value="{{ old('email') }}">

                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" placeholder="Password"
                                name="password">

                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input id="password-confirm" type="password" class="form-control form-control-xl"
                                placeholder="confirm pasword" name="password_confirmation" required
                                autocomplete="new-password">

                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
                            {{ __('Reset Password') }}
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
</body>

</html>
