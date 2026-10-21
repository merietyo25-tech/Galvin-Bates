@extends('layouts.dashboard')
@section('title', 'SMS — ' . site_name())
@section('page_title', 'SMS')

@section('content')

<div class="d-flex align-items-start justify-content-between flex-wrap gap-3 page-hdr">
  <div>
    <h4>Envoi de SMS</h4>
    <p>Envoyez un SMS à un numéro, à des clients choisis ou à tous les clients</p>
  </div>
  @if(! $settings->enabled)
  <span class="badge-status bs-red"><i class="fas fa-power-off" style="font-size:.55rem"></i> Passerelle non configurée</span>
  @endif
</div>

@if($errors->any())
<div class="flash flash-err mb-4"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first() }}</div>
@endif

<div class="row g-4">

  {{-- ── Envoi ─────────────────────────────────────────────── --}}
  <div class="col-xl-7">
    <div class="card-pro mb-4">
      <div class="card-pro-hdr"><div class="card-pro-title"><span class="icon-dot"></span>Nouveau message</div></div>
      <div class="card-pro-body">
        <form action="{{ route('admin.sms.send') }}" method="POST" id="smsForm">
          @csrf
          <div class="row g-3">
            <div class="col-12">
              <label class="form-label-pro">Destinataires *</label>
              <select name="mode" id="smsMode" class="form-control-pro">
                <option value="single"   @selected(old('mode','single')==='single')>Un numéro</option>
                <option value="selected" @selected(old('mode')==='selected')>Clients sélectionnés</option>
                <option value="all"      @selected(old('mode')==='all')>Tous les clients ({{ $clients->count() }} avec téléphone)</option>
              </select>
            </div>

            <div class="col-12" id="boxSingle">
              <label class="form-label-pro">Numéro de téléphone</label>
              <input type="text" name="number" class="form-control-pro" placeholder="+33 6 12 34 56 78"
                     value="{{ old('number') }}">
              <p class="form-help">Écrivez le numéro avec son indicatif (+ ou 00) : fonctionne pour n'importe quel pays.@if($settings->default_country_code) Sans indicatif, +{{ $settings->default_country_code }} est ajouté.@endif</p>
            </div>

            <div class="col-12" id="boxSelected" style="display:none">
              <label class="form-label-pro">Clients</label>
              <select name="client_ids[]" class="form-control-pro" multiple size="8">
                @foreach($clients as $c)
                <option value="{{ $c->id }}" @selected(in_array($c->id, old('client_ids', [])))>{{ $c->name }} — {{ $c->phone }}</option>
                @endforeach
              </select>
              <p class="form-help">Ctrl / Cmd + clic pour en sélectionner plusieurs.</p>
            </div>

            <div class="col-12">
              <label class="form-label-pro">Message *</label>
              <textarea name="message" id="smsText" class="form-control-pro" rows="4" maxlength="480" required>{{ old('message') }}</textarea>
              <p class="form-help"><span id="smsCount">0</span>/480 caractères — <span id="smsParts">0</span> SMS par destinataire</p>
            </div>

            <div class="col-12">
              <button type="submit" class="btn-navy" data-sms-send><i class="fas fa-paper-plane"></i> Envoyer</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{-- ── Configuration ──────────────────────────────────────── --}}
  @if($canConfigure)
  <div class="col-xl-5">
    <div class="card-pro mb-4">
      <div class="card-pro-hdr"><div class="card-pro-title"><span class="icon-dot"></span>Passerelle SMS (gratuite)</div></div>
      <div class="card-pro-body">
        <form action="{{ route('admin.sms.settings') }}" method="POST">
          @csrf
          <div class="row g-3">
            <div class="col-12">
              <label class="form-label-pro">Mode</label>
              <select name="driver" class="form-control-pro">
                <option value="android_gateway" @selected(old('driver',$settings->driver)==='android_gateway')>Android SMS Gateway (téléphone + SIM)</option>
                <option value="log" @selected(old('driver',$settings->driver)==='log')>Test (écrit dans le journal, n'envoie rien)</option>
              </select>
            </div>
            <div class="col-12">
              <label class="form-label-pro">URL de la passerelle</label>
              <input type="url" name="api_url" class="form-control-pro" placeholder="http://192.168.1.20:8080"
                     value="{{ old('api_url', $settings->api_url) }}">
            </div>
            <div class="col-6">
              <label class="form-label-pro">Utilisateur</label>
              <input type="text" name="username" class="form-control-pro" autocomplete="off" value="{{ old('username', $settings->username) }}">
            </div>
            <div class="col-6">
              <label class="form-label-pro">Mot de passe</label>
              <input type="password" name="password" class="form-control-pro" autocomplete="new-password"
                     placeholder="{{ $settings->getRawOriginal('password') ? '•••••••• (inchangé)' : '' }}">
            </div>
            <div class="col-12">
              <label class="form-label-pro">Indicatif pays par défaut (facultatif)</label>
              <input type="text" name="default_country_code" class="form-control-pro" value="{{ old('default_country_code', $settings->default_country_code) }}">
            </div>
            <div class="col-12">
              <button type="submit" class="btn-navy"><i class="fas fa-save"></i> Enregistrer</button>
            </div>
          </div>
        </form>

        <hr style="margin:1.25rem 0">
        <p class="form-help" style="margin:0">
          <strong>Mise en place (gratuit, open-source)&nbsp;:</strong><br>
          1. Installez l'app <em>Android SMS Gateway</em> (sms-gate.app) sur un téléphone Android avec une SIM.<br>
          2. Activez « Local server » et notez l'adresse, l'utilisateur et le mot de passe affichés.<br>
          3. Saisissez-les ci-dessus (le serveur et le téléphone doivent être sur le même réseau Wi-Fi, ou utilisez le mode cloud <code>https://api.sms-gate.app/3rdparty/v1</code>).
        </p>
      </div>
    </div>
  </div>
  @endif

  {{-- ── Historique ─────────────────────────────────────────── --}}
  <div class="col-12">
    <div class="card-pro">
      <div class="card-pro-hdr"><div class="card-pro-title"><span class="icon-dot"></span>Historique</div></div>
      <div class="table-responsive-pro">
        <table class="pro-table">
          <thead>
            <tr><th>Date</th><th>Destinataire</th><th>Message</th><th>Statut</th></tr>
          </thead>
          <tbody>
            @forelse($history as $m)
            <tr>
              <td data-label="Date" style="white-space:nowrap">{{ $m->created_at->format('d/m/Y H:i') }}</td>
              <td data-label="Destinataire">
                <div class="cell-name">{{ $m->user?->name ?? '—' }}</div>
                <div class="cell-sub">{{ $m->phone }}</div>
              </td>
              <td data-label="Message" style="max-width:380px">{{ \Illuminate\Support\Str::limit($m->body, 100) }}</td>
              <td data-label="Statut">
                @if($m->status === 'sent')
                <span class="badge-status bs-green">Envoyé</span>
                @elseif($m->status === 'pending')
                <span class="badge-status bs-gray">En attente</span>
                @else
                <span class="badge-status bs-red" title="{{ $m->error }}">Échec</span>
                @if($m->error)<div class="cell-sub">{{ \Illuminate\Support\Str::limit($m->error, 60) }}</div>@endif
                @endif
              </td>
            </tr>
            @empty
            <tr><td colspan="4" style="text-align:center;color:var(--c-muted);padding:2rem">Aucun SMS envoyé pour le moment.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
    @if($history->hasPages())
    <div class="card-pro" style="padding:1rem 1.25rem;margin-top:1rem">{{ $history->links('partials.pagination') }}</div>
    @endif
  </div>
</div>

<script>
(function () {
  var mode = document.getElementById('smsMode'),
      single = document.getElementById('boxSingle'),
      selected = document.getElementById('boxSelected'),
      txt = document.getElementById('smsText'),
      cnt = document.getElementById('smsCount'),
      parts = document.getElementById('smsParts');
  function sync() {
    single.style.display = mode.value === 'single' ? '' : 'none';
    selected.style.display = mode.value === 'selected' ? '' : 'none';
  }
  function count() {
    var n = txt.value.length;
    cnt.textContent = n;
    parts.textContent = n === 0 ? 0 : (n <= 160 ? 1 : Math.ceil(n / 153));
  }
  mode.addEventListener('change', sync);
  txt.addEventListener('input', count);
  document.getElementById('smsForm').addEventListener('submit', function (e) {
    if (mode.value === 'all' && !confirm('Envoyer ce SMS à TOUS les clients ?')) { e.preventDefault(); }
  });
  sync(); count();
})();
</script>
@endsection
