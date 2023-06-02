
<?php $__env->startSection('title', __('Chat Settings')); ?>
<?php $__env->startSection('breadcum'); ?>
<div class="breadcrumbbar">
          <h4 class="page-title"><?php echo e(__('Chat Settings')); ?></h4>
          <div class="breadcrumb-list">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Chat Settings')); ?></li>
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
          			<h5 class="box-title"><?php echo e(__('Chat Settings')); ?></h5>
        		</div>

        		<?php echo Form::model($chat,['method'=>'POST','action'=>'ChatSettingController@update']); ?>

              <?php if(isset($chat) && count($chat) > 0): ?>  
              <?php $__currentLoopData = $chat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <!-- ======= Facebook Login start ========== -->
              <div class="col-md-6 col-lg-6 col-xl-12">
                <div class="bg-info-rgba ml-6 mr-6 mb-6">
                  <div class="card-header text-dark"><h4> <?php echo e(__('Chat Settings For ')); ?> <?php echo e(ucfirst($element->key)); ?></h4></div>
                    <?php echo Form::hidden('ids['.$element->id.']', $element->id); ?>

                    <input type='hidden' name="keyname[<?php echo e($element->id); ?>]" value="<?php echo e($element->key); ?>">
                    <div class="payment-gateway-block">
                        <div class="row mx-2 my-4" id="fb_box_dtl" >
                          <?php if($element->key != 'whatsapp'): ?>
                            <div class="col-md-2">
                              <div class="form-group text-dark<?php echo e($errors->has('enable_messanger') ? ' has-error' : ''); ?>">
                                <label for=""><?php echo e(__('Enable')); ?> </label>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <input type="checkbox" name="enable_messanger[<?php echo e($element->id); ?>]" <?php echo e($element->enable_messanger == 1 ? 'checked' :''); ?> class='custom_toggle' >
                            </div>
                          <?php endif; ?>
                          <?php if($element->key != 'whatsapp'): ?>
                            <div class="col-md-8">
                              <div class="form-group text-dark <?php echo e($errors->has('script') ? ' has-error' : ''); ?>">
                                <?php echo Form::label('script',__('Script') ); ?>

                                <?php echo Form::textarea('script['.$element->id.']', $element->script, ['class' => 'form-control','rows'=>'3']); ?>

                                <small class="text-danger"><?php echo e($errors->first('script')); ?></small>
                              </div>
                            </div>
                          <?php endif; ?>
                          

                          <?php if($element->key != 'messanger'): ?>
                            <div class="col-md-3">
                              <div class="form-group text-dark<?php echo e($errors->has('mobile') ? ' has-error' : ''); ?>">
                                <?php echo Form::label('mobile', __('Whatsapp Mobile No')); ?>

                              
                                <?php echo Form::text('mobile['.$element->id.']', $element->mobile, [ 'class' => 'form-control', 'placeholder' => __('Whatsapp Mobile No')]); ?>

                                <small class="text-danger"><?php echo e($errors->first('mobile')); ?></small>
                              </div>
                            </div>
                          <?php endif; ?>

                          <?php if($element->key != 'messanger'): ?>
                            <div class="col-md-3">
                              <div class="form-group text-dark<?php echo e($errors->has('text') ? ' has-error' : ''); ?>">
                                <?php echo Form::label('text',__('Welcome Text')); ?> 
                                <?php echo Form::text('text['.$element->id.']', $element->text, ['class' => 'form-control', 'placeholder' => __('Hello, Welcome')]); ?>

                                <small class="text-danger"><?php echo e($errors->first('text')); ?></small>
                              </div>
                            </div>
                          <?php endif; ?>

                          <?php if($element->key != 'messanger'): ?>
                            <div class="col-md-3">
                              <div class="form-group text-dark<?php echo e($errors->has('header') ? ' has-error' : ''); ?>">
                                <?php echo Form::label('header',__('Chat Header')); ?> 
                                <?php echo Form::text('header['.$element->id.']', $element->header, ['class' => 'form-control', 'placeholder' => __('Connect with us')]); ?>

                                <small class="text-danger"><?php echo e($errors->first('header')); ?></small>
                              </div>
                            </div>
                          <?php endif; ?>

                          <?php if($element->key != 'messanger'): ?>
                            <div class="col-md-1">
                              <div class="form-group text-dark<?php echo e($errors->has('size') ? ' has-error' : ''); ?>">
                                <?php echo Form::label('size',__('Icon Size')); ?> 
                                <?php echo Form::number('size['.$element->id.']', $element->size, ['class' => 'form-control','min'=>'30']); ?>

                                <small class="text-danger"><?php echo e($errors->first('size')); ?></small>
                              </div>
                            </div>
                          <?php endif; ?>

                          <?php if($element->key != 'messanger'): ?>
                            <div class="col-md-2">
                                <div class="form-group text-dark<?php echo e($errors->has('color') ? ' has-error' : ''); ?>">
                                <?php echo Form::label('color',__('Header Color')); ?> 
                                <?php echo Form::color('color['.$element->id.']', $element->color, ['class' => 'form-control']); ?>

                                <small class="text-danger"><?php echo e($errors->first('color')); ?></small>
                              </div>
                            </div>
                          <?php endif; ?>

                          <?php if($element->key != 'messanger'): ?>
                            <div class="col-md-3">
                              <div class="form-group text-dark<?php echo e($errors->has('enable_whatsapp') ? ' has-error' : ''); ?>">
                                <h6 class="bootstrap-switch-label"><?php echo e(__('Enable')); ?></h6>
                                <input type="checkbox" name="enable_whatsapp[<?php echo e($element->id); ?>]" <?php echo e($element->enable_whatsapp == 1 ? 'checked' :''); ?> class='custom_toggle' >
                              </div>
                              <small class="text-danger"><?php echo e($errors->first('enable_whatsapp')); ?></small>
                            </div>
                          <?php endif; ?>  
                          
                          <?php if($element->key != 'messanger'): ?>
                            <div class="col-md-3">
                              <div class="form-group text-dark<?php echo e($errors->has('position') ? ' has-error' : ''); ?>">
                                <h6 class="bootstrap-switch-label"><?php echo e(__('Position')); ?> 
                                  <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo e(__('Position : Left/Right')); ?>">
                                    <i class="fa fa-info"></i>
                                  </small></h6>
                                <input type="checkbox" name="position[<?php echo e($element->id); ?>]" <?php echo e($element->position == 'left' ?'checked' :''); ?> class='custom_toggle' >
                              </div>
                              <small class="text-danger"><?php echo e($errors->first('position')); ?></small>
                            </div>
                          <?php endif; ?>  

                        </div>
                    </div>
                  </div>
                </div>
                <!-- ======= Facebook Login end ========== -->
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <div class="col-md-6 col-lg-6 col-xl-12 form-group">
                  <button type="submit" class="btn btn-primary-rgba" title="<?php echo e(__('Save')); ?>"><i class="fa fa-check-circle"></i>
                    <?php echo e(__('Save')); ?></button>
                </div>
              <?php echo Form::close(); ?>


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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/admin/chat_setting/index.blade.php ENDPATH**/ ?>