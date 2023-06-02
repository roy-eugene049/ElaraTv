
<?php $__env->startSection('title',__('Addon Manager')); ?>
<?php $__env->startSection('breadcum'); ?>
	<div class="breadcrumbbar">
        <h4 class="page-title"><?php echo e(__('Addon Manager')); ?></h4>
        <div class="breadcrumb-list">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>" title="<?php echo e(__('Dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
              <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Addon Manager')); ?></li>
            </ol>
        </div>                    
    </div>
    
<?php $__env->stopSection(); ?>
<?php $__env->startSection('maincontent'); ?>
<div class="contentbar"> 
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <button type="button" class="float-right btn btn-primary-rgba mr-2 " data-toggle="modal"
                    data-target=".bd-example-modal-lg" title="<?php echo e(__('Install New Addon')); ?>"><i class="feather icon-plus mr-2"></i> <?php echo e(__('Install New Addon')); ?> </button>
            
            
                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleLargeModalLabel"><?php echo e(__("Install New Addon")); ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" title="<?php echo e(__('Close')); ?>">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                                
                            <div class="modal-body">
                                <form action="<?php echo e(route('addon.install')); ?>" method="POST" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group">
                                        <label><?php echo e(__('Enter Purchase Code')); ?>: <span class="text-danger">*</span></label>
                                        <input type="text" placeholder="<?php echo e(__('Enter Purchase Code of Your Addon')); ?>" class="form-control" name="purchase_code">
                                    </div>
            
                                    <div class="form-group">
                                        <label><?php echo e(__('Choose Addon Zip File')); ?>: <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="addon_file">
                                    </div>
            
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" title="<?php echo e(__('Install')); ?>"><i class="feather icon-plus"></i> <?php echo e(__('Install')); ?></button>
                                     
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            
                    <h5 class="card-title"><?php echo e(__('Addon Manager')); ?></h5>                    
                </div> 

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="modules" class="table table-bordered">
                            <thead>
                                <th>#</th>
                                <th><?php echo e(__('Logo')); ?></th>
                                <th><?php echo e(__('Addon Name')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                                <th><?php echo e(__('Version')); ?></th>
                                <th><?php echo e(__('Actions')); ?></th>
                            </thead>                    
                            <tbody>                    
                            </tbody>
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
    $(function () {
        "use strict";
        jQuery.noConflict();
        var table;
        if($.fn.dataTable.isDataTable( '#modules')){
            table = $('#modules').DataTable();
        }else{
            table = $('#modules').DataTable({
                processing: true,
                serverSide: true,
                ajax: '<?php echo e(url("admin/addon-manger")); ?>',
                language: {
                    searchPlaceholder: "Search Addon..."
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable : false
                    },
                    {
                        data: 'image',
                        name: 'image',
                        searchable: false,
                        orderable : false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'version',
                        name: 'version'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
                dom: 'lBfrtip',
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ],
                order: [
                    [0, 'DESC']
                ]
            });
        }
        

        $('#modules').on('change', '.toggle_addon', function (e) { 

            var modulename = $(this).data('addon');

            if($(this).is(':checked')){
                var status = 1;
            }else{
                var status = 0;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url : '<?php echo e(url("admin/toggle/module")); ?>',
                method : 'POST',
                data : {status : status, modulename : modulename},
                success :function(data){
                    table.draw();

                    if(data.status == 'success'){
                        toastr.success(data.msg,{timeOut: 1500});
                    }else{
                        toastr.error(data.msg, 'Oops!',{timeOut: 1500});
                    }
                    
                },
                error : function(jqXHR,err){
                    console.log(err);
                }
            });

        });

    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/admin/addonmanager/index.blade.php ENDPATH**/ ?>