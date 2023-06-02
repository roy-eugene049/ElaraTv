
<?php $__env->startSection('title',__('All Package Features')); ?>
<?php $__env->startSection('breadcum'); ?>
	<div class="breadcrumbbar">
        <h4 class="page-title"><?php echo e(__('All Package Features')); ?></h4>
        <div class="breadcrumb-list">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>" title="<?php echo e(__('Dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
              <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Package Features')); ?></li>
            </ol>
        </div>   
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('maincontent'); ?>
<div class="contentbar"> 
    <div class="row">
        <div class="col-md-12">

            <div class="card m-b-50">
                <div class="card-header">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('package-feature.delete')): ?>
            <button type="button" class="float-right btn btn-danger-rgba mr-2 " data-toggle="modal"
            data-target="#bulk_delete" title="<?php echo e(__('Delete Selected')); ?>"><i class="feather icon-trash mr-2"></i> <?php echo e(__('Delete Selected')); ?> </button>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('package-feature.create')): ?>
            <a href="<?php echo e(route('package_feature.create')); ?>" class="float-right btn btn-primary-rgba mr-2" title="<?php echo e(__('Create Package Feature')); ?>"><i
                class="feather icon-plus mr-2"></i><?php echo e(__('Create Package Feature')); ?> </a>
              <?php endif; ?>
                    <h5 class="card-title"><?php echo e(__('All Package Features')); ?></h5>
                    
                </div> 

                <div class="card-body">
                    <div class="table-responsive">
                         <table id="package_featureTable" class="table table-borderd">

                            <thead>
                                <th> <?php echo e(__('#')); ?></th>
                                <th> <?php echo e(__('PACAKGE FEATURE')); ?></th>
                                <th> <?php echo e(__('ACTION')); ?></th>
                            </thead>

                            <?php if($p_feature): ?>
                            <tbody>
                         
                            </tbody>
                          <?php endif; ?>

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
                                            <?php echo Form::open(['method' => 'POST', 'action' => 'PackageFeatureController@bulk_delete', 'id' => 'bulk_delete_form']); ?>

                                                <?php echo method_field('POST'); ?>
                                                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal"><?php echo e(__('No')); ?></button>
                                                <button type="submit" class="btn btn-danger"><?php echo e(__('Yes')); ?></button>
                                            <?php echo Form::close(); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </table>                  
                    </div>
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
 <script>
  $(function () {
    jQuery.noConflict();
    var table;
    if ( $.fn.dataTable.isDataTable( '#package_featureTable' ) ) {
        table = $('#package_featureTable').DataTable()
    }else{
        var table = $('#package_featureTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            autoWidth: false,
            scrollCollapse: true,
     
       
            ajax: "<?php echo e(route('package_feature.index')); ?>",
            columns: [
                {data: 'checkbox', name: 'checkbox',orderable: false, searchable: false},
                {data: 'name', name: 'name'},
                {data: 'action', name: 'action',searchable: false}
            
            ],
            dom : 'lBfrtip',
            buttons : [
            'csv','excel','pdf','print'
            ],
            order : [[0,'desc']]
        });    
    }
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/admin/package_feature/index.blade.php ENDPATH**/ ?>