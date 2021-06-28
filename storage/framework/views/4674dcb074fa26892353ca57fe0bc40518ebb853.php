<div class="ps-cart__content">
    <?php if(Cart::instance('cart')->count() > 0): ?>
        <div class="ps-cart__items">
            <div class="ps-cart__items__body">
                <?php
                    $products = [];
                    $productIds = Cart::instance('cart')->content()->pluck('id')->toArray();

                    if ($productIds) {
                        $products = get_products([
                            'condition' => [
                                ['ec_products.id', 'IN', $productIds],
                            ],
                            'with' => ['slugable'],
                        ]);
                    }
                ?>
                <?php if(count($products)): ?>
                    <?php $__currentLoopData = Cart::instance('cart')->content(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cartItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $product = $products->where('id', $cartItem->id)->first();
                        ?>

                        <?php if(!empty($product)): ?>
                            <div class="ps-product--cart-mobile">
                                <div class="ps-product__thumbnail">
                                    <a href="<?php echo e($product->original_product->url); ?>"><img src="<?php echo e($cartItem->options['image']); ?>" alt="<?php echo e($product->name); ?>" /></a>
                                </div>
                                <div class="ps-product__content">
                                    <a class="ps-product__remove remove-cart-item" href="<?php echo e(route('public.cart.remove', $cartItem->rowId)); ?>"><i class="icon-cross"></i></a>
                                    <a href="<?php echo e($product->original_product->url); ?>"> <?php echo e($product->name); ?></a>
                                    <p class="mb-0"><small><?php echo e($cartItem->qty); ?> x <?php echo e(format_price($cartItem->price)); ?></small></p>
                                    <p class="mb-0"><small><small><?php echo e($cartItem->options['attributes'] ?? ''); ?></small></small></p>
                                    <?php if(!empty($cartItem->options['extras']) && is_array($cartItem->options['extras'])): ?>
                                        <?php $__currentLoopData = $cartItem->options['extras']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(!empty($option['key']) && !empty($option['value'])): ?>
                                                <p class="mb-0"><small><?php echo e($option['key']); ?>: <strong> <?php echo e($option['value']); ?></strong></small></p>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="ps-cart__footer">
            <?php if(EcommerceHelper::isTaxEnabled()): ?>
                <h5><?php echo e(__('Sub Total')); ?>:<strong><?php echo e(format_price(Cart::instance('cart')->rawSubTotal())); ?></strong></h5>
                <h5><?php echo e(__('Tax')); ?>:<strong><?php echo e(format_price(Cart::instance('cart')->rawTax())); ?></strong></h5>
                <h3><?php echo e(__('Total')); ?>:<strong><?php echo e(format_price(Cart::instance('cart')->rawSubTotal() + Cart::instance('cart')->rawTax())); ?></strong></h3>
            <?php else: ?>
                <h3><?php echo e(__('Sub Total')); ?>:<strong><?php echo e(format_price(Cart::instance('cart')->rawSubTotal())); ?></strong></h3>
            <?php endif; ?>
            <figure>
                <a class="ps-btn" href="<?php echo e(route('public.cart')); ?>"><?php echo e(__('View Cart')); ?></a>
                <?php if(session('tracked_start_checkout')): ?>
                    <a href="<?php echo e(route('public.checkout.information', session('tracked_start_checkout'))); ?>" class="ps-btn"><?php echo e(__('Checkout')); ?></a>
                <?php endif; ?>
            </figure>
        </div>
    <?php else: ?>
        <div class="ps-cart__items ps-cart_no_items">
            <span class="cart-empty-message"><?php echo e(__('No products in the cart.')); ?></span>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH C:\Apache24\htdocs\bazaar\platform/themes/martfury/partials/cart.blade.php ENDPATH**/ ?>