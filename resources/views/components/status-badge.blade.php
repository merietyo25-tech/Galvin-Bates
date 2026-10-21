@props([
    'domain',
    'status',
    'label' => null,
    'icon'  => false,
])

@php
    $meta  = config("solberg.status_badges.$domain.$status", ['badge' => 'draft', 'icon' => 'fa-circle']);
    $badge = $meta['badge'];
    $ic    = $icon === true ? $meta['icon'] : $icon;
@endphp

{{-- .ca-badge::before fournit deja un point colore (currentColor) : pas besoin d'icone par defaut --}}
<span {{ $attributes->merge(['class' => "ca-badge ca-badge--$badge"]) }}>
    @if($ic)<i class="fas {{ $ic }}"></i>@endif {{ $label ?? ucfirst($status) }}
</span>
