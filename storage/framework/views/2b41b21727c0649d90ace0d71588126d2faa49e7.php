
<?php $__env->startSection('title', __('Mail Settings')); ?>
<?php $__env->startSection('breadcum'); ?>
<div class="breadcrumbbar">
    <h4 class="page-title"><?php echo e(__('Mail Settings')); ?></h4>
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>" title="<?php echo e(__('Dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
          <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Mail Settings')); ?></li>
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
          <h5 class="box-title"><?php echo e(__('Mail Settings')); ?></h5>
        </div>
        <div class="card-body ml-2">
          <?php echo Form::model($env_files, ['method' => 'POST', 'action' => 'ConfigController@changeMailEnvKeys']); ?>

            <div class="row">
              <div class="col-md-3">
                <div class="form-group text-dark<?php echo e($errors->has('MAIL FROM NAME') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('MAIL_FROM_NAME',__('Sender Name')); ?> <sup class="text-danger">*</sup>
                    <input class="form-control" type="text" name="MAIL_FROM_NAME" value="<?php echo e($env_files['MAIL_FROM_NAME']); ?>" placeholder="<?php echo e(__('Please Enter Mail Sender Name')); ?>">
                    <small class="text-danger"><?php echo e($errors->first('MAIL_FROM_NAME')); ?></small>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group text-dark<?php echo e($errors->has('MAIL_FROM_ADDRESS') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('MAIL_DRIVER', __('Mail From Address')); ?> <sup class="text-danger">*</sup>
                  <?php echo Form::email('MAIL_FROM_ADDRESS', null, ['class' => 'form-control', 'placeholder' => __('Please Enter Mail Address')]); ?>

                    <small class="text-danger"><?php echo e($errors->first('MAIL_FROM_ADDRESS')); ?></small>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group text-dark<?php echo e($errors->has('MAIL_PORT') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('MAIL_PORT', __('Mail Port')); ?> <sup class="text-danger">*</sup>
                  <?php echo Form::text('MAIL_PORT', null, ['class' => 'form-control', 'placeholder' => __('2525')]); ?>

                  <small class="text-danger"><?php echo e($errors->first('MAIL_PORT')); ?></small>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group text-dark<?php echo e($errors->has('MAIL_USERNAME') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('MAIL_USERNAME', __('Mail User Name')); ?> <sup class="text-danger">*</sup>
                  <?php echo Form::text('MAIL_USERNAME', null, ['class' => 'form-control', 'placeholder' => __('Please Enter Mail User Name')]); ?>

                  <small class="text-danger"><?php echo e($errors->first('MAIL_USERNAME')); ?></small>
                </div>
              </div>              
              <div class="col-md-2">
                <div class="form-group text-dark<?php echo e($errors->has('MAIL HOST') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('MAIL_DRIVER', __('Mail Driver')); ?> <sup class="text-danger">*</sup>
                  <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo e(__('There are three Mail Drivers: SMTP, Mail, Sendmail, if SMTP is not working then check Sendmail. Sendmail required proc_open enable.')); ?>">
                    <i class="fa fa-info"></i>
                  </small>
                    <?php echo Form::text('MAIL_DRIVER', null, ['class' => 'form-control', 'placeholder' => __('SMTP')]); ?>

                    <small class="text-danger"><?php echo e($errors->first('MAIL_DRIVER')); ?></small>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group text-dark<?php echo e($errors->has('MAIL HOST') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('MAIL_HOST', __('Mail Host')); ?> <sup class="text-danger">*</sup>
                  <?php echo Form::text('MAIL_HOST', null, ['class' => 'form-control', 'placeholder' => __('mail.yourdomain.com')]); ?>

                  <small class="text-danger"><?php echo e($errors->first('MAIL_HOST')); ?></small>
                </div>
              </div>
              <div class="col-md-3">
                <div class="search form-group mail-password-input text-dark<?php echo e($errors->has('MAIL_PASSWORD') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('MAIL_PASSWORD', __('Mail Password')); ?> <sup class="text-danger">*</sup>
                  <input type="password" name="MAIL_PASSWORD" id="mailpass" value="<?php echo e($env_files['MAIL_PASSWORD']); ?>" class="form-control">
                  <i class="feather icon-eye"></i>
                  <small class="text-danger"><?php echo e($errors->first('MAIL_PASSWORD')); ?> </small>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group text-dark<?php echo e($errors->has('MAIL_ENCRYPTION') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('MAIL_ENCRYPTION', __('Mail Encryption')); ?>

                  <?php echo Form::text('MAIL_ENCRYPTION', null, ['class' => 'form-control', 'placeholder' => __('SSL')]); ?>

                  <small class="text-danger"><?php echo e($errors->first('MAIL_ENCRYPTION')); ?></small>
                </div>
              </div>
              
                <div class="col-md-6 col-lg-6 col-xl-12 form-group">
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

  $(".toggle-password2").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
  });
  </script>
  <script>
  (function($){
    $.noConflict();    
  })(jQuery);    
</script>  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/admin/mailsetting/mailset.blade.php ENDPATH**/ ?>