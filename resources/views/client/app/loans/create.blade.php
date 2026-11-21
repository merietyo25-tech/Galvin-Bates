@extends('layouts.client-app')
@section('title', __('app.loanreq_title') . ' — ' . site_name())
@section('page_title', __('app.loanreq_title'))
@section('back_btn', true)
@section('back_url', route('client.app.loans'))

@push('styles')
<style>
.lr-wrap { padding: .875rem 1.25rem 1.5rem; max-width: 640px; margin: 0 auto }
.lr-intro { font-size: .8rem; color: var(--ca-text-3); line-height: 1.55; margin-bottom: 1rem }

/* Carte simulation */
.lr-sim {
  background: linear-gradient(145deg,#1B527A 0%,#0D2E54 55%,#071828 100%);
  border-radius: 20px; padding: 1.25rem 1.375rem; color: #fff; margin-bottom: 1.25rem;
  box-shadow: 0 14px 40px rgba(3,42,79,.35);
}
.lr-sim__lbl { font-size: .65rem; font-weight: 700; text-transform: uppercase; letter-spacing: .1em; color: rgba(255,255,255,.55) }
.lr-sim__val { font-family: 'Space Grotesk', sans-serif; font-size: 2.1rem; font-weight: 900; line-height: 1.1; margin: .25rem 0 .9rem }
.lr-sim__val small { font-size: .9rem; font-weight: 600; color: rgba(255,255,255,.7) }
.lr-sim__grid { display: grid; grid-template-columns: repeat(3,1fr); gap: .5rem; border-top: 1px solid rgba(255,255,255,.12); padding-top: .8rem }
.lr-sim__k { font-size: .6rem; text-transform: uppercase; letter-spacing: .06em; color: rgba(255,255,255,.5) }
.lr-sim__v { font-size: .85rem; font-weight: 700; margin-top: .1rem; white-space: nowrap }

/* Champs */
.lr-card { background: var(--ca-bg2); border: 1px solid var(--ca-border); border-radius: 16px; padding: 1rem; margin-bottom: 1rem }
.lr-card__title { font-size: .68rem; font-weight: 800; text-transform: uppercase; letter-spacing: .08em; color: var(--ca-text-3); margin-bottom: .75rem }
.lr-field { margin-bottom: .9rem }
.lr-field:last-child { margin-bottom: 0 }
.lr-label { display: block; font-size: .78rem; font-weight: 700; color: var(--ca-text-2); margin-bottom: .35rem }
.lr-input { font-family: inherit;
  width: 100%; padding: .7rem .85rem; border-radius: 12px; font-size: .9rem;
  background: var(--ca-bg); color: var(--ca-text); border: 1.5px solid var(--ca-border); outline: none;
}
.lr-input:focus { border-color: var(--ca-accent-l) }
.lr-input.is-err { border-color: #ef4444 }
.lr-err { font-size: .72rem; color: #ef4444; margin-top: .3rem }
.lr-amount { position: relative }
.lr-amount .lr-input { font-size: 1.25rem; font-weight: 800; padding-right: 4.5rem }
.lr-amount span { position: absolute; right: .9rem; top: 50%; transform: translateY(-50%); font-weight: 700; color: var(--ca-text-3) }
.lr-range { width: 100%; margin-top: .6rem; accent-color: var(--ca-accent-l) }
.lr-hint { display: flex; justify-content: space-between; font-size: .68rem; color: var(--ca-text-3); margin-top: .15rem }

.lr-chips { display: flex; flex-wrap: wrap; gap: .4rem }
.lr-chip {
  padding: .45rem .8rem; border-radius: 999px; font-size: .75rem; font-weight: 700; cursor: pointer;
  border: 1.5px solid var(--ca-border); background: var(--ca-bg); color: var(--ca-text-2);
}
.lr-chip.on { border-color: var(--ca-accent-l); background: rgba(129,182,233,.14); color: var(--ca-accent-l) }

.lr-types { display: grid; grid-template-columns: 1fr 1fr; gap: .5rem }
.lr-type {
  display: flex; align-items: center; gap: .55rem; padding: .7rem .75rem; border-radius: 12px; cursor: pointer;
  border: 1.5px solid var(--ca-border); background: var(--ca-bg); color: var(--ca-text-2); font-size: .78rem; font-weight: 600;
}
.lr-type i { width: 18px; text-align: center; color: var(--ca-text-3) }
.lr-type.on { border-color: var(--ca-accent-l); color: var(--ca-text) }
.lr-type.on i { color: var(--ca-accent-l) }
.lr-type input { display: none }

.lr-accept { display: flex; gap: .6rem; align-items: flex-start; font-size: .76rem; color: var(--ca-text-2); line-height: 1.5; cursor: pointer }
.lr-accept input { margin-top: .2rem; width: 18px; height: 18px; accent-color: var(--ca-accent-l); flex-shrink: 0 }
.lr-note { font-size: .7rem; color: var(--ca-text-3); line-height: 1.5; margin-top: .6rem }

@media (max-width: 420px) { .lr-types { grid-template-columns: 1fr } .lr-sim__val { font-size: 1.8rem } }
</style>
@endpush

@section('content')
@php
  $typeIcons = ['personnel' => 'fa-user', 'professionnel' => 'fa-briefcase', 'immobilier' => 'fa-house', 'rachat_credit' => 'fa-arrows-rotate',
                'investissement' => 'fa-chart-line', 'credit_relais' => 'fa-bridge', 'autre' => 'fa-ellipsis'];
  $startAmount = old('amount', min(max(10000, $min), $max));
  $startMonths = (int) old('darly', 60);
  $locale      = str_replace('_', '-', app()->getLocale());
@endphp

<div class="lr-wrap"
     x-data="loanSim({ amount: {{ (float) $startAmount }}, months: {{ $startMonths }}, rate: {{ $rate }}, min: {{ $min }}, max: {{ $max }}, cur: @js($currency), locale: @js($locale) })">

  <p class="lr-intro">{{ __('app.loanreq_intro') }}</p>

  @if($errors->any())
  <div class="ca-flash ca-flash--err" style="margin:0 0 1rem">
    <i class="fas fa-exclamation-triangle"></i> {{ $errors->first() }}
  </div>
  @endif

  {{-- Simulation en direct --}}
  <div class="lr-sim" aria-live="polite">
    <div class="lr-sim__lbl">{{ __('app.loanreq_monthly') }}</div>
    <div class="lr-sim__val"><span x-text="fmt(monthly())"></span> <small>{{ __('app.per_month') }}</small></div>
    <div class="lr-sim__grid">
      <div><div class="lr-sim__k">{{ __('app.loanreq_rate') }}</div><div class="lr-sim__v">{{ number_format($rate, 2, ',', ' ') }} %</div></div>
      <div><div class="lr-sim__k">{{ __('app.loanreq_total_cost') }}</div><div class="lr-sim__v" x-text="fmt(monthly() * months - amount)"></div></div>
      <div><div class="lr-sim__k">{{ __('app.loanreq_total_repaid') }}</div><div class="lr-sim__v" x-text="fmt(monthly() * months)"></div></div>
    </div>
  </div>

  <form method="POST" action="{{ route('client.app.loans.store') }}" @submit="sending = true">
    @csrf

    {{-- Montant + durée --}}
    <div class="lr-card">
      <div class="lr-card__title">{{ __('app.loanreq_section_amount') }}</div>

      <div class="lr-field">
        <label class="lr-label" for="lr-amount">{{ __('app.loanreq_amount') }}</label>
        <div class="lr-amount">
          <input id="lr-amount" type="number" name="amount" class="lr-input @error('amount') is-err @enderror"
                 x-model.number="amount" min="{{ $min }}" max="{{ $max }}" step="100" inputmode="decimal" required>
          <span>{{ $currency }}</span>
        </div>
        <input type="range" class="lr-range" x-model.number="amount" min="{{ $min }}" max="{{ $max }}" step="{{ $max > 100000 ? 1000 : 100 }}" aria-label="{{ __('app.loanreq_amount') }}">
        <div class="lr-hint"><span>{{ number_format($min, 0, ',', ' ') }} {{ $currency }}</span><span>{{ number_format($max, 0, ',', ' ') }} {{ $currency }}</span></div>
        @error('amount')<div class="lr-err">{{ $message }}</div>@enderror
      </div>

      <div class="lr-field">
        <span class="lr-label">{{ __('app.loanreq_duration') }}</span>
        <input type="hidden" name="darly" :value="months">
        <div class="lr-chips" role="radiogroup" aria-label="{{ __('app.loanreq_duration') }}">
          @foreach($durations as $d)
          <button type="button" class="lr-chip" :class="months === {{ $d }} ? 'on' : ''" @click="months = {{ $d }}"
                  role="radio" :aria-checked="months === {{ $d }}">{{ $d }} {{ __('app.months') }}</button>
          @endforeach
        </div>
        @error('darly')<div class="lr-err">{{ $message }}</div>@enderror
      </div>
    </div>

    {{-- Projet --}}
    <div class="lr-card">
      <div class="lr-card__title">{{ __('app.loanreq_section_project') }}</div>

      <div class="lr-field">
        <span class="lr-label">{{ __('app.loanreq_type') }}</span>
        <div class="lr-types" x-data="{ t: @js(old('type_financement', 'personnel')) }">
          @foreach($types as $type)
          <label class="lr-type" :class="t === '{{ $type }}' ? 'on' : ''">
            <input type="radio" name="type_financement" value="{{ $type }}" x-model="t">
            <i class="fas {{ $typeIcons[$type] ?? 'fa-circle' }}"></i> {{ __('app.loanreq_type_' . $type) }}
          </label>
          @endforeach
        </div>
        @error('type_financement')<div class="lr-err">{{ $message }}</div>@enderror
      </div>

      <div class="lr-field">
        <label class="lr-label" for="lr-objet">{{ __('app.loanreq_purpose') }}</label>
        <input id="lr-objet" type="text" name="objet" maxlength="255" required value="{{ old('objet') }}"
               class="lr-input @error('objet') is-err @enderror" placeholder="{{ __('app.loanreq_purpose_ph') }}">
        @error('objet')<div class="lr-err">{{ $message }}</div>@enderror
      </div>

      <div class="lr-field">
        <label class="lr-label" for="lr-details">{{ __('app.loanreq_details') }}</label>
        <textarea id="lr-details" name="subject" rows="3" maxlength="2000" class="lr-input"
                  placeholder="{{ __('app.loanreq_details_ph') }}">{{ old('subject') }}</textarea>
      </div>

      {{-- Coordonnées demandées seulement si le profil ne les contient pas encore --}}
      @unless($user->phone)
      <div class="lr-field">
        <label class="lr-label" for="lr-phone">{{ __('app.loanreq_phone') }}</label>
        <input id="lr-phone" type="tel" name="phone" maxlength="50" required value="{{ old('phone') }}"
               class="lr-input @error('phone') is-err @enderror" autocomplete="tel">
        @error('phone')<div class="lr-err">{{ $message }}</div>@enderror
      </div>
      @endunless

      @unless($user->address)
      <div class="lr-field">
        <label class="lr-label" for="lr-address">{{ __('app.loanreq_address') }}</label>
        <input id="lr-address" type="text" name="address" maxlength="255" required value="{{ old('address') }}"
               class="lr-input @error('address') is-err @enderror" autocomplete="street-address">
        @error('address')<div class="lr-err">{{ $message }}</div>@enderror
      </div>
      @endunless
    </div>

    <div class="lr-card">
      <label class="lr-accept">
        <input type="checkbox" name="accept" value="1" required @checked(old('accept'))>
        <span>{{ __('app.loanreq_accept') }}</span>
      </label>
      @error('accept')<div class="lr-err">{{ $message }}</div>@enderror
      <p class="lr-note"><i class="fas fa-circle-info"></i> {{ __('app.loanreq_estimate_note') }}</p>
    </div>

    <button type="submit" class="ca-btn ca-btn--accent" style="width:100%" :disabled="sending">
      <i class="fas" :class="sending ? 'fa-spinner fa-spin' : 'fa-paper-plane'"></i> {{ __('app.loanreq_submit') }}
    </button>
  </form>
</div>
@endsection

@push('scripts')
<script>
function loanSim(o) {
  return {
    amount: o.amount, months: o.months, rate: o.rate, sending: false,
    // Même formule que LoanService::calculateMonthlyPayment
    monthly() {
      const a = Math.min(Math.max(Number(this.amount) || 0, 0), o.max);
      const n = this.months;
      if (!a || !n) return 0;
      if (!this.rate) return a / n;
      const r = this.rate / 100 / 12;
      return a * r * Math.pow(1 + r, n) / (Math.pow(1 + r, n) - 1);
    },
    fmt(v) {
      try { return new Intl.NumberFormat(o.locale, { style: 'currency', currency: o.cur }).format(Math.max(v, 0)); }
      catch (e) { return (Math.max(v, 0)).toFixed(2) + ' ' + o.cur; }
    },
  };
}
</script>
@endpush
