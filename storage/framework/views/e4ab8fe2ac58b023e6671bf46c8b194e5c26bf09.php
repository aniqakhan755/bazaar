<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php echo e(trans('plugins/ecommerce::order.invoice_for_order')); ?> <?php echo e(get_order_code($order->id)); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('vendor/core/plugins/ecommerce/css/invoice.css')); ?>">
</head>
<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="5">
                    <table>
                        <tr>
                            <td style="width: 150px;">
                                <?php if(theme_option('logo')): ?>
                                    <img src="<?php echo e(RvMedia::getImageUrl(theme_option('logo'))); ?>" style="width:100%; max-width:150px;" alt="<?php echo e(theme_option('site_title')); ?>">
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php echo e(trans('plugins/ecommerce::order.invoice')); ?>: <?php echo e(get_order_code($order->id)); ?><br>
                                <?php echo e(trans('plugins/ecommerce::order.created')); ?>: <?php echo e(now()->format('F d, Y')); ?><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="5">
                    <table>
                        <tr>
                            <td>
                                <?php echo e($order->address->name); ?><br>
                                <?php echo e($order->address->address); ?><br>
                                <?php echo e($order->address->email); ?> <br>
                                <?php echo e($order->address->phone ?? 'N/A'); ?>

                            </td>

                            <td>
                                <?php echo e($order->user->name ? $order->user->name : $order->address->name); ?><br>
                                <?php echo e($order->user->email ? $order->user->email : $order->address->email); ?><br>
                                <?php echo e($order->user->phone ? $order->user->phone : $order->address->phone); ?>

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td colspan="4">
                    <?php echo e(trans('plugins/ecommerce::order.payment_method')); ?>

                </td>

                <td>
                    <?php echo e(trans('plugins/ecommerce::order.payment_status_label')); ?>

                </td>
            </tr>

            <tr class="details">
                <td colspan="4">
                    <?php echo e($order->payment->payment_channel->label()); ?>

                </td>

                <td>
                    <?php echo e($order->payment->status->label()); ?>

                </td>
            </tr>

            <tr class="heading">
                <th><?php echo e(trans('plugins/ecommerce::products.form.product')); ?></th>
                <th><?php echo e(trans('plugins/ecommerce::products.form.options')); ?></th>
                <th><?php echo e(trans('plugins/ecommerce::products.form.price')); ?></th>
                <th><?php echo e(trans('plugins/ecommerce::products.form.quantity')); ?></th>
                <th><?php echo e(trans('plugins/ecommerce::products.form.total')); ?></th>
            </tr>

            <?php $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
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
                        ],
                    ]);
                ?>
                <?php if(!empty($product)): ?>
                    <tr class="item">
                        <td><?php echo e($product->name); ?></td>
                        <td>
                            <?php $attributes = get_product_attributes($product->id); ?>
                            <?php if(!empty($attributes)): ?>
                                <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!$loop->last): ?>
                                        <?php echo e($attribute->attribute_set_title); ?>: <?php echo e($attribute->title); ?> <br>
                                    <?php else: ?>
                                        <?php echo e($attribute->attribute_set_title); ?>: <?php echo e($attribute->title); ?>

                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <?php if(!empty($orderProduct->options) && is_array($orderProduct->options)): ?>
                                <?php $__currentLoopData = $orderProduct->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!empty($option['key']) && !empty($option['value'])): ?>
                                        <p class="mb-0"><small><?php echo e($option['key']); ?>: <strong> <?php echo e($option['value']); ?></strong></small></p>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($product->front_sale_price != $product->price): ?>
                                <?php echo htmlentities(format_price($product->front_sale_price)); ?>

                                <del><?php echo htmlentities(format_price($product->price)); ?></del>
                            <?php else: ?>
                                <?php echo htmlentities(format_price($product->price)); ?>

                            <?php endif; ?>
                        </td>
                        <td> <?php echo e($orderProduct->qty); ?> </td>
                        <td>
                            <?php if($product->front_sale_price != $product->price): ?>
                                <?php echo htmlentities(format_price($product->front_sale_price * $orderProduct->qty)); ?>

                            <?php else: ?>
                                <?php echo htmlentities(format_price($product->price * $orderProduct->qty)); ?>

                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <tr class="total">
                <td colspan="4">&nbsp;</td>
                <td style="width: 50%">
                    <p><?php echo e(trans('plugins/ecommerce::products.form.sub_total')); ?>: <?php echo htmlentities(format_price($order->sub_total)); ?></p>
                    <p><?php echo e(trans('plugins/ecommerce::products.form.shipping_fee')); ?>: <?php echo htmlentities(format_price($order->shipping_amount)); ?></p>
                    <p><?php echo e(trans('plugins/ecommerce::products.form.discount')); ?>: <?php echo htmlentities(format_price($order->discount_amount)); ?></p>
                    <p><?php echo e(trans('plugins/ecommerce::products.form.total')); ?>: <?php echo htmlentities(format_price($order->amount)); ?></p>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
<?php /**PATH C:\Apache24\htdocs\bazaar\platform/plugins/ecommerce/resources/views//invoices/template.blade.php ENDPATH**/ ?>