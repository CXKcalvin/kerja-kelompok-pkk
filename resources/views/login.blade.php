@extends('layout.template')

@section('title','Login & Register · Purple & Black')
@section('title','Studio Edit | Jasa Edit Foto Profesional')
<link rel="stylesheet" href="/css/login.css">

@section('isi')

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
            <form action="{{ route('authlogin') }}" method="post" class="form active" id="loginForm" autocomplete="off">
                @csrf
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="text" name="login" placeholder="Email address/username" required />
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" id="loginPassword" required />
                    <button type="button" class="toggle-pw" id="toggleLoginPw" onclick="togglePassword('loginPassword')">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>

                <button type="submit" class="btn-primary">
                    <i class="fas fa-arrow-right-to-bracket"></i> Login
                </button>
                @error('login')
                <div style="background-color: gray; color: red; border-radius: 20px; padding: 20px;">
                    {{ $message }}
                </div>
                @enderror
            </form>

            <!-- REGISTER FORM -->
            <form action="{{ route('authregister') }}" method="post" class="form" id="registerForm" autocomplete="off">
                @csrf
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input name="nama_client" type="text" placeholder="Full name" required />
                </div>
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input name="email_client" type="email" placeholder="Email address" required />
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input name="password_client" type="password" placeholder="Password" id="registerPassword" required />
                    <button type="button" class="toggle-pw" id="toggleRegisterPw" onclick="togglePassword('registerPassword')">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>

                <button type="submit" class="btn-primary">
                    <i class="fas fa-user-plus"></i> Create account
                </button>
            </form>
        </div>
    </div>

    <script src="/js/login.js"></script>
</body>
@endsection