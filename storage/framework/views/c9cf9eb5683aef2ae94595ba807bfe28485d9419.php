
<?php $__env->startSection('title',__('Contact Us')); ?>
<?php $__env->startSection('main-wrapper'); ?>
<div class="breadcrumb-main-block" style="background-image: url('images/b-2.jpg')">
  <div class="overlay-bg"></div>
  <div class="container-fluid">
    <div class="row">
      <h4 class="heading">Contact Us</h4>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
      </ol>
    </div>
  </div>
</div>

<div class="contact-main-block" style="background-color: #111;">
  <br>
  <?php if(Session::has('success')): ?>
  <div class="alert alert-success">
    <?php echo e(__('Success')); ?> : <?php echo e(Session::get('success')); ?>

  </div>
  <?php endif; ?>
  
  <div class="contact-form-block">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-5">
          <div class="contact-us-img">
            <img src="<?php echo e(url('images/contactus.jpg')); ?>" class="img-fluid" alt="">
          </div>
        </div>
        <div class="col-lg-7 col-md-7 col-sm-7">
          <h3 class="contact-us-heading"><?php echo e(__('Contact')); ?> <span class="us_text"><?php echo e(__('Us')); ?></span></h3>
          <br>
          <h5 class="contact-us-heading"><?php echo e(__('Contact Detail')); ?></h5>
          <form class="contact-block" action="<?php echo e(route('send.contactus')); ?>" method="post">
            <?php echo e(csrf_field()); ?>

            
            <div class="row">
              <div class="col-lg-4">
                <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                  <label style="color: #fff;" for=""><?php echo e(__('Name')); ?>:</label>
                  <input type="text" class="form-control custom-field-contact" name="name">
                  <?php if($errors->has('name')): ?>
                  <span class="help-block">
                    <strong><?php echo e($errors->first('name')); ?></strong>
                  </span>
                  <?php endif; ?>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                  <label style="color: #fff;" for=""><?php echo e(__('Email')); ?>:</label>
                  <input type="email" class="search-input form-control custom-field-contact" name="email">
                  <?php if($errors->has('email')): ?>
                  <span class="help-block">
                    <strong><?php echo e($errors->first('email')); ?></strong>
                  </span>
                  <?php endif; ?>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group<?php echo e($errors->has('subj') ? ' has-error' : ''); ?>">
                  <label style="color: #fff;" for=""><?php echo e(__('Subject')); ?>:</label>
                  <select name="subj" id="" class="form-control custom-field-contact">
                    <option value="Billing Issue"><?php echo e(__('Billing Issue')); ?></option>
                    <option value="Streaming Issue"><?php echo e(__('Streaming Issue')); ?></option>
                    <option value="Application Issue"><?php echo e(__('Application Issue')); ?></option>
                    <option value="Advertising"><?php echo e(__('Advertising')); ?></option>
                    <option value="Partnership"><?php echo e(__('Partnership')); ?></option>
                    <option value="Other"><?php echo e(__('Other')); ?></option>
                  </select>
                  <?php if($errors->has('subj')): ?>
                  <span class="help-block">
                    <strong><?php echo e($errors->first('subj')); ?></strong>
                  </span>
                  <?php endif; ?>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group<?php echo e($errors->has('msg') ? ' has-error' : ''); ?>">
                  <label style="color: #fff;" for=""><?php echo e(__('Message')); ?>:</label>
                  <textarea name="msg" class="form-control custom-field-contact" rows="5" cols="50"></textarea>
                  <?php if($errors->has('msg')): ?>
                  <span class="help-block">
                    <strong><?php echo e($errors->first('msg')); ?></strong>
                  </span>
                  <?php endif; ?>
                </div>
              </div>
            </div>
            <input type="submit" class="btn btn-subscribe" value="<?php echo e(__('Send')); ?>">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/contact.blade.php ENDPATH**/ ?>