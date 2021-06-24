@php
    SeoHelper::setTitle(__('Vendor Registration Success'));
    Theme::fire('beforeRenderTheme', app(\Botble\Theme\Contracts\Theme::class));
@endphp

{!! Theme::partial('header') !!}

<div class="ps-page--404 page-registration-success">
    <div class="container">
        <div class="ps-section__content">
            <img class="registration-image" src="{{ Theme::asset()->url('img/check.png') }}" alt="thank you">
            <h3>{{ __('Thank you !') }}</h3>
            <p>{{ __("Your information has been successfully submitted.") }}<strong> Check your email </strong>for further instructions on <strong>account activation.</strong></p>
            <a class="btn btn-primary btn-lg p-3
" href="{{ url('/') }}"> {{ __('Continue to Website') }}</a>
        </div>
    </div>
</div>

{!! Theme::partial('footer') !!}


