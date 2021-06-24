@extends('core/base::layouts.master')
@section('content')
    @php do_action(BASE_ACTION_TOP_FORM_CONTENT_NOTIFICATION, request(), $payment) @endphp
    {!! Form::open(['route' => ['payment.update', $payment->id]]) !!}
        @method('PUT')
        <div class="row">
            <div class="col-md-9">
                <div class="widget meta-boxes">
                    <div class="widget-title">
                        <h4>
                            <span>{{ trans('plugins/payment::payment.information') }}</span>
                        </h4>
                    </div>
                    <div class="widget-body">
                        <p>{{ trans('plugins/payment::payment.created_at') }}: <strong>{{ $payment->created_at }}</strong></p>
                        <p>{{ trans('plugins/payment::payment.payment_channel') }}: <strong>{{ $payment->payment_channel->label() }}</strong></p>
                        <p>{{ trans('plugins/payment::payment.total') }}: <strong>{{ $payment->amount }} {{ $payment->currency }}</strong></p>
                        <p>{{ trans('plugins/payment::payment.status') }}: <strong>{!! $payment->status->label() !!}</strong></p>
                        {!! $detail !!}
                    </div>
                </div>
                <div class="widget meta-boxes">
                    <div class="widget-title">
                        <h4>
                            <span>{{ trans('plugins/payment::payment.customer_information') }}</span>
                        </h4>
                    </div>
                    <div class="widget-body">
                        <p>{{ trans('plugins/payment::payment.customer_name') }}: <strong>{{ $customer_details->name }}</strong></p>
                        <p>{{ trans('plugins/payment::payment.customer_email') }}: <strong>{{$customer_details->email}}</strong></p>
                        <p>{{ trans('plugins/payment::payment.customer_contact') }}: <strong>{{$customer_details->phone}}</strong></p>
                    </div>
                </div>
                <div class="widget meta-boxes">
                    <div class="widget-title">
                        <h4>
                            <span>{{ trans('plugins/ecommerce::order.order_information') }}  {{ get_order_code($order->id) }} </span>
                        </h4>
                    </div>
                    <div class="widget-body">
                        <div class="pd-all-20 p-none-t border-top-title-main">
                        <div class="table-wrap">
                            <table class="table-order table-divided">
                                <tbody>
                                @foreach ($order->products as $orderProduct)
                                    @php
                                        $product = get_products([
                                            'condition' => [
                                                'ec_products.status' => \Botble\Base\Enums\BaseStatusEnum::PUBLISHED,
                                                'ec_products.id' => $orderProduct->product_id,
                                            ],
                                            'take' => 1,
                                            'select' => [
                                                'ec_products.id',
                                                'ec_products.images',
                                                'ec_products.name',
                                                'ec_products.price',
                                                'ec_products.sale_price',
                                                'ec_products.sale_type',
                                                'ec_products.start_date',
                                                'ec_products.end_date',
                                                'ec_products.sku',
                                                'ec_products.is_variation',
                                            ],
                                        ]);
                                    @endphp

                                    <tr>
                                        @if ($product)
                                            <td class="width-60-px min-width-60-px vertical-align-t">
                                                <div class="wrap-img"><img class="thumb-image thumb-image-cartorderlist" src="{{ RvMedia::getImageUrl($product->original_product->image, 'thumb', false, RvMedia::getDefaultImage()) }}" alt="{{ $orderProduct->product_name }}"></div>
                                            </td>
                                        @endif
                                        <td class="pl5 p-r5 min-width-200-px">
                                            <span class="bold hover-underline pre-line">
                                                {{ $orderProduct->product_name }}</span>
                                            @if ($product)
                                                &nbsp;
                                                @if ($product->sku)
                                                    ({{ trans('plugins/ecommerce::order.sku') }} : <strong>{{ $product->sku }}</strong>)
                                                @endif
                                                @if ($product->is_variation)
                                                    <p class="mb-0">
                                                        <small>
                                                            @php $attributes = get_product_attributes($product->id) @endphp
                                                            @if (!empty($attributes))
                                                                @foreach ($attributes as $attribute)
                                                                    {{ $attribute->attribute_set_title }}: {{ $attribute->title }}@if (!$loop->last), @endif
                                                                @endforeach
                                                            @endif
                                                        </small>
                                                    </p>
                                                @endif
                                            @endif

                                            @if (!empty($orderProduct->options) && is_array($orderProduct->options))
                                                @foreach($orderProduct->options as $option)
                                                    @if (!empty($option['key']) && !empty($option['value']))
                                                        <p class="mb-0"><small>{{ $option['key'] }}: <strong> {{ $option['value'] }}</strong></small></p>
                                                    @endif
                                                @endforeach
                                            @endif

                                            {!! apply_filters(ECOMMERCE_ORDER_DETAIL_EXTRA_HTML, null) !!}
                                            @if ($order->shipment->id)
                                                <ul class="unstyled">
                                                    <li class="simple-note">
                                                       <span>{{ $orderProduct->qty }}</span><span class="text-lowercase"> {{ trans('plugins/ecommerce::order.completed') }}</span>
                                                    </li>
                                                </ul>
                                            @endif
                                        </td>
                                        <td class="pl5 p-r5 text-right">
                                            <div class="inline_block">
                                                <span>{{ format_price($orderProduct->price) }}</span>
                                            </div>
                                        </td>
                                        <td class="pl5 p-r5 text-center">x</td>
                                        <td class="pl5 p-r5">
                                            <span>{{ $orderProduct->qty }}</span>
                                        </td>
                                        <td class="pl5 text-right">{{ format_price($orderProduct->price * $orderProduct->qty) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        </div>
                        <div class="pd-all-20 p-none-t">
                            <div class="flexbox-grid-default block-rps-768">
                                <div class="flexbox-auto-right p-r5">

                                </div>
                                <div class="flexbox-auto-right pl5">
                                    <div class="table-wrap">
                                        <table class="table-normal table-none-border table-color-gray-text">
                                            <tbody>
                                            <tr>
                                                <td class="text-right color-subtext">{{ trans('plugins/ecommerce::order.sub_amount') }}</td>
                                                <td class="text-right pl10">
                                                    <span>{{ format_price($order->sub_total) }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right color-subtext mt10">
                                                    <p class="mb0">{{ trans('plugins/ecommerce::order.discount') }}</p>
                                                    @if ($order->coupon_code)
                                                        <p class="mb0">{!! trans('plugins/ecommerce::order.coupon_code', ['code' => Html::tag('strong', $order->coupon_code)->toHtml()])  !!}</p>
                                                    @elseif ($order->discount_description)
                                                        <p class="mb0">{{ $order->discount_description }}</p>
                                                    @endif
                                                </td>
                                                <td class="text-right p-none-b pl10">
                                                    <p class="mb0">{{ format_price($order->discount_amount) }}</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right color-subtext mt10">
                                                    <p class="mb0">{{ trans('plugins/ecommerce::order.shipping_fee') }}</p>
                                                    <p class="mb0 font-size-12px">{{ $order->shipping_method_name }}</p>
{{--                                                    <p class="mb0 font-size-12px">{{ ecommerce_convert_weight($weight) }} {{ ecommerce_weight_unit(true) }}</p>--}}
                                                </td>
                                                <td class="text-right p-none-t pl10">
                                                    <p class="mb0">{{ format_price($order->shipping_amount) }}</p>
                                                </td>
                                            </tr>
                                            @if (EcommerceHelper::isTaxEnabled())
                                                <tr>
                                                    <td class="text-right color-subtext mt10">
                                                        <p class="mb0">{{ trans('plugins/ecommerce::order.tax') }}</p>
                                                    </td>
                                                    <td class="text-right p-none-t pl10">
                                                        <p class="mb0">{{ format_price($order->tax_amount, $order->currency_id) }}</p>
                                                    </td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td class="text-right mt10">
                                                    <p class="mb0 color-subtext">{{ trans('plugins/ecommerce::order.total_amount') }}</p>
                                                </td>
                                                <td class="text-right text-no-bold p-none-t pl10">
                                                        <span>{{ format_price($order->amount) }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-bottom"></td>
                                                <td class="border-bottom"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-right color-subtext">{{ trans('plugins/ecommerce::order.paid_amount') }}</td>
                                                <td class="text-right color-subtext pl10">

                                                        <span>{{ format_price($order->payment->status == \Botble\Payment\Enums\PaymentStatusEnum::COMPLETED ? $order->payment->amount : 0) }}</span>
                                                </td>
                                            </tr>
                                            @if ($order->payment->status == \Botble\Payment\Enums\PaymentStatusEnum::REFUNDED)
                                                <tr class="hidden">
                                                    <td class="text-right color-subtext">{{ trans('plugins/ecommerce::order.refunded_amount') }}</td>
                                                    <td class="text-right pl10">
                                                        <span>{{ format_price($order->payment->amount) }}</span>
                                                    </td>
                                                </tr>
                                            @endif
                                            <tr class="hidden">
                                                <td class="text-right color-subtext">{{ trans('plugins/ecommerce::order.amount_received') }}</td>
                                                <td class="text-right pl10">
                                                    <span>{{ format_price($order->payment->status == \Botble\Payment\Enums\PaymentStatusEnum::COMPLETED ? $order->amount : 0) }}</span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                @php do_action(BASE_ACTION_META_BOXES, 'advanced', $payment) @endphp
            </div>
            <div class="col-md-3 right-sidebar">
                <div class="widget meta-boxes form-actions form-actions-default action-horizontal">
                    <div class="widget-title">
                        <h4>
                            <span>{{ trans('plugins/payment::payment.action') }}</span>
                        </h4>
                    </div>
                    <div class="widget-body">
                        <div class="btn-set">
                            <button type="submit" name="submit" value="save" class="btn btn-info">
                                <i class="fa fa-save"></i> {{ trans('core/base::forms.save') }}
                            </button>
                            &nbsp;
                            <button type="submit" name="submit" value="apply" class="btn btn-success">
                                <i class="fa fa-check-circle"></i> {{ trans('core/base::forms.save_and_continue') }}
                            </button>
                            &nbsp;
                        </div>
                    </div>
                </div>
                <div class="widget meta-boxes">
                    <div class="widget-title">
                        <h4><label for="status" class="control-label required" aria-required="true">{{ trans('core/base::tables.status') }}</label></h4>
                    </div>
                    <div class="widget-body">
                        {!! Form::customSelect('status', $paymentStatuses, $payment->status) !!}
                    </div>
                </div>
                @php do_action(BASE_ACTION_META_BOXES, 'side', $payment) @endphp
            </div>
        </div>
    {!! Form::close() !!}
@stop
