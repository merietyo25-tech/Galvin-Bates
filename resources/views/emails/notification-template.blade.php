@php
$btnTexts = [
    'fr' => 'Voir les prochaines étapes', 'en' => 'View next steps', 'pl' => 'Zobacz kolejne kroki',
    'es' => 'Ver los próximos pasos', 'bg' => 'Вижте следващите стъпки', 'hu' => 'Következő lépések megtekintése',
    'it' => 'Vedi i prossimi passi', 'de' => 'Nächste Schritte ansehen', 'lt' => 'Peržiūrėti tolimesnius žingsnius',
    'ro' => 'Vezi următorii pași', 'lv' => 'Skatīt nākamos soļus', 'nl' => 'Bekijk volgende stappen',
    'pt' => 'Ver próximos passos',
];
$btnText = $btnTexts[$locale] ?? $btnTexts['fr'];
@endphp
<x-email-layout
    :title="$title"
    subtitle="{{ site_name() }}"
    accent="teal"
    :locale="$locale"
>

{!! $body !!}

@if(!empty($outcomeUrl))
<div class="btn-wrap">
  <a href="{{ $outcomeUrl }}" class="btn">{{ $btnText }}</a>
</div>
@endif

</x-email-layout>
