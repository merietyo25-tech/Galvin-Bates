@extends('layouts.client-app')
@section('title', $invoice->reference . ' — ' . site_name())
@section('page_title', __('app.invoice_detail'))
@section('back_btn', true)
@section('back_url', route('client.app.invoices'))

@push('styles')
<style>
/* La facture est une « feuille » blanche, identique en thème clair et sombre (et à l'impression). */
.inv-wrap { padding: .875rem 1rem 0; max-width: 820px; margin: 0 auto }

.inv-actions { display: flex; gap: .6rem; justify-content: flex-end; margin-bottom: .75rem }
.inv-btn {
  display: inline-flex; align-items: center; gap: .45rem;
  padding: .6rem 1rem; border-radius: 10px; border: 0; cursor: pointer;
  font-size: .8rem; font-weight: 700; background: #032A4F; color: #fff;
}
.inv-btn:hover { background: #0657A4 }

.inv-sheet {
  background: #fff; color: #1F2937; border-radius: 14px; overflow: hidden;
  box-shadow: 0 10px 30px rgba(3,42,79,.18), 0 0 0 1px rgba(3,42,79,.06);
  font-size: .82rem; line-height: 1.5;
}

/* En-tête */
.inv-head {
  background: #032A4F; color: #fff; padding: 1.25rem 1.5rem;
  display: flex; justify-content: space-between; align-items: center; gap: 1rem; flex-wrap: wrap;
}
.inv-head__logo { max-width: 190px }
.inv-head__logo img { max-height: 44px; width: auto }
.inv-head__doc { text-align: right }
.inv-head__title { font-size: 1.35rem; font-weight: 800; letter-spacing: .12em; text-transform: uppercase }
.inv-head__ref { font-size: .78rem; opacity: .75; font-family: 'Space Grotesk', monospace; margin-top: .15rem }

/* Statut */
.inv-status { display: inline-flex; align-items: center; gap: .35rem; margin-top: .45rem;
  padding: .2rem .65rem; border-radius: 999px; font-size: .68rem; font-weight: 800; text-transform: uppercase; letter-spacing: .06em }
.inv-status--sent      { background: #FEF3C7; color: #92400E }
.inv-status--paid      { background: #DCFCE7; color: #166534 }
.inv-status--cancelled { background: #E5E7EB; color: #374151 }
.inv-status--overdue   { background: #FEE2E2; color: #991B1B }

.inv-body { padding: 1.5rem }

/* Parties */
.inv-parties { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1.25rem }
.inv-party__lbl { font-size: .66rem; font-weight: 800; text-transform: uppercase; letter-spacing: .08em; color: #6B7280; margin-bottom: .35rem }
.inv-party__name { font-weight: 700; color: #111827; font-size: .9rem }
.inv-party__line { color: #4B5563 }

/* Dates */
.inv-meta { display: grid; grid-template-columns: repeat(3, 1fr); border: 1px solid #E5E7EB; border-radius: 10px; margin-bottom: 1.25rem; overflow: hidden }
.inv-meta__cell { padding: .7rem .9rem; border-right: 1px solid #E5E7EB }
.inv-meta__cell:last-child { border-right: 0 }
.inv-meta__lbl { font-size: .66rem; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: #6B7280 }
.inv-meta__val { font-weight: 700; color: #111827; margin-top: .1rem }
.inv-meta__val--late { color: #B91C1C }

/* Lignes */
.inv-table { width: 100%; border-collapse: collapse; margin-bottom: 1rem }
.inv-table th {
  background: #F3F4F6; color: #374151; font-size: .68rem; font-weight: 800; text-transform: uppercase; letter-spacing: .05em;
  padding: .6rem .75rem; text-align: left; border-bottom: 2px solid #032A4F;
}
.inv-table td { padding: .7rem .75rem; border-bottom: 1px solid #F0F1F3; color: #1F2937; vertical-align: top }
.inv-table .num { text-align: right; white-space: nowrap }
.inv-table .ctr { text-align: center; white-space: nowrap }
.inv-table td.desc { font-weight: 600 }

/* Totaux */
.inv-totals { margin-left: auto; width: 100%; max-width: 320px }
.inv-totals__row { display: flex; justify-content: space-between; padding: .4rem .75rem; color: #4B5563 }
.inv-totals__row span:last-child { font-weight: 600; color: #111827; white-space: nowrap }
.inv-totals__due {
  display: flex; justify-content: space-between; align-items: center; margin-top: .4rem;
  background: #032A4F; color: #fff; border-radius: 10px; padding: .75rem .9rem;
}
.inv-totals__due span:first-child { font-size: .72rem; font-weight: 700; text-transform: uppercase; letter-spacing: .06em }
.inv-totals__due span:last-child { font-size: 1.15rem; font-weight: 800; font-family: 'Space Grotesk', sans-serif; white-space: nowrap }

/* Note + pied */
.inv-note { margin-top: 1.25rem; background: #F8FAFC; border-left: 3px solid #0657A4; border-radius: 8px; padding: .75rem .9rem; color: #374151 }
.inv-note strong { display: block; font-size: .7rem; text-transform: uppercase; letter-spacing: .06em; color: #0657A4; margin-bottom: .2rem }
.inv-foot { border-top: 1px solid #E5E7EB; padding: .9rem 1.5rem; font-size: .72rem; color: #6B7280; text-align: center }

.inv-spacer { height: 1.5rem }

@media (max-width: 560px) {
  .inv-body { padding: 1.1rem }
  .inv-parties { grid-template-columns: 1fr; gap: .9rem }
  .inv-meta { grid-template-columns: 1fr }
  .inv-meta__cell { border-right: 0; border-bottom: 1px solid #E5E7EB }
  .inv-meta__cell:last-child { border-bottom: 0 }
  .inv-table th.hide-sm, .inv-table td.hide-sm { display: none }
  .inv-totals { max-width: none }
}

/* Impression / PDF : seule la facture est imprimée */
@media print {
  @page { margin: 12mm }
  body * { visibility: hidden !important }
  .inv-sheet, .inv-sheet * { visibility: visible !important }
  .inv-sheet { position: absolute; left: 0; top: 0; width: 100%; box-shadow: none; border-radius: 0 }
  .inv-head, .inv-totals__due, .inv-table th { -webkit-print-color-adjust: exact; print-color-adjust: exact }
  .inv-table th.hide-sm, .inv-table td.hide-sm { display: table-cell !important }
}
</style>
@endpush

@section('content')
@php
  $site     = \App\Models\SiteContact::current();
  $currency = $invoice->currency ?? ($user->currency ?? 'EUR');
  $st       = $invoice->status;
  $overdue  = $st === 'sent' && $invoice->due_date && $invoice->due_date->isPast();
  $money    = fn ($v) => number_format((float) $v, 2, ',', ' ') . ' ' . $currency;

  $statusLabels = [
      'sent'      => __('app.invoice_status_sent'),
      'paid'      => __('app.invoice_status_paid'),
      'cancelled' => __('app.invoice_status_cancelled'),
  ];

  // Lignes : tableau « items », sinon la description seule
  $items = collect($invoice->items ?? [])->map(fn ($i) => [
      'label' => $i['description'] ?? $i['name'] ?? '—',
      'qty'   => (float) ($i['quantity'] ?? 1),
      'unit'  => (float) ($i['unit_price'] ?? 0),
      'total' => (float) ($i['total'] ?? (($i['unit_price'] ?? 0) * ($i['quantity'] ?? 1))),
  ]);
  if ($items->isEmpty() && $invoice->description) {
      $items = collect([['label' => $invoice->description, 'qty' => 1, 'unit' => (float) $invoice->subtotal, 'total' => (float) $invoice->subtotal]]);
  }
  $fmtQty = fn ($q) => rtrim(rtrim(number_format($q, 2, ',', ' '), '0'), ',');
@endphp

<div class="inv-wrap">

  <div class="inv-actions">
    <button type="button" class="inv-btn" onclick="window.print()">
      <i class="fas fa-print"></i> {{ __('app.invoice_print') }}
    </button>
  </div>

  <article class="inv-sheet">

    <header class="inv-head">
      <div class="inv-head__logo">
        <x-logo variant="full" theme="dark" size="md"
                :dark="$site->logo_dark_path ? Storage::url($site->logo_dark_path) : null"
                :name="$site->name" />
      </div>
      <div class="inv-head__doc">
        <div class="inv-head__title">{{ __('app.invoice_doc_title') }}</div>
        <div class="inv-head__ref">N° {{ $invoice->reference }}</div>
        <span class="inv-status inv-status--{{ $overdue ? 'overdue' : $st }}">
          {{ $overdue ? __('app.invoice_overdue') : ($statusLabels[$st] ?? $st) }}
        </span>
      </div>
    </header>

    <div class="inv-body">

      <div class="inv-parties">
        <div>
          <div class="inv-party__lbl">{{ __('app.invoice_issuer') }}</div>
          <div class="inv-party__name">{{ $site->name ?: site_name() }}</div>
          @foreach(['address_1', 'address_2', 'address_3'] as $f)
            @if($site->$f)<div class="inv-party__line">{{ $site->$f }}</div>@endif
          @endforeach
          @if($site->email ?: site_email())<div class="inv-party__line">{{ $site->email ?: site_email() }}</div>@endif
          @if($site->phone_1)<div class="inv-party__line">{{ $site->phone_1 }}</div>@endif
        </div>
        <div>
          <div class="inv-party__lbl">{{ __('app.invoice_billed_to') }}</div>
          <div class="inv-party__name">{{ $user->name }}</div>
          @if($user->address)<div class="inv-party__line">{{ $user->address }}</div>@endif
          @if($user->country)<div class="inv-party__line">{{ $user->country }}</div>@endif
          <div class="inv-party__line">{{ $user->email }}</div>
          @if($user->phone)<div class="inv-party__line">{{ $user->phone }}</div>@endif
        </div>
      </div>

      <div class="inv-meta">
        <div class="inv-meta__cell">
          <div class="inv-meta__lbl">{{ __('app.invoice_date') }}</div>
          <div class="inv-meta__val">{{ $invoice->issue_date?->format('d/m/Y') ?? '—' }}</div>
        </div>
        <div class="inv-meta__cell">
          <div class="inv-meta__lbl">{{ __('app.invoice_due') }}</div>
          <div class="inv-meta__val {{ $overdue ? 'inv-meta__val--late' : '' }}">{{ $invoice->due_date?->format('d/m/Y') ?? '—' }}</div>
        </div>
        <div class="inv-meta__cell">
          <div class="inv-meta__lbl">{{ __('app.invoice_status') }}</div>
          <div class="inv-meta__val">
            @if($st === 'paid' && $invoice->paid_at)
              {{ __('app.invoice_paid_on', ['date' => $invoice->paid_at->format('d/m/Y')]) }}
            @else
              {{ $overdue ? __('app.invoice_overdue') : ($statusLabels[$st] ?? $st) }}
            @endif
          </div>
        </div>
      </div>

      @if($items->isNotEmpty())
      <table class="inv-table">
        <thead>
          <tr>
            <th>{{ __('app.invoice_items') }}</th>
            <th class="ctr">{{ __('app.invoice_qty') }}</th>
            <th class="num hide-sm">{{ __('app.invoice_unit_price') }}</th>
            <th class="num">{{ __('app.invoice_amount') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($items as $item)
          <tr>
            <td class="desc">{{ $item['label'] }}</td>
            <td class="ctr">{{ $fmtQty($item['qty']) }}</td>
            <td class="num hide-sm">{{ $money($item['unit']) }}</td>
            <td class="num">{{ $money($item['total']) }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @endif

      <div class="inv-totals">
        <div class="inv-totals__row"><span>{{ __('app.invoice_subtotal') }}</span><span>{{ $money($invoice->subtotal) }}</span></div>
        @if($invoice->tax_rate > 0)
        <div class="inv-totals__row"><span>{{ __('app.invoice_tax') }} ({{ rtrim(rtrim(number_format($invoice->tax_rate, 2, ',', ''), '0'), ',') }} %)</span><span>{{ $money($invoice->tax_amount) }}</span></div>
        @endif
        <div class="inv-totals__due">
          <span>{{ $st === 'sent' ? __('app.invoice_amount_due') : __('app.invoice_total') }}</span>
          <span>{{ $money($invoice->total) }}</span>
        </div>
      </div>

      @if($invoice->note)
      <div class="inv-note">
        <strong>{{ __('app.invoice_note') }}</strong>
        {{ $invoice->note }}
      </div>
      @endif

    </div>

    <footer class="inv-foot">
      {{ __('app.invoice_questions') }} · {{ $site->name ?: site_name() }}
    </footer>

  </article>
</div>

<div class="inv-spacer"></div>
@endsection
