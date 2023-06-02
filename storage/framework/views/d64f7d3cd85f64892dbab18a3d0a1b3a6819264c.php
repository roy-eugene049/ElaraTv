
<?php $__env->startSection('title',__('All Slider')); ?>
<?php $__env->startSection('breadcum'); ?>
  <div class="breadcrumbbar">
    <h4 class="page-title"><?php echo e(__('All Slider')); ?></h4>
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>" title="<?php echo e(__('Dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
          <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('All Slider')); ?></li>
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
              <a href="<?php echo e(route('home_slider.create')); ?>" class="float-right btn btn-primary-rgba mr-2" title="<?php echo e(__('Add Slide')); ?>"><i
                  class="feather icon-plus mr-2"></i><?php echo e(__('Add Slide')); ?></a>
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
                              <?php echo Form::open(['method' => 'POST', 'action' => 'HomeSliderController@bulk_delete', 'id' => 'bulk_delete_form']); ?>

                                    <?php echo method_field('POST'); ?>
                                    <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal"><?php echo e(__('No')); ?></button>
                                    <button type="submit" class="btn btn-danger"><?php echo e(__('Yes')); ?></button>
                                <?php echo Form::close(); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <h5 class="card-title"> <?php echo e(__("All Slider")); ?></h5>
          </div>
          
          <div class="card-body">
           
              <div class="table-responsive">
                <table id="full_detail_table" class="table table-borderd responsive " style="width: 100%">
                  <thead>
                    <tr class="table-heading-row">
                    <th>
                      <div class="inline">
                        <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
                        <label for="checkboxAll" class="material-checkbox"></label>
                      </div>
                      #
                    </th>
                    <th><?php echo e(__('Movie')); ?></th>
                    <th><?php echo e(__('TV Series')); ?></th>
                    <th><?php echo e(__('Slide Image')); ?></th>
                    <th><?php echo e(__('Active')); ?></th>
                    <th><?php echo e(__('Actions')); ?></th>
                  </tr>
                  </thead>
                  <?php if($home_slides): ?>
                    <tbody id="sortable">
                    <?php $__currentLoopData = $home_slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $home_slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr class="sortable row1" data-id="<?php echo e($home_slide->id); ?>">
                        <td>
                          <div class="inline">
                            <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="<?php echo e($home_slide->id); ?>" id="checkbox<?php echo e($home_slide->id); ?>">
                            <label for="checkbox<?php echo e($home_slide->id); ?>" class="material-checkbox"></label>
                          </div>
                          <a class="handle"><i class="fa fa-unsorted" style="opacity: 0.3"></i></a>
                          <?php echo e($key+1); ?>

                        </td>
                        <td><?php echo e($home_slide->movie ? $home_slide->movie->title : '-'); ?></td>
                        <td><?php echo e($home_slide->tvseries ? $home_slide->tvseries->title : '-'); ?></td>
                        <td class="app-slider-image">
                          <?php if(isset($home_slide->slide_image)): ?>
                            <?php if(isset($home_slide->movie) && $home_slide->movie_id != NULL): ?>
                              <?php if($home_slide->movie != null && $home_slide->movie_id != NULL): ?>
                                <img src="<?php echo e(asset('images/home_slider/movies/'. $home_slide->slide_image)); ?>" class="img-responsive" alt="slide-image">
                              <?php elseif($home_slide->movie->poster != null): ?>
                                <img src="<?php echo e(asset('images/movies/posters/'. $home_slide->movie->poster)); ?>" class="img-responsive" alt="slide-image">
                              <?php endif; ?>
                            <?php elseif(isset($home_slide->tvseries)&& $home_slide->tv_series_id != NULL): ?>
                              <?php if($home_slide->slide_image != null): ?>
                                <img src="<?php echo e(asset('images/home_slider/shows/'. $home_slide->slide_image)); ?>" class="img-responsive" alt="slide-image">
                              <?php elseif($home_slide->tvseries['poster'] != null): ?>
                                <img src="<?php echo e(asset('images/tvseries/posters/'. $home_slide->tvseries['poster'])); ?>" class="img-responsive" alt="slide-image">
                              <?php endif; ?>
                            <?php else: ?>
                              <?php if($home_slide->slide_image != null): ?>
                                <img src="<?php echo e(asset('images/home_slider/'. $home_slide->slide_image)); ?>" class="img-responsive" alt="slide-image">
                              <?php endif; ?>
                            <?php endif; ?>
                          <?php endif; ?>
                        </td>
                        <td><?php echo e($home_slide->active == 1 ? __('Active') : __('inactive')); ?></td>
                        <td>
                          <div class="admin-table-action-block">
                            <a href="<?php echo e(route('home_slider.edit', $home_slide->id)); ?>" data-toggle="" data-original-title="<?php echo e(__('Edit')); ?>" class="btn btn-round btn-outline-primary" title="<?php echo e(__('Edit')); ?>"> <i class="fa fa-edit"></i></a>
                            <button type="button" class="btn btn-round btn-outline-danger" data-toggle="modal" data-target="#delete<?php echo e($home_slide->id); ?>" title="<?php echo e(__('Delete')); ?>"><i class="fa fa-trash"></i> </button>
                          </div>
                        </td>
                      </tr>
                      <!-- Delete Modal -->
                      <div id="delete<?php echo e($home_slide->id); ?>" class="delete-modal modal fade" role="dialog">
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
                                  <?php echo Form::open(['method' => 'DELETE', 'action' => ['HomeSliderController@destroy', $home_slide->id]]); ?>

                                        <?php echo method_field('POST'); ?>
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
  var sorturl = <?php echo json_encode(route('slide_reposition')); ?>;
</script>
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
    $( "#full_detail_table" ).sortable({
      items: "tr",
      cursor: 'move',
      opacity: 0.6,
      update: function() {
          sendOrderToServer();
      }
    });

  })(jQuery);  

  function sendOrderToServer() {
    var order = [];
    var token = $('meta[name="csrf-token"]').attr('content');
    $('tr.row1').each(function(index,element) {
      order.push({
        id: $(this).attr('data-id'),
        position: index+1
      });
    });
    $.ajax({
      type: "POST", 
      dataType: "json", 
      url: sorturl,
      data: {
          order: order,
        _token: token
      },
      success: function(response) {
          if (response.status == "success") {
            console.log(response);
          } else {
            console.log(response);
          }
      }
    });
  }
  
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/admin/homeslider/index.blade.php ENDPATH**/ ?>