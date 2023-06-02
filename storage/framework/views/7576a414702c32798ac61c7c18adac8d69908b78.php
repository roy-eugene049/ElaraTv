
<?php $__env->startSection('title',__('All Coupons')); ?>
<?php $__env->startSection('breadcum'); ?>
	<div class="breadcrumbbar">
    <h4 class="page-title"><?php echo e(__('All Coupons')); ?></h4>
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>" title="<?php echo e(__('Dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
          <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('All Coupons')); ?></li>
        </ol>
    </div>  
  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('maincontent'); ?>
<div class="contentbar">
<div class="row">
  
  <div class="col-lg-12">
      <div class="card m-b-30">
          <div class="card-header">
            <button type="button" class="float-right btn btn-danger-rgba mr-2 " data-toggle="modal"
            data-target="#bulk_delete" title="<?php echo e(__('Delete Selected')); ?>"><i class="feather icon-trash mr-2"></i> <?php echo e(__('Delete Selected')); ?> </button>
              <a href="<?php echo e(route('coupons.create')); ?>" class="float-right btn btn-primary-rgba mr-2" title="<?php echo e(__('Create Coupon')); ?>"><i
                  class="feather icon-plus mr-2"></i><?php echo e(__('Create Coupon')); ?></a>
                  <div id="bulk_delete" class="delete-modal modal fade" role="dialog">
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
                                <?php echo Form::open(['method' => 'POST', 'action' => 'CouponController@bulk_delete', 'id' => 'bulk_delete_form']); ?>

                                    <?php echo method_field('POST'); ?>
                                    <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal"><?php echo e(__('No')); ?></button>
                                    <button type="submit" class="btn btn-danger"><?php echo e(__('Yes')); ?></button>
                                <?php echo Form::close(); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <h5 class="card-title"> <?php echo e(__("All Coupons")); ?></h5>
          </div>
          
          <div class="card-body">
           
              <div class="table-responsive">
                <table id="roletable" class="table table-borderd responsive " style="width: 100%">

                    <thead>
                      <th>
                        <div class="inline">
                          <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
                          <label for="checkboxAll" class="material-checkbox">#</label>
                        </div>
                      </th>
                      <th><?php echo e(__('Coupon Code')); ?></th>
                      <th><?php echo e(__('Percent Off')); ?></th>
                      <th><?php echo e(__('Amount Off')); ?></th>
                      <th><?php echo e(__('Duration')); ?></th>
                      <th><?php echo e(__('Duration in Months')); ?></th>
                      <th><?php echo e(__('Max Redemption')); ?></th>
                      <th><?php echo e(__('Valid Upto')); ?></th>
                      <th><?php echo e(__('Actions')); ?></th>
                    </thead>
                
                    <tbody>
              <?php if($coupons): ?>
                <tbody>
                  <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td>
                        <div class="inline">
                          <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="<?php echo e($coupon->id); ?>" id="checkbox<?php echo e($coupon->id); ?>">
                          <label for="checkbox<?php echo e($coupon->id); ?>" class="material-checkbox"><?php echo e($key+1); ?></label>
                        </div>
                      </td>
                      <td><?php echo e($coupon->coupon_code); ?></td>
                      <td><?php echo e($coupon->percent_off ? $coupon->percent_off.'%' : '-'); ?></td>
                      <td>
                        <?php if($coupon->amount_off): ?>
                          <i class="<?php echo e($currency_symbol); ?> main-curr"></i><?php echo e($coupon->amount_off); ?>

                        <?php endif; ?>
                      </td>
                      <td><?php echo e($coupon->duration); ?></td>
                      <td><?php echo e($coupon->duration_in_months); ?></td>
                      <td><?php echo e($coupon->max_redemptions); ?></td>
                      <td><?php echo e(date('F d, Y',strtotime($coupon->redeem_by))); ?></td>
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('coupon.delete')): ?>
                      <td>
                        <?php if($coupon->in_stripe != 1): ?>
                        <div class="admin-table-action-block">
                          <a href="<?php echo e(route('coupons.edit', $coupon->id)); ?>"  title="<?php echo e(__('Edit')); ?>" data-toggle="" data-original-title="<?php echo e(__('Edit')); ?>" class="btn btn-round btn-outline-primary"> <i class="fa fa-edit"></i></a>
                        </div>
                        <?php endif; ?>
                        <div class="admin-table-action-block">
                          <button type="button" class="btn btn-round btn-outline-danger" data-toggle="modal" data-target="#delete<?php echo e($coupon->id); ?>" title="<?php echo e(__('Delete')); ?>"><i class="fa fa-trash"></i> </button>
                        </div>
                      </td>
                      <?php endif; ?>
                    </tr>

                    <div id="delete<?php echo e($coupon->id); ?>" class="delete-modal modal fade" role="dialog">
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
                                <?php echo Form::open(['method' => 'DELETE', 'action' => ['CouponController@destroy', $coupon->id]]); ?>

                                      <?php echo method_field('DELETE'); ?>
                                      <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal"><?php echo e(__('No')); ?></button>
                                      <button type="submit" class="btn btn-danger"><?php echo e(__('Yes')); ?></button>
                                  <?php echo Form::close(); ?>

                              </div>
                          </div>
                      </div>
                  </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?> 
<?php $__env->startSection('script'); ?>
<script>
  $(function(){
    $('#checkboxAll').on('change', function(){
      if($(this).prop("checked") == true){
        $('.material-checkbox-input').attr('checked', true);
      }
      else if($(this).prop("checked") == false){
        $('.material-checkbox-input').attr('checked', false);
      }
    });
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/admin/coupon/index.blade.php ENDPATH**/ ?>