<div class="dropdown">
  <button class="btn btn-round btn-outline-primary" type="button"
      id="CustomdropdownMenuButton1" data-toggle="dropdown"
      aria-haspopup="true" aria-expanded="false" title="<?php echo e(__('Action')); ?>"><i
          class="feather icon-more-vertical-"></i></button>
  <div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton1">
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('users.edit')): ?>
      <a class="dropdown-item" href="<?php echo e(route('users.edit',$id)); ?>" title="<?php echo e(__('Edit')); ?>"><i class="feather icon-edit mr-2"></i><?php echo e(__("Edit")); ?></a>
      <a class="dropdown-item" href="<?php echo e(route('change_subscription_show',$id)); ?>" title="<?php echo e(__('Change Subcription')); ?>"><i class="fa fa-exchange mr-2"></i><?php echo e(__("Change Subcription")); ?></a>
      <?php endif; ?>
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('users.delete')): ?>
      <a class="dropdown-item btn btn-link" data-toggle="modal" data-target="#delete<?php echo e($id); ?>" title="<?php echo e(__('Delete')); ?>">


          <i class="feather icon-delete mr-2"></i><?php echo e(__("Delete")); ?></a>
      </a>
      <?php endif; ?>
  </div>
</div>

<!-- delete Modal start -->
<div class="modal fade bd-example-modal-sm" id="delete<?php echo e($id); ?>"
  tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleSmallModalLabel"><?php echo e(__('Delete')); ?></h5>
              <button type="button" class="close" data-dismiss="modal"
                  aria-label="Close" title="<?php echo e(__('Close')); ?>">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <h4><?php echo e(__('Are You Sure ?')); ?></h4>
              <p><?php echo e(__('Do you really want to delete')); ?>

                  <b><?php echo e($name); ?></b>?
                  <?php echo e(__('This process cannot be undone.')); ?></p>
          </div>
          <div class="modal-footer">
              <form method="post"
                  action="<?php echo e(route("users.destroy", $id)); ?>"
                  class="pull-right">
                  <?php echo e(csrf_field()); ?>

                  <?php echo e(method_field("DELETE")); ?>

                  <button type="reset" class="btn btn-secondary"
                      data-dismiss="modal"><?php echo e(__('No')); ?></button>
                  <button type="submit" class="btn btn-primary"><?php echo e(__('Yes')); ?></button>
              </form>
          </div>
      </div>
  </div>
</div>
<!-- delete Model ended --><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/admin/users/action.blade.php ENDPATH**/ ?>