
<?php $__env->startSection('title',__('All Blogs')); ?>
<?php $__env->startSection('breadcum'); ?>
	<div class="breadcrumbbar">
      <h4 class="page-title"><?php echo e(__('All Blogs')); ?></h4>
      <div class="breadcrumb-list">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>" title="<?php echo e(__('Dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Blogs')); ?></li>
          </ol>
      </div>  
  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('maincontent'); ?>
<div class="contentbar permissionTable"> 
  <div class="row">
    <div class="col-md-12">
      <div class="card-header movie-create-heading">
        <div class="row">
          <div class="col-lg-4 col-4 col-md-4">
            <h5 class="card-title"><?php echo e(__('All Blogs')); ?>

                 <input class="grand_selectallm ml-3" type="checkbox">
                                        <?php echo e(__('Select All')); ?></h5>
          </div>
          <div class="col-lg-8 col-8 col-md-8">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('movies.create')): ?>
              <button type="button" class="float-right btn btn-danger-rgba mr-2 " data-toggle="modal"
              data-target="#bulk_delete" title="<?php echo e(__('Delete Selected')); ?>"><i class="feather icon-trash mr-2"></i> <?php echo e(__('Delete Selected')); ?> </button>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('movies.delete')): ?>
            <a href="<?php echo e(route('blog.create')); ?>" class="float-right btn btn-primary-rgba mr-2" title="<?php echo e(__('Add Post')); ?>"><i
                class="feather icon-plus mr-2"></i><?php echo e(__('Add Post')); ?> </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

            <div class="card-body">
                <section id="movies" class="movies-main-block blog-admin-page">
                    <div class="row">
                      <?php if(isset($blogs) && $blogs->count() > 0): ?>
                      <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <input class="permissioncheckbox form-check-card-input visibility-visible" form="bulk_delete_form" type="checkbox" value="39" id="checkbox39" name="checked[]">         
                            <div class="card">
                              <?php if($item->image != NULL): ?>
                              <a href="<?php echo e(url('account/blog/', $item->slug)); ?>" target="__blank" title="<?php echo e($item->title); ?>"><img src="<?php echo e(url('/images/blog/' . $item->image)); ?>" class="card-img-top" alt="<?php echo e($item->title); ?>"></a>
                              <?php else: ?>
                              <a href="<?php echo e(url('account/blog/', $item->slug)); ?>" target="__blank" title="<?php echo e($item->title); ?>"><img src="<?php echo e(Avatar::create($item->title)->toBase64()); ?>" class="card-img-top" alt="<?php echo e($item->title); ?>"></a>
                              <?php endif; ?>
                                <div class="overlay-bg"></div>
                                <div class="dropdown card-dropdown">
                                    <a class="btn btn-round btn-outline-primary pull-right dropdown-toggle" type="button" id="dropdownMenuButton-39" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="<?php echo e(__('Settings')); ?>"><i class="feather icon-more-vertical-"></i></a>
                                    <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton-39">
                                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog.view')): ?>
                                        <a class="dropdown-item" href="<?php echo e(url('account/blog/', $item->slug)); ?>" target="__blank" title="<?php echo e(__('View')); ?>"><i class="feather icon-monitor mr-2"></i> <?php echo e(__('View')); ?></a>     
                                      <?php endif; ?>

                                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog.edit')): ?>                                   
                                        <a class="dropdown-item" href="<?php echo e(route('blog.edit', $item->id)); ?>" title="<?php echo e(__('Edit')); ?>"><i class="feather icon-edit mr-2"></i> <?php echo e(__('Edit')); ?></a>    
                                      <?php endif; ?>
                
                                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog.delete')): ?>                                  
                                        <a type="button" class="dropdown-item" data-toggle="modal" data-target="#deleteModal39" title="<?php echo e(__('Delete')); ?>"><i class="feather icon-trash mr-2"></i> <?php echo e(__('Delete')); ?></a>
                                      <?php endif; ?>
                                    </div>
                                </div>
                                <div id="deleteModal39" class="delete-modal modal fade card-dropdown-modal" role="dialog">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">×</button>
                                                <div class="delete-icon"></div>
                                            </div>
                                            <div class="modal-body text-center">
                                                <h4 class="modal-heading"><?php echo e(__('Are You Sure ?')); ?></h4>
                                                <p><?php echo e(__('Do you really want to delete these records? This process cannot be undone.')); ?></p>
                                            </div>
                                            <div class="modal-footer">
                                              <form method="POST" action="<?php echo e(route("blog.destroy", $item->id)); ?>">
                                                <?php echo method_field('DELETE'); ?>
                                                <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="_method" value="DELETE">                         
                                                    <input type="hidden" name="_token" value="PJpGpor9HW1djPWhvrxuHo7Y48gaHbQtNSlcy9KM">                            
                                                    <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal"><?php echo e(__('No')); ?></button>
                                                    <button type="submit" class="btn btn-danger"><?php echo e(__('Yes')); ?></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header">
                                  <h5 class="card-title"><a href="<?php echo e(url('account/blog/', $item->slug)); ?>" target="__blank" title="<?php echo e($item->title); ?>"><?php echo e($item->title); ?></a></h5><br>
                                </div>
                                <div class="card-body">                                    
                                    <div class="card-block">
                                        <h6 class="card-body-sub-heading"><?php echo e(__('Description')); ?></h6>
                                        <p><?php echo isset($item->detail) && $item->detail != NULL ? str_limit($item->detail,100) : '-'; ?></p>
                                    </div>
                                    <div class="card-block row">
                                        <div class="col-xs-6 col-md-6 col-md-6">
                                            <h6 class="card-body-sub-heading"><?php echo e(__('Status')); ?></h6>
                                            <p class="status-btn">
                                              <?php if($item->is_active == 1): ?>
                                                <p><?php echo e(__('Active')); ?></p>
                                              <?php else: ?>
                                                <p><?php echo e(__('De Active')); ?></p>
                                              <?php endif; ?>
                                            </p>
                                       </div>
                                    </div>              
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-12 pagination-block text-center">
                          <?php echo $blogs->appends(request()->query())->links(); ?>

                        </div>
                      <?php else: ?>
                        <div class="col-md-12 text-center">
                          <h5><?php echo e(__("Let's start :)")); ?></h5>
                          <small><?php echo e(__('Get Started by creating a Blog! All of your Blog will be displayed on this page.')); ?></small>
                        </div>
                      <?php endif; ?>
                    </div>
                </section>
            </div>
        </div>
</div>
</div>
</div>
<?php $__env->stopSection(); ?> 
<?php $__env->startSection('script'); ?>  

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/admin/blog/index.blade.php ENDPATH**/ ?>