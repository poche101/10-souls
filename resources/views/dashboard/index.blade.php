<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin Dashboard — 10 Souls in 10 Days</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Epilogue:wght@300;400;500;600&display=swap" rel="stylesheet"/>

    <style>
        :root {
            --royal: #3B0070;
            --royal-mid: #5A1098;
            --royal-light: #8B4FC8;
            --gold: #C9A84C;
            --gold-light: #F0C040;
            --ink: #0D0818;
            --muted: #6B5F80;
            --surface: #F7F4FC;
            --card: #FFFFFF;
            --border: rgba(59,0,112,0.1);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Epilogue', sans-serif;
            background: var(--surface);
            color: var(--ink);
            min-height: 100vh;
        }

        h1, h2, h3, .font-display { font-family: 'Syne', sans-serif; }

        /* ── Sidebar ── */
        .sidebar {
            position: fixed;
            top: 0; left: 0; bottom: 0;
            width: 240px;
            background: linear-gradient(180deg, #1a0030 0%, #2D0050 60%, #3B0070 100%);
            display: flex;
            flex-direction: column;
            z-index: 50;
            border-right: 1px solid rgba(201,168,76,0.15);
        }

        .sidebar-logo {
            padding: 28px 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }

        .sidebar-nav { padding: 20px 12px; flex: 1; }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            color: rgba(255,255,255,0.55);
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            margin-bottom: 4px;
        }

        .nav-item:hover { background: rgba(255,255,255,0.06); color: rgba(255,255,255,0.85); }
        .nav-item.active {
            background: rgba(201,168,76,0.15);
            color: #F0C040;
            border: 1px solid rgba(201,168,76,0.25);
        }

        .nav-item svg { width: 18px; height: 18px; flex-shrink: 0; }

        .sidebar-footer {
            padding: 16px 12px 24px;
            border-top: 1px solid rgba(255,255,255,0.06);
        }

        /* ── Main ── */
        .main {
            margin-left: 240px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── Topbar ── */
        .topbar {
            background: white;
            border-bottom: 1px solid var(--border);
            padding: 16px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 40;
        }

        /* ── Stat cards ── */
        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 22px 24px;
            border: 1px solid var(--border);
            position: relative;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(59,0,112,0.1);
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
        }
        .stat-card.purple::before { background: linear-gradient(90deg, #3B0070, #8B4FC8); }
        .stat-card.gold::before   { background: linear-gradient(90deg, #C9A84C, #F0C040); }
        .stat-card.teal::before   { background: linear-gradient(90deg, #0D9488, #14B8A6); }
        .stat-card.rose::before   { background: linear-gradient(90deg, #BE185D, #EC4899); }
        .stat-card.indigo::before { background: linear-gradient(90deg, #4338CA, #818CF8); }
        .stat-card.green::before  { background: linear-gradient(90deg, #15803D, #22C55E); }

        .stat-icon {
            width: 44px; height: 44px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 14px;
        }

        .stat-value {
            font-family: 'Syne', sans-serif;
            font-size: 32px;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-label { font-size: 13px; color: var(--muted); font-weight: 500; }

        /* ── Table ── */
        .table-card {
            background: white;
            border-radius: 18px;
            border: 1px solid var(--border);
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(59,0,112,0.06);
        }

        .table-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }

        .search-box {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--surface);
            border: 1.5px solid var(--border);
            border-radius: 10px;
            padding: 9px 14px;
            transition: border-color 0.2s;
        }
        .search-box:focus-within { border-color: var(--royal-light); }
        .search-box input {
            border: none; outline: none; background: transparent;
            font-family: 'Epilogue', sans-serif;
            font-size: 14px; color: var(--ink);
            width: 220px;
        }
        .search-box input::placeholder { color: var(--muted); }

        table { width: 100%; border-collapse: collapse; }

        thead tr { background: #FAFAFE; }
        thead th {
            padding: 13px 16px;
            text-align: left;
            font-family: 'Syne', sans-serif;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--muted);
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }
        thead th a { color: inherit; text-decoration: none; display: flex; align-items: center; gap-5px; }
        thead th a:hover { color: var(--royal); }

        tbody tr {
            border-bottom: 1px solid rgba(59,0,112,0.05);
            transition: background 0.15s;
        }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: #FAF8FF; }

        tbody td {
            padding: 14px 16px;
            font-size: 14px;
            color: var(--ink);
            vertical-align: middle;
        }

        .avatar-circle {
            width: 36px; height: 36px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 13px;
            flex-shrink: 0;
        }

        .badge {
            display: inline-flex; align-items: center; gap: 4px;
            padding: 3px 10px; border-radius: 20px;
            font-size: 12px; font-weight: 600;
        }

        .badge-title {
            background: rgba(59,0,112,0.07);
            color: var(--royal-mid);
        }

        .souls-bar {
            display: flex; align-items: center; gap: 8px;
        }
        .souls-track {
            flex: 1; height: 5px; border-radius: 3px;
            background: rgba(59,0,112,0.08);
            max-width: 80px;
        }
        .souls-fill {
            height: 100%; border-radius: 3px;
            background: linear-gradient(90deg, #C9A84C, #F0C040);
        }

        /* ── Pagination ── */
        .pagination { display: flex; align-items: center; gap: 4px; }
        .page-btn {
            width: 34px; height: 34px;
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 600;
            transition: all 0.15s;
            border: 1px solid var(--border);
            background: white;
            color: var(--muted);
            text-decoration: none;
        }
        .page-btn:hover { background: var(--surface); color: var(--royal); border-color: var(--royal-light); }
        .page-btn.active {
            background: var(--royal);
            color: white;
            border-color: var(--royal);
        }
        .page-btn.disabled { opacity: 0.4; pointer-events: none; }

        /* ── Top churches panel ── */
        .church-row {
            display: flex; align-items: center; gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid var(--border);
        }
        .church-row:last-child { border-bottom: none; }

        .church-rank {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 18px;
            width: 28px;
            color: rgba(59,0,112,0.2);
            flex-shrink: 0;
        }
        .church-rank.top { color: var(--gold); }

        .church-bar-track {
            flex: 1; height: 6px; border-radius: 3px;
            background: rgba(59,0,112,0.07);
        }
        .church-bar-fill {
            height: 100%; border-radius: 3px;
            background: linear-gradient(90deg, #3B0070, #8B4FC8);
            transition: width 1s ease;
        }

        /* ── Animations ── */
        @keyframes fadeUp { from { opacity:0; transform:translateY(20px); } to { opacity:1; transform:translateY(0); } }
        .fade-up { animation: fadeUp 0.5s ease forwards; opacity: 0; }
        .d1 { animation-delay: 0.05s; }
        .d2 { animation-delay: 0.1s;  }
        .d3 { animation-delay: 0.15s; }
        .d4 { animation-delay: 0.2s;  }
        .d5 { animation-delay: 0.25s; }
        .d6 { animation-delay: 0.3s;  }

        /* ── Btn ── */
        .btn-export {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 9px 18px;
            border-radius: 10px;
            font-family: 'Epilogue', sans-serif;
            font-size: 13px; font-weight: 600;
            background: linear-gradient(135deg, #C9A84C, #F0C040);
            color: #1a0030;
            border: none; cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
            box-shadow: 0 3px 12px rgba(201,168,76,0.35);
        }
        .btn-export:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(201,168,76,0.45); }

        .btn-outline {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 9px 18px;
            border-radius: 10px;
            font-family: 'Epilogue', sans-serif;
            font-size: 13px; font-weight: 600;
            background: white;
            color: var(--royal);
            border: 1.5px solid var(--border);
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-outline:hover { border-color: var(--royal-light); background: var(--surface); }

        .empty-state {
            padding: 64px 24px;
            text-align: center;
            color: var(--muted);
        }

        /* Responsive */
        @media (max-width: 900px) {
            .sidebar { width: 200px; }
            .main { margin-left: 200px; }
        }
        @media (max-width: 640px) {
            .sidebar { display: none; }
            .main { margin-left: 0; }
        }
    </style>
</head>
<body>

{{-- ══════════════════════════════════════════════════════════ --}}
{{-- SIDEBAR                                                    --}}
{{-- ══════════════════════════════════════════════════════════ --}}
<aside class="sidebar">
    <div class="sidebar-logo">
        <div class="flex items-center gap-3 mb-1">
            <div style="width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,#C9A84C,#F0C040);display:flex;align-items:center;justify-content:center;">
                <img src="/images/oip.png" alt="Logo">
            </div>
            <div>
                <p style="font-family:'Syne',sans-serif;font-weight:700;font-size:13px;color:white;line-height:1.2;">Christ Embassy</p>
                <p style="font-size:10px;color:rgba(255,255,255,0.4);letter-spacing:0.1em;text-transform:uppercase;">Lagos Zone 5</p>
            </div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <p style="font-size:10px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:rgba(255,255,255,0.25);padding:0 14px 10px;">Menu</p>

        <a href="{{ route('dashboard') }}" class="nav-item active">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
            Dashboard
        </a>

        <a href="{{ route('register.form') }}" class="nav-item">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
            New Registration
        </a>

        <a href="{{ route('dashboard.export') }}" class="nav-item">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
            Export CSV
        </a>
    </nav>

    <div class="sidebar-footer">
        <div style="background:rgba(201,168,76,0.1);border:1px solid rgba(201,168,76,0.2);border-radius:10px;padding:12px 14px;">
            <p style="font-size:11px;font-weight:700;color:#F0C040;font-family:'Syne',sans-serif;margin-bottom:3px;">Campaign Period</p>
            <p style="font-size:12px;color:rgba(255,255,255,0.6);">4th – 13th May, 2026</p>
        </div>
    </div>
</aside>

{{-- ══════════════════════════════════════════════════════════ --}}
{{-- MAIN                                                       --}}
{{-- ══════════════════════════════════════════════════════════ --}}
<main class="main">

    {{-- Topbar --}}
    <div class="topbar">
        <div>
            <h1 style="font-family:'Syne',sans-serif;font-size:20px;font-weight:800;color:var(--ink);">Campaign Dashboard</h1>
            <p style="font-size:12px;color:var(--muted);margin-top:2px;">10 Souls in 10 Days — Soulwinning Campaign 2.0</p>
        </div>
        <div style="display:flex;align-items:center;gap:10px;">
            <a href="{{ route('dashboard.export') }}" class="btn-export">
                <svg style="width:15px;height:15px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                Export CSV
            </a>
            <a href="{{ route('register.form') }}" class="btn-outline">
                <svg style="width:15px;height:15px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Add Registration
            </a>

             <a href="{{ route('logout') }}"
            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition duration-200 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Logout
            </a>
        </div>
    </div>

    <div style="padding:28px 32px;flex:1;">

        {{-- ── STAT CARDS ── --}}
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:16px;margin-bottom:28px;">

            <div class="stat-card purple fade-up d1">
                <div class="stat-icon" style="background:rgba(59,0,112,0.08);">
                    <svg style="width:22px;height:22px;color:#5A1098;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                </div>
                <div class="stat-value" style="color:#3B0070;">{{ number_format($totalRegistered) }}</div>
                <div class="stat-label">Total Registered</div>
            </div>

            <div class="stat-card gold fade-up d2">
                <div class="stat-icon" style="background:rgba(201,168,76,0.1);">
                    <svg style="width:22px;height:22px;color:#C9A84C;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 2l2.4 7.4H22l-6.2 4.5 2.4 7.4L12 17l-6.2 4.3 2.4-7.4L2 9.4h7.6z"/></svg>
                </div>
                <div class="stat-value" style="color:#8B6914;">{{ number_format($totalSoulsComitted) }}</div>
                <div class="stat-label">Souls Committed</div>
            </div>

            <div class="stat-card teal fade-up d3">
                <div class="stat-icon" style="background:rgba(13,148,136,0.08);">
                    <svg style="width:22px;height:22px;color:#0D9488;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
                </div>
                <div class="stat-value" style="color:#0D9488;">{{ number_format($totalChurches) }}</div>
                <div class="stat-label">Churches</div>
            </div>

            <div class="stat-card rose fade-up d4">
                <div class="stat-icon" style="background:rgba(190,24,93,0.07);">
                    <svg style="width:22px;height:22px;color:#BE185D;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg>
                </div>
                <div class="stat-value" style="color:#BE185D;">{{ number_format($totalGroups) }}</div>
                <div class="stat-label">Groups</div>
            </div>

            <div class="stat-card indigo fade-up d5">
                <div class="stat-icon" style="background:rgba(67,56,202,0.07);">
                    <svg style="width:22px;height:22px;color:#4338CA;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                </div>
                <div class="stat-value" style="color:#4338CA;">{{ number_format($todayRegistrations) }}</div>
                <div class="stat-label">Today's Signups</div>
            </div>

            <div class="stat-card green fade-up d6">
                <div class="stat-icon" style="background:rgba(21,128,61,0.07);">
                    <svg style="width:22px;height:22px;color:#15803D;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
                </div>
                <div class="stat-value" style="color:#15803D;">{{ number_format($withAvatars) }}</div>
                <div class="stat-label">Avatars Generated</div>
            </div>
        </div>

        {{-- ── LOWER SECTION: Table + Top Churches ── --}}
        <div style="display:grid;grid-template-columns:1fr 280px;gap:20px;align-items:start;">

            {{-- Main table --}}
            <div class="table-card fade-up d2">
                <div class="table-header">
                    <div>
                        <h2 style="font-family:'Syne',sans-serif;font-size:16px;font-weight:700;color:var(--ink);">All Registrations</h2>
                        <p style="font-size:12px;color:var(--muted);margin-top:2px;">
                            {{ $registrations->total() }} {{ Str::plural('record', $registrations->total()) }} found
                            @if($search) for "<strong>{{ $search }}</strong>" @endif
                        </p>
                    </div>

                    <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
                        {{-- Search --}}
                        <form method="GET" action="{{ route('dashboard') }}" style="display:flex;gap:8px;">
                            @if(request('per_page')) <input type="hidden" name="per_page" value="{{ request('per_page') }}"> @endif
                            @if(request('sort'))     <input type="hidden" name="sort"     value="{{ request('sort') }}"> @endif
                            @if(request('dir'))      <input type="hidden" name="dir"      value="{{ request('dir') }}"> @endif

                            <div class="search-box">
                                <svg style="width:16px;height:16px;color:var(--muted);flex-shrink:0;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                                <input type="text" name="search" placeholder="Search name, church, group…" value="{{ $search }}"/>
                            </div>
                            <button type="submit" style="padding:9px 14px;border-radius:10px;border:1.5px solid var(--border);background:white;font-family:'Epilogue',sans-serif;font-size:13px;font-weight:600;color:var(--royal);cursor:pointer;">Search</button>
                            @if($search)
                            <a href="{{ route('dashboard') }}" style="padding:9px 12px;border-radius:10px;border:1px solid var(--border);background:white;font-size:13px;color:var(--muted);text-decoration:none;">✕</a>
                            @endif
                        </form>
                    </div>
                </div>

                <div style="overflow-x:auto;">
                   <table>
    <thead>
        <tr>
            <th style="width:40px;">#</th>
            <th>
                <a href="{{ route('dashboard', array_merge(request()->query(), ['sort'=>'full_name','dir'=>($sortBy==='full_name'&&$sortDir==='asc'?'desc':'asc')])) }}">
                    Registrant
                    @if($sortBy==='full_name') <span>{{ $sortDir==='asc' ? '↑' : '↓' }}</span> @endif
                </a>
            </th>
            <th>Phone</th>
            <th>Cell</th>
            <th>
                <a href="{{ route('dashboard', array_merge(request()->query(), ['sort'=>'church','dir'=>($sortBy==='church'&&$sortDir==='asc'?'desc':'asc')])) }}">
                    Church
                    @if($sortBy==='church') <span>{{ $sortDir==='asc' ? '↑' : '↓' }}</span> @endif
                </a>
            </th>
            <th>
                <a href="{{ route('dashboard', array_merge(request()->query(), ['sort'=>'group','dir'=>($sortBy==='group'&&$sortDir==='asc'?'desc':'asc')])) }}">
                    Group
                    @if($sortBy==='group') <span>{{ $sortDir==='asc' ? '↑' : '↓' }}</span> @endif
                </a>
            </th>
            <th>
                <a href="{{ route('dashboard', array_merge(request()->query(), ['sort'=>'souls_commitment','dir'=>($sortBy==='souls_commitment'&&$sortDir==='asc'?'desc':'asc')])) }}">
                    Souls
                    @if($sortBy==='souls_commitment') <span>{{ $sortDir==='asc' ? '↑' : '↓' }}</span> @endif
                </a>
            </th>
            <th>Avatar</th>
            <th>
                <a href="{{ route('dashboard', array_merge(request()->query(), ['sort'=>'kingschat_handle','dir'=>($sortBy==='kingschat_handle'&&$sortDir==='asc'?'desc':'asc')])) }}">
                    KC Handle
                    @if($sortBy === 'kingschat_handle')
                        <span>{{ $sortDir === 'asc' ? '↑' : '↓' }}</span>
                    @endif
                </a>
            </th>
            <th>
                <a href="{{ route('dashboard', array_merge(request()->query(), ['sort'=>'created_at','dir'=>($sortBy==='created_at'&&$sortDir==='asc'?'desc':'asc')])) }}">
                    Registered
                    @if($sortBy === 'created_at')
                        <span>{{ $sortDir === 'asc' ? '↑' : '↓' }}</span>
                    @endif
                </a>
            </th>
        </tr>
    </thead>
    <tbody>
        @forelse($registrations as $i => $reg)
        @php
            $colors = [
                ['#EDE9FE','#5B21B6'],['#FEF3C7','#92400E'],['#D1FAE5','#065F46'],
                ['#FCE7F3','#9D174D'],['#DBEAFE','#1E40AF'],['#FEE2E2','#991B1B'],
            ];
            $c = $colors[$reg->id % count($colors)];
            $initials = collect(explode(' ', $reg->full_name))->take(2)->map(fn($w)=>strtoupper($w[0]))->implode('');
        @endphp
        <tr>
            <td style="color:var(--muted);font-size:12px;font-weight:600;">
                {{ $registrations->firstItem() + $i }}
            </td>
            <td>
                <div style="display:flex;align-items:center;gap:10px;">
                    @if($reg->avatar_path)
                        <img src="{{ asset('storage/'.$reg->avatar_path) }}"
                             style="width:36px;height:36px;border-radius:50%;object-fit:cover;border:2px solid rgba(201,168,76,0.4);"
                             alt="{{ $reg->full_name }}"/>
                    @else
                        <div class="avatar-circle" style="background:{{ $c[0] }};color:{{ $c[1] }};">
                            {{ $initials }}
                        </div>
                    @endif
                    <div>
                        <div style="font-weight:600;font-size:14px;color:var(--ink);">{{ $reg->full_name }}</div>
                        <span class="badge badge-title">{{ $reg->title }}</span>
                    </div>
                </div>
            </td>
            <td style="color:var(--muted);font-size:13px;">{{ $reg->phone_number }}</td>
            <td style="font-size:13px;">{{ $reg->cell }}</td>
            <td>
                <div style="font-size:13px;font-weight:500;max-width:140px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="{{ $reg->church }}">
                    {{ $reg->church }}
                </div>
            </td>
            <td style="font-size:13px;color:var(--muted);">{{ $reg->group }}</td>
            <td>
                @php $maxSouls = $registrations->max('souls_commitment') ?: 1; @endphp
                <div class="souls-bar">
                    <span style="font-family:'Syne',sans-serif;font-weight:700;font-size:15px;color:var(--gold);min-width:24px;">{{ $reg->souls_commitment }}</span>
                    <div class="souls-track">
                        <div class="souls-fill" style="width:{{ min(100, ($reg->souls_commitment / $maxSouls) * 100) }}%;"></div>
                    </div>
                </div>
            </td>
            <td>
                @if($reg->avatar_path)
                    <a href="{{ route('avatar.download', $reg->id) }}"
                       style="display:inline-flex;align-items:center;gap:4px;font-size:12px;font-weight:600;color:#15803D;text-decoration:none;background:rgba(21,128,61,0.08);padding:4px 10px;border-radius:6px;"
                       title="Download avatar">
                        <svg style="width:13px;height:13px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                        Done
                    </a>
                @else
                    <a href="{{ route('avatar.show', $reg->id) }}"
                       style="display:inline-flex;align-items:center;gap:4px;font-size:12px;font-weight:600;color:#C9A84C;text-decoration:none;background:rgba(201,168,76,0.08);padding:4px 10px;border-radius:6px;">
                        <svg style="width:13px;height:13px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25M12 3v13.5m0 0l-4.5-4.5M12 16.5l4.5-4.5"/></svg>
                        Upload
                    </a>
                @endif
            </td>
            {{-- Added the missing KC Handle cell here --}}
            <td style="font-size:13px; font-weight:500; color:var(--ink);">
                {{ $reg->kingschat_handle ?? '—' }}
            </td>
            <td style="font-size:12px;color:var(--muted);white-space:nowrap;">
                {{ $reg->created_at->format('M d, Y') }}<br/>
                <span style="font-size:11px;">{{ $reg->created_at->format('g:i A') }}</span>
            </td>
        </tr>
        @empty
        <tr>
            {{-- Updated colspan to 10 to match the new total number of columns --}}
            <td colspan="10">
                <div class="empty-state">
                    <svg style="width:48px;height:48px;color:rgba(59,0,112,0.15);margin:0 auto 16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                    <p style="font-family:'Syne',sans-serif;font-weight:700;font-size:16px;color:var(--royal);margin-bottom:6px;">No registrations found</p>
                    <p style="font-size:13px;">{{ $search ? 'Try a different search term.' : 'No one has registered yet.' }}</p>
                </div>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
                </div>

                {{-- Pagination --}}
                @if($registrations->hasPages())
                <div style="padding:16px 20px;border-top:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
                    <p style="font-size:13px;color:var(--muted);">
                        Showing <strong>{{ $registrations->firstItem() }}</strong>–<strong>{{ $registrations->lastItem() }}</strong>
                        of <strong>{{ $registrations->total() }}</strong>
                    </p>
                    <div class="pagination">
                        <a href="{{ $registrations->previousPageUrl() ?? '#' }}"
                           class="page-btn {{ !$registrations->previousPageUrl() ? 'disabled' : '' }}">
                            <svg style="width:14px;height:14px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/></svg>
                        </a>
                        @foreach($registrations->getUrlRange(max(1,$registrations->currentPage()-2), min($registrations->lastPage(),$registrations->currentPage()+2)) as $page => $url)
                            <a href="{{ $url }}" class="page-btn {{ $page == $registrations->currentPage() ? 'active' : '' }}">{{ $page }}</a>
                        @endforeach
                        <a href="{{ $registrations->nextPageUrl() ?? '#' }}"
                           class="page-btn {{ !$registrations->nextPageUrl() ? 'disabled' : '' }}">
                            <svg style="width:14px;height:14px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                        </a>
                    </div>
                </div>
                @endif
            </div>

            {{-- ── RIGHT PANEL: Top Churches ── --}}
            <div style="display:flex;flex-direction:column;gap:16px;">

                {{-- Top churches --}}
                <div class="table-card fade-up d3" style="padding:20px;">
                    <h3 style="font-family:'Syne',sans-serif;font-size:15px;font-weight:700;color:var(--ink);margin-bottom:4px;">Top Churches</h3>
                    <p style="font-size:12px;color:var(--muted);margin-bottom:16px;">By number of registrants</p>

                    @php $maxCount = $topChurches->max('count') ?: 1; @endphp

                    @forelse($topChurches as $idx => $ch)
                    <div class="church-row">
                        <span class="church-rank {{ $idx === 0 ? 'top' : '' }}">{{ $idx + 1 }}</span>
                        <div style="flex:1;min-width:0;">
                            <div style="font-size:13px;font-weight:600;color:var(--ink);margin-bottom:5px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="{{ $ch->church }}">
                                {{ $ch->church }}
                            </div>
                            <div class="church-bar-track">
                                <div class="church-bar-fill" style="width:{{ ($ch->count / $maxCount) * 100 }}%;"></div>
                            </div>
                        </div>
                        <div style="text-align:right;flex-shrink:0;">
                            <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:16px;color:var(--royal);">{{ $ch->count }}</div>
                            <div style="font-size:11px;color:var(--muted);">{{ $ch->souls }} souls</div>
                        </div>
                    </div>
                    @empty
                    <p style="font-size:13px;color:var(--muted);text-align:center;padding:24px 0;">No data yet</p>
                    @endforelse
                </div>

                {{-- Campaign quick links --}}
                <div class="table-card fade-up d4" style="padding:20px;">
                    <h3 style="font-family:'Syne',sans-serif;font-size:15px;font-weight:700;color:var(--ink);margin-bottom:16px;">Quick Links</h3>
                    <div style="display:flex;flex-direction:column;gap:10px;">
                        <a href="https://kingsforms.online/10soulsin10daysapril" target="_blank"
                           style="display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:10px;background:rgba(59,0,112,0.04);border:1px solid var(--border);text-decoration:none;transition:background 0.15s;"
                           onmouseover="this.style.background='rgba(59,0,112,0.08)'" onmouseout="this.style.background='rgba(59,0,112,0.04)'">
                            <div style="width:30px;height:30px;border-radius:8px;background:rgba(59,0,112,0.08);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <svg style="width:15px;height:15px;color:var(--royal-mid);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/></svg>
                            </div>
                            <div>
                                <p style="font-size:12px;font-weight:600;color:var(--ink);">Registration Form</p>
                                <p style="font-size:11px;color:var(--muted);">kingsforms.online</p>
                            </div>
                        </a>

                        <a href="https://kingsforms.online/10soulsin10daysdata" target="_blank"
                           style="display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:10px;background:rgba(201,168,76,0.05);border:1px solid rgba(201,168,76,0.2);text-decoration:none;transition:background 0.15s;"
                           onmouseover="this.style.background='rgba(201,168,76,0.1)'" onmouseout="this.style.background='rgba(201,168,76,0.05)'">
                            <div style="width:30px;height:30px;border-radius:8px;background:rgba(201,168,76,0.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <svg style="width:15px;height:15px;color:var(--gold);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 2l2.4 7.4H22l-6.2 4.5 2.4 7.4L12 17l-6.2 4.3 2.4-7.4L2 9.4h7.6z"/></svg>
                            </div>
                            <div>
                                <p style="font-size:12px;font-weight:600;color:var(--ink);">Submit Souls Data</p>
                                <p style="font-size:11px;color:var(--muted);">kingsforms.online</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

</body>
</html>
