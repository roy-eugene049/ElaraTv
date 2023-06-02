<div class="genre-prime-block genre-prime-block-one genre-paddin-top">
           <div class="container-fluid">
                
                <h5 class="section-heading"><?php echo e(__('Upcoming Movie')); ?> <?php echo e($menu->name); ?></h5>

                
                <!-- Upcoming Tvshows and movies in List view -->
                <?php if($section->view == 1): ?>
                  <div class="genre-prime-slider owl-carousel">

                     <?php $__currentLoopData = $upcomingitems->menu_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <?php
                         if(isset($auth) && $auth != NULL){


                           if ($item->type == 'M') {
                            $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                              ['user_id', '=', $auth->id],
                                                                              ['movie_id', '=', $item->id],
                                                                            ])->first();
                          }
                           }

                          
                        ?>

                          <?php if($item->movie != NULL && $item->movie->type == 'M' && $item->movie['status'] == 1): ?>
                          <?php
                             $image = 'images/movies/thumbnails/'.$item->movie->thumbnail;
                            // Read image path, convert to base64 encoding
                          
                            $imageData = base64_encode(@file_get_contents($image));
                            if($imageData){
                            // Format the image SRC:  data:{mime};base64,{data};
                            $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                            }else{
                                $src = url('images/default-thumbnail.jpg');
                            }
                          ?>

                            <div class="genre-prime-slide">
                              <div class="genre-slide-image home-prime-slider protip" data-pt-placement="outside" data-pt-title="#prime-mix-description-block<?php echo e($item->movie->id); ?>">
                                <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                                <a href="<?php echo e(url('movie/detail',$item->movie->slug)); ?>">
                                  <?php if($src): ?>
                                    <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                  <?php else: ?>
                                    <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                  <?php endif; ?>
                                </a>
                                
                                <?php else: ?>
                                <a href="<?php echo e(url('movie/guest/detail',$item->movie->slug)); ?>">
                                  <?php if($src): ?>
                                    <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                  <?php else: ?>
                                    <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                  <?php endif; ?>
                                </a>
                                <?php endif; ?>
                                <?php if($item->movie->is_custom_label == 1): ?>
                                  <?php if(isset($item->movie->label_id)): ?>
                                    <span class="badge bg-info"><?php echo e($item->movie->label->name); ?></span>
                                  <?php endif; ?>
                                <?php else: ?>

                                  <?php if(isset($item->movie->is_upcoming) && $item->movie->is_upcoming == 1): ?>
                                    <?php if($item->movie->upcoming_date != NULL): ?>
                                      <span class="badge bg-success"><?php echo e(date('M jS Y',strtotime($item->movie->upcoming_date))); ?></span>
                                    <?php else: ?>
                                      <span class="badge bg-danger"><?php echo e(__('Coming Soon')); ?></span>
                                    <?php endif; ?>
                                    
                                  <?php endif; ?>
                                <?php endif; ?>
                              
                              </div>
                              <?php if(isset($protip) && $protip == 1): ?>
                              <div id="prime-mix-description-block<?php echo e($item->movie->id); ?>" class="prime-description-block">
                                  <h5 class="description-heading"><?php echo e($item->movie->title); ?></h5>
                                 
                                  <ul class="description-list">
                                    <li><?php echo e(__('Tmdb Rating')); ?> <?php echo e($item->movie->rating); ?></li>
                                    <li><?php echo e($item->movie->duration); ?> <?php echo e(__('Mins')); ?></li>
                                    <li><?php echo e($item->movie->publish_year); ?></li>
                                    <li><?php echo e($item->movie->maturity_rating); ?></li>
                                    
                                  </ul>
                                  <div class="main-des">
                                    <p><?php echo e(str_limit($item->movie->detail,100,'...')); ?></p>
                                    <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                                      <a href="<?php echo e(url('movie/detail',$item->movie->slug)); ?>"><?php echo e(__('Read More')); ?></a>
                                    <?php else: ?>
                                       <a href="<?php echo e(url('movie/guest/detail',$item->movie->slug)); ?>"><?php echo e(__('Read More')); ?></a>
                                    <?php endif; ?>
                                  </div>
                                
                                    
                                  <div class="des-btn-block">
                                    <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                                      
                                      <?php if($item->movie->trailer_url != null || $item->movie->trailer_url != ''): ?>
                                         <a class="iframe btn btn-default" href="<?php echo e(route('watchTrailer',$item->movie->id)); ?>"><?php echo e(__('Watch Trailer')); ?></a>
                                      <?php endif; ?>
                                    <?php else: ?>
                                      <?php if($item->movie->trailer_url != null || $item->movie->trailer_url != ''): ?>
                                        <a class="iframe btn btn-default" href="<?php echo e(route('guestwatchtrailer',$item->movie->id)); ?>"><?php echo e(__('Watch Trailer')); ?></a>
                                      <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if($catlog == 0 && getSubscription()->getData()->subscribed == true): ?>
                                      <?php if(isset($wishlist_check->added)): ?>
                                        <button onclick="addWish(<?php echo e($item->movie->id); ?>,'<?php echo e($item->movie->type); ?>')" class="addwishlistbtn<?php echo e($item->movie->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')); ?></button>
                                      <?php else: ?>
                                     
                                        <button onclick="addWish(<?php echo e($item->movie->id); ?>,'<?php echo e($item->movie->type); ?>')" class="addwishlistbtn<?php echo e($item->movie->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e(__('Add to Watchlist')); ?></button>
                                      <?php endif; ?>
                                    <?php elseif($catlog ==1 && $auth): ?>
                                      <?php if(isset($wishlist_check->added)): ?>
                                        <button onclick="addWish(<?php echo e($item->movie->id); ?>,'<?php echo e($item->movie->type); ?>')" class="addwishlistbtn<?php echo e($item->movie->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')); ?></button>
                                      <?php else: ?>
                                     
                                        <button onclick="addWish(<?php echo e($item->movie->id); ?>,'<?php echo e($item->movie->type); ?>')" class="addwishlistbtn<?php echo e($item->movie->id); ?><?php echo e($item->movie->type); ?> btn-default"><?php echo e(__('Add to Watchlist')); ?></button>
                                      <?php endif; ?>
                                    <?php endif; ?>
                                    
                                  </div>
                                 
                              </div>
                              <?php endif; ?>
                            </div>
                          <?php endif; ?>
                       
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                  </div>
                <?php endif; ?>
                <!-- Upcoming Tvshows and movies in List view END -->

                <!-- Upcoming Tvshows and movies in Grid view -->
                <?php if($section->view == 0): ?>
                     <div class="genre-prime-block">
                        <?php $__currentLoopData = $upcomingitems->menu_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <?php
                             if(isset($auth) && $auth != NULL){


                               if ($item->movie != NULL && $item->movie->type == 'M' && $item->movie['status'] == 1) {
                                $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                                  ['user_id', '=', $auth->id],
                                                                                  ['movie_id', '=', $item->movie->id],
                                                                                ])->first();
                              }
                               }

                              
                            ?>
                           
                              <?php if($item->movie != NULL && $item->movie->type == 'M' && $item->movie['status'] == 1): ?>
                              <?php
                                 $image = 'images/movies/thumbnails/'.$item->movie->thumbnail;
                                // Read image path, convert to base64 encoding
                              
                                $imageData = base64_encode(@file_get_contents($image));
                                if($imageData){
                                // Format the image SRC:  data:{mime};base64,{data};
                                $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                }else{
                                    $src = url('images/default-thumbnail.jpg');
                                }
                              ?>

                                <div class="col-lg-2 col-md-3 col-xs-6 col-sm-4">
                                    <div class="cus_img">
                                      <div class="genre-slide-image home-prime-slider protip " data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-mix-description-block<?php echo e($item->movie->id); ?>">
                                        <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                                        <a href="<?php echo e(url('movie/detail',$item->movie->slug)); ?>">
                                        <?php if($src): ?>
                                          <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="genre-image">
                                        <?php else: ?>
                                          <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="genre-image">
                                        <?php endif; ?>
                                      </a>
                                      <?php else: ?>
                                       <a href="<?php echo e(url('movie/guest/detail',$item->movie->slug)); ?>">
                                        <?php if($src): ?>
                                          <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="genre-image">
                                        <?php else: ?>
                                          <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="genre-image">
                                        <?php endif; ?>
                                      </a>

                                      <?php endif; ?>
                                      <?php if($item->movie->is_custom_label == 1): ?>
                                        <?php if(isset($item->movie->label_id)): ?>
                                          <span class="badge bg-info"><?php echo e($item->movie->label->name); ?></span>
                                        <?php endif; ?>
                                      <?php else: ?>

                                        <?php if(isset($item->movie->is_upcoming) && $item->movie->is_upcoming == 1): ?>
                                          <?php if($item->upcoming_date != NULL): ?>
                                            <span class="badge bg-success"><?php echo e(date('M jS Y',strtotime($item->upcoming_date))); ?></span>
                                          <?php else: ?>
                                            <span class="badge bg-danger"><?php echo e(__('Coming Soon')); ?></span>
                                          <?php endif; ?>
                                          
                                        <?php endif; ?>
                                      <?php endif; ?>
                                     
                                    </div>
                                    <?php if(isset($protip) && $protip == 1): ?>
                                    <div id="prime-mix-description-block<?php echo e($item->movie->id); ?>" class="prime-description-block">
                                      <h5 class="description-heading"><?php echo e($item->movie->title); ?></h5>
                                    
                                      <ul class="description-list">
                                        <li><?php echo e(__('Tmdb Rating')); ?> <?php echo e($item->movie->rating); ?></li>
                                        <li><?php echo e($item->movie->duration); ?> <?php echo e(__('Mins')); ?></li>
                                        <li><?php echo e($item->movie->publish_year); ?></li>
                                        <li><?php echo e($item->movie->maturity_rating); ?></li>
                                       
                                      </ul>
                                      <div class="main-des">
                                        <p><?php echo e(str_limit($item->movie->detail,100,'...')); ?></p>
                                        <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                                          <a href="<?php echo e(url('movie/detail',$item->movie->slug)); ?>"><?php echo e(__('Read More')); ?></a>
                                        <?php else: ?>
                                           <a href="<?php echo e(url('movie/guest/detail',$item->movie->slug)); ?>"><?php echo e(__('Read More')); ?></a>
                                        <?php endif; ?>
                                      </div>
                                      <div class="des-btn-block">
                                        <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                                       
                                          <?php if($item->movie->trailer_url != null || $item->movie->trailer_url != ''): ?>
                                             <a class="iframe btn btn-default" href="<?php echo e(route('watchTrailer',$item->movie->id)); ?>"><?php echo e(__('Watch Trailer')); ?></a>
                                          <?php endif; ?>
                                        <?php else: ?>
                                          <?php if($item->movie->trailer_url != null || $item->movie->trailer_url != ''): ?>
                                            <a class="iframe btn btn-default" href="<?php echo e(route('guestwatchtrailer',$item->movie->id)); ?>"><?php echo e(__('Watch Trailer')); ?></a>
                                          <?php endif; ?>
                                        <?php endif; ?>

                                        <?php if($catlog == 0 && getSubscription()->getData()->subscribed == true): ?>
                                          <?php if(isset($wishlist_check->added)): ?>
                                            <button onclick="addWish(<?php echo e($item->movie->id); ?>,'<?php echo e($item->movie->type); ?>')" class="addwishlistbtn<?php echo e($item->movie->id); ?><?php echo e($item->movie->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')); ?></button>
                                          <?php else: ?>
                                         
                                            <button onclick="addWish(<?php echo e($item->movie->id); ?>,'<?php echo e($item->movie->type); ?>')" class="addwishlistbtn<?php echo e($item->movie->id); ?><?php echo e($item->movie->type); ?> btn-default"><?php echo e(__('Add to Watchlist')); ?></button>
                                          <?php endif; ?>
                                        <?php elseif($catlog ==1 && $auth): ?>
                                          <?php if(isset($wishlist_check->added)): ?>
                                            <button onclick="addWish(<?php echo e($item->movie->id); ?>,'<?php echo e($item->movie->type); ?>')" class="addwishlistbtn<?php echo e($item->movie->id); ?><?php echo e($item->movie->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')); ?></button>
                                          <?php else: ?>
                                         
                                            <button onclick="addWish(<?php echo e($item->movie->id); ?>,'<?php echo e($item->movie->type); ?>')" class="addwishlistbtn<?php echo e($item->movie->id); ?><?php echo e($item->movie->type); ?> btn-default"><?php echo e(__('Add to Watchlist')); ?></button>
                                          <?php endif; ?>
                                        <?php endif; ?>
                                        
                                      </div> 
                                         
                                    </div>
                                     <?php endif; ?> 
                                  
                                    </div>
                                </div>
                              <?php endif; ?>
                            
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </div>
                <?php endif; ?>
              
            </div>
        </div> <?php /**PATH /home3/elaratvc/elaratv.in/resources/views/upcoming.blade.php ENDPATH**/ ?>