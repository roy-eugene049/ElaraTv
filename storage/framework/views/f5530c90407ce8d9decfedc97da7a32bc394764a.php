<!-- This will append Mpesa payment tab content on admin payment settings page. -->
<!-- Mpesa Payment tab content strat -->

<?php $__env->startSection('title', __('adminstaticwords.APISettings')); ?>

<?php $__env->startSection('maincontent'); ?>
<div class="contentbar">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="card m-b-30 mt-4">
                <div class="card-body">
                    <div class="admin-form-main-block mrg-t-40">
                        <div class="admin-form-block z-depth-1">
                        
                            <h6 class="form-block-heading apipadding"><?php echo e(__('MPesa Payemnt Gateway')); ?></h6>
                            <br>
                
                            <form action="<?php echo e(route('mpesa.payment.settings')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <!-- Consumer Secret Key -->
                                        <div class="form-group">
                                            <div class="search">
                                                <label class="text-dark" for="MPESA_CONSUMER_SECRET"> <?php echo e(__("MPESA CONSUMER SECRET:")); ?></label>
                                                <input type="password" class="form-control" id="MPESA_PASSKEY"  name="MPESA_CONSUMER_SECRET" id="MPESA_CONSUMER_SECRET" value="<?php echo e(env('MPESA_CONSUMER_SECRET')); ?>" placeholder='<?php echo e(__("enter your MPESA CONSUMER SECRET KEY")); ?>'>
                                                <span toggle="#MPESA_PASSKEY" class="fa fa-fw fa-eye field-icon toggle-password2"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <!-- Consumer Key -->
                                        <div class="form-group">
                                            <label class="text-dark"><?php echo e(__("Consumer Key:")); ?></label>
                                            <input required name="MPESA_COSUMER_KEY" value="<?php echo e(env('MPESA_COSUMER_KEY')); ?>" type="text" class="form-control" placeholder="<?php echo e(__("Enter CONSUMER KEY")); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <!-- Pass Key -->
                                        <div class="form-group">
                                            <div class="search">
                                                <label class="text-dark" for="MPESA_PASSKEY"><?php echo e(__("MPESA PASS KEY:")); ?></label>
                                                <input id="pass_log_id202" type="password" class="form-control" id="MPESA_PASSKEY"  name="MPESA_PASSKEY" value="<?php echo e(env('MPESA_PASSKEY')); ?>" placeholder='<?php echo e(__("enter your MPESA PASSKEY.")); ?>'>
                                                <span toggle="#pass_log_id202" class="fa fa-fw fa-eye field-icon toggle-password2"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <!-- Shortcode -->
                                        <div class="form-group">
                                            <label class="text-dark"><?php echo e(__("MPESA SHORTCODE:")); ?></label>
                                            <input required name="MPESA_SHORTCODE" value="<?php echo e(env('MPESA_SHORTCODE')); ?>" type="text" class="form-control" placeholder="<?php echo e(__("Enter MPESA SHORTCODE")); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <!-- Status -->
                                        <div class="form-group">
                                            <label class="text-dark" for=""><?php echo e(__("Status:")); ?></label>
                                            <br>
                                            <label class="switch">
                                                <?php echo Form::checkbox('MPESA_ENBALE', 1, (config('mpesa.ENABLE') == 1 ? "checked"  :""), ['id' => 'MPESA_ENBALE','class' => 'checkbox-switch']); ?>

                                                <span class="slider round"></span>
                                            </label>
                                            <br>
                                            <small class="txt-desc"><?php echo e(__("(Active or deactive payment gateway by toggling it.)")); ?></small>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <!-- Live/Sandbox -->
                                        <div class="form-group sandbox-switch">
                                            <label class="text-dark"><?php echo e(__("Sandbox (TEST MODE):")); ?></label>
                                            <br>
                                                <label class="switch">
                                                    <?php echo Form::checkbox('MPESA_SANDBOX', 1, (config('mpesa.MPESA_SANDBOX') == 'live' ? "checked" : ""), ['id' => 'MPESA_SANDBOX', 'class' => 'bootswitch', "data-on-text"=>"LIVE", "data-off-text"=>"SANDBOX", "data-size"=>"small"]); ?>

                                                </label>
                                                <br>
                                            <small class="txt-desc"><?php echo e(__("(Active or deactive test mode in payment gateway by toggling it.)")); ?>

                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-4">
                                        <!-- Reset / Submit Buttom -->
                                        <div class="btn-group">
                                            <a href=<?php echo e(url()->previous()); ?> class="btn btn-info"><i class="material-icons left">reply</i> <?php echo e(__('Back')); ?></a>
                                            <button type="reset" class="btn btn-danger"><i class="material-icons left">toys</i> <?php echo e(__('adminstaticwords.Reset')); ?></button>
                                            <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> <?php echo e(__('Save Settings')); ?></button>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-script'); ?>

    <!-- Script for eye icon password - show/hide -->
    <script>

        $(".toggle-password2").click(function() 
        {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } 
            else {
                input.attr("type", "password");
            }
        });

    </script>

<?php $__env->stopSection(); ?>
<!-- Mpesa Payment tab content end -->
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/Modules/MPesa/Resources/views/admin/tab.blade.php ENDPATH**/ ?>