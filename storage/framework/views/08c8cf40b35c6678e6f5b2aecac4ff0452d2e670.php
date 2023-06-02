<?php $__env->startSection('title',__('Purchase Plan')); ?>
<?php $__env->startSection('main-wrapper'); ?>
  <!-- main wrapper -->
  <section id="main-wrapper" class="main-wrapper home-page user-account-section">
    <div class="container-fluid">
      <h4 class="heading"><?php echo e(__('pricing plan')); ?></h4>
      <ul class="bradcump">
        <li><a href="<?php echo e(url('account')); ?>"><?php echo e(__('dashboard')); ?></a></li>
        <li>/</li>
        <li><?php echo e(__('pricing plan')); ?></li>
      </ul>
      <div class="purchase-plan-main-block main-home-section-plans purchase-section">
        <div class="panel-setting-main-block panel-purchase">
          <div class="container">
            <div class="plan-block-dtl">
              <h3 class="plan-dtl-heading"><?php echo e(__('purchase membership')); ?></h3>
              <h4 class="plan-dtl-sub-heading"><?php echo e(__('Purchase any of the membership package from below.')); ?></h4>
              <div class="plan-dtl-list">
                <ul>
                  <li><?php echo e(__('Select any of your preferred membership package & make payment.')); ?>

                  </li>
                  <li><?php echo e(__('You can cancel your subscription anytime later.')); ?>

                  </li>
                </ul>
              </div>
            </div>
            
            <div class="snip1404 row">
              <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($plan->delete_status == 1): ?>
                <?php if($plan->status != 'inactive'): ?>
                  <div class="col-lg-3 col-sm-6">
                    <div class="main-plan-section  <?php if(isset($current_subscription) && $current_subscription->package_id == $plan->id): ?> main-plan-section-two <?php endif; ?>">
                      <header>
                        <h4 class="plan-home-title">
                         <?php echo e($plan->name); ?> 
                        </h4>
                        <div class="plan-cost"><span class="plan-price">
                          <?php if(Session::has('current_currency')): ?>

                            <?php echo e(currency($plan->amount, $from = $plan->currency, $to = Session::has('current_currency') ? ucfirst(Session::get('current_currency')) : $plan->currency, $format = true)); ?></span> <span class="plan-type">
                            <?php echo e(currency($plan->amount, $from = $plan->currency, $to = Session::has('current_currency') ? ucfirst(Session::get('current_currency')) : $plan->currency, $format = true)); ?> / <?php echo e(($plan->interval_count)); ?> 
                          <?php else: ?>
                            <i class="<?php echo e($plan->currency_symbol); ?>"></i><?php echo e($plan->amount); ?></span><span class="plan-type">
                            <i class="<?php echo e($plan->currency_symbol); ?>"></i> <?php echo e(number_format(($plan->amount) / ($plan->interval_count),2)); ?> /
                          <?php endif; ?>
                            <?php if($plan->interval == 'year'): ?>
                              <?php echo e(__('Yearly')); ?>

                            <?php elseif($plan->interval == 'month'): ?>
                              <?php echo e(__('Monthly')); ?>

                            <?php elseif($plan->interval == 'week'): ?>
                              <?php echo e(__('Weekly')); ?>

                            <?php elseif($plan->interval == 'day'): ?>
                              <?php echo e(__('Daily')); ?>

                            <?php endif; ?>
                        </span></div>
                      </header>
                        
                      <?php
                      $pricingTexts = App\PricingText::where('package_id',$plan->id)->get();
                      ?>
                      <?php if(isset($package_feature)): ?>
                        <?php $__currentLoopData = $package_feature; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <ul class="plan-features">
                            <?php if(isset($plan['feature'])): ?>
                             <li><?php if(in_array($pf->id, $plan['feature'])): ?><i class="fa fa-check "> </i><?php else: ?> <i class="fa fa-close "> </i> <?php endif; ?> <?php echo e($pf->name); ?></li> <?php endif; ?>
                           </ul>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php endif; ?>
                  
                      <?php if(auth()->guard()->check()): ?>
                        <?php if(isset($current_subscription) && $current_subscription->package_id == $plan->id): ?>
                        <div class="plan-select"><a class="btn btn-prime btn-prime-bg"><?php echo e(__('already subscribe')); ?></a></div>

                        <?php else: ?>
                          <?php if(!isset($current_subscription) && $current_subscription == NULL): ?>
                            <?php if($plan->free == 1 && $plan->status == 'upcoming'): ?>
                                <div class="plan-select"><a href="#" class="btn btn-prime"><?php echo e(__('COMING SOON!')); ?></a></div>
                            <?php elseif($plan->free == 1 && $plan->status == 'active'): ?>
                            <form action="<?php echo e(route('free.package.subscription',$plan->id)); ?>" method="POST">
                              <?php echo csrf_field(); ?>
                                <div class="plan-select btn-prime-subs"><a class="btn btn-prime"><input type="submit" class="btn-subscribe" value="<?php echo e(__('subscribe')); ?>"></a></div>
                              </form>
                            <?php elseif($plan->status == 'upcoming'): ?>
                            <div class="plan-select"><a href="#" class="btn btn-prime"><?php echo e(__('COMING SOON!')); ?></a></div>
                            
                            <?php else: ?>
                              <div class="plan-select"><a href="<?php echo e(route('get_payment', $plan->id)); ?>" class="btn btn-prime"><?php echo e(__('subscribe')); ?></a></div>
                            <?php endif; ?>
                          <?php endif; ?>
                        <?php endif; ?>
                        
                      <?php else: ?>
                        <div class="plan-select"><a href="<?php echo e(route('register')); ?>"><?php echo e(__('register now')); ?></a></div>
                      <?php endif; ?>
                    </div>
                  </div>
                <?php endif; ?>
              <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end main wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/user/purchaseplan.blade.php ENDPATH**/ ?>