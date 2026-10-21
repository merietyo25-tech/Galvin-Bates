@extends('layouts.app')
@section('title', __('menu.contact'))

@section('content')
@php
    $locale = app()->getLocale();
    $siteContact = \App\Models\SiteContact::current();
    $socialLinks = \App\Models\SocialLink::where('is_visible', true)->orderBy('sort_order')->get();
    $addresses = collect([$siteContact->address_1, $siteContact->address_2, $siteContact->address_3])->filter();
    $phones    = collect([$siteContact->phone_1, $siteContact->phone_2])->filter();
@endphp

{{-- Page hero --}}
<div class="page-hero">
    <div class="container">
        <div class="page-hero__content">
            <h1 class="page-hero__title">@lang('menu.contact')</h1>
            <ul class="page-hero__breadcrumb">
                <li><a href="{{ route('home', ['locale' => $locale]) }}">@lang('menu.home')</a></li>
                <li class="sep"><i class="fas fa-chevron-right"></i></li>
                <li>@lang('menu.contact')</li>
            </ul>
        </div>
    </div>
</div>

{{-- Info bar --}}
<div class="contact-info-bar">
    <div class="container">
        <div class="row g-3 gutter-y-20">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-duration="800ms" data-wow-delay="0ms">
                <div class="contact-info-card">
                    <div class="contact-info-card__icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <p class="contact-info-card__title">{{ __('contact.address_title') }}</p>
                        @forelse ($addresses as $address)
                        <p class="contact-info-card__value" style="margin-bottom:.35rem">{{ $address }}</p>
                        @empty
                        <p class="contact-info-card__value">—</p>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-duration="800ms" data-wow-delay="80ms">
                <div class="contact-info-card">
                    <div class="contact-info-card__icon"><i class="fas fa-phone-alt"></i></div>
                    <div>
                        <p class="contact-info-card__title">{{ __('contact.phone_title') }}</p>
                        @forelse ($phones as $phone)
                        <p class="contact-info-card__value" style="margin-bottom:.35rem"><a href="tel:{{ preg_replace('/[^\d+]/', '', $phone) }}">{{ $phone }}</a></p>
                        @empty
                        <p class="contact-info-card__value">—</p>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-duration="800ms" data-wow-delay="160ms">
                <div class="contact-info-card">
                    <div class="contact-info-card__icon"><i class="fas fa-envelope"></i></div>
                    <div>
                        <p class="contact-info-card__title">{{ __('contact.mail_title') }}</p>
                        @if($siteContact->email)
                        <p class="contact-info-card__value"><a href="mailto:{{ $siteContact->email }}">{{ $siteContact->email }}</a></p>
                        @else
                        <p class="contact-info-card__value">—</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Form + Image panel --}}
<section class="py-24 bg-white">
    <div class="container">
        <div class="row g-4 gutter-y-40 align-items-stretch">

            {{-- Image panel --}}
            <div class="col-lg-5 wow fadeInLeft" data-wow-duration="900ms">
                <div class="contact-image-panel">
                    <img src="{{ asset('assets/images/resources/contact-1-1.jpg') }}"
                         alt="Contact {{ $siteContact->name }}" class="contact-image-panel__img">
                    <div class="contact-image-panel__info">
                        <div class="contact-panel__company">
                            <h3>{{ $siteContact->name }}</h3>
                            <p>{{ __('contact.detail_desc') }}</p>
                        </div>
                        @if ($addresses->first())
                        <div class="contact-panel__item">
                            <div class="contact-panel__item-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <div>
                                <span class="contact-panel__item-label">{{ __('contact.address_title') }}</span>
                                <span class="contact-panel__item-value">{{ $addresses->first() }}</span>
                            </div>
                        </div>
                        @endif
                        @if ($phones->first())
                        <div class="contact-panel__item">
                            <div class="contact-panel__item-icon"><i class="fas fa-phone-alt"></i></div>
                            <div>
                                <span class="contact-panel__item-label">{{ __('contact.phone_title') }}</span>
                                <a href="tel:{{ preg_replace('/[^\d+]/', '', $phones->first()) }}" class="contact-panel__item-value">{{ $phones->first() }}</a>
                            </div>
                        </div>
                        @endif
                        @if ($siteContact->email)
                        <div class="contact-panel__item">
                            <div class="contact-panel__item-icon"><i class="fas fa-envelope"></i></div>
                            <div>
                                <span class="contact-panel__item-label">{{ __('contact.mail_title') }}</span>
                                <a href="mailto:{{ $siteContact->email }}" class="contact-panel__item-value">{{ $siteContact->email }}</a>
                            </div>
                        </div>
                        @endif
                        <div class="contact-panel__social">
                            @foreach ($socialLinks as $link)
                            <a href="{{ $link->url }}" aria-label="{{ $link->label }}" @if(str_starts_with($link->url, 'http')) target="_blank" rel="noopener" @endif><i class="{{ $link->icon_class }}"></i></a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Contact form --}}
            <div class="col-lg-7 wow fadeInRight" data-wow-duration="900ms" data-wow-delay="150ms">
                <div class="form-card h-100">
                    <div class="section-label mb-2">{{ __('contact.form_title') }}</div>
                    <h2 class="section-title mb-6">{{ __('contact.detail_title') }}</h2>

                    @if (session('success'))
                        <div class="alert alert-success">{{ __('message.success_contact') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ __('message.error') }}</div>
                    @endif

                    <form method="POST" action="{{ route('contact.send') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __('contact.placeholder_name') }} *</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                           placeholder="{{ __('contact.placeholder_name') }}" required>
                                    @error('name')<span class="form-error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __('contact.placeholder_email') }} *</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                           placeholder="{{ __('contact.placeholder_email') }}" required>
                                    @error('email')<span class="form-error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('contact.subject') }} *</label>
                                    <select name="subject" class="form-control" required>
                                        <option value="">— {{ __('contact.subject') }} —</option>
                                        <option value="Prêt personnel"  {{ old('subject')=='Prêt personnel'  ?'selected':'' }}>@lang('menu.personal')</option>
                                        <option value="Prêt immobilier" {{ old('subject')=='Prêt immobilier' ?'selected':'' }}>@lang('menu.home_loan')</option>
                                        <option value="Prêt commercial" {{ old('subject')=='Prêt commercial' ?'selected':'' }}>@lang('menu.business')</option>
                                        <option value="Prêt étudiant"   {{ old('subject')=='Prêt étudiant'   ?'selected':'' }}>@lang('menu.study')</option>
                                        <option value="Prêt auto"       {{ old('subject')=='Prêt auto'       ?'selected':'' }}>@lang('menu.auto')</option>
                                        <option value="Prêt moto"       {{ old('subject')=='Prêt moto'       ?'selected':'' }}>@lang('menu.bike')</option>
                                        <option value="Autre"           {{ old('subject')=='Autre'           ?'selected':'' }}>Autre</option>
                                    </select>
                                    @error('subject')<span class="form-error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Message *</label>
                                    <textarea name="message" class="form-control" rows="6"
                                              placeholder="{{ __('contact.placeholder_message') }}" required>{{ old('message') }}</textarea>
                                    @error('message')<span class="form-error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn-primary btn-primary--lg w-100 justify-content-center">
                                    <i class="fas fa-paper-plane"></i>
                                    {{ __('contact.button') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
