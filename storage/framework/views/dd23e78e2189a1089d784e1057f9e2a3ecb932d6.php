<!-- This will show you edit and delete action -->
<div class="dropdown">
    <a href="<?php echo e(url('/admin/checkout-currency', $id)); ?>" class="btn btn-round btn-outline-primary" title="<?php echo e(__('Settings')); ?>"><i class="feather icon-settings"></i></a>
    <button type="button" class="btn btn-round btn-outline-danger" data-toggle="modal" data-target="#deleteModal<?php echo e($id); ?>" title="<?php echo e(__('Delete')); ?>"><i class="fa fa-trash"></i> </button>
    
    
    <!-- Modal -->
    <div id="deleteModal<?php echo e($id); ?>" class="delete-modal modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close"
                        data-dismiss="modal" title="<?php echo e(__('Close')); ?>">&times;</button>
                    <div class="delete-icon"></div>
                </div>
                <div class="modal-body text-center">
                    <h4 class="modal-heading"><?php echo e(__('Are You Sure ?')); ?></h4>
                    <p><?php echo e(__('Do you really want to delete selected item names here? This
                        process
                        cannot be undone.')); ?></p>
                </div>
                <div class="modal-footer">
                    <form method="post" action="<?php echo e(route('currency.destroy',$code)); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="modulename" value="<?php echo e($name); ?>">
                    <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal"><?php echo e(__('No')); ?></button>
                        <button type="submit" class="btn btn-danger"><?php echo e(__('Yes')); ?></button>
                  </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Model ended -->
</div><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/admin/currency/action.blade.php ENDPATH**/ ?>