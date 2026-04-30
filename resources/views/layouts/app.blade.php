<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>@yield('title', '10 Souls in 10 Days — Christ Embassy Lagos Zone 5')</title>

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        royal:  { DEFAULT: '#4B0082', light: '#7B2FBE', dark: '#2D0050' },
                        gold:   { DEFAULT: '#C9A84C', light: '#F0C040', dark: '#8B6914' },
                        cream:  '#FDF8F0',
                    },
                    fontFamily: {
                        display: ['"Playfair Display"', 'Georgia', 'serif'],
                        body:    ['"DM Sans"', 'sans-serif'],
                    },
                    backgroundImage: {
                        'gold-gradient': 'linear-gradient(135deg, #C9A84C 0%, #F0C040 50%, #C9A84C 100%)',
                        'royal-gradient': 'linear-gradient(135deg, #2D0050 0%, #4B0082 60%, #7B2FBE 100%)',
                    }
                }
            }
        }
    </script>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>

    <style>
        * { box-sizing: border-box; }
        body { font-family: 'DM Sans', sans-serif; }

        .gold-border {
            border: 2px solid transparent;
            background-clip: padding-box;
            position: relative;
        }
        .gold-border::before {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: inherit;
            background: linear-gradient(135deg, #C9A84C, #F0C040, #C9A84C);
            z-index: -1;
        }

        .input-field {
            width: 100%;
            padding: 14px 18px 14px 48px;
            border: 1.5px solid #E5E0F0;
            border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            color: #1a1a2e;
            background: #FAFAFA;
            transition: all 0.2s ease;
            outline: none;
        }
        .input-field:focus {
            border-color: #7B2FBE;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(123, 47, 190, 0.08);
        }
        .input-field::placeholder { color: #B0A8C0; }

        select.input-field { cursor: pointer; appearance: none; }

        .input-wrapper { position: relative; }
        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #7B2FBE;
            width: 20px;
            height: 20px;
        }

        .btn-gold {
            background: linear-gradient(135deg, #C9A84C 0%, #F0C040 50%, #C9A84C 100%);
            color: #2D0050;
            font-weight: 700;
            font-family: 'DM Sans', sans-serif;
            font-size: 16px;
            letter-spacing: 0.5px;
            padding: 16px 40px;
            border-radius: 14px;
            border: none;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 4px 20px rgba(201, 168, 76, 0.4);
        }
        .btn-gold:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(201, 168, 76, 0.55);
        }
        .btn-gold:active { transform: translateY(0); }

        .fade-in {
            opacity: 0;
            transform: translateY(24px);
            animation: fadeUp 0.6s ease forwards;
        }
        @keyframes fadeUp {
            to { opacity: 1; transform: translateY(0); }
        }
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
        .delay-4 { animation-delay: 0.4s; }
        .delay-5 { animation-delay: 0.5s; }
        .delay-6 { animation-delay: 0.6s; }
    </style>

    @stack('styles')
</head>
<body class="min-h-screen bg-cream">
    @yield('content')
    @stack('scripts')
</body>
</html>
