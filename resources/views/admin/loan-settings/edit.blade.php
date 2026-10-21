@extends('layouts.dashboard')
@section('title', 'Paramètres de prêt — ' . site_name())
@section('page_title', 'Paramètres de prêt')

@section('content')

<div class="d-flex align-items-start justify-content-between flex-wrap gap-3 page-hdr">
  <div>
    <h4>Paramètres de prêt</h4>
    <p>Taux et montants appliqués par défaut aux nouvelles demandes de prêt et affichés sur le site public</p>
  </div>
</div>

@if($errors->any())
<div class="flash flash-err mb-4"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first() }}</div>
@endif

<form action="{{ route('admin.loan-settings.update') }}" method="POST">
@csrf
<div class="row g-4">

  <div class="col-xl-6">
    <div class="card-pro mb-4">
      <div class="card-pro-hdr">
        <div class="card-pro-title"><span class="icon-dot"></span>Taux</div>
      </div>
      <div class="card-pro-body">
        <div class="row g-3">
          <div class="col-12">
            <label class="form-label-pro">Taux d'intérêt annuel (%) *</label>
            <div class="d-flex gap-2 align-items-center">
              <input type="number" name="annual_rate" class="form-control-pro" step="0.01" min="0" max="100"
                     value="{{ old('annual_rate', $setting->annual_rate) }}" style="flex:1">
              <div style="padding:.6rem .875rem;background:var(--c-bg);border:1.5px solid var(--c-border);border-radius:var(--radius-sm);font-weight:700;font-size:.8125rem;color:var(--c-navy);flex-shrink:0">%</div>
            </div>
            <p class="form-help">
              Ce taux est appliqué automatiquement à chaque nouvelle demande de prêt créée depuis l'espace admin,
              et affiché sur le simulateur du site public. Les dossiers déjà créés conservent leur propre taux.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-6">
    <div class="card-pro mb-4">
      <div class="card-pro-hdr">
        <div class="card-pro-title"><span class="icon-dot"></span>Montants</div>
      </div>
      <div class="card-pro-body">
        <div class="row g-3">
          <div class="col-12">
            <label class="form-label-pro">Montant minimum *</label>
            <input type="number" name="min_amount" class="form-control-pro" step="0.01" min="0"
                   value="{{ old('min_amount', $setting->min_amount) }}">
          </div>
          <div class="col-12">
            <label class="form-label-pro">Montant maximum *</label>
            <input type="number" name="max_amount" class="form-control-pro" step="0.01" min="0"
                   value="{{ old('max_amount', $setting->max_amount) }}">
            <p class="form-help">
              Bornes appliquées au champ « Autre montant » du formulaire de demande de prêt sur le site public.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12">
    <div class="card-pro mb-4">
      <div class="card-pro-hdr">
        <div class="card-pro-title"><span class="icon-dot"></span>Notifications</div>
      </div>
      <div class="card-pro-body">
        <div class="row g-3">
          <div class="col-12 col-md-6">
            <label class="form-label-pro">Email de notification *</label>
            <input type="email" name="notification_email" class="form-control-pro"
                   value="{{ old('notification_email', $setting->notification_email) }}">
            <p class="form-help">
              Adresse qui reçoit les nouvelles demandes de prêt et les pièces d'identité envoyées
              par les clients depuis le site public.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12">
    <button type="submit" class="btn-navy">
      <i class="fas fa-save"></i> Enregistrer
    </button>
  </div>

</div>
</form>

@endsection
