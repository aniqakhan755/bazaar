<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li <?php if($category->children->count()): ?> class="menu-item-has-children has-mega-menu" <?php endif; ?>>
        <a href="<?php echo e($category->url); ?>"><?php if(count($category->icon->meta_value) > 0): ?> <i class="<?php echo e($category->icon->meta_value[0]); ?>"></i> <?php endif; ?> <?php echo e($category->name); ?></a>
        <?php if($category->children->count()): ?>
            <span class="sub-toggle"></span>
            <div class="mega-menu">
                <?php $__currentLoopData = $category->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="mega-menu__column">
                        <?php if($childCategory->children->count()): ?>
                            <h4><?php echo e($childCategory->name); ?><span class="sub-toggle"></span></h4>
                            <ul class="mega-menu__list">
                                <?php $__currentLoopData = $childCategory->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a href="<?php echo e($item->url); ?>"><?php echo e($item->name); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php else: ?>
                            <a href="<?php echo e($childCategory->url); ?>"><?php echo e($childCategory->name); ?></a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\Apache24\htdocs\bazaar\platform/themes/martfury/partials/product-categories-dropdown.blade.php ENDPATH**/ ?>