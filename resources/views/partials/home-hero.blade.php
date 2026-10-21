{{-- ============================================================
     HERO v3 — scène 3D (Three.js) + révélations GSAP
     Le canvas #hx-canvas est piloté par assets/js/motion.js
============================================================ --}}
@php $locale = app()->getLocale(); @endphp
<section class="hx" id="hx">
    <div class="hx__bg" aria-hidden="true"></div>
    <div class="hx__grid" aria-hidden="true"></div>
    <div class="hx__glow hx__glow--a" aria-hidden="true"></div>
    <div class="hx__glow hx__glow--b" aria-hidden="true"></div>
    <canvas id="hx-canvas" class="hx__canvas" aria-hidden="true"></canvas>

    <div class="container-xl hx__inner">
        <div class="hx__copy">
            <div class="hx__chip">
                <span class="hx__chip-dot"></span>
                {{ __('home.slide_1.title') }}
            </div>

            <h1 class="hx__title">
                <span class="hx-line"><span>{{ __('home.slide_1.text1') }}</span></span>
                <span class="hx-line hx-line--accent"><span>{{ __('home.slide_1.text2') }}</span></span>
            </h1>

            <p class="hx__lead">{{ __('home.hero_subtitle') }}</p>

            <ul class="hx__pills">
                @foreach([
                    ['fas fa-bolt',     __('home.infos.item1')],
                    ['fas fa-coins',    __('home.infos.item3')],
                    ['fas fa-sync-alt', __('home.infos.item4')],
                ] as $pill)
                <li><i class="{{ $pill[0] }}"></i> {{ $pill[1] }}</li>
                @endforeach
            </ul>

            <div class="hx__cta">
                <a href="{{ route('loan', ['locale' => $locale]) }}" class="hx-btn hx-btn--solid" data-magnetic>
                    <i class="fas fa-file-signature"></i> @lang('menu.loan')
                    <i class="fas fa-arrow-right hx-btn__arrow"></i>
                </a>
                <a href="#simulate" class="hx-btn hx-btn--ghost" data-magnetic>
                    <i class="fas fa-calculator"></i> @lang('menu.simulate')
                </a>
            </div>
        </div>

        {{-- Visuel : photo client + maquette de l'appli de prêt (style banque mobile) --}}
        <div class="hx__visual" aria-hidden="true">
            <div class="hx-photo">
                <img src="{{ asset('assets/images/backgrounds/main-slider-bg-3-3.jpg') }}" alt="" width="1920" height="1000" fetchpriority="high">
                <span class="hx-photo__shade"></span>
            </div>

            <div class="hx-phone" data-float="8">
                <div class="hx-phone__notch"></div>
                <div class="hx-phone__screen">
                    <div class="hx-app__top">
                        <span class="hx-app__avatar">{{ strtoupper(substr(site_name(), 0, 1)) }}</span>
                        <span class="hx-app__bell"><i class="fas fa-bell"></i></span>
                    </div>
                    <div class="hx-app__balance">
                        <small>@lang('home.total_loan_amount_granted')</small>
                        <strong>25 000 €</strong>
                        <div class="hx-app__bar"><i></i></div>
                    </div>
                    <div class="hx-app__ring">
                        <svg viewBox="0 0 120 120"><circle cx="60" cy="60" r="50" class="trk"/><circle cx="60" cy="60" r="50" class="val"/></svg>
                        <span><b>48h</b><em>@lang('menu.loan')</em></span>
                    </div>
                    <ul class="hx-app__rows">
                        <li><i class="fas fa-calendar-alt"></i><span>60 ×</span><b>412 €</b></li>
                        <li><i class="fas fa-percent"></i><span>TAEG</span><b>3,9 %</b></li>
                        <li><i class="fas fa-shield-alt"></i><span>&nbsp;</span><b><i class="fas fa-check"></i></b></li>
                    </ul>
                    <span class="hx-app__btn">@lang('menu.loan') <i class="fas fa-arrow-right"></i></span>
                </div>
            </div>
        </div>
    </div>

    {{-- Bandeau de confiance --}}
    <div class="hx__trust">
        <div class="container-xl hx__trust-row">
            @foreach ([
                ['fas fa-users',      '8 500+',    8500,   '+',   __('home.customer_satisfaction_rate')],
                ['fas fa-euro-sign',  '500 000 €', 500000, ' €',  __('home.total_loan_amount_granted')],
                ['fas fa-bolt',       '48h',       null,   '',    __('home.average_approval_time')],
                ['fas fa-history',    '15',        15,     '',    __('home.about.exptitle')],
            ] as $t)
            <div class="hx__trust-item">
                <span class="hx__trust-icon"><i class="{{ $t[0] }}"></i></span>
                <div>
                    <strong @if($t[2]) data-count="{{ $t[2] }}" data-suffix="{{ $t[3] }}" @endif>{{ $t[1] }}</strong>
                    <span>{{ $t[4] }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <a href="#about" class="hx__scroll" aria-label="Défiler vers les services">
        <span class="hx__scroll-line"></span>
    </a>
</section>
