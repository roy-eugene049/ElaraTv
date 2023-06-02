
<?php $__env->startSection('title',__('Google Advertise')); ?>
<?php $__env->startSection('stylesheet'); ?>
<style>
  .fl::first-letter {text-transform:uppercase}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcum'); ?>
	<div class="breadcrumbbar">
                <h4 class="page-title"><?php echo e(__('Google Advertise')); ?></h4>
                <div class="breadcrumb-list">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
                      <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Google Advertise')); ?></li>
                    </ol>
                </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('maincontent'); ?>
<div class="contentbar">
<div class="row">
  
  <div class="col-lg-12">
      <div class="card m-b-30">
          <div class="card-header"><button type="button" class="float-right btn btn-danger-rgba mr-2 " data-toggle="modal"
            data-target="#bulk_delete"><i class="feather icon-trash mr-2"></i> <?php echo e(__('Delete Selected')); ?> </button>
              <a href="<?php echo e(route('google.ads.create')); ?>" class="float-right btn btn-primary-rgba mr-2"><i
                  class="feather icon-plus mr-2"></i><?php echo e(__('Create AD')); ?></a>
                  <div id="bulk_delete" class="delete-modal modal fade" role="dialog">
              <div class="modal-dialog modal-sm">
                  <!-- Modal content-->
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close"
                              data-dismiss="modal">&times;</button>
                          <div class="delete-icon"></div>
                      </div>
                      <div class="modal-body text-center">
                          <h4 class="modal-heading"><?php echo e(__('Are You Sure ?')); ?></h4>
                          <p><?php echo e(__('Do you really want to delete selected item names here? This
                              process
                              cannot be undone.')); ?></p>
                      </div>
                      <div class="modal-footer">
                        <?php echo Form::open(['method' => 'POST', 'action' => 'GoogleAdsController@bulk_delete', 'id' => 'bulk_delete_form']); ?>

                              <?php echo method_field('POST'); ?>
                              <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal"><?php echo e(__('No')); ?></button>
                              <button type="submit" class="btn btn-danger"><?php echo e(__('Yes')); ?></button>
                          <?php echo Form::close(); ?>

                      </div>
                  </div>
              </div>
                <h5 class="card-title"> <?php echo e(__("Create AD")); ?></h5>
          </div>
          
          <div class="card-body">
           
              <div class="table-responsive">
                <table id="roletable" class="table table-borderd responsive " style="width: 100%">

                    <thead>
                      <th>
                        <div class="inline">
                          <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
                          <label for="checkboxAll" class="material-checkbox">#</label>
                        </div>
                      </th>
                      <th><?php echo e(__('Google Ad Client')); ?></th>
                      <th><?php echo e(__('Google Ad Slot')); ?></th>
                      <th><?php echo e(__('Edit')); ?></th>
                      <th><?php echo e(__('Actions')); ?></th>
                    </thead>
                
                    <tbody>
                      <tr>
                        <?php $i=0; ?>
                        <?php $__currentLoopData = $googleads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $i++ ?>
        
                        <td>
                          <div class="inline">
                            <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="<?php echo e($ad->id); ?>" id="checkbox<?php echo e($ad->id); ?>">
                            <label for="checkbox<?php echo e($ad->id); ?>" class="material-checkbox"></label>
                          </div>
                        </td>
        
                         <td><?php echo e($i); ?></td>
                         <td class="fl"><?php echo e($ad->google_ad_client); ?></td>
                         <td class="fl"><?php echo e($ad->google_ad_slot); ?></td>
                         <td><a href="<?php echo e(route('google.ads.edit',$ad->id)); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>" class="btn btn-round btn-outline-primary"> <i class="fa fa-edit"></i></a></td>
                         <td>
                             <form action="<?php echo e(route('google.ads.delete',$ad->id)); ?>" method="POST">
                                <?php echo e(csrf_field()); ?> 
                                <?php echo e(method_field('DELETE')); ?>

                                <button type="submit" value="<?php echo e(__('Delete')); ?>" onclick="return confirm('Are you sure?')" class="btn btn-round btn-outline-danger" ><i class="fa fa-trash"></i> </button>
                                
                             </form>
                         </td>
                         </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?> 
<?php $__env->startSection('script'); ?>
<script>
  $(function(){
    $('#checkboxAll').on('change', function(){
      if($(this).prop("checked") == true){
        $('.material-checkbox-input').attr('checked', true);
      }
      else if($(this).prop("checked") == false){
        $('.material-checkbox-input').attr('checked', false);
      }
    });
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/googleads/index.blade.php ENDPATH**/ ?>