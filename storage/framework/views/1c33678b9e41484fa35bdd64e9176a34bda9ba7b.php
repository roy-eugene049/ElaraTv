<link href="<?php echo e(url('css/owl.carousel.min.css')); ?>" rel="stylesheet" type="text/css"/> <!-- owl carousel css -->
<link href="<?php echo e(url('css/owl.theme.default.min.css')); ?>" rel="stylesheet" type="text/css"/> <!-- owl carousel css -->


<?php $__currentLoopData = $menu->menugenreshow->sortBy('genre.position'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if(isset($genre->genre) && $genre->genre != NULL): ?>
 <?php
   $moviegenreitems = NULL;
   $moviegenreitems = array();

     foreach ($menu_data as $key => $item) 
     {
       
      $gmovie =  App\Movie::join('videolinks','videolinks.movie_id','=','movies.id')
                 ->select('movies.id as id','movies.title as title','movies.type as type','movies.status as status','movies.genre_id as genre_id','movies.thumbnail as thumbnail','movies.rating as rating','movies.duration as duration','movies.publish_year as publish_year','movies.maturity_rating as maturity_rating','movies.detail as detail','movies.trailer_url as trailer_url','videolinks.iframeurl as iframeurl','movies.slug as slug','movies.tmdb as tmdb','movies.is_custom_label as is_custom_label','movies.label_id as label_id')
                   ->where('movies.is_upcoming','!=' ,1)
                 ->where('movies.id',$item->movie_id)->first();
          if(isset($gmovie->genre_id)) {   
            foreach (explode(',',$gmovie->genre_id) as $key => $ggid) {
              if($ggid==$genre->genre->id){
                if(isset($gmovie) && $gmovie != NULL){
            
                  $moviegenreitems[] = $gmovie;
                          
                }
              }           
            }
          }
          


         if($section->order == 1){
             arsort($moviegenreitems);
           }

         if(count($moviegenreitems) == $section->item_limit){
             break;
             exit(1);
         }

     }       
     $moviegenreitems = array_values(array_filter($moviegenreitems));
     foreach ($menu_data as $key => $item) 
     {

       $gtvs = App\Tvseries::
                   join('seasons','seasons.tv_series_id','=','tv_series.id')
                   ->join('episodes','episodes.seasons_id','=','seasons.id')
                   ->join('videolinks','videolinks.episode_id','=','episodes.id')
                   ->select('seasons.id as seasonid','tv_series.genre_id as genre_id','tv_series.id as id','tv_series.type as type','tv_series.status as status','tv_series.thumbnail as thumbnail','tv_series.title as title','tv_series.rating as rating','seasons.publish_year as publish_year','tv_series.maturity_rating as age_req','tv_series.detail as detail','seasons.season_no as season_no','videolinks.iframeurl as iframeurl','seasons.trailer_url as trailer_url','seasons.tmdb as tmdb','tv_series.is_custom_label as is_custom_label','tv_series.label_id as label_id')
                  
             ->where('tv_series.id',$item->tv_series_id)->first();
             
   
             if(isset($gtvs->genre_id)) {   
            foreach (explode(',',$gtvs->genre_id) as $key => $ggtid) {
              if($ggtid==$genre->genre->id){
                if(isset($gtvs) && $gtvs != NULL){
            
                  $moviegenreitems[] = $gtvs;
                          
                }
              }           
            }
          }
     
       if($section->order == 1){
         arsort($moviegenreitems);
       }

       if(count($moviegenreitems) == $section->item_limit*2){
           break;
           exit(1);
       }

     }
     $moviegenreitems = array_values(array_filter($moviegenreitems));
  
 ?>
<div class="genre-prime-block genre-prime-block-one genre-paddin-top">    
  <div class="container-fluid">        
    <?php if($moviegenreitems != NULL && count($moviegenreitems)>0): ?>
     <h5 class="section-heading"><?php echo e($genre->genre->name); ?> in <?php echo e($menu->name); ?> </h5>
       
       <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
       
         <a href="<?php echo e(route('show.in.genre',$genre->genre->id)); ?>" class="see-more"> <b><?php echo e(__('View All')); ?></b></a>
     
       <?php else: ?>
       
         <a href="<?php echo e(route('show.in.guest.genre',$genre->genre->id)); ?>" class="see-more"> <b><?php echo e(__('View All')); ?></b></a>
         
       
       <?php endif; ?>
    <?php endif; ?>   
                           
    <?php if($section->view == 1): ?>
   <!-- List view movies in genre -->
       <div class="genre-prime-slider owl-carousel">
         <?php $__currentLoopData = $moviegenreitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

         <?php
                     if(isset($auth)  && $auth != NULL){


                       if ($item->type == 'M') {
                         $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                           ['user_id', '=', $auth->id],
                                                                           ['movie_id', '=', $item->id],
                                                                         ])->first();
                       }
                       }

                       if(isset($auth)  && $auth != NULL){

                           $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();

                           if (isset($gets1)) {


                             $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                         ['user_id', '=', $auth->id],
                                                                         ['season_id', '=', $gets1->id],
                               ])->first();


                             }

                           }
                           else{
                             $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();
                           }
                     ?>

       
             <!-- List view genre movies and tv shows -->
           
               <?php if($item->status == 1): ?>
                   <?php if($item->type == 'M'): ?>
                   <?php
                         $image = 'images/movies/thumbnails/'.$item->thumbnail;
                         // Read image path, convert to base64 encoding
                         
                         $imageData = base64_encode(@file_get_contents($image));
                         if($imageData){
                         // Format the image SRC:  data:{mime};base64,{data};
                         $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                         }else{
                             $src = Avatar::create($item->title)->toBase64();
                         }
                     ?>
                     <?php if(hidedata($item->id,$item->type) != 1): ?>
                     <div class="genre-prime-slide">
                         <div class="genre-slide-image home-prime-slider protip" data-pt-placement="outside" data-pt-title="#prime-mix-description-block<?php echo e($item->id); ?>">
                           <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                           <a href="<?php echo e(url('movie/detail',$item->slug)); ?>">
                             <?php if($src): ?>
                               <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="movie-image">
                             <?php else: ?>
                               <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="movie-image">
                             <?php endif; ?>
                           </a>
                           <div class="hide-icon">
                             <a onclick="hideforme('<?php echo e($item->id); ?>','<?php echo e($item->type); ?>')" title="<?php echo e(__('Hide this Movie')); ?>" class=""><i class="fa fa-eye-slash"></i></a>
                           </div>
                           <?php if(timecalcuate($auth->id,$item->id,$item->type) != 0): ?>
                             <div class="progress">
                               <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo e(timecalcuate($auth->id,$item->id,$item->type)); ?>%">
                               </div>
                             </div>
                           <?php endif; ?>
                           <?php else: ?>
                             <a href="<?php echo e(url('movie/guest/detail',$item->slug)); ?>">
                             <?php if($src): ?>
                               <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="movie-image">
                             <?php else: ?>
                               <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="movie-image">
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
                         <div id="prime-mix-description-block<?php echo e($item->id); ?>" class="prime-description-block">
                             <h5 class="description-heading"><?php echo e($item->title); ?></h5>
                             
                             <ul class="description-list">
                               <li><?php echo e(__('Tmdb Rating')); ?> <?php echo e($item->rating); ?></li>
                               <li><?php echo e($item->duration); ?> <?php echo e(__('Mins')); ?></li>
                               <li><?php echo e($item->publish_year); ?></li>
                               <li><?php echo e($item->maturity_rating); ?></li>
                             
                             </ul>
                             <div class="main-des">
                               <p><?php echo e($item->detail); ?></p>
                               <a href="#"></a>
                             </div>
                             <div class="des-btn-block">
                               <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                                 <?php if($item->is_upcoming != 1): ?>
                                   <?php if(checkInMovie($item) == true && isset($item->video_link)): ?>
                                     <?php if($item->maturity_rating == 'all age' || $age>=str_replace('+', '', $item->maturity_rating)): ?>
                                       <?php if(isset($item->video_link['iframeurl']) && $item->video_link['iframeurl'] != null): ?>
                                   
                                         <a href="<?php echo e(route('watchmovieiframe',$item->id)); ?>"class="btn btn-play iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span>
                                         </a>

                                       <?php else: ?>
                                         <a href="<?php echo e(route('watchmovie',$item->id)); ?>" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span>
                                           </a>
                                       <?php endif; ?>
                                     <?php else: ?>
                                       <a onclick="myage(<?php echo e($age); ?>)" class=" btn btn-play play-btn-icon"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span></a>
                                     <?php endif; ?>
                                   <?php endif; ?>
                                 <?php endif; ?>
                                 <?php if($item->trailer_url != null || $item->trailer_url != ''): ?>
                                   <a class="iframe btn btn-default" href="<?php echo e(route('watchTrailer',$item->id)); ?>"><?php echo e(__('Watch Trailer')); ?></a>
                                 <?php endif; ?>
                               <?php else: ?>
                                 <?php if($item->trailer_url != null || $item->trailer_url != ''): ?>
                                   <a class="iframe btn btn-default" href="<?php echo e(route('guestwatchtrailer',$item->id)); ?>"><?php echo e(__('Watch Trailer')); ?></a>
                                 <?php endif; ?>
                               <?php endif; ?>
                               
                               <?php if($catlog==0 && getSubscription()->getData()->subscribed == true): ?>
                                 <?php if(isset($wishlist_check->added)): ?>
                                   <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')); ?></button>
                                 <?php else: ?>
                               
                                   <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e(__('Add to Watchlist')); ?></button>
                                 <?php endif; ?>
                               <?php elseif($catlog ==1 && $auth): ?>
                                 <?php if(isset($wishlist_check->added)): ?>
                                   <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')); ?></button>
                                 <?php else: ?>
                             
                                   <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e(__('Add to Watchlist')); ?></button>
                                 <?php endif; ?>
                               <?php endif; ?>
                             </div>
                           </div>
                         <?php endif; ?>
                     </div>
                     <?php endif; ?>
                   <?php endif; ?>

                   <?php if($item->type == 'T'): ?>
                     <?php
                         $image = 'images/tvseries/thumbnails/'.$item->thumbnail;
                         // Read image path, convert to base64 encoding
                         
                         $imageData = base64_encode(@file_get_contents($image));
                         if($imageData){
                         // Format the image SRC:  data:{mime};base64,{data};
                         $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                         }else{
                             $src = Avatar::create($item->title)->toBase64();
                         }
                     ?>
                     <?php if(isset($gets1) && hidedata($gets1->id,$gets1->type) != 1): ?>
                       <div class="genre-prime-slide">
                           <div class="genre-slide-image home-prime-slider protip" data-pt-placement="outside" data-pt-title="#prime-mix-description-block<?php echo e($item->id); ?><?php echo e($item->type); ?>">
                               <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                               <a <?php if(isset($gets1)): ?> href="<?php echo e(url('show/detail',$gets1->season_slug)); ?>" <?php endif; ?>>
                                 <?php if($item->thumbnail != null): ?>
                                   
                                   <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="tvseries-image">
                                 
                                 <?php else: ?>
                                   <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="tvseries-image">
                                 <?php endif; ?>
                               </a>
                               <div class="hide-icon">
                                 <a onclick="hideforme('<?php echo e($gets1->id); ?>','<?php echo e($gets1->type); ?>')" title="<?php echo e(__('Hide this Movie')); ?>" class=""><i class="fa fa-eye-slash"></i></a>
                               </div>
                               <?php else: ?>
                               <a <?php if(isset($gets1)): ?> href="<?php echo e(url('show/guest/detail',$gets1->season_slug)); ?>" <?php endif; ?>>
                                 <?php if($item->thumbnail != null): ?>
                                   <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="tvseries-image">
                               
                                 <?php else: ?>
                                   <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="tvseries-image">
                                 <?php endif; ?>
                               </a>
                               <?php endif; ?> 
                             
                           </div>
                           <?php if(isset($protip) && $protip == 1): ?>
                           <div id="prime-mix-description-block<?php echo e($item->id); ?><?php echo e($item->type); ?>" class="prime-description-block">
                             <h5 class="description-heading"><?php echo e($item->title); ?></h5>
                             <div class="movie-rating"><?php echo e(__('Tmdb Rating')); ?> <?php echo e($item->rating); ?></div>
                             <ul class="description-list">
                               <li><?php echo e(__('Season')); ?> <?php echo e($item->season_no); ?></li>
                               <li><?php echo e($item->publish_year); ?></li>
                               <li><?php echo e($item->age_req); ?></li>
                               
                             </ul>
                             <div class="main-des">
                               <?php if($item->detail != null || $item->detail != ''): ?>
                                 <p><?php echo e($item->detail); ?></p>
                               <?php else: ?>
                                 <p><?php echo e($item->detail); ?></p>
                               <?php endif; ?>
                               <a href="#"></a>
                             </div>
                             
                             <div class="des-btn-block">
                               <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                                 <?php if(isset($gets1->episodes[0]) && checkInTvseries($item) == true && isset($gets1->episodes[0]->video_link)): ?>
                                   <?php if($item->age_req == 'all age' || $age>=str_replace('+', '', $item->age_req)): ?>
                                     <?php if($gets1->episodes[0]->video_link['iframeurl'] !=""): ?>
                                 
                                       <a href="#" onclick="playoniframe('<?php echo e($gets1->episodes[0]->video_link['iframeurl']); ?>','<?php echo e($gets1->episodes[0]->seasons->tvseries->id); ?>','tv')" class="btn btn-play"><span class= "play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span>
                                       </a>

                                     <?php else: ?>
                                       <a href="<?php echo e(route('watchTvShow',$item->seasonid)); ?>" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span></a>
                                     <?php endif; ?>
                                   <?php else: ?>
                                     <a onclick="myage(<?php echo e($age); ?>)" class=" btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span></a>
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
                                 <?php if(isset($gets1)): ?>
                                   <?php if(isset($wishlist_check->added)): ?>
                                     <a onclick="addWish(<?php echo e($item->seasonid); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($item->seasonid); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')); ?></a>
                                   <?php else: ?>
                                     <?php if($gets1): ?>
                                       <a onclick="addWish(<?php echo e($item->seasonid); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($item->seasonid); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e(__('Add to Watchlist')); ?>

                                       </a>
                                     <?php endif; ?>
                                   <?php endif; ?>
                                 <?php endif; ?>
                               <?php elseif($catlog ==1 && $auth): ?>
                                 <?php if(isset($gets1)): ?>
                                   <?php if(isset($wishlist_check->added)): ?>
                                     <a onclick="addWish(<?php echo e($item->seasonid); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($item->seasonid); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')); ?></a>
                                   <?php else: ?>
                                     <?php if($gets1): ?>
                                       <a onclick="addWish(<?php echo e($item->seasonid); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($item->seasonid); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e(__('Add to Watchlist')); ?>

                                       </a>
                                     <?php endif; ?>
                                   <?php endif; ?>
                                 <?php endif; ?>
                               <?php endif; ?>
                             </div>
                           </div>
                           <?php endif; ?>
                       </div>
                     <?php endif; ?>
                   <?php endif; ?>
               <?php endif; ?>
           
           <!-- end -->

         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </div>
   
   <!-- List view movies in genre END -->
    <?php endif; ?>
                             

                       
    <?php if($section->view == 0): ?>

     <!-- Grid view genre movies -->
     <div class="genre-prime-block">
           
             <?php $__currentLoopData = $moviegenreitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <?php
                 

                 if(isset($auth)  && $auth != NULL){
                     if ($item->type == 'M') {
                       $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                         ['user_id', '=', $auth->id],
                                                                         ['movie_id', '=', $item->id],
                                                                       ])->first();
                     }
                   }



                   $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();

                   if (isset($gets1) && $auth  && $auth != NULL) {


                     $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                 ['user_id', '=', $auth->id],
                                                                 ['season_id', '=', $gets1->id],
                       ])->first();


                     }

       

                   
                 ?>
                 <?php if($item->status == 1): ?>
                   <?php if($item->type == 'M'): ?>
                   
                     <?php
                       $image = 'images/movies/thumbnails/'.$item->thumbnail;
                       // Read image path, convert to base64 encoding
                       
                       $imageData = base64_encode(@file_get_contents($image));
                       if($imageData){
                       // Format the image SRC:  data:{mime};base64,{data};
                       $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                       }else{
                           $src = Avatar::create($item->title)->toBase64();
                       }
                     ?>
                     <?php if(hidedata($item->id,$item->type) != 1): ?>
                     <div class="col-lg-2 col-md-3 col-xs-6 col-sm-4">
                       <div class="cus_img">
                         <div class="genre-slide-image home-prime-slider protip" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-mix-description-block<?php echo e($item->id); ?>">
                             <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                               <a href="<?php echo e(url('movie/detail',$item->slug)); ?>">
                               <?php if($src): ?>
                                 <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="movie-image">
                               
                               <?php endif; ?>
                             </a>
                             <div class="hide-icon hide-icon-two">
                               <a onclick="hideforme('<?php echo e($item->id); ?>','<?php echo e($item->type); ?>')" title="<?php echo e(__('Hide this Movie')); ?>" class=""><i class="fa fa-eye-slash"></i></a>
                             </div>
                             <?php if(timecalcuate($auth->id,$item->id,$item->type) != 0): ?>
                             <div class="progress">
                               <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo e(timecalcuate($auth->id,$item->id,$item->type)); ?>%">
                               </div>
                             </div>
                             <?php endif; ?>
                             <?php else: ?>
                               <a href="<?php echo e(url('movie/guest/detail',$item->slug)); ?>">
                                 <?php if($src): ?>
                                   <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="movie-image">
                                 
                                 <?php endif; ?>
                               </a>

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
                         
                         </div>
                         <?php if(isset($protip) && $protip == 1): ?>
                         <div id="prime-mix-description-block<?php echo e($item->id); ?>" class="prime-description-block">
                             <h5 class="description-heading"><?php echo e($item->title); ?></h5>
                             <div class="movie-rating"><?php echo e(__('Tmdb Rating')); ?> <?php echo e($item->rating); ?></div>
                             <ul class="description-list">
                               <li><?php echo e($item->duration); ?> <?php echo e(__('Mins')); ?></li>
                               <li><?php echo e($item->publish_year); ?></li>
                               <li><?php echo e($item->maturity_rating); ?></li>
                             
                             </ul>
                             <div class="main-des">
                               <p><?php echo e($item->detail); ?></p>
                               <a href="#"></a>
                             </div>
                             
                             <div class="des-btn-block">
                               <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                                 <?php if($item->is_upcoming != 1): ?>
                                   <?php if(checkInMovie($item) == true && isset($item->video_link)): ?>
                                     <?php if($item->maturity_rating == 'all age' || $age>=str_replace('+', '', $item->maturity_rating)): ?>
                                       <?php if(isset($item->video_link['iframeurl']) && $item->video_link['iframeurl'] != null): ?>
                                   
                                         <a href="<?php echo e(route('watchmovieiframe',$item->id)); ?>"class="btn btn-play iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span>
                                         </a>

                                       <?php else: ?>
                                         <a href="<?php echo e(route('watchmovie',$item->id)); ?>" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span>
                                         </a>
                                       <?php endif; ?>
                                     <?php else: ?>
                                       <a onclick="myage(<?php echo e($age); ?>)" class=" btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span>
                                       </a>
                                     <?php endif; ?>
                                   <?php endif; ?>
                                 <?php endif; ?>
                                 <?php if($item->trailer_url != null || $item->trailer_url != ''): ?>
                                   <a class="iframe btn btn-default" href="<?php echo e(route('watchTrailer',$item->id)); ?>"><?php echo e(__('Watch Trailer')); ?></a>
                                 <?php endif; ?>
                               <?php else: ?>
                                 <?php if($item->trailer_url != null || $item->trailer_url != ''): ?>
                                   <a class="iframe btn btn-default" href="<?php echo e(route('guestwatchtrailer',$item->id)); ?>"><?php echo e(__('Watch Trailer')); ?></a>
                                 <?php endif; ?>
                               <?php endif; ?>
                             
                               <?php if($catlog ==0 && getSubscription()->getData()->subscribed == true): ?>
                                 <?php if(isset($wishlist_check->added)): ?>
                                   <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')); ?></button>
                                 <?php else: ?>
                               
                                   <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e(__('Add to Watchlist')); ?></button>
                                 <?php endif; ?>
                               <?php elseif($catlog ==1 && $auth): ?>
                                 <?php if(isset($wishlist_check->added)): ?>
                                   <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')); ?></button>
                                 <?php else: ?>
                             
                                   <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e(__('Add to Watchlist')); ?></button>
                                 <?php endif; ?>
                               <?php endif; ?>
                             </div>
                           </div>
                           <?php endif; ?>
                         </div>
                     </div>
                     <?php endif; ?>
                   <?php endif; ?>

                   <?php if($item->type == 'T'): ?>
                       <?php
                         $image = 'images/tvseries/thumbnails/'.$item->thumbnail;
                         // Read image path, convert to base64 encoding
                         
                         $imageData = base64_encode(@file_get_contents($image));
                         if($imageData){
                         // Format the image SRC:  data:{mime};base64,{data};
                         $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                         }else{
                             $src = Avatar::create($item->title)->toBase64();
                         }
                       ?>
                       <?php if(isset($gets1) && hidedata($gets1->id,$gets1->type) != 1): ?>
                         <div class="col-lg-2 col-md-3 col-xs-6 col-sm-4">
                                       <div class="cus_img">
                                       <div class="genre-slide-image home-prime-slider protip" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-mix-description-block<?php echo e($item->id); ?><?php echo e($item->type); ?>">
                                         <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
                                           <a <?php if(isset($gets1)): ?> href="<?php echo e(url('show/detail',$gets1->season_slug)); ?>" <?php endif; ?>>
                                             <?php if($src): ?>
                                               
                                               <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="tvseries-image">
                                           
                                             <?php endif; ?>
                                           </a>
                                           <div class="hide-icon hide-icon-two">
                                             <a onclick="hideforme('<?php echo e($gets1->id); ?>','<?php echo e($gets1->type); ?>')" title="<?php echo e(__('Hide this Movie')); ?>" class=""><i class="fa fa-eye-slash"></i></a>
                                           </div>
                                           <?php else: ?>
                                           <a <?php if(isset($gets1)): ?> href="<?php echo e(url('show/guest/detail',$gets1->season_slug)); ?>" <?php endif; ?>>
                                             <?php if($src): ?>
                                               <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="tvseries-image">
                                             
                                           
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
                                                 <?php if($item->age_req == 'all age' || $age>=str_replace('+', '', $item->age_req)): ?>
                                                   <?php if($gets1->episodes[0]->video_link['iframeurl'] !=""): ?>
                                               
                                                     <a href="#" onclick="playoniframe('<?php echo e($gets1->episodes[0]->video_link['iframeurl']); ?>','<?php echo e($gets1->episodes[0]->seasons->tvseries->id); ?>','tv')" class="btn btn-play"><span class= "play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span>
                                                     </a>

                                                   <?php else: ?>
                                                     <a href="<?php echo e(route('watchTvShow',$gets1->id)); ?>" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span></a>
                                                   <?php endif; ?>
                                                 <?php else: ?>
                                                 <a onclick="myage(<?php echo e($age); ?>)" class=" btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('Play Now')); ?></span></a>
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
                                             <?php if($catlog == 1 && getSubscription()->getData()->subscribed == true): ?>
                                               <?php if(isset($gets1)): ?>
                                                 <?php if(isset($wishlist_check->added)): ?>
                                                   <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('remove fromw atchlist') : __('Add to Watchlist')); ?></a>
                                                 <?php else: ?>
                                                   <?php if($gets1): ?>
                                                     <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e(__('Add to Watchlist')); ?>

                                                     </a>
                                                   <?php endif; ?>
                                                 <?php endif; ?>
                                               <?php endif; ?>
                                             <?php elseif($catlog ==1 && $auth): ?>

                                               <?php if(isset($gets1)): ?>
                                                 <?php if(isset($wishlist_check->added)): ?>
                                                   <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')); ?></a>
                                                 <?php else: ?>
                                                   <?php if($gets1): ?>
                                                     <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e(__('Add to Watchlist')); ?>

                                                     </a>
                                                   <?php endif; ?>
                                                 <?php endif; ?>
                                               <?php endif; ?>
                                             <?php endif; ?>
                                           </div>
                                         </div>
                                       <?php endif; ?>     
                                     
                                     </div>
                         </div>
                       <?php endif; ?>
                   <?php endif; ?>
                 <?php endif; ?>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

     </div>

     <!--end grid view for genre-->
    <?php endif; ?>
  </div>            
</div>  
<?php endif; ?> 
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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

<script type="text/javascript" src="<?php echo e(url('js/jquery.popover.js')); ?>"></script> <!-- bootstrap popover js -->
<script type="text/javascript" src="<?php echo e(url('js/menumaker.js')); ?>"></script> <!-- menumaker js -->
<script type="text/javascript" src="<?php echo e(url('js/jquery.curtail.min.js')); ?>"></script> <!-- menumaker js -->
<?php if(selected_lang()->rtl == 0): ?>
<script type="text/javascript" src="<?php echo e(url('js/owl.carousel.min.js')); ?>"></script> 
<script type="text/javascript" src="<?php echo e(url('js/slider.js')); ?>"></script>
<?php else: ?>
<script type="text/javascript" src="<?php echo e(url('js/owl-carousel-rtl-js/owl.carousel.min.js')); ?>"></script> <!-- owl carousel js -->
<script type="text/javascript" src="<?php echo e(url('js/slider-rtl.js')); ?>"></script>
<?php endif; ?>

<script type="text/javascript" src="<?php echo e(url('js/jquery.scrollSpeed.js')); ?>"></script> <!-- owl carousel js -->
<script type="text/javascript" src="<?php echo e(url('js/TweenMax.min.js')); ?>"></script> <!-- animation gsap js -->
<script type="text/javascript" src="<?php echo e(url('js/ScrollMagic.min.js')); ?>"></script> <!-- custom js -->
<script type="text/javascript" src="<?php echo e(url('js/animation.gsap.min.js')); ?>"></script> <!-- animation gsap js -->
<script type="text/javascript" src="<?php echo e(url('js/modernizr-custom.js')); ?>"></script> <!-- debug addIndicators js -->
<script type="text/javascript" src="<?php echo e(url('js/theme.js')); ?>"></script> <!-- custom js -->
<script type="text/javascript" src="<?php echo e(url('js/custom-js.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(url('js/colorbox.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(url('js/checkit.js')); ?>"></script>

<script src="<?php echo e(url('js/star-rating.min.js')); ?>"></script><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/selectgenre.blade.php ENDPATH**/ ?>