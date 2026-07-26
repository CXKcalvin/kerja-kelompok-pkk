(function () {
    // DOM elements
    const loginForm = document.getElementById("loginForm");
    const registerForm = document.getElementById("registerForm");
    const tabLogin = document.getElementById("tabLogin");
    const tabRegister = document.getElementById("tabRegister");
    const switchToRegister = document.getElementById("switchToRegister");
    const switchToLogin = document.getElementById("switchToLogin");

    // Toggle password visibility
    const loginPwInput = document.getElementById("loginPassword");
    const registerPwInput = document.getElementById("registerPassword");
    const toggleLoginPw = document.getElementById("toggleLoginPw");
    const toggleRegisterPw = document.getElementById("toggleRegisterPw");

    // ----- helper: switch active tab -----
    function setActiveTab(tab) {
        // remove active class from both tabs
        tabLogin.classList.remove("active");
        tabRegister.classList.remove("active");
        // set active on selected tab
        if (tab === "login") {
            tabLogin.classList.add("active");
            loginForm.classList.add("active");
            registerForm.classList.remove("active");
        } else {
            tabRegister.classList.add("active");
            registerForm.classList.add("active");
            loginForm.classList.remove("active");
        }
    }

    // ----- event listeners for tabs -----
    tabLogin.addEventListener("click", function (e) {
        e.preventDefault();
        setActiveTab("login");
    });

    tabRegister.addEventListener("click", function (e) {
        e.preventDefault();
        setActiveTab("register");
    });

    // switch links (inside forms)
    switchToRegister.addEventListener("click", function (e) {
        e.preventDefault();
        setActiveTab("register");
    });

    switchToLogin.addEventListener("click", function (e) {
        e.preventDefault();
        setActiveTab("login");
    });

    // ----- toggle password visibility (login) -----
    toggleLoginPw.addEventListener("click", function () {
        const type =
            loginPwInput.getAttribute("type") === "password"
                ? "text"
                : "password";
        loginPwInput.setAttribute("type", type);
        this.querySelector("i").classList.toggle("fa-eye");
        this.querySelector("i").classList.toggle("fa-eye-slash");
    });

    toggleRegisterPw.addEventListener("click", function () {
        const type =
            registerPwInput.getAttribute("type") === "password"
                ? "text"
                : "password";
        registerPwInput.setAttribute("type", type);
        this.querySelector("i").classList.toggle("fa-eye");
        this.querySelector("i").classList.toggle("fa-eye-slash");
    });

    // ----- (optional) prevent default form submit for demo -----
    loginForm.addEventListener("submit", function (e) {
        e.preventDefault();
        // subtle feedback (purple vibe)
        const btn = this.querySelector(".btn-primary");
        btn.innerHTML = '<i class="fas fa-spinner fa-pulse"></i> Logging in...';
        setTimeout(() => {
            btn.innerHTML =
                '<i class="fas fa-arrow-right-to-bracket"></i> Login';
            alert("✨ Login demo — welcome! (purple & black vibe)");
        }, 900);
    });

    registerForm.addEventListener("submit", function (e) {
        e.preventDefault();
        const btn = this.querySelector(".btn-primary");
        btn.innerHTML = '<i class="fas fa-spinner fa-pulse"></i> Creating...';
        setTimeout(() => {
            btn.innerHTML = '<i class="fas fa-user-plus"></i> Create account';
            alert("✨ Registration demo — your account would be created!");
        }, 900);
    });

    // (optional) social buttons just alert
    document.querySelectorAll(".social-btn").forEach((btn) => {
        btn.addEventListener("click", function () {
            alert("🔮 Social login demo (purple style)");
        });
    });

    // small extra: toggle eye icon on init
    // set default eye state (both are password)
    // icons already set to fa-eye
})();

function togglePassword(inputId) {
    // Ambil elemen input spesifik berdasarkan ID
    const input = document.getElementById(inputId);
    
    if (input) {
        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    }
}
