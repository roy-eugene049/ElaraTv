
<?php $__env->startSection('title',__('Social Url Setting')); ?>
<?php $__env->startSection('breadcum'); ?>
	 <div class="breadcrumbbar">
      <h4 class="page-title"><?php echo e(__('Social URL Settings')); ?></h4>
      <div class="breadcrumb-list">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Social URL Settings')); ?></li>
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
          <a href="<?php echo e(url('admin/')); ?>" class="float-right btn btn-primary-rgba mr-2" title="<?php echo e(__('Back')); ?>"><i
            class="feather icon-arrow-left mr-2"></i><?php echo e(__('Back')); ?></a>        
          <h5 class="box-title"><?php echo e(__('Social URL Settings')); ?></h5>
        </div>
        <div class="card-body ml-2">
          <?php echo Form::open(['method' => 'POST', 'action' => 'SocialIconController@post', 'files' => true]); ?>

            <div class="row">
              <div class="col-md-4">
        				<div class= "form-group text-dark">
                        <label for=""><i class="fa fa-facebook"></i> <?php echo e(__('Facebook URL')); ?>:</label>
        				<input autofocus="" placeholder="http://facebook.com/" type="text" class="form-control" name="url1" value="<?php echo e($si->url1); ?>">
                </div>
        			</div>           
              <div class="col-md-4">
        				<div class= "form-group text-dark">
          				<label for=""><i class="fa fa-twitter"></i> <?php echo e(__('Twitter URL')); ?>:</label>
          				<input type="text" placeholder="http://twitter.com/" class="form-control" name="url2" value="<?php echo e($si->url2); ?>">
        				</div>
              </div>
              <div class="col-md-4">
        				<div class= "form-group text-dark">
          				<label for=""><i class="fa fa-youtube"></i> <?php echo e(__('YouTube URL')); ?>:</label>
          				<input type="text" placeholder="http://youtube.com/" class="form-control" name="url3" value="<?php echo e($si->url3); ?>">
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/admin/landing-page/si.blade.php ENDPATH**/ ?>