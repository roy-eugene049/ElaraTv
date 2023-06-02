<!--------------------- live event ------------------------->

    <?php if(isset($liveevent) && count($liveevent) > 0): ?>
      <div class="genre-prime-block">

        <div class="container-fluid">
          <h5 class="section-heading"><?php echo e(__('Live Event')); ?> </h5>
          <div class="genre-prime-slider owl-carousel">
            <?php $__currentLoopData = $liveevent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $liveevents): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="genre-prime-slide">
                <div class="genre-slide-image protip" data-pt-placement="outside" data-pt-title="#prime-genre-event-description-block<?php echo e($liveevents->id); ?>">
                  <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                    <a href="<?php echo e(url('event/detail',$liveevents->slug)); ?>">
                    <?php if($liveevents->thumbnail != null || $liveevents->thumbnail != ''): ?>
                      <img data-src="<?php echo e(asset('images/events/thumbnails/'.$liveevents->thumbnail)); ?>" class="img-responsive owl-lazy" alt="liveevent-image">
                    <?php else: ?>
                      <img data-src="<?php echo e(asset('images/default-thumbnail.jpg')); ?>" class="img-responsive owl-lazy" alt="liveevent-image">
                    <?php endif; ?>
                   </a>
                  <?php else: ?>
                    <a href="<?php echo e(url('event/guest/detail',$liveevents->slug)); ?>">
                    <?php if($liveevents->thumbnail != null || $liveevents->thumbnail != ''): ?>
                      <img data-src="<?php echo e(asset('images/events/thumbnails/'.$liveevents->thumbnail)); ?>" class="img-responsive owl-lazy" alt="liveevent-image">
                    <?php else: ?>
                      <img data-src="<?php echo e(asset('images/default-thumbnail.jpg')); ?>" class="img-responsive owl-lazy" alt="liveevent-image">
                    <?php endif; ?>
                    </a>
                  <?php endif; ?>
                </div>
                <?php if(isset($protip) && $protip == 1): ?>
                <div id="prime-genre-event-description-block<?php echo e($liveevents->id); ?>" class="prime-description-block">
                  <div class="prime-description-under-block">
                    <h5 class="description-heading"><?php echo e(str_limit($liveevents->title,100)); ?></h5></br>
                    <p>Start Time :- <b> <?php echo e(date('F j, Y  g:i:a',strtotime($liveevents->start_time))); ?> </b> </p>

                    <p>End Time :- <b> <?php echo e(date('F j, Y  g:i:a',strtotime($liveevents->end_time))); ?> </b> </p>

                    <p>Organized By :- <b> <?php echo e($liveevents->organized_by); ?> </b> </p>
                
                    <div class="main-des">
                      <p><?php echo e(str_limit($liveevents->description,100)); ?></p>
                      
                      <a href="#"><?php echo e(__('Read More')); ?></a>
                    </div>
                    <div class="des-btn-block">
                     <?php
                        date_default_timezone_set('Asia/Calcutta');
                        $today_date = date('d jS Y | h:i:s');

                         $start_date = date('d jS Y | h:i a',strtotime($liveevents->start_time));

                         $end_date = date('d jS Y | h:i a',strtotime($liveevents->end_time));
                          
                      ?>
                      <?php if($today_date >= $start_date && $today_date <= $end_date): ?>

                        <?php if(isset($liveevents->video_link['iframeurl']) && $liveevents->video_link['iframeurl'] != null): ?>
                          <?php if(Auth::check() && Auth::user()->is_admin == '1'): ?>
                            <a onclick="playoniframe('<?php echo e($liveevents['iframeurl']); ?>','<?php echo e($liveevents->id); ?>','event')" class="btn btn-play play-btn-icon<?php echo e($liveevents['id']); ?>"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span>
                             </a>
                          <?php else: ?>

                             <a onclick="playoniframe('<?php echo e($liveevents['iframeurl']); ?>','<?php echo e($liveevents->id); ?>','event')" class="btn btn-play play-btn-icon<?php echo e($liveevents['id']); ?>"><span class="play-btn-icon "><i class="fa fa-play"></i></span><span class="play-text"><?php echo e(__('Play Now')); ?></span>
                              </a>
                          <?php endif; ?>

                        <?php else: ?>
                          <?php if(Auth::check() && Auth::user()->is_admin == '1'): ?>
                            <a  href="<?php echo e(route('watchevent',$liveevents->id)); ?>" class="btn btn-play play-btn-icon<?php echo e($liveevents['id']); ?>"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span>
                              </a>
                          <?php else: ?>
                            <a href="<?php echo e(url('/watch/event/'.$liveevents->id)); ?>" class=" btn btn-play play-btn-icon<?php echo e($liveevents['id']); ?>"><span class="play-btn-icon "><i class="fa fa-play" ><span class="play-text"><?php echo e(__('Play Now')); ?> </span></a>
                          <?php endif; ?>
                        <?php endif; ?>
                      
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
                <?php endif; ?>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
      </div>
    <?php endif; ?>


<!-------------------- end live event ----------------------><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/event.blade.php ENDPATH**/ ?>