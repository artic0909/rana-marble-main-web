@extends('frontend.layout.app')

@section('title', 'Forgot Password – Rana Marble | Divine Marble')

@section('content')

<head>
    <style>
        /* ═══════════ AUTH SECTION ═══════════ */
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
            max-width: 460px;
            position: relative;
            z-index: 2;
        }

        /* ── Step progress bar ── */
        .step-progress {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0;
            margin-bottom: 36px;
        }

        .step-dot {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            border: 2px solid rgba(201, 168, 76, 0.4);
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: "Cinzel", serif;
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--text-light);
            transition: all 0.35s;
            flex-shrink: 0;
        }

        .step-dot.active {
            background: linear-gradient(135deg, var(--saffron), var(--maroon));
            border-color: transparent;
            color: #fff;
            box-shadow: 0 4px 14px rgba(212, 114, 42, 0.4);
        }

        .step-dot.done {
            background: linear-gradient(135deg, var(--gold), var(--saffron));
            border-color: transparent;
            color: #fff;
        }

        .step-line {
            flex: 1;
            height: 2px;
            background: rgba(201, 168, 76, 0.25);
            max-width: 60px;
            transition: background 0.35s;
        }

        .step-line.done {
            background: var(--gold);
        }

        /* ── Top ornament ── */
        .auth-top-ornament {
            text-align: center;
            margin-bottom: 22px;
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
            margin: 0 auto 12px;
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
            font-size: 1.55rem;
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
            margin-bottom: 28px;
        }

        .auth-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--border-gold), transparent);
            margin-bottom: 26px;
        }

        /* ── Step panels ── */
        .step-panel {
            display: none;
        }

        .step-panel.active {
            display: block;
            animation: fadeUp 0.45s ease both;
        }

        /* ── Form elements ── */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
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

        .input-wrap>i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gold);
            font-size: 0.9rem;
            pointer-events: none;
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
            pointer-events: all;
        }

        .toggle-pw:hover {
            color: var(--saffron);
        }

        .auth-form input[type="email"],
        .auth-form input[type="password"],
        .auth-form input[type="text"] {
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

        /* ── OTP inputs ── */
        .otp-group {
            display: flex;
            gap: 14px;
            justify-content: center;
            margin: 8px 0 24px;
        }

        .otp-input {
            width: 64px;
            height: 64px;
            border: 2px solid rgba(201, 168, 76, 0.35);
            border-radius: 8px;
            font-family: "Cinzel Decorative", serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--maroon);
            text-align: center;
            background: #fffdf7;
            outline: none;
            transition: all 0.25s;
            caret-color: var(--saffron);
        }

        .otp-input:focus {
            border-color: var(--saffron);
            box-shadow: 0 0 0 3px rgba(212, 114, 42, 0.12);
            background: #fff;
        }

        .otp-input.filled {
            border-color: var(--gold);
            background: rgba(201, 168, 76, 0.06);
        }

        .otp-hint {
            text-align: center;
            font-family: "Crimson Pro", serif;
            font-size: 0.9rem;
            color: var(--text-light);
            margin-bottom: 4px;
        }

        .otp-resend {
            text-align: center;
            font-family: "Crimson Pro", serif;
            font-size: 0.92rem;
            color: var(--text-mid);
            margin-bottom: 24px;
        }

        .otp-resend a {
            color: var(--saffron);
            text-decoration: none;
            font-weight: 600;
            cursor: pointer;
        }

        .otp-resend a:hover {
            color: var(--maroon);
        }

        /* ── Password strength ── */
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
            margin-top: 5px;
            color: var(--text-light);
            font-family: "Crimson Pro", serif;
        }

        /* ── Buttons ── */
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
            margin-top: 4px;
        }

        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(212, 114, 42, 0.5);
        }

        /* Success state */
        .success-icon {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            margin: 0 auto 20px;
            box-shadow: 0 6px 20px rgba(39, 174, 96, 0.35);
            animation: popIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) both;
        }

        @keyframes popIn {
            from {
                transform: scale(0);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .success-msg {
            text-align: center;
            font-family: "Crimson Pro", serif;
            font-size: 1.05rem;
            color: var(--text-mid);
            line-height: 1.7;
            margin-bottom: 28px;
        }

        /* Back link */
        .auth-back {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: 20px;
            font-family: "Cinzel", serif;
            font-size: 0.72rem;
            letter-spacing: 0.07em;
            color: var(--saffron);
            text-decoration: none;
            cursor: pointer;
            transition: color 0.2s;
        }

        .auth-back:hover {
            color: var(--maroon);
        }

        /* Email display badge */
        .email-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(201, 168, 76, 0.1);
            border: 1px solid rgba(201, 168, 76, 0.3);
            border-radius: 20px;
            padding: 6px 16px;
            font-family: "Crimson Pro", serif;
            font-size: 0.95rem;
            color: var(--text-mid);
            margin: 0 auto 20px;
            text-align: center;
            display: flex;
            justify-content: center;
        }

        .email-badge i {
            color: var(--gold);
            font-size: 0.85rem;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 520px) {
            .auth-card {
                padding: 36px 20px;
            }

            .auth-title {
                font-size: 1.25rem;
            }

            .otp-input {
                width: 54px;
                height: 54px;
                font-size: 1.35rem;
            }

            .otp-group {
                gap: 10px;
            }
        }
    </style>
</head>

<!-- ═══════════════════ FORGOT PASSWORD SECTION ═══════════════════ -->
<section class="auth-section">
    <div class="auth-card" id="authCard">

        <!-- Step Progress -->
        <div class="step-progress">
            <div class="step-dot active" id="dot1">1</div>
            <div class="step-line" id="line1"></div>
            <div class="step-dot" id="dot2">2</div>
            <div class="step-line" id="line2"></div>
            <div class="step-dot" id="dot3">3</div>
        </div>

        <!-- Top ornament (shared) -->
        <div class="auth-top-ornament">
            <div class="auth-om"><i class="fas fa-om"></i></div>
            <span class="auth-subtitle-tag" id="stepTag">Recover Access</span>
        </div>

        <h1 class="auth-title" id="stepTitle">Forgot Password</h1>
        <p class="auth-tagline" id="stepTagline">We'll send a verification code to your email</p>

        <div class="auth-divider"></div>

        <!-- ═══ STEP 1 – Email ═══ -->
        <div class="step-panel active" id="step1">
            <form class="auth-form" onsubmit="goToStep2(event)">
                <div class="form-group">
                    <label for="fp-email">Registered Email Address</label>
                    <div class="input-wrap">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="fp-email" name="email" placeholder="you@example.com" required />
                    </div>
                </div>
                <button type="submit" class="btn-auth">
                    <i class="fas fa-paper-plane"></i> Send OTP
                </button>
            </form>
            <a class="auth-back" href="login.html">
                <i class="fas fa-arrow-left"></i> Back to Login
            </a>
        </div>

        <!-- ═══ STEP 2 – OTP ═══ -->
        <div class="step-panel" id="step2">
            <p class="otp-hint">Enter the 4-digit code sent to</p>
            <div class="email-badge" id="emailBadge">
                <i class="fas fa-envelope"></i>
                <span id="emailDisplay">—</span>
            </div>

            <div class="otp-group">
                <input class="otp-input" id="otp1" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]" />
                <input class="otp-input" id="otp2" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]" />
                <input class="otp-input" id="otp3" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]" />
                <input class="otp-input" id="otp4" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]" />
            </div>

            <p class="otp-resend">Didn't receive it? <a onclick="resendOtp()">Resend OTP</a></p>

            <button class="btn-auth" onclick="goToStep3()">
                <i class="fas fa-shield-alt"></i> Verify OTP
            </button>

            <a class="auth-back" onclick="goBackTo(1)">
                <i class="fas fa-arrow-left"></i> Change Email
            </a>
        </div>

        <!-- ═══ STEP 3 – New Password ═══ -->
        <div class="step-panel" id="step3">
            <form class="auth-form" onsubmit="resetPassword(event)">
                <div class="form-group">
                    <label for="new-password">New Password</label>
                    <div class="input-wrap">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="new-password" name="new_password"
                            placeholder="Create a strong password" required oninput="checkStrength(this.value)"
                            style="padding-right:42px" />
                        <button type="button" class="toggle-pw" onclick="togglePassword('new-password', this)"
                            title="Show/Hide">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="strength-bar" id="strengthBar">
                        <span></span><span></span><span></span>
                    </div>
                    <div class="strength-text" id="strengthText">Enter a password</div>
                </div>

                <div class="form-group">
                    <label for="confirm-password">Confirm New Password</label>
                    <div class="input-wrap">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="confirm-password" name="confirm_password"
                            placeholder="Re-enter your password" required style="padding-right:42px" />
                        <button type="button" class="toggle-pw" onclick="togglePassword('confirm-password', this)"
                            title="Show/Hide">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-auth">
                    <i class="fas fa-check-circle"></i> Reset Password
                </button>
            </form>
            <a class="auth-back" onclick="goBackTo(2)">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>

        <!-- ═══ STEP 4 – Success ═══ -->
        <div class="step-panel" id="step4">
            <div class="success-icon"><i class="fas fa-check"></i></div>
            <h2 class="auth-title">Password Reset!</h2>
            <p class="success-msg">
                Your password has been updated successfully.<br>
                You can now sign in with your new password.
            </p>
            <a href="login.html" class="btn-auth" style="text-decoration:none;">
                <i class="fas fa-sign-in-alt"></i> Go to Login
            </a>
        </div>

    </div>
</section>

<div class="ornament-divider" style="margin: 0; text-align: center; color: var(--saffron);"><i class="fas fa-om"></i></div>



<script>
    /* ── Step data ── */
    const stepMeta = {
        1: {
            tag: 'Recover Access',
            title: 'Forgot Password',
            tagline: 'We\'ll send a verification code to your email'
        },
        2: {
            tag: 'Verification',
            title: 'Enter OTP',
            tagline: 'A 4-digit code has been sent to your email'
        },
        3: {
            tag: 'New Password',
            title: 'Reset Password',
            tagline: 'Choose a strong, new password'
        },
    };

    function showStep(n) {
        /* hide all panels */
        document.querySelectorAll('.step-panel').forEach(p => p.classList.remove('active'));
        document.getElementById('step' + n).classList.add('active');

        /* update dots */
        [1, 2, 3].forEach(i => {
            const dot = document.getElementById('dot' + i);
            dot.classList.remove('active', 'done');
            if (i < n) dot.classList.add('done'), dot.innerHTML = '<i class="fas fa-check" style="font-size:0.7rem"></i>';
            else if (i === n) dot.classList.add('active'), dot.textContent = i;
            else dot.textContent = i;
        });

        /* update lines */
        [1, 2].forEach(i => {
            const line = document.getElementById('line' + i);
            line.classList.toggle('done', i < n);
        });

        /* update header text (not for success step) */
        if (n <= 3) {
            document.getElementById('stepTag').textContent = stepMeta[n].tag;
            document.getElementById('stepTitle').textContent = stepMeta[n].title;
            document.getElementById('stepTagline').textContent = stepMeta[n].tagline;
        }

        /* Hide progress bar & ornament on success */
        document.querySelector('.step-progress').style.display = n === 4 ? 'none' : 'flex';
        document.querySelector('.auth-top-ornament').style.display = n === 4 ? 'none' : 'block';
        document.getElementById('stepTitle').style.display = n === 4 ? 'none' : 'block';
        document.getElementById('stepTagline').style.display = n === 4 ? 'none' : 'block';
        document.querySelector('.auth-divider').style.display = n === 4 ? 'none' : 'block';

        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    /* ── Step 1 → 2 ── */
    function goToStep2(e) {
        e.preventDefault();
        const email = document.getElementById('fp-email').value.trim();
        if (!email) return;
        document.getElementById('emailDisplay').textContent = email;
        showStep(2);
        setTimeout(() => document.getElementById('otp1').focus(), 400);
    }

    /* ── Step 2 → 3 ── */
    function goToStep3() {
        const digits = ['otp1', 'otp2', 'otp3', 'otp4'].map(id => document.getElementById(id).value);
        if (digits.some(d => d === '' || isNaN(d))) {
            alert('Please enter all 4 digits of the OTP.');
            return;
        }
        showStep(3);
        setTimeout(() => document.getElementById('new-password').focus(), 400);
    }

    /* ── Step 3 → Success ── */
    function resetPassword(e) {
        e.preventDefault();
        const np = document.getElementById('new-password').value;
        const cp = document.getElementById('confirm-password').value;
        if (np !== cp) {
            alert('Passwords do not match. Please try again.');
            return;
        }
        if (np.length < 6) {
            alert('Password must be at least 6 characters.');
            return;
        }
        showStep(4);
    }

    /* ── Go back ── */
    function goBackTo(n) {
        showStep(n);
    }

    /* ── Resend OTP ── */
    function resendOtp() {
        ['otp1', 'otp2', 'otp3', 'otp4'].forEach(id => {
            const el = document.getElementById(id);
            el.value = '';
            el.classList.remove('filled');
        });
        document.getElementById('otp1').focus();
        alert('A new OTP has been sent to ' + document.getElementById('emailDisplay').textContent);
    }

    /* ── OTP auto-focus & backspace ── */
    document.querySelectorAll('.otp-input').forEach((input, i, inputs) => {
        input.addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '').slice(-1);
            if (this.value) {
                this.classList.add('filled');
                if (i < inputs.length - 1) inputs[i + 1].focus();
            } else {
                this.classList.remove('filled');
            }
        });
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Backspace' && !this.value && i > 0) {
                inputs[i - 1].focus();
                inputs[i - 1].value = '';
                inputs[i - 1].classList.remove('filled');
            }
        });
        /* Allow only digits */
        input.addEventListener('keypress', function(e) {
            if (!/[0-9]/.test(e.key)) e.preventDefault();
        });
    });

    /* ── Password show/hide toggle ── */
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

    /* ── Password strength ── */
    function checkStrength(val) {
        const bar = document.getElementById('strengthBar');
        const text = document.getElementById('strengthText');
        bar.className = 'strength-bar';
        if (!val) {
            text.textContent = 'Enter a password';
            text.style.color = '';
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