<span class="log-icon log-icon-<?php echo e($history->type); ?>"></span>
<span>
    <?php if($history->user->id): ?>
        <a href="<?php echo e(route('users.profile.view', $history->user->id)); ?>"><?php echo e($history->user->getFullName()); ?></a>
    <?php else: ?>
        <span><?php echo e(trans('plugins/audit-log::history.system')); ?></span>
    <?php endif; ?>
    <?php if(Lang::has('plugins/audit-log::history.' . $history->action)): ?> <?php echo e(trans('plugins/audit-log::history.' . $history->action)); ?> <?php else: ?> <?php echo e($history->action); ?> <?php endif; ?>
    <?php if($history->module): ?>
        <?php if(Lang::has('plugins/audit-log::history.' . $history->module)): ?> <?php echo e(trans('plugins/audit-log::history.' . $history->module)); ?> <?php else: ?> <?php echo e($history->module); ?> <?php endif; ?>
    <?php endif; ?>
    <?php if($history->reference_name): ?>
        <?php if(empty($history->user) || $history->user->getFullName() != $history->reference_name): ?>
            "<?php echo e(Str::limit($history->reference_name, 40)); ?>"
        <?php endif; ?>
    <?php endif; ?>
    .
</span>
<span class="small italic"><?php echo e($history->created_at->diffForHumans()); ?> </span>
<span>(<a href="https://whatismyipaddress.com/ip/<?php echo e($history->ip_address); ?>" target="_blank" title="<?php echo e($history->ip_address); ?>" rel="nofollow"><?php echo e($history->ip_address); ?></a>)</span>
<?php /**PATH C:\Apache24\htdocs\bazaar\platform/plugins/audit-log/resources/views//activity-line.blade.php ENDPATH**/ ?>