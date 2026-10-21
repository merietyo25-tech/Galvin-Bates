@extends('layouts.dashboard')
@section('title', __('app.files_title') . ' — ' . site_name())
@section('page_title', __('app.loans_title'))

@section('content')
<div class="cl-scope">

{{-- ── Page header ──────────────────────────────────────────── --}}
<div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
  <div>
    <div style="font-size:1.125rem;font-weight:800;color:var(--cl-text);margin-bottom:.2rem">
      {{ __('app.files_title') }}
    </div>
    <div style="font-size:.8rem;color:var(--cl-muted)">
      {{ __('app.files_subtitle') }}
    </div>
  </div>
  <div class="d-flex gap-2">
    <a href="{{ route('client.dashboard') }}" class="cl-btn cl-btn--ghost">
      <i class="fas fa-th-large"></i> {{ __('app.back_to_dashboard') }}
    </a>
  </div>
</div>

{{-- ── Stats bar ────────────────────────────────────────────── --}}
<div class="cl-stats mb-4">
  <div class="cl-stat" style="--stat-color:var(--cl-accent);--stat-color-bg:rgba(184,136,62,.12)">
    <div class="cl-stat__icon"><i class="fas fa-layer-group"></i></div>
    <div class="cl-stat__val">{{ $stats['total'] }}</div>
    <div class="cl-stat__lbl">{{ __('app.stat_total') }}</div>
  </div>
  <div class="cl-stat" style="--stat-color:var(--cl-amber);--stat-color-bg:rgba(245,158,11,.12)">
    <div class="cl-stat__icon"><i class="fas fa-hourglass-half"></i></div>
    <div class="cl-stat__val">{{ $stats['pending'] }}</div>
    <div class="cl-stat__lbl">{{ __('app.stat_pending') }}</div>
  </div>
  <div class="cl-stat" style="--stat-color:var(--cl-blue);--stat-color-bg:rgba(59,130,246,.12)">
    <div class="cl-stat__icon"><i class="fas fa-file-contract"></i></div>
    <div class="cl-stat__val">{{ $stats['contract_sent'] }}</div>
    <div class="cl-stat__lbl">{{ __('app.status_sent') }}</div>
  </div>
  <div class="cl-stat" style="--stat-color:var(--cl-green);--stat-color-bg:rgba(16,185,129,.12)">
    <div class="cl-stat__icon"><i class="fas fa-check-circle"></i></div>
    <div class="cl-stat__val">{{ $stats['finalized'] }}</div>
    <div class="cl-stat__lbl">{{ __('app.stat_finalized') }}</div>
  </div>
</div>

{{-- ── Loans grid ───────────────────────────────────────────── --}}
@if($loans->isEmpty())
<div class="cl-empty">
  <div class="cl-empty__icon"><i class="fas fa-file-invoice-dollar"></i></div>
  <div class="cl-empty__title">{{ __('app.no_loans_title') }}</div>
  <div class="cl-empty__body">
    {{ __('app.no_loans_body') }}
  </div>
  <a href="{{ route('home',['locale'=>app()->getLocale()]) }}" class="cl-btn cl-btn--accent">
    <i class="fas fa-globe me-1"></i> {{ __('app.back_to_site') }}
  </a>
</div>
@else

<div class="cl-section-title">
  <i class="fas fa-file-invoice-dollar me-1" style="color:var(--cl-accent)"></i>
  {{ trans_choice('app.files_total_count', $loans->total(), ['count' => $loans->total()]) }}
</div>

<div class="row g-3">
  @foreach($loans as $loan)
  @php
    $steps = ['draft','pending','validated','contract_sent','contract_signed','finalized'];
    $idx   = array_search($loan->status, $steps);
    $pct   = $idx !== false ? round(($idx + 1) / count($steps) * 100) : 0;
    $badgeClass = match($loan->status) {
        'draft'           => 'cl-badge--draft',
        'pending'         => 'cl-badge--pending',
        'validated'       => 'cl-badge--validated',
        'contract_sent'   => 'cl-badge--sent',
        'contract_signed' => 'cl-badge--signed',
        'finalized'       => 'cl-badge--finalized',
        'rejected'        => 'cl-badge--rejected',
        default           => 'cl-badge--draft',
    };
    $accentColor = match($loan->status) {
        'rejected'        => 'var(--cl-red)',
        'finalized'       => 'var(--cl-accent)',
        'contract_signed' => 'var(--cl-green)',
        'contract_sent'   => 'var(--cl-blue)',
        default           => 'var(--cl-amber)',
    };
  @endphp
  <div class="col-md-6 col-xl-4">
    <div class="cl-loan-card" style="--card-accent:{{ $accentColor }}">
      <div class="cl-loan-card__top"></div>

      <div class="cl-loan-card__head">
        <span class="cl-loan-card__ref">{{ $loan->reference }}</span>
        <span class="cl-badge {{ $badgeClass }}">{{ $loan->statusLabel() }}</span>
      </div>

      <div class="cl-loan-card__body">
        <div class="cl-loan-card__amount-label">{{ __('app.loan_amount') }}</div>
        <div class="cl-loan-card__amount">
          {{ number_format($loan->amount, 0, ',', ' ') }}
          <span>{{ $loan->currency }}</span>
        </div>

        <div class="cl-loan-card__grid">
          <div>
            <div class="cl-loan-card__metric-label">{{ __('app.monthly') }}</div>
            <div class="cl-loan-card__metric-val accent">
              {{ number_format($loan->monthly_payment, 2, ',', ' ') }} {{ $loan->currency }}
            </div>
          </div>
          <div>
            <div class="cl-loan-card__metric-label">{{ __('app.duration') }}</div>
            <div class="cl-loan-card__metric-val">{{ $loan->darly }} {{ __('app.months') }}</div>
          </div>
          <div>
            <div class="cl-loan-card__metric-label">{{ __('app.interest_rate') }}</div>
            <div class="cl-loan-card__metric-val">{{ $loan->interest_rate }} %</div>
          </div>
          <div>
            <div class="cl-loan-card__metric-label">{{ __('app.date_opened') }}</div>
            <div class="cl-loan-card__metric-val">{{ $loan->created_at->format('d/m/Y') }}</div>
          </div>
        </div>

        @if($loan->objet)
        <div style="font-size:.72rem;color:var(--cl-muted);margin-bottom:.875rem">
          <i class="fas fa-tag me-1" style="color:var(--cl-accent-d)"></i>
          {{ Str::limit($loan->objet, 55) }}
        </div>
        @endif

        @if($loan->status !== 'rejected')
        <div class="cl-progress">
          <div class="cl-progress__header">
            <span class="cl-progress__label">{{ __('app.file_progress') }}</span>
            <span class="cl-progress__pct">{{ $pct }}%</span>
          </div>
          <div class="cl-progress__bar">
            <div class="cl-progress__fill" style="width:{{ $pct }}%"></div>
          </div>
        </div>
        @else
        <div class="cl-alert cl-alert--error" style="margin:0">
          <i class="cl-alert__icon fas fa-ban"></i>
          <div>{{ __('app.status_rejected') }}</div>
        </div>
        @endif
      </div>

      <div class="cl-loan-card__foot">
        <a href="{{ route('client.loans.show', $loan) }}" class="cl-btn cl-btn--primary" style="width:100%">
          <i class="fas fa-eye"></i> {{ __('app.view_file') }}
        </a>
      </div>
    </div>
  </div>
  @endforeach
</div>

{{-- Pagination --}}
@if($loans->hasPages())
<div class="d-flex justify-content-center mt-4">
  {{ $loans->links() }}
</div>
@endif

@endif
</div>
@endsection
