
<?php $__env->startSection('title', __('Payment Gateway Settings')); ?>
<?php $__env->startSection('breadcum'); ?>
<div class="breadcrumbbar">
    <h4 class="page-title"><?php echo e(__('Payment Gateway Settings')); ?></h4>
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>" title="<?php echo e(__('Dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
          <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Payment Gateway Settings')); ?></li>
        </ol>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('maincontent'); ?>
<div class="contentbar">
  <div class="row">
    <div class="col-lg-12">
      <div class="card m-b-30">
        <div class="card-header">
          <h5 class="box-title"><?php echo e(__('Payment Gateway Settings')); ?></h5>
        </div>
        <div class="card-body ml-2">
          <?php echo Form::model($env_files, ['method' => 'POST', 'action' => 'ConfigController@changeEnvKeys']); ?>

<div class="row">
  <div class="col-md-6 col-lg-6 col-xl-12">
    <div class="bg-primary ml-6 mr-6 mb-6">
      <div class="card-header text-white"><h4 class="text-white"><i class="feather icon-Settings" aria-hidden="true"></i> <?php echo e(__('PAYEMNT GATEWAYS')); ?></h4></div>
  </div>
</div>

<!-- ======= STRIPE PAYMENT start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
    <div class="bg-info-rgba ml-6 mr-6 mb-6">
        <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> <?php echo e(__('Stripe Payment Gateway')); ?></h4></div>
            <div class="payment-gateway-block">
                <div class="form-group">
                    <div class="row mx-2 my-4">
                        <div class="col-md-10">
                            <?php echo Form::label('stripe_payment', __('Stripe Payment Gateway')); ?>

                            <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo e(__('All plans and coupons create from the Admin Panel. Dont create from strip account. All your test is complete then make a stripe to live mode, Stripe Test Mode user and packages not support to live mode.')); ?>">
                              <i class="fa fa-info"></i>
                            </small>

                        </div>
                        <div class="col-md-2">
                            <label class="switch">
                                <?php echo Form::checkbox('stripe_payment', 1, $config->stripe_payment, ['class' => 'custom_toggle']); ?>

                            </label>
                        </div>
                    </div>
                </div>
                <div class="row mx-2 my-4" style="<?php echo e($config->stripe_payment==1 ? "" : "display: none"); ?>" id="stripe_box">
                    <div class="col-md-6">
                        <div class="form-group<?php echo e($errors->has('STRIPE_KEY') ? ' has-error' : ''); ?>">
                            <label class="text-dark"><?php echo e(__('STRIPE KEY')); ?> <sup class="text-danger">*</sup></label>
                            <?php echo Form::text('STRIPE_KEY', null, ['class' => 'form-control']); ?>

                            <small class="text-danger"><?php echo e($errors->first('STRIPE_KEY')); ?></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="search form-group<?php echo e($errors->has('STRIPE_SECRET') ? ' has-error' : ''); ?>">
                            <label class="text-dark"><?php echo e(__('STRIPE SECRET KEY')); ?> <sup class="text-danger">*</sup></label>
                            <input class ="form-control" type="text" name="STRIPE_SECRET" id="captcha-password-field" value= "<?php echo e($env_files['STRIPE_SECRET']); ?>">
                            <small class="text-danger"><?php echo e($errors->first('STRIPE_SECRET')); ?></small>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
<!-- ======= STRIPE PAYMENT end ========== -->

<!-- ======= PAYPAL PAYMENT start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
  <div class="bg-info-rgba ml-6 mr-6 mb-6">
      <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> <?php echo e(__('PayPal Payment Gateway')); ?></h4></div>
          <div class="payment-gateway-block">
              <div class="form-group">
                  <div class="row mx-2 my-4">
                      <div class="col-md-10">
                        <?php echo Form::label('paypal_payment', __('PayPal Payment Gateway')); ?>

                        <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo e(__('For Paypal payment gateway You Need Paypal Key. Go To: https://developer.paypal.com/. All your test complete then make Payment Gateway to live mode,  Payment Gateway Sandbox Mode user and price not support to live mode.')); ?>">
                          <i class="fa fa-info"></i>
                        </small>
                      </div>
                      <div class="col-md-2">
                          <label class="switch">
                            <?php echo Form::checkbox('paypal_payment', 1, $config->paypal_payment, ['class' => 'custom_toggle']); ?>

                          </label>
                      </div>
                  </div>
              </div>
              <div class="row mx-2 my-4" style="<?php echo e($config->paypal_payment==1 ? "" : "display: none"); ?>" id="paypal_box">
                  <div class="col-md-3">
                      <div class="form-group<?php echo e($errors->has('PAYPAL_CLIENT_ID') ? ' has-error' : ''); ?>">
                          <label class="text-dark"><?php echo e(__('PayPal Client ID')); ?> <sup class="text-danger">*</sup></label>
                          <input type="text" name="PAYPAL_CLIENT_ID" value="<?php echo e($env_files['PAYPAL_CLIENT_ID']); ?>" id="pclientid" class="form-control">
                          <small class="text-danger"><?php echo e($errors->first('PAYPAL_CLIENT_ID')); ?></small>
                      </div>
                  </div>

                  <div class="col-md-6">
                      <div class="search form-group<?php echo e($errors->has('PAYPAL_SECRET_ID') ? ' has-error' : ''); ?>">
                          <label class="text-dark"><?php echo e(__('PayPal Secret ID')); ?> <sup class="text-danger">*</sup></label>
                          <input type="text" name="PAYPAL_SECRET_ID" value="<?php echo e($env_files['PAYPAL_SECRET_ID']); ?>" id="paypal_secret" class="form-control">
                          <small class="text-danger"><?php echo e($errors->first('PAYPAL_SECRET_ID')); ?></small>
                      </div>
                  </div>

                  <div class="col-md-3">
                    <div class="search form-group<?php echo e($errors->has('PAYPAL_MODE') ? ' has-error' : ''); ?>">
                        <label class="text-dark"><?php echo e(__('PayPal Mode')); ?> <sup class="text-danger">*</sup>
                          <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo e(__('PayPal offers two modes for processing payments: Sandbox and Live mode.
Sandbox mode is a testing environment that allows you to test PayPal integration in a simulated environment, using fake PayPal accounts and transactions. This is a great way to test and debug your PayPal integration without risking any real money or transactions.
Live mode is the actual production environment where real transactions take place, using real PayPal accounts and actual funds. To accept payments in Live mode, you will need to have a verified PayPal Business account and have completed the necessary setup steps to receive payments.')); ?>">
                            <i class="fa fa-info"></i>
                          </small>
                        </label>
                        <?php echo Form::text('PAYPAL_MODE', null, ['class' => 'form-control']); ?>

                        <small class="text-danger"><?php echo e($errors->first('PAYPAL_SECRET_ID')); ?></small>
                    </div>
                </div>
                  
              </div>
          </div>
      </div>
  </div>
<!-- ======= STRIPE PAYMENT end ========== -->

<!-- ======= RAZORPAY PAYMENT start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
  <div class="bg-info-rgba ml-6 mr-6 mb-6">
      <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> <?php echo e(__('Razorpay Payment Gateway')); ?></h4></div>
          <div class="payment-gateway-block">
              <div class="form-group">
                  <div class="row mx-2 my-4">
                      <div class="col-md-10">
                          <?php echo Form::label('razorpay_payment', __('Razorpay Payment Gateway')); ?>

                      </div>
                      <div class="col-md-2">
                          <label class="switch">
                              <?php echo Form::checkbox('razorpay_payment', 1, $config->razorpay_payment, ['class' => 'custom_toggle']); ?>

                          </label>
                      </div>
                  </div>
              </div>
              <div class="row mx-2 my-4" style="<?php echo e($config->razorpay_payment==1 ? "" : "display: none"); ?>" id="razorpay_box">
                  <div class="col-md-6">
                      <div class="form-group<?php echo e($errors->has('STRIPE_KEY') ? ' has-error' : ''); ?>">
                          <label class="text-dark"><?php echo e(__('Razorpay Key')); ?> <sup class="text-danger">*</sup></label>
                          <?php echo Form::text('RAZOR_PAY_KEY', null , ['class' => 'form-control']); ?>

                          <small class="text-danger"><?php echo e($errors->first('RAZOR_PAY_KEY')); ?></small>
                      </div>
                  </div>

                  <div class="col-md-6">
                      <div class="search form-group<?php echo e($errors->has('RAZOR_PAY_SECRET') ? ' has-error' : ''); ?>">
                          <label class="text-dark"><?php echo e(__('Razorpay Secret Key')); ?> <sup class="text-danger">*</sup></label>
                          <input type="text" id="razorpay_secret" name="RAZOR_PAY_SECRET" value="<?php echo e($env_files['RAZOR_PAY_SECRET']); ?>" class="form-control" >
                          <small class="text-danger"><?php echo e($errors->first('RAZOR_PAY_SECRET')); ?></small>
                      </div>
                  </div>
                  
              </div>
          </div>
      </div>
  </div>
<!-- ======= RAZORPAY PAYMENT end ========== -->

<!-- ======= PAYU PAYMENT start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
  <div class="bg-info-rgba ml-6 mr-6 mb-6">
      <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> <?php echo e(__('PayU Payment Gateway')); ?></h4></div>
          <div class="payment-gateway-block">
              <div class="form-group">
                  <div class="row mx-2 my-4">
                      <div class="col-md-10">
                          <?php echo Form::label('payu_payment', __('PayU Payment Gateway')); ?>

                      </div>
                      <div class="col-md-2">
                          <label class="switch">
                              <?php echo Form::checkbox('payu_payment', 1, $config->payu_payment, ['class' => 'custom_toggle']); ?>

                          </label>
                      </div>
                  </div>
              </div>
              <div class="row mx-2 my-4" style="<?php echo e($config->payu_payment==1 ? "" : "display: none"); ?>" id="payu_box">
                  <div class="col-md-3">
                      <div class="form-group<?php echo e($errors->has('PAYU_METHOD') ? ' has-error' : ''); ?>">
                          <label class="text-dark"><?php echo e(__('PayU Method')); ?> <sup class="text-danger">*</sup></label>
                          <?php echo Form::text('PAYU_METHOD', null, ['class' => 'form-control']); ?>

                          <small class="text-danger"><?php echo e($errors->first('PAYU_METHOD')); ?></small>
                      </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group<?php echo e($errors->has('PAYU_DEFAULT') ? ' has-error' : ''); ?>">
                        <label class="text-dark"><?php echo e(__('PayU Default Option')); ?> <sup class="text-danger">*</sup></label>
                        <?php echo Form::text('PAYU_DEFAULT', null, ['class' => 'form-control']); ?>

                        <small class="text-danger"><?php echo e($errors->first('PAYU_DEFAULT')); ?></small>
                    </div>
                </div>

                  <div class="col-md-3">
                      <div class="search form-group<?php echo e($errors->has('PAYU_MERCHANT_KEY') ? ' has-error' : ''); ?>">
                          <label class="text-dark"><?php echo e(__('PayU Merchant Key')); ?> <sup class="text-danger">*</sup></label>
                          <input class ="form-control" type="text" name="PAYU_MERCHANT_KEY"  value= "<?php echo e($env_files['PAYU_MERCHANT_KEY']); ?>">
                          <small class="text-danger"><?php echo e($errors->first('PAYU_MERCHANT_KEY')); ?></small>
                      </div>
                  </div>

                  <div class="col-md-3">
                    <div class="search form-group<?php echo e($errors->has('PAYU_MERCHANT_SALT') ? ' has-error' : ''); ?>">
                        <label class="text-dark"><?php echo e(__('PayU Merchant Salt')); ?> <sup class="text-danger">*</sup></label>
                        <input class ="form-control" type="text" name="PAYU_MERCHANT_SALT"  value= "<?php echo e($env_files['PAYU_MERCHANT_SALT']); ?>">
                        <small class="text-danger"><?php echo e($errors->first('PAYU_MERCHANT_SALT')); ?></small>
                    </div>
                </div>
                  
              </div>
          </div>
      </div>
  </div>
<!-- ======= PAYU PAYMENT end ========== -->

<!-- ======= BRAIN TREE PAYMENT start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
  <div class="bg-info-rgba ml-6 mr-6 mb-6">
      <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> <?php echo e(__('Braintree Payment Gateway')); ?></h4></div>
          <div class="payment-gateway-block">
              <div class="form-group">
                  <div class="row mx-2 my-4">
                      <div class="col-md-10">
                        <?php echo Form::label('braintree', __('Braintree Payment Gateway')); ?>

                      </div>
                      <div class="col-md-2">
                          <label class="switch">
                            <?php echo Form::checkbox('braintree', 1, $config->braintree, ['class' => 'custom_toggle','id' => 'braintree_check']); ?>

                          </label>
                      </div>
                  </div>
              </div>
              <div class="row mx-2 my-4" style="<?php echo e($config->braintree == 1 ? "" : "display: none"); ?>" id="braintree_box">
                  <div class="col-md-4">
                      <div class="form-group<?php echo e($errors->has('BTREE_ENVIRONMENT') ? ' has-error' : ''); ?>">
                          <label class="text-dark"><?php echo e(__('Braintree Environment')); ?> <sup class="text-danger">*</sup></label>
                          <input type="text" name="BTREE_ENVIRONMENT" value="<?php echo e($env_files['BTREE_ENVIRONMENT']); ?>"  class="form-control">
                          <small class="text-danger"><?php echo e($errors->first('BTREE_ENVIRONMENT')); ?></small>
                      </div>
                  </div>

                  <div class="col-md-4">
                      <div class="search form-group<?php echo e($errors->has('BTREE_MERCHANT_ID') ? ' has-error' : ''); ?>">
                          <label class="text-dark"><?php echo e(__('Braintree Merchant ID')); ?> <sup class="text-danger">*</sup></label>
                          <input type="text" name="BTREE_MERCHANT_ID" value="<?php echo e($env_files['BTREE_MERCHANT_ID']); ?>" class="form-control">
                          <small class="text-danger"><?php echo e($errors->first('BTREE_MERCHANT_ID')); ?></small>
                      </div>
                  </div>

                  <div class="col-md-4">
                    <div class="search form-group<?php echo e($errors->has('BTREE_MERCHANT_ACCOUNT_ID') ? ' has-error' : ''); ?>">
                        <label class="text-dark"><?php echo e(__('Merchant Merchant Account ID')); ?> <sup class="text-danger">*</sup></label>
                        <input type="text" name="BTREE_MERCHANT_ACCOUNT_ID" value="<?php echo e($env_files['BTREE_MERCHANT_ACCOUNT_ID']); ?>" class="form-control">
                        <small class="text-danger"><?php echo e($errors->first('BTREE_MERCHANT_ACCOUNT_ID')); ?></small>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="search form-group<?php echo e($errors->has('BTREE_PUBLIC_KEY') ? ' has-error' : ''); ?>">
                        <label class="text-dark"><?php echo e(__('Merchant Public Key')); ?> <sup class="text-danger">*</sup></label>
                        <input type="text" name="BTREE_PUBLIC_KEY" value="<?php echo e($env_files['BTREE_PUBLIC_KEY']); ?>" class="form-control">
                        <small class="text-danger"><?php echo e($errors->first('BTREE_PUBLIC_KEY')); ?></small>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="search form-group<?php echo e($errors->has('BTREE_PRIVATE_KEY') ? ' has-error' : ''); ?>">
                        <label class="text-dark"><?php echo e(__('Merchant Private Key')); ?> <sup class="text-danger">*</sup></label>
                        <input type="text" name="BTREE_PRIVATE_KEY" value="<?php echo e($env_files['BTREE_PRIVATE_KEY']); ?>" class="form-control">
                        <small class="text-danger"><?php echo e($errors->first('BTREE_PRIVATE_KEY')); ?></small>
                    </div>
                </div>
                  
              </div>
          </div>
      </div>
  </div>
<!-- ======= BRAIN TREE PAYMENT end ========== -->

<!-- ======= coinpay PAYMENT start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
  <div class="bg-info-rgba ml-6 mr-6 mb-6">
      <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> <?php echo e(__('Coinpay Payment Gateway')); ?></h4><a href="https://www.coinpayments.net/" target="__blank" title="(<?php echo e(__('Coin Payment Site')); ?>)">  (<?php echo e(__('Coinpay Payment Site')); ?>)</a></div>
          <div class="payment-gateway-block">
              <div class="form-group">
                  <div class="row mx-2 my-4">
                      <div class="col-md-10">
                        <?php echo Form::label('coinpay', __('Coinpay Payment Gateway')); ?> 
                      </div>
                      <div class="col-md-2">
                          <label class="switch">
                            <?php echo Form::checkbox('coinpay', 1, $config->coinpay, ['class' => 'custom_toggle','id' => 'coinpay_check']); ?>

                          </label>
                      </div>
                  </div>
              </div>
              <div class="row mx-2 my-4" style="<?php echo e($config->coinpay==1 ? "" : "display: none"); ?>" id="coinpay_box">
                  <div class="col-md-4">
                      <div class="form-group<?php echo e($errors->has('COINPAYMENTS_MERCHANT_ID') ? ' has-error' : ''); ?>">
                          <label class="text-dark"><?php echo e(__('Coinpay Payment Merchant ID')); ?> <sup class="text-danger">*</sup></label>
                          <input type="text" name="COINPAYMENTS_MERCHANT_ID" value="<?php echo e($env_files['COINPAYMENTS_MERCHANT_ID']); ?>"  class="form-control">
                          <small class="text-danger"><?php echo e($errors->first('COINPAYMENTS_MERCHANT_ID')); ?></small>
                      </div>
                  </div>

                  <div class="col-md-4">
                      <div class="search form-group<?php echo e($errors->has('COINPAYMENTS_PUBLIC_KEY') ? ' has-error' : ''); ?>">
                          <label class="text-dark"><?php echo e(__('Coinpay Payment Public Key')); ?> <sup class="text-danger">*</sup></label>
                          <input type="text" name="COINPAYMENTS_PUBLIC_KEY" value="<?php echo e($env_files['COINPAYMENTS_PUBLIC_KEY']); ?>"  class="form-control">
                          <small class="text-danger"><?php echo e($errors->first('COINPAYMENTS_PUBLIC_KEY')); ?></small>
                      </div>
                  </div>

                  <div class="col-md-4">
                    <div class="search form-group<?php echo e($errors->has('COINPAYMENTS_PRIVATE_KEY') ? ' has-error' : ''); ?>">
                        <label class="text-dark"><?php echo e(__('Coinpay Payment Private Key')); ?> <sup class="text-danger">*</sup></label>
                        <input type="text" name="COINPAYMENTS_PRIVATE_KEY" value="<?php echo e($env_files['COINPAYMENTS_PRIVATE_KEY']); ?>"  class="form-control">
                        <small class="text-danger"><?php echo e($errors->first('COINPAYMENTS_PRIVATE_KEY')); ?></small>
                    </div>
                  </div>
                  
              </div>
          </div>
      </div>
  </div>
<!-- ======= Coinpay PAYMENT end ========== -->

<!-- ======= PAY STACK PAYMENT start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
  <div class="bg-info-rgba ml-6 mr-6 mb-6">
      <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> <?php echo e(__('Pay Stack Payment Gateway')); ?></h4><h5><?php echo e(__('(Only Works for NGN Currency)')); ?></h5></div>
          <div class="payment-gateway-block">
              <div class="form-group">
                  <div class="row mx-2 my-4">
                      <div class="col-md-10">
                        <?php echo Form::label('paystack', __('Pay Stack Payment Gateway')); ?> 
                        <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo e(__('Only Works for NGN Currency.')); ?>">
                        <i class="fa fa-info"></i>
                      </small>
                      </div>
                      <div class="col-md-2">
                          <label class="switch">
                            <?php echo Form::checkbox('paystack', 1, $config->paystack, ['class' => 'custom_toggle','id' => 'paystack_check']); ?>

                          </label>
                      </div>
                  </div>
              </div>
              <div class="row mx-2 my-4" style="<?php echo e($config->paystack==1 ? "" : "display: none"); ?>" id="paystack_box">
                  <div class="col-md-6">
                      <div class="form-group<?php echo e($errors->has('PAYSTACK_PUBLIC_KEY') ? ' has-error' : ''); ?>">
                          <label class="text-dark"><?php echo e(__('Pay Stack Public Key')); ?> <sup class="text-danger">*</sup></label>
                          <input type="text" name="PAYSTACK_PUBLIC_KEY" value="<?php echo e($env_files['PAYSTACK_PUBLIC_KEY']); ?>"  class="form-control">
                          <small class="text-danger"><?php echo e($errors->first('PAYSTACK_PUBLIC_KEY')); ?></small>
                      </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group<?php echo e($errors->has('PAYSTACK_SECRET_KEY') ? ' has-error' : ''); ?>">
                        <label class="text-dark"><?php echo e(__('Pay Stack Secret Key')); ?> <sup class="text-danger">*</sup></label>
                        <input type="text" name="PAYSTACK_SECRET_KEY" value="<?php echo e($env_files['PAYSTACK_SECRET_KEY']); ?>"  class="form-control">
                        <small class="text-danger"><?php echo e($errors->first('PAYSTACK_SECRET_KEY')); ?></small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group<?php echo e($errors->has('MERCHANT_EMAIL') ? ' has-error' : ''); ?>">
                        <label class="text-dark"><?php echo e(__('Merchant Email')); ?> <sup class="text-danger">*</sup></label>
                        <input type="text" name="MERCHANT_EMAIL" value="<?php echo e($env_files['MERCHANT_EMAIL']); ?>"  class="form-control">
                        <small class="text-danger"><?php echo e($errors->first('MERCHANT_EMAIL')); ?></small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group<?php echo e($errors->has('PAYSTACK_PAYMENT_URL') ? ' has-error' : ''); ?>">
                        <label class="text-dark"><?php echo e(__('Pay Stack Payment URL')); ?> <sup class="text-danger">*</sup></label>
                        <input type="text" name="PAYSTACK_PAYMENT_URL" value="<?php echo e($env_files['PAYSTACK_PAYMENT_URL']); ?>"  class="form-control">
                        <small class="text-danger"><?php echo e($errors->first('PAYSTACK_PAYMENT_URL')); ?></small>
                    </div>
                </div>
                  
              </div>
          </div>
      </div>
  </div>
<!-- ======= PAY STACK PAYMENT end ========== -->

<!-- ======= PAYTM PAYMENT start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
  <div class="bg-info-rgba ml-6 mr-6 mb-6">
      <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> <?php echo e(__('Paytm Payment Gateway
')); ?></h4></div>
          <div class="payment-gateway-block">
              <div class="form-group">
                  <div class="row mx-2 my-4">
                      <div class="col-md-10">
                        <?php echo Form::label('paytm_payment', __('Paytm Payment Gateway')); ?>

                      </div>
                      <div class="col-md-2">
                          <label class="switch">
                            <?php echo Form::checkbox('paytm_payment', 1, $config->paytm_payment, ['class' => 'custom_toggle','id' => 'paytm_check']); ?>

                          </label>
                      </div>
                  </div>
              </div>
              <div class="row mx-2 my-4" style="<?php echo e($config->paytm_payment==1 ? "" : "display: none"); ?>" id="paytm_box">
                  <div class="col-md-3">
                      <div class="form-group<?php echo e($errors->has('PAYTM_MID') ? ' has-error' : ''); ?>">
                          <label class="text-dark"><?php echo e(__('Merchant ID')); ?> <sup class="text-danger">*</sup></label>
                          <input type="text" name="PAYTM_MID" value="<?php echo e($env_files['PAYTM_MID']); ?>"  class="form-control">
                          <small class="text-danger"><?php echo e($errors->first('PAYTM_MID')); ?></small>
                      </div>
                  </div>

                  <div class="col-md-6">
                      <div class="search form-group<?php echo e($errors->has('PAYTM_MERCHANT_KEY') ? ' has-error' : ''); ?>">
                          <label class="text-dark"><?php echo e(__('Merchant Key')); ?> <sup class="text-danger">*</sup></label>
                          <input type="text" name="PAYTM_MERCHANT_KEY" value="<?php echo e($env_files['PAYTM_MERCHANT_KEY']); ?>"  class="form-control">
                          <small class="text-danger"><?php echo e($errors->first('PAYTM_MERCHANT_KEY')); ?></small>
                      </div>
                  </div>

                  <div class="col-md-3">
                    <label class="text-dark"><?php echo e(__('Paytm LIVE/TEST')); ?></label>
                  
                      <label class="switch">
                        <?php echo Form::checkbox('paytm_test', 1, ($config->paytm_test == 1 ? 1 : 0), ['class' => 'custom_toggle']); ?>

                      </label>
                  </div>
                  
              </div>
          </div>
      </div>
  </div>
<!-- ======= PAYTM PAYMENT end ========== -->

<!-- ======= INSTA MOJO PAYMENT start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
  <div class="bg-info-rgba ml-6 mr-6 mb-6">
      <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> <?php echo e(__('INSTA MOJO Payment Gateway')); ?></h4><h5><?php echo e(__('(Support Only INR Currency)')); ?></h5></div>
          <div class="payment-gateway-block">
              <div class="form-group">
                  <div class="row mx-2 my-4">
                      <div class="col-md-10">
                        <?php echo Form::label('instamojo_payment', __('INSTA MOJO Payment Gateway')); ?>

                        <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo e(__('Support Only INR Currency')); ?>">
                          <i class="fa fa-info"></i>
                        </small>
                      </div>
                      <div class="col-md-2">
                          <label class="switch">
                            <?php echo Form::checkbox('instamojo_payment', 1, $config->instamojo_payment, ['class' => 'custom_toggle', 'id'=>'instamojo_check']); ?>

                          </label>
                      </div>
                  </div>
              </div>
              <div class="row mx-2 my-4" style="<?php echo e($config->instamojo_payment==1 ? "" : "display: none"); ?>" id="instamojo_box">
                  <div class="col-md-6">
                      <div class="form-group<?php echo e($errors->has('IM_API_KEY') ? ' has-error' : ''); ?>">
                          <label class="text-dark"><?php echo e(__('INSTA MOJO Api Key')); ?></label>
                          <input type="text" name="IM_API_KEY" value="<?php echo e($env_files['IM_API_KEY']); ?>" class="form-control">
                          <small class="text-danger"><?php echo e($errors->first('IM_API_KEY')); ?></small>
                      </div>
                  </div>

                  <div class="col-md-6">
                      <div class="search form-group<?php echo e($errors->has('IM_AUTH_TOKEN') ? ' has-error' : ''); ?>">
                          <label class="text-dark"><?php echo e(__('INSTA MOJO Api Token')); ?></label>
                          <input type="text" name="IM_AUTH_TOKEN" value="<?php echo e($env_files['IM_AUTH_TOKEN']); ?>"  class="form-control">
                          <small class="text-danger"><?php echo e($errors->first('IM_AUTH_TOKEN')); ?></small>
                      </div>
                  </div>

                  <div class="col-md-4">
                    <div class="search form-group<?php echo e($errors->has('IM_URL') ? ' has-error' : ''); ?>">
                        <label class="text-dark"><?php echo e(__('INSTA MOJO Payment URL')); ?></label>
                        <input type="text" name="IM_URL" value="<?php echo e($env_files['IM_URL']); ?>"  class="form-control">
                        <small class="text-danger"><?php echo e($errors->first('IM_URL')); ?></small>
                    </div>
                </div>

                <div class="col-md-6">
                    <small class="text-danger">             
                    <br/>           
                        <ul>
                            <li>
                                <a target="__blank"  href="https://test.instamojo.com/api/1.1" title="<?php echo e(__('For Testing Mode Payment URL')); ?>"><?php echo e(__('For Testing Mode Payment URL')); ?> https://test.instamojo.com/api/1.1</a>
                            </li>
                            <li>
                                <a target="__blank"  href="https://www.instamojo.com/api/1.1/" title="<?php echo e(__('For Live Mode Payment URL')); ?>"><?php echo e(__('For Live Mode Payment URL')); ?> https://www.instamojo.com/api/1.1/</a>
                            </li>
                        </ul>
                    </small>
                </div>
                  
              </div>
          </div>
      </div>
  </div>
<!-- ======= INSTA MOJO PAYMENT end ========== -->

<!-- ======= MOLLIE PAYMENT start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
  <div class="bg-info-rgba ml-6 mr-6 mb-6">
      <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> <?php echo e(__('MOLLIE Payment Gateway')); ?></h4></div>
          <div class="payment-gateway-block">
              <div class="form-group">
                  <div class="row mx-2 my-4">
                      <div class="col-md-10">
                        <?php echo Form::label('mollie_payment', __('MOLLIE Payment Gateway')); ?>

                      </div>
                      <div class="col-md-2">
                          <label class="switch">
                            <?php echo Form::checkbox('mollie_payment', 1, $config->mollie_payment, ['class' => 'custom_toggle','id' => 'mollie_check']); ?>

                          </label>
                      </div>
                  </div>
              </div>
              <div class="row mx-2 my-4" style="<?php echo e($config->mollie_payment==1 ? "" : "display: none"); ?>" id="mollie_box">
                  <div class="col-md-12">
                      <div class="form-group<?php echo e($errors->has('MOLLIE_KEY') ? ' has-error' : ''); ?>">
                          <label class="text-dark"><?php echo e(__('MOLLIE Key')); ?> <sup class="text-danger">*</sup></label>
                          <input type="text" name="MOLLIE_KEY" value="<?php echo e($env_files['MOLLIE_KEY']); ?>" placeholder="<?php echo e(__('Please Enter Mollie Key')); ?>" class="form-control">
                          <small class="text-danger"><?php echo e($errors->first('MOLLIE_KEY')); ?></small>
                      </div>
                  </div>
                  
              </div>
          </div>
      </div>
  </div>
<!-- ======= MOLLIE PAYMENT end ========== -->

<!-- ======= CASHFREE PAYMENT start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
  <div class="bg-info-rgba ml-6 mr-6 mb-6">
      <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> <?php echo e(__('CASHFREE Payment Gateway')); ?></h4></div>
          <div class="payment-gateway-block">
              <div class="form-group">
                  <div class="row mx-2 my-4">
                      <div class="col-md-10">
                        <?php echo Form::label('cashfree_payment', __('CASHFREE Payment Gateway')); ?>

                      </div>
                      <div class="col-md-2">
                          <label class="switch">
                            <?php echo Form::checkbox('cashfree_payment', 1, $config->cashfree_payment, ['class' => 'custom_toggle','id' => 'cashfree_check']); ?>

                          </label>
                      </div>
                  </div>
              </div>
              <div class="row mx-2 my-4" style="<?php echo e($config->cashfree_payment==1 ? "" : "display: none"); ?>" id="cashfree_box">
                  <div class="col-md-4">
                      <div class="form-group<?php echo e($errors->has('CASHFREE_APP_ID') ? ' has-error' : ''); ?>">
                          <label class="text-dark"><?php echo e(__('CASH FREE APP ID')); ?> <sup class="text-danger">*</sup></label>
                          <?php echo Form::text('CASHFREE_APP_ID', null, ['class' => 'form-control']); ?>

                          <small class="text-danger"><?php echo e($errors->first('CASHFREE_APP_ID')); ?></small>
                      </div>
                  </div>

                  <div class="col-md-4">
                      <div class="search form-group<?php echo e($errors->has('CASHFREE_SECRET_ID') ? ' has-error' : ''); ?>">
                          <label class="text-dark"><?php echo e(__('CASHFREE Secret ID')); ?> <sup class="text-danger">*</sup></label>
                          <input type="password" name="CASHFREE_SECRET_ID" value="<?php echo e(env('CASHFREE_SECRET_ID') ? env('CASHFREE_SECRET_ID') :''); ?>" id="cashfree_secret" class="form-control">
                          <small class="text-danger"><?php echo e($errors->first('CASHFREE_SECRET_ID')); ?></small>
                      </div>
                  </div>

                  <div class="col-md-4">
                    <div class="search form-group<?php echo e($errors->has('CASHFREE_API_END_URL') ? ' has-error' : ''); ?>">
                        <label class="text-dark"><?php echo e(__('CASHFREE API and URL')); ?> <sup class="text-danger">*</sup></label>
                        <input type="text" name="CASHFREE_API_END_URL" value="<?php echo e(env('CASHFREE_API_END_URL') ? env('CASHFREE_API_END_URL') : ''); ?>" placeholder="https://test.cashfree.com" class="form-control">
                        <small class="text-danger"><?php echo e($errors->first('CASHFREE_API_END_URL')); ?></small>
                    </div>
                </div>
                <div class="col-md-12">
                    <small class="text-danger">                      
                        <ul>
                            <li>
                                <a target="__blank"  href="https://test.cashfree.com" title="<?php echo e(__('For Test Mode Use CASHFREE API END URL')); ?>"><?php echo e(__('For Test Mode Use CASHFREE API END URL')); ?> https://test.cashfree.com</a>
                            </li>
                            <li>
                                <a target="__blank"  href="https://cashfree.com" title="<?php echo e(__('For Live Mode Use CASHFREE API END URL')); ?>"><?php echo e(__('For Live Mode Use CASHFREE API END URL')); ?> https://cashfree.com</a>
                            </li>
                        </ul>
                    </small>
                </div>
                  
              </div>
          </div>
      </div>
  </div>
<!-- ======= CASHFREE PAYMENT end ========== -->

<!-- ======= OMISE PAYMENT start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
  <div class="bg-info-rgba ml-6 mr-6 mb-6">
      <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> <?php echo e(__('OMISE Payment Gateway')); ?></h4></div>
          <div class="payment-gateway-block">
              <div class="form-group">
                  <div class="row mx-2 my-4">
                      <div class="col-md-10">
                          <?php echo Form::label('omise_payment', __('OMISE Payment Gateway')); ?>

                      </div>
                      <div class="col-md-2">
                          <label class="switch">
                              <?php echo Form::checkbox('omise_payment', 1, $config->omise_payment, ['class' => 'custom_toggle','id' => 'omise_check']); ?>

                          </label>
                      </div>
                  </div>
              </div>
              <div class="row mx-2 my-4" style="<?php echo e($config->omise_payment==1 ? "" : "display: none"); ?>" id="omise_box">
                  <div class="col-md-4">
                      <div class="form-group<?php echo e($errors->has('OMISE_PUBLIC_KEY') ? ' has-error' : ''); ?>">
                          <label class="text-dark"><?php echo e(__('OMISE Public Key')); ?> <sup class="text-danger">*</sup></label>
                          <?php echo Form::text('OMISE_PUBLIC_KEY', null, ['class' => 'form-control']); ?>

                          <small class="text-danger"><?php echo e($errors->first('OMISE_PUBLIC_KEY')); ?></small>
                      </div>
                  </div>

                  <div class="col-md-4">
                      <div class="search form-group<?php echo e($errors->has('OMISE_SECRET_KEY') ? ' has-error' : ''); ?>">
                          <label class="text-dark"><?php echo e(__('OMISE Secret Key')); ?> <sup class="text-danger">*</sup></label>
                          <input class ="form-control" type="text" id="omise_secret" name="OMISE_SECRET_KEY" value="<?php echo e($env_files['OMISE_SECRET_KEY'] ? $env_files['OMISE_SECRET_KEY'] : ''); ?>" >
                          <small class="text-danger"><?php echo e($errors->first('OMISE_SECRET_KEY')); ?></small>
                      </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group<?php echo e($errors->has('OMISE_API_VERSION') ? ' has-error' : ''); ?>">
                        <label class="text-dark"><?php echo e(__('OMISE API Version')); ?> <sup class="text-danger">*</sup></label>
                        <?php echo Form::text('OMISE_API_VERSION', null, ['class' => 'form-control']); ?>

                        <small class="text-danger"><?php echo e($errors->first('OMISE_API_VERSION')); ?></small>
                    </div>
                </div>
                  
              </div>
          </div>
      </div>
  </div>
<!-- ======= OMISE PAYMENT end ========== -->

<!-- ======= Flutter Rave PAYMENT start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
  <div class="bg-info-rgba ml-6 mr-6 mb-6">
    <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> <?php echo e(__('FLUTTER RAVE Payment Gateway')); ?></h4><a href="https://dashboard.flutterwave.com/signup" title="(<?php echo e(__('Flutter Rave Site')); ?>)" target="__blank">  (<?php echo e(__('Flutter Rave Site')); ?>)</a></div>
          <div class="payment-gateway-block">
              <div class="form-group">
                  <div class="row mx-2 my-4">
                      <div class="col-md-10">
                          <?php echo Form::label('flutterrave', __('FLUTTER RAVE Payment Gateway')); ?>

                      </div>
                      <div class="col-md-2">
                          <label class="switch">
                              <?php echo Form::checkbox('flutterrave_payment', 1, $config->flutterrave_payment, ['class' => 'custom_toggle','id' => 'flutter_check']); ?>

                          </label>
                      </div>
                  </div>
              </div>
              <div class="row mx-2 my-4" style="<?php echo e($config->flutterrave_payment==1 ? "" : "display: none"); ?>" id="flutterave_box">
                  <div class="col-md-6">
                      <div class="form-group<?php echo e($errors->has('RAVE_PUBLIC_KEY') ? ' has-error' : ''); ?>">
                          <label class="text-dark"><?php echo e(__('RAVE Public Key')); ?> <sup class="text-danger">*</sup></label>
                          <input type="text" name="RAVE_PUBLIC_KEY" value="<?php echo e($env_files['RAVE_PUBLIC_KEY'] ? $env_files['RAVE_PUBLIC_KEY'] : ''); ?>" class="form-control">
                          <small class="text-danger"><?php echo e($errors->first('RAVE_PUBLIC_KEY')); ?></small>
                      </div>
                  </div>

                  <div class="col-md-6">
                      <div class="search form-group<?php echo e($errors->has('RAVE_SECRET_KEY') ? ' has-error' : ''); ?>">
                          <label class="text-dark"><?php echo e(__('RAVE Secret Key')); ?> <sup class="text-danger">*</sup></label>
                          <input type="text" name="RAVE_SECRET_KEY" value="<?php echo e($env_files['RAVE_SECRET_KEY'] ? $env_files['RAVE_SECRET_KEY'] :''); ?>" class="form-control">
                          <small class="text-danger"><?php echo e($errors->first('RAVE_SECRET_KEY')); ?></small>
                      </div>
                  </div>

                  <div class="col-md-2">
                    <div class="search form-group<?php echo e($errors->has('RAVE_COUNTRY') ? ' has-error' : ''); ?>">
                        <label class="text-dark"><?php echo e(__('Country Code')); ?> <sup class="text-danger">*</sup></label>
                        <input type="text" name="RAVE_COUNTRY" value="<?php echo e($env_files['RAVE_COUNTRY'] ? $env_files['RAVE_COUNTRY'] : ''); ?>" class="form-control">
                        <small class="text-danger"><?php echo e($errors->first('RAVE_COUNTRY')); ?></small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="search form-group<?php echo e($errors->has('RAVE_LOGO') ? ' has-error' : ''); ?>">
                        <label class="text-dark"><?php echo e(__('RAVE Logo')); ?> <sup class="text-danger">*</sup>
                          <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo e(__('Enter Full URL to Logo')); ?>">
                            <i class="fa fa-info"></i>
                          </small>
                        </label>
                        <input type="text" name="RAVE_LOGO" value="<?php echo e($env_files['RAVE_LOGO'] ? $env_files['RAVE_LOGO'] : ''); ?>" class="form-control">
                       
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="search form-group<?php echo e($errors->has('RAVE_PREFIX') ? ' has-error' : ''); ?>">
                        <label class="text-dark"><?php echo e(__('RAVE Prefix')); ?> <sup class="text-danger">*</sup></label>
                        <input type="text" name="RAVE_PREFIX" value="<?php echo e($env_files['RAVE_PREFIX'] ? $env_files['RAVE_PREFIX'] : ''); ?>" class="form-control">
                        <small class="text-danger"><?php echo e($errors->first('RAVE_PREFIX')); ?></small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="search form-group<?php echo e($errors->has('RAVE_SECRET_HASH') ? ' has-error' : ''); ?>">
                        <label class="text-dark"><?php echo e(__('RAVE Secret Hash')); ?> <sup class="text-danger">*</sup></label>
                        <input type="text" name="RAVE_SECRET_HASH" value="<?php echo e($env_files['RAVE_SECRET_HASH'] ? $env_files['RAVE_SECRET_HASH'] : ''); ?>" class="form-control">
                        <small class="text-danger"><?php echo e($errors->first('RAVE_SECRET_HASH')); ?></small>
                    </div>
                </div>
                  
              </div>
          </div>
      </div>
  </div>
<!-- ======= Flutter Rave PAYMENT end ========== -->

<!-- ======= PAYHERE PAYMENT start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
    <div class="bg-info-rgba ml-6 mr-6 mb-6">
        <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> <?php echo e(__('PAYHERE Payment Gateway')); ?></h4></div>
            <div class="payment-gateway-block">
                <div class="form-group">
                    <div class="row mx-2 my-4">
                        <div class="col-md-10">
                          <?php echo Form::label('payhere', __('PAYHERE Payment Gateway')); ?>

                        </div>
                        <div class="col-md-2">
                            <label class="switch">
                              <?php echo Form::checkbox('payhere_payment', 1, $config->payhere_payment, ['class' => 'custom_toggle','id' => 'payhere_check']); ?>

                            </label>
                        </div>
                    </div>
                </div>
                <div class="row mx-2 my-4" style="<?php echo e($config->payhere_payment==1 ? "" : "display: none"); ?>" id="payhere_box">
                    <div class="col-md-3">
                        <div class="form-group<?php echo e($errors->has('PAYHERE_BUISNESS_APP_CODE') ? ' has-error' : ''); ?>">
                            <label class="text-dark"><?php echo e(__('PAYHERE Business APP Code')); ?> <sup class="text-danger">*</sup>
</label>
                            <input type="text" name="PAYHERE_BUISNESS_APP_CODE" value="<?php echo e($env_files['PAYHERE_BUISNESS_APP_CODE']); ?>" class="form-control">
                            <small class="text-danger"><?php echo e($errors->first('PAYHERE_BUISNESS_APP_CODE')); ?></small>
                        </div>
                    </div>
  
                    <div class="col-md-6">
                        <div class="search form-group<?php echo e($errors->has('PAYHERE_APP_SECRET') ? ' has-error' : ''); ?>">
                            <label class="text-dark"><?php echo e(__('PAYHERE APP Secret Key')); ?> <sup class="text-danger">*</sup>
</label>
                            <input type="text" name="PAYHERE_APP_SECRET" value="<?php echo e($env_files['PAYHERE_APP_SECRET']); ?>" class="form-control">
                            <small class="text-danger"><?php echo e($errors->first('PAYHERE_APP_SECRET')); ?></small>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="search form-group<?php echo e($errors->has('PAYHERE_MERCHANT_ID') ? ' has-error' : ''); ?>">
                            <label class="text-dark"><?php echo e(__('PAYHERE Merchant ID')); ?> <sup class="text-danger">*</sup>
</label>
                            <input type="text" name="PAYHERE_MERCHANT_ID" value="<?php echo e($env_files['PAYHERE_MERCHANT_ID']); ?>" class="form-control">
                            <small class="text-danger"><?php echo e($errors->first('PAYHERE_MERCHANT_ID')); ?></small>
                        </div>
                    </div>
  
                    <div class="col-md-6">
                      <label class="text-dark"><?php echo e(__('PAYHERE Payment Environment LIVE/SANDBOX')); ?></label>
                    
                      <label class="switch">
                          <?php echo Form::checkbox('PAYHERE_MODE', 1, ($env_files['PAYHERE_MODE'] == 'live' ? 1 : 0), ['class' => 'custom_toggle']); ?>

                      </label>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
  <!-- ======= PAYHERE PAYMENT end ========== -->

  <!-- ======= BANK DETAILS PAYMENT start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
    <div class="bg-info-rgba ml-6 mr-6 mb-6">
        <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> <?php echo e(__('Bank Details')); ?></h4></div>
            <div class="payment-gateway-block">
                <div class="form-group">
                    <div class="row mx-2 my-4">
                        <div class="col-md-10">
                            <?php echo Form::label('bankdetails', __('Bank Details')); ?>

                        </div>
                        <div class="col-md-2">
                            <label class="switch">
                                <?php echo Form::checkbox('bankdetails', 1, $config->bankdetails, ['class' => 'custom_toggle']); ?>

                            </label>
                        </div>
                    </div>
                </div>
                <div class="row mx-2 my-4" style="<?php echo e($config->bankdetails==1 ? "" : "display: none"); ?>" id="bank_box">
                    <div class="col-md-3">
                        <div class="form-group<?php echo e($errors->has('account_no') ? ' has-error' : ''); ?>">
                            <label class="text-dark"><?php echo e(__('Account Number')); ?> <sup class="text-danger">*</sup>
</label>
                            <input id="payum" type="text" class="form-control" value="<?php echo e($config->account_no); ?>" name="account_no">
                            <small class="text-danger"><?php echo e($errors->first('account_no')); ?></small>
                        </div>
                    </div>
  
                    <div class="col-md-3">
                      <div class="form-group<?php echo e($errors->has('account_name') ? ' has-error' : ''); ?>">
                          <label class="text-dark"><?php echo e(__('Account Owner Name')); ?> <sup class="text-danger">*</sup>
</label>
                          <input id="payum" type="text" class="form-control" value="<?php echo e($config->account_name); ?>" name="account_name">
                          <small class="text-danger"><?php echo e($errors->first('account_name')); ?></small>
                      </div>
                  </div>
  
                    <div class="col-md-3">
                        <div class="search form-group<?php echo e($errors->has('ifsc_code') ? ' has-error' : ''); ?>">
                            <label class="text-dark"><?php echo e(__('IFSC Code')); ?> <sup class="text-danger">*</sup>
</label>
                            <input id="payum" type="text" class="form-control" value="<?php echo e($config->ifsc_code); ?>" name="ifsc_code">
                            <small class="text-danger"><?php echo e($errors->first('ifsc_code')); ?></small>
                        </div>
                    </div>
  
                    <div class="col-md-3">
                      <div class="search form-group<?php echo e($errors->has('bank_name') ? ' has-error' : ''); ?>">
                          <label class="text-dark"><?php echo e(__('Bank Name')); ?> <sup class="text-danger">*</sup>
</label>
                          <input type="text" name="bank_name" value="<?php echo e($config->bank_name); ?>" id="payusalt" class="form-control">
                          <small class="text-danger"><?php echo e($errors->first('bank_name')); ?></small>
                      </div>
                  </div>
                    
                </div>
            </div>
        </div>
    </div>
  <!-- ======= BANK DETAILS PAYMENT end ========== -->

  <!-- ======= AWS STORAGE PAYMENT start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
    <div class="bg-info-rgba ml-6 mr-6 mb-6">
        <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> <?php echo e(__('AWS Storage Details')); ?></h4></div>
            <div class="payment-gateway-block">
                <div class="form-group">
                    <div class="row mx-2 my-4">
                        <div class="col-md-10">
                            <?php echo Form::label('aws', __('AWS Storage Details')); ?>

                        </div>
                        <div class="col-md-2">
                            <label class="switch">
                                <?php echo Form::checkbox('aws', 1, $config->aws, ['class' => 'custom_toggle']); ?>

                            </label>
                        </div>
                    </div>
                </div>
                <div class="row mx-2 my-4" style="<?php echo e($config->aws==1 ? "" : "display: none"); ?>" id="aws_box">
                    <div class="col-md-3">
                        <div class="form-group<?php echo e($errors->has('key') ? ' has-error' : ''); ?>">
                            <label class="text-dark"><?php echo e(__('AWS Access Key')); ?> <sup class="text-danger">*</sup>
</label>
                            <input id="payum" type="text" class="form-control" value="<?php echo e(isset($env_files['key']) ? $env_files['key'] : ''); ?>" name="key">
                            <small class="text-danger"><?php echo e($errors->first('key')); ?></small>
                        </div>
                    </div>
  
                    <div class="col-md-3">
                      <div class="form-group<?php echo e($errors->has('secret') ? ' has-error' : ''); ?>">
                          <label class="text-dark"><?php echo e(__('AWS Secret Key')); ?> <sup class="text-danger">*</sup>
</label>
                          <input id="payum" type="text" class="form-control" value="<?php echo e(isset($env_files['secret']) ? $env_files['secret'] :''); ?>" name="secret">
                          <small class="text-danger"><?php echo e($errors->first('secret')); ?></small>
                      </div>
                  </div>
  
                    <div class="col-md-3">
                        <div class="search form-group<?php echo e($errors->has('region') ? ' has-error' : ''); ?>">
                            <label class="text-dark"><?php echo e(__('AWS Bucket Region')); ?> <sup class="text-danger">*</sup>
</label>
                            <input id="payum" type="text" class="form-control" value="<?php echo e(isset($env_files['region']) ? $env_files['region'] : ''); ?>" name="region">
                            <small class="text-danger"><?php echo e($errors->first('region')); ?></small>
                        </div>
                    </div>
  
                    <div class="col-md-3">
                        <div class="search form-group<?php echo e($errors->has('bucket') ? ' has-error' : ''); ?>">
                            <label class="text-dark"><?php echo e(__('AWS Bucket Name')); ?> <sup class="text-danger">*</sup>
</label>
                            <input type="text" name="bucket" value="<?php echo e(isset($env_files['bucket']) ? $env_files['bucket'] : ''); ?>" id="payusalt" class="form-control">
                            <small class="text-danger"><?php echo e($errors->first('bucket')); ?></small>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
  <!-- ======= AWS STORAGE PAYMENT end ========== -->



<div class="col-md-6 col-lg-6 col-xl-12 form-group">
  <button type="submit" class="btn btn-primary-rgba" title="<?php echo e(__('Save')); ?>"
><i class="fa fa-check-circle"></i>
    <?php echo e(__('Save')); ?></button>
</div>
</div>
<?php echo Form::close(); ?>

        <div class="clear-both"></div>
      </div>
    </div>
  </div>
</div>
</div>

  

<?php $__env->stopSection(); ?> 
<?php $__env->startSection('script'); ?>
<script>
  $(".toggle-password").click(function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
      input.attr("type", "text");
    } else {
      input.attr("type", "password");
    }
  }); 

  $(".toggle-password2").click(function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
      input.attr("type", "text");
    } else {
      input.attr("type", "password");
    }
  });

</script>

<script>
  $('#stripe_payment').on('change',function(){
    if ($('#stripe_payment').is(':checked')){
         $('#stripe_box').show('fast');
      }else{
        $('#stripe_box').hide('fast');
      }
  });  

  $('#razorpay_payment').on('change',function(){
    if ($('#razorpay_payment').is(':checked')){
         $('#razorpay_box').show('fast');
      }else{
        $('#razorpay_box').hide('fast');
      }
  });   

  $('#paypal_payment').on('change',function(){
    if ($('#paypal_payment').is(':checked')){
         $('#paypal_box').show('fast');
      }else{
        $('#paypal_box').hide('fast');
      }
  });   

  $('#payu_payment').on('change',function(){
    if ($('#payu_payment').is(':checked')){
         $('#payu_box').show('fast');
      }else{
        $('#payu_box').hide('fast');
      }
  }); 

  $('#bankdetails').on('change',function(){
    if ($('#bankdetails').is(':checked')){
         $('#bank_box').show('fast');
      }else{
        $('#bank_box').hide('fast');
      }
  }); 
    

  $('#paytm_check').on('change',function(){
    if ($('#paytm_check').is(':checked')){
         $('#paytm_box').show('fast');
      }else{
        $('#paytm_box').hide('fast');
      }
  }); 

  $('#braintree_check').on('change',function(){
    if ($('#braintree_check').is(':checked')){
         $('#braintree_box').show('fast');
      }else{
        $('#braintree_box').hide('fast');
      }
  }); 
   $('#paystack_check').on('change',function(){
    if ($('#paystack_check').is(':checked')){
         $('#paystack_box').show('fast');
      }else{
        $('#paystack_box').hide('fast');
      }
  }); 

  $('#payhere_check').on('change',function(){
    if ($('#payhere_check').is(':checked')){
         $('#payhere_box').show('fast');
      }else{
        $('#payhere_box').hide('fast');
      }
  }); 

  $('#instamojo_check').on('change',function(){
    if ($('#instamojo_check').is(':checked')){
         $('#instamojo_box').show('fast');
      }else{
        $('#instamojo_box').hide('fast');
      }
  });

  $('#mollie_check').on('change',function(){
    if ($('#mollie_check').is(':checked')){
         $('#mollie_box').show('fast');
      }else{
        $('#mollie_box').hide('fast');
      }
  });

  $('#cashfree_check').on('change',function(){
    if ($('#cashfree_check').is(':checked')){
         $('#cashfree_box').show('fast');
      }else{
        $('#cashfree_box').hide('fast');
      }
  });

  $('#omise_check').on('change',function(){
    if ($('#omise_check').is(':checked')){
         $('#omise_box').show('fast');
      }else{
        $('#omise_box').hide('fast');
      }
  }); 

  $('#flutter_check').on('change',function(){
    if ($('#flutter_check').is(':checked')){
         $('#flutterave_box').show('fast');
      }else{
        $('#flutterave_box').hide('fast');
      }
  });    

 

  $('#coinpay_check').on('change',function(){
    if ($('#coinpay_check').is(':checked')){
         $('#coinpay_box').show('fast');
      }else{
        $('#coinpay_box').hide('fast');
      }
  });  

  $('#aws').on('change',function(){
    if ($('#aws').is(':checked')){
         $('#aws_box').show('fast');
      }else{
        $('#aws_box').hide('fast');
      }
  });  
  $('#captcha').on('change',function(){
    if ($('#captcha').is(':checked')){
         $('#captcha_box').show('fast');
      }else{
        $('#captcha_box').hide('fast');
      }
  });   
</script>
<script>
  (function($){
    $.noConflict();    
  })(jQuery);    
</script>  

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/admin/config/pg.blade.php ENDPATH**/ ?>