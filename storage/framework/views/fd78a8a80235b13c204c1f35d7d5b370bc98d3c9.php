
<?php $__env->startSection('title',__('Create Audio Language')); ?>
<?php $__env->startSection('breadcum'); ?>
	<div class="breadcrumbbar">
    <h4 class="page-title"><?php echo e(__('Create Audio Language')); ?></h4>
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>" title="<?php echo e(__('Dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
          <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Create Audio Language')); ?></li>
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
          <a href="<?php echo e(url('admin/audio_language')); ?>" class="float-right btn btn-primary-rgba mr-2" title="<?php echo e(__('Back')); ?>"><i
            class="feather icon-arrow-left mr-2"></i><?php echo e(__('Back')); ?></a>
          <h5 class="box-title"><?php echo e(__('Create Audio Language')); ?></h5>
        </div>
        <div class="card-body ml-2">
          <?php echo Form::open(['method' => 'POST', 'action' => 'AudioLanguageController@store', 'files' => true]); ?>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group <?php echo e($errors->has('language') ? ' has-error' : ''); ?>">
                  <label for="language">
                    <?php echo e(__('Language')); ?>:
                    <sup class="text-danger">*</sup>
                  </label>
                  <input value="<?php echo e(old('language')); ?>" autofocus required name="language" type="text" class="form-control"
                    placeholder="<?php echo e(__('Please Enter Language')); ?>" />
                  <small class="text-danger"><?php echo e($errors->first('language')); ?></small>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group<?php echo e($errors->has('genre') ? ' has-error' : ''); ?> input-file-block">
                  <?php echo Form::label('image', __('Audio Language Image')); ?><br/>
                  <?php echo Form::file('image', ['class' => 'input-file', 'id'=>'image']); ?>

                  <small class="text-danger"><?php echo e($errors->first('image')); ?></small>
                </div>
              </div>   
              <div class="col-md-12"> 
                <div class="form-group">
                  <button type="reset" class="btn btn-success-rgba" title="<?php echo e(__('Reset')); ?>"><?php echo e(__('Reset')); ?></button>
                  <button type="submit" class="btn btn-primary-rgba" title="<?php echo e(__('Create')); ?>"><i class="fa fa-check-circle"></i>
                    <?php echo e(__('Create')); ?></button>
                </div>
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
  $(function(){
    $('form').on('submit', function(event){
      $('.loading-block').addClass('active');
    });

    $(".toggle-password2").click(function() {
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });
  });


</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/admin/audio_language/create.blade.php ENDPATH**/ ?>