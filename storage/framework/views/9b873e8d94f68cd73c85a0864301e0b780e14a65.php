
<?php $__env->startSection('title',__('Change Subscription')); ?>
<?php $__env->startSection('breadcum'); ?>
	<div class="breadcrumbbar">
      <h4 class="page-title"><?php echo e(__('User Subscription')); ?></h4>
      <div class="breadcrumb-list">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>" title="<?php echo e(__('Dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('User Subscription')); ?></li>
          </ol>
      </div>    
  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('maincontent'); ?>
<div class="contentbar"> 
  <div class="row">
    <div class="col-md-12">
      <div class="card m-b-50">
        <div class="card-body">
          <div class="table-responsive">
            <table id="plan_table" class="table table-borderd">
              <thead>
                <th><?php echo e(__('ID')); ?></th>
                <th><?php echo e(__('Name')); ?></th>
                <th><?php echo e(__('Email')); ?></th>
                <th><?php echo e(__('Plans')); ?></th>
                <th><?php echo e(__('Subscribtion Expire')); ?></th>
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
    jQuery.noConflict();
    var table;
    if($.fn.dataTable.isDataTable('#plan_table')){
      table = $('#plan_table').DataTable();
    }else{
      table = $('#plan_table').DataTable({
        processing: true,
        serverSide: true,
         responsive: true,
        autoWidth: false,
        scrollCollapse: true,
     
        ajax: "<?php echo e(route('plan.index')); ?>",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'username', name: 'username'},
            {data : 'useremail', name: 'useremail'},
            {data : 'planname', name: 'planname'},
            {data : 'subscription_to', name : 'subscription_to'},
            {data : 'action', name: 'action'}
    
        ],
        dom : 'lBfrtip',
        buttons : [
          'csv','excel','pdf','print'
        ],
        order : [[0,'DESC']]
      });
    }
    
    
  });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/admin/plan/index.blade.php ENDPATH**/ ?>