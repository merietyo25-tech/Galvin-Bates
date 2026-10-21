@extends('layouts.dashboard')
@section('title', 'Réseaux sociaux — ' . site_name())
@section('page_title', 'Réseaux sociaux')

@section('content')

<div class="d-flex align-items-start justify-content-between flex-wrap gap-3 page-hdr">
  <div>
    <h4>Réseaux sociaux</h4>
    <p>Liens sociaux affichés dans le pied de page et sur la page contact du site public</p>
  </div>
  <a href="{{ route('admin.social-links.create') }}" class="btn-navy">
    <i class="fas fa-plus"></i> Ajouter
  </a>
</div>

@if($links->isEmpty())
<div class="card-pro" style="text-align:center;padding:4rem 2rem">
  <i class="fas fa-share-alt" style="font-size:3rem;color:var(--c-accent);opacity:.35;display:block;margin-bottom:1rem"></i>
  <p style="font-weight:600;color:var(--c-navy);font-size:1rem;margin-bottom:.35rem">Aucun réseau social configuré</p>
  <p style="color:var(--c-muted);font-size:.8375rem;margin-bottom:1.25rem">
    Ajoutez un lien pour qu'il apparaisse dans le pied de page et sur la page contact.
  </p>
  <a href="{{ route('admin.social-links.create') }}" class="btn-navy">
    <i class="fas fa-plus"></i> Ajouter
  </a>
</div>
@else
<div class="card-pro">
  <div class="table-responsive-pro">
    <table class="pro-table">
      <thead>
        <tr>
          <th style="width:52px"></th>
          <th>Réseau</th>
          <th>URL</th>
          <th>Ordre</th>
          <th>Visibilité</th>
          <th style="text-align:right;width:96px">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($links as $link)
        <tr>
          <td data-label="">
            <span style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,var(--c-navy),var(--c-navy-3));color:var(--c-accent);font-size:.9rem">
              <i class="{{ $link->icon_class }}"></i>
            </span>
          </td>

          <td data-label="Réseau">
            <div class="cell-name">{{ $link->label }}</div>
            <div class="cell-sub">{{ $link->platform }}</div>
          </td>

          <td data-label="URL">
            <span style="font-size:.8125rem;color:var(--c-text);word-break:break-all">{{ $link->url }}</span>
          </td>

          <td data-label="Ordre" style="color:var(--c-muted);font-size:.78rem">
            {{ $link->sort_order }}
          </td>

          <td data-label="Visibilité">
            @if($link->is_visible)
            <span class="badge-status bs-green">
              <i class="fas fa-eye" style="font-size:.55rem"></i> Visible
            </span>
            @else
            <span class="badge-status bs-gray">
              <i class="fas fa-eye-slash" style="font-size:.55rem"></i> Masqué
            </span>
            @endif
          </td>

          <td data-label="Actions" style="text-align:right">
            <div style="display:flex;gap:.375rem;justify-content:flex-end">
              <a href="{{ route('admin.social-links.edit', $link) }}"
                 class="btn-icon btn-icon-primary" title="Modifier">
                <i class="fas fa-pen"></i>
              </a>
              <form action="{{ route('admin.social-links.destroy', $link) }}" method="POST"
                    data-confirm="Ce lien de reseau social sera supprime."
            data-confirm-title="Supprimer ce lien ?" data-confirm-ok="Supprimer" data-confirm-danger="1">
                @csrf @method('DELETE')
                <button type="submit" class="btn-icon btn-icon-danger" title="Supprimer">
                  <i class="fas fa-trash"></i>
                </button>
              </form>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endif


{{-- Pagination --}}
@if($links->hasPages())
<div class="card-pro" style="padding:1rem 1.25rem;margin-top:1rem">
  {{ $links->links('partials.pagination') }}
</div>
@endif

@endsection
