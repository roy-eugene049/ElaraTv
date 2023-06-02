
<?php $__env->startSection('title',"Search result for $searchKey"); ?>
<?php $__env->startSection('main-wrapper'); ?>
  <!-- main wrapper -->
<?php
  $age=0;
  if ($configs->age_restriction==1) {
    if(Auth::user()){
      $user_id=Auth::user()->id;
      $user=App\User::findOrfail($user_id);
      $age=$user->age;
    }
  }else{
    $age=100;
  }
 $withlogin= $configs->withlogin;
 $auth=Auth::user();


?>
  <section class="main-wrapper main-wrapper-single-movie-prime">
    <div class="container-fluid movie-series-section search-section">
      <?php if(isset($actor)): ?>
        <div class="movie-series-block">
          <div class="row">
            <div class="col-12 col-sm-3 col-lg-2">
              <div class="movie-series-img">
                <?php
                  if ($actor->image != null) {
                    $content = @file_get_contents(public_path() . '/images/actors/' . $actor->image);
                    if($content){
                      $image = public_path() .'/images/actors/' . $actor->image;
                    }else{
                      $image = Avatar::create($actor->name)->toBase64();
                    }
                  }else{
                    $image = Avatar::create($actor->name)->toBase64();
                  }
                  $imageData = base64_encode(@file_get_contents($image));
                  if($imageData){
                      $actorsrc = 'data: '.mime_content_type($image).';base64,'.$imageData;
                  }

                ?>
                <?php if($actorsrc != NULL): ?>
                  <img data-src="<?php echo e($actorsrc); ?>" class="img-responsive actor_image lazy" alt="actor-image">
               
                <?php endif; ?>
              </div>
            </div>
            <div class="col-12 col-sm-9 col-lg-10">
              <div class="movie-series-section search-actor">
                <h5 class="movie-series-heading movie-series-name">
                  <?php echo e($actor->name); ?>

                </h5>
                <p>
                  <?php echo e(__('dob')); ?>- <?php echo e($actor->DOB ? $actor->DOB : __('Not Available')); ?> </p>
                <p>
                  <?php echo e(__('placeofbirth')); ?>- <?php echo e($actor->place_of_birth ? $actor->place_of_birth : __('Not Available')); ?> </p>
                <p>
                  <?php echo e($actor->biography); ?>

                </p>
              </div>
            </div>
          </div>
        </div>
        <h5 class="movie-series-heading"><?php echo e(count($filter_video)); ?> <?php echo e(__('Found For')); ?> "<?php echo e($searchKey); ?>"</h5>
        
      <?php endif; ?>

      <?php if(isset($director)): ?>
        <div class="movie-series-block">
          <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-3">
              <div class="movie-series-img">
                <?php
                  if ($director->image != null) {
                    $content = @file_get_contents(public_path() . '/images/directors/' . $director->image);
                   
                    if($content){
                      $image = public_path() .'/images/directors/' . $director->image;
                    }else{
                      $image = Avatar::create($director->name)->toBase64();
                    }
                  }else{
                    $image = Avatar::create($director->name)->toBase64();
                  }
                  $imageData = base64_encode(@file_get_contents($image));
                  if($imageData){
                      $directorsrc = 'data: '.mime_content_type($image).';base64,'.$imageData;
                  }

                ?>

                <?php if($directorsrc !=NULL): ?>
                  <img data-src="<?php echo e($directorsrc); ?>" class="img-responsive actor_image lazy" alt="Director-image">
                <?php endif; ?>
              </div>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-9">
              <div class="movie-series-section search-actor">
                <h5 class="movie-series-heading movie-series-name">
                  <?php echo e($director->name); ?>

                </h5>
                <p>
                  <?php echo e(__('DOB')); ?>- <?php echo e($director->DOB); ?> </p>
                <p>
                  <?php echo e(__('Place of Brth')); ?>- <?php echo e($director->place_of_birth); ?></p>                
                <p>
                  <?php echo e($director->biography); ?>

                </p>
              </div>
            </div>
          </div>
        </div>
        <h5 class="movie-series-heading"><?php echo e(count($filter_video)); ?> <?php echo e(__('Found For')); ?> "<?php echo e($searchKey); ?>"</h5>
      <?php endif; ?>

      <?php if(isset($filter_video)): ?>
        <?php if(count($filter_video) > 0): ?>
          <?php $__currentLoopData = $filter_video->unique('id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
              if($auth){
                if ($item->type == 'M')
                {
                  $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                            ['user_id', '=', $auth->id],
                                                                            ['movie_id', '=', $item->id],
                                                                           ])->first();
                } else {
                  $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                            ['user_id', '=', $auth->id],
                                                                            ['season_id', '=', $item->id],
                                                                           ])->first();
                }
              }
            ?>
            <div class="movie-series-block">
              <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-3">
                  <div class="movie-series-img home-prime-slider">
                   
                    <?php if($item->type == 'M'): ?>
                      <?php
                      if($item->thumbnail != NULL){
                        $content = @file_get_contents(public_path() .'/images/movies/thumbnails/'.$item->thumbnail);
                        
                        if($content){
                          $image = public_path() .'/images/movies/thumbnails/'.$item->thumbnail;
                        }else{
                          $image = Avatar::create($item->title)->toBase64();
                        }
                      }else{
                        $image = Avatar::create($item->title)->toBase64();
                      }
                      
                      $imageData = base64_encode(@file_get_contents($image));
                      if($imageData){
                          $movie_src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                      }
                      ?>
                      <?php if($movie_src != null): ?> 
                        <img data-src="<?php echo e($movie_src); ?>" class="img-responsive actor_image lazy" alt="genre-image">
                      <?php endif; ?>
                      <?php if($item->is_custom_label == 1): ?>
                        <?php if(isset($item->label_id)): ?>
                          <span class="badge bg-info"><?php echo e($item->label->name); ?></span>
                        <?php endif; ?>
                      <?php else: ?>
                        <?php if(isset($item->is_upcoming) && $item->is_upcoming == 1): ?>
                          <?php if($item->upcoming_date != NULL): ?>
                            <span class="badge bg-success"><?php echo e(date('M jS Y',strtotime($item->upcoming_date))); ?></span>
                          <?php else: ?>
                            <span class="badge bg-danger"><?php echo e(__('Coming Soon')); ?></span>
                          <?php endif; ?>
                      
                        <?php endif; ?>
                      <?php endif; ?>
                     
                    <?php elseif($item->type == 'S'): ?>
                      <?php
                        if($item->thumbnail != NULL){
                          $content = @file_get_contents(public_path() .'/images/tvseries/thumbnails/'. $item->thumbnail); 
                          if($content){
                            $image = public_path() .'/images/tvseries/thumbnails/'. $item->thumbnail;
                          }
                        }elseif($item->tvseries->thumbnail != NULL){
                          $content = @file_get_contents(public_path() .'/images/tvseries/thumbnails/'. $item->tvseries->thumbnail); 
                          if($content){
                            $image = public_path() .'/images/tvseries/thumbnails/'. $item->tvseries->thumbnail;
                          }
                        }else{
                          $image = Avatar::create($item->tvseries->title)->toBase64();
                        }

                        $imageData = base64_encode(@file_get_contents($image));
                        if($imageData){
                            $tvseires_src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                        }
                        
                      ?>
                      <?php if($tvseires_src != null): ?>
                        <img data-src="<?php echo e($tvseires_src); ?>" class="img-responsive actor_image lazy" alt="genre-image">
                        <?php if($item->tvseries->is_custom_label == 1): ?>
                          <?php if(isset($item->tvseries->label_id)): ?>
                            <span class="badge bg-info"><?php echo e($item->tvseries->label->name); ?></span>
                          <?php endif; ?>
                        <?php endif; ?>
                      
                      <?php endif; ?>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-9">
                  <div class="movie-series-section search-actor">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-6">
                        <h5 class="movie-series-heading movie-series-name">
                          <?php if($item->type == 'M'): ?>
                            <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                              <a href="<?php echo e(url('movie/detail', $item->slug)); ?>"><?php echo e($item->title); ?></a>
                            <?php else: ?>
                                <a href="<?php echo e(url('movie/guest/detail', $item->slug)); ?>"><?php echo e($item->title); ?></a>
                            <?php endif; ?>
                          <?php elseif($item->type == 'S'): ?>
                            <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                              <a href="<?php echo e(url('show/detail', $item->season_slug)); ?>"><?php echo e($item->tvseries->title); ?></a>
                            <?php else: ?>
                              <a href="<?php echo e(url('show/guest/detail', $item->season_slug)); ?>"><?php echo e($item->tvseries->title); ?></a>
                            <?php endif; ?>
                          <?php endif; ?>
                        </h5>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6">
                        <ul class="movie-series-des-list">
                          <li>
                            <?php if($item->type == 'M'): ?>
                              <?php if($item->duration != NULL): ?> <?php echo e($item->duration); ?> <?php echo e(__('Mins')); ?><?php endif; ?>
                            <?php else: ?>
                              <?php echo e(__('Season')); ?> <?php echo e($item->season_no); ?> 
                            <?php endif; ?>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <p>
                      <?php if($item->type == 'M'): ?>
                        <?php echo e(str_limit($item->detail, 360)); ?>

                        <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                          <a href="<?php echo e(url('movie/detail', $item->slug)); ?>"><?php echo e(__('Read More')); ?></a>
                        <?php else: ?>
                            <a href="<?php echo e(url('movie/guest/detail', $item->slug)); ?>"><?php echo e(__('Read More')); ?></a>
                        <?php endif; ?>

                      <?php else: ?>
                        <?php if($item->detail != null || $item->detail != ''): ?>
                          <?php echo e(str_limit($item->detail, 360)); ?>

                          <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                            <a href="<?php echo e(url('show/detail', $item->season_slug)); ?>"><?php echo e(__('Read More')); ?></a>
                          <?php else: ?>
                              <a href="<?php echo e(url('show/guest/detail', $item->season_slug)); ?>"><?php echo e(__('Read More')); ?></a>
                          <?php endif; ?>
                        <?php else: ?>
                          <?php echo e(str_limit($item->tvseries->detail, 360)); ?>

                          <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                            <a href="<?php echo e(url('show/detail', $item->season_slug)); ?>"><?php echo e(__('Read More')); ?></a>
                          <?php else: ?>
                              <a href="<?php echo e(url('show/guest/detail', $item->season_slug)); ?>"><?php echo e(__('Read More')); ?></a>
                          <?php endif; ?>
                        <?php endif; ?>
                      <?php endif; ?>
                    </p>
                    <div class="des-btn-block des-in-list">
                      <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                        <?php if($item->type == 'M' ): ?>
                          <?php if($item->is_upcoming != 1): ?>
                            <?php if(checkInMovie($item) == true && isset($item->video_link)): ?>
                              <?php if($item->maturity_rating =='all age' || $age>=str_replace('+', '',$item->maturity_rating)): ?>
                                <?php if(isset($item->video_link['iframeurl']) && $item->video_link['iframeurl'] != null): ?>
                                  <a href="<?php echo e(route('watchmovieiframe',$item->id)); ?>"class="btn btn-play search-btn iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span>
                                  </a>
                                <?php else: ?> 
                                  <a href="<?php echo e(route('watchmovie', $item->id)); ?>" class="iframe btn btn-play search-btn"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span>
                                  </a>
                                <?php endif; ?>
                              <?php else: ?>
                                <a onclick="myage(<?php echo e($age); ?>)" class="btn btn-play search-btn"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span>
                                </a>
                              <?php endif; ?>
                            <?php endif; ?>
                          <?php endif; ?>
                          <?php if($item->trailer_url != null || $item->trailer_url != ''): ?>
                            <a href="<?php echo e(route('watchTrailer',$item->id)); ?>" class="iframe btn btn-default"><?php echo e(__('Watch Trailer')); ?></a>
                          <?php endif; ?>
                        <?php else: ?>
                          <?php if(isset($item->episodes[0]) && checkInTvseries($item) == true && isset($item->episodes[0]->video_link)): ?>
                            <?php if(isset($item->episodes[0]->video_link->iframeurl) && $item->episodes[0]->video_link->iframeurl !=""): ?>

                              <a href="#" onclick="playoniframe('<?php echo e($item->episodes[0]->video_link->iframeurl); ?>','<?php echo e($item->id); ?>','tv')" class="btn btn-play search-btn"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span>
                              </a>

                            <?php else: ?> 
                              <a href="<?php echo e(route('watchTvShow', $item->id)); ?>" class="iframe btn btn-play search-btn"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span></a>
                            <?php endif; ?>
                          <?php endif; ?>
                        <?php endif; ?>
                      
                        
                        <?php if($auth): ?>
                          <?php if(isset($wishlist_check->added)): ?>
                              <a onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('Rmove From Watchlist') : __('Add to Watchlist')); ?></a>
                          <?php else: ?>
                            <a onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e(__('Add to Watchlist')); ?></a>
                            <?php endif; ?>
                        <?php endif; ?>
                      <?php else: ?>
                        <div class="des-btn-block des-in-list">
                          <?php if($item->trailer_url != null || $item->trailer_url != ''): ?>
                            <a href="<?php echo e(route('guestwatchtrailer',$item->id)); ?>" class="iframe btn btn-default"><?php echo e(__('Watch Trailer')); ?></a>
                          <?php endif; ?>
                        </div>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
               
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
          <div class="container-fluid movie-series-section search-section">
            <div class="search-box">
              <h5 class="movie-series-heading text-center"><?php echo e(__('Sorry, there are no data that matched your search request')); ?> </h5>
              <p class="text-center"><?php echo e(__('Please try diffrent criteria such as actor, director and genre etc !')); ?></p>
          
            </div>
          </div>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </section>
  <!-- end main wrapper -->
 



<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-script'); ?>
  <script>
  

    

    
    function playTrailer(url) {
      $('.video-player').css({
        "visibility" : "visible",
        "z-index" : "99999",
      });
      $('body').css({
        "overflow": "hidden"
      });
      $('#my_video').show();
      $('.vjs-control-bar').removeClass('hide-visible');
      let str = url;
      let youtube_slice_1 = str.slice(0, 14);
      let youtube_slice_2 = str.slice(0, 20);
      if (youtube_slice_1 == "https://youtu." || youtube_slice_2 == "https://www.youtube.")
      {
        $('.vjs-control-bar').addClass('hide-visible');
        player.src({ type: "video/youtube", src: url});
      } else {
        player.src({ type: "video/mp4", src: url});
      }

      setTimeout(function(){
        player.play();
      }, 300);
    }

    

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



    <script>

      function playoniframe(url,id,type){
        $(document).ready(function(){
          var SITEURL = '<?php echo e(URL::to('')); ?>';
           $.ajax({
                type: "get",
                url: SITEURL + "/user/watchhistory/"+id+'/'+type,
                success: function (data) {
                 console.log(data);
                },
                error: function (data) {
                   console.log(data)
                }
            });
      
        });       
        $.colorbox({ href: url, width: '100%', height: '100%', iframe: true });
      }
      
    </script>
  <script>  
      function myage(age){
        if (age==0) {
        $('#ageModal').modal('show'); 
      }else{
          $('#ageWarningModal').modal('show');
      }
    }
      
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/search.blade.php ENDPATH**/ ?>