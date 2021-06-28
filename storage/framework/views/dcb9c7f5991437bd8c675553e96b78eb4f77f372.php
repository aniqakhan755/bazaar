<div class="ps-product-list mb-60">
    <product-collections-component title="<?php echo clean($title); ?>" :product_collections="<?php echo e(json_encode($productCollections)); ?>" url="<?php echo e(route('public.ajax.products')); ?>" all="<?php echo e(route('public.products')); ?>"></product-collections-component>
</div>
<?php /**PATH C:\Apache24\htdocs\bazaar\platform/themes/martfury/partials/short-codes/product-collections.blade.php ENDPATH**/ ?>