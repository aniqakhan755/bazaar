<?php if($category): ?>
    <div class="ps-product-list">
        <product-category-products-component :category="<?php echo e(json_encode($category)); ?>" :children="<?php echo e(json_encode($category->children)); ?>" url="<?php echo e(route('public.ajax.product-category-products')); ?>" all="<?php echo e($category->url); ?>"></product-category-products-component>
    </div>
<?php endif; ?>
<?php /**PATH C:\Apache24\htdocs\bazaar\platform/themes/martfury/partials/short-codes/product-category-products.blade.php ENDPATH**/ ?>