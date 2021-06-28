

<?php $__env->startSection('body-class'); ?> login <?php $__env->stopSection(); ?>
<?php $__env->startSection('body-style'); ?> background-image: url(<?php echo e(get_login_background()); ?>); <?php $__env->stopSection(); ?>

<?php $__env->startPush('header'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="faded-bg animated"></div>
            <div class="hidden-xs col-sm-7 col-md-8">
                <div class="clearfix">
                    <div class="col-sm-12 col-md-10 col-md-offset-2">
                        <div class="logo-title-container">
                            <div class="copy animated fadeIn">
                                <h1><?php echo e(setting('admin_title', config('core.base.general.base_name'))); ?></h1>
                                <p><?php echo clean(trans('core/base::layouts.copyright', ['year' => now()->format('Y'), 'company' => setting('admin_title', config('core.base.general.base_name'))])); ?></p>
                            </div>
                        </div> <!-- .logo-title-container -->
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-5 col-md-4 login-sidebar">

                <div class="login-container">

                    <?php echo $__env->yieldContent('content'); ?>

                    <div style="clear:both"></div>

                </div> <!-- .login-container -->

            </div> <!-- .login-sidebar -->
        </div> <!-- .row -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('core/base::layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Apache24\htdocs\bazaar\platform/core/acl/resources/views//auth/master.blade.php ENDPATH**/ ?>