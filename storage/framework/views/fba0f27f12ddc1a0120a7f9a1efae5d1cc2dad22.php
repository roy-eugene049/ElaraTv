<?php if(isset($audio) && count($audio)>0): ?>
<div class="genre-prime-block">
  <div class="container-fluid">
    <h5 class="section-heading">Audio</h5>
    <div class="genre-prime-slider owl-carousel">
      <?php $__currentLoopData = $audio; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $audios): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

      <div class="genre-prime-slide">
        <div class="genre-slide-image protip" data-pt-placement="outside"
          data-pt-title="#prime-mix-description-block-blog<?php echo e($audios->id); ?>">
          <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
          <a href="<?php echo e(url('audio/detail/'.$audios->id)); ?>">
            <?php if($audios->thumbnail != null): ?>
            <img data-src="<?php echo e(asset('images/audio/thumbnails/'.$audios->thumbnail)); ?>" class="img-responsive owl-lazy"
              alt="audio-image">
            <?php else: ?>
            <img data-src="<?php echo e(asset('images/default-thumbnail.jpg')); ?>" class="img-responsive owl-lazy" alt="blog-image">
            <?php endif; ?>
          </a>
          <?php else: ?>
          <a href="<?php echo e(url('audio/guest/detail/'.$audios->id)); ?>">
            <?php if($audios->thumbnail != null): ?>
            <img data-src="<?php echo e(asset('images/audio/thumbnails/'.$audios->thumbnail)); ?>" class="img-responsive owl-lazy"
              alt="audio-image">
            <?php else: ?>
            <img data-src="<?php echo e(asset('images/default-thumbnail.jpg')); ?>" class="img-responsive owl-lazy" alt="blog-image">
            <?php endif; ?>
          </a>
          <?php endif; ?>
        </div>
        <div id="prime-mix-description-block-blog<?php echo e($audios->id); ?>" class="prime-description-block">
          <h5 class="description-heading"><?php echo e($audios['title']); ?></h5>

          <div class="main-des">
            <p><?php echo str_limit($audios->detail, 100); ?></p>

          </div>
        </div>
      </div>

      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
</div>
<?php endif; ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/audio.blade.php ENDPATH**/ ?>