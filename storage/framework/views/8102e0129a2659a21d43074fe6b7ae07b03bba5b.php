<div id="app">
    <?php if($page->template === 'homepage'): ?>
        <?php echo apply_filters(PAGE_FILTER_FRONT_PAGE_CONTENT, clean($page->content, 'youtube'), $page); ?>

    <?php else: ?>
        <?php echo apply_filters(PAGE_FILTER_FRONT_PAGE_CONTENT, clean($page->content, 'youtube'), $page); ?>

    <?php endif; ?>
</div>
<?php /**PATH C:\Apache24\htdocs\bazaar\platform/themes/martfury/views/page.blade.php ENDPATH**/ ?>