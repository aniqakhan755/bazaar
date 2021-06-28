<div class="ps-newsletter mt-40">
    <div class="ps-container newsletter-form">
        <form class="ps-form--newsletter" method="post" action="<?php echo e(route('public.newsletter.subscribe')); ?>">
            <div class="row">
                <div class="col-xl-5">
                    <div class="ps-form__left">
                        <h3><?php echo clean($title); ?></h3>
                        <p><?php echo clean($description); ?></p>
                    </div>
                </div>
                <div class="col-xl-7">
                    <div class="ps-form__right">
                        <?php echo csrf_field(); ?>
                        <div class="form-group--nest">
                            <input class="form-control" name="email" type="email" placeholder="<?php echo e(__('Email address')); ?>">
                            <button class="ps-btn" type="submit"><?php echo e(__('Subscribe')); ?></button>
                        </div>
                        <?php if(setting('enable_captcha') && is_plugin_active('captcha')): ?>
                            <?php echo Captcha::display(); ?>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php /**PATH C:\Apache24\htdocs\bazaar\platform/themes/martfury/partials/short-codes/newsletter-form.blade.php ENDPATH**/ ?>