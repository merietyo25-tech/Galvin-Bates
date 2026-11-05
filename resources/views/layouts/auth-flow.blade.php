<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="theme-color" content="#0657A4">
<link rel="icon" type="image/png" sizes="192x192" href="/site-icon-192.png">
<title>@yield('title') — {{ site_name() }}</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
{{-- Gabarit des pages d'activation du compte (module KYC / IBAN / activation) --}}
<style>
:root{
  --bg:#02182E; --card:#05243F; --inp:#06304F; --navy:#032A4F; --navy2:#043767;
  --accent:#2B94F7; --accent-soft:#81B6E9;
  --text:#FFFFFF; --sub:rgba(255,255,255,.6); --muted:rgba(255,255,255,.32); --bdr:rgba(129,182,233,.16);
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html,body{min-height:100%;background:var(--bg);color:var(--text);font-family:'Inter',system-ui,sans-serif;font-size:15px;-webkit-font-smoothing:antialiased}
a{color:inherit;text-decoration:none}
.shell{min-height:100vh;display:flex;flex-direction:column}
.topbar{display:flex;align-items:center;justify-content:space-between;padding:.9rem 1.5rem}
.topbar a{font-size:.78rem;color:var(--sub);display:inline-flex;gap:.45rem;align-items:center}
.topbar a:hover{color:#fff}
.wrap{flex:1;display:flex;align-items:center;justify-content:center;gap:2.5rem;padding:1.5rem 1.25rem 2.5rem;flex-wrap:wrap}
.aside{max-width:320px;flex:1 1 260px}
.aside__title{font-family:'Space Grotesk',sans-serif;font-size:1.35rem;margin-bottom:1rem}
.aside__list{list-style:none;display:grid;gap:.85rem}
.aside__list li{display:flex;gap:.7rem;align-items:flex-start;color:var(--sub);font-size:.9rem;line-height:1.5}
.aside__list i{color:var(--accent);margin-top:.2rem;width:18px;text-align:center}
.card{width:100%;max-width:420px;background:var(--card);border:1px solid var(--bdr);border-radius:20px;padding:2.2rem 2rem;box-shadow:0 16px 48px rgba(0,0,0,.25)}
.logo-box{display:flex;justify-content:center;margin:0 auto 1.4rem}
.logo-box img{max-height:70px;width:auto;height:auto !important}
.card-head{text-align:center;margin-bottom:1.6rem}
.card-title{font-family:'Space Grotesk',sans-serif;font-size:1.4rem;font-weight:700;margin-bottom:.45rem}
.card-sub{font-size:.85rem;color:var(--sub);line-height:1.6}
.msg{display:flex;gap:.55rem;align-items:flex-start;border-radius:10px;padding:.7rem .9rem;font-size:.8rem;margin-bottom:1rem;line-height:1.5}
.msg i{margin-top:.15rem}
.msg--ok{background:rgba(16,185,129,.12);border:1px solid rgba(16,185,129,.3);color:#6EE7B7}
.msg--err{background:rgba(239,68,68,.12);border:1px solid rgba(239,68,68,.3);color:#FCA5A5}
.msg--info{background:rgba(43,148,247,.1);border:1px solid rgba(43,148,247,.28);color:var(--accent-soft)}
.fgrp{margin-bottom:1rem}
.flabel{display:block;font-size:.75rem;font-weight:600;color:var(--sub);margin-bottom:.4rem}
.frel{position:relative}
.ficon{position:absolute;left:.95rem;top:50%;transform:translateY(-50%);color:var(--muted);font-size:.8rem}
.finput{width:100%;padding:.85rem 1rem .85rem 2.6rem;background:var(--inp);border:1.5px solid var(--bdr);border-radius:12px;color:var(--text);font-family:inherit;outline:none}
.finput:focus{border-color:var(--accent)}
.finput.err{border-color:#ef4444}
.fbtn{width:100%;padding:.9rem 1.4rem;border:none;border-radius:999px;font-weight:700;font-size:.95rem;font-family:inherit;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:.55rem;background:linear-gradient(135deg,#0870D4,#0657A4);color:#fff;box-shadow:0 6px 24px rgba(6,87,164,.45)}
.fbtn:hover{filter:brightness(1.15)}
.fbtn:disabled{opacity:.6;cursor:not-allowed}
.fbtn--ghost{background:transparent;border:1.5px solid var(--bdr);box-shadow:none;color:var(--sub)}
.fbtn--ghost:hover{color:#fff;border-color:var(--accent-soft)}
.alt-link{text-align:center;margin-top:1.4rem;font-size:.8rem}
.alt-link a{color:var(--accent);font-weight:600}
.foot{text-align:center;font-size:.7rem;color:var(--muted);padding:1rem}
@media (max-width:760px){.aside{display:none}}
</style>
@stack('styles')
</head>
<body>
<div class="shell">
  <div class="topbar">
    <a href="{{ url('/') }}"><i class="fas fa-arrow-left"></i> {{ __('auth.back_site') }}</a>
  </div>

  <main class="wrap">
    @hasSection('aside')
    <aside class="aside">@yield('aside')</aside>
    @endif
    <div class="card">
      <div class="logo-box"><x-logo variant="full" theme="dark" size="md" /></div>
      @yield('content')
    </div>
  </main>

  <div class="foot">&copy; {{ date('Y') }} {{ site_name() }}</div>
</div>
@stack('scripts')
</body>
</html>
