@php
    $tags = app(\Botble\Ecommerce\Repositories\Interfaces\ProductTagInterface::class)->allBy(['status' => \Botble\Base\Enums\BaseStatusEnum::PUBLISHED], ['slugable']);
    $rand = mt_rand();
@endphp
<aside class="widget widget_shop">

    <div class="ps-block__container">
        <div class="ps-block__header">
            <div class="ps-block__thumbnail mb-5"><img src="{{ $user->avatar_url }}" alt="vendor-logo"></div>
            <h4 class="widget-title company-title">{{$company->company_name}}</h4>
            <div class="rating_wrap">
                <div class="br-widget">

                    <div class="rating">
                        <div class="product_rate"
                             style="width: {{ get_average_star_of_company($user->id) * 20 }}%"></div>
                    </div>
                </div>
            </div>
            {{--            <p><strong>85% Positive</strong> (562 rating)</p>--}}
        </div>
        <span class="ps-block__divider"></span>
        <div class="ps-block__content">
            <p><strong>{{$company->company_name}}</strong>, {{$company->about_company}}</p><span
                class="ps-block__divider"></span>
            <p><strong class="mr-1">Address</strong>{{$company->company_address}} {{$company->city}}
                , {{$company->country}}</p>
            {{--            <figure>--}}
            {{--                <figcaption>Foloow us on social</figcaption>--}}
            {{--                <ul class="ps-list--social-color">--}}
            {{--                    <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>--}}
            {{--                    <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>--}}
            {{--                    <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>--}}
            {{--                    <li><a class="feed" href="#"><i class="fa fa-feed"></i></a></li>--}}
            {{--                </ul>--}}
            {{--            </figure>--}}
        </div>
        <div class="ps-block__footer">
            {{--            <p>Call us directly<strong>(+053) 77-637-3300</strong></p>--}}

        </div>
    </div>

</aside>
<aside class="widget widget_shop">
    <h4 class="widget-title">{{ __('By Price') }}</h4>
    <div class="widget__content nonlinear-wrapper">
        <div class="nonlinear" data-min="0" data-max="{{ theme_option('max_filter_price', 100000) }}"></div>
        <div class="ps-slider__meta">
            <div data-current-exchange-rate="{{ get_current_exchange_rate() }}"></div>
            <input class="product-filter-item product-filter-item-price-0" name="min_price"
                   value="{{ request()->input('min_price', 0) }}" type="hidden">
            <input class="product-filter-item product-filter-item-price-1" name="max_price"
                   value="{{ request()->input('max_price', theme_option('max_filter_price', 100000)) }}" type="hidden">
            <span class="ps-slider__value">
            <span class="ps-slider__min"></span> {{ get_application_currency()->title }}</span> - <span
                class="ps-slider__value"><span class="ps-slider__max"></span> {{ get_application_currency()->title }}
            </span>
        </div>
    </div>


    {!! render_product_swatches_filter([
        'view' => Theme::getThemeNamespace() . '::views.ecommerce.attributes.attributes-filter-renderer'
    ]) !!}
</aside>

@if (count($tags) > 0)
    <aside class="widget widget_shop">
        <h4 class="widget-title">{{ __('By Tags') }}</h4>
        <figure class="ps-custom-scrollbar" data-height="250">
            @foreach($tags as $tag)
                <div class="ps-checkbox">
                    <input class="form-control product-filter-item" type="checkbox" name="tags[]"
                           id="tag-{{ $rand }}-{{ $tag->id }}" value="{{ $tag->id }}"
                           @if (in_array($tag->id, request()->input('tags', []))) checked @endif>
                    <label for="tag-{{ $rand }}-{{ $tag->id }}"><span>{{ $tag->name }}</span></label>
                </div>
            @endforeach
        </figure>
    </aside>
@endif


