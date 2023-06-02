
<?php $__env->startSection('title', __('Adsense')); ?>
<?php $__env->startSection('breadcum'); ?>
	<div class="breadcrumbbar">
      <h4 class="page-title"><?php echo e(__('Google Adsense')); ?></h4>
      <div class="breadcrumb-list">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>" title="<?php echo e(__('Dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Google Adsense')); ?></li>
          </ol>
      </div>                  
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('maincontent'); ?>
<div class="contentbar"> 
  <div class="row">
    <div class="col-md-12">

        <div class="card m-b-50">
            <div class="card-header">
                <h5 class="card-title"><?php echo e(__('Google Adsense')); ?></h5>
            </div> 

            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                <?php if($ad): ?>
                  <?php echo Form::model($ad, ['method' => 'PUT', 'action' => ['AdsenseController@update', $ad->id], 'files' => true]); ?>


                    <div class="form-group<?php echo e($errors->has('code') ? ' has-error' : ''); ?>">
                        <?php echo Form::label('code', __('Enter Your Adsense Script Code')); ?>

                        <?php echo Form::textarea('code', null, ['placeholder' => __('Enter Your Google Adsense Script Code'),'id' => 'textarea', 'class' => 'form-control']); ?>

                        <small class="text-danger"><?php echo e($errors->first('code')); ?></small>
                    </div>
                </div>
                <div class="col-md-3">
                      <!-- is Home -->
                        <div class="bootstrap-checkbox form-group<?php echo e($errors->has('ishome') ? ' has-error' : ''); ?>">
                        <div class="row">
                          <div class="col-md-8">
                            <h5 class="bootstrap-switch-label"><?php echo e(__('Visible On Home')); ?></h5>
                          </div>
                          <div class="col-md-1 pad-0">
                            <div class="make-switch">
                              <?php echo Form::checkbox('ishome', 1, ($ad->ishome == '1' ? true : false), ['class' => 'custom_toggle']); ?>

                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <small class="text-danger"><?php echo e($errors->first('ishome')); ?></small>
                        </div>
                      </div>
                </div>
                <div class="col-md-3">
                      <!-- is wishlist -->
                        <div class="bootstrap-checkbox form-group<?php echo e($errors->has('iswishlist') ? ' has-error' : ''); ?>">
                        <div class="row">
                          <div class="col-md-83">
                            <h5 class="bootstrap-switch-label"><?php echo e(__('Visible On Wishlist')); ?></h5>
                          </div>
                          <div class="col-md-1 pad-0">
                            <div class="make-switch">
                              <?php echo Form::checkbox('iswishlist', 1, ($ad->iswishlist == '1' ? true : false), ['class' => 'custom_toggle']); ?>

                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <small class="text-danger"><?php echo e($errors->first('iswishlist')); ?></small>
                        </div>
                      </div>
                </div>
                <!-- is View All -->
                <div class="col-md-3">                     
                        <div class="bootstrap-checkbox form-group<?php echo e($errors->has('isviewall') ? ' has-error' : ''); ?>">
                        <div class="row">
                          <div class="col-md-8">
                            <h5 class="bootstrap-switch-label"><?php echo e(__('Visible On All')); ?></h5>
                          </div>
                          <div class="col-md-1 pad-0">
                            <div class="make-switch">
                              <?php echo Form::checkbox('isviewall', 1, ($ad->isviewall == '1' ? true : false), ['class' => 'custom_toggle']); ?>

                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <small class="text-danger"><?php echo e($errors->first('isviewall')); ?></small>
                        </div>
                      </div>
                </div>
                <div class="col-md-3">
                      <div class="bootstrap-checkbox form-group<?php echo e($errors->has('status') ? ' has-error' : ''); ?>">
                        <div class="row">
                          <div class="col-md-6">
                            <h5 class="bootstrap-switch-label"><?php echo e(__('Status')); ?></h5>
                          </div>
                          <div class="col-md-1 pad-0">
                            <div class="make-switch">
                              <?php echo Form::checkbox('status', 1, ($ad->status == '1' ? true : false), ['class' => 'custom_toggle']); ?>

                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <small class="text-danger"><?php echo e($errors->first('status')); ?></small>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="btn-group pull-left">
                        <button type="submit" class="btn btn-primary-rgba" title="<?php echo e(__('Save')); ?>"><i class="fa fa-check-circle"></i> <?php echo e(__('Save')); ?></button>
                      </div>
                    </div>
                    <div class="clear-both"></div>
                  <?php echo Form::close(); ?>

                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php $__env->stopSection(); ?> 
<?php $__env->startSection('script'); ?>
<script>
  $(function () {
    CKEDITOR.replace('editor1');
  });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/admin/adsense/index.blade.php ENDPATH**/ ?>