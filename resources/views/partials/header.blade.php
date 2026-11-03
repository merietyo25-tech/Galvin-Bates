@php
    $locale = app()->getLocale(); $route = Route::currentRouteName() ?? 'home';
    $siteContact = \App\Models\SiteContact::current();
@endphp

<header id="site-header" class="site-header fixed top-0 left-0 right-0 z-50 transition-all duration-300">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 flex items-center justify-between gap-3 h-16 sm:h-20">

        <!-- Logo -->
        <a href="{{ route('home', ['locale' => $locale]) }}" class="flex items-center gap-3 flex-shrink-0 min-w-0 site-logo-link">
            <span class="logo-img logo-img--white">
                <x-logo variant="full" theme="dark" size="md" :dark="$siteContact->logo_dark_path ? Storage::url($siteContact->logo_dark_path) : null" :name="$siteContact->name" />
            </span>
            <span class="logo-img logo-img--color">
                <x-logo variant="full" theme="light" size="md" :light="$siteContact->logo_light_path ? Storage::url($siteContact->logo_light_path) : null" :name="$siteContact->name" />
            </span>
        </a>

        <!-- Desktop nav -->
        <nav class="hidden xl:flex items-center gap-1" aria-label="Navigation principale">
            @php
            $links = [
                ['route' => 'home',     'label' => 'menu.home'],
                ['route' => 'about',    'label' => 'menu.about'],
                ['route' => 'services', 'label' => 'menu.services'],
                ['route' => 'faq',      'label' => 'menu.faq'],
                ['route' => 'contact',  'label' => 'menu.contact'],
            ];
            $serviceRoutes = ['services','services.auto','services.personal','services.home','services.study','services.business','services.bike'];
            @endphp
            @foreach ($links as $link)
            @php
            $active = $link['route'] === 'services'
                ? in_array($route, $serviceRoutes)
                : $route === $link['route'];
            @endphp
            <a href="{{ route($link['route'], ['locale' => $locale]) }}"
               class="nav-link px-3 2xl:px-4 py-2 text-sm font-semibold rounded-lg whitespace-nowrap transition-colors duration-200 {{ $active ? 'nav-link--active' : '' }}">
                @lang($link['label'])
            </a>
            @endforeach
        </nav>

        <!-- Right actions -->
        <div class="flex items-center gap-2 sm:gap-3 flex-shrink-0">

            <!-- Language switcher -->
            @php
                $langs   = \App\Models\Language::enabledList();
                $current = $langs->firstWhere('code', $locale);
                $flagExt = $current->flag_ext ?? 'png';
            @endphp
            <div class="lang-switch" x-data="{ open: false }" @keydown.escape.window="open = false">
                <button type="button" @click="open = !open" @click.outside="open = false"
                        :aria-expanded="open" aria-haspopup="true"
                        aria-label="Langue : {{ $current->native_name ?? strtoupper($locale) }}"
                        class="lang-btn">
                    <img src="{{ asset('images/' . $locale . '.' . $flagExt) }}" alt="" class="lang-flag">
                    <span class="lang-btn__code">{{ strtoupper($locale) }}</span>
                    <svg class="lang-btn__chev" :class="{ 'is-open': open }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>

                <div class="lang-menu" x-show="open" x-transition.opacity.duration.150ms style="display:none" role="menu" aria-label="Langue">
                    <div class="lang-menu__title"><i class="fas fa-globe" aria-hidden="true"></i> Langue · Language</div>
                    <div class="lang-menu__grid">
                        @foreach ($langs as $lang)
                        <a href="{{ route($route ?? 'home', ['locale' => $lang->code]) }}"
                           hreflang="{{ $lang->code }}" lang="{{ $lang->code }}" role="menuitem"
                           class="lang-item {{ $lang->code === $locale ? 'is-active' : '' }}"
                           @if($lang->code === $locale) aria-current="true" @endif>
                            <img src="{{ asset('images/' . $lang->code . '.' . $lang->flag_ext) }}" alt="" class="lang-flag">
                            <span class="lang-item__name">{{ $lang->native_name ?: strtoupper($lang->code) }}</span>
                            <span class="lang-item__code">{{ strtoupper($lang->code) }}</span>
                            @if($lang->code === $locale)<i class="fas fa-check lang-item__check" aria-hidden="true"></i>@endif
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Ouvrir un compte (sans demande de prêt) -->
            @guest
            <a href="{{ route('register') }}"
               class="hidden lg:inline-flex btn-account"
               title="@lang('menu.open_account')" aria-label="@lang('menu.open_account')">
                <i class="fas fa-user-plus" aria-hidden="true"></i>
                <span class="btn-account__label">@lang('menu.open_account')</span>
            </a>
            @endguest

            <!-- CTA -->
            <a href="{{ route('loan', ['locale' => $locale]) }}"
               class="hidden md:inline-flex items-center gap-2 btn-primary text-sm whitespace-nowrap">
                <span>@lang('menu.loan')</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </a>

            <!-- Mobile toggle -->
            <button @click="mobileOpen = !mobileOpen"
                class="xl:hidden p-2 rounded-lg mobile-menu-btn inline-flex items-center justify-center w-11 h-11 transition-colors duration-200"
                aria-label="Menu" :aria-expanded="mobileOpen">
                <svg x-show="!mobileOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="mobileOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display:none">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="mobileOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="xl:hidden mobile-menu border-t" style="display:none; position:relative; z-index:9999;">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 py-4 space-y-1 max-h-[calc(100vh-4rem)] overflow-y-auto">
            @foreach ($links as $link)
            @php
            $active = $link['route'] === 'services'
                ? in_array($route, $serviceRoutes)
                : $route === $link['route'];
            @endphp
            <a href="{{ route($link['route'], ['locale' => $locale]) }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-colors duration-150 {{ $active ? 'bg-navy text-white' : 'text-gray-700 hover:bg-gray-50' }}">
                @lang($link['label'])
            </a>
            @endforeach
            <div class="pt-3 border-t border-gray-100 mt-3 space-y-2">
                @guest
                <a href="{{ route('register') }}"
                   class="flex items-center justify-center gap-2 btn-account w-full py-3">
                    <i class="fas fa-user-plus" aria-hidden="true"></i>
                    <span>@lang('menu.open_account')</span>
                </a>
                @endguest
                <a href="{{ route('loan', ['locale' => $locale]) }}"
                   class="flex items-center justify-center gap-2 btn-primary w-full py-3">
                    <span>@lang('menu.loan')</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</header>

<!-- Header spacer (non-home pages) -->
@if(!request()->routeIs('home'))
<div class="h-16 sm:h-20"></div>
@endif
