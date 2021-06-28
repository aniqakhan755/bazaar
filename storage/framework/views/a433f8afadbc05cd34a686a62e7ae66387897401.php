<?php if($product): ?>
    <div class="ps-product__thumbnail">
        <a href="<?php echo e($product->url); ?>">
            <img src="<?php echo e(RvMedia::getImageUrl($product->image, 'small', false, RvMedia::getDefaultImage())); ?>" alt="<?php echo e($product->name); ?>">
        </a>
        <?php if($product->front_sale_price !== $product->price): ?>
            <div class="ps-product__badge"><?php echo e(get_sale_percentage($product->price, $product->front_sale_price)); ?></div>
        <?php endif; ?>
        <ul class="ps-product__actions">
            <?php if(EcommerceHelper::isCartEnabled()): ?>
                <li><a class="add-to-cart-button" data-id="<?php echo e($product->id); ?>" href="<?php echo e(route('public.cart.add-to-cart')); ?>" title="<?php echo e(__('Add To Cart')); ?>"><i class="icon-bag2"></i></a></li>
            <?php endif; ?>
            <li><a href="<?php echo e(route('public.ajax.quick-view', $product->id)); ?>" title="<?php echo e(__('Quick View')); ?>" class="js-quick-view-button"><i class="icon-eye"></i></a></li>
            <li><a class="js-add-to-wishlist-button" href="<?php echo e(route('public.wishlist.add', $product->id)); ?>" title="<?php echo e(__('Add to Wishlist')); ?>"><i class="icon-heart"></i></a></li>
            <li><a class="js-add-to-compare-button" href="<?php echo e(route('public.compare.add', $product->id)); ?>" title="<?php echo e(__('Compare')); ?>"><i class="icon-chart-bars"></i></a></li>
        </ul>
    </div>
    <div class="ps-product__container">
        <div class="ps-product__content"><a class="ps-product__title" href="<?php echo e($product->url); ?>"><?php echo e($product->name); ?></a>
            <?php if(EcommerceHelper::isReviewEnabled()): ?>
                <?php $countRating = get_count_reviewed_of_product($product->id); ?>
                <?php if($countRating > 0): ?>
                    <div class="rating_wrap">
                        <div class="rating">
                            <div class="product_rate" style="width: <?php echo e(get_average_star_of_product($product->id) * 20); ?>%"></div>
                        </div>
                        <span class="rating_num">(<?php echo e($countRating); ?>)</span>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <p class="ps-product__price <?php if($product->front_sale_price !== $product->price): ?> sale <?php endif; ?>"><?php echo e(format_price($product->front_sale_price_with_taxes)); ?> <?php if($product->front_sale_price !== $product->price): ?> <del><?php echo e(format_price($product->price_with_taxes)); ?> </del> <?php endif; ?></p>
        </div>
        <div class="ps-product__content hover"><a class="ps-product__title" href="<?php echo e($product->url); ?>"><?php echo e($product->name); ?></a>
            <p class="ps-product__price <?php if($product->front_sale_price !== $product->price): ?> sale <?php endif; ?>"><?php echo e(format_price($product->front_sale_price_with_taxes)); ?> <?php if($product->front_sale_price !== $product->price): ?> <del><?php echo e(format_price($product->price_with_taxes)); ?> </del> <?php endif; ?></p>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\Apache24\htdocs\bazaar\platform/themes/martfury/partials/product-item.blade.php ENDPATH**/ ?>