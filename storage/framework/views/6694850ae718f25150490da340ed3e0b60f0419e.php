
<?php $__env->startSection('title',__('Landing Pages')); ?>
<?php $__env->startSection('breadcum'); ?>
	<div class="breadcrumbbar">
      <h4 class="page-title"><?php echo e(__('Landing Pages')); ?></h4>
      <div class="breadcrumb-list">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>" title="<?php echo e(__('Dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Landing Pages')); ?></li>
          </ol>
      </div> 
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('maincontent'); ?>
<div class="contentbar">
<div class="row">
  
  <div class="col-lg-12">
      <div class="card m-b-50">
          <div class="card-header">
            <button type="button" class="float-right btn btn-danger-rgba mr-2 " data-toggle="modal"
          data-target="#bulk_delete" title="<?php echo e(__('Delete Selected')); ?>"><i class="feather icon-trash mr-2"></i> <?php echo e(__('Delete Selected')); ?> </button>
            <a href="<?php echo e(route('landing-page.create')); ?>" class="float-right btn btn-primary-rgba mr-2" title="<?php echo e(__('Create Slide')); ?>"><i
                class="feather icon-plus mr-2"></i><?php echo e(__('Create Slide')); ?></a>
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
                            <?php echo Form::open(['method' => 'POST', 'action' => 'LandingPageController@bulk_delete', 'id' => 'bulk_delete_form']); ?>

                                  <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal"><?php echo e(__('No')); ?></button>
                                  <button type="submit" class="btn btn-danger"><?php echo e(__('Yes')); ?></button>
                              <?php echo Form::close(); ?>

                          </div>
                      </div>
                  </div>
              </div>
                <h5 class="card-title"> <?php echo e(__("Landing Pages")); ?></h5>
          </div>
          
          <div class="card-body">
           
              <div class="table-responsive">
                <table id="full_detail_table" class="table table-borderd responsive " style="width: 100%">

                    <thead>
                      <th>
                        <div class="inline">
                          <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
                          <label for="checkboxAll" class="material-checkbox"></label>
                        </div>
                      </th>
                      <th><?php echo e(__('Image')); ?></th>
                      <th><?php echo e(__('Slide Heading')); ?></th>
                      <th><?php echo e(__('Details')); ?></th>
                      <th><?php echo e(__('Button For')); ?></th>
                      <th><?php echo e(__('Image Position')); ?></th>
                      <th><?php echo e(__('Actions')); ?></th>
                    </thead>
                
                    <tbody>

                      <?php if($landing_pages): ?>
                      <tbody>
                        <?php $__currentLoopData = $landing_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr id="item-<?php echo e($block->id); ?>">
                            <td>
                              <div class="inline">
                                <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="<?php echo e($block->id); ?>" id="checkbox<?php echo e($block->id); ?>">
                                <label for="checkbox<?php echo e($block->id); ?>" class="material-checkbox"></label>
                              </div>
                              <?php echo e($key+1); ?>

                            </td>
                            <td>
                              <?php if($block->image != null): ?> 
                                <img src="<?php echo e(asset('images/main-home/'.$block->image)); ?>" width="140px" height="50px" class="img-responsive">
                              <?php endif; ?>
                            </td>
                            <td><?php echo e($block->heading); ?></td>
                            <td title="<?php echo e($block->detail); ?>"><?php echo e(str_limit($block->detail, 50)); ?></td>
                            <td>
                              <?php if($block->button == 1): ?>
                                <?php if($block->button_link == 'login'): ?>
                                  <a href="#" data-toggle="tooltip" data-original-title="Login Link" class="btn btn-prime"><?php echo e($block->button_text); ?></a>
                                <?php elseif($block->button_link == 'register'): ?>  
                                  <a href="#" data-toggle="tooltip" data-original-title="Register Link" class="btn btn-prime"><?php echo e($block->button_text); ?></a>
                                <?php endif; ?>
                              <?php endif; ?>
                            </td>
                            <td><?php echo e($block->left == 1 ? 'Left' : 'Right'); ?></td>
                            <td>
                              <div class="admin-table-action-block">
                                <a href="<?php echo e(route('landing-page.edit', $block->id)); ?>" data-toggle="" data-original-title="<?php echo e(__('Edit')); ?>" class="btn btn-round btn-outline-primary" title="<?php echo e(__('Edit')); ?>"> <i class="fa fa-edit"></i></a>
                                <button type="button" class="btn btn-round btn-outline-danger" data-toggle="modal" data-target="#delete<?php echo e($block->id); ?>" title="<?php echo e(__('Delete')); ?>"><i class="fa fa-trash"></i> </button>
                              </div>
                            </td>
                          </tr>
                          <div id="delete<?php echo e($block->id); ?>" class="delete-modal modal fade" role="dialog">
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
                                      <?php echo Form::open(['method' => 'DELETE', 'action' => ['LandingPageController@destroy', $block->id]]); ?>

                                            <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal"><?php echo e(__('No')); ?></button>
                                            <button type="submit" class="btn btn-danger"><?php echo e(__('Yes')); ?></button>
                                        <?php echo Form::close(); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tbody>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?> 
<?php $__env->startSection('script'); ?>
<script>
  (function($){
    $('#checkboxAll').on('change', function(){
      if($(this).prop("checked") == true){
        $('.material-checkbox-input').attr('checked', true);
      }
      else if($(this).prop("checked") == false){
        $('.material-checkbox-input').attr('checked', false);
      }
    });

    $('table.db tbody').sortable({
      cursor: "move",
      revert: true,
      placeholder: 'sort-highlight',
      connectWith: '.connectedSortable',
      forcePlaceholderSize: true,
      zIndex: 999999,
      axis: 'y',
      update: function(event, ui) {
        var data = $(this).sortable('serialize');
        app.$http.post('<?php echo e(route('landing_page_reposition')); ?>', {item: data}).then((response) => {
          console.log(data);
          console.log('re');
          console.log(response);
        }).catch((e) => {
          console.log($(this).sortable('serialize'));
          console.log(e);
          console.log('err');
        });
      }
    });
  })(jQuery);
 
  $(window).resize(function() {
    $('table.db tr').css('min-width', $('table.db').width());
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/admin/landing-page/index.blade.php ENDPATH**/ ?>