
<?php $__env->startSection('title','Affiliate Settings'); ?>
<?php $__env->startSection('breadcum'); ?>
	<div class="breadcrumbbar">
      <h4 class="page-title"><?php echo e(__('Affiliate Settings')); ?></h4>
      <div class="breadcrumb-list">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>" title="<?php echo e(__('Dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Affiliate Settings')); ?></li>
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
          <a href="<?php echo e(url('admin/fakeViews')); ?>" class="float-right btn btn-primary-rgba mr-2" title="<?php echo e(__('Back')); ?>"><i
            class="feather icon-arrow-left mr-2"></i><?php echo e(__('Back')); ?></a>
          <h5 class="box-title"><?php echo e(__('Affiliate Settings')); ?></h5>
        </div>
        <div class="card-body ml-2">
          <form action="<?php echo e(route('admin.affilate.update')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="row">
              <div class="col-md-4">
                <div class="bootstrap-checkbox form-group text-dark<?php echo e($errors->has('enable_affilate') ? ' has-error' : ''); ?>">
                  <div class="col-md-7">
                    <h5 class="bootstrap-switch-label"><?php echo e(__('Enable Affiliate')); ?> ?</h5>
                  </div>
                  <div class="col-md-5 pad-0">
                    <div class="make-switch">
                      <?php echo Form::checkbox('enable_affilate', 1, (isset($af_settings) && $af_settings->enable_affilate == 1 ? 1 : 0), ['class' => 'custom_toggle', "data-on-text"=>__('On'), "data-off-text"=>__('OFF'), "data-size"=>"small"]); ?>

                    </div>
                  </div>
                  <small class="text-danger"><?php echo e($errors->first('enable_affilate')); ?></small>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group text-dark<?php echo e($errors->has('code_limit') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('code_limit',__('Refer code charters limit')); ?> <sup class="text-danger">*</sup> <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo e(__('Refer code character limit. eg: if you put 4 then refer code will be 4 charters like EX51 and if you put 6 then it will be ABCD45')); ?>">
                      <i class="fa fa-info"></i>
                  </small>
                  
                  <?php echo Form::text('code_limit',  isset($af_settings) ? $af_settings->code_limit : 4 , ['class' => 'form-control']); ?>

                  
                  <small class="text-danger"><?php echo e($errors->first('code_limit')); ?></small>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group text-dark<?php echo e($errors->has('refer_amount') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('refer_amount',__('Refer Amount:')); ?> <sup class="text-danger">*</sup> <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo e(__('Per Refer amount in default currency')); ?>">
                      <i class="fa fa-info"></i>
                  </small>
                  <?php echo Form::number('refer_amount', isset($af_settings) ? $af_settings->refer_amount : 0 , ['class' => 'form-control', 'min'=>"0", 'step'=>'0.01']); ?>

                 
                  <small class="text-danger"><?php echo e($errors->first('refer_amount')); ?></small>
                </div>
              </div>              
              <div class="col-md-12">
                <div class= "form-group text-dark<?php echo e($errors->has('about_system') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('about_system', __('Descriptions')); ?> <sup class="text-danger">*</sup>
                  <?php echo Form::textarea('about_system', isset($af_settings) ? $af_settings->about_system : "" , ['id' => '','autocomplete'=>'off', 'class' => 'form-control ckeditor', 'required']); ?>

                  <small class="text-danger"><?php echo e($errors->first('about_system')); ?></small>
                </div>
              </div>
            </div>
              
            <div class="form-group text-dark">
              <button type="reset" class="btn btn-success-rgba" title="<?php echo e(__('Reset')); ?>"><?php echo e(__('Reset')); ?></button>
              <button type="submit" class="btn btn-primary-rgba" title="<?php echo e(__('Save')); ?>"><i class="fa fa-check-circle"></i> <?php echo e(__('Save')); ?></button>
            </div>
          </form>
            
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?> 
<?php $__env->startSection('script'); ?>
<script>
  (function($){
    $.noConflict();    
  })(jQuery);    
</script>  

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/admin/affilate/settings.blade.php ENDPATH**/ ?>