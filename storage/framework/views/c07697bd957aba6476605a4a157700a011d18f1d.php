<script>
    jQuery(document).ready(function () {

        $("<?php echo e($validator['selector']); ?>").each(function () {
            $(this).validate({
                errorElement: 'span',
                errorClass: 'invalid-feedback',

                errorPlacement: function (error, element) {
                    if (element.parent('.input-group').length ||
                        element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function (element) {
                    $(element).closest('.form-control').removeClass('is-valid').addClass('is-invalid');
                },

                <?php if(isset($validator['ignore']) && is_string($validator['ignore'])): ?>
                    ignore: "<?php echo e($validator['ignore']); ?>",
                <?php endif; ?>


                unhighlight: function (element) {
                    $(element).closest('.form-control').removeClass('is-invalid').addClass('is-valid');
                },

                success: function (element) {
                    $(element).closest('.form-control').removeClass('is-invalid').addClass('is-valid');
                },

                focusInvalid: false,
                <?php if(config('core.js-validation.js-validation.focus_on_error')): ?>
                invalidHandler: function (form, validator) {

                    if (!validator.numberOfInvalids())
                        return;

                    $('html, body').animate({
                        scrollTop: $(validator.errorList[0].element).offset().top
                    }, <?php echo e(config('core.js-validation.js-validation.duration_animate')); ?>);
                    $(validator.errorList[0].element).focus();

                },
                <?php endif; ?>

                rules: <?php echo json_encode($validator['rules']); ?>

            });
        });
    });
</script>
<?php /**PATH C:\Apache24\htdocs\bazaar\platform/core/js-validation/resources/views//bootstrap.blade.php ENDPATH**/ ?>