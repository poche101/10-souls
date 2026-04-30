<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin Login — 10 Souls in 10 Days</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Epilogue:wght@300;400;500;600&display=swap" rel="stylesheet"/>

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Epilogue', sans-serif;
            min-height: 100vh;
            background: #0D0818;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        /* ── Animated background ── */
        .bg-layer {
            position: fixed;
            inset: 0;
            z-index: 0;
        }

        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            animation: drift 8s ease-in-out infinite alternate;
        }

        .orb-1 {
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(75,0,130,0.5), transparent 70%);
            top: -100px; left: -100px;
            animation-delay: 0s;
        }

        .orb-2 {
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(201,168,76,0.2), transparent 70%);
            bottom: -80px; right: -80px;
            animation-delay: -3s;
        }

        .orb-3 {
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(123,47,190,0.3), transparent 70%);
            top: 50%; right: 20%;
            animation-delay: -5s;
        }

        @keyframes drift {
            from { transform: translate(0, 0) scale(1); }
            to   { transform: translate(30px, 20px) scale(1.1); }
        }

        /* ── Grid pattern ── */
        .grid-pattern {
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
            background-size: 40px 40px;
            z-index: 0;
        }

        /* ── Card ── */
        .login-card {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 440px;
            margin: 20px;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 24px;
            padding: 48px 40px;
            backdrop-filter: blur(20px);
            box-shadow:
                0 0 0 1px rgba(201,168,76,0.1),
                0 40px 80px rgba(0,0,0,0.6),
                inset 0 1px 0 rgba(255,255,255,0.05);
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        @keyframes slideUp {
            to { opacity: 1; transform: translateY(0); }
        }

        /* ── Gold accent top border ── */
        .card-accent {
            position: absolute;
            top: 0; left: 40px; right: 40px;
            height: 1px;
            background: linear-gradient(90deg, transparent, #C9A84C, #F0C040, #C9A84C, transparent);
            border-radius: 1px;
        }

        /* ── Logo ── */
        .logo-ring {
            width: 64px; height: 64px;
            border-radius: 18px;
            background: linear-gradient(135deg, #1a0030, #3B0070);
            border: 1px solid rgba(201,168,76,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            position: relative;
            box-shadow: 0 8px 32px rgba(75,0,130,0.4);
        }

        .logo-ring::after {
            content: '';
            position: absolute;
            inset: -1px;
            border-radius: 18px;
            background: linear-gradient(135deg, rgba(201,168,76,0.4), transparent, rgba(201,168,76,0.2));
            z-index: -1;
        }

        /* ── Input ── */
        .input-group {
            position: relative;
            margin-bottom: 16px;
        }

        .input-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.4);
            margin-bottom: 8px;
        }

        .input-field {
            width: 100%;
            padding: 14px 18px 14px 46px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 12px;
            font-family: 'Epilogue', sans-serif;
            font-size: 15px;
            color: white;
            outline: none;
            transition: all 0.2s ease;
        }

        .input-field::placeholder {
            color: rgba(255,255,255,0.2);
        }

        .input-field:focus {
            border-color: rgba(201,168,76,0.5);
            background: rgba(255,255,255,0.06);
            box-shadow: 0 0 0 3px rgba(201,168,76,0.08);
        }

        .input-icon {
            position: absolute;
            left: 16px;
            bottom: 14px;
            width: 18px;
            height: 18px;
            color: rgba(255,255,255,0.25);
            pointer-events: none;
            transition: color 0.2s;
        }

        .input-group:focus-within .input-icon {
            color: rgba(201,168,76,0.7);
        }

        .toggle-password {
            position: absolute;
            right: 14px;
            bottom: 12px;
            background: none;
            border: none;
            cursor: pointer;
            color: rgba(255,255,255,0.25);
            padding: 2px;
            transition: color 0.2s;
        }
        .toggle-password:hover { color: rgba(201,168,76,0.7); }

        /* ── Submit button ── */
        .btn-login {
            width: 100%;
            padding: 15px;
            border-radius: 12px;
            border: none;
            cursor: pointer;
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 15px;
            letter-spacing: 0.5px;
            background: linear-gradient(135deg, #C9A84C 0%, #F0C040 50%, #C9A84C 100%);
            color: #1a0030;
            transition: all 0.25s ease;
            box-shadow: 0 4px 20px rgba(201,168,76,0.3);
            position: relative;
            overflow: hidden;
            margin-top: 8px;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, transparent 30%, rgba(255,255,255,0.2) 50%, transparent 70%);
            transform: translateX(-100%);
            transition: transform 0.5s ease;
        }

        .btn-login:hover::before { transform: translateX(100%); }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(201,168,76,0.45);
        }
        .btn-login:active { transform: translateY(0); }

        /* ── Error alert ── */
        .error-alert {
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.25);
            border-radius: 10px;
            padding: 12px 16px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        /* ── Fade animations ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-up { animation: fadeUp 0.5s ease forwards; opacity: 0; }
        .d1 { animation-delay: 0.1s; }
        .d2 { animation-delay: 0.2s; }
        .d3 { animation-delay: 0.25s; }
        .d4 { animation-delay: 0.3s; }
        .d5 { animation-delay: 0.4s; }
    </style>
</head>
<body>

    {{-- Animated background --}}
    <div class="bg-layer">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
    </div>
    <div class="grid-pattern"></div>

    {{-- Login Card --}}
    <div class="login-card">
        <div class="card-accent"></div>

        {{-- Logo --}}
        <div class="fade-up d1">
            <div class="logo-ring">
                <img src="/images/oip.png" alt="Logo">
            </div>

            <div style="text-align:center;margin-bottom:32px;">
                <p style="font-size:11px;font-weight:600;letter-spacing:0.15em;text-transform:uppercase;color:rgba(201,168,76,0.7);margin-bottom:6px;">
                    Christ Embassy · Lagos Zone 5
                </p>
                <h1 style="font-family:'Syne',sans-serif;font-weight:800;font-size:26px;color:white;line-height:1.2;margin-bottom:6px;">
                    Admin Dashboard
                </h1>
                <p style="font-size:13px;color:rgba(255,255,255,0.35);">
                    Sign in to manage campaign registrations
                </p>
            </div>
        </div>

        {{-- Error messages --}}
        @if ($errors->any())
        <div class="error-alert fade-up d2">
            <svg style="width:16px;height:16px;color:#f87171;flex-shrink:0;margin-top:1px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
            </svg>
            <div>
                @foreach ($errors->all() as $error)
                    <p style="font-size:13px;color:#f87171;font-weight:500;">{{ $error }}</p>
                @endforeach
            </div>
        </div>
        @endif

        @if (session('error'))
        <div class="error-alert fade-up d2">
            <svg style="width:16px;height:16px;color:#f87171;flex-shrink:0;margin-top:1px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
            </svg>
            <p style="font-size:13px;color:#f87171;font-weight:500;">{{ session('error') }}</p>
        </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf

            {{-- Password --}}
            <div class="input-group fade-up d3">
                <label class="input-label">Admin Password</label>
                <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                </svg>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="input-field"
                    placeholder="Enter admin password"
                    required
                    autocomplete="current-password"
                />
                <button type="button" class="toggle-password" onclick="togglePassword()">
                    <svg id="eye-icon" style="width:18px;height:18px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.964-7.178z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </button>
            </div>

            {{-- Submit --}}
            <div class="fade-up d5">
                <button type="submit" class="btn-login">
                    Access Dashboard
                </button>
            </div>
        </form>

        {{-- Footer --}}
        <div class="fade-up d5" style="margin-top:28px;padding-top:24px;border-top:1px solid rgba(255,255,255,0.06);text-align:center;">
            <p style="font-size:12px;color:rgba(255,255,255,0.2);">
                10 Souls in 10 Days · Soulwinning Campaign 2.0
            </p>
            <p style="font-size:11px;color:rgba(255,255,255,0.12);margin-top:4px;">
                4th – 13th May, 2026
            </p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon  = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/>
                `;
            } else {
                input.type = 'password';
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.964-7.178z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                `;
            }
        }
    </script>

</body>
</html>