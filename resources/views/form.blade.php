@extends('layouts.app')

@section('title', 'Register — 10 Souls in 10 Days')

@section('content')

    {{-- ── Background decorative layer ── --}}
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        {{-- Top-right soft blob --}}
        <div
            style="position:absolute;top:-120px;right:-120px;width:480px;height:480px;border-radius:50%;background:radial-gradient(circle,rgba(123,47,190,0.12) 0%,transparent 70%);">
        </div>
        {{-- Bottom-left soft blob --}}
        <div
            style="position:absolute;bottom:-80px;left:-80px;width:360px;height:360px;border-radius:50%;background:radial-gradient(circle,rgba(201,168,76,0.1) 0%,transparent 70%);">
        </div>
        {{-- Subtle grid pattern --}}
        <div
            style="position:absolute;inset:0;background-image:radial-gradient(circle,rgba(75,0,130,0.04) 1px,transparent 1px);background-size:32px 32px;">
        </div>
    </div>

    <div class="relative z-10 min-h-screen py-10 px-4 flex flex-col items-center justify-start">

        {{-- ── Header ── --}}
        <header class="w-full max-w-2xl mb-10 fade-in">
            {{-- Logo + org badge --}}
            <div class="flex flex-col items-center gap-3 mb-8">
                {{-- Crown / org logo placeholder --}}
                <div class="flex items-center justify-center w-16 h-16 rounded-2xl shadow-lg"
                    style="background:linear-gradient(135deg,#2D0050,#7B2FBE);">
                    <img src="/images/oip.png" alt="Logo">
                </div>

                <div class="text-center">
                    <p class="text-xs font-semibold tracking-widest uppercase text-purple-400 mb-1">Christ Embassy</p>
                    <div class="inline-flex items-center gap-2 px-4 py-1 rounded-full text-xs font-bold tracking-wider"
                        style="background:linear-gradient(135deg,#C9A84C,#F0C040);color:#2D0050;">
                        LAGOS ZONE 5
                    </div>
                </div>
            </div>

            {{-- Hero text --}}
            <div class="text-center">
                <div class="inline-flex items-center gap-2 mb-4 px-4 py-2 rounded-full border text-xs font-semibold tracking-wider uppercase"
                    style="border-color:rgba(201,168,76,0.4);color:#C9A84C;background:rgba(201,168,76,0.06);">
                    <span
                        style="width:6px;height:6px;border-radius:50%;background:#C9A84C;display:inline-block;animation:pulse 1.5s infinite;"></span>
                    Soulwinning Campaign 2.0
                </div>

                <h1 class="font-display font-black text-4xl md:text-5xl leading-tight mb-3" style="color:#2D0050;">
                    10 Souls
                    <span
                        style="background:linear-gradient(135deg,#C9A84C,#F0C040);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                        in 10 Days
                    </span>
                </h1>

                <p class="text-gray-500 text-base font-body max-w-md mx-auto leading-relaxed">
                    Saturating the Island with the Gospel.<br />
                    <span class="font-semibold" style="color:#4B0082;">4th – 13th May, 2026</span>
                </p>
            </div>

            {{-- Divider --}}
            <div class="flex items-center gap-4 mt-8">
                <div class="flex-1 h-px" style="background:linear-gradient(90deg,transparent,rgba(201,168,76,0.4));"></div>
                <div class="w-2 h-2 rounded-full" style="background:#C9A84C;"></div>
                <div class="flex-1 h-px" style="background:linear-gradient(90deg,rgba(201,168,76,0.4),transparent);"></div>
            </div>
        </header>

        {{-- ── Form card ── --}}
        <div class="w-full max-w-2xl fade-in delay-1">
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden"
                style="box-shadow:0 25px 60px rgba(75,0,130,0.12),0 8px 24px rgba(0,0,0,0.06);">

                {{-- Card top accent bar --}}
                <div class="h-1.5 w-full"
                    style="background:linear-gradient(90deg,#2D0050,#7B2FBE,#C9A84C,#F0C040,#C9A84C);"></div>

                <div class="p-8 md:p-10">
                    <div class="mb-8">
                        <h2 class="font-display font-bold text-2xl mb-1" style="color:#2D0050;">Registration Form</h2>
                        <p class="text-sm text-gray-400">Fill in your details to join the campaign</p>
                    </div>

                    @if ($errors->any())
                        <div class="mb-6 p-4 rounded-xl border text-sm"
                            style="background:#FFF5F5;border-color:#FED7D7;color:#9B2C2C;">
                            <p class="font-semibold mb-2">Please fix the following:</p>
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                   <form action="{{ route('register.store') }}" method="POST" class="space-y-5">
                        @csrf

                        {{-- Row: Title --}}
                        <div class="fade-in delay-2">
                            <label class="block text-sm font-semibold mb-2" style="color:#2D0050;">
                                Title <span class="text-red-400">*</span>
                            </label>
                            <div class="input-wrapper">
                                <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                                <select name="title" class="input-field" style="padding-left:48px;" required>
                                    <option value="" disabled {{ old('title') ? '' : 'selected' }}>Select your title
                                    </option>
                                    @foreach (['Pastor', 'Brother', 'Sister', 'Deacon', 'Deaconess'] as $t)
                                        <option value="{{ $t }}" {{ old('title') == $t ? 'selected' : '' }}>
                                            {{ $t }}</option>
                                    @endforeach
                                </select>
                                {{-- Custom chevron for select --}}
                                <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 pointer-events-none"
                                    style="color:#7B2FBE;" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </div>

                        {{-- Full Name --}}
                        <div class="fade-in delay-2">
                            <label class="block text-sm font-semibold mb-2" style="color:#2D0050;">
                                Full Name <span class="text-red-400">*</span>
                            </label>
                            <div class="input-wrapper">
                                <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                                <input type="text" name="full_name" class="input-field" placeholder="e.g. John Adeyemi"
                                    value="{{ old('full_name') }}" required />
                            </div>
                        </div>

                        {{-- KingsChat Handle --}}
                        <div class="fade-in delay-2">
                            <label class="block text-sm font-semibold mb-2" style="color:#2D0050;">
                                KingsChat Handle <span class="text-red-400"></span>
                            </label>
                            <div class="input-wrapper">
                                <img src="images/kchat.png" alt="KingsChat"
                                    class="input-icon"
                                    style="width:45px; height:45px; object-fit:contain;" />
                                <input type="text" name="kingschat_handle" class="input-field"
                                    placeholder="e.g. @JohnAdeyemi"
                                    value="{{ old('kingschat_handle') }}" />
                            </div>
                        </div>

                        {{-- Row: Phone + Cell --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 fade-in delay-3">
                            <div>
                                <label class="block text-sm font-semibold mb-2" style="color:#2D0050;">
                                    Phone Number <span class="text-red-400">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                    </svg>
                                    <input type="tel" name="phone_number" class="input-field"
                                        placeholder="e.g. 08012345678" value="{{ old('phone_number') }}" required />
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-2" style="color:#2D0050;">
                                    Cell <span class="text-red-400">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                    </svg>
                                    <input type="text" name="cell" class="input-field"
                                        placeholder="Your cell name" value="{{ old('cell') }}" required />
                                </div>
                            </div>
                        </div>

                        {{-- Church --}}
                        <div class="fade-in delay-4">
                            <label class="block text-sm font-semibold mb-2" style="color:#2D0050;">
                                Church/Fellowship <span class="text-red-400">*</span>
                            </label>
                            <div class="input-wrapper">
                                <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>
                                <input type="text" name="church" class="input-field"
                                    placeholder="e.g. CE Victoria Island, Strategic Professionals"
                                    value="{{ old('church') }}" required />
                            </div>
                        </div>

                        {{-- Group --}}
                        <div class="fade-in delay-4">
                            <label class="block text-sm font-semibold mb-2" style="color:#2D0050;">
                                Group <span class="text-red-400">*</span>
                            </label>
                            <div class="input-wrapper">
                                <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                                </svg>
                                <input type="text" name="group" class="input-field"
                                    placeholder="e.g. Victoria Island Group" value="{{ old('group') }}" required />
                            </div>
                        </div>

                        {{-- Souls commitment --}}
                        <div class="fade-in delay-5">
                            <label class="block text-sm font-semibold mb-2" style="color:#2D0050;">
                                How many souls do you commit to win in this 10 Days?
                                <span class="text-red-400">*</span>
                            </label>
                            <div class="p-5 rounded-2xl border-2 border-dashed"
                                style="border-color:rgba(201,168,76,0.5);background:linear-gradient(135deg,rgba(201,168,76,0.04),rgba(75,0,130,0.04));">
                                <div class="flex items-center gap-4">

                                    <div class="flex-1 text-center">
                                        {{-- Input field instead of Div --}}
                                        <input type="number" id="souls_input" name="souls_commitment"
                                            value="{{ old('souls_commitment', 1) }}" min="1"
                                            class="w-full bg-transparent border-none text-center font-display font-black text-5xl focus:ring-0 focus:outline-none"
                                            style="background:linear-gradient(135deg,#C9A84C,#F0C040);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text; -moz-appearance: textfield;"
                                            oninput="validateInput(this)">

                                        <p class="text-xs text-gray-400 mt-1 font-medium tracking-wide uppercase">souls
                                            committed</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="pt-4 fade-in delay-6">
                            <button type="submit" class="btn-gold w-full flex items-center justify-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Register Now
                            </button>

                            <p class="text-center text-xs text-gray-400 mt-4">
                                By registering, you commit to winning souls for Christ during<br />
                                the <span class="font-semibold" style="color:#4B0082;">10 Souls in 10 Days</span>
                                campaign.
                            </p>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Footer links --}}

        </div>

        <div class="h-12"></div>
    </div>

    @push('styles')
        <style>
            @keyframes pulse {

                0%,
                100% {
                    opacity: 1;
                }

                50% {
                    opacity: 0.4;
                }
            }

            #decrement:hover,
            #increment:hover {
                background: rgba(75, 0, 130, 0.15) !important;
                transform: scale(1.05);
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            let count = {{ old('souls_commitment', 1) }};

            function changeCount(delta) {
                count = Math.max(1, Math.min(100, count + delta));
                document.getElementById('count-display').textContent = count;
                document.getElementById('souls_input').value = count;
            }

            // Animate the counter on load
            const display = document.getElementById('count-display');
            display.style.transition = 'transform 0.1s ease';

            document.getElementById('decrement').addEventListener('click', () => {
                display.style.transform = 'scale(0.9)';
                setTimeout(() => display.style.transform = 'scale(1)', 100);
            });
            document.getElementById('increment').addEventListener('click', () => {
                display.style.transform = 'scale(1.1)';
                setTimeout(() => display.style.transform = 'scale(1)', 100);
            });
        </script>

        <script>
            function changeCount(amount) {
    const input = document.getElementById('souls_input');
    let currentValue = parseInt(input.value) || 0;
    let newValue = currentValue + amount;

    if (newValue < 1) newValue = 1; // Minimum limit
    input.value = newValue;
}

function validateInput(input) {
    // Ensure the user doesn't leave it empty or enter 0/negative numbers
    if (input.value === "" || parseInt(input.value) < 1) {
        // We don't force it to 1 immediately so they can delete and type
        // but we can add a 'blur' listener to fix it when they click away
    }
}

// Optional: Fix empty or invalid input when user clicks away
document.getElementById('souls_input').addEventListener('blur', function() {
    if (this.value === "" || parseInt(this.value) < 1) {
        this.value = 1;
    }
});
        </script>
    @endpush

@endsection
