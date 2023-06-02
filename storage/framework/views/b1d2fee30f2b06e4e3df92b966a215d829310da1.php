
<?php $__env->startSection('title',__('Signin And SignUp Customization')); ?>
<?php $__env->startSection('breadcum'); ?>
	  <div class="breadcrumbbar">
      <h4 class="page-title"><?php echo e(__('SignIn & SignUp Settings')); ?></h4>
      <div class="breadcrumb-list">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>" title="<?php echo e(__('Dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('SignIn & SignUp Settings')); ?></li>
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
      <div class="card m-b-50">
        <div class="card-header">
          <h5 class="box-title"><?php echo e(__('SignIn & SignUp Settings')); ?></h5>
        </div>
        <div class="card-body ml-2">
          <?php echo Form::model($auth_customize, ['method' => 'POST', 'action' => 'AuthCustomizeController@store', 'files' => true]); ?>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group text-dark<?php echo e($errors->has('detail') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('detail',__('Page Details')); ?>  <sup class="text-danger">*</sup>
                  <?php echo Form::textarea('detail', null, ['id' => 'editor1', 'class' => 'form-control']); ?>

                  <small class="text-danger"><?php echo e($errors->first('detail')); ?></small>
                </div>
              </div>
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-6 form-group text-dark auth-custom-img">
                     <?php echo Form::label('image', __('Image')); ?>

                    <?php if($auth_customize->image != null): ?>
                      <img src="<?php echo e(asset('images/login/'.$auth_customize->image)); ?>" class="img-responsive" alt="Login">
                    <?php else: ?>
                      <div class="image-block"></div>                    
                    <?php endif; ?>
                  </div>
                </div>
                <div class="form-group text-dark<?php echo e($errors->has('image') ? ' has-error' : ''); ?> input-file-block">
                  <?php echo Form::file('image', ['class' => 'input-file', 'id'=>'image']); ?>                 
                  <small class="text-danger"><?php echo e($errors->first('image')); ?></small>
                </div>
              </div>
            </div>
              
              
                <div class="form-group">
                  <button type="submit" class="btn btn-primary-rgba" title="<?php echo e(__('Save')); ?>"><i class="fa fa-check-circle"></i>
                    <?php echo e(__('Save')); ?></button>
                </div>
                <?php echo Form::close(); ?>

                <div class="clear-both"></div>
            

      </div>
    </div>
  </div>
</div>
</div>
<?php $__env->stopSection(); ?> 
<?php $__env->startSection('script'); ?>
<script>
  (function ($) {
    // jQuery.noConflict();
    $(window).on('load', function (){
      CKEDITOR.replace('editor1');
    });
    
  })(jQuery);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/admin/auth_customize/index.blade.php ENDPATH**/ ?>