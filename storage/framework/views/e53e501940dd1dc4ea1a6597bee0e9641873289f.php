<div class="ps-site-features">
    <div class="ps-container">
        <div class="ps-block--site-features">
            <?php for($i = 1; $i <= 5; $i++): ?>
                <?php if(theme_option('feature_' . $i . '_title')): ?>
                    <div class="ps-block__item">
                        <div class="ps-block__left"><i class="<?php echo e(theme_option('feature_' . $i . '_icon')); ?>"></i></div>
                        <div class="ps-block__right">
                            <h4><?php echo e(theme_option('feature_' . $i . '_title')); ?></h4>
                            <p><?php echo e(theme_option('feature_' . $i . '_subtitle')); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
    </div>
</div>
<?php /**PATH C:\Apache24\htdocs\bazaar\platform/themes/martfury/partials/short-codes/site-features.blade.php ENDPATH**/ ?>