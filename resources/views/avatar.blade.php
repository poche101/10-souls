@extends('layouts.app')

@section('title', 'Upload Your Avatar — 10 Souls in 10 Days')

@section('content')

    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div style="position:absolute;top:-120px;right:-120px;width:480px;height:480px;border-radius:50%;background:radial-gradient(circle,rgba(123,47,190,0.12) 0%,transparent 70%);">
        </div>
        <div style="position:absolute;bottom:-80px;left:-80px;width:360px;height:360px;border-radius:50%;background:radial-gradient(circle,rgba(201,168,76,0.1) 0%,transparent 70%);">
        </div>
        <div style="position:absolute;inset:0;background-image:radial-gradient(circle,rgba(75,0,130,0.04) 1px,transparent 1px);background-size:32px 32px;">
        </div>
    </div>

    <div class="relative z-10 min-h-screen py-10 px-4 flex flex-col items-center">

        {{-- Header --}}
        <header class="w-full max-w-5xl mb-8 fade-in">
            <div class="flex flex-col items-center gap-3 mb-6">
                <div class="flex items-center justify-center w-14 h-14 rounded-2xl shadow-lg"
                    style="background:linear-gradient(135deg,#2D0050,#7B2FBE);">
                    <img src="/images/oip.png" alt="Logo">
                </div>
                <div class="text-center">
                    <p class="text-xs font-semibold tracking-widest uppercase text-purple-400 mb-1">Christ Embassy</p>
                    <div class="inline-flex items-center gap-2 px-4 py-1 rounded-full text-xs font-bold tracking-wider"
                        style="background:linear-gradient(135deg,#C9A84C,#F0C040);color:#2D0050;">LAGOS ZONE 5</div>
                </div>
            </div>

            <div class="text-center mb-2">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-semibold mb-4"
                    style="background:rgba(0,180,100,0.1);color:#00803a;border:1px solid rgba(0,180,100,0.25);">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Registration Successful!
                </div>
                <h1 class="font-display font-black text-3xl md:text-4xl mb-2" style="color:#2D0050;">
                    Welcome, <span
                        style="background:linear-gradient(135deg,#C9A84C,#F0C040);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">{{ $registration->title }}
                        {{ $registration->full_name }}</span>!
                </h1>
                <p class="text-gray-500 text-base">Upload your photo to generate your campaign avatar</p>
            </div>
        </header>

        {{-- Main content: centered on desktop --}}
        <div class="w-full max-w-2xl grid grid-cols-1 gap-8 items-start fade-in delay-1">

            {{-- ── Avatar Preview ── --}}
            <div class="flex flex-col items-center">
                <div class="w-full max-w-sm">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4 text-center">Preview</h3>

                    <div class="relative rounded-2xl overflow-hidden shadow-2xl bg-white aspect-square">

                        {{-- Layer 1: User photo behind frame --}}
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none"
                            style="z-index: 1;">
                            <img id="user-photo-preview" class="hidden object-cover rounded-full"
                                style="width: 53%; aspect-ratio: 1; transform: translateY(-7%);" alt="User photo">
                        </div>

                        {{-- Layer 2: Frame image --}}
                        <img id="frame-overlay" src="/images/10.png"
                            class="relative w-full h-full z-10 pointer-events-none"
                            alt="Campaign Frame">

                        {{-- Layer 3: Final generated result --}}
                    
                    </div>

                    {{-- Download button --}}
                    <div id="download-section" class="hidden mt-5">
                        <a id="download-btn" href="{{ route('avatar.download', $registration->id) }}"
                            class="btn-gold w-full flex items-center justify-center gap-2 text-center">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                            </svg>
                            Download My Avatar
                        </a>
                        <p class="text-center text-xs text-gray-400 mt-2">Share on WhatsApp, Instagram & Facebook!</p>
                    </div>
                </div>
            </div>

            {{-- ── Upload card ── --}}
            <div class="flex flex-col gap-6">

                <div class="bg-white rounded-2xl shadow-lg overflow-hidden"
                    style="box-shadow:0 8px 30px rgba(75,0,130,0.08);">
                    <div class="h-1"
                        style="background:linear-gradient(90deg,#2D0050,#7B2FBE,#C9A84C,#F0C040,#C9A84C);"></div>
                    <div class="p-6">
                        <h3 class="font-display font-bold text-lg mb-1" style="color:#2D0050;">Upload Your Photo</h3>
                        <p class="text-sm text-gray-400 mb-6">Your photo will be placed inside the campaign frame</p>

                        {{-- Drop zone --}}
                        <div id="drop-zone"
                            class="relative border-2 border-dashed rounded-2xl p-10 text-center cursor-pointer transition-all"
                            style="border-color:rgba(123,47,190,0.3);background:rgba(123,47,190,0.02);"
                            onclick="document.getElementById('photo-input').click()">

                            <input type="file" id="photo-input" accept="image/jpeg,image/jpg,image/png"
                                class="hidden" onchange="handleFileSelect(event)" />

                            <div id="drop-content">
                                <div class="w-16 h-16 rounded-2xl mx-auto mb-4 flex items-center justify-center"
                                    style="background:linear-gradient(135deg,rgba(75,0,130,0.1),rgba(201,168,76,0.1));">
                                    <svg class="w-8 h-8" style="color:#7B2FBE;" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                    </svg>
                                </div>
                                <p class="font-semibold text-base mb-1" style="color:#2D0050;">Click to upload your photo</p>
                                <p class="text-sm text-gray-400">or drag and drop here</p>
                                <p class="text-xs text-gray-300 mt-2">JPG or PNG, max 5MB</p>
                            </div>

                            <div id="file-selected" class="hidden">
                                <div class="w-16 h-16 rounded-2xl mx-auto mb-4 flex items-center justify-center"
                                    style="background:rgba(0,180,100,0.1);">
                                    <svg class="w-8 h-8" style="color:#00803a;" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <p class="font-semibold text-sm" style="color:#00803a;" id="file-name-display">Photo selected</p>
                                <p class="text-xs text-gray-400 mt-1">Click to change</p>
                            </div>
                        </div>

                        {{-- Error message --}}
                        <div id="upload-error" class="hidden mt-4 p-3 rounded-xl text-sm font-medium"
                            style="background:#FFF5F5;color:#9B2C2C;border:1px solid #FED7D7;"></div>

                        {{-- Upload button --}}
                        <button id="upload-btn" onclick="uploadAvatar()" disabled
                            class="btn-gold w-full mt-5 flex items-center justify-center gap-2 opacity-40 cursor-not-allowed transition-all"
                            style="pointer-events:none;">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z" />
                            </svg>
                            <span id="upload-btn-text">Generate My Avatar</span>
                        </button>

                        {{-- Loading bar --}}
                        <div id="progress-bar" class="hidden mt-4">
                            <div class="flex justify-between text-xs text-gray-400 mb-2">
                                <span>Generating avatar...</span>
                                <span id="progress-pct">0%</span>
                            </div>
                            <div class="h-2 rounded-full overflow-hidden" style="background:#F0E8FF;">
                                <div id="progress-fill" class="h-full rounded-full transition-all duration-300"
                                    style="width:0%;background:linear-gradient(90deg,#4B0082,#7B2FBE,#C9A84C);"></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tips card --}}
                <div class="rounded-2xl p-5"
                    style="background:linear-gradient(135deg,rgba(75,0,130,0.05),rgba(201,168,76,0.05));border:1px solid rgba(201,168,76,0.2);">
                    <h4 class="text-sm font-bold mb-3" style="color:#4B0082;">📸 Photo Tips for Best Results</h4>
                    <ul class="space-y-2 text-sm text-gray-500">
                        <li class="flex items-start gap-2">
                            <span style="color:#C9A84C;margin-top:1px;">✓</span>
                            Use a clear, well-lit headshot or portrait photo
                        </li>
                        <li class="flex items-start gap-2">
                            <span style="color:#C9A84C;margin-top:1px;">✓</span>
                            Center your face for best circle crop results
                        </li>
                        <li class="flex items-start gap-2">
                            <span style="color:#C9A84C;margin-top:1px;">✓</span>
                            JPG or PNG format, under 5MB
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="h-12"></div>
    </div>

    @push('scripts')
        <script>
            const registrationId = {{ $registration->id }};
            let selectedFile = null;

            const dropZone = document.getElementById('drop-zone');
            dropZone.addEventListener('dragover', e => {
                e.preventDefault();
                dropZone.style.borderColor = '#7B2FBE';
                dropZone.style.background = 'rgba(123,47,190,0.06)';
            });
            dropZone.addEventListener('dragleave', () => {
                dropZone.style.borderColor = 'rgba(123,47,190,0.3)';
                dropZone.style.background = 'rgba(123,47,190,0.02)';
            });
            dropZone.addEventListener('drop', e => {
                e.preventDefault();
                dropZone.style.borderColor = 'rgba(123,47,190,0.3)';
                dropZone.style.background = 'rgba(123,47,190,0.02)';
                const file = e.dataTransfer.files[0];
                if (file) processFile(file);
            });

            function handleFileSelect(event) {
                const file = event.target.files[0];
                if (file) processFile(file);
            }

            function processFile(file) {
                if (!['image/jpeg', 'image/jpg', 'image/png'].includes(file.type)) {
                    showError('Please upload a JPG or PNG image.');
                    return;
                }
                if (file.size > 5 * 1024 * 1024) {
                    showError('File must be under 5MB.');
                    return;
                }

                selectedFile = file;
                hideError();

                document.getElementById('drop-content').classList.add('hidden');
                document.getElementById('file-selected').classList.remove('hidden');
                document.getElementById('file-name-display').textContent = file.name;

                const reader = new FileReader();
                reader.onload = e => {
                    const userPhoto = document.getElementById('user-photo-preview');
                    userPhoto.src = e.target.result;
                    userPhoto.classList.remove('hidden');
                    document.getElementById('final-avatar-preview').classList.add('hidden');
                };
                reader.readAsDataURL(file);

                const btn = document.getElementById('upload-btn');
                btn.disabled = false;
                btn.style.opacity = '1';
                btn.style.cursor = 'pointer';
                btn.style.pointerEvents = 'auto';
            }

            function showError(msg) {
                const el = document.getElementById('upload-error');
                el.textContent = msg;
                el.classList.remove('hidden');
            }

            function hideError() {
                document.getElementById('upload-error').classList.add('hidden');
            }

            async function uploadAvatar() {
                if (!selectedFile) return;

                const btn = document.getElementById('upload-btn');
                const btnText = document.getElementById('upload-btn-text');
                const progressBar = document.getElementById('progress-bar');
                const progressFill = document.getElementById('progress-fill');
                const progressPct = document.getElementById('progress-pct');

                btn.disabled = true;
                btn.style.opacity = '0.7';
                btnText.textContent = 'Generating...';
                progressBar.classList.remove('hidden');
                hideError();

                let pct = 0;
                const interval = setInterval(() => {
                    pct = Math.min(pct + Math.random() * 15, 85);
                    progressFill.style.width = pct + '%';
                    progressPct.textContent = Math.round(pct) + '%';
                }, 200);

                const formData = new FormData();
                formData.append('photo', selectedFile);

                const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
                if (csrfTokenMeta) {
                    formData.append('_token', csrfTokenMeta.content);
                } else {
                    clearInterval(interval);
                    showError('Configuration error (CSRF missing).');
                    resetBtn();
                    return;
                }

                try {
                    const response = await fetch(`/avatar/${registrationId}/upload`, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        }
                    });
                    clearInterval(interval);
                    progressFill.style.width = '100%';
                    progressPct.textContent = '100%';

                    const data = await response.json();

                    if (data.success) {
                        const finalImg = document.getElementById('final-avatar-preview');
                        finalImg.src = data.image_url + '?t=' + Date.now();
                        finalImg.classList.remove('hidden');

                        document.getElementById('download-section').classList.remove('hidden');
                        document.getElementById('download-btn').href = `/avatar/${registrationId}/download`;

                        btnText.textContent = '✓ Avatar Generated!';
                        btn.style.opacity = '1';

                        setTimeout(() => {
                            document.getElementById('download-section').scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });
                        }, 300);
                    } else {
                        showError(data.message || 'Generation failed.');
                        resetBtn();
                    }
                } catch (err) {
                    clearInterval(interval);
                    showError('Connection error or server crash.');
                    resetBtn();
                }
            }

            function resetBtn() {
                const btn = document.getElementById('upload-btn');
                btn.disabled = false;
                btn.style.opacity = '1';
                document.getElementById('upload-btn-text').textContent = 'Generate My Avatar';
                document.getElementById('progress-bar').classList.add('hidden');
            }
        </script>
    @endpush
@endsection
