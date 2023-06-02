
<?php $__env->startSection('title','Manual Payment Gateway'); ?>
<?php $__env->startSection('breadcum'); ?>
	<div class="breadcrumbbar">
        <h4 class="page-title"><?php echo e(__('Manual Payment Gateway')); ?></h4>
        <div class="breadcrumb-list">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>" title="<?php echo e(__('Dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
              <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Manual Payment Gateway')); ?></li>
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
                    <button type="button" class="float-right btn btn-success-rgba mr-2 " data-toggle="modal"
                    data-target=".bd-example-modal-lg" title="<?php echo e(__('Add New')); ?>"><i class="feather icon-plus mr-2"></i> <?php echo e(__('Add New')); ?> </button>
            
            
                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleLargeModalLabel"><?php echo e(__("Add New Manual Payment Gateway")); ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" title="<?php echo e(__('Close')); ?>">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                                
                            <div class="modal-body">
                                <form action="<?php echo e(route('manual.payment.gateway.store')); ?>" method="POST" enctype="multipart/form-data">

                                    <?php echo csrf_field(); ?>
        
                                    <div class="form-group">
                                        <label for="">
                                            <?php echo e(__('Payment Method Name')); ?>: <span class="text-danger">*</span>
                                        </label>
                                        <input required type="text" value="<?php echo e(old('payment_name')); ?>" name="payment_name"
                                            class="form-control" placeholder="<?php echo e(__('Please Enter Payment Method Name')); ?>" />
                                    </div>
        
                                    <div class="form-group">
                                        <label for="">
                                           <?php echo e(__(' Payment Instructions')); ?> : <span class="text-danger">*</span>
                                        </label>
        
                                        <textarea name="description" id="" cols="30" rows="5"
                                            class="form-control editor" placeholder="<?php echo e(__('Please Enter Payment Instructions')); ?>" ><?php echo old('description'); ?></textarea>
        
                                    </div>
        
                                    <div class="form-group">
                                        <label for="">
                                            <?php echo e(__('Image')); ?> :
                                        </label>
                                        <input type="file" class="form-control" name="thumbnail">
                                    </div>
        
                                    <div class="form-group">
                                        <label class="col-md-5 bootstrap-switch-label"><?php echo e(__('Status')); ?> :</label>
                                        <label class="make-switch col-md-7 pad-0">
                                            <input class="custom_toggle" id="status" type="checkbox" name="status" <?php echo e(old('status') ? "checked" : ""); ?>>
                                            
                                        </label>
                                    </div>
        
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" title="<?php echo e(__('Update')); ?>">
                                            <i class="fa fa-save"></i> <?php echo e(__('Create')); ?>

                                        </button>
                                    </div>
        
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            

                    <h5 class="card-title"><?php echo e(__('Manual Payment Gateway')); ?></h5>
                    
                </div> 

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="modules" class="table table-bordered">
                            <thead>
                                <th>#</th>
                                <th><?php echo e(__('Payment Gateway Name')); ?></th>
                                <th><?php echo e(__('Actions')); ?></th>
                            </thead>
                    
                            <tbody>
                                <?php $__currentLoopData = $methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key+1); ?></td>
                                        <td><?php echo e(ucfirst($m->payment_name)); ?></td>
                                        <td>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manual-payment.edit')): ?>
                                            <button type="button" data-toggle="modal" data-target="bd-example-modal-lg<?php echo e($m->id); ?>" class="btn btn-round btn-outline-primary" title="<?php echo e(__('Edit')); ?>">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </button>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manual-payment.delete')): ?>
                                            <button type="button" data-toggle="modal" data-target="#delete<?php echo e($m->id); ?>" class="btn btn-round btn-outline-danger" title="<?php echo e(__('Delete')); ?>">
                                            <i class="fa fa-trash"></i>
                                          </button>
                                        <?php endif; ?>
                                            
                                        </td>
                                    </tr>

                                    
                                        <div class="modal fade bd-example-modal-lg<?php echo e($m->id); ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleLargeModalLabel"><?php echo e(__("Add New Manual Payment Gateway")); ?></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" title="<?php echo e(__('Close')); ?>">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                        
                                                    <div class="modal-body">
                                                        <form action="<?php echo e(route('manual.payment.gateway.update',$m->id)); ?>" method="POST" enctype="multipart/form-data">

                                                            <?php echo csrf_field(); ?>
                        
                                                            <div class="form-group">
                                                                <label for="">
                                                                    <?php echo e(__('Payment Method Name')); ?>: <span class="text-red">*</span>
                                                                </label>
                                                                <input required type="text" value="<?php echo e($m['payment_name']); ?>" name="payment_name" class="form-control"  placeholder="<?php echo e(__('Please Enter Payment Method Name')); ?>"/>
                                                            </div>
                        
                                                            <div class="form-group">
                                                                <label for="">
                                                                    <?php echo e(__('Payment Instructions')); ?> : <span class="text-red">*</span>
                                                                </label>
                        
                                                                <textarea name="description" id="" cols="30" rows="5" class="form-control editor" placeholder="<?php echo e(__('Please Enter Payment Instructions')); ?>"><?php echo $m['description']; ?></textarea>
                        
                                                            </div>
                        
                                                            <div class="form-group">
                                                                <label for="">
                                                                    <?php echo e(__('Image')); ?> :
                                                                </label>
                                                                <input type="file" class="form-control" name="thumbnail">
                                                            </div>
                        
                                                           
                                                                <div class="bootstrap-checkbox form-group<?php echo e($errors->has('status') ? ' has-error' : ''); ?>">
                                                                  <div class="row">
                                                                    <div class="col-md-7">
                                                                      <h5 class="bootstrap-switch-label"><?php echo e(__('Status')); ?></h5>
                                                                    </div>
                                                                    <div class="col-md-5 pad-0">
                                                                      <div class="make-switch">
                                                                        <?php echo Form::checkbox('status', 1, ($m->status == 1 ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>__('On'), "data-off-text"=>__('OFF'), "data-size"=>"small"]); ?>

                                                                        
                                                                      </div>
                                                                    </div>
                                                                  </div>
                                                                
                                                                </div>
                                                           
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-outline-primary" title="<?php echo e(__('Update')); ?>">
                                                                    <i class="fa fa-save"></i> Instructions
                                                                </button>
                                                            </div>
                        
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    


                                
                                    <div id="delete<?php echo e($m->id); ?>" class="delete-modal modal fade" role="dialog">
                                        <div class="modal-dialog modal-sm">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="<?php echo e(__('Close')); ?>"
                                                        data-dismiss="modal" title="">&times;</button>
                                                    <div class="delete-icon"></div>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <h4 class="modal-heading"><?php echo e(__('Are You Sure ?')); ?></h4>
                                                    <p><?php echo e(__('Do you really want to delete selected item names here? This
                                                        process
                                                        cannot be undone.')); ?></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form method="post" action="<?php echo e(route('manual.payment.gateway.delete',$m->id)); ?>">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="modulename" value="<?php echo e($name); ?>">
                                                    <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal"><?php echo e(__('No')); ?></button>
                                                        <button type="submit" class="btn btn-danger"><?php echo e(__('Yes')); ?></button>
                                                  </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/admin/manualpayment/index.blade.php ENDPATH**/ ?>