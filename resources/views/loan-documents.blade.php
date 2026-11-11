@extends('layouts.app')
@section('title', __('loan.complete_title'))


@section('content')
@php $locale = app()->getLocale(); @endphp

<div class="page-hero">
    <div class="container">
        <div class="page-hero__content">
            <h1 class="page-hero__title">{{ __('loan.complete_title') }}</h1>
            <ul class="page-hero__breadcrumb">
                <li><a href="{{ route('home', ['locale' => $locale]) }}">@lang('menu.home')</a></li>
                <li class="sep"><i class="fas fa-chevron-right"></i></li>
                <li><a href="{{ route('loan', ['locale' => $locale]) }}">@lang('menu.loan')</a></li>
                <li class="sep"><i class="fas fa-chevron-right"></i></li>
                <li>{{ __('loan.complete_title') }}</li>
            </ul>
        </div>
    </div>
</div>

<section class="py-24 bg-white">
    <div class="container">
        <div class="row g-4 align-items-start">

            {{-- ══════════ FORMULAIRE PRINCIPAL ══════════ --}}
            <div class="col-lg-8 order-2 order-lg-1 wow fadeInLeft" data-wow-duration="700ms">

                <div class="form-card">

                    <div class="section-label mb-2">@lang('menu.loan')</div>
                    <h2 class="section-title mb-2">{{ __('loan.complete_title') }}</h2>
                    <p style="color:#666;margin-bottom:1.5rem;">{{ __('loan.complete_desc') }}</p>

                    @if (session('loan_sent'))
                        <div class="alert alert-success mb-4">
                            <i class="fas fa-check-circle" style="margin-right:.4rem;"></i>
                            @lang('message.loan_sent_next')
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success mb-4">
                            <i class="fas fa-check-circle" style="margin-right:.4rem;"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('docs_already_sent'))
                        <div class="alert alert-warning mb-4">
                            <i class="fas fa-exclamation-triangle" style="margin-right:.4rem;"></i>
                            @lang('message.docs_already_sent')
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <ul class="mb-0" style="padding-left:1.1rem;">
                                @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success') || session('docs_already_sent'))
                        <div class="text-center py-3">
                            <a href="{{ route('home', ['locale' => $locale]) }}" class="btn-primary btn-primary--lg">
                                <i class="fas fa-home" style="margin-right:.5rem;"></i>
                                @lang('menu.home')
                            </a>
                        </div>
                    @else
                    @include('partials.loan-documents-form', ['returnTo' => 'complete'])
                    @endif
                </div>

            </div>

            {{-- ══════════ CONDITIONS ══════════ --}}
            <div class="col-lg-4 order-1 order-lg-2 wow fadeInRight" data-wow-duration="900ms" data-wow-delay="150ms">
                <div style="position:sticky;top:110px;">
                    <div style="background:#fff8e1;border:1px solid #ffe082;border-radius:8px;padding:1rem 1.25rem;">
                        <div style="font-weight:700;color:#7c5800;margin-bottom:.35rem;">
                            <i class="fas fa-info-circle" style="margin-right:.4rem;"></i>
                            {{ __('message.loan_conditions_title') }}
                        </div>
                        <p style="margin:0;color:#7c5800;font-size:.88rem;">{{ __('message.loan_conditions_text') }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

