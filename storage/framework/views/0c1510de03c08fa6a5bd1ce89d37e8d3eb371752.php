
<?php $__env->startSection('title',__('Change Subscription')." ". $user->name); ?>
<?php $__env->startSection('breadcum'); ?>
	<div class="breadcrumbbar">
    <h4 class="page-title"><?php echo e(__('Change Subscription')); ?></h4>
    <div class="breadcrumb-list">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>" title="<?php echo e(__('Dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Edit Subscription Plan')); ?></li>
      </ol>
    </div>     
  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('maincontent'); ?>
<div class="contentbar">
  <div class="row">
    <?php if($errors->any()): ?>  
    <div class="alert alert-danger" role="alert">
      <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>     
        <p><?php echo e($error); ?><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="<?php echo e(__('Close')); ?>">
        <span aria-hidden="true" style="color:red;">&times;</span></button></p>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
    </div>
    <?php endif; ?>
    <div class="col-lg-12">
      <div class="card m-b-30">
        <div class="card-header">
          <a href="<?php echo e(route('users.index')); ?>" class="float-right btn btn-primary-rgba mr-2" title="<?php echo e(__('Back')); ?>"><i
            class="feather icon-arrow-left mr-2"></i><?php echo e(__('Back')); ?></a>
          <h5 class="box-title"><?php echo e(__('Change Or Add Subscription')); ?></h5>
        </div>
        <div class="card-body ml-2">
          <?php echo Form::open(['method' => 'POST', 'action' => 'UsersController@change_subscription', 'files' => true]); ?>

          <div class="change-subs-title mb-3">
            <h5><?php echo e(__('User Name')); ?>: <?php echo e($user->name); ?></h5>
            <?php
              $planname='not exist';
              if (isset($plans)) {
                if (isset($last_payment->plan->name) && !is_null($last_payment)){
                    $planname=$last_payment->plan->name;
                    $planid = $last_payment->plan->id;
                  }else{
                  if (isset($user_stripe_plan) && !is_null($user_stripe_plan)) {
                    $planname=$user_stripe_plan->name;
                    $planid = $user_stripe_plan->id;
                  }
                }
              }
              else{
                  $planname='not exist';
              }

            ?>
              
            <h5><?php echo e(__('Last Subscription Plan')); ?>: <?php echo e($planname); ?></h5>
          </div>
          <input type="hidden" name="user_stripe_plan_id" value="<?php echo e($user_stripe_plan != null ? $user_stripe_plan->id : null); ?>">
          <input type="hidden" name="last_payment_id" value="<?php echo e($last_payment != null ? $last_payment->id : null); ?>">
          <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">


          <?php $__currentLoopData = $user->paypal_subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
              $test=0;
              $status =App\Package::select('status')->where('id',$pu->package_id)->get();
                    foreach ($status as $key => $value) {
                    $test=$value->status;
                    }
            ?>

            <?php if($test == 1): ?>
              <div class="alert alert-danger">
                <?php echo e(__('User Plan Not Exist')); ?>

              </div>
            <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <div class="form-group col-md-4">
            <select class="form-control select2" name="plan_id">
              <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($plan->delete_status == 1): ?>
              <option value="<?php echo e($plan->id); ?>" <?php echo e(isset($planid) && $planid == $plan->id ? 'Selected' : ''); ?>><?php echo e($plan->name); ?></option>
              <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success-rgba" title="<?php echo e(__('Change Subscription')); ?>"><i class="fa fa-check-circle mr-1"></i>
              <?php echo e(__('Change Subscription')); ?></button>
          </div>
          <?php echo Form::close(); ?>

          <div class="clear-both"></div>
        </div>

      </div>
    </div>
  </div>
</div>
</div>

<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/admin/users/change_sub.blade.php ENDPATH**/ ?>