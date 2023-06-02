
<?php $__env->startSection('title',__('Affiliate Reports')); ?>
<?php $__env->startSection('breadcum'); ?>
    <div class="breadcrumbbar">
        <h4 class="page-title"><?php echo e(__('Affiliate Reports')); ?></h4>
        <div class="breadcrumb-list">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>" title="<?php echo e(__('Dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Affiliate Reports')); ?></li>
            </ol>
        </div>                
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('maincontent'); ?>
<div class="contentbar"> 
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                         <table id="affiliate_report" class="table table-borderd">
                            <thead>
                                <th> <?php echo e(__('#')); ?></th>
                                <th> <?php echo e(__('Referred User')); ?></th>
                                <th> <?php echo e(__('Referred By')); ?></th>
                                <th> <?php echo e(__('Amount')); ?></th>
                                <th> <?php echo e(__('Date')); ?></th>
                            </thead>
                            <tbody>
                                
                            </tbody>
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
                                            <?php echo Form::open(['method' => 'POST', 'action' => 'UsersController@bulk_delete', 'id' => 'bulk_delete_form']); ?>

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

    $(function () {
        "use strict";
        jQuery.noConflict();
        var table;
        if($.fn.dataTable.isDataTable('#affiliate_report')){
            table = $('#affiliate_report').DataTable();
        }else{
            table = $('#affiliate_report').DataTable({
                processing: true,
                serverSide: true,
            
                responsive: true,
                autoWidth: false,
                scrollCollapse: true,
                ajax: '<?php echo e(route("admin.affilate.dashboard")); ?>',
                language: {
                    searchPlaceholder: "Search in reports..."
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'affilate_histories.id', searchable : false},
                    {data : 'refered_user', name : 'fromRefered.name'},
                    {data : 'user', name : 'user.name'},
                    {data : 'amount', name : 'affilate_histories.amount'},
                    {data : 'created_at', name : 'affilate_histories.created_at'},
                ],
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;
    
                // converting to interger to find total
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace("<?php echo e($currency_symbol); ?>", '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                var grandtotal = api
                        .column( 4 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    
                        
                    // Update footer by showing the total with the reference of the column index 
                $( api.column( 3).footer() ).html('Total');
                    $( api.column( 4 ).footer() ).html("<?php echo e($currency_symbol); ?>"+'<p>'+grandtotal.toFixed(2)+'</p>');
                },
            
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/admin/affilate/dashboard.blade.php ENDPATH**/ ?>