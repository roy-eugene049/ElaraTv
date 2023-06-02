
<?php $__env->startSection('title','Roles'); ?>
<?php $__env->startSection('breadcum'); ?>
	<div class="breadcrumbbar">
        <h4 class="page-title"><?php echo e(__('ROLES')); ?></h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Roles')); ?></li>
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
                <a href="<?php echo e(route('roles.create')); ?>" class="float-right btn btn-primary-rgba mr-2"><i
                    class="feather icon-plus mr-2"></i><?php echo e(__('Create a new role')); ?></a>
              
             
                <h5 class="card-title"> <?php echo e(__("Roles")); ?></h5>
              
              
          </div>
          
          <div class="card-body">
           
              <div class="table-responsive">
                <table id="roletable" class="table table-borderd responsive " style="width: 100%">

                    <thead>
                        <th class="text-center">
                            #
                        </th>
                        <th class="text-center">
                            <?php echo e(__("Role Name")); ?>

                        </th>
                        <th class="text-center">
                            <?php echo e(__('Action')); ?>

                        </th>
                    </thead>
                
                    <tbody>
                      <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                      <td class="text-center"><?php echo e($key+1); ?></td>
                      <td class="text-center"><?php echo e($role->name); ?></td>
                      <td class="text-center">
                        <?php if(($role->id == 1) || ($role->id == 2) || ($role->id == 3)): ?>
                          <h6 style="color:#a94442;"><b>System reserved role</b></h6>
                      <?php else: ?>
                        <a class="btn btn-round btn-outline-primary" href="<?php echo e(url('/admin/roles/'.$role->id.'/edit')); ?>"> <i class="fa fa-pencil"></i></a>
                        <button type="button" data-toggle="modal" data-target="#delete" class="btn btn-round btn-outline-danger">
                            <i class="fa fa-trash"></i>
                        </button>
                            <div id="delete" class="delete-modal modal fade" role="dialog">
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
                                          <form method="post" action="<?php echo e(url('admin/roles/'.$role->id.'/delete')); ?>" class="pull-right">
                                            <?php echo csrf_field(); ?>
                                            <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal"><?php echo e(__('No')); ?></button>
                                                <button type="submit" class="btn btn-danger"><?php echo e(__('Yes')); ?></button>
                                          </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                      <?php endif; ?>
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
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/roles/index.blade.php ENDPATH**/ ?>