
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sign In | FORGE PC</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800;900&family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        :root {
            --bg: #090909;
            --surface: #111;
            --surface2: #181818;
            --text: #f4f4f2;
            --muted: #898989;
            --line: #292929;
            --accent: #ed252d;
            --accent-hover: #ff4249;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            background: var(--bg);
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
        }

        a { color: inherit; text-decoration: none; }
        button, input { font: inherit; }

        .page {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1.08fr .92fr;
        }

        /* LEFT VISUAL PANEL */

        .visual-panel {
            min-height: 100vh;
            position: relative;
            overflow: hidden;
            background: #080808;
            isolation: isolate;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 35px 7%;
        }

        .visual-image {
            position: absolute;
            inset: 0;
            z-index: -2;
            background:
                url('https://images.unsplash.com/photo-1587202372775-e229f172b9d7?auto=format&fit=crop&w=1800&q=90')
                center / cover;
            animation: imageZoom 20s ease-in-out infinite alternate;
        }

        @keyframes imageZoom {
            to { transform: scale(1.08); }
        }

        .visual-overlay {
            position: absolute;
            inset: 0;
            z-index: -1;
            background:
                linear-gradient(90deg, rgba(5,5,5,.95), rgba(5,5,5,.68)),
                linear-gradient(0deg, #050505, transparent 70%);
        }

        .visual-grid {
            position: absolute;
            inset: 0;
            z-index: -1;
            opacity: .12;
            background-image:
                linear-gradient(#ffffff25 1px, transparent 1px),
                linear-gradient(90deg, #ffffff25 1px, transparent 1px);
            background-size: 55px 55px;
            mask-image: linear-gradient(135deg, #000, transparent 85%);
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 11px;
            width: fit-content;
        }

        .brand-mark {
            width: 42px;
            height: 42px;
            background: var(--accent);
            display: grid;
            place-items: center;
            transform: skew(-8deg);
        }

        .brand-mark svg { color: white; }

        .brand-text {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 27px;
            line-height: .8;
            font-weight: 900;
        }

        .brand-text span { color: var(--accent); }

        .brand-text small {
            display: block;
            margin-top: 7px;
            font-family: 'DM Sans', sans-serif;
            color: #999;
            font-size: 7px;
            letter-spacing: 2px;
        }

        .visual-content {
            max-width: 570px;
            margin: auto 0;
            padding: 70px 0;
            animation: enter .8s ease both;
        }

        @keyframes enter {
            from { opacity: 0; transform: translateY(22px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .eyebrow {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #ff555b;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 2px;
        }

        .eyebrow-line {
            width: 25px;
            height: 2px;
            background: var(--accent);
        }

        .visual-content h1 {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(75px, 9vw, 125px);
            font-weight: 900;
            line-height: .78;
            letter-spacing: -2px;
            margin: 30px 0;
        }

        .visual-content h1 span { color: var(--accent); }

        .visual-content p {
            max-width: 420px;
            color: #b2b2b2;
            font-size: 12px;
            line-height: 2;
        }

        .visual-points {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 35px;
        }

        .visual-points span {
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 9px 12px;
            border: 1px solid #ffffff35;
            background: #1119;
            color: #ddd;
            font-size: 9px;
        }

        .visual-points i { color: var(--accent); }

        .visual-footer {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            color: #888;
            font-size: 8px;
            letter-spacing: 1.5px;
        }

        .visual-footer span:last-child { color: #ff555b; }

        /* RIGHT LOGIN PANEL */

        .form-panel {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 35px clamp(25px, 7vw, 95px);
            background: var(--bg);
            position: relative;
        }

        .form-top {
            display: flex;
            justify-content: flex-end;
        }

        .back-link {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--muted);
            font-size: 10px;
            font-weight: 700;
            transition: color .2s;
        }

        .back-link:hover { color: white; }

        .login-content {
            width: 100%;
            max-width: 390px;
            margin: auto;
            padding: 55px 0;
            animation: enter .8s .15s ease both;
        }

        .form-index {
            color: var(--accent);
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 2px;
        }

        .login-content h2 {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 62px;
            font-weight: 900;
            line-height: .85;
            margin: 15px 0;
            letter-spacing: -1px;
        }

        .login-content h2 span { color: var(--accent); }

        .form-description {
            color: var(--muted);
            font-size: 11px;
            line-height: 1.8;
            margin: 18px 0 32px;
        }

        .status-message {
            padding: 12px 14px;
            margin-bottom: 20px;
            background: #14291c;
            border: 1px solid #285b39;
            color: #8cdaa5;
            font-size: 10px;
            line-height: 1.7;
        }

        .error-box {
            padding: 12px 14px;
            margin-bottom: 20px;
            background: #301416;
            border: 1px solid #79272d;
            color: #ff9a9f;
            font-size: 10px;
            line-height: 1.7;
        }

        .field { margin-bottom: 21px; }

        .field-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .field label {
            color: #dedede;
            font-size: 10px;
            font-weight: 700;
        }

        .field-header a {
            color: var(--accent);
            font-size: 9px;
            font-weight: 700;
        }

        .input-wrap { position: relative; }

        .input-wrap > i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
            width: 17px;
            height: 17px;
            pointer-events: none;
        }

        .input-wrap input {
            width: 100%;
            height: 51px;
            padding: 0 45px;
            background: var(--surface);
            border: 1px solid var(--line);
            outline: none;
            color: white;
            font-size: 11px;
            transition: border .2s, box-shadow .2s;
        }

        .input-wrap input::placeholder { color: #666; }

        .input-wrap input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px #ed252d18;
        }

        .password-toggle {
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            display: grid;
            place-items: center;
            border: 0;
            background: transparent;
            color: #777;
            padding: 5px;
        }

        .password-toggle:hover { color: white; }

        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 5px 0 25px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 9px;
            color: var(--muted);
            font-size: 10px;
            cursor: pointer;
        }

        .remember input {
            accent-color: var(--accent);
            width: 14px;
            height: 14px;
        }

        .submit-btn {
            width: 100%;
            min-height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            border: 0;
            background: var(--accent);
            color: white;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .7px;
            transition: background .2s, transform .2s;
        }

        .submit-btn:hover {
            background: var(--accent-hover);
            transform: translateY(-2px);
        }

        .submit-btn:disabled {
            opacity: .7;
            cursor: wait;
            transform: none;
        }

        .secure-note {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 20px;
            color: #777;
            font-size: 9px;
        }

        .secure-note i { color: #69b987; }

        .form-bottom {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            border-top: 1px solid var(--line);
            padding-top: 20px;
            color: #666;
            font-size: 8px;
            letter-spacing: .7px;
        }

        .form-bottom a:hover { color: white; }

        @media (max-width: 900px) {
            .page { grid-template-columns: .9fr 1.1fr; }
            .visual-panel { padding: 30px 6%; }
            .visual-content h1 { font-size: 85px; }
            .form-panel { padding: 30px 7%; }
        }

        @media (max-width: 680px) {
            .page { display: block; }
            .visual-panel {
                min-height: 300px;
                padding: 25px 7%;
            }
            .visual-content {
                padding: 55px 0 25px;
                margin: 0;
            }
            .visual-content h1 {
                font-size: 65px;
                margin: 20px 0;
            }
            .visual-content p { font-size: 10px; }
            .visual-points { display: none; }
            .visual-footer { display: none; }
            .form-panel {
                min-height: 650px;
                padding: 25px 7%;
            }
            .form-top { display: none; }
            .login-content { padding: 45px 0; }
            .login-content h2 { font-size: 55px; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: .01ms !important;
                transition-duration: .01ms !important;
            }
        }
    </style>
</head>

<body>
<div class="page">

    <section class="visual-panel">
        <div class="visual-image"></div>
        <div class="visual-overlay"></div>
        <div class="visual-grid"></div>

        <a href="{{ url('/') }}" class="brand">
            <span class="brand-mark"><i data-lucide="zap"></i></span>
            <span class="brand-text">FORGE<span>PC</span><small>HARDWARE & SERVICES</small></span>
        </a>

        <div class="visual-content">
            <div class="eyebrow">
                <span class="eyebrow-line"></span>
                YOUR WORKSPACE STARTS HERE
            </div>

            <h1>BUILT FOR<br><span>WHAT'S NEXT.</span></h1>

            <p>
                Your hardware journey, all in one place.
                Access your account to manage builds, explore components,
                and keep your FORGE PC experience moving.
            </p>

            <div class="visual-points">
                <span><i data-lucide="shield-check"></i> Secure access</span>
                <span><i data-lucide="cpu"></i> Your builds</span>
                <span><i data-lucide="wrench"></i> Service support</span>
            </div>
        </div>

        <div class="visual-footer">
            <span>FORGE PC / ACCESS PORTAL</span>
            <span>01 — AUTHENTICATION</span>
        </div>
    </section>

    <main class="form-panel">

        <div class="form-top">
            <a href="{{ url('/') }}" class="back-link">
                <i data-lucide="arrow-left"></i>
                BACK TO WEBSITE
            </a>
        </div>

        <div class="login-content">
            <span class="form-index">ACCOUNT ACCESS / 001</span>

            <h2>WELCOME<br><span>BACK.</span></h2>

            <p class="form-description">
                Sign in to continue where you left off.
                Your next build starts with the right connection.
            </p>

            @if (session('status'))
                <div class="status-message">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="error-box">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
<form method="POST" action="{{ route('login.submit') }}">
    @csrf

    <div class="field">
        <div class="field-header">
            <label for="email">EMAIL ADDRESS</label>
        </div>

        <div class="input-wrap">
            <i data-lucide="mail"></i>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="you@example.com"
                autocomplete="username"
                required
                autofocus
            >
        </div>
        @error('email')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <div class="field">
        <div class="field-header">
            <label for="password">PASSWORD</label>
            <a href="{{ route('password.request') }}">Forgot password?</a>
        </div>

        <div class="input-wrap">
            <i data-lucide="lock"></i>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="Enter your password"
                autocomplete="current-password"
                required
            >

            <button
                type="button"
                class="password-toggle"
                id="passwordToggle"
                aria-label="Show password"
            >
                <i data-lucide="eye"></i>
            </button>
        </div>
        @error('password')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-options">
        <label class="remember">
            <input
                type="checkbox"
                name="remember"
                value="1"
                {{ old('remember') ? 'checked' : '' }}
            >
            Remember me
        </label>
    </div>

    <button type="submit" class="submit-btn" id="submitBtn">
        <span>SIGN IN TO FORGE</span>
        <i data-lucide="arrow-up-right"></i>
    </button>

    <div class="secure-note">
        <i data-lucide="shield-check"></i>
        Your account connection is protected.
    </div>
</form>
        </div>

        <div class="form-bottom">
            <span>© {{ date('Y') }} FORGE PC</span>
            <a href="{{ url('/') }}">RETURN TO HOME</a>
            <span>ACCESS PORTAL / 01</span>
        </div>

    </main>
</div>

<script>
    lucide.createIcons();

    const password = document.getElementById('password');
    const passwordToggle = document.getElementById('passwordToggle');

    passwordToggle.addEventListener('click', () => {
        const isHidden = password.type === 'password';

        password.type = isHidden ? 'text' : 'password';

        passwordToggle.innerHTML = isHidden
            ? '<i data-lucide="eye-off"></i>'
            : '<i data-lucide="eye"></i>';

        passwordToggle.setAttribute(
            'aria-label',
            isHidden ? 'Hide password' : 'Show password'
        );

        lucide.createIcons();
    });

    document.querySelector('form').addEventListener('submit', () => {
        const button = document.getElementById('submitBtn');

        button.disabled = true;
        button.querySelector('span').textContent = 'AUTHENTICATING...';
    });
</script>
</body>
</html>
