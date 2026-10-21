@extends('layouts.dashboard')
@section('title','Modèles de notification')
@section('page_title','Modèles de notification')

@section('content')

<div class="d-flex align-items-start justify-content-between flex-wrap gap-3 page-hdr">
  <div>
    <h4>Modèles de notification</h4>
    <p>Un modèle par langue et par étape — utilisé automatiquement selon la langue du client au moment de l'envoi.</p>
  </div>
  <a href="{{ route('admin.notification-templates.create') }}" class="btn-navy">
    <i class="fas fa-plus"></i> Nouveau modèle
  </a>
</div>

<div style="display:flex;gap:.4rem;margin-bottom:1.25rem">
  @foreach(\App\Models\NotificationTemplate::TYPES as $code => $label)
  <a href="{{ route('admin.notification-templates.index', ['type' => $code]) }}"
     class="{{ $type === $code ? 'btn-navy' : 'btn-ghost' }} btn-sm-pro">
    {{ $label }}
  </a>
  @endforeach
</div>

@if(count($missingLocales))
<div style="padding:.65rem 1rem;background:#FEF9C3;border:1px solid #FDE047;border-radius:8px;
            font-size:.78rem;color:#713F12;margin-bottom:1.25rem">
  <i class="fas fa-exclamation-triangle me-1"></i>
  Langues sans modèle configuré (le français sera utilisé en repli) :
  <strong>{{ collect($missingLocales)->map(fn($l) => $localeLabels[$l] ?? strtoupper($l))->join(', ') }}</strong>
</div>
@endif

{{-- $totalTemplates (controleur) et non $templates->count() : ce dernier ne
     compterait que la page affichee. --}}
@if(!$totalTemplates)
<div class="card-pro" style="text-align:center;padding:4rem 2rem">
  <i class="fas fa-bell" style="font-size:3rem;color:var(--c-accent);opacity:.35;display:block;margin-bottom:1rem"></i>
  <p style="font-weight:600;color:var(--c-navy);font-size:1rem;margin-bottom:.35rem">Aucun modèle disponible</p>
  <p style="color:var(--c-muted);font-size:.8375rem;margin-bottom:1.25rem">
    Créez au moins un modèle en français (utilisé en repli pour les langues non configurées) avant de valider un dossier.
  </p>
  <a href="{{ route('admin.notification-templates.create') }}" class="btn-navy">
    <i class="fas fa-plus"></i> Créer un modèle
  </a>
</div>
@else
<div class="row g-4">
  @foreach($templates as $t)
  <div class="col-md-6 col-xl-4">
    <div class="card-pro h-100 d-flex flex-column">

      <div class="card-pro-hdr" style="flex-shrink:0">
        <div style="display:flex;align-items:center;gap:.75rem;min-width:0;flex:1">
          <div style="width:38px;height:38px;border-radius:9px;background:#EEF2FF;display:flex;align-items:center;justify-content:center;flex-shrink:0">
            <i class="fas fa-bell" style="color:var(--c-navy);font-size:.875rem"></i>
          </div>
          <div style="min-width:0;flex:1">
            <div style="font-weight:700;color:var(--c-navy);font-size:.875rem;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">
              {{ $t->name }}
            </div>
            <div style="display:flex;align-items:center;gap:.35rem;margin-top:.25rem;flex-wrap:wrap">
              <span class="badge-status bs-amber" style="font-size:.62rem">{{ $localeLabels[$t->locale] ?? strtoupper($t->locale) }}</span>
              @if($t->hasDocxTemplate())
              <span style="font-size:.62rem;padding:.1rem .4rem;border-radius:4px;font-weight:700;
                           background:#EFF6FF;color:#1D4ED8;border:1px solid #1D4ED833">
                <i class="fas fa-file-word" style="margin-right:.2rem"></i>DOCX v{{ $t->docx_version }}
              </span>
              @else
              <span style="font-size:.62rem;padding:.1rem .4rem;border-radius:4px;font-weight:700;
                           background:#FEF9C3;color:#713F12;border:1px solid #FDE047">
                Pas de DOCX
              </span>
              @endif
            </div>
          </div>
        </div>
      </div>

      <div class="card-pro-body" style="flex:1;display:flex;flex-direction:column;gap:.6rem">
        <div style="font-size:.73rem;color:var(--c-muted)">
          <i class="fas fa-user me-1"></i> {{ $t->creator?->name ?? 'Système' }}
          <span style="margin:0 .4rem">·</span>
          <i class="fas fa-calendar me-1"></i> {{ $t->created_at->format('d/m/Y') }}
        </div>
        <div style="font-size:.73rem;color:var(--c-muted)">
          <i class="fas fa-heading me-1"></i> {{ $t->subject }}
        </div>
        @if(!trim(strip_tags($t->content ?? '')))
        <div style="padding:.45rem .75rem;background:#FEF9C3;border:1px solid #FDE047;
                    border-radius:8px;font-size:.7rem;color:#713F12">
          <i class="fas fa-exclamation-triangle me-1"></i> Contenu vide — à rédiger
        </div>
        @endif
      </div>

      <div style="padding:.875rem 1.25rem;border-top:1px solid var(--c-border);
                  display:flex;gap:.4rem;flex-wrap:wrap;align-items:center">
        <a href="{{ route('admin.notification-templates.edit',$t) }}"
           class="btn-navy btn-sm-pro" style="flex:1;justify-content:center;min-width:70px">
          <i class="fas fa-pen"></i> Modifier
        </a>
        <form action="{{ route('admin.notification-templates.destroy',$t) }}" method="POST"
              data-confirm="Supprimer ce modèle de notification ?">
          @csrf @method('DELETE')
          <button class="btn-icon btn-icon-danger" title="Supprimer">
            <i class="fas fa-trash"></i>
          </button>
        </form>
      </div>

    </div>
  </div>
  @endforeach
</div>
@endif


{{-- Pagination --}}
@if($templates->hasPages())
<div class="card-pro" style="padding:1rem 1.25rem;margin-top:1rem">
  {{ $templates->links('partials.pagination') }}
</div>
@endif

@endsection
