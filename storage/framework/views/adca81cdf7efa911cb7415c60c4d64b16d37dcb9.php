
<?php $__env->startSection('title',__('Edit Slider')); ?>
<?php $__env->startSection('breadcum'); ?>
	<div class="breadcrumbbar">
    <h4 class="page-title"><?php echo e(__('Edit Slide')); ?></h4>
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>" title="<?php echo e(__('Dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
          <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Edit Slide')); ?></li>
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
          <a href="<?php echo e(url('admin/home_slider')); ?>" class="float-right btn btn-primary-rgba mr-2" title="<?php echo e(__('Back')); ?>"><i
            class="feather icon-arrow-left mr-2"></i><?php echo e(__('Back')); ?></a>
          <h5 class="box-title"><?php echo e(__('Edit Slide')); ?></h5>
        </div>
        <div class="card-body ml-2">
          <?php echo Form::model($home_slide, ['method' => 'PATCH', 'action' => ['HomeSliderController@update', $home_slide->id], 'files' => true]); ?>

            <div class="row">
              <div class="col-md-4">
                <div class="bootstrap-checkbox slide-option-switch form-group text-dark<?php echo e($errors->has('prime_main_slider') ? ' has-error' : ''); ?>">
                  <div class="row">
                    <div class="col-md-7">
                      <h5 class="bootstrap-switch-label"><?php echo e(__('Slide For')); ?></h5>
                    </div>
                    <div class="col-md-5 pad-0">
                      <div class="make-switch">
                        <?php echo Form::checkbox('', 1, (isset($movie_dtl) ? 1 : 0), ['class' => 'bootswitch', 'id' => 'TheCheckBox', "data-on-text"=>"Movies", "data-off-text"=>"Tv Series", "data-size"=>"small",]); ?>

                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <small class="text-danger"><?php echo e($errors->first('prime_main_slider')); ?></small>
                  </div>
                </div>
              </div>
                <div class="col-md-4">    
                  <div id="movie_id_block" class="form-group text-dark<?php echo e($errors->has('movie_id') ? ' has-error' : ''); ?>">
                    <?php echo Form::label('movie_id', __('Select App Slide For Movie')); ?>

                    <?php if(isset($movie_dtl)): ?>
                      <?php echo Form::select('movie_id', [$movie_dtl->id => $movie_dtl->title] + $movie_list, null, ['class' => 'form-control select2', 'placeholder' => '']); ?>

                    <?php else: ?>
                      <?php echo Form::select('movie_id', $movie_list, null, ['class' => 'form-control select2', 'placeholder' => '']); ?>

                    <?php endif; ?>
                    <small class="text-danger"><?php echo e($errors->first('movie_id')); ?></small>
                  </div>
                  <div id="tv_series_id_block" class="form-group text-dark<?php echo e($errors->has('tv_series_id') ? ' has-error' : ''); ?>">
                    <?php echo Form::label('tv_series_id', __('Select App Slide For Tv Show')); ?>

                    <?php if(isset($tv_series_dtl)): ?>
                      <?php echo Form::select('tv_series_id', [$tv_series_dtl->id => $tv_series_dtl->title] + $tv_series_list, null, ['class' => 'form-control select2', 'placeholder' => '']); ?>

                    <?php else: ?>
                      <?php echo Form::select('tv_series_id', $tv_series_list, null, ['class' => 'form-control select2', 'placeholder' => '']); ?>

                    <?php endif; ?>
                    <small class="text-danger"><?php echo e($errors->first('tv_series_id')); ?></small>
                  </div>
                </div>
                <div class="col-md-4">    
                  <div style="<?php echo e($home_slide->type == 'v' ? "display: none" : ""); ?>" id="slider_image" class="form-group text-dark<?php echo e($errors->has('slide_image') ? ' has-error' : ''); ?> input-file-block">
                    <?php echo Form::label('slide_image', __('Slide Image')); ?>

                    <?php echo Form::file('slide_image', ['class' => 'input-file', 'id'=>'slide_image']); ?>                  
                    <small class="text-danger"><?php echo e($errors->first('slide_image')); ?></small>
                  </div>
                </div>
                <div class="col-md-3"> 
                  <?php if($button->kids_mode==1): ?>
                    <div class="form-group text-dark<?php echo e($errors->has('is_kids') ? ' has-error' : ''); ?>">
                      <div class="row">
                        <div class="col-md-6">
                          <?php echo Form::label('is_kids', __('For Kids Section')); ?>

                        </div>
                        <div class="col-md-5 pad-0">
                          <label class="switch">
                            <?php echo Form::checkbox('is_kids', 1, $home_slide->is_kids, ['class' => 'custom_toggle','id'=>'kids_mode']); ?>

                            <span class="slider round"></span>
                          </label>
                        </div>
                      </div>
                      <div class="col-xs-12">
                        <small class="text-danger"><?php echo e($errors->first('is_kids')); ?></small>
                      </div>
                    </div>
                  <?php endif; ?>
                </div>
                <div class="col-md-3">
                  <div class="form-group text-dark<?php echo e($errors->has('active') ? ' has-error' : ''); ?>">
                    <div class="row">
                      <div class="col-md-4">
                        <?php echo Form::label('active', __('Active')); ?>

                      </div>
                      <div class="col-md-5 pad-0">
                        <label class="switch">
                          <?php echo Form::checkbox('active', 1, $home_slide->active, ['class' => 'custom_toggle']); ?>

                          <span class="slider round"></span>
                        </label>
                      </div>
                    </div>
                    <div class="col-xs-12">
                      <small class="text-danger"><?php echo e($errors->first('series')); ?></small>
                    </div>
                  </div>
                </div>
              </div>
              
              
                <div class="form-group">
                  <button type="submit" class="btn btn-primary-rgba" title="<?php echo e(__('Update')); ?>"><i class="fa fa-check-circle"></i>
                    <?php echo e(__('Update')); ?></button>
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
  $(document).ready(function(){
    <?php if(isset($movie_dtl)): ?>
      $('#tv_series_id_block').hide();
    <?php elseif(isset($tv_series_dtl)): ?>
      $('#movie_id_block').hide();  
    <?php endif; ?>

    $('#TheCheckBox').on('switchChange.bootstrapSwitch', function (event, state) {

        if (state == true) {

          $('#tv_series_id').val("");
          $('#tv_series_id_block').hide();
          $('#movie_id_block').show();

        } else if (state == false) {

          $('#tv_series_id_block').show();
          $('#movie_id').val("");
          $('#movie_id_block').hide(); 

        };

    });
    
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/admin/homeslider/edit.blade.php ENDPATH**/ ?>