<div class="ps-product-list mt-40 mb-40">
    <div class="ps-container">
        <div class="ps-section__header">
            <h3><?php echo clean($title); ?></h3>
            <ul class="ps-section__links">
                <li><a href="<?php echo e(route('public.products')); ?>"><?php echo e(__('View All')); ?></a></li>
            </ul>
        </div>
        <featured-products-component url="<?php echo e(route('public.ajax.featured-products')); ?>"></featured-products-component>
    </div>
</div>

<?php /**PATH C:\Apache24\htdocs\bazaar\platform/themes/martfury/partials/short-codes/featured-products.blade.php ENDPATH**/ ?>