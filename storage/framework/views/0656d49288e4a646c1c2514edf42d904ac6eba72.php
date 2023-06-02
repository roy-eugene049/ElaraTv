
<?php $__env->startSection('title', __('Seo Settings')); ?>
<?php $__env->startSection('breadcum'); ?>
<div class="breadcrumbbar">
    <h4 class="page-title"><?php echo e(__('SEO Settings')); ?></h4>
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>" title="<?php echo e(__('Dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
          <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('SEO Settings')); ?></li>
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
          <h5 class="box-title"><?php echo e(__('SEO Settings')); ?></h5>
        </div>
        <div class="card-body ml-2">
          <?php if($seo): ?>
          <?php echo Form::model($seo, ['method' => 'PATCH', 'action' => ['SeoController@update', $seo->id], 'files' => true]); ?>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group text-dark<?php echo e($errors->has('description') ? ' has-error' : ''); ?>">
                <?php echo Form::label('author',__('Author Name')); ?>

                <?php echo Form::text('author', null, ['placeholder' => __('EnterAuthorName'),'id' => 'textbox', 'class' => 'form-control']); ?>

                <small class="text-danger"><?php echo e($errors->first('author')); ?></small>
              </div>
            </div>
            <div class="col-md-6"></div>
            <div class="col-md-6">
              <div class="form-group text-dark<?php echo e($errors->has('description') ? ' has-error' : ''); ?>">
                <?php echo Form::label('description', __('Metadata Description')); ?>

                <?php echo Form::textarea('description', null, ['id' => 'textbox', 'class' => 'form-control']); ?>

                <small class="text-danger"><?php echo e($errors->first('description')); ?></small>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group text-dark<?php echo e($errors->has('keyword') ? ' has-error' : ''); ?>">
                <?php echo Form::label('keyword', __('Metadata Keyword')); ?>

                <?php echo Form::textarea('keyword', null, ['placeholder' => __('Keyword Placeholder'),'id' => 'textbox', 'class' => 'form-control']); ?>

                <small class="text-danger"><?php echo e($errors->first('keyword')); ?></small>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group text-dark<?php echo e($errors->has('google') ? ' has-error' : ''); ?>">
                <?php echo Form::label('google',__('Google Analytics')); ?>

                <?php echo Form::text('google', null, ['class' => 'form-control']); ?>

                <small class="text-danger"><?php echo e($errors->first('google')); ?></small>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group text-dark<?php echo e($errors->has('fb') ? ' has-error' : ''); ?>">
                <?php echo Form::label('fb', __('Facebook Pixcal')); ?>

                <?php echo Form::text('fb', null, ['id' => 'textbox1', 'class' => 'form-control']); ?>

                <small class="text-danger"><?php echo e($errors->first('fb')); ?></small>
              </div>
            </div>
              </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary-rgba" title="<?php echo e(__('Save')); ?>"><i class="fa fa-check-circle"></i> <?php echo e(__('Save')); ?></button>
            </div>

          <?php echo Form::close(); ?>

        <?php endif; ?>
        <div class="clear-both">
        </div>

      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card m-b-30">
      <div class="card-body ml-2">
        <div class="card-body bg-success-rgba">
          <div class="row align-items-center">
            <div class="col-12">
              <h5 class="text-success process-fonts"><i class="fa fa-info-circle"></i> <?php echo e(__('Site Map Generate')); ?></h5>
                
                <br>
                <a href="<?php echo e(url('/sitemap')); ?>" class="btn btn-primary-rgba" title="<?php echo e(__('Generate')); ?>"><?php echo e(__('Generate')); ?></a>
                <?php if(@file_get_contents(public_path().'/sitemap.xml')): ?>
                  <a href="<?php echo e(url('/sitemap/download')); ?>" class="btn btn-primary-rgba" data-toggle="tooltip" data-original-title="<?php echo e(__('download sitemap.xml')); ?>" title="<?php echo e(__('download sitemap.xml')); ?>"><i class="material-icons">download </i><?php echo e(__('sitemap.xml')); ?></a>
                  |
                  <a href="<?php echo e(url('/sitemap.xml')); ?>" class="btn btn-primary-rgba" data-toggle="tooltip" data-original-title="<?php echo e(__('view sitemap')); ?>"><i class="material-icons">visibility</i><?php echo e(__('Sitemap')); ?></a>
                <?php endif; ?>
              </div>
            </div>
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/admin/seo.blade.php ENDPATH**/ ?>