@if ($paginator->hasPages())
<nav class="pg-pro" role="navigation" aria-label="Pagination">
    <p class="pg-pro__summary">
        {{-- Le ?? qui figurait ici ne servait a rien : __() renvoie la CLE quand la
             traduction manque, jamais null. Le resume affichait donc litteralement
             "pagination.showing 1 pagination.to 20". Les cles existent desormais
             dans les 16 fichiers lang/*/pagination.php. --}}
        @lang('pagination.showing')
        <strong>{{ $paginator->firstItem() }}</strong>
        @lang('pagination.to')
        <strong>{{ $paginator->lastItem() }}</strong>
        @lang('pagination.of')
        <strong>{{ $paginator->total() }}</strong>
        @lang('pagination.results')
    </p>

    <ul class="pg-pro__list">
        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <li class="pg-pro__item pg-pro__item--disabled" aria-disabled="true">
                <span class="pg-pro__link"><i class="fas fa-chevron-left"></i></span>
            </li>
        @else
            <li class="pg-pro__item">
                <a class="pg-pro__link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                    <i class="fas fa-chevron-left"></i>
                </a>
            </li>
        @endif

        {{-- Page numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="pg-pro__item pg-pro__item--dots"><span class="pg-pro__link">{{ $element }}</span></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="pg-pro__item pg-pro__item--active" aria-current="page">
                            <span class="pg-pro__link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="pg-pro__item">
                            <a class="pg-pro__link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <li class="pg-pro__item">
                <a class="pg-pro__link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                    <i class="fas fa-chevron-right"></i>
                </a>
            </li>
        @else
            <li class="pg-pro__item pg-pro__item--disabled" aria-disabled="true">
                <span class="pg-pro__link"><i class="fas fa-chevron-right"></i></span>
            </li>
        @endif
    </ul>
</nav>
@endif
