
<?php
  $auth = Illuminate\Support\Facades\Auth::user();
  $withlogin= $configs->withlogin;
  $catlog = $configs->catlog;   
 
?>
<?php if(isset($movie)): ?>
<?php $__env->startSection('custom-meta'); ?>

<?php $__env->startSection('title',$movie->title.' | '); ?>
<link rel="canonical" href="<?php echo e(url()->full()); ?>"/>
<meta name="robots" content="all">
<meta property="og:title" content="<?php echo e($movie->title); ?>"/>
<meta property="og:description" content="<?php echo e(substr(strip_tags($movie->detail), 0, 100)); ?><?php echo e(strlen(strip_tags($movie->detail))>100 ? '...' : ""); ?>" />
<meta property="og:type" content="website"/>
<meta property="og:url" content="<?php echo e(url()->full()); ?>" />
<meta property="og:image" content="<?php echo e(url('public/images/movies/thumbnails/'.$movie->thumbnail)); ?>" />

<meta name="twitter:title" content="<?php echo e($movie->title); ?>" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:description" content="<?php echo e($movie->detail); ?>" />
<meta name="twitter:site" content="<?php echo e(url()->full()); ?>" />

<?php $__env->stopSection(); ?>

<?php elseif($season): ?>

<?php
 $title = $season->tvseries->title;
 ?>
<?php $__env->startSection('custom-meta'); ?>
<meta property="og:title" content="<?php echo e($season->tvseries->title); ?>"/>
<meta property="og:description" content="<?php echo e(substr(strip_tags($season->tvseries->description), 0, 100)); ?><?php echo e(strlen(strip_tags($season->tvseries->description))>100 ? '...' : ""); ?>" />
<meta property="og:type" content="website"/>
<meta property="og:url" content="<?php echo e(url()->full()); ?>" />
<meta property="og:image" content="<?php echo e(url('public/images/movies/thumbnails/'.$season->thumbnail)); ?>" />

<meta name="twitter:title" content="<?php echo e($season->tvseries->title); ?>" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:description" content="<?php echo e($season->tvseries->description); ?>" />
<meta name="twitter:site" content="<?php echo e(url()->full()); ?>" />

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title',"$title"); ?>

<?php endif; ?>
<?php $__env->startSection('main-wrapper'); ?>
<!-- Modal -->
<?php echo $__env->make('modal.agemodal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Modal -->
<?php echo $__env->make('modal.agewarning', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- main wrapper -->
  <section class="main-wrapper main-wrapper-single-movie-prime">
    <div class="background-main-poster-overlay">
      <?php if(isset($movie)): ?>
            <?php if($movie->poster != null): ?>
              <div class="background-main-poster" style="background-image: url('<?php echo e(url('images/movies/posters/'.$movie->poster)); ?>');">
            <?php else: ?>
              <div class="background-main-poster" style="background-image: url('<?php echo e(url('images/default-poster.jpg')); ?>');">
            <?php endif; ?>
        <?php endif; ?>
        <?php if(isset($season)): ?>
          <?php if($season->poster != null): ?>
            <div class="background-main-poster" style="background-image: url('<?php echo e(url('images/tvseries/posters/'.$season->poster)); ?>');">
          <?php elseif($season->tvseries->poster != null): ?>
            <div class="background-main-poster" style="background-image: url('<?php echo e(url('images/tvseries/posters/'.$season->tvseries->poster)); ?>');">
          <?php else: ?>
            <div class="background-main-poster" style="background-image: url('<?php echo e(url('images/default-poster.jpg')); ?>');">
          <?php endif; ?>
        <?php endif; ?>
      </div>
      <div class="overlay-bg gredient-overlay-right"></div>
      <div class="overlay-bg"></div>
    </div>
    <div id="full-movie-dtl-main-block" class="full-movie-dtl-main-block">
      <div class="container-fluid">
        <?php if(isset($movie)): ?>
          <?php
            
            $a_languages = collect();
            if ($movie->a_language != null) {
              $a_lan_list = explode(',', $movie->a_language);
              for($i = 0; $i < count($a_lan_list); $i++) {
                try {
                  $a_language = App\AudioLanguage::find($a_lan_list[$i])->language;
                  $a_languages->push($a_language);
                } catch (Exception $e) {
                }
              }
            }
          if(isset($auth)){
            $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                        ['user_id', '=', $auth->id],
                                                                        ['movie_id', '=', $movie->id],
                                                                       ])->first();
                                                                     }
            // Directors list of movie from model
            $directors = collect();
            if ($movie->director_id != null) {
              $p_directors_list = explode(',', $movie->director_id);
              for($i = 0; $i < count($p_directors_list); $i++) {
                try {
                  $p_director = App\Director::find($p_directors_list[$i])->name;
                  $directors->push($p_director);
                } catch (Exception $e) {

                }
              }
            }

            // Actors list of movie from model
            $actors = collect();
            if ($movie->actor_id != null) {
              $p_actors_list = explode(',', $movie->actor_id);
              for($i = 0; $i < count($p_actors_list); $i++) {
                try {
                  $p_actor = App\Actor::find($p_actors_list[$i])->name;
                  $actors->push($p_actor);
                } catch (Exception $e) {

                }
              }
            }

            // Genre list of movie from model
            $genres = collect();
            if (isset($movie->genre_id)){
              $genre_list = explode(',', $movie->genre_id);
              for ($i = 0; $i < count($genre_list); $i++) {
                try {
                  $genre = App\Genre::find($genre_list[$i])->name;
                  $genres->push($genre);
                } catch (Exception $e) {

                }
              }
            }

          ?>
          <div class="row">
            <div class="col-md-8">
              <div class="full-movie-dtl-block">
                <h2 class="section-heading"><?php echo e($movie->title); ?>

                  <span>
                  <?php if($movie->live == 1): ?>
                    <?php if($movie->livetvicon != NULL): ?>
                      <?php
                          $livetv = App\Config::pluck('livetvicon')->first();
                      ?>
                      <img src="<?php echo e(url('images/livetvicon/'.$livetv)); ?>" alt="livetvicon-image" width="50">
                    <?php else: ?>
                      <img src="<?php echo e(url('images/default-tvicon.png')); ?>"  alt="livetvicon-image" >
                    <?php endif; ?>
                  <?php endif; ?>
                  </span>
                </h2>
                <div class="imdb-ratings-block">
                  <ul>
                    <?php if(isset($movie->publish_year)): ?><li><?php echo e($movie->publish_year); ?></li><?php endif; ?>
                    <?php if($movie->live !=1): ?>
                      <?php if(isset($movie->duration)): ?><li><?php echo e($movie->duration); ?> <?php echo e(__('Mins')); ?></li><?php endif; ?>
                    <?php endif; ?>
                    <?php if(isset($movie->maturity_rating)): ?><li><?php echo e($movie->maturity_rating); ?></li><?php endif; ?>
                    <?php if($movie->live != 1): ?>
                      <?php if($configs->user_rating != 1): ?>
                        <?php if(isset($movie->rating)): ?><li><?php echo e(__('Tmdb Rating')); ?> <?php echo e($movie->rating); ?></li><?php endif; ?>
                      <?php endif; ?>
                    <?php endif; ?>

                    <li><i title="views" class="fa fa-eye"></i> <?php echo e(views($movie)
                      ->unique()
                      ->count() + $movie->views); ?></li>

                      <li class="share-btn-icon">
                        <button id="share"><i title="Share" class="fa fa-share-alt" aria-hidden="true"></i></button>

                        <div class="tooltip" id="tooltip">
                          <a href="#"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                          <a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a>
                          <a href=""><i class="fa fa-telegram" aria-hidden="true"></i></a>
                          <a href=""><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                        </div>

                        <!-- <input type="checkbox" id="check">
                        <label for=""><i title="Share" class="fa fa-share-alt" aria-hidden="true"></i></label>
                        <div class="icons">
                          <a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a>
                          <a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a>
                          <a href=""><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                          <a href=""><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                        </div> -->
                        <!-- <i title="Share" class="fa fa-share-alt" aria-hidden="true"></i> -->

                      </li>
                      <?php if($configs->user_rating==1): ?>
                      <li>
                        <div class="dropdown rating-dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-star"></i> <?php echo e(__('Rate')); ?>

                          <span class="caret"></span></button>
                          <ul class="dropdown-menu">
                           
                              <?php if(auth()->guard()->check()): ?>
                             
                                <?php
                                  $uid=auth()->user()->id;
                                  $rating=App\UserRating::where('user_id',$uid)->where('movie_id',$movie->id)->first();
                                  
                                  ?>
                              <?php echo Form::open(['method' => 'POST', 'id'=>'formrating', 'action' => 'UserRatingController@store']); ?>

                              
                                <input type="text" hidden="" name="movie_id" value="<?php echo e($movie->id); ?>">
                                <input type="text" hidden="" name="user_id" value="<?php echo e($auth->id); ?>">
                                <input id="rating" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-step="0.5"  value="<?php echo e(isset($rating) ? $rating->rating: 0); ?>">
                            
                            
                              <div class="form-group">
                                <textarea class="form-control" rows="5" id="comment" name="review" placeholder="Write your review here"><?php echo e(isset($rating) ? $rating->review : ''); ?></textarea>
                              </div>
                              <button type="submit" class="btn btn-default"><?php echo e(__('Submit a Review')); ?></button>
                             
                              <?php endif; ?>
                              <?php if(auth()->guard()->guest()): ?>
                              <a href="<?php echo e(url('login')); ?>" class="btn btn-default"><?php echo e(__('Login to leave a review')); ?></a>
                              <?php endif; ?>
                              <?php echo Form::close(); ?> 
                          </ul>
                        </div>
                      </li>
                      <?php endif; ?>
                      
                  </ul>
                </div>
                

                <div id="wishlistelement" class="screen-play-btn-block ">
                
                <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                <?php if($movie->is_upcoming != 1): ?>
                  <?php if(checkInMovie($movie) == true && isset($movie->video_link)): ?>
                    <?php if($movie->maturity_rating == 'all age' || $age>=str_replace('+', '',$movie->maturity_rating)): ?>
                      <?php if(isset($movie->video_link['iframeurl']) && $movie->video_link['iframeurl'] != null): ?>
                        
                        <a href="<?php echo e(route('watchmovieiframe',$movie->id)); ?>"class="btn btn-play iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span>
                        </a>
              
                      <?php else: ?>

                        <a href="<?php echo e(route('watchmovie',$movie->id)); ?>" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span>
                          </a>
                          
                      <?php endif; ?>
                    <?php else: ?>
                      
                      <a onclick="myage(<?php echo e($age); ?>)"  class=" btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span>
                      </a>
                      
                    <?php endif; ?>
                  <?php endif; ?>
                <?php endif; ?>
                  <?php if($movie->trailer_url != null || $movie->trailer_url != ''): ?>
                    <a href="<?php echo e(route('watchTrailer',$movie->id)); ?>" class="watch-trailer-btn iframe btn btn-default"><?php echo e(__('Watch Trailer')); ?></a>
                  <?php endif; ?>
                <?php else: ?>
                   <?php if($movie->trailer_url != null || $movie->trailer_url != ''): ?>
                    <a href="<?php echo e(route('guestwatchtrailer',$movie->id)); ?>" class="watch-trailer-btn iframe btn btn-default"><?php echo e(__('Watch Trailer')); ?></a>
                  <?php endif; ?>
                <?php endif; ?>
                <?php if($catlog ==0 && getSubscription()->getData()->subscribed == true): ?>
                  <?php if(isset($wishlist_check->added)): ?>
                    <a onclick="addWish(<?php echo e($movie->id); ?>,'<?php echo e($movie->type); ?>')" class="watch-trailer-btn addwishlistbtn<?php echo e($movie->id); ?><?php echo e($movie->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')); ?></a>
                  <?php else: ?>
                    <a onclick="addWish(<?php echo e($movie->id); ?>,'<?php echo e($movie->type); ?>')" class="watch-trailer-btn addwishlistbtn<?php echo e($movie->id); ?><?php echo e($movie->type); ?> btn-default"><?php echo e(__('Add to Watchlist')); ?></a>
                  <?php endif; ?>
                <?php elseif($catlog ==1 && $auth): ?>
                  <?php if(isset($wishlist_check->added)): ?>
                    <a onclick="addWish(<?php echo e($movie->id); ?>,'<?php echo e($movie->type); ?>')" class="watch-trailer-btn addwishlistbtn<?php echo e($movie->id); ?><?php echo e($movie->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')); ?></a>
                  <?php else: ?>
                    <a onclick="addWish(<?php echo e($movie->id); ?>,'<?php echo e($movie->type); ?>')" class="watch-trailer-btn addwishlistbtn<?php echo e($movie->id); ?><?php echo e($movie->type); ?> btn-default"><?php echo e(__('Add to Watchlist')); ?></a>
                  <?php endif; ?>
                <?php endif; ?>
                 
                <?php
                 $mlc = array();
                  if(isset($movie->multilinks)){
                    foreach ($movie->multilinks as $key => $value) {
                       if($value->download == 1){
                        $mlc[] = 1;
                       }else{
                          $mlc[] = 0;
                       }
                    }
                  }
                ?>

                <?php if(isset($movie->multilinks) && count($movie->multilinks) > 0 ): ?>   
                  <?php if(Auth::user() && getSubscription()->getData()->subscribed == true): ?>
                  <?php if(in_array(1, $mlc)): ?>
                     <button type="button" class="btn btn-default watch-trailer-btn" data-toggle="collapse" data-target="#downloadmovie"><?php echo e(__('Download')); ?></button>

                    <div id="downloadmovie" class="collapse">
                      <table  class=" text-center table table-bordered table-responsive detail-multiple-link">
                        <thead>
                          <th align="center">#</th>
                          <th align="center"><?php echo e(__('Download')); ?></th>
                          <th align="center"><?php echo e(__('Quality')); ?></th>
                          <th align="center"><?php echo e(__('Size')); ?></th>
                          <th align="center"><?php echo e(__('Language')); ?></th>
                          <th align="center"><?php echo e(__('Clicks')); ?></th>
                          <th align="center"><?php echo e(__('User')); ?></th>
                          <th align="center"><?php echo e(__('Added')); ?></th>
                        </thead>
                   
                        <tbody>
                          
                         <?php $__currentLoopData = $movie->multilinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          
                            <?php if($link->download == 1): ?>
                              <tr>
                                <?php
                                  $lang = App\AudioLanguage::where('id',$link->language)->first();
                                ?>

                                <td align="center"><?php echo e($key+1); ?></td>
                                <td align="center"><a data-id="<?php echo e($link->id); ?>" class="download btn btn-sm btn-success" title="<?php echo e(__('Download')); ?>" href="<?php echo e($link->url); ?>" ><i class="fa fa-download"></i></td>
                                <td align="center"><?php echo e($link->quality); ?></td>
                                <td align="center"><?php echo e($link->size); ?></td>
                                <td align="center"><?php if(isset($lang)): ?><?php echo e($lang->language); ?><?php endif; ?></td>
                                <td><?php echo e($link->clicks); ?></td>
                                <td align="center"><?php echo e($link->movie->user->name); ?></td>
                                <td align="center"><?php echo e(date('Y-m-d',strtotime($link->created_at))); ?></td>
                                
                              </tr>

                            <?php endif; ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                        </tbody>
                        
                      </table>
                    </div>
                  <?php endif; ?>
                  <?php endif; ?>
                <?php endif; ?>
 

              </div>
                <p>
                  <?php echo e($movie->detail); ?>

                </p>
              </div>
              <div class="screen-casting-dtl">
                <ul class="casting-headers">
                  <?php if($movie->live!=1): ?>
                    <?php if(count($directors) > 0): ?>
                      <li><?php echo e(__('Directors')); ?> :
                        <span class="categories-count">
                            <?php for($i = 0; $i < count($directors); $i++): ?>
                              <?php if($i == count($directors)-1): ?>
                                <a href="<?php echo e(url('video/detail/director_search', trim($directors[$i]))); ?>"><?php echo e($directors[$i]); ?></a>
                              <?php else: ?>
                                <a href="<?php echo e(url('video/detail/director_search', trim($directors[$i]))); ?>"><?php echo e($directors[$i]); ?></a>,
                              <?php endif; ?>
                            <?php endfor; ?>
                        </span>
                      </li>
                    <?php endif; ?>
                    <?php if(count($actors) > 0): ?>
                      <li><?php echo e(__('Starring')); ?> :
                        <span class="categories-count">
                            <?php for($i = 0; $i < count($actors); $i++): ?>
                              <?php if($i == count($actors)-1): ?>
                                <a href="<?php echo e(url('video/detail/actor_search', trim($actors[$i]))); ?>"><?php echo e($actors[$i]); ?></a>
                              <?php else: ?>
                                <a href="<?php echo e(url('video/detail/actor_search', trim($actors[$i]))); ?>"><?php echo e($actors[$i]); ?></a>,
                              <?php endif; ?>
                            <?php endfor; ?>
                        </span>
                      </li>
                    <?php endif; ?>
                  <?php endif; ?>
                  <?php if(count($genres) > 0): ?>
                    <li><?php echo e(__('genres')); ?> :
                      <span class="categories-count">
                          <?php for($i = 0; $i < count($genres); $i++): ?>
                            <?php if($i == count($genres)-1): ?>
                              <a href="<?php echo e(url('video/detail/genre_search', trim($genres[$i]))); ?>"><?php echo e($genres[$i]); ?></a>
                            <?php else: ?>
                              <a href="<?php echo e(url('video/detail/genre_search', trim($genres[$i]))); ?>"><?php echo e($genres[$i]); ?></a>,
                            <?php endif; ?>
                          <?php endfor; ?>
                      </span>
                    </li>
                  <?php endif; ?>
                  <li><?php echo e(__('Uploaded By')); ?> : 
                      <span class="categories-count">
                      <?php echo e($movie->user->name); ?>

                      </span>
                  </li>
                  <?php if(count($movie->subtitles)>0): ?>
                    <li><?php echo e(__('Sub titles')); ?> : 
                      <span class="categories-count">
                          <?php $__currentLoopData = $movie->subtitles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <?php if($key == count($movie->subtitles)-1): ?>
                            <?php echo e($sub['sub_lang']); ?>

                           <?php else: ?>
                             <?php echo e($sub['sub_lang']); ?>,
                           <?php endif; ?>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                      </span>
                    </li>
                  <?php endif; ?>
                  <?php if(count($a_languages) > 0): ?>
                    <li><?php echo e(__('Audio language')); ?> : 
                      <span class="categories-count">
                          <?php if($movie->a_language != null && isset($a_languages)): ?>
                            <?php for($i = 0; $i < count($a_languages); $i++): ?>
                              <?php if($i == count($a_languages)-1): ?>
                                <?php echo e($a_languages[$i]); ?>

                              <?php else: ?>
                                <?php echo e($a_languages[$i]); ?>,
                              <?php endif; ?>
                            <?php endfor; ?>
                          <?php endif; ?>
                      </span>
                    </li>
                  <?php endif; ?>
                </ul>
               
              </div>
              
            </div>
  
            <?php if($button->remove_thumbnail == 0): ?>
           
            <div class="col-md-4">
              <div class="poster-thumbnail-block home-prime-slider">
              
                <?php if($movie->thumbnail != null || $movie->thumbnail != ''): ?>
                  <img data-src="<?php echo e(url('images/movies/thumbnails/'.$movie->thumbnail)); ?>" class="img-responsive lazy" alt="genre-image">
                <?php else: ?>
                  <img data-src="<?php echo e(url('images/default-thumbnail.jpg')); ?>" class="img-responsive lazy" alt="genre-image">
                <?php endif; ?>
               
              </div>
            </div>
            <?php endif; ?>
          </div>

        </div>

        <?php elseif(isset($season)): ?>
          <?php
           
            $a_languages = collect();
            if ($season->a_language != null) {
              $a_lan_list = explode(',', $season->a_language);
              for($i = 0; $i < count($a_lan_list); $i++) {
                try {
                  $a_language = App\AudioLanguage::find($a_lan_list[$i])->language;
                  $a_languages->push($a_language);
                } catch (Exception $e) {
                }
              }
            }
             if(isset($auth)){
            $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                          ['user_id', '=', $auth->id],
                                                                          ['season_id', '=', $season->id],
                                                                         ])->first();
                                                                       }
            // Actors list of movie from model
            $actors = collect();
            if ($season->actor_id != null) {
              $p_actors_list = explode(',', $season->actor_id);
              for($i = 0; $i < count($p_actors_list); $i++) {
                try {
                  $p_actor = App\Actor::find(trim($p_actors_list[$i]))->name;
                  $actors->push($p_actor);
                } catch (Exception $e) {
                }
              }
            }

            // Genre list of movie from model
            $genres = collect();
            if ($season->tvseries->genre_id != null){
              $genre_list = explode(',', $season->tvseries->genre_id);
              for ($i = 0; $i < count($genre_list); $i++) {
                try {
                  $genre = App\Genre::find($genre_list[$i])->name;
                  $genres->push($genre);
                } catch (Exception $e) {
                }
              }
            }
          ?>
          <div class="row">
            <div class="col-md-8">
              <div class="full-movie-dtl-block">
                <h2 class="section-heading"><?php echo e($season->tvseries->title); ?></h2>
                 <br/>
                <select style="border-radius:8px!important;width:20%;-webkit-box-shadow: none;box-shadow: none;color: #FFF;background: rgba(17, 17, 17, 0.5);display: block;clear: both;border: 1px solid rgba(17, 17, 17, 0.5);border-radius: 0;" name="" id="selectseason" class="form-control">
                  <?php $__currentLoopData = $season->tvseries->seasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allseason): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <option <?php echo e($season->season_slug == $allseason->season_slug ? "selected" : ""); ?> value="<?php echo e($allseason->season_slug); ?>"><?php echo e(__('Season')); ?> <?php echo e($allseason->season_no); ?></option>
                  
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <br>
                <div class="imdb-ratings-block">
                  <ul>
                    <?php if(isset($season->publish_year)): ?><li><?php echo e($season->publish_year); ?></li><?php endif; ?>
                    <?php if(isset($season->season_no)): ?><li><?php echo e($season->season_no); ?> <?php echo e(__('Season')); ?></li><?php endif; ?>
                    <?php if(isset($season->tvseries->age_req)): ?><li><?php echo e($season->tvseries->age_req); ?></li><?php endif; ?>
                    <?php if($configs->user_rating != 1): ?>
                      <?php if(isset($season->tvseries->rating)): ?><li><?php echo e(__('Tmdb Rating')); ?> <?php echo e($season->tvseries->rating); ?></li><?php endif; ?>
                    <?php endif; ?>
                    <li><i title="views" class="fa fa-eye"></i> <?php echo e(views($season)
                        ->unique()
                        ->count() + $season->views); ?></li>
                    <?php if($configs->user_rating==1): ?>
                    <li>
                      <div class="dropdown rating-dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-star"></i> <?php echo e(__('Rate')); ?>

                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                         
                            <?php if(auth()->guard()->check()): ?>
                           
                              <?php
                                $uid=auth()->user()->id;
                                $rating=App\UserRating::where('user_id',$uid)->where('tv_id',$season->tvseries->id)->first();
                                $avg_rating=App\UserRating::where('tv_id',$season->tvseries->id)->avg('rating');
                                ?>
                             <?php echo Form::open(['method' => 'POST', 'id'=>'formratingtv', 'action' => 'UserRatingController@store']); ?>

                             <input type="text" hidden="" name="tv_id" 
                             value="<?php echo e($season->tvseries->id); ?>">
                               <input type="text" hidden="" name="user_id" value="<?php echo e($auth->id); ?>">
                             <input id="rating" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1"  
                             value="<?php echo e(isset($rating)? $rating->rating: 2); ?>">
                          
                          
                            <div class="form-group">
                              <textarea class="form-control" rows="5" id="comment" name="review" placeholder="Write your review here"><?php echo e(isset($rating) ? $rating->review : ''); ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-default"><?php echo e(__('Submit a review')); ?></button>
                          
                            <?php endif; ?>
                            <?php if(auth()->guard()->guest()): ?>
                            <a href="<?php echo e(url('login')); ?>" class="btn btn-default"><?php echo e(__('Login to leave a review')); ?></a>
                            <?php endif; ?>
                            <?php echo Form::close(); ?> 
                        </ul>
                      </div>
                    </li>
                    <?php endif; ?>
                  </ul>
                </div>
                   

                 <div class="screen-play-btn-block movie-single-play-btn">
                <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                  <?php if(isset($season->episodes[0]) && checkInTvseries($season->tvseries) == true && isset($season->episodes[0]->video_link)): ?>
                    <?php if($season->tvseries->age_req =='all age' || $age>=str_replace('+', '',$season->tvseries->age_req)): ?>
                      <?php if($season->episodes[0]->video_link['iframeurl'] !=""): ?>
                       
                        <a href="#" onclick="playoniframe('<?php echo e($season->episodes[0]->video_link['iframeurl']); ?>','<?php echo e($season->tvseries->id); ?>','tv')" class="btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span>
                        </a>
                      <?php else: ?>
                        <a href="<?php echo e(route('watchTvShow',$season->id)); ?>" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span></a>
                      <?php endif; ?>
                    <?php else: ?>
                      <a  onclick="myage(<?php echo e($age); ?>)" class="btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span></a>
                    <?php endif; ?>
                  <?php endif; ?>
                   <?php if($season->trailer_url != null || $season->trailer_url != ''): ?>
                    <a href="<?php echo e(route('watchtvTrailer',$season->id)); ?>" class="watch-trailer-btn iframe btn btn-default"><?php echo e(__('Watch Trailer')); ?></a>
                  <?php endif; ?>
                <?php else: ?>
                   <?php if($season->trailer_url != null || $season->trailer_url != ''): ?>
                    <a href="<?php echo e(route('guestwatchtvtrailer',$season->id)); ?>" class="watch-trailer-btn iframe btn btn-default"><?php echo e(__('Watch Trailer')); ?></a>
                  <?php endif; ?>
                <?php endif; ?>
                <?php if($catlog == 0 && getSubscription()->getData()->subscribed == true): ?>
                  <?php if(isset($wishlist_check->added)): ?>
                    <a onclick="addWish(<?php echo e($season->id); ?>,'<?php echo e($season->type); ?>')" class="watch-trailer-btn addwishlistbtn<?php echo e($season->id); ?><?php echo e($season->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')); ?></a>
                  <?php else: ?>
                    <a onclick="addWish(<?php echo e($season->id); ?>,'<?php echo e($season->type); ?>')" class="watch-trailer-btn addwishlistbtn<?php echo e($season->id); ?><?php echo e($season->type); ?> btn-default"><?php echo e(__('Add to Watchlist')); ?></a>
                  <?php endif; ?>
                <?php elseif($catlog ==1 && $auth): ?>
                  <?php if(isset($wishlist_check->added)): ?>
                    <a onclick="addWish(<?php echo e($season->id); ?>,'<?php echo e($season->type); ?>')" class="watch-trailer-btn addwishlistbtn<?php echo e($season->id); ?><?php echo e($season->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')); ?></a>
                  <?php else: ?>
                    <a onclick="addWish(<?php echo e($season->id); ?>,'<?php echo e($season->type); ?>')" class="watch-trailer-btn addwishlistbtn<?php echo e($season->id); ?><?php echo e($season->type); ?> btn-default"><?php echo e(__('Add to Watchlist')); ?></a>
                  <?php endif; ?>
                <?php endif; ?>
              </div>
                <p>
                  <?php if($season->detail != null || $season->detail != ''): ?>
                    <?php echo e($season->detail); ?>

                  <?php else: ?>
                    <?php echo e($season->tvseries->detail); ?>

                  <?php endif; ?>
                </p>
              </div>
              <div class="screen-casting-dtl">
                <ul class="casting-headers">
                  <?php if(count($actors) > 0): ?>
                    <li><?php echo e(__('Starring')); ?> : 
                      <span class="categories-count">
                        <?php for($i = 0; $i < count($actors); $i++): ?>
                          <?php if($i == count($actors)-1): ?>
                            <a href="<?php echo e(url('video/detail/actor_search', trim($actors[$i]))); ?>"><?php echo e($actors[$i]); ?></a>
                          <?php else: ?>
                            <a href="<?php echo e(url('video/detail/actor_search', trim($actors[$i]))); ?>"><?php echo e($actors[$i]); ?></a>,
                          <?php endif; ?>
                        <?php endfor; ?>
                      </span>
                    </li>
                  <?php endif; ?>
                  <?php if(count($genres) > 0): ?>
                    <li><?php echo e(__('genres')); ?> : 
                       <span class="categories-count">
                          <?php for($i = 0; $i < count($genres); $i++): ?>
                            <?php if($i == count($genres)-1): ?>
                              <a href="<?php echo e(url('video/detail/genre_search', trim($genres[$i]))); ?>"><?php echo e($genres[$i]); ?></a>
                            <?php else: ?>
                              <a href="<?php echo e(url('video/detail/genre_search', trim($genres[$i]))); ?>"><?php echo e($genres[$i]); ?></a>,
                            <?php endif; ?>
                          <?php endfor; ?>
                       </span>
                    </li>
                  <?php endif; ?>
                  <li><?php echo e(__('Uploaded By')); ?> : 
                      <span class="categories-count">
                      <?php echo e($season->tvseries->user->name); ?>

                      </span>
                  </li>
                  <?php if(count($season->episodes)>0): ?>
                    <?php
                      $subtitles = collect();
                      foreach ($season->episodes as $e) {
                          foreach ($e->subtitles as $sub) {
                              $subtitles->push($sub->sub_lang);
                          }
                      }

                      $subtitles = $subtitles->unique();
                    ?>
                    <?php if(count($subtitles)>0): ?>
                      <li><?php echo e(__('subtitles')); ?> : 
                        <span class="categories-count">
                          <?php $__currentLoopData = $subtitles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($key == count($subtitles)-1): ?>
                                    <?php echo e($sub); ?>

                            <?php else: ?>
                                      <?php echo e($sub); ?>,
                            <?php endif; ?>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </span>
                      </li>
                    <?php endif; ?>
                  <?php endif; ?>
                  <?php if($season->a_language != null && isset($a_languages)): ?>
                    <li><?php echo e(__('audiolanguage')); ?> : 
                     <span class="categories-count">
                        <?php for($i = 0; $i < count($a_languages); $i++): ?>
                          <?php if($i == count($a_languages)-1): ?>
                            <?php echo e($a_languages[$i]); ?>

                          <?php else: ?>
                            <?php echo e($a_languages[$i]); ?>,
                          <?php endif; ?>
                        <?php endfor; ?>
                      </span>
                   </li>
                  <?php endif; ?>
                </ul>
                
              </div>
              
            </div>
            <?php if($button->remove_thumbnail == 0): ?>
             
            <div class="col-md-4">
              <div class="poster-thumbnail-block home-prime-slider">
             
                <?php if($season->thumbnail != null): ?>
                  <img data-src="<?php echo e(url('images/tvseries/thumbnails/'.$season->thumbnail)); ?>" class="img-responsive lazy" alt="genre-image">
                <?php elseif($season->tvseries->thumbnail != null): ?>
                  <img data-src="<?php echo e(url('images/tvseries/thumbnails/'.$season->tvseries->thumbnail)); ?>" class="img-responsive lazy" alt="genre-image">
                <?php else: ?>
                  <img data-src="<?php echo e(url('images/default-thumbnail.jpg')); ?>" class="img-responsive lazy" alt="genre-image">
                <?php endif; ?>
               
              </div>
            </div>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>


    <?php if(isset($actors) && count($actors) > 0): ?>
    <div class="genre-prime-block movie-series-section search-section starring-section">
      <div class="container-fluid">
        <h5 class="section-heading"><?php echo e(__('Starring')); ?> </h5>
        <div class="genre-prime-slide owls-item">
          <ul>
             <?php $__currentLoopData = $actors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $actor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if(isset($actor) && $actor != NULL): ?>
                <?php
                  $actor_detail = App\Actor::where('name','LIKE', "%$actor%")->first()
                   
                ?>
                <?php if(isset($actor_detail) && $actor_detail != NULL): ?> 
                  <li>
                    <div class="genre-slide-image actor_detail">
                      <a href="<?php echo e(url('video/detail/actor_search',$actor_detail->slug)); ?>">
                        <?php
                          if(isset($actor_detail) && $actor_detail->image != NULL){
                            $content = @file_get_contents(public_path() . '/images/actors/' . $actor_detail->image);
                          }
                        ?>
                       
                        <?php if(isset($content) && $content != false): ?>
                          <img src="<?php echo e(url('/images/actors/' . $actor_detail->image)); ?>" class="img-fluid" alt="<?php echo e($actor_detail->name); ?>">
                        <?php else: ?>
                          <img src="<?php echo e(Avatar::create($actor_detail->name)->toBase64()); ?>" class="img-fluid" alt="">
                        <?php endif; ?>
                        
                      </a>
                    </div>
                  </li>
                <?php endif; ?>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         
            
           
          </ul>  
        </div>
       
      </div>
    </div>
    <?php endif; ?>

    <!-- movie series -->
    <?php if(isset($movie->movie_series) && $movie->series != 1): ?>
      <?php if(count($movie->movie_series) > 0): ?>
        <div class="container-fluid movie-series-section search-section">
          <h5 class="movie-series-heading">Series <?php echo e(count($movie->movie_series)); ?></h5>
          <div>
            <?php $__currentLoopData = $movie->movie_series; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $series): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $single_series = \App\Movie::where('id', $series->series_movie_id)->first();
                 if(isset($auth)){
                    $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                        ['user_id', '=', $auth->id],
                        ['movie_id', '=', $single_series->id],
                      ])->first();
                    }
                  
                
               
              ?>
              <div class="movie-series-block movie-section">
                <div class="row">
                  <div class="col-lg-2">
                    <div class="movie-series-img home-prime-slider">
                     
                      <?php if($single_series->thumbnail != null || $single_series->thumbnail != ''): ?>
                        <img src="<?php echo e(url('images/movies/thumbnails/'.$single_series->thumbnail)); ?>" class="img-responsive lazy" alt="movie-image">
                      <?php else: ?>
                        <img data-src="<?php echo e(url('images/default-thumbnail.jpg')); ?>" class="img-responsive lazy" alt="movie-image">
                      <?php endif; ?>
                     
                    
                    </div>
                  </div>
                  <div class="col-lg-10">
                    <div class="movie-series-section">
                      <div class="row">
                        <div class="col-lg-8"> 
                          <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                          <h5 class="movie-series-heading movie-series-name"><a href="<?php echo e(url('movie/detail', $single_series->slug)); ?>"><?php echo e($single_series->title); ?></a></h5>
                          <?php else: ?>
                             <h5 class="movie-series-heading movie-series-name"><a href="<?php echo e(url('movie/guest/detail', $single_series->slug)); ?>"><?php echo e($single_series->title); ?></a></h5>
                          <?php endif; ?>
                        </div>
                        <div class="col-lg-4">
                          <ul class="movie-series-des-list movie-series-des-list-two">
                            <li><?php echo e($single_series->duration); ?> <?php echo e(__('Mins')); ?></li>
                          </ul>
                        </div>
                      </div>
                      <p>
                        <?php echo e(str_limit($single_series->detail,360)); ?>

                      </p>

                      <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                        <a href="<?php echo e(url('movie/detail', $single_series->slug)); ?>"><?php echo e(__('Read More')); ?></a>
                      <?php else: ?>
                        <a href="<?php echo e(url('movie/guest/detail', $single_series->slug)); ?>"><?php echo e(__('Read More')); ?></a>
                      <?php endif; ?>
                       
                      <div class="des-btn-block des-in-list">
                        <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                          <?php if($single_series->is_upcoming != 1): ?>
                            <?php if(checkInMovie($single_series) == true && isset($single_series->video_link)): ?>
                              <?php if($single_series->maturity_rating == 'all age' || $age>=str_replace('+', '',$single_series->maturity_rating)): ?>
                                <?php if(isset($single_series->video_link['iframeurl']) && $single_series->video_link['iframeurl'] != null): ?>
                                  
                                  <a href="<?php echo e(route('watchmovieiframe',$single_series->id)); ?>"class="btn btn-play iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span>
                                  </a>
                        
                                <?php else: ?>

                                  <a href="<?php echo e(route('watchmovie',$single_series->id)); ?>" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span>
                                    </a>
                                    
                                <?php endif; ?>
                              <?php else: ?>

                                <a onclick="myage(<?php echo e($age); ?>)"  class=" btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span>
                                </a>
                                
                              <?php endif; ?>
                            <?php endif; ?>
                          <?php endif; ?>
                          <?php if($single_series->trailer_url != null || $single_series->trailer_url != ''): ?>
                            <a href="<?php echo e(route('watchTrailer',$single_series->id)); ?>" class="iframe btn btn-default"><?php echo e(__('Watch Trailer')); ?></a>
                          <?php endif; ?>
                        <?php else: ?>
                           <?php if($single_series->trailer_url != null || $single_series->trailer_url != ''): ?>
                            <a href="<?php echo e(route('guestwatchtrailer',$single_series->id)); ?>" class="iframe btn btn-default"><?php echo e(__('Watch Trailer')); ?></a>
                          <?php endif; ?>
                        <?php endif; ?>
                        <?php if($catlog ==0 && getSubscription()->getData()->subscribed == true): ?>
                          <?php if(isset($wishlist_check->added)): ?>
                            <a onclick="addWish(<?php echo e($single_series->id); ?>,'<?php echo e($single_series->type); ?>')" class="watch-trailer-btn addwishlistbtn<?php echo e($single_series->id); ?><?php echo e($single_series->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')); ?></a>
                          <?php else: ?>
                            <a onclick="addWish(<?php echo e($single_series->id); ?>,'<?php echo e($single_series->type); ?>')" class="watch-trailer-btn addwishlistbtn<?php echo e($single_series->id); ?><?php echo e($single_series->type); ?> btn-default"><?php echo e(__('Add to Watchlist')); ?></a>
                          <?php endif; ?>
                        <?php elseif($catlog ==1 && $auth): ?>
                          <?php if(isset($wishlist_check->added)): ?>
                            <a onclick="addWish(<?php echo e($single_series->id); ?>,'<?php echo e($single_series->type); ?>')" class="watch-trailer-btn addwishlistbtn<?php echo e($single_series->id); ?><?php echo e($single_series->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')); ?></a>
                          <?php else: ?>
                            <a onclick="addWish(<?php echo e($single_series->id); ?>,'<?php echo e($single_series->type); ?>')" class="watch-trailer-btn addwishlistbtn<?php echo e($single_series->id); ?><?php echo e($single_series->type); ?> btn-default"><?php echo e(__('Add to Watchlist')); ?></a>
                          <?php endif; ?>
                        <?php endif; ?>
                         
                        <?php
                         $mlc = array();
                          if(isset($single_series->multilinks)){
                            foreach ($single_series->multilinks as $key => $value) {
                               if($value->download == 1){
                                $mlc[] = 1;
                               }else{
                                  $mlc[] = 0;
                               }
                            }
                          }
                        ?>

                        <?php if(isset($single_series->multilinks) && count($single_series->multilinks) > 0 ): ?>   
                          <?php if(Auth::user() && getSubscription()->getData()->subscribed == true): ?>
                            <?php if(in_array(1, $mlc)): ?>
                               <button type="button" class="btn btn-sm btn-default watch-trailer-btn download-btn" data-toggle="collapse" data-target="#downloadmovie<?php echo e($single_series->id); ?>"><?php echo e(__('download')); ?></button>

                              <div id="downloadmovie<?php echo e($single_series->id); ?>" class="collapse">
                                <table  class=" text-center table table-bordered table-responsive detail-multiple-link">
                                  <thead>
                                    <th align="center">#</th>
                                    <th align="center"><?php echo e(__('Download')); ?></th>
                                    <th align="center"><?php echo e(__('Quality')); ?></th>
                                    <th align="center"><?php echo e(__('Size')); ?></th>
                                    <th align="center"><?php echo e(__('Language')); ?></th>
                                    <th align="center"><?php echo e(__('Clicks')); ?></th>
                                    <th align="center"><?php echo e(__('User')); ?></th>
                                    <th align="center"><?php echo e(__('Added')); ?></th>
                                  </thead>
                             
                                  <tbody>
                                    
                                   <?php $__currentLoopData = $single_series->multilinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    
                                      <?php if($link->download == 1): ?>
                                        <tr>
                                          <?php
                                            $lang = App\AudioLanguage::where('id',$link->language)->first();
                                          ?>

                                          <td align="center"><?php echo e($key+1); ?></td>
                                          <td align="center"><a data-id="<?php echo e($link->id); ?>" class="download btn btn-sm btn-success" title="<?php echo e(__('Download')); ?>" href="<?php echo e($link->url); ?>" ><i class="fa fa-download"></i></td>
                                          <td align="center"><?php echo e($link->quality); ?></td>
                                          <td align="center"><?php echo e($link->size); ?></td>
                                          <td align="center"><?php if(isset($lang)): ?><?php echo e($lang->language); ?><?php endif; ?></td>
                                          <td><?php echo e($link->clicks); ?></td>
                                          <td align="center"><?php echo e($link->movie->user->name); ?></td>
                                          <td align="center"><?php echo e(date('Y-m-d',strtotime($link->created_at))); ?></td>
                                        </tr>
                                      <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </tbody>
                                  
                                </table>
                              </div>
                            <?php endif; ?>
                          <?php endif; ?>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
      <?php endif; ?>
    <?php endif; ?>
    <?php if(isset($filter_series) && $movie->series == 1): ?>
      <?php if(count($filter_series) > 0): ?>
        <div class="container-fluid movie-series-section search-section">
          <h5 class="movie-series-heading"><?php echo e(__('Series')); ?> <?php echo e(count($filter_series)); ?></h5>
          <div>
            <?php $__currentLoopData = $filter_series; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $series): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
               if(isset($auth)){
                $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                    ['user_id', '=', $auth->id],
                    ['movie_id', '=', $series->id],
                   ])->first();
                 }
                
              ?>
              <div class="movie-series-block movie-section">
              
                <div class="row">
                  <div class="col-lg-2">
                    <div class="movie-series-img home-prime-slider">
                      <?php if($series->thumbnail != null): ?>
                        <img src="<?php echo e(url('images/movies/thumbnails/'.$series->thumbnail)); ?>" class="img-responsive lazy" alt="movie-image">
                      <?php else: ?>
                        <img data-src="<?php echo e(url('images/default-thumbnail.jpg')); ?>" class="img-responsive lazy" alt="movie-image">
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-lg-10">
                    <div class="movie-series-section">
                      <div class="row">
                        <div class="col-lg-8"> 
                          <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                          <h5 class="movie-series-heading movie-series-name"><a href="<?php echo e(url('movie/detail', $series->slug)); ?>"><?php echo e($series->title); ?></a></h5>
                          <?php else: ?>
                            <h5 class="movie-series-heading movie-series-name"><a href="<?php echo e(url('movie/guest/detail', $series->slug)); ?>"><?php echo e($series->title); ?></a></h5>
                          <?php endif; ?>
                        </div>
                        <div class="col-lg-4">
                          <ul class="movie-series-des-list movie-series-des-list-two">
                            <li><?php echo e($series->duration); ?> <?php echo e(__('Mins')); ?></li>
                          </ul>
                        </div>
                      </div>
                      <p>
                        <?php echo e(str_limit($series->detail,360)); ?>


                      </p>
                      <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                          <a href="<?php echo e(url('movie/detail', $series->slug)); ?>"><?php echo e(__('Read More')); ?></a>
                        <?php else: ?>
                          <a href="<?php echo e(url('movie/guest/detail', $series->slug)); ?>"><?php echo e(__('Read More')); ?></a>
                        <?php endif; ?>
                      <div class="des-btn-block des-in-list">
                        <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                        <?php if($series->is_upcoming != 1): ?>
                          <?php if(checkInMovie($series) == true && isset($series->video_link)): ?>
                            <?php if($series->maturity_rating == 'all age' || $age>=str_replace('+', '',$series->maturity_rating)): ?>
                              <?php if(isset($series->video_link['iframeurl']) && $series->video_link['iframeurl'] != null): ?>
                                
                                <a href="<?php echo e(route('watchmovieiframe',$series->id)); ?>"class="btn btn-play iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span>
                                </a>
                      
                              <?php else: ?>

                                <a href="<?php echo e(route('watchmovie',$series->id)); ?>" class="iframe watch-trailer-btn btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span>
                                  </a>
                                  
                              <?php endif; ?>
                            <?php else: ?>

                              <a onclick="myage(<?php echo e($age); ?>)"  class=" btn btn-play "><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span>
                              </a>
                              
                            <?php endif; ?>
                          <?php endif; ?>
                        <?php endif; ?>
                          <?php if($series->trailer_url != null || $series->trailer_url != ''): ?>
                            <a href="<?php echo e(route('watchTrailer',$series->id)); ?>" class="watch-trailer-btn iframe btn btn-default"><?php echo e(__('Watch Trailer')); ?></a>
                          <?php endif; ?>
                        <?php else: ?>
                           <?php if($series->trailer_url != null || $series->trailer_url != ''): ?>
                            <a href="<?php echo e(route('guestwatchtrailer',$series->id)); ?>" class="watch-trailer-btn iframe btn btn-default"><?php echo e(__('Watch Trailer')); ?></a>
                          <?php endif; ?>
                        <?php endif; ?>
                        <?php if($catlog ==0 && getSubscription()->getData()->subscribed == true): ?>
                          <?php if(isset($wishlist_check->added)): ?>
                            <a onclick="addWish(<?php echo e($series->id); ?>,'<?php echo e($series->type); ?>')" class="watch-trailer-btn addwishlistbtn<?php echo e($series->id); ?><?php echo e($series->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')); ?></a>
                          <?php else: ?>
                            <a onclick="addWish(<?php echo e($series->id); ?>,'<?php echo e($series->type); ?>')" class="watch-trailer-btn addwishlistbtn<?php echo e($series->id); ?><?php echo e($series->type); ?> btn-default"><?php echo e(__('Add to Watchlist')); ?></a>
                          <?php endif; ?>
                        <?php elseif($catlog ==1 && $auth): ?>
                          <?php if(isset($wishlist_check->added)): ?>
                            <a onclick="addWish(<?php echo e($series->id); ?>,'<?php echo e($series->type); ?>')" class="watch-trailer-btn addwishlistbtn<?php echo e($series->id); ?><?php echo e($series->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')); ?></a>
                          <?php else: ?>
                            <a onclick="addWish(<?php echo e($series->id); ?>,'<?php echo e($series->type); ?>')" class="watch-trailer-btn addwishlistbtn<?php echo e($series->id); ?><?php echo e($series->type); ?> btn-default"><?php echo e(__('Add to Watchlist')); ?></a>
                          <?php endif; ?>
                        <?php endif; ?>
                         
                        <?php
                         $mlc = array();
                          if(isset($series->multilinks)){
                            foreach ($series->multilinks as $key => $value) {
                               if($value->download == 1){
                                $mlc[] = 1;
                               }else{
                                  $mlc[] = 0;
                               }
                            }
                          }
                        ?>

                        <?php if(isset($series->multilinks) && count($series->multilinks) > 0 ): ?>   
                          <?php if(Auth::user() && getSubscription()->getData()->subscribed == true): ?>
                            <?php if(in_array(1, $mlc)): ?>
                               <button type="button" class="btn btn-sm btn-default download-btn watch-trailer-btn" data-toggle="collapse" data-target="#downloadmovie<?php echo e($series->id); ?>"><?php echo e(__('download')); ?></button>

                              <div id="downloadmovie<?php echo e($series->id); ?>" class="collapse">
                                <table  class=" text-center table table-bordered table-responsive detail-multiple-link">
                                  <thead>
                                    <th align="center">#</th>
                                    <th align="center"><?php echo e(__('Download')); ?></th>
                                    <th align="center"><?php echo e(__('Quality')); ?></th>
                                    <th align="center"><?php echo e(__('Size')); ?></th>
                                    <th align="center"><?php echo e(__('Language')); ?></th>
                                    <th align="center"><?php echo e(__('Clicks')); ?></th>
                                    <th align="center"><?php echo e(__('User')); ?></th>
                                    <th align="center"><?php echo e(__('Added')); ?></th>
                                  </thead>
                             
                                  <tbody>
                                    
                                   <?php $__currentLoopData = $series->multilinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    
                                      <?php if($link->download == 1): ?>
                                        <tr>

                                          <?php
                                        
                                            $lang = App\AudioLanguage::where('id',$link->language)->first();
                                          ?>

                                          <td align="center"><?php echo e($key+1); ?></td>
                                          <td align="center"><a data-id="<?php echo e($link->id); ?>" class="download btn btn-sm btn-success" title="<?php echo e(__('Download')); ?>" href="<?php echo e($link->url); ?>" ><i class="fa fa-download"></i></td>
                                          <td align="center"><?php echo e($link->quality); ?></td>
                                          <td align="center"><?php echo e($link->size); ?></td>
                                          <td align="center"><?php if(isset($lang)): ?><?php echo e($lang->language); ?><?php endif; ?></td>
                                          <td><?php echo e($link->clicks); ?></td>
                                          <td align="center"><?php echo e($link->movie->user->name); ?></td>
                                          <td align="center"><?php echo e(date('Y-m-d',strtotime($link->created_at))); ?></td>
                                         
                                          
                                        </tr>

                                      <?php endif; ?>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  
                                  </tbody>
                                  
                                </table>
                              </div>
                            <?php endif; ?>
                          <?php endif; ?>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
      <?php endif; ?>
    <?php endif; ?>
    <!-- end movie series -->


<br/>
<br/>
  
   <!-- episodes -->
    <?php if(isset($season->episodes)): ?>
      <?php if(count($season->episodes) > 0): ?>
        <div class="container-fluid movie-series-section search-section">
          <h5 class="movie-series-heading"><?php echo e(__('Episodes')); ?> <?php echo e(count($season->episodes)); ?></h5>
          <div>
            <?php $__currentLoopData = $season->episodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $episode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           
              <div class="movie-series-block movie-section">
                <div class="row">
                  <div class="col-lg-2">
                    <div class="movie-series-img home-prime-slider">
                     
                      <?php if($episode->thumbnail != null): ?>
                        <img data-src="<?php echo e(url('images/tvseries/episodes/'.$episode->thumbnail)); ?>" class="img-responsive lazy" alt="genre-image">
                      <?php elseif($episode->thumbnail != null): ?>
                        <img data-src="<?php echo e(url('images/tvseries/episodes/'.$episode->thumbnail)); ?>" class="img-responsive lazy" alt="genre-image">
                      <?php else: ?>
                        <img data-src="<?php echo e(url('images/default-thumbnail.jpg')); ?>" class="img-responsive lazy" alt="genre-image">
                      <?php endif; ?>
                    
                    </div>
                  </div>
                    
                  <div class="col-lg-10">
                    <div class="movie-series-section">
                      <div class="row">
                        <div class="col-lg-8"> 
                          <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                            <?php if(checkInTvseries($episode->seasons->tvseries) == true && isset($episode->video_link)): ?>
                              <?php if($episode->seasons->tvseries->maturity_rating =='all age' || $age>=str_replace('+', '',$episode->seasons->tvseries->maturity_rating)): ?>
                                <?php if(isset($episode->video_link['iframeurl']) && $episode->video_link['iframeurl'] !=""): ?>
                                  <a onclick="playoniframe('<?php echo e($episode->video_link['iframeurl']); ?>','<?php echo e($episode->seasons->tvseries->id); ?>','tv')" class="btn btn-play btn-sm-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><h5 class="movie-series-heading movie-series-name"><?php echo e($key+1); ?>. <?php echo e($episode->title); ?></h5></span></a>
                                <?php else: ?>
                                  <a href="<?php echo e(route('watch.Episode', $episode->id)); ?>" class="iframe watch-trailer-btn btn btn-play btn-sm-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><h5 class="movie-series-heading movie-series-name"><?php echo e($key+1); ?>. <?php echo e($episode->title); ?></h5></span></a>
                                <?php endif; ?>
                              <?php else: ?>
                                <a onclick="myage(<?php echo e($age); ?>)" class="btn btn-play btn-sm-play watch-trailer-btn"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><h5 class="movie-series-heading movie-series-name"><?php echo e($key+1); ?>. <?php echo e($episode->title); ?></h5></span></a>
                              <?php endif; ?>
                            <?php else: ?>
                              <h5 class="movie-series-heading movie-series-name"><?php echo e($key+1); ?>. <?php echo e($episode->title); ?></h5>
                            <?php endif; ?>
                          <?php else: ?>
                            <h5 class="movie-series-heading movie-series-name"><?php echo e($key+1); ?>. <?php echo e($episode->title); ?></h5>
                          <?php endif; ?>
                        </div>
                        <?php if(isset($episode->duration) && $episode->duration > 0): ?>
                        <div class="col-lg-4">
                          <ul class="movie-series-des-list">
                            <li><?php echo e($episode->duration); ?><?php echo e(__('Mins')); ?></li>
                          </ul>
                        </div>
                        <?php endif; ?>
                      </div>
                      <?php
                        $a_languages = collect();
                        if ($episode->a_language != null) {
                          $a_lan_list = explode(',', $episode->a_language);
                          for($i = 0; $i < count($a_lan_list); $i++) {
                            try {
                              $a_language = App\AudioLanguage::find($a_lan_list[$i])->language;
                              $a_languages->push($a_language);
                            } catch (Exception $e) {
                            }
                          }
                        }
                      ?>
                      <p>
                        <?php echo e(str_limit($episode->detail, 480)); ?> 
                       
                      </p>
                      <?php
                         $elc = array();
                        if(isset($episode->multilinks)){
                          foreach ($episode->multilinks as $key => $value) {
                             if($value->download == 1){
                              $elc[] = 1;
                             }else{
                                $elc[] = 0;
                             }
                          }
                        }
                      ?>
                      <?php if(isset($episode->multilinks) &&  count($episode->multilinks) >0): ?>
                        <?php if(Auth::user() && getSubscription()->getData()->subscribed == true): ?>
                          <?php if(in_array(1, $elc)): ?>

                            <button type="button" class="btn btn-default download-btn watch-trailer-btn" data-toggle="collapse" data-target="#downloadtvseries<?php echo e($episode->id); ?>"><?php echo e(__('download')); ?></button>

                            <div id="downloadtvseries<?php echo e($episode->id); ?>" class="collapse">
                              <br/>
                              <table   class=" text-center table table-bordered table-responsive detail-multiple-link">
                                <thead>
                                  <th align="center">#</th>
                                  <th align="center"><?php echo e(__('Download')); ?></th>
                                  <th align="center"><?php echo e(__('Quality')); ?></th>
                                  <th align="center"><?php echo e(__('Size')); ?></th>
                                  <th align="center"><?php echo e(__('Language')); ?></th>
                                  <th align="center"><?php echo e(__('Clicks')); ?></th>
                                  <th align="center"><?php echo e(__('User')); ?></th>
                                  <th align="center"><?php echo e(__('Added')); ?></th>
                                </thead>
                           
                                <tbody>
                                  <?php $__currentLoopData = $episode->multilinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($link->download == 1): ?>
                                      <tr>
                                        <?php
                                          $lang = App\AudioLanguage::where('id',$link->language)->first();
                                        ?>

                                        <td align="center"><?php echo e($key+1); ?></td>
                                        <td align="center"><a data-id="<?php echo e($link->id); ?>" class="download btn btn-sm btn-success" title="download" href="<?php echo e($link->url); ?>" ><i class="fa fa-download"></i></td>
                                        <td align="center"><?php echo e($link->quality); ?></td>
                                        <td align="center"><?php echo e($link->size); ?></td>
                                        <td align="center"><?php if(isset($lang)): ?><?php echo e($lang->language); ?><?php endif; ?></td>
                                        <td><?php echo e($link->clicks); ?></td>
                                        <td align="center"><?php echo e($link->episode->seasons->tvseries->user->name); ?></td>
                                        <td align="center"><?php echo e(date('Y-m-d',strtotime($link->created_at))); ?></td>
                                      </tr>
                                    <?php endif; ?>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                              </table>
                            </div>
                          <?php endif; ?>
                        <?php endif; ?>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
      
      <?php endif; ?>
    <?php endif; ?>
    <!-- end episode -->




   
<br/>



<?php if(isset($movie)): ?>
  <?php if($configs->comments == 1 || $configs->user_rating == 1): ?>
    
    <div class="container-fluid movie-series-section comment-nav-tabs">
       <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist" >
        <?php if($configs->comments == 1): ?>
          <li role="presentation" class="active"><a href="#showcomment" aria-controls="showcomment" role="tab" data-toggle="tab" style="z-index:999;"><?php echo e(__('Comment')); ?></a></li>
        

          <?php if(getSubscription()->getData()->subscribed == true): ?>
          <li role="presentation" style="z-index:999;"><a href="#postcomment" aria-controls="postcomment" role="tab" data-toggle="tab"><?php echo e(__('Post Comment')); ?></a></li>
          <?php endif; ?>
        <?php endif; ?>
        <?php if($configs->user_rating == 1): ?>
        <li role="presentation" style="z-index:999;"><a href="#review" aria-controls="review" role="tab" data-toggle="tab"><?php echo e(__('Review')); ?></a></li>
        <?php endif; ?>
      </ul>
      <br/>
      <!-- Tab panes -->
      <div class="tab-content">
        <?php if($configs->comments == 1): ?>
          <div role="tabpanel" class="tab-pane fade in active" id="showcomment">
            <?php if(isset($movie->comments) && $movie->comments->isEmpty()): ?>
            <div class="row text-center" style="color:#B1B1B1;">
              <h4 class="text-center"><i class="fa fa-comment-o"></i> &nbsp;<?php echo e(__('No comments yet!')); ?></h4>&nbsp;
                <small class="text-center"><?php echo e(__('Be the first to share what you think !')); ?></small>
            </div>
              
            <?php else: ?>
              
              <h4 class="title" style="color:#B1B1B1;"><span class="glyphicon glyphicon-comment"></span> <?php echo e($movie->comments->where('status',1)->count()); ?> <?php echo e(__('Comment')); ?> </h4> <br/>
              
                <?php $__currentLoopData = $movie->comments->where('status','1'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="comment">
                      <div class="author-info">
                        <img src="<?php echo e(Avatar::create($comment->name )->toBase64()); ?>" class="author-image">
                        <div class="author-name">
                          <h4 class="author-heading"><?php echo e($comment->name); ?></h4>
                          <p class="author-time"><?php echo e(date('F jS, Y - g:i a',strtotime($comment->created_at))); ?></p>
                        </div>
                        <?php if(Auth::check() && (Auth::user()->is_admin == 1 || $comment->user_id == Auth::user()->id)): ?>  
                        <button type="button" class="btn btn-danger btn-floating pull-right" data-toggle="modal" data-target="#deleteModal<?php echo e($comment->id); ?>" style="left:10px;position:relative;"><i class="fa fa-trash-o"></i></button>
                        <?php endif; ?>
                        <?php if(getSubscription()->getData()->subscribed == true): ?>
                        <button type="button" class="btn btn-danger comment-btn btn-floating pull-right" data-toggle="modal" data-target="#<?php echo e($comment->id); ?>deleteModal"><i class="fa fa-reply"></i></button>
                        <?php endif; ?>
                      </div>

                      <div class="comment-content">
                      <?php echo e($comment->comment); ?>

                      </div>
                    </div>
                    <!-- ---------------- comment delete ------------>
                        <div id="deleteModal<?php echo e($comment->id); ?>" class="delete-modal  modal fade" role="dialog">
                          <div class="modal-dialog modal-sm">
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <div class="delete-icon"></div>
                              </div>
                              <div class="modal-body text-center">
                                <h4 class="modal-heading comment-delete-heading"><?php echo e(__('Are You Sure')); ?></h4>
                                <p class="comment-delete-detail"><?php echo e(__('Model Message')); ?></p>
                              </div>
                              <div class="modal-footer">
                                <?php echo Form::open(['method' => 'DELETE', 'action' => ['MovieCommentController@deletecomment', $comment->id]]); ?>

                                    <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal"><?php echo e(__('No')); ?></button>
                                    <button type="submit" class="btn btn-danger"><?php echo e(__('Yes')); ?></button>
                                <?php echo Form::close(); ?>

                              </div>
                            </div>
                          </div>
                        </div>
                      <!-------------------- end comment delete ------------------->
                  
                        
                    <!-- Modal -->
                    <?php $__currentLoopData = $comment->subcomments->where('status',1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcomment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                      <div class="comment" style="margin-left:50px;">
                        <div class="author-info">
                          <?php
                              $name=App\user::where('id',$subcomment->user_id)->first();
                            ?>
                          <img src="<?php echo e(Avatar::create($name->name )->toBase64()); ?>" class="author-image">
                          <div class="author-name">
                          
                            <h5 class="author-heading"><?php echo e($name->name); ?></h5>
                            <p class="author-time"><?php echo e(date('F jS, Y - g:i a',strtotime($subcomment->created_at))); ?></p>
                          </div>
                          <?php if(Auth::check() && (Auth::user()->is_admin == 1 || $subcomment->user_id == Auth::user()->id)): ?>
                        
                            <button type="button" class="btn btn-danger btn-floating comment-btn pull-right" data-toggle="modal" data-target="#subdeleteModal<?php echo e($subcomment->id); ?>"><i class="fa fa-trash-o"></i></button>
                          <div id="subdeleteModal<?php echo e($subcomment->id); ?>" class="delete-modal modal fade" role="dialog">
                          <div class="modal-dialog modal-sm">
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <div class="delete-icon"></div>
                              </div>
                              <div class="modal-body text-center">
                                <h4 class="modal-heading comment-delete-heading "><?php echo e(__('Are You Sure')); ?></h4>
                                <p class="comment-delete-detail"><?php echo e(__('Model Message')); ?></p>
                              </div>
                              <div class="modal-footer">
                                <?php echo Form::open(['method' => 'DELETE', 'action' => ['MovieCommentController@deletesubcomment', $subcomment->id]]); ?>

                                    <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal"><?php echo e(__('No')); ?></button>
                                    <button type="submit" class="btn btn-danger"><?php echo e(__('Yes')); ?></button>
                                <?php echo Form::close(); ?>

                              </div>
                            </div>
                          </div>
                        </div>

                        
                        <?php endif; ?>
                        </div>

                        <div class="comment-content">
                        <?php echo e($subcomment->reply); ?>

                        </div>
                      
                      </div>
                    
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div id="<?php echo e($comment->id); ?>deleteModal" class="comment-modal modal fade" role="dialog"  style="margin-top: 20px;">
                            <div class="modal-dialog modal-md" style="margin-top:70px;">
                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <div class="delete-icon"></div>
                                <h4 style="color:#FFF;"> <?php echo e(__('Reply For')); ?> <?php echo e($comment->name); ?></h4>
                                </div>
                                <div class="modal-body text-center">
                                  
                                    <form action="<?php echo e(route('movie.comment.reply', ['cid' =>$comment->id])); ?>" method ="POST">
                                      <?php echo e(csrf_field()); ?>

                                    <?php echo e(Form::label('reply',__('Your Reply'))); ?>

                                    <?php echo e(Form::textarea('reply', null, ['class' => 'form-control', 'rows'=> '5','cols' => '10'])); ?> 
                                    <br/>
                                      <button type="submit" class="btn btn-danger"><?php echo e(__('Submit')); ?></button>
                                </form>
                                </div>
                                <div class="modal-footer">
                                
                                </div>
                              </div>
                            </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
          </div>

          <?php if(auth()->guard()->check()): ?>
          <div role="tabpanel" class="tab-pane fade" id="postcomment">
              <div style="width: 90%;color:#B1B1B1;" class=" " >
                  <h3 class="author-heading post-comment-heading"><?php echo e(__('Post Comment')); ?>:</h3><br/>
                        <?php echo e(Form::open( ['route' => ['movie.comment.store', $movie->id], 'method' => 'POST'])); ?>

                      <br>
                      <?php echo e(Form::label('comment',__('Comment'))); ?>

                      <?php echo e(Form::textarea('comment', null, ['class' => 'form-control', 'rows'=> '5','cols' => '9'])); ?>

                      <br/>
                      <?php echo e(Form::submit(__('Add Comment'), ['class' => 'btn btn-md btn-default'])); ?>

              </div>

          </div>
          <?php endif; ?>
        <?php endif; ?>
        <?php if($configs->user_rating == 1): ?>
        <div role="tabpanel" class="tab-pane fade in active" id="review">
          <?php $__currentLoopData = $movieRating; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mrating): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="comment">
            <div class="author-info">
              <img src="<?php echo e(Avatar::create($mrating->user->name )->toBase64()); ?>" class="author-image">
              <div class="author-name">
                <h4 class="author-heading"><?php echo e($mrating->user->name); ?> </h4> <span><input id="rating" name="rating" class="rating rating-loading" disabled data-min="0" data-max="5" data-step="0.5"  value="<?php echo e(isset($mrating) ? $mrating->rating: 0); ?>"></span>
                <p class="author-time"><?php echo e(date('F jS, Y - g:i a',strtotime($mrating->created_at))); ?></p>
              </div>
             
            </div>
           
          </div>
          <div class="comment-content">
            <p class="author-heading"><?php echo e($mrating->review); ?></p>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>
      </div>
    </div>
    <br/>
  <?php endif; ?>
<?php endif; ?>


<?php if(isset($season)): ?>
  <?php if($configs->comments == 1): ?>
    <div class="container-fluid movie-series-section comment-nav-tabs">
     <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
       
        <li role="presentation" class="active"><a href="#showcomment" aria-controls="showcomment" role="tab" data-toggle="tab" style="z-index:999;"><?php echo e(__('Comment')); ?></a></li>
        
        <?php if(getSubscription()->getData()->subscribed == true): ?>
        <li role="presentation"><a href="#postcomment" aria-controls="postcomment" role="tab" data-toggle="tab" style="z-index:999;"><?php echo e(__('Post Comment')); ?></a></li>
        <?php endif; ?>
      </ul>
      <br/>
    <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="showcomment">
          <?php if(isset($season->tvseries->comments) && $season->tvseries->comments->isEmpty()): ?>
           <div class="row text-center" style="color:#B1B1B1;">
             <h4 class="text-center"><i class="fa fa-comment-o"></i> &nbsp;<?php echo e(__('No comments yet!')); ?></h4>&nbsp;
              <small class="text-center"><?php echo e(__('Be the first to share what you think !')); ?></small>
           </div>
          <?php else: ?>
          <h4 class="title" style="color:#B1B1B1;"><span class="glyphicon glyphicon-comment"></span> <?php echo e($season->tvseries->comments->where('status',1)->count()); ?> <?php echo e(__('comment')); ?> </h4> <br/>
            
            <?php $__currentLoopData = $season->tvseries->comments->where('status',1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="comment">
                  <div class="author-info">
                    <img src="<?php echo e(Avatar::create($comment->name )->toBase64()); ?>" class="author-image">
                    <div class="author-name">
                      <h4 class="author-heading"><?php echo e($comment->name); ?></h4>
                      <p class="author-time"><?php echo e(date('F jS, Y - g:i a',strtotime($comment->created_at))); ?></p>
                    </div>
                     <?php if(Auth::check() && (Auth::user()->is_admin == 1 || $comment->user_id == Auth::user()->id)): ?>  
                    <button type="button" class="btn btn-danger comment-btn btn-floating pull-right" data-toggle="modal" data-target="#deleteModal<?php echo e($comment->id); ?>" style="left:10px;position:relative;"><i class="fa fa-trash-o"></i></button>


                      <!-- ---------------- comment delete ------------>
                    <div id="deleteModal<?php echo e($comment->id); ?>" class="delete-modal comment-modal modal fade" role="dialog">
                      <div class="modal-dialog modal-sm">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="delete-icon"></div>
                          </div>
                          <div class="modal-body text-center">
                            <h4 class="modal-heading comment-delete-heading"><?php echo e(__('Are You Sure')); ?></h4>
                            <p class="comment-delete-detail"><?php echo e(__('Model Message')); ?></p>
                          </div>
                           <div class="modal-footer">
                            <?php echo Form::open(['method' => 'DELETE', 'action' => ['TVCommentController@deletecomment', $comment->id]]); ?>

                                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal"><?php echo e(__('No')); ?></button>
                                <button type="submit" class="btn btn-danger"><?php echo e(__('Yes')); ?></button>
                            <?php echo Form::close(); ?>

                          </div>
                        </div>
                      </div>
                    </div>
                  <!-------------------- end comment delete ------------------->


                    <?php endif; ?>
                    <?php if(getSubscription()->getData()->subscribed == true): ?>
                     <button type="button" class=" btn btn-danger comment-btn btn-floating pull-right" data-toggle="modal" data-target="#<?php echo e($comment->id); ?>deleteModal"><i class="fa fa-reply"></i> </button>
                    <?php endif; ?>
                  </div>

                  <div class="comment-content">
                   <?php echo e($comment->comment); ?>

                  </div>
                </div>
                <div>
                   
                      <!-- Modal -->
                     
                      <div id="<?php echo e($comment->id); ?>deleteModal" class="delete-modal comment-modal modal fade" role="dialog"  style="margin-top: 20px;">
                        <div class="modal-dialog modal-md" style="margin-top:70px;">
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                               
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <div class="delete-icon"></div>
                             <h4 style="color:#FFF;"> <?php echo e(__('Reply For')); ?> <?php echo e($comment->name); ?></h4>
                            </div>
                            <div class="modal-body text-center">
                               
                                <form action="<?php echo e(route('tv.comment.reply', ['cid' =>$comment->id])); ?>" method ="POST">
                                  <?php echo e(csrf_field()); ?>

                                <?php echo e(Form::label('reply',__('Your Reply'))); ?>

                                <?php echo e(Form::textarea('reply', null, ['class' => 'form-control', 'rows'=> '5','cols' => '10'])); ?> 
                                <br/>
                                  <button type="submit" class="btn btn-danger"><?php echo e(__('Submit')); ?></button>
                             </form>
                            </div>
                            <div class="modal-footer">
                             
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
                 <?php $__currentLoopData = $comment->subcomments->where('status',1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcomment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  
                    <div class="comment" style="margin-left:50px;">
                    <div class="author-info">
                       <?php
                           $name=App\user::where('id',$subcomment->user_id)->first();
                         ?>
                      <img src="<?php echo e(Avatar::create($name->name )->toBase64()); ?>" class="author-image">
                      <div class="author-name">
                       
                        <h5 class="author-heading"><?php echo e($name->name); ?></h5>
                        <p class="author-time"><?php echo e(date('F jS, Y - g:i a',strtotime($subcomment->created_at))); ?></p>
                      </div>
                        <?php if(Auth::check() && (Auth::user()->is_admin == 1 || $subcomment->user_id == Auth::user()->id)): ?>
                     
                         <button type="button" class="btn btn-danger comment-btn btn-floating pull-right" data-toggle="modal" data-target="#subdeleteModal<?php echo e($subcomment->id); ?>"><i class="fa fa-trash-o"></i></button>    
                       <div id="subdeleteModal<?php echo e($subcomment->id); ?>" class="delete-modal comment-modal modal fade" role="dialog">
                      <div class="modal-dialog modal-sm">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="delete-icon"></div>
                          </div>
                          <div class="modal-body text-center">
                            <h4 class="modal-heading comment-delete-heading"><?php echo e(__('Are You Sure')); ?></h4>
                            <p class="comment-delete-detail"><?php echo e(__('Modal Message')); ?></p>
                          </div>
                           <div class="modal-footer">
                            <?php echo Form::open(['method' => 'DELETE', 'action' => ['TVCommentController@deletesubcomment', $subcomment->id]]); ?>

                                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal"><?php echo e(__('No')); ?></button>
                                <button type="submit" class="btn btn-danger"><?php echo e(__('Yes')); ?></button>
                            <?php echo Form::close(); ?>

                          </div>
                        </div>
                      </div>
                    </div>
                    <?php endif; ?>

                    </div>

                    <div class="comment-content">
                     <?php echo e($subcomment->reply); ?>

                    </div>
                  </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
        </div>
        <?php if(auth()->guard()->check()): ?>
        <div role="tabpanel" class="tab-pane fade" id="postcomment">
            <div style="width: 90%;color:#B1B1B1;" class=" " >
                <h3 class="post-comment-heading"><?php echo e(__('Post Comment')); ?>:</h3><br/>
              
                    <?php echo e(Form::open( ['route' => ['tv.comment.store', $season->tvseries->id], 'method' => 'POST'])); ?>

                    
                    <br/>
                    <?php echo e(Form::label('comment',__('Comment'))); ?>

                    <?php echo e(Form::textarea('comment', null, ['class' => 'form-control', 'rows'=> '5','cols' => '10'])); ?>

                    <br/>
                    <?php echo e(Form::submit(__('add comment'), ['class' => 'btn btn-md btn-default'])); ?>

            </div>

        </div>
        <?php endif; ?>
      </div>
    </div>
  <br/>
  <?php endif; ?>
<?php endif; ?>
      
    <!-- end episodes -->
<br/>
    <?php if($prime_genre_slider == 1): ?>
      <?php
        $all = collect();
        $all_fil_movies = App\Movie::where('status', 1)->get();
        $all_fil_tv = App\TvSeries::all();
        if (isset($movie)) {
          $genres = explode(',', $movie->genre_id);
        } elseif (isset($season)) {
          $genres = explode(',', $season->tvseries->genre_id);
        }
        for($i = 0; $i < count($genres); $i++) {
          foreach ($all_fil_movies as $fil_movie) {
            $fil_genre_item = explode(',', trim($fil_movie->genre_id));
            for ($k=0; $k < count($fil_genre_item); $k++) {
              if (trim($fil_genre_item[$k]) == trim($genres[$i])) {
                if (isset($movie)) {
                  if ($fil_movie->id != $movie->id) {
                    $all->push($fil_movie);
                  }
                } else {
                  $all->push($fil_movie);
                }
              }
            }
          }
        }
        if (isset($movie)) {
          $all = $all->except($movie->id);
        }

        for($i = 0; $i < count($genres); $i++) {
          foreach ($all_fil_tv as $fil_tv) {
            $fil_genre_item = explode(',', trim($fil_tv->genre_id));
            for ($k=0; $k < count($fil_genre_item); $k++) {
              if (trim($fil_genre_item[$k]) == trim($genres[$i])) {
                $fil_tv = $fil_tv->seasons;
                if (isset($season)) {
                  $all->push($fil_tv->except($season->id));
                } else {
                  $all->push($fil_tv);
                }
              }
            }
          }
        }
        $all = $all->unique();
        $all = $all->flatten();
      ?>
      
      <?php if(isset($all) && count($all) > 0): ?>
        <div class="genre-prime-block">
          <div class="container-fluid">
            <h5 class="section-heading"><?php echo e(__('Customer Also Watched')); ?></h5>
            <div class="genre-prime-slider owl-carousel">
              <?php if(isset($all)): ?>
                <?php $__currentLoopData = $all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               
                  <?php
                   
                   if(isset($auth)){
                    if ($item->type == 'S') {
                       $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                        ['user_id', '=', $auth->id],
                                                                        ['season_id', '=', $item->id],
                                                                       ])->first();
                    } elseif ($item->type == 'M') {
                      $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                        ['user_id', '=', $auth->id],
                                                                        ['movie_id', '=', $item->id],
                                                                       ])->first();
                    }

                  }
                  ?>
                  <?php if($item->type == 'M'): ?>
                   
                    <?php if(isset($movie)): ?>
                    <div class="genre-prime-slide owls-item">
                      <div class="genre-slide-image home-prime-slider protip" data-pt-placement="outside" data-pt-title="#prime-mix-description-block<?php echo e($item->id); ?>">
                        <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                          <a href="<?php echo e(url('movie/detail/'.$item->slug)); ?>">
                            <?php if($item->thumbnail != null): ?>
                              <img data-src="<?php echo e(url('images/movies/thumbnails/'.$item->thumbnail)); ?>" class="img-responsive owl-lazy" alt="genre-image">
                            <?php else: ?>
                              <img data-src="<?php echo e(url('images/default-thumbnail.jpg')); ?>" class="img-responsive owl-lazy" alt="genre-image">
                            <?php endif; ?>
                          </a>
                          <?php if(timecalcuate($auth->id,$item->id,$item->type) != 0): ?>
                          <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo e(timecalcuate($auth->id,$item->id,$item->type)); ?>%">
                            </div>
                          </div>
                          <?php endif; ?>
                          <?php else: ?>
                          <a href="<?php echo e(url('movie/guest/detail/'.$item->slug)); ?>">
                            <?php if($item->thumbnail != null): ?>
                              <img data-src="<?php echo e(url('images/movies/thumbnails/'.$item->thumbnail)); ?>" class="img-responsive owl-lazy" alt="genre-image">
                            <?php else: ?>
                              <img data-src="<?php echo e(url('images/default-thumbnail.jpg')); ?>" class="img-responsive owl-lazy" alt="genre-image">
                            <?php endif; ?>
                          </a>
                          
                        <?php endif; ?>
                        
                        <?php if($item->is_custom_label == 1): ?>
                          <?php if(isset($item->label_id)): ?>
                            <span class="badge bg-info"><?php echo e($item->label->name); ?></span>
                          <?php endif; ?>
                        <?php else: ?>

                         <?php if(isset($item->is_upcoming) && $item->is_upcoming == 1): ?>
                            <span class="badge bg-success"><?php echo e(__('Up Coming')); ?></span>
                          <?php endif; ?>
                        <?php endif; ?>
                      </div>
                      <div id="prime-mix-description-block<?php echo e($item->id); ?>" class="prime-description-block">
                        <h5 class="description-heading"><?php echo e($item->title); ?></h5>
                        
                        <ul class="description-list">
                          <li><?php echo e(__('Tmdb Rating')); ?> <?php echo e($item->rating); ?></li>
                          <li><?php echo e($item->duration); ?> <?php echo e(__('Mins')); ?></li>
                          <li><?php echo e($item->publish_year); ?></li>
                          <li><?php echo e($item->maturity_rating); ?></li>
                          
                        </ul>
                        <div class="main-des">
                          <p><?php echo e(str_limit($item->detail,100,'...')); ?></p>
                          <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                            <a href="<?php echo e(url('movie/detail',$item->slug)); ?>"><?php echo e(__('Read More')); ?></a>
                          <?php else: ?>
                            <a href="<?php echo e(url('movie/guest/detail',$item->slug)); ?>"><?php echo e(__('Read More')); ?></a>
                          <?php endif; ?>
                        </div>
                        <div class="des-btn-block">
                          <?php if($auth  && getSubscription()->getData()->subscribed == true): ?>
                            <?php if(isset($item) && $item->is_upcoming != 1): ?>
                              <?php if(checkInMovie($item) == true && isset($item->video_link)): ?>
                                <?php if($item->maturity_ratin =='all age' || $age>=str_replace('+', '',$item->maturity_rating)): ?>

                                  <?php if(isset($item->video_link['iframeurl']) && $item->video_link['iframeurl'] != null): ?>
                              
                                    <a href="<?php echo e(route('watchmovieiframe',$item->id)); ?>"class="btn btn-play iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span>
                                    </a>

                                  <?php else: ?> 
                                    <a href="<?php echo e(route('watchmovie',$item->id)); ?>" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span></a>
                                  <?php endif; ?>
                                <?php else: ?>
                                  
                                  <a onclick="myage(<?php echo e($age); ?>)" class="btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span>
                                  </a>
                                  
                                <?php endif; ?>
                              <?php endif; ?>
                            <?php endif; ?>
                            <?php if($item->trailer_url != null || $item->trailer_url != ''): ?>
                              <a href="<?php echo e(route('watchTrailer',$item->id)); ?>" class="iframe btn-default"><?php echo e(__('Watch Trailer')); ?></a>
                            <?php endif; ?>
                          <?php else: ?>
                            <?php if($item->trailer_url != null || $item->trailer_url != ''): ?>
                              <a href="<?php echo e(route('guestwatchtrailer',$item->id)); ?>" class="iframe btn-default"><?php echo e(__('Watch Trailer')); ?></a>
                            <?php endif; ?>
                          <?php endif; ?>

                          <?php if($catlog ==0 && getSubscription()->getData()->subscribed == true): ?>
                        
                            <?php if(isset($wishlist_check->added)): ?>
                              <a onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')); ?></a>
                            <?php else: ?>
                              <a onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e(__('Add to Watchlist')); ?></a>
                            <?php endif; ?>
                          <?php elseif($catlog ==1 && $auth): ?>
                            <?php if(isset($wishlist_check->added)): ?>
                              <a onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')); ?></a>
                            <?php else: ?>
                              <a onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e(__('Add to Watchlist')); ?></a>
                            <?php endif; ?>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  <?php endif; ?>
                  <?php endif; ?>

                  <?php if($item->type == "S"): ?>
                   
                    <?php if(!isset($movie)): ?>
                    <div class="genre-prime-slide owls-item">
                      <div class="genre-slide-image home-prime-slider protip" data-pt-placement="outside" data-pt-title="#prime-mix-description-block<?php echo e($item->id); ?><?php echo e($item->type); ?>">
                        <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                          <a href="<?php echo e(url('show/detail/'.$item->season_slug)); ?>">
                            <?php if($item->thumbnail != null): ?>
                              <img data-src="<?php echo e(url('images/tvseries/thumbnails/'.$item->thumbnail)); ?>" class="img-responsive owl-lazy" alt="genre-image">
                            <?php elseif($item->tvseries->thumbnail != null): ?>
                              <img data-src="<?php echo e(url('images/tvseries/thumbnails/'.$item->tvseries->thumbnail)); ?>" class="img-responsive owl-lazy" alt="genre-image">
                            <?php else: ?>
                              <img data-src="<?php echo e(url('images/default-thumbnail.jpg')); ?>" class="img-responsive owl-lazy" alt="genre-image">
                            <?php endif; ?>
                          </a>
                          <?php else: ?>
                          <a href="<?php echo e(url('show/guest/detail/'.$item->season_slug)); ?>">
                            <?php if($item->thumbnail != null): ?>
                              <img data-src="<?php echo e(url('images/tvseries/thumbnails/'.$item->thumbnail)); ?>" class="img-responsive owl-lazy" alt="genre-image">
                            <?php elseif($item->tvseries->thumbnail != null): ?>
                              <img data-src="<?php echo e(url('images/tvseries/thumbnails/'.$item->tvseries->thumbnail)); ?>" class="img-responsive owl-lazy" alt="genre-image">
                            <?php else: ?>
                              <img data-src="<?php echo e(url('images/default-thumbnail.jpg')); ?>" class="img-responsive owl-lazy" alt="genre-image">
                            <?php endif; ?>
                          </a>
                        <?php endif; ?>
                        <?php if($item->tvseries->is_custom_label == 1): ?>
                          <?php if(isset($item->tvseries->label_id)): ?>
                            <span class="badge bg-info"><?php echo e($item->tvseries->label->name); ?></span>
                          <?php endif; ?>
                        <?php endif; ?>
                      
                      </div>
                      <div id="prime-mix-description-block<?php echo e($item->id); ?><?php echo e($item->type); ?>" class="prime-description-block">
                        <h5 class="description-heading"><?php echo e($item->tvseries->title); ?></h5>
                        <div class="movie-rating"><?php echo e(__('Tmdb Rating')); ?> <?php echo e($item->tvseries->rating); ?></div>
                        <ul class="description-list">
                          <li>Season <?php echo e($item->season_no); ?></li>
                          <li><?php echo e($item->publish_year); ?></li>
                          <li><?php echo e($item->tvseries->age_req); ?></li>
                         
                        </ul>
                        <div class="main-des">
                          <?php if($item->detail != null || $item->detail != ''): ?>
                            <p><?php echo e(str_limit($item->detail,100,'...')); ?></p>
                          <?php else: ?>
                            <p><?php echo e(str_limit($item->tvseries->detail,100,'...')); ?></p>
                          <?php endif; ?>
                          <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                            <a href="<?php echo e(url('show/detail',$item->season_slug)); ?>"><?php echo e(__('Read More')); ?></a>
                          <?php else: ?>
                            <a href="<?php echo e(url('show/guest/detail',$item->season_slug)); ?>"><?php echo e(__('Read More')); ?></a>
                          <?php endif; ?>
                        </div>
                        <div class="des-btn-block">
                          <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                            <?php if(isset($item->episodes[0]) && checkInTvseries($item->tvseries) == true && isset($item->episodes[0]->video_link)): ?>
                              <?php if($item->tvseries->age_req =='all age' || $age>=str_replace('+', '',$item->tvseries->age_req)): ?>
                                <?php if($item->episodes[0]->video_link['iframeurl'] !=""): ?>

                                  <a href="#" onclick="playoniframe('<?php echo e($item->episodes[0]->video_link['iframeurl']); ?>','<?php echo e($item->tvseries->id); ?>','tv')" class="btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span>
                                   </a>
                                <?php else: ?>
                                  <a href="<?php echo e(route('watchTvShow',$item->id)); ?>" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span></a>
                                <?php endif; ?>
                              <?php else: ?>
                                <a onclick="myage(<?php echo e($age); ?>)" class="btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span>
                                 </a>
                              <?php endif; ?>
                           <?php endif; ?>
                           <?php if($item->trailer_url != null || $item->trailer_url != ''): ?>
                              <a href="<?php echo e(route('watchtvTrailer',$item->id)); ?>" class="iframe btn btn-default"><?php echo e(__('Watch Trailer')); ?></a>
                            <?php endif; ?>
                          <?php else: ?>
                             <?php if($item->trailer_url != null || $item->trailer_url != ''): ?>
                              <a href="<?php echo e(route('guestwatchtvtrailer',$item->id)); ?>" class="iframe btn btn-default"><?php echo e(__('Watch Trailer')); ?></a>
                            <?php endif; ?>
                          <?php endif; ?>
                          <?php if($catlog ==0 && getSubscription()->getData()->subscribed == true): ?>
                            <?php if(isset($wishlist_check->added)): ?>
                              <a onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')); ?></a>
                            <?php else: ?>
                              <a onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e(__('Add to Watchlist')); ?></a>
                            <?php endif; ?>
                          <?php elseif($catlog ==1 && $auth): ?>
                            <?php if(isset($wishlist_check->added)): ?>
                              <a onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')); ?></a>
                            <?php else: ?>
                              <a onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e(__('Add to Watchlist')); ?></a>
                            <?php endif; ?>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                    <?php endif; ?>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endif; ?>
    <?php else: ?>
      <?php
        $all = collect();
        $all_fil_movies = App\Movie::all();
        $all_fil_tv = App\TvSeries::all();
        if (isset($movie)) {
          $genres = explode(',', $movie->genre_id);
        } elseif (isset($season)) {
          $genres = explode(',', $season->tvseries->genre_id);
        }
        for($i = 0; $i < count($genres); $i++) {
          foreach ($all_fil_movies as $fil_movie) {
            $fil_genre_item = explode(',', trim($fil_movie->genre_id));
            for ($k=0; $k < count($fil_genre_item); $k++) {
              if (trim($fil_genre_item[$k]) == trim($genres[$i])) {
                if (isset($movie)) {
                  if ($fil_movie->id != $movie->id) {
                    $all->push($fil_movie);
                  }
                } else {
                  $all->push($fil_movie);
                }
              }
            }
          }
        }
        if (isset($movie)) {
          $all = $all->except($movie->id);
        }

        for($i = 0; $i < count($genres); $i++) {
          foreach ($all_fil_tv as $fil_tv) {
            $fil_genre_item = explode(',', trim($fil_tv->genre_id));
            for ($k=0; $k < count($fil_genre_item); $k++) {
              if (trim($fil_genre_item[$k]) == trim($genres[$i])) {
                $fil_tv = $fil_tv->seasons;
                if (isset($season)) {
                  $all->push($fil_tv->except($season->id));
                } else {
                  $all->push($fil_tv);
                }
              }
            }
          }
        }
        $all = $all->unique();
        $all = $all->flatten();
      ?>
      
      <?php if(isset($all) && count($all) > 0): ?>
        <div class="genre-main-block">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-3">
                <div class="genre-dtl-block">
                  <h3 class="section-heading"><?php echo e(__('Customer Also Watched')); ?></h3>
                  <p class="section-dtl"><?php echo e(__('At the Big Screen at Home')); ?></p>
                </div>
              </div>
              <div class="col-md-9">
                <div class="genre-main-slider owl-carousel">
                  <?php if(isset($all)): ?>
                    <?php $__currentLoopData = $all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($item->type == 'S'): ?>
                       
                        <div class="genre-slide">
                          <div class="genre-slide-image home-prime-slider owls-item">
                           <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                            <a href="<?php echo e(url('show/detail/'.$item->season_slug)); ?>">
                              <?php if($item->thumbnail != null): ?>
                                <img data-src="<?php echo e(url('images/tvseries/thumbnails/'.$item->thumbnail)); ?>" class="img-responsive owl-lazy" alt="genre-image">
                              <?php elseif($item->tvseries->thumbnail != null): ?>
                                <img data-src="<?php echo e(url('images/tvseries/thumbnails/'.$item->tvseries->thumbnail)); ?>" class="img-responsive owl-lazy" alt="genre-image">
                              <?php else: ?>
                                <img data-src="<?php echo e(url('images/default-thumbnail.jpg')); ?>" class="img-responsive owl-lazy" alt="genre-image">
                              <?php endif; ?>
                            </a>

                            <?php else: ?>
                            <a href="<?php echo e(url('show/guest/detail/'.$item->season_slug)); ?>">
                              <?php if($item->thumbnail != null): ?>
                                <img data-src="<?php echo e(url('images/tvseries/thumbnails/'.$item->thumbnail)); ?>" class="img-responsive owl-lazy" alt="genre-image">
                              <?php elseif($item->tvseries->thumbnail != null): ?>
                                <img data-src="<?php echo e(url('images/tvseries/thumbnails/'.$item->tvseries->thumbnail)); ?>" class="img-responsive owl-lazy" alt="genre-image">
                              <?php else: ?>
                                <img data-src="<?php echo e(url('images/default-thumbnail.jpg')); ?>" class="img-responsive owl-lazy" alt="genre-image">
                              <?php endif; ?>
                            </a>
                            <?php endif; ?>
                             <?php if($item->tvseries->is_custom_label == 1): ?>
                              <?php if(isset($item->tvseries->label_id)): ?>
                                <span class="badge bg-info"><?php echo e($item->tvseries->label->name); ?></span>
                              <?php endif; ?>
                            <?php endif; ?>
                         
                          </div>
                          <div class="genre-slide-dtl">
                            <h5 class="genre-dtl-heading"><?php if($auth && getSubscription()->getData()->subscribed == true): ?><a href="<?php echo e(url('show/detail/'.$item->season_slug)); ?>"><?php echo e($item->tvseries->title); ?></a>
                            <?php else: ?>
                            <a href="<?php echo e(url('show/guest/detail/'.$item->season_slug)); ?>"><?php echo e($item->tvseries->title); ?></a>
                          <?php endif; ?></h5>
                            <div class="genre-small-info"><?php echo e($item->detail != null ? str_limit($item->detail,150,'...'): str_limit($item->tvseries->detail,150,'...')); ?></div>
                          </div>
                        </div>
                      <?php elseif(isset($item) && $item->type == 'M'): ?>
                     
                       
                        <div class="genre-slide">
                          <div class="genre-slide-image home-prime-slider owls-item">
                           <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                            <a href="<?php echo e(url('movie/detail/'.$item->slug)); ?>">
                              <?php if($item->thumbnail != null): ?>
                              <img data-src="<?php echo e(url('images/movies/thumbnails/'.$item->thumbnail)); ?>" class="img-responsive owl-lazy" alt="genre-image">
                            <?php else: ?>
                              <img data-src="<?php echo e(url('images/default-thumbnail.jpg')); ?>" class="img-responsive owl-lazy" alt="genre-image">
                            <?php endif; ?>
                            </a>
                            <?php if(timecalcuate($auth->id,$item->id,$item->type) != 0): ?>
                            <div class="progress">
                              <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo e(timecalcuate($auth->id,$item->id,$item->type)); ?>%">
                              </div>
                            </div>
                            <?php endif; ?>
                            <?php else: ?>
                             <a href="<?php echo e(url('movie/guest/detail/'.$item->slug)); ?>">
                              <?php if($item->thumbnail != null): ?>
                                <img data-src="<?php echo e(url('images/movies/thumbnails/'.$item->thumbnail)); ?>" class="img-responsive owl-lazy" alt="genre-image">
                              <?php else: ?>
                                <img data-src="<?php echo e(url('images/default-thumbnail.jpg')); ?>" class="img-responsive owl-lazy" alt="genre-image">
                              <?php endif; ?>
                            </a>
                            <?php endif; ?>
                            <?php if($item->is_custom_label == 1): ?>
                              <?php if(isset($item->label_id)): ?>
                                <span class="badge bg-info"><?php echo e($item->label->name); ?></span>
                              <?php endif; ?>
                            <?php else: ?>

                              <?php if(isset($item->is_upcoming) && $item->is_upcoming == 1): ?>
                                <span class="badge bg-success"><?php echo e(__('Upcoming')); ?></span>
                              <?php endif; ?>
                            <?php endif; ?>
                            
                          </div>
                          <div class="genre-slide-dtl">
                            <h5 class="genre-dtl-heading"><?php if($auth && getSubscription()->getData()->subscribed == true): ?><a href="<?php echo e(url('movie/detail/'.$item->slug)); ?>"><?php echo e($item->title); ?></a>
                            <?php else: ?>
                            <a href="<?php echo e(url('movie/guest/detail/'.$item->slug)); ?>"><?php echo e($item->title); ?></a>
                          <?php endif; ?></h5>
                          <div class="genre-small-info"><?php echo e($item->detail != null ? str_limit($item->detail,150, '...') :''); ?></div>
                          </div>
                        </div>
                      <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>
    <?php endif; ?>

    <!-- Share Modal -->
      <div class="modal fade" id="sharemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="text-center modal-body">
              <?php
                echo Share::currentPage(null,[],'<div class="row">', '</div>')
                ->facebook()
                ->twitter()
                ->telegram()
                ->whatsapp();
              ?>
            </div>
           
          </div>
        </div>
      </div>
  </section>


 <?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-script'); ?>

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
  $('#selectseason').on('change',function(){
    var get = $('#selectseason').val();
    <?php if(Auth::check() && getSubscription()->getData()->subscribed == true ): ?>
    window.location.href = '<?php echo e(url('show/detail/')); ?>/'+get;
    <?php else: ?>
     window.location.href = '<?php echo e(url('show/guest/detail/')); ?>/'+get;
    <?php endif; ?>
  });
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
  

<script type="text/javascript">
  $('.download').on('click',function(){
   
   var id    =  $(this).data('id');
   $.ajax({
      type : 'GET',
      url :  '<?php echo e(route("updateclick")); ?>',
      dataType : 'json',
      data : {id : id},
      success : function(data){
          console.log(data);
      }
   });
  });
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
<?php echo $__env->make('layouts.theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/movie_single_prime.blade.php ENDPATH**/ ?>