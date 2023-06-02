
<?php $__env->startSection('title',__('All Manual Payment Transacation')); ?>
<?php $__env->startSection('breadcum'); ?>
	<div class="breadcrumbbar">
        <h4 class="page-title"><?php echo e(__('All Manual Payment Transactions')); ?></h4>
        <div class="breadcrumb-list">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>" title="<?php echo e(__('Dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
              <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('All Manual Payment Transactions')); ?></li>
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
                <h5 class="card-title"> <?php echo e(__("All Manual Payment Transactions")); ?></h5>
          </div>
          
          <div class="card-body">
           
              <div class="table-responsive">
                <table id="roletable" class="table table-borderd responsive " style="width: 100%">

                    <thead>
                      <th><?php echo e(__('#')); ?></th>
                      <th><?php echo e(__('User Name')); ?></th>
                      <th><?php echo e(__('Package')); ?></th>
                      <th><?php echo e(__('Amount')); ?></th>
                      <th><?php echo e(__('Subscription From')); ?></th>
                      <th><?php echo e(__('Subscription To')); ?></th>
                      <th><?php echo e(__('Status')); ?></th>
                      <th><?php echo e(__('Actions')); ?></th>
                    </thead>
                
                    <?php if($manual_payment): ?>
                    <tbody>
                      <?php $__currentLoopData = $manual_payment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($key+1); ?></td>
                          <td><?php echo e($payment->user->name); ?></td>
                          <td><?php echo e($payment->plan->name); ?></td>
                          <td><?php echo e($payment->plan->amount); ?></td>
                          <td><?php echo e(date('F j, Y  g:i:a',strtotime($payment->subscription_from))); ?></td>
                          <td><?php echo e(date('F j, Y  g:i:a',strtotime($payment->subscription_to))); ?></td>
                          <td>
                            <?php if($payment->status == 1): ?>
                              <a href="<?php echo e(url('manualpayment',$payment->id)); ?>" class='badge badge-pill badge-success' title="<?php echo e(__('Active')); ?>"><?php echo e(__('Active')); ?></a>
                            <?php else: ?>
                              <a href="<?php echo e(url('manualpayment',$payment->id)); ?>" class='badge badge-pill badge-danger' title="<?php echo e(__('De-active')); ?>"><?php echo e(__('De-active')); ?></a> 
                            <?php endif; ?>
                          </td>
                          <td>
                            <a href="<?php echo e(url('/images/recipt/'.$payment->file)); ?>" data-toggle="tooltip" data-original-title="Download file" class="btn btn-round btn-outline-success" title="<?php echo e(__('Download')); ?>" download><i class="fa fa-cloud-download"></i></a></td>
                        </tr>
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/admin/manual_payment/index.blade.php ENDPATH**/ ?>