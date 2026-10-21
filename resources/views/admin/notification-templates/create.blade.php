@extends('layouts.dashboard')
@section('title','Nouveau modèle de notification')
@section('page_title','Nouveau modèle de notification')

@section('content')

<div class="d-flex align-items-start justify-content-between flex-wrap gap-3 page-hdr">
  <div>
    <h4>Nouveau modèle de notification</h4>
    <p>Un seul modèle par langue — sélectionné automatiquement selon la langue du client au moment de la validation.</p>
  </div>
  <a href="{{ route('admin.notification-templates.index') }}" class="btn-ghost btn-sm-pro">
    <i class="fas fa-arrow-left"></i> Retour
  </a>
</div>

@if($errors->any())
<div class="flash flash-err mb-4"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first() }}</div>
@endif

<div style="max-width:640px;margin:0 auto">

  <form action="{{ route('admin.notification-templates.store') }}" method="POST">
  @csrf

  <div class="card-pro mb-4">
    <div class="card-pro-hdr">
      <div class="card-pro-title"><span class="icon-dot"></span>Informations</div>
    </div>
    <div class="card-pro-body">
      <div class="row g-3">
        <div class="col-12">
          <label class="form-label-pro">Nom du modèle *</label>
          <input type="text" name="name" class="form-control-pro"
                 value="{{ old('name') }}" placeholder="Ex: Notification de validation — FR" required>
        </div>
        <div class="col-sm-6">
          <label class="form-label-pro">Étape *</label>
          <select name="type" class="form-control-pro" required>
            @foreach($types as $code=>$lbl)
            <option value="{{ $code }}" {{ old('type')==$code?'selected':'' }}>{{ $lbl }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-sm-6">
          <label class="form-label-pro">Langue *</label>
          <select name="locale" class="form-control-pro" required>
            <option value="">—</option>
            @foreach($localeLabels as $code=>$lbl)
            <option value="{{ $code }}" {{ old('locale')==$code?'selected':'' }}>{{ $lbl }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-12" id="subjectField">
          <label class="form-label-pro">Sujet de l'email *</label>
          <input type="text" name="subject" id="subjectInput" class="form-control-pro"
                 value="{{ old('subject') }}" placeholder="Ex: Votre demande {reference} a été validée" required>
        </div>
      </div>
    </div>
  </div>

  <div style="display:flex;gap:.75rem;justify-content:flex-end">
    <a href="{{ route('admin.notification-templates.index') }}" class="btn-ghost">Annuler</a>
    <button type="submit" class="btn-navy">
      <i class="fas fa-save me-1"></i>Créer et rédiger le contenu
    </button>
  </div>
  </form>

</div>

@push('scripts')
<script>
(function () {
  var typeSelect    = document.querySelector('select[name="type"]');
  var subjectField  = document.getElementById('subjectField');
  var subjectInput  = document.getElementById('subjectInput');
  var NO_SUBJECT_TYPES = ['{{ \App\Models\NotificationTemplate::TYPE_CONDITIONS }}'];

  function syncSubjectField() {
    var noSubject = NO_SUBJECT_TYPES.indexOf(typeSelect.value) !== -1;
    subjectField.style.display = noSubject ? 'none' : '';
    subjectInput.required = !noSubject;
  }

  typeSelect.addEventListener('change', syncSubjectField);
  syncSubjectField();
})();
</script>
@endpush

@endsection
