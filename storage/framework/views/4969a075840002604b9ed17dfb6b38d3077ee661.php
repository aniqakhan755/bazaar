 <footer class="ps-footer">
        <div class="ps-container">
            <div class="ps-footer__widgets">
                <aside class="widget widget_footer widget_contact-us">
                    <h4 class="widget-title"><?php echo e(__('Contact us')); ?></h4>
                    <div class="widget_content">
                        <p><?php echo e(__('Call us 24/7')); ?></p>
                        <h3><?php echo e(theme_option('hotline')); ?></h3>
                        <p><?php echo e(theme_option('address')); ?> <br><a href="mailto:<?php echo e(theme_option('email')); ?>"><?php echo e(theme_option('email')); ?></a></p>
                        <ul class="ps-list--social">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <?php if(theme_option('social-name-' . $i) && theme_option('social-url-' . $i) && theme_option('social-icon-' . $i)): ?>
                                    <li>
                                        <a href="<?php echo e(theme_option('social-url-' . $i)); ?>"
                                           title="<?php echo e(theme_option('social-name-' . $i)); ?>" style="color: <?php echo e(theme_option('social-color-' . $i)); ?>">
                                            <i class="fa <?php echo e(theme_option('social-icon-' . $i)); ?>"></i>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </ul>
                    </div>
                </aside>
                <?php echo dynamic_sidebar('footer_sidebar'); ?>

            </div>
            <div class="ps-footer__links" id="footer-links">
                <?php echo dynamic_sidebar('bottom_footer_sidebar'); ?>

            </div>
            <div class="ps-footer__copyright">
                <p><?php echo e(theme_option('copyright')); ?></p>
                <p>
                    <span><?php echo e(__('We Using Safe Payment For')); ?>:</span>
                    <?php $__currentLoopData = json_decode(theme_option('payment_methods', []), true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!empty($method)): ?>
                            <span><img src="<?php echo e(RvMedia::getImageUrl($method)); ?>" alt="payment method"></span>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </p>
            </div>
        </div>
    </footer>

    <?php if(is_plugin_active('newsletter') && theme_option('enable_newsletter_popup', 'yes') === 'yes'): ?>
        <div data-session-domain="<?php echo e(config('session.domain') ?? request()->getHost()); ?>"></div>
        <div class="ps-popup" id="subscribe" data-time="<?php echo e((int)theme_option('newsletter_show_after_seconds', 10) * 1000); ?>" style="display: none">
            <div class="ps-popup__content bg--cover" data-background="<?php echo e(RvMedia::getImageUrl(theme_option('newsletter_image'))); ?>" style="background-size: cover!important;"><a class="ps-popup__close" href="#"><i class="icon-cross"></i></a>
                <form method="post" action="<?php echo e(route('public.newsletter.subscribe')); ?>" class="ps-form--subscribe-popup newsletter-form">
                    <?php echo csrf_field(); ?>
                    <div class="ps-form__content">
                        <h4><?php echo e(__('Get 25% Discount')); ?></h4>
                        <p><?php echo e(__('Subscribe to the mailing list to receive updates on new arrivals, special offers and our promotions.')); ?></p>
                        <div class="form-group">
                            <input class="form-control" name="email" type="email"  placeholder="<?php echo e(__('Email Address')); ?>" required>
                        </div>

                        <?php if(setting('enable_captcha') && is_plugin_active('captcha')): ?>
                            <div class="form-group">
                                <?php echo Captcha::display(); ?>

                            </div>
                        <?php endif; ?>

                        <div class="form-group">
                            <button class="ps-btn" type="submit" ><?php echo e(__('Subscribe')); ?></button>
                        </div>
                        <div class="ps-checkbox">
                            <input class="form-control" type="checkbox" id="dont_show_again" name="dont_show_again">
                            <label for="dont_show_again"><?php echo e(__("Don't show this popup again")); ?></label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>

    <?php echo Theme::get('bottomFooter'); ?>


    <div id="back2top"><i class="icon icon-arrow-up"></i></div>
    <div class="ps-site-overlay"></div>
    <?php if(is_plugin_active('ecommerce')): ?>
        <div class="ps-search" id="site-search"><a class="ps-btn--close" href="#"></a>
            <div class="ps-search__content">
                <form class="ps-form--primary-search" action="<?php echo e(route('public.products')); ?>" method="post">
                    <input class="form-control" name="q" value="<?php echo e(request()->query('q')); ?>" type="text" placeholder="<?php echo e(__('Search for...')); ?>">
                    <button><i class="aroma-magnifying-glass"></i></button>
                </form>
            </div>
        </div>
    <?php endif; ?>
    <div class="modal fade" id="product-quickview" tabindex="-1" role="dialog" aria-labelledby="product-quickview" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content"><span class="modal-close" data-dismiss="modal"><i class="icon-cross2"></i></span>
                <article class="ps-product--detail ps-product--fullwidth ps-product--quickview">
                </article>
            </div>
        </div>
    </div>

    <script>
        window.trans = {
            "View All": "<?php echo e(__('View All')); ?>",
        }
        window.siteUrl = "<?php echo e(url('')); ?>";
    </script>

    <?php echo Theme::footer(); ?>


     <?php if(session()->has('success_msg') || session()->has('error_msg') || (isset($errors) && $errors->count() > 0) || isset($error_msg)): ?>
         <script type="text/javascript">
             $(document).ready(function () {
                 <?php if(session()->has('success_msg')): ?>
                    window.showAlert('alert-success', '<?php echo e(session('success_msg')); ?>');
                 <?php endif; ?>

                 <?php if(session()->has('error_msg')): ?>
                    window.showAlert('alert-danger', '<?php echo e(session('error_msg')); ?>');
                 <?php endif; ?>

                 <?php if(isset($error_msg)): ?>
                    window.showAlert('alert-danger', '<?php echo e($error_msg); ?>');
                 <?php endif; ?>

                 <?php if(isset($errors)): ?>
                     <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        window.showAlert('alert-danger', '<?php echo $error; ?>');
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 <?php endif; ?>
             });
         </script>
     <?php endif; ?>
    </body>
</html>
<?php /**PATH C:\Apache24\htdocs\bazaar\platform/themes/martfury/partials/footer.blade.php ENDPATH**/ ?>