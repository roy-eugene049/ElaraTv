
<?php $__env->startSection('title',__('Kids')); ?>
<?php $__env->startSection('main-wrapper'); ?>
<section id="wishlistelement" class="main-wrapper">
    <div>
        <?php if(isset($kids_home_slides) && count($kids_home_slides) > 0): ?>
            <div id="home-main-block" class="home-main-block">
                <div id="home-slider-one" class="home-slider-one owl-carousel">
                    <?php $__currentLoopData = $kids_home_slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($slide->active == 1): ?>
                        <div class="slider-block ">
                        <div class="slider-image">
                            <?php if(isset($slide->slide_image)): ?>  
                            <?php if($slide->movie_id != null): ?>
                                <?php if(isset($auth) && getSubscription()->getData()->subscribed == true): ?>

                                <a href="<?php echo e(isset($slide->movie) && $slide->movie != NULL ? url('movie/detail', $slide->movie->slug) : '#'); ?>">
                                    <?php if($slide->slide_image != null): ?>
                                    <?php
                                        $image = 'images/home_slider/movies/'. $slide->slide_image;
                                        // Read image path, convert to base64 encoding
                                        
                                        $imageData = base64_encode(@file_get_contents($image));
                                        if($imageData){
                                        // Format the image SRC:  data:{mime};base64,{data};
                                        $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                        }else{
                                        $src = '';
                                        }
                                    ?>
                                    <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="slider-image">
                                    <?php elseif($slide->movie->poster != null): ?>
                                        <?php
                                            $image = 'images/movies/posters/'. $slide->movie->poster;
                                        // Read image path, convert to base64 encoding
                                        
                                        $imageData = base64_encode(@file_get_contents($image));
                                        if($src){
                                        // Format the image SRC:  data:{mime};base64,{data};
                                        $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                        }else{
                                            $src = '';
                                            }
                                        ?>
                                        <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="slider-image">
                                    <?php endif; ?>
                                </a>
                                <?php else: ?>
                                <a href="<?php echo e(isset($slide->movie) && $slide->movie != NULL ? url('movie/guest/detail', $slide->movie->slug) : '#'); ?>">
                                    <?php if($slide->slide_image != null): ?>
                                    <?php
                                        $image = 'images/home_slider/movies/'. $slide->slide_image;
                                        // Read image path, convert to base64 encoding
                                        
                                        $imageData = base64_encode(@file_get_contents($image));
                                        if($imageData){
                                        // Format the image SRC:  data:{mime};base64,{data};
                                        $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                        }else{
                                            $src = '';
                                        }
                                    ?>
                                    <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="slider-image">
                                    <?php elseif($slide->movie->poster != null): ?>
                                    <?php
                                        $image = 'images/movies/posters/'. $slide->movie->poster;
                                        // Read image path, convert to base64 encoding
                                        
                                        $imageData = base64_encode(@file_get_contents($image));
                                        if($src){
                                        // Format the image SRC:  data:{mime};base64,{data};
                                        $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                        }else{
                                            $src = '';
                                        }
                                    ?>
                                    <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="slider-image">
                                    <?php endif; ?>
                                </a>
                                <?php endif; ?>
                            <?php elseif($slide->tv_series_id != null): ?>
                                <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                                <a href="<?php echo e(isset($slide->tvseries->seasons[0]) && $slide->tvseries->seasons[0] != NULL ? url('show/detail', $slide->tvseries->seasons[0]->season_slug) : '#'); ?>">
                                    <?php if($slide->slide_image != null): ?>
                                    <img data-src="<?php echo e(url('images/home_slider/shows/'. $slide->slide_image)); ?>" class="img-responsive owl-lazy" alt="slider-image">
                                    <?php elseif($slide->tvseries->poster != null): ?>
                                    <img data-src="<?php echo e(url('images/tvseries/posters/'. $slide->tvseries->poster)); ?>" class="img-responsive owl-lazy" alt="slider-image">
                                    <?php endif; ?>
                                </a>
                                <?php else: ?>
                                <a href="<?php echo e(isset($slide->tvseries->seasons[0]) && $slide->tvseries->seasons[0] != NULL ? url('show/guest/detail', $slide->tvseries->seasons[0]->season_slug) : '#'); ?>">
                                    <?php if($slide->slide_image != null): ?>
                                    <img data-src="<?php echo e(url('images/home_slider/shows/'. $slide->slide_image)); ?>" class="img-responsive owl-lazy" alt="slider-image">
                                    <?php elseif($slide->tvseries->poster != null): ?>
                                    <img data-src="<?php echo e(url('images/tvseries/posters/'. $slide->tvseries->poster)); ?>" class="img-responsive owl-lazy" alt="slider-image">
                                    <?php endif; ?>
                                </a>
                                <?php endif; ?>
                            <?php else: ?>
                                <a href="#">
                                <?php if($slide->slide_image != null): ?>
                                    <img data-src="<?php echo e(url('images/home_slider/'. $slide->slide_image)); ?>" class="img-responsive owl-lazy" alt="slider-image">
                                <?php endif; ?>
                                </a>
                            <?php endif; ?>
                            <?php endif; ?>
                            
                        </div>
                        </div>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>





    
<!---------------- Recently Added Movies  in kids Start  ------------------>
<?php if(isset($kids_movies) && count($kids_movies) > 0): ?>
<div class="genre-prime-block genre-prime-block-one genre-paddin-top genre-top-slider">
  <div class="container-fluid">
     <h5 class="section-heading"><?php echo e(__('Movies for Kids')); ?></h5>
        <div class="genre-prime-slider owl-carousel">
           <?php $__currentLoopData = $kids_movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($m->status == 1): ?>
                <?php if($m->type == 'M'): ?>
                  <?php
                    if($m->thumbnail != NULL){
                      $image = public_path() . '/images/movies/thumbnails/'.$m->thumbnail;
                    }else{
                      $image = Avatar::create($m->title)->toBase64();
                    }
                    // Read image path, convert to base64 encoding
                    $imageData = base64_encode(@file_get_contents($image));
                    if($imageData){
                        $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                    }else{
                        $src = Avatar::create($m->title)->toBase64();
                    }
                  ?>
                  <?php if(hidedata($m->id,$m->type) != 1): ?>
                  <div class="genre-prime-slide">
                    <div class="genre-slide-image home-prime-slider protip" data-pt-placement="outside" data-pt-title="#prime-mix-description-block<?php echo e($m->id); ?>" data-pt-interactive="false">
                      <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                        <a href="<?php echo e(url('movie/detail',$m->slug)); ?>">
                          <?php if($src): ?>
                            <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                          <?php endif; ?>
                        </a>
                        <div class="hide-icon">
                          <a onclick="hideforme('<?php echo e($m->id); ?>','<?php echo e($m->type); ?>')" title="<?php echo e(__('Hide this Movie')); ?>" class=""><i class="fa fa-eye-slash"></i></a>
                        </div>
                        <?php if(timecalcuate($auth->id,$m->id,$m->type) != 0): ?>
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo e(timecalcuate($auth->id,$m->id,$m->type)); ?>%">
                          </div>
                        </div>
                        <?php endif; ?>
                      <?php endif; ?>
                      <?php if($m->is_custom_label == 1): ?>
                        <?php if(isset($m->label_id)): ?>
                          <span class="badge bg-info"><?php echo e($m->label->name); ?></span>
                        <?php endif; ?>
                      <?php endif; ?>
                    </div>

                    <?php if($protip == 1): ?>

                    <div id="prime-mix-description-block<?php echo e($m->id); ?>" class="prime-description-block">
                      <h5 class="description-heading"><?php echo e($m->title); ?></h5>
                      
                      <ul class="description-list">
                        <li><?php echo e(__('tmdb rating')); ?> <?php echo e($m->rating); ?></li>
                        <li><?php echo e($m->duration); ?> <?php echo e(__('Mins')); ?></li>
                        <li><?php echo e($m->publish_year); ?></li>
                        <li><?php echo e($m->maturity_rating); ?></li>
                       
                      </ul>
                      <div class="main-des">
                        <p><?php echo e(str_limit($m->detail,100,'...')); ?></p>
                        <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                          <a href="<?php echo e(url('movie/detail',$m->slug)); ?>"><?php echo e(__('Read More')); ?></a>
                        <?php endif; ?>
                      </div>  
                      <div class="des-btn-block">
                       
                        <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                          <?php if($m->is_upcoming == 0): ?>
                          <?php if(checkInMovie($m) == true && isset($m->video_link)): ?>
                        
                              <?php if(isset($m->video_link['iframeurl']) && $m->video_link['iframeurl'] != null): ?>
                              
                              <a href="<?php echo e(route('watchmovieiframe',$m->id)); ?>"class="btn btn-play iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span>
                              </a>

                              <?php else: ?>
                                <a href="<?php echo e(route('watchmovie',$m->id)); ?>" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span>
                                </a>
                              <?php endif; ?>
                            <?php else: ?>
                            <a onclick="myage(<?php echo e($age); ?>)" class=" btn btn-play play-btn-icon"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span></a>
                              
                            <?php endif; ?>
                          
                        <?php endif; ?>
                          <?php if($m->trailer_url != null || $m->trailer_url != ''): ?>
                            <a class="iframe btn btn-default" href="<?php echo e(route('watchTrailer',$m->id)); ?>"><?php echo e(__('Watch Trailer')); ?></a>
                          <?php endif; ?>
                        <?php endif; ?>
                      </div>
                    </div>
                    <?php endif; ?>   
                  </div>
                  <?php endif; ?>
                
                <?php endif; ?>
              <?php endif; ?>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
        </div>
      </div>
    </div> 
  <?php endif; ?>
<!------- Recently added movies in Kids End -------->


<?php if(isset($kids_recent_tv) && count($kids_recent_tv) > 0): ?>
<?php
$recentlyadded = [];

foreach ($kids_recent_tv as $key => $item) {
    
    $kids_rectvs =  App\TvSeries::
                  join('seasons','seasons.tv_series_id','=','tv_series.id')
                  ->join('episodes','episodes.seasons_id','=','seasons.id')
                  ->join('videolinks','videolinks.episode_id','=','episodes.id')
                  ->select('seasons.id as seasonid','tv_series.genre_id as genre_id','tv_series.id as id','tv_series.type as type','tv_series.status as status','tv_series.thumbnail as thumbnail','tv_series.title as title','tv_series.rating as rating','seasons.publish_year as publish_year','tv_series.maturity_rating as age_req','tv_series.detail as detail','seasons.season_no as season_no','videolinks.iframeurl as iframeurl','seasons.season_slug as season_slug','seasons.trailer_url as trailer_url','seasons.tmdb as tmdb','tv_series.is_custom_label as is_custom_label','tv_series.label_id as label_id')
                  ->where('tv_series.is_kids','=' ,1)
                  ->where('tv_series.id',$item->id)->first();
      
    $recentlyadded[] = $kids_rectvs;


}



$recentlyadded = array_values(array_filter($recentlyadded));

?>

<div class="genre-prime-block genre-prime-block-one genre-paddin-top genre-top-slider">
<div class="container-fluid">
     
  <h5 class="section-heading"><?php echo e(__('Tv-Shows for Kids')); ?></h5>
     
  <!-- Recently added movies and tv shows in list view End-->
    
      <div class="genre-prime-slider owl-carousel">
         <?php $__currentLoopData = $recentlyadded; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
             
                  $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();
            ?>

            <?php if($item->status == 1): ?>
              
              <?php if($item->type == 'T'): ?>
                  <?php
                       $image = 'images/tvseries/thumbnails/'.$item->thumbnail;
                      // Read image path, convert to base64 encoding
                      
                      $imageData = base64_encode(@file_get_contents($image));
                      if($imageData){
                          $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                      }else{
                          $src = Avatar::create($item->title)->toBase64();
                      }
                  ?>
                <?php if(hidedata($gets1->id,$gets1->type) != 1): ?>
                 <div class="genre-prime-slide">
                    <div class="genre-slide-image home-prime-slider protip" data-pt-placement="outside" data-pt-title="#prime-mix-description-block<?php echo e($item->id); ?><?php echo e($item->type); ?>">
                      <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                        <a <?php if(isset($gets1)): ?> href="<?php echo e(url('show/detail',$gets1->season_slug)); ?>" <?php endif; ?>>
                          <?php if($src != null): ?>
                            
                            <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                          <?php endif; ?>
                        </a>
                        <div class="hide-icon">
                          <a onclick="hideforme('<?php echo e($gets1->id); ?>','<?php echo e($gets1->type); ?>')" title="<?php echo e(__('Hide this Movie')); ?>" class=""><i class="fa fa-eye-slash"></i></a>
                        </div>
                      <?php else: ?>
                        <a <?php if(isset($gets1)): ?> href="<?php echo e(url('show/guest/detail',$gets1->season_slug)); ?>" <?php endif; ?>>
                          <?php if($item->thumbnail != null): ?>
                            <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                          <?php endif; ?>
                        </a>
                      <?php endif; ?>
                      <?php if($item->is_custom_label == 1): ?>
                        <?php if(isset($item->label_id)): ?>
                          <span class="badge bg-info"><?php echo e($item->label->name); ?></span>
                        <?php endif; ?>
                      <?php endif; ?>
                     
                    </div>
                    <?php if(isset($protip) && $protip == 1): ?>
                    <div id="prime-mix-description-block<?php echo e($item->id); ?><?php echo e($item->type); ?>" class="prime-description-block">
                      <h5 class="description-heading"><?php echo e($item->title); ?></h5>
                      
                      <ul class="description-list">
                        <li><?php echo e(__('Tmdb Rating')); ?> <?php echo e($item->rating); ?></li>
                        <li><?php echo e(__('Season')); ?> <?php echo e($item->season_no); ?></li>
                        <li><?php echo e($item->publish_year); ?></li>
                        <li><?php echo e($item->age_req); ?></li>
                       
                      </ul>
                      <div class="main-des">
                        <?php if($item->detail != null || $item->detail != ''): ?>
                          <p><?php echo e(str_limit($item->detail,100,'...')); ?></p>
                        <?php else: ?>
                          <p><?php echo e(str_limit($item->detail,100,'...')); ?></p>
                        <?php endif; ?>
                        <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                          <a href="<?php echo e(url('show/detail',$item->season_slug)); ?>"><?php echo e(__('Read More')); ?></a>
                        <?php else: ?>
                           <a href="<?php echo e(url('show/guest/detail',$item->season_slug)); ?>"><?php echo e(__('Read More')); ?></a>
                        <?php endif; ?>
                      </div>
                     
                      <div class="des-btn-block">
                        <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                          <?php if(isset($gets1->episodes[0]) && checkInTvseries($item) == true && isset($gets1->episodes[0]->video_link)): ?>
                              <?php if($gets1->episodes[0]->video_link['iframeurl'] !=""): ?>
                           
                                <a href="#" onclick="playoniframe('<?php echo e($gets1->episodes[0]->video_link['iframeurl']); ?>','<?php echo e($gets1->episodes[0]->seasons->tvseries->id); ?>','tv')" class="btn btn-play"><span class= "play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span>
                                </a>

                              <?php else: ?>
                                <a href="<?php echo e(route('watchTvShow',$gets1->id)); ?>" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span></a>
                              <?php endif; ?>
                          <?php endif; ?>
                          <?php if($gets1->trailer_url != null || $gets1->trailer_url != ''): ?>
                            <a href="<?php echo e(route('watchtvTrailer',$gets1->id)); ?>" class="iframe btn btn-default"><?php echo e(__('Watch Trailer')); ?></a>
                          <?php endif; ?>
                        <?php else: ?>
                           <?php if($gets1->trailer_url != null || $gets1->trailer_url != ''): ?>
                            <a href="<?php echo e(route('guestwatchtvtrailer',$gets1->id)); ?>" class="iframe btn btn-default"><?php echo e(__('Watch Trailer')); ?></a>
                          <?php endif; ?>
                        <?php endif; ?>
                        
                      </div>
                    </div>
                    <?php endif; ?>
                 </div>
                <?php endif; ?>
              <?php endif; ?>
            <?php endif; ?>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
      </div>
    
  <!-- Recently added movies and tv shows in list view End-->
   

  </div>
</div> 
<?php endif; ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-script'); ?>
<script>
 
      function myage(age){
        if (age==0) {
        $('#ageModal').modal('show'); 
      }else{
          $('#ageWarningModal').modal('show');
      }
    }
  
</script>

 
<script type="text/javascript">


function addWish(id, type) {
    //   app.addToWishList(id, type);
    $.ajax({
        type: 'POST',
        url: '<?php echo e(route('addtowishlist')); ?>',
        data: {"id": id, "type": type, "_token": "<?php echo e(csrf_token()); ?>"},
        success: function (data) {
            console.log(data);
        }
    });
    setTimeout(function() {
        $('.addwishlistbtn'+id+type).text(function(i, text){
          return text == "<?php echo e(__('Add to Watchlist')); ?>" ? "<?php echo e(__('Remove from Watchlist')); ?>" : "<?php echo e(__('Add to Watchlist')); ?>";
        });
      }, 100);
    }
  </script>

  <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/kids.blade.php ENDPATH**/ ?>