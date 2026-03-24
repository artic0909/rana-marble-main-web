@extends('frontend.layout.app')

@section('title', 'Register – Rana Marble | Divine Marble')

@section('content')

<head>
    <style>
        /* ═══════════ AUTH PAGE ═══════════ */
        .auth-section {
            min-height: calc(100vh - 180px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 20px;
            background: linear-gradient(160deg, #fdf6e3 0%, #f5eac8 60%, #fdf6e3 100%);
            position: relative;
            overflow: hidden;
        }

        .auth-section::before {
            content: "";
            position: absolute;
            top: -120px;
            right: -120px;
            width: 420px;
            height: 420px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(201, 168, 76, 0.12) 0%, transparent 70%);
            pointer-events: none;
        }

        .auth-section::after {
            content: "";
            position: absolute;
            bottom: -100px;
            left: -100px;
            width: 360px;
            height: 360px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(212, 114, 42, 0.1) 0%, transparent 70%);
            pointer-events: none;
        }

        .auth-card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid rgba(201, 168, 76, 0.3);
            box-shadow:
                0 20px 60px rgba(107, 26, 26, 0.08),
                0 4px 20px rgba(201, 168, 76, 0.1);
            padding: 48px 44px;
            width: 100%;
            max-width: 520px;
            position: relative;
            z-index: 2;
            animation: fadeUp 0.7s ease both;
        }

        .auth-top-ornament {
            text-align: center;
            margin-bottom: 28px;
        }

        .auth-om {
            width: 52px;
            height: 52px;
            background: linear-gradient(135deg, var(--saffron), var(--gold));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.4rem;
            margin: 0 auto 14px;
            box-shadow: 0 4px 18px rgba(212, 114, 42, 0.35);
        }

        .auth-subtitle-tag {
            font-family: "Cinzel", serif;
            font-size: 0.68rem;
            letter-spacing: 0.22em;
            color: var(--saffron);
            text-transform: uppercase;
            display: block;
        }

        .auth-title {
            font-family: "Cinzel Decorative", serif;
            font-size: 1.65rem;
            font-weight: 700;
            color: var(--maroon);
            text-align: center;
            margin-bottom: 6px;
        }

        .auth-tagline {
            font-family: "Crimson Pro", serif;
            font-style: italic;
            color: var(--text-light);
            text-align: center;
            font-size: 1rem;
            margin-bottom: 32px;
        }

        .auth-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--border-gold), transparent);
            margin-bottom: 28px;
        }

        .auth-form .form-group {
            margin-bottom: 18px;
        }

        .auth-form .form-group label {
            display: block;
            font-family: "Cinzel", serif;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--text-mid);
            margin-bottom: 8px;
            letter-spacing: 0.06em;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap i.field-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gold);
            font-size: 0.9rem;
            pointer-events: none;
        }

        .auth-form input[type="email"],
        .auth-form input[type="password"],
        .auth-form input[type="text"],
        .auth-form input[type="tel"] {
            width: 100%;
            padding: 13px 14px 13px 42px;
            border: 1.5px solid rgba(201, 168, 76, 0.35);
            border-radius: 6px;
            font-family: "Crimson Pro", serif;
            font-size: 1rem;
            color: var(--text-dark);
            background: #fffdf7;
            transition: all 0.25s;
            outline: none;
        }

        .auth-form input:focus {
            border-color: var(--saffron);
            box-shadow: 0 0 0 3px rgba(212, 114, 42, 0.1);
            background: #fff;
        }

        /* Two-column row for name fields */
        .form-row-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        /* Password strength meter */
        .strength-bar {
            display: flex;
            gap: 5px;
            margin-top: 8px;
        }

        .strength-bar span {
            flex: 1;
            height: 4px;
            border-radius: 2px;
            background: rgba(201, 168, 76, 0.2);
            transition: background 0.3s;
        }

        .strength-bar.weak span:nth-child(1) {
            background: #e74c3c;
        }

        .strength-bar.medium span:nth-child(1),
        .strength-bar.medium span:nth-child(2) {
            background: #f39c12;
        }

        .strength-bar.strong span {
            background: #27ae60;
        }

        .strength-text {
            font-size: 0.75rem;
            margin-top: 4px;
            color: var(--text-light);
            font-family: "Crimson Pro", serif;
        }

        /* Eye toggle button */
        .toggle-pw {
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-light);
            font-size: 0.95rem;
            padding: 0;
            line-height: 1;
            transition: color 0.2s;
        }

        .toggle-pw:hover {
            color: var(--saffron);
        }

        /* Terms checkbox */
        .terms-check {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 24px;
            font-family: "Crimson Pro", serif;
            font-size: 0.95rem;
            color: var(--text-mid);
            line-height: 1.5;
        }

        .terms-check input[type="checkbox"] {
            accent-color: var(--saffron);
            width: 16px;
            height: 16px;
            margin-top: 3px;
            flex-shrink: 0;
            cursor: pointer;
        }

        .terms-check a {
            color: var(--saffron);
            text-decoration: none;
        }

        .terms-check a:hover {
            color: var(--maroon);
        }

        .btn-auth {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, var(--saffron), var(--maroon));
            color: white;
            border: none;
            border-radius: 6px;
            font-family: "Cinzel", serif;
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            cursor: pointer;
            transition: all 0.25s;
            box-shadow: 0 6px 20px rgba(212, 114, 42, 0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(212, 114, 42, 0.5);
        }

        .auth-or {
            text-align: center;
            margin: 24px 0;
            position: relative;
            font-family: "Cinzel", serif;
            font-size: 0.7rem;
            letter-spacing: 0.14em;
            color: var(--text-light);
        }

        .auth-or::before,
        .auth-or::after {
            content: "";
            position: absolute;
            top: 50%;
            width: 38%;
            height: 1px;
            background: rgba(201, 168, 76, 0.3);
        }

        .auth-or::before {
            left: 0;
        }

        .auth-or::after {
            right: 0;
        }

        .social-logins {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 28px;
        }

        .btn-social {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 14px;
            border: 1.5px solid rgba(201, 168, 76, 0.3);
            border-radius: 6px;
            background: #fffdf7;
            font-family: "Crimson Pro", serif;
            font-size: 0.95rem;
            color: var(--text-dark);
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-social:hover {
            border-color: var(--gold);
            background: rgba(201, 168, 76, 0.06);
        }

        .btn-social .fab.fa-google {
            color: #EA4335;
        }

        .btn-social .fab.fa-facebook-f {
            color: #1877F2;
        }

        .auth-switch {
            text-align: center;
            font-family: "Crimson Pro", serif;
            font-size: 1rem;
            color: var(--text-mid);
        }

        .auth-switch a {
            color: var(--saffron);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .auth-switch a:hover {
            color: var(--maroon);
        }

        /* Trust badges */
        .auth-trust {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid rgba(201, 168, 76, 0.2);
        }

        .trust-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-family: "Cinzel", serif;
            font-size: 0.65rem;
            letter-spacing: 0.06em;
            color: var(--text-light);
        }

        .trust-item i {
            color: var(--gold);
            font-size: 0.85rem;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(24px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 560px) {
            .auth-card {
                padding: 36px 22px;
            }

            .auth-title {
                font-size: 1.3rem;
            }

            .form-row-2 {
                grid-template-columns: 1fr;
            }

            .social-logins {
                grid-template-columns: 1fr;
            }

            .auth-trust {
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }
        }
    </style>
</head>



<!-- ═══════════════════ REGISTER SECTION ═══════════════════ -->
<section class="auth-section">
    <div class="auth-card">

        <!-- Top ornament -->
        <div class="auth-top-ornament">
            <div class="auth-om"><img src="{{ asset('./img/logo.png') }}" alt="" width="50"></div>
            <span class="auth-subtitle-tag">Join The Family</span>
        </div>

        <h1 class="auth-title">Create Account</h1>
        <p class="auth-tagline">Begin your divine journey with us</p>

        <div class="auth-divider"></div>

        <form class="auth-form" action="{{ route('register.post') }}" method="POST">
            @csrf

            <!-- Name row -->
            <div class="form-row-2">
                <div class="form-group">
                    <label for="first-name">First Name</label>
                    <div class="input-wrap">
                        <i class="fas fa-user field-icon"></i>
                        <input type="text" id="first-name" name="first_name" placeholder="Raj" required />
                    </div>
                </div>
                <div class="form-group">
                    <label for="last-name">Last Name</label>
                    <div class="input-wrap">
                        <i class="fas fa-user field-icon"></i>
                        <input type="text" id="last-name" name="last_name" placeholder="Sharma" required />
                    </div>
                </div>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email Address</label>
                <div class="input-wrap">
                    <i class="fas fa-envelope field-icon"></i>
                    <input type="email" id="email" name="email" placeholder="you@example.com" required />
                </div>
            </div>

            <!-- Phone -->
            <div class="form-group">
                <label for="phone">Mobile Number</label>
                <div class="input-wrap">
                    <i class="fas fa-phone-alt field-icon"></i>
                    <input type="tel" id="phone" name="phone" placeholder="+91 98765 43210" />
                </div>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrap">
                    <i class="fas fa-lock field-icon"></i>
                    <input type="password" id="password" name="password" placeholder="Create a strong password"
                        required oninput="checkStrength(this.value)" style="padding-right:42px" />
                    <button type="button" class="toggle-pw" onclick="togglePassword('password', this)"
                        title="Show/Hide Password">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="strength-bar" id="strengthBar">
                    <span></span><span></span><span></span>
                </div>
                <div class="strength-text" id="strengthText">Enter a password</div>
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="confirm-password">Confirm Password</label>
                <div class="input-wrap">
                    <i class="fas fa-lock field-icon"></i>
                    <input type="password" id="confirm-password" name="confirm_password"
                        placeholder="Re-enter your password" required style="padding-right:42px" />
                    <button type="button" class="toggle-pw" onclick="togglePassword('confirm-password', this)"
                        title="Show/Hide Password">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn-auth">
                <i class="fas fa-user-plus"></i> Create Account
            </button>
        </form>

        <p class="auth-switch" style="margin-top: 15px;">
            Already have an account? <a href="{{route('login')}}">Sign In</a>
        </p>
    </div>
</section>

<div class="ornament-divider" style="margin: 0; text-align: center; color: var(--saffron);"><i class="fas fa-om"></i></div>


<script>
    function togglePassword(id, btn) {
        const input = document.getElementById(id);
        const icon = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }

    function checkStrength(val) {
        const bar = document.getElementById('strengthBar');
        const text = document.getElementById('strengthText');
        bar.className = 'strength-bar';
        if (val.length === 0) {
            text.textContent = 'Enter a password';
        } else if (val.length < 6) {
            bar.classList.add('weak');
            text.textContent = 'Weak – too short';
            text.style.color = '#e74c3c';
        } else if (val.length < 10 || !/[A-Z]/.test(val) || !/[0-9]/.test(val)) {
            bar.classList.add('medium');
            text.textContent = 'Medium – add uppercase & numbers';
            text.style.color = '#f39c12';
        } else {
            bar.classList.add('strong');
            text.textContent = 'Strong password ✓';
            text.style.color = '#27ae60';
        }
    }
</script>

@endsection