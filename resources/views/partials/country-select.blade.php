{{--
  Liste déroulante de tous les pays, nommés dans la langue du site (Intl.DisplayNames),
  pré-remplie avec le pays détecté du visiteur (IP, sinon langue du navigateur).
  Paramètres : $name (nom du champ), $value (valeur actuelle), $required (bool), $class (classes CSS).
  La valeur envoyée est le nom du pays (comme dans le KYC).
--}}
@php
  $csName     = $name ?? 'country';
  $csValue    = $value ?? '';
  $csRequired = $required ?? true;
  $csClass    = $class ?? 'form-control';
@endphp
<div x-data="countrySelect(@js($csValue))">
  <select name="{{ $csName }}" class="{{ $csClass }}" x-model="country" autocomplete="country-name" @required($csRequired)>
    <option value="">— {{ __('onboarding.f_country') }} —</option>
    @if($csValue)<option value="{{ $csValue }}" selected>{{ $csValue }}</option>@endif
    <template x-for="c in countries" :key="c.code">
      <option :value="c.name" x-text="c.name" :selected="c.name === country"></option>
    </template>
  </select>
  <small x-show="detected" x-cloak style="display:block;margin-top:.3rem;color:#16a34a;font-size:.74rem">
    <i class="fas fa-location-dot"></i> {{ __('onboarding.country_detected') }}
  </small>
</div>

@once
@push('scripts')
<script>
(function () {
  var CODES = ['AD','AE','AF','AG','AI','AL','AM','AO','AR','AS','AT','AU','AW','AX','AZ','BA','BB','BD','BE','BF','BG','BH','BI','BJ','BL','BM','BN','BO','BQ','BR','BS','BT','BW','BY','BZ','CA','CC','CD','CF','CG','CH','CI','CK','CL','CM','CN','CO','CR','CU','CV','CW','CX','CY','CZ','DE','DJ','DK','DM','DO','DZ','EC','EE','EG','EH','ER','ES','ET','FI','FJ','FK','FM','FO','FR','GA','GB','GD','GE','GF','GG','GH','GI','GL','GM','GN','GP','GQ','GR','GT','GU','GW','GY','HK','HN','HR','HT','HU','ID','IE','IL','IM','IN','IO','IQ','IR','IS','IT','JE','JM','JO','JP','KE','KG','KH','KI','KM','KN','KP','KR','KW','KY','KZ','LA','LB','LC','LI','LK','LR','LS','LT','LU','LV','LY','MA','MC','MD','ME','MF','MG','MH','MK','ML','MM','MN','MO','MP','MQ','MR','MS','MT','MU','MV','MW','MX','MY','MZ','NA','NC','NE','NF','NG','NI','NL','NO','NP','NR','NU','NZ','OM','PA','PE','PF','PG','PH','PK','PL','PM','PN','PR','PS','PT','PW','PY','QA','RE','RO','RS','RU','RW','SA','SB','SC','SD','SE','SG','SH','SI','SK','SL','SM','SN','SO','SR','SS','ST','SV','SX','SY','SZ','TC','TD','TG','TH','TJ','TK','TL','TM','TN','TO','TR','TT','TV','TW','TZ','UA','UG','US','UY','UZ','VA','VC','VE','VG','VI','VN','VU','WF','WS','YE','YT','ZA','ZM','ZW'];
  var LOCALE = "{{ str_replace('_', '-', app()->getLocale()) }}";

  function factory(initial) {
    return {
      country: initial || '',
      countries: [],
      detected: false,
      init() { this.build(); this.detect(); },
      build() {
        var names = null;
        try { names = new Intl.DisplayNames([LOCALE, 'fr', 'en'], { type: 'region' }); } catch (e) {}
        this.countries = CODES.map(function (code) {
          var n = code;
          if (names) { try { n = names.of(code) || code; } catch (e) {} }
          return { code: code, name: n };
        }).sort(function (a, b) { return a.name.localeCompare(b.name, LOCALE); });
      },
      async detect() {
        if (this.country) return;
        try {
          var ctrl = new AbortController(), t = setTimeout(function () { ctrl.abort(); }, 3000);
          var res = await fetch('https://get.geojs.io/v1/ip/country.json', { signal: ctrl.signal });
          clearTimeout(t);
          if (res.ok) {
            var j = await res.json();
            var f = this.countries.find(function (c) { return c.code === (j.country || '').toUpperCase(); });
            if (f && !this.country) { this.country = f.name; this.detected = true; return; }
          }
        } catch (e) {}
        var region = ((navigator.language || '').split('-')[1] || '').toUpperCase();
        var g = region && this.countries.find(function (c) { return c.code === region; });
        if (g && !this.country) { this.country = g.name; this.detected = true; }
      },
    };
  }

  // Disponible avant et après le démarrage d'Alpine
  window.countrySelect = factory;
  document.addEventListener('alpine:init', function () { window.Alpine.data('countrySelect', factory); });
})();
</script>
@endpush
@endonce
