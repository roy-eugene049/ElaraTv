
<?php $__env->startSection('title',__('Create Google Advertise')); ?>
<?php $__env->startSection('breadcum'); ?>
	<div class="breadcrumbbar">
    <h4 class="page-title"><?php echo e(__('HOME')); ?></h4>
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
          <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Create Google Advertise')); ?></li>
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
  <p><?php echo e($error); ?><button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true" style="color:red;">&times;</span></button></p>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
  </div>
  <?php endif; ?>
    <div class="col-lg-12">
      <div class="card m-b-30">
        <div class="card-header">
        <a href="<?php echo e(route('google.ads')); ?>" class="float-right btn btn-primary-rgba mr-2"><i
                  class="feather icon-arrow-left mr-2"></i><?php echo e(__('Back')); ?></a>
          <h5 class="box-title"><?php echo e(__('Create Google Advertise')); ?></h5>
          
        </div>
        <div class="card-body ml-2">
			<form style="margin-top:-15px;" enctype="multipart/form-data" method="POST" action="<?php echo e(route('google.ads.store')); ?> ">
				<br>
        <?php echo e(csrf_field()); ?>

        <div class="row">
          <div class="col-lg-4 col-md-6">
            <div id="forpopup1" class="form-group text-dark">
              <label for=""><?php echo e(__('Google Ad Client')); ?><sup class="text-danger">*</sup></label>
              <input type="text" class="form-control" name="google_ad_client" placeholder="ca-pub-9227170916808685" >
              <small class="text-danger"><?php echo e($errors->first('google_ad_client')); ?></small>
				    </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div id="forpopup1" class="form-group text-dark">
              <label for=""><?php echo e(__('Google Ad Slot')); ?><sup class="text-danger">*</sup></label>
              <input type="text" class="form-control" name="google_ad_slot" placeholder="7711195609" >
              <small class="text-danger"><?php echo e($errors->first('google_ad_slot')); ?></small>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div id="forpopup1" class="form-group text-dark">
              <label for=""><?php echo e(__('Google Ad Width')); ?></label>
              <input type="text" class="form-control" name="google_ad_width" placeholder="100" >
              <small class="text-danger"><?php echo e($errors->first('google_ad_width')); ?></small>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div id="forpopup1" class="form-group text-dark">
              <label for=""><?php echo e(__('Google Ad Height')); ?></label>
              <input type="text" class="form-control" name="google_ad_height" placeholder="300" >
              <small class="text-danger"><?php echo e($errors->first('google_ad_height')); ?></small>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div id="forpopup1" class="form-group text-dark">
              <label for=""><?php echo e(__('Enter Start Time')); ?></label>
              <input type="text" class="form-control" name="google_ad_starttime" placeholder="ex. 00:00:10" >
              <small class="text-danger"><?php echo e($errors->first('google_ad_starttime')); ?></small>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div id="forpopup" class="form-group text-dark">
              <label for=""><?php echo e(__('Enter End Time')); ?></label>
              <input type="text" class="form-control" name="google_ad_endtime" placeholder="ex. 00:00:20" >
              <small class="text-danger"><?php echo e($errors->first('google_ad_endtime')); ?></small>
            </div>
          </div>
        </div>
                <div class="form-group">
                  <button type="submit"  value="<?php echo e(__('Create')); ?>" class="btn btn-primary-rgba"><i class="fa fa-check-circle"></i>
                    <?php echo e(__('Update')); ?></button>
                </div>
			</form>
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
    $.noConflict();
    $('form').on('submit', function(event){
      $('.loading-block').addClass('active');
    });
  });

  $(".toggle-password2").click(function() {
    $.noConflict();
  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
  });
  
</script>


    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/googleads/create.blade.php ENDPATH**/ ?>