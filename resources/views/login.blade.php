<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login & Register · Purple & Black</title>
    <!-- Font Awesome for icons (optional but adds flair) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="/css/login.css">
</head>

<body>

    <div class="auth-card">

        <!-- Tab header -->
        <div class="tabs">
            <button class="tab-btn active" data-form="login" id="tabLogin">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>
            <button class="tab-btn" data-form="register" id="tabRegister">
                <i class="fas fa-user-plus"></i> Register
            </button>
        </div>

        <!-- forms container -->
        <div class="forms-container">

            <!-- LOGIN FORM -->
            <form class="form active" id="loginForm" autocomplete="off">
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" placeholder="Email address" required />
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Password" id="loginPassword" required />
                    <button type="button" class="toggle-pw" id="toggleLoginPw" onclick="togglePassword('loginPassword')">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>

                <button type="submit" class="btn-primary">
                    <i class="fas fa-arrow-right-to-bracket"></i> Login
                </button>
            </form>

            <!-- REGISTER FORM -->
            <form class="form" id="registerForm" autocomplete="off">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input name="nama_siswa" type="text" placeholder="Full name" required />
                </div>
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input name="email_siswa" type="email" placeholder="Email address" required />
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input name="password_siswa" type="password" placeholder="Password" id="registerPassword" required />
                    <button type="button" class="toggle-pw" id="toggleRegisterPw" onclick="togglePassword('registerPassword')">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="input-group">
                    <i class="fas fa-check-circle"></i>
                    <input type="password" placeholder="Confirm password" required />
                </div>

                <button type="submit" class="btn-primary">
                    <i class="fas fa-user-plus"></i> Create account
                </button>
            </form>
        </div>
    </div>

    <script src="/js/login.js"></script>
</body>

</html>