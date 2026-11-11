@extends('layouts.dashboard')
@section('title', 'Demandes de carte — ' . site_name())
@section('page_title', 'Demandes de carte')

@section('content')

<div class="page-hdr-row">
  <div class="page-hdr">
    <h1>Demandes de carte bancaire</h1>
    <p>Cartes demandées par les clients depuis leur espace. Valider émet la carte (Visa) ; refuser prévient le client avec le motif.</p>
  </div>
</div>

<div class="card-pro" style="margin-bottom:1.25rem">
  <div class="card-pro-body" style="padding:.75rem 1.25rem">
    <form method="GET" style="display:flex;gap:.625rem;flex-wrap:wrap;align-items:center">
      <select name="status" class="form-control-pro" style="width:auto;min-width:200px" onchange="this.form.submit()">
        <option value="pending"  @selected($status === 'pending')>En attente ({{ $pendingCount }})</option>
        <option value="approved" @selected($status === 'approved')>Validées</option>
        <option value="rejected" @selected($status === 'rejected')>Refusées</option>
        <option value="all"      @selected($status === 'all')>Toutes</option>
      </select>
    </form>
  </div>
</div>

@if($requests->isEmpty())
<div class="card-pro" style="text-align:center;padding:5rem 2rem">
  <i class="fas fa-credit-card" style="font-size:2.5rem;color:var(--c-muted);opacity:.2;display:block;margin-bottom:1rem"></i>
  <p style="font-size:.9375rem;font-weight:600;color:var(--c-muted)">Aucune demande de carte à afficher.</p>
</div>
@else

<div style="display:flex;flex-direction:column;gap:1rem">
@foreach($requests as $cr)
@php
  $map = [
    'pending'  => ['cls'=>'bs-amber', 'icon'=>'hourglass-half', 'bar'=>'var(--c-amber)', 'lbl'=>'En attente'],
    'approved' => ['cls'=>'bs-green', 'icon'=>'check',          'bar'=>'var(--c-green)', 'lbl'=>'Validée'],
    'rejected' => ['cls'=>'bs-red',   'icon'=>'times',          'bar'=>'var(--c-red)',   'lbl'=>'Refusée'],
  ];
  $sm = $map[$cr->status] ?? $map['pending'];
@endphp
<div class="card-pro" style="border-left:4px solid {{ $sm['bar'] }}">
  <div style="display:grid;grid-template-columns:minmax(0,1.3fr) minmax(0,1fr) auto;gap:1.25rem;align-items:start;padding:1rem 1.25rem">
    <div>
      @if($cr->user)
      <a href="{{ route('admin.users.show', $cr->user) }}" class="cell-name" style="text-decoration:none">{{ $cr->user->name }}</a>
      <div class="cell-sub">{{ $cr->user->email }}</div>
      @else
      <div class="cell-name">Client supprimé</div>
      @endif
      <div class="cell-sub" style="margin-top:.35rem">Demandée le {{ $cr->created_at->format('d/m/Y · H:i') }}</div>
    </div>
    <div>
      <div style="font-size:.85rem;font-weight:700;color:var(--c-navy)">
        <i class="fas fa-{{ $cr->card_type === 'physical' ? 'credit-card' : 'mobile-screen' }}" style="margin-right:.35rem"></i>
        Carte {{ $cr->card_type === 'physical' ? 'physique' : 'virtuelle' }}
      </div>
      <div class="cell-sub">Titulaire : {{ $cr->holder_name }}</div>
      @if($cr->delivery_address)
      <div class="cell-sub">Livraison : {{ $cr->delivery_address }}</div>
      @endif
      @if($cr->status === 'rejected' && $cr->rejection_reason)
      <div class="cell-sub" style="color:var(--c-red)">Motif : {{ $cr->rejection_reason }}</div>
      @endif
      @if($cr->reviewer)
      <div class="cell-sub">Traitée par {{ $cr->reviewer->name }} le {{ $cr->reviewed_at?->format('d/m/Y') }}</div>
      @endif
    </div>
    <div style="text-align:right">
      <span class="badge-status {{ $sm['cls'] }}"><i class="fas fa-{{ $sm['icon'] }}" style="font-size:.6rem"></i> {{ $sm['lbl'] }}</span>
    </div>
  </div>

  @if($cr->isPending() && $cr->user)
  <div style="display:flex;gap:.6rem;flex-wrap:wrap;padding:0 1.25rem 1rem;align-items:flex-start" x-data="{ refuse: false }">
    <form method="POST" action="{{ route('admin.card-requests.approve', $cr) }}"
          data-confirm="Émettre une carte {{ $cr->card_type === 'physical' ? 'physique' : 'virtuelle' }} pour {{ $cr->user->name }} ?" data-confirm-title="Valider la demande" data-confirm-ok="Émettre la carte">
      @csrf
      <button type="submit" class="btn-navy btn-sm-pro"><i class="fas fa-check"></i> Valider et émettre la carte</button>
    </form>
    <button type="button" class="btn-navy btn-sm-pro" style="background:var(--c-bg);color:var(--c-red);border:1px solid var(--c-border)" @click="refuse = !refuse">
      <i class="fas fa-times"></i> Refuser
    </button>
    <form method="POST" action="{{ route('admin.card-requests.reject', $cr) }}" x-show="refuse" x-cloak style="display:flex;gap:.5rem;flex:1 1 320px">
      @csrf
      <input type="text" name="reason" class="form-control-pro" maxlength="500" required placeholder="Motif du refus (visible par le client)">
      <button type="submit" class="btn-navy btn-sm-pro" style="background:var(--c-red)">Confirmer</button>
    </form>
  </div>
  @endif
</div>
@endforeach
</div>

<div style="margin-top:1.25rem">{{ $requests->links() }}</div>
@endif

@endsection
