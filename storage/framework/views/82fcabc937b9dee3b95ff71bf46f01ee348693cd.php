<?php if($url != NULL): ?>
<a href="<?php echo e(url($url)); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('Manage Settings')); ?>" class="btn btn-round btn-outline-primary" title="<?php echo e(__('Settings')); ?>"><i class="feather icon-settings"></i></a>
<?php endif; ?>
<button type="button" data-toggle="modal" data-target="#delete<?php echo e($name); ?>" class="btn btn-round btn-outline-danger"  title="<?php echo e(__('Delete')); ?>">
  <i class="fa fa-trash"></i>
</button>

    <div id="delete<?php echo e($name); ?>" class="delete-modal modal fade" role="dialog">
      <div class="modal-dialog modal-sm">
          <!-- Modal content-->
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close"
                      data-dismiss="modal"  title="<?php echo e(__('Close')); ?>">&times;</button>
                  <div class="delete-icon"></div>
              </div>
              <div class="modal-body text-center">
                  <h4 class="modal-heading"><?php echo e(__('Are You Sure ?')); ?></h4>
                  <p><?php echo e(__('Do you really want to delete selected item names here? This
                      process
                      cannot be undone.')); ?></p>
              </div>
              <div class="modal-footer">
                <form method="post" action="<?php echo e(route('addon.delete')); ?>" class="pull-right">
                  <?php echo csrf_field(); ?>
                  <input type="hidden" name="modulename" value="<?php echo e($name); ?>">
                  <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal"><?php echo e(__('No')); ?></button>
                      <button type="submit" class="btn btn-danger"><?php echo e(__('Yes')); ?></button>
                </form>
              </div>
          </div>
      </div>
  </div><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/admin/addonmanager/action.blade.php ENDPATH**/ ?>