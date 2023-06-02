
<?php $__env->startSection('title',__('All Audio Languages')); ?>
<?php $__env->startSection('breadcum'); ?>
	<div class="breadcrumbbar">
    <h4 class="page-title"><?php echo e(__('All Audio Languages')); ?></h4>
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>" title="<?php echo e(__('Dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
          <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('All Audio Languages')); ?></li>
        </ol>
    </div>  
  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('maincontent'); ?>
<div class="contentbar"> 
  <div class="row">
    <div class="col-md-12">
      <div class="card-header movie-create-heading mb-4 pb-4">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-12">
            <form class="navbar-form" role="search">
            <div class="input-group ">
                <form method="get" action="">
                <input value="<?php echo e(app('request')->input('name') ?? ''); ?>" type="text" name="search" class="form-control float-left text-center" placeholder="<?php echo e(__('Search Audio Language')); ?>">
                <button type="submit" class="search-button"><i class="fa fa-search"></i></button>
                </form>
            </div>
            </form>
          </div>
          <div class="col-lg-8 col-md-8 col-12">
                
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('audiolanguage.delete')): ?>
              <button type="button" class="float-right btn btn-danger-rgba mr-2 " data-toggle="modal"
              data-target="#bulk_delete"><i class="feather icon-trash mr-2"></i> <?php echo e(__('Delete Selected')); ?> </button>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('audiolanguage.create')): ?>
            <a href="<?php echo e(route('audio_language.create')); ?>" class="float-right btn btn-primary-rgba mr-2" title="<?php echo e(__('Create Audio Language')); ?>"><i
                class="feather icon-plus mr-2"></i><?php echo e(__('Create Audio Language')); ?> </a>
            <?php endif; ?>
            
            <div id="bulk_delete" class="delete-modal modal fade" role="dialog">
                <div class="modal-dialog modal-sm">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close"
                                data-dismiss="modal" title="<?php echo e(__('Close')); ?>">&times;</button>
                            <div class="delete-icon"></div>
                        </div>
                        <div class="modal-body text-center">
                            <h4 class="modal-heading"><?php echo e(__('Are You Sure ?')); ?></h4>
                            <p><?php echo e(__('Do you really want to delete selected item names here? This
                                process
                                cannot be undone.')); ?></p>
                        </div>
                        <div class="modal-footer">
                            <?php echo Form::open(['method' => 'POST', 'action' => 'AudioLanguageController@bulk_delete', 'id' => 'bulk_delete_form']); ?>

                                <?php echo method_field('POST'); ?>
                                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal"><?php echo e(__('No')); ?></button>
                                <button type="submit" class="btn btn-danger"><?php echo e(__('Yes')); ?></button>
                            <?php echo Form::close(); ?>

                        </div>
                    </div>
                </div>
            </div>
            
          </div>
        </div>
      </div>
            
        <div class="row">
            <!-- Start col -->
        <?php if($audio_languages != NULL && count($audio_languages) > 0): ?>
          <?php $__currentLoopData = $audio_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php
            if($item->image != NULL){
              $content = @file_get_contents(public_path() .'/images/audiolanguage/' . $item->image); 
              if($content){
                $image = public_path() .'/images/audiolanguage/' . $item->image;
              }else{
                $image = Avatar::create($item->name)->toBase64();
              }
            }else{
              $image = Avatar::create($item->name)->toBase64();
            }

            $imageData = base64_encode(@file_get_contents($image));
            if($imageData){
                $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
            } 
          ?>
            <div class="col-md-6 col-lg-6 col-xl-2">
                <div class="card m-b-30 audio-lang-page">
                    <?php if($src != NULL): ?>
                        <img class="card-img-top" src="<?php echo e($src); ?>" alt="<?php echo e($item->language); ?>">
                    <?php endif; ?>
                    <div class="card-img-overlay">
                        <h5 class="card-title text-white font-18 text-center"><?php echo e($item->language); ?></h5>                 
                    </div>     
                    <div class="card-body">
                        <div class="row mt-1 mb-1 justify-content-center">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('genre.edit')): ?>
                        <div class="col-2 mr-2">
                            <a href="<?php echo e(route('audio_language.edit', $item->id)); ?>">
                            <i title="Edit" class="feather icon-edit mr-5"></i></a>
                            </div>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('genre.delete')): ?>
                        <div class="col-2">
                            <a href="" data-toggle="modal" data-target="#delete<?php echo e($item->id); ?>">
                              <i title="Delete" class="text-primary feather icon-trash"></i></a>
          
                            <div class="modal fade bd-example-modal-sm" id="delete<?php echo e($item->id); ?>" tabindex="-1" role="dialog"
                              aria-hidden="true">
                              <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleSmallModalLabel"><?php echo e(__('Delete')); ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <h4><?php echo e(__('Are You Sure ?')); ?></h4>
                                    <p><?php echo e(__('Do you really want to delete')); ?> ? <?php echo e(__('This process cannot be undone.')); ?></p>
                                  </div>
                                  <div class="modal-footer">
                                    <form method="post" action="<?php echo e(route("audio_language.destroy", $item->id)); ?>" class="pull-right">
                                      <?php echo e(csrf_field()); ?>

                                      <?php echo e(method_field("DELETE")); ?>

                                      <button type="reset" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('No')); ?></button>
                                      <button type="submit" class="btn btn-primary"><?php echo e(__('Yes')); ?></button>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php endif; ?>
                        </div>
                    </div>
                    </div>
                </div> 
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <div class="col-md-12 pagination-block">
          <?php echo $audio_languages->appends(request()->query())->links(); ?>

         </div> 
        </div>
    </div></div>
</div>
</div>
</div>
<?php $__env->stopSection(); ?> 
<?php $__env->startSection('script'); ?>
   

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/admin/audio_language/index.blade.php ENDPATH**/ ?>