<?php
    SeoHelper::setTitle(__('Vendor Registration Success'));
    Theme::fire('beforeRenderTheme', app(\Botble\Theme\Contracts\Theme::class));
?>

<?php echo Theme::partial('header'); ?>


<div class="ps-page--404 page-registration-success">
    <div class="container">
        <div class="ps-section__content">
            <img class="registration-image" src="<?php echo e(Theme::asset()->url('img/check.png')); ?>" alt="thank you">
            <h3><?php echo e(__('Thank you !')); ?></h3>
            <p><?php echo e(__("Your information has been successfully submitted.")); ?><strong> Check your email </strong>for further instructions on <strong>account activation.</strong></p>
            <a class="btn btn-primary btn-lg p-3
" href="<?php echo e(url('/')); ?>"> <?php echo e(__('Continue to Website')); ?></a>
        </div>
    </div>
</div>

<?php echo Theme::partial('footer'); ?>



<?php /**PATH C:\Apache24\htdocs\bazaar\platform/core/acl/resources/views//auth/register-success.blade.php ENDPATH**/ ?>