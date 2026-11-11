@extends('layouts.client-app')
@section('title', __('banking.card_title') . ' — ' . site_name())
@section('page_title', __('banking.card_title'))
@section('back_btn', true)
@section('back_url', route('client.app.profile'))

@push('styles')
<style>
.cd-body { padding:1.25rem 1.25rem 2.5rem }

/* Carte visuelle */
.cd-card {
  border-radius:20px; aspect-ratio:1.586; max-width:420px; margin:0 auto 1.25rem;
  background:linear-gradient(145deg,#1B527A 0%,#0D2E54 45%,#071828 100%);
  padding:1.35rem 1.5rem; position:relative; overflow:hidden; color:#fff;
  box-shadow:0 20px 56px rgba(0,0,0,.5),0 0 0 1px rgba(255,255,255,.07);
  display:flex; flex-direction:column; justify-content:space-between;
}
.cd-card--off { filter:grayscale(.85) brightness(.75) }
.cd-card::before { content:''; position:absolute; top:-70px; right:-60px; width:220px; height:220px; border-radius:50%;
  background:radial-gradient(circle,rgba(0,200,150,.14) 0%,transparent 65%); }
.cd-card__top { display:flex; justify-content:space-between; align-items:center; position:relative }
.cd-card__brand { font-size:.62rem; font-weight:800; letter-spacing:.14em; text-transform:uppercase; color:rgba(255,255,255,.55) }
.cd-card__type { font-size:.58rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase;
  padding:.2rem .55rem; border-radius:999px; background:rgba(255,255,255,.12) }
.cd-card__chip { width:38px; height:28px; border-radius:5px; background:linear-gradient(135deg,#B5D4F2,#81B6E9,#2B94F7) }
.cd-card__number { font-family:'Space Grotesk',monospace; font-size:1.15rem; font-weight:700; letter-spacing:.14em; position:relative }
.cd-card__bottom { display:flex; justify-content:space-between; align-items:flex-end; position:relative }
.cd-card__label { font-size:.52rem; text-transform:uppercase; letter-spacing:.1em; color:rgba(255,255,255,.45) }
.cd-card__val { font-size:.8rem; font-weight:700; letter-spacing:.05em; text-transform:uppercase }
.cd-card__network { font-family:'Space Grotesk',sans-serif; font-size:1.35rem; font-weight:800; font-style:italic; letter-spacing:.02em }
.cd-card__state { position:absolute; inset:0; display:flex; align-items:center; justify-content:center;
  font-size:.85rem; font-weight:800; letter-spacing:.12em; text-transform:uppercase; background:rgba(0,0,0,.35) }

/* Blocs */
.cd-section-title { font-size:.72rem; font-weight:700; text-transform:uppercase; letter-spacing:.08em; color:var(--ca-text-3); margin:1.5rem 0 .75rem }
.cd-list { background:var(--ca-bg2); border:1px solid var(--ca-border); border-radius:var(--ca-radius-md); overflow:hidden }
.cd-row { display:flex; justify-content:space-between; align-items:center; gap:1rem; padding:.85rem 1.1rem; border-bottom:1px solid var(--ca-border-2) }
.cd-row:last-child { border-bottom:none }
.cd-key { font-size:.8rem; color:var(--ca-text-3) }
.cd-val { font-size:.82rem; font-weight:700; color:var(--ca-text); text-align:right }
.cd-badge { font-size:.68rem; font-weight:700; padding:.2rem .6rem; border-radius:999px }
.cd-badge--ok   { background:rgba(0,200,150,.15); color:var(--ca-positive) }
.cd-badge--warn { background:rgba(245,166,35,.15); color:var(--ca-amber) }
.cd-badge--err  { background:rgba(239,68,68,.15); color:var(--ca-negative) }

.cd-panel { background:var(--ca-bg2); border:1px solid var(--ca-border); border-radius:var(--ca-radius-md); padding:1.1rem }
.cd-range { width:100%; accent-color:var(--ca-teal-l) }
.cd-range-vals { display:flex; justify-content:space-between; font-size:.72rem; color:var(--ca-text-3); margin-top:.3rem }
.cd-limit-now { font-family:'Space Grotesk',sans-serif; font-size:1.4rem; font-weight:800; color:var(--ca-text); margin-bottom:.6rem }
.cd-actions { display:grid; gap:.75rem; margin-top:1.25rem }

/* États vides / en attente */
.cd-empty { display:flex; flex-direction:column; align-items:center; text-align:center; padding:2.5rem 1rem 1.5rem }
.cd-empty__ico { width:76px; height:76px; border-radius:50%; background:var(--ca-bg3); border:1px solid var(--ca-border);
  display:flex; align-items:center; justify-content:center; font-size:1.7rem; color:var(--ca-teal-l); margin-bottom:1rem }
.cd-empty__title { font-size:1rem; font-weight:800; color:var(--ca-text); margin-bottom:.45rem }
.cd-empty__sub { font-size:.82rem; color:var(--ca-text-3); line-height:1.6; max-width:340px }

/* Formulaire de demande */
.cd-types { display:grid; grid-template-columns:1fr 1fr; gap:.75rem; margin-bottom:1rem }
.cd-type { position:relative; cursor:pointer }
.cd-type input { position:absolute; opacity:0 }
.cd-type__box { border:1.5px solid var(--ca-border); border-radius:var(--ca-radius-md); padding:.9rem; background:var(--ca-bg2);
  height:100%; transition:border-color var(--ca-transition), background var(--ca-transition) }
.cd-type input:checked + .cd-type__box { border-color:var(--ca-teal-l); background:rgba(27,138,122,.1) }
.cd-type input:focus-visible + .cd-type__box { outline:2px solid var(--ca-teal-l); outline-offset:2px }
.cd-type__ico { font-size:1.2rem; color:var(--ca-teal-l); margin-bottom:.45rem }
.cd-type__name { font-size:.85rem; font-weight:800; color:var(--ca-text) }
.cd-type__desc { font-size:.72rem; color:var(--ca-text-3); line-height:1.45; margin-top:.2rem }
.cd-alert { border-radius:var(--ca-radius-md); padding:.85rem 1rem; font-size:.8rem; line-height:1.55; margin-bottom:1rem; display:flex; gap:.6rem }
.cd-alert--err { background:rgba(239,68,68,.1); border:1px solid rgba(239,68,68,.3); color:var(--ca-negative) }
.cd-alert--warn { background:rgba(245,166,35,.1); border:1px solid rgba(245,166,35,.3); color:var(--ca-amber) }
.cd-err { font-size:.72rem; color:var(--ca-negative); margin-top:.3rem }
</style>
@endpush

@section('content')
@php
  $currency = $user->currency ?: 'EUR';
  $typeLabel = fn ($t) => $t === 'physical' ? __('banking.card_type_physical') : __('banking.card_type_virtual');
@endphp
<div class="cd-body">

{{-- ── 1. Identité pas encore vérifiée ─────────────────────────────── --}}
@if(! $kycOk && ! $card)
  <div class="cd-empty">
    <div class="cd-empty__ico"><i class="fas fa-id-card"></i></div>
    <div class="cd-empty__title">{{ __('banking.card_kyc_title') }}</div>
    <div class="cd-empty__sub">{{ __('banking.card_kyc_sub') }}</div>
  </div>
  <a href="{{ route('client.app.kyc.show') }}" class="ca-btn ca-btn--accent" style="width:100%;justify-content:center">
    <i class="fas fa-id-card"></i> {{ __('kyc.title') }}
  </a>

{{-- ── 2. Carte émise ───────────────────────────────────────────────── --}}
@elseif($card)
  @php
    $blocked = $card->status === \App\Models\Card::STATUS_BLOCKED;
    $frozen  = $card->status === \App\Models\Card::STATUS_SUSPENDED;
    $maxLimit = max(min(\App\Models\Card::LIMIT_MAX, $card->cap()), \App\Models\Card::LIMIT_MIN);
  @endphp

  <div class="cd-card {{ $blocked || $frozen ? 'cd-card--off' : '' }}">
    <div class="cd-card__top">
      <span class="cd-card__brand">{{ site_name() }}</span>
      <span class="cd-card__type">{{ $typeLabel($card->card_type) }}</span>
    </div>
    <div class="cd-card__chip" aria-hidden="true"></div>
    <div class="cd-card__number">{{ $card->maskedNumber() }}</div>
    <div class="cd-card__bottom">
      <div>
        <div class="cd-card__label">{{ __('banking.card_holder') }}</div>
        <div class="cd-card__val">{{ $card->holder_name }}</div>
      </div>
      <div>
        <div class="cd-card__label">{{ __('banking.card_expires') }}</div>
        <div class="cd-card__val">{{ $card->expires_at?->format('m/y') }}</div>
      </div>
      <div class="cd-card__network">{{ strtoupper($card->network) }}</div>
    </div>
    @if($blocked || $frozen)
    <div class="cd-card__state"><i class="fas fa-{{ $blocked ? 'ban' : 'snowflake' }}" style="margin-right:.45rem"></i>
      {{ $blocked ? __('banking.card_status_blocked') : __('banking.card_status_frozen') }}</div>
    @endif
  </div>

  @if($blocked)
  <div class="cd-alert cd-alert--err"><i class="fas fa-ban" style="margin-top:.15rem"></i><span>{{ __('banking.card_blocked_notice') }}</span></div>
  @endif

  <div class="cd-section-title">{{ __('banking.card_details') }}</div>
  <div class="cd-list">
    <div class="cd-row"><span class="cd-key">{{ __('banking.card_status') }}</span>
      <span class="cd-badge {{ $blocked ? 'cd-badge--err' : ($frozen ? 'cd-badge--warn' : 'cd-badge--ok') }}">
        {{ $blocked ? __('banking.card_status_blocked') : ($frozen ? __('banking.card_status_frozen') : __('banking.card_status_active')) }}
      </span></div>
    <div class="cd-row"><span class="cd-key">{{ __('banking.card_type') }}</span><span class="cd-val">{{ $typeLabel($card->card_type) }}</span></div>
    <div class="cd-row"><span class="cd-key">{{ __('banking.card_network') }}</span><span class="cd-val">{{ ucfirst($card->network) }}</span></div>
    <div class="cd-row"><span class="cd-key">{{ __('banking.card_number') }}</span><span class="cd-val">{{ $card->maskedNumber() }}</span></div>
    <div class="cd-row"><span class="cd-key">{{ __('banking.card_expires') }}</span><span class="cd-val">{{ $card->expires_at?->format('m/Y') }}</span></div>
    <div class="cd-row"><span class="cd-key">{{ __('banking.card_cap') }}</span><span class="cd-val">{{ number_format($card->cap(), 0, ',', ' ') }} {{ $currency }}</span></div>
  </div>

  @unless($blocked)
  <div class="cd-section-title">{{ __('banking.card_limit') }}</div>
  <form method="POST" action="{{ route('client.app.card.limit') }}" class="cd-panel"
        x-data="{ v: {{ min($card->effectiveLimit(), $maxLimit) }} }">
    @csrf
    <div class="cd-limit-now"><span x-text="Number(v).toLocaleString('fr-FR')"></span> {{ $currency }} <small style="font-size:.7rem;color:var(--ca-text-3);font-weight:600">/ {{ __('banking.card_per_month') }}</small></div>
    <input type="range" name="spending_limit" class="cd-range" min="{{ \App\Models\Card::LIMIT_MIN }}" max="{{ $maxLimit }}"
           step="{{ \App\Models\Card::LIMIT_STEP }}" x-model="v" aria-label="{{ __('banking.card_limit') }}">
    <div class="cd-range-vals"><span>{{ number_format(\App\Models\Card::LIMIT_MIN, 0, ',', ' ') }}</span><span>{{ number_format($maxLimit, 0, ',', ' ') }}</span></div>
    @error('spending_limit')<div class="cd-err">{{ $message }}</div>@enderror
    <button type="submit" class="ca-btn ca-btn--accent" style="width:100%;justify-content:center;margin-top:.9rem">
      <i class="fas fa-check"></i> {{ __('banking.card_limit_save') }}
    </button>
  </form>

  <div class="cd-actions">
    <form method="POST" action="{{ route('client.app.card.freeze') }}">
      @csrf
      <button type="submit" class="ca-btn ca-btn--ghost" style="width:100%;justify-content:center">
        <i class="fas fa-{{ $frozen ? 'unlock' : 'snowflake' }}"></i>
        {{ $frozen ? __('banking.card_unfreeze') : __('banking.card_freeze') }}
      </button>
    </form>
  </div>
  @endunless

{{-- ── 3. Demande en cours d'examen ─────────────────────────────────── --}}
@elseif($request && $request->isPending())
  <div class="cd-empty">
    <div class="cd-empty__ico" style="color:var(--ca-amber)"><i class="fas fa-hourglass-half"></i></div>
    <div class="cd-empty__title">{{ __('banking.card_pending_title') }}</div>
    <div class="cd-empty__sub">{{ __('banking.card_pending_sub') }}</div>
  </div>
  <div class="cd-list">
    <div class="cd-row"><span class="cd-key">{{ __('banking.card_type') }}</span><span class="cd-val">{{ $typeLabel($request->card_type) }}</span></div>
    <div class="cd-row"><span class="cd-key">{{ __('banking.card_holder') }}</span><span class="cd-val">{{ $request->holder_name }}</span></div>
    @if($request->delivery_address)
    <div class="cd-row"><span class="cd-key">{{ __('banking.card_delivery_address') }}</span><span class="cd-val">{{ $request->delivery_address }}</span></div>
    @endif
    <div class="cd-row"><span class="cd-key">{{ __('banking.card_requested_on') }}</span><span class="cd-val">{{ $request->created_at->format('d/m/Y H:i') }}</span></div>
    <div class="cd-row"><span class="cd-key">{{ __('banking.card_status') }}</span><span class="cd-badge cd-badge--warn">{{ __('banking.card_status_pending') }}</span></div>
  </div>

{{-- ── 4. Formulaire de demande ─────────────────────────────────────── --}}
@else
  <div class="cd-empty" style="padding-top:1.25rem">
    <div class="cd-empty__ico"><i class="fas fa-credit-card"></i></div>
    <div class="cd-empty__title">{{ __('banking.card_request_title') }}</div>
    <div class="cd-empty__sub">{{ __('banking.card_request_sub') }}</div>
  </div>

  @if($request && $request->status === \App\Models\CardRequest::STATUS_REJECTED)
  <div class="cd-alert cd-alert--warn"><i class="fas fa-circle-exclamation" style="margin-top:.15rem"></i>
    <span><strong>{{ __('banking.card_rejected_title') }}</strong><br>{{ $request->rejection_reason }}</span></div>
  @endif

  <form method="POST" action="{{ route('client.app.card.request') }}" x-data="{ type: '{{ old('card_type', 'virtual') === 'physical' ? 'physical' : 'virtual' }}' }"
        onsubmit="this.querySelector('button[type=submit]').disabled = true">
    @csrf
    <div class="cd-types" role="radiogroup" aria-label="{{ __('banking.card_type') }}">
      <label class="cd-type">
        <input type="radio" name="card_type" value="virtual" x-model="type">
        <div class="cd-type__box">
          <div class="cd-type__ico"><i class="fas fa-mobile-screen"></i></div>
          <div class="cd-type__name">{{ __('banking.card_type_virtual') }}</div>
          <div class="cd-type__desc">{{ __('banking.card_type_virtual_desc') }}</div>
        </div>
      </label>
      <label class="cd-type">
        <input type="radio" name="card_type" value="physical" x-model="type">
        <div class="cd-type__box">
          <div class="cd-type__ico"><i class="fas fa-credit-card"></i></div>
          <div class="cd-type__name">{{ __('banking.card_type_physical') }}</div>
          <div class="cd-type__desc">{{ __('banking.card_type_physical_desc') }}</div>
        </div>
      </label>
    </div>

    <div class="ca-form-group">
      <label class="ca-form-label" for="holder_name">{{ __('banking.card_holder') }}</label>
      <input type="text" id="holder_name" name="holder_name" class="ca-form-input" maxlength="26" required
             value="{{ old('holder_name', mb_substr(strtoupper(\Illuminate\Support\Str::ascii($user->name)), 0, 26)) }}"
             style="text-transform:uppercase">
      @error('holder_name')<div class="cd-err">{{ $message }}</div>@enderror
    </div>

    <div class="ca-form-group" x-show="type === 'physical'" x-cloak>
      <label class="ca-form-label" for="delivery_address">{{ __('banking.card_delivery_address') }}</label>
      <textarea id="delivery_address" name="delivery_address" rows="3" class="ca-form-input" maxlength="500"
                :required="type === 'physical'">{{ old('delivery_address', $user->address) }}</textarea>
      @error('delivery_address')<div class="cd-err">{{ $message }}</div>@enderror
    </div>

    <button type="submit" class="ca-btn ca-btn--accent" style="width:100%;justify-content:center">
      <i class="fas fa-paper-plane"></i> {{ __('banking.card_request_btn') }}
    </button>
  </form>
@endif

</div>
@endsection
