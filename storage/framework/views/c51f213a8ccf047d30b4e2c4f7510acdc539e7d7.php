<?php if($flashSale): ?>
    <div class="ps-deal-of-day">
        <div class="ps-container">
            <div class="ps-section__header">
                <div class="ps-block--countdown-deal">
                    <div class="ps-block__left">
                        <h3><?php echo isset($title) ? clean($title) : $flashSale->name; ?></h3>
                    </div>
                    <div class="ps-block__right">
                        <figure>
                            <figcaption><?php echo e(__('End in')); ?>:</figcaption>
                            <ul class="ps-countdown" data-time="<?php echo e($flashSale->end_date); ?>">
                                <li><span class="days"></span></li>
                                <li><span class="hours"></span></li>
                                <li><span class="minutes"></span></li>
                                <li><span class="seconds"></span></li>
                            </ul>
                        </figure>
                    </div>
                </div>
    <!--            <a href="#"><?php echo e(__('View all')); ?></a>-->
            </div>
            <flash-sale-products-component url="<?php echo e(route('public.ajax.get-flash-sale', $flashSale->id)); ?>"></flash-sale-products-component>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\Apache24\htdocs\bazaar\platform/themes/martfury/partials/short-codes/flash-sale.blade.php ENDPATH**/ ?>