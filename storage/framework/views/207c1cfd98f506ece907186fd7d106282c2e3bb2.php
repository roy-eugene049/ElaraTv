
<?php $__env->startSection('title',"Edit Tv Chanel - $movie->title"); ?>
<?php $__env->startSection('breadcum'); ?>
	<div class="breadcrumbbar">
    <h4 class="page-title"><?php echo e(__('Edit TV Chanel')); ?></h4>
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>" title="<?php echo e(__('Dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
          <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Edit TV Chanel')); ?></li>
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
          <a href="<?php echo e(url('admin/livetv')); ?>" class="float-right btn btn-primary-rgba mr-2" title="<?php echo e(__('Back')); ?>"><i
            class="feather icon-arrow-left mr-2"></i><?php echo e(__('Back')); ?></a>
          <h5 class="box-title"><?php echo e(__('Edit TV Chanel')); ?></h5>
        </div>
        <div class="card-body ml-2">
          <?php echo Form::model($movie, ['method' => 'PATCH', 'action' => ['LiveTvController@update',$movie->id], 'files' => true]); ?>

          <div class="bg-info-rgba p-4 mb-4 rounded">
            <div class="row">
              <div class="col-lg-4 col-md-4">
                <div id="movie_title" class="form-group text-dark<?php echo e($errors->has('title') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('title', __('Tv Chanel Title')); ?><sup class="text-danger">*</sup>
                  <input <?php echo e($movie->fetch_by == 'byID' ? "readonly=readonly" : ""); ?> id="mv_t" type="text" class="form-control" name="title" value="<?php echo e($movie->title); ?>">
                  <small class="text-danger"><?php echo e($errors->first('title')); ?></small>
                </div>
              </div>
              <div class="col-lg-4 col-md-4">
                <div id="movie_slug" class="form-group text-dark<?php echo e($errors->has('slug') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('slug', __('Live TV Slug')); ?><sup class="text-danger">*</sup>
                  <input type="text" class="form-control" name="slug" value="<?php echo e($movie->title); ?>">
                  <small class="text-danger"><?php echo e($errors->first('slug')); ?></small>
                </div>
              </div>
              <div class="col-lg-4 col-md-4">
                <div class="form-group text-dark<?php echo e($errors->has('maturity_rating') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('maturity_rating', __('Maturity Rating')); ?><sup class="text-danger">*</sup>
                  <?php echo Form::select('maturity_rating', array('all age' => __('All Age'), '13+' =>'13+', '16+' => '16+', '18+'=>'18+'), null, ['class' => 'form-control select2']); ?>

                  <small class="text-danger"><?php echo e($errors->first('maturity_rating')); ?></small>
                </div>
              </div>
              <div class="col-lg-4 col-md-4">
                <input type="text" name="director_id" value="0" hidden="true">
                <input type="text" name="actor_id" value="0" hidden="true">
                <input type="text" name="duration" value="0" hidden="true">
                <div class="form-group text-dark text-dark<?php echo e($errors->has('rating') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('rating', __('Ratings')); ?><sup class="text-danger">*</sup>
                  <?php echo Form::text('rating',  null, ['class' => 'form-control', ]); ?>

                  <small class="text-danger"><?php echo e($errors->first('rating')); ?></small>
                </div>
              </div>
              <div class="col-lg-4 col-md-4">
                
                <div class="form-group text-dark<?php echo e($errors->has('a_language') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('a_language', __('Audio Languages')); ?><sup class="text-danger">*</sup>
                  <div class="input-group">
                    <select name="a_language[]" id="a_language" class="form-control select2" multiple="multiple">
                      <?php if(isset($old_lans) && count($old_lans) > 0): ?>
                      <?php $__currentLoopData = $old_lans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $old): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($old->id); ?>" selected="selected"><?php echo e($old->language); ?></option> 
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php endif; ?>
                      <?php if(isset($a_lans)): ?>
                      <?php $__currentLoopData = $a_lans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($rest->id); ?>"><?php echo e($rest->language); ?></option> 
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php endif; ?>
                    </select>  
                    <a href="#" class="add-audio-lang" data-toggle="modal" data-target="#AddLangModal" class="input-group-addon"><i class="feather icon-plus"></i></a>
                  </div>
                  <small class="text-danger"><?php echo e($errors->first('a_language')); ?></small>
                </div>
              </div>
              <div class="col-lg-4 col-md-4">
                <div class="form-group text-dark text-dark<?php echo e($errors->has('genre_id') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('genre_id',__('Genre')); ?><sup class="text-danger">*</sup>
                  <div class="input-group">
                    <select name="genre_id[]" id="genre_id" class="form-control select2" multiple="multiple">
                      <?php if(isset($old_genre) && count($old_genre) > 0): ?>
                      <?php $__currentLoopData = $old_genre; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $old): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($old->id); ?>" selected="selected"><?php echo e($old->name); ?></option> 
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php endif; ?>
                      <?php if(isset($genre_ls)): ?>
                      <?php $__currentLoopData = $genre_ls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($rest->id); ?>"><?php echo e($rest->name); ?></option> 
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php endif; ?>
                    </select>  
                    <a href="#" class="add-audio-lang" data-toggle="modal" data-target="#AddGenreModal" class="input-group-addon"><i class="feather icon-plus"></i></a>
                  </div>
                  <small class="text-danger"><?php echo e($errors->first('genre_id')); ?></small>
                </div>
              </div>
              <div class="col-lg-4 col-md-4">
                <div class="form-group text-dark">
                  <label for=""><?php echo e(__('Meta Keyword')); ?>: <sup class="text-danger">*</sup></label>
                  <input name="keyword" type="text" class="form-control" value="<?php echo e($movie->keyword); ?>" data-role="tagsinput"/>          
                </div>
              </div>
              <div class="col-lg-8 col-md-8">
                
                <div class="form-group text-dark<?php echo e($errors->has('selecturl') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('selecturls', __('Add Video')); ?><sup class="text-danger">*</sup>
                  <select class="form-control select2" id="selecturl" name="selecturl">
                    <?php if($video_link['iframeurl'] != ''): ?>
                    <option value="iframeurl" selected><?php echo e(__('IFrame URL')); ?></option>
                    <?php else: ?>
                    <option value="iframeurl"><?php echo e(__('IFrame URL')); ?></option>
                    <?php endif; ?>
                    <?php if($video_link['ready_url'] != ''): ?>
                    <option value="customurl" selected><?php echo e(__('Custom URL YouTube URL Vimeo URL')); ?></option>
                    <?php else: ?>
                    <option value="customurl"><?php echo e(__('Custom URL YouTube URL Vimeo URL')); ?></option>
                    <?php endif; ?>
                  </select>
                  <small class="text-danger"><?php echo e($errors->first('selecturl')); ?></small>
                </div>      
                <div id="ifbox"  style="<?php echo e($video_link['iframeurl'] != '' ? '' : "display: none"); ?>" class="form-group text-dark">
                  <label for="iframeurl"><?php echo e(__('IFRAME URL')); ?>: </label> <a data-toggle="modal" data-target="#embdedexamp"></a>
                  <input  type="text" value="<?php echo e($video_link['iframeurl']); ?>" class="form-control" name="iframeurl" placeholder="<?php echo e(__('IFRAME URL')); ?>">
                </div>
          
                <!-- Modal -->
                <div  class="modal fade" id="embdedexamp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" title="<?php echo e(__('Close')); ?>"><span aria-hidden="true">&times;</span></button>
                        <h6 class="modal-title" id="myModalLabel"><?php echo e(__('Embed URL Examples')); ?>: </h6>
                      </div>
                      <div class="modal-body">
                        <p style="font-size: 15px;"><b><?php echo e(__('YouTube')); ?>:</b> <?php echo e(__('YouTube URL Link')); ?> </p>
          
                        <p style="font-size: 15px;"><b><?php echo e(__('Google Drive')); ?>:</b><?php echo e(__('Google Drive Link')); ?></p>
          
                        <p style="font-size: 15px;"><b><?php echo e(__('Openload')); ?>:</b> <?php echo e(__('Openload Link')); ?> </p>
                      </div>
          
                    </div>
                  </div>
                </div>
          
                
                <div id="ready_url" style="<?php echo e($video_link['ready_url'] != '' ? '' : "display: none"); ?>" class="form-group text-dark<?php echo e($errors->has('ready_url') ? ' has-error' : ''); ?>">
                  <label id="ready_url_text"></label>
                  <p class="inline info"> <?php echo e(__('Please Enter Your Video URL')); ?></p>
                  <?php echo Form::text('ready_url',$video_link['ready_url'], ['class' => 'form-control','id'=>'apiUrl']); ?>

                  <small class="text-danger"><?php echo e($errors->first('ready_url')); ?></small>
                </div>
              </div>
              <div class="col-lg-6 col-md-6">
                <div class="form-group text-dark">
                  <label for=""><?php echo e(__('Meta Description')); ?>: </label>
                  <textarea name="description" id="" cols="30" rows="5" class="form-control"><?php echo e($movie->description); ?></textarea>
                </div>
              </div>
              <div class="col-lg-6 col-md-6">
                <div class="form-group text-dark text-dark<?php echo e($errors->has('detail') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('detail', __('Description')); ?><sup class="text-danger">*</sup>
                  <?php echo Form::textarea('detail', null, ['class' => 'form-control materialize-textarea', 'rows' => '5']); ?>

                  <small class="text-danger"><?php echo e($errors->first('detail')); ?></small>
                </div>
              </div>
            </div>
          </div>
          <div class="bg-info-rgba p-4 mb-4 rounded">
            <div class="row">
              <div class="col-lg-4 col-md-4">
                <div class="form-group text-dark<?php echo e($errors->has('featured') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('featured', __('Featured')); ?>

                  <br>
                  <label class="switch">                
                    <?php echo Form::checkbox('featured', 1, $movie->featured, ['class' => 'custom_toggle']); ?>

                    <span class="slider round"></span>
                  </label>
                  <div class="col-xs-12">
                    <small class="text-danger"><?php echo e($errors->first('featured')); ?></small>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-4">
                <div class="form-group text-dark text-dark<?php echo e($errors->has('livetvicon') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('livetvicon', __('Live TV Icon Show')); ?>

                  <br>
                  <label class="switch">                
                    <?php echo Form::checkbox('livetvicon', 1, $movie->livetvicon, ['class' => 'custom_toggle']); ?>

                    <span class="slider round"></span>
                  </label>
                  <div class="col-xs-12">
                    <small class="text-danger"><?php echo e($errors->first('livetvicon')); ?></small>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-4">
                <div class="form-group text-dark<?php echo e($errors->has('is_protect') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('is_protect', __('Protected Video?')); ?>

                  <br>
                  <label class="switch">
                    <input type="checkbox" name="is_protect" class="custom_toggle" id="is_protect" <?php echo e($movie->is_protect == 1 ? 'checked' : ''); ?>>
                    <span class="slider round"></span>
                  </label>
                  <div class="col-xs-12">
                    <small class="text-danger"><?php echo e($errors->first('is_protect')); ?></small>
                  </div>
                </div>
                <div class="search form-group text-dark<?php echo e($errors->has('password') ? ' has-error' : ''); ?> is_protect" style="<?php echo e($movie->is_protect == 1 ? '' : 'display:none'); ?>" >
                  <?php echo Form::label('password', __('Protected Password For Video')); ?>

                  <input type="password" id="password" name="password" class="form-control">
                  <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                  <small class="text-danger"><?php echo e($errors->first('password')); ?></small>
                </div>
              </div>
              <div class="col-lg-8 col-md-8">
                <div class="upload-image-main-block">
                  
                    <div class="row">
                      <div class="col-lg-4 col-md-5 mb-4">
                        <label><?php echo e(__('Thumbnail')); ?></label>
                        <div class="thumbnail-img-block">
                          <?php if(isset($movie->thumbnail) && $movie->thumbnail != NULL): ?>
                          <img src="<?php echo e(url('/images/movies/thumbnails/'.$movie->thumbnail)); ?>" class="img-fluid" alt="">
                        <?php else: ?>
                        <img src="<?php echo e(url('images/default-thumbnail.jpg')); ?>" id="thumbnail" class="img-fluid" alt="">
                        <?php endif; ?>
                        </div>
                        <div class="input-group">
                          <input id="img_upload_input" type="file" name="thumbnail" class="form-control" onchange="readURL(this);" />
                        </div>
                      </div>
                      <div class="col-lg-8 col-md-7 mb-4">
                        <label><?php echo e(__('Posters')); ?></label>
                        <div class="poster-img-block">
                          <?php if(isset($movie->poster) && $movie->poster != NULL): ?>
                            <img src="<?php echo e(url('/images/movies/posters/'.$movie->poster)); ?>" class="img-fluid" alt="">
                          <?php else: ?>
                          <img src="<?php echo e(url('images/default-poster.jpg')); ?>" id="poster" class="img-fluid" alt="">
                          <?php endif; ?>
                        </div>
                        <div class="input-group">
                          <input id="img_upload_input_one" type="file" name="poster" class="form-control" onchange="readURL(this);" />
                        </div>
                      </div>
                      
                    </div>
                  
                </div>
              </div>
              <div class="col-lg-12 col-md-12 permissionTable">
                <div class="menu-block menu-block-input" >
                  <h6 class="menu-block-heading mb-3"><?php echo e(__('Please Select Menu')); ?></h6><sup class="text-danger">*</sup>
                  
                  <?php if(isset($menus) && count($menus) > 0): ?>
                  <div class="row">
                    <div class="col-lg-3 col-md-6">
                      <div class="row">
                        <div class="col-lg-4 col-md-8 col-6">
                          <?php echo e(__('All Menus')); ?>

                        </div>
                        <div class="col-lg-8 col-md-4 col-6 pad-0">
                          <div class="inline">
                            <input type="checkbox" class="grand_selectallm grand_selectallm filled-in material-checkbox-input all" name="menu[]" value="100" id="checkbox<?php echo e(100); ?>" >
                            <label for="checkbox<?php echo e(100); ?>" class="material-checkbox"></label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-3 col-md-6">
                      <div class="row">
                        <div class="col-lg-4 col-md-8 col-6">
                          <?php echo e($menu->name); ?>

                        </div>
                        <?php
                        $checked = null;
                        if (isset($menu->menu_data) && count($menu->menu_data) > 0) {
                          if ($menu->menu_data->where('movie_id', $movie->id)->where('menu_id', $menu->id)->first() != null) {
                            $checked = 1;
                          }
                        }
                        ?>
                        <div class="col-lg-8 col-md-4 col-6 pad-0">
                          <div class="inline">
                            <?php if($checked == 1): ?>
                            <input type="checkbox" class="permissioncheckbox filled-in material-checkbox-input" name="menu[]" value="<?php echo e($menu->id); ?>" id="checkbox<?php echo e($menu->id); ?>" checked>
                            <label for="checkbox<?php echo e($menu->id); ?>" class="material-checkbox"></label>
                            <?php else: ?>
                            <input type="checkbox" class=" permissioncheckbox filled-in material-checkbox-input" name="menu[]" value="<?php echo e($menu->id); ?>" id="checkbox<?php echo e($menu->id); ?>">
                            <label for="checkbox<?php echo e($menu->id); ?>" class="material-checkbox"></label>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                  <?php endif; ?>
                </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group text-dark text-dark ">
                <button type="submit" class="btn btn-primary-rgba" title="<?php echo e(__('Update')); ?>"><i class="fa fa-check-circle"></i>
                  <?php echo e(__('Update')); ?></button>
              </div>
            </div>
          </div>                
          <?php echo Form::close(); ?>

          <div class="clear-both"></div>
      </div>
    </div>
  </div>
</div>
<!-- Add Language Modal -->
<div id="AddLangModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?php echo e(__('Add Language')); ?></h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <?php echo Form::open(['method' => 'POST', 'action' => 'AudioLanguageController@store']); ?>

      <div class="modal-body">
        <div class="form-group text-dark text-dark<?php echo e($errors->has('language') ? ' has-error' : ''); ?>">
          <?php echo Form::label('language', __('Language')); ?>

          <?php echo Form::text('language', null, ['class' => 'form-control', 'required' => 'required']); ?>

          <small class="text-danger"><?php echo e($errors->first('language')); ?></small>
        </div>
      </div>
      <div class="modal-footer">
        <div class="btn-group pull-right">
          <button type="reset" class="btn btn-success-rgba" title="<?php echo e(__('Reset')); ?>"><?php echo e(__('Reset')); ?></button>
          <button type="submit" class="btn btn-primary-rgba" title="<?php echo e(__('Create')); ?>"><?php echo e(__('Create')); ?></button>
        </div>
      </div>
      <?php echo Form::close(); ?>

    </div>
  </div>
</div>
<!-- Add Genre Modal -->
<div id="AddGenreModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?php echo e(__('Add Genre')); ?></h5>
        <button type="button" class="close" data-dismiss="modal" title="<?php echo e(__('Close')); ?>">&times;</button>
      </div>
      <?php echo Form::open(['method' => 'POST', 'action' => 'GenreController@store']); ?>

      <div class="modal-body admin-form-block">
        <div class="form-group text-dark text-dark<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
          <?php echo Form::label('name',__('Name')); ?>

          <?php echo Form::text('name', null, ['class' => 'form-control', 'required' => 'required']); ?>

          <small class="text-danger"><?php echo e($errors->first('name')); ?></small>
        </div>
      </div>
      <div class="modal-footer">
        <div class="btn-group pull-right">
          <button type="reset" class="btn btn-success-rgba" title="<?php echo e(__('Reset')); ?>"> <?php echo e(__('Reset')); ?></button>
          <button type="submit" class="btn btn-primary-rgba" title="<?php echo e(__('Create')); ?>"> <?php echo e(__('Create')); ?></button>
        </div>
      </div>
      <div class="clear-both"></div>
      <?php echo Form::close(); ?>

    </div>
  </div>
</div>
<?php $__env->stopSection(); ?> 
<?php $__env->startSection('script'); ?><script>
  $(document).ready(function(){
   
    $('#selecturl').change(function(){  
     selecturl = document.getElementById("selecturl").value;
     if (selecturl == 'iframeurl') {
    $('#ifbox').show();
       $('#subtitle_section').hide();
    $('#uploadvideo').hide();
    $('#ready_url').hide();
    


  }else if (selecturl == 'uploadvideo') {
   $('#uploadvideo').show();
      $('#subtitle_section').show();
   $('#ready_url').hide();
   $('#ifbox').hide();
   

 }else if(selecturl=='customurl'){
       $('#ifbox').hide();
       $('#uploadvideo').hide();
       $('#ready_url').show();
          $('#subtitle_section').hide();
          
       $('#ready_url_text').text('Enter Custom URL or Vimeo or Youtube URL');
   }
    else if (selecturl == 'youtubeapi') {
   $('#uploadvideo').hide();
   $('#ready_url').show();
      $('#subtitle_section').hide();
  
   $('#ifbox').hide();
   $('#ready_url_text').text('Import From Youtube API');

 }else if(selecturl=='vimeoapi'){
   $('#ifbox').hide();
   $('#uploadvideo').hide();
   $('#ready_url').show();
      $('#subtitle_section').hide();
  
   $('#ready_url_text').text('Import From Vimeo API');

 }

});
    var i= 1;
    $('#add').click(function(){  
     i++;  
     $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="file" name="sub_t[]"/></td><td><input type="text" name="sub_lang[]" placeholder="Subtitle Language" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn-sm btn_remove">X</button></td></tr>');  
   });

    $(document).on('click', '.btn_remove', function(){  
     var button_id = $(this).attr("id");   
     $('#row'+button_id+'').remove();  
   });  

   
    <?php if($movie->tmdb == 'N'): ?>
    $('#custom_dtl').show();
    <?php endif; ?>
    <?php if($movie->subtitle == 0): ?>
    $('.subtitle_list').hide();
    $('#subtitle-file').hide();
    <?php endif; ?> 
    <?php if($movie->series == 0): ?>
    $('.movie_id').hide();
    <?php endif; ?>
    $('input[name="subtitle"]').click(function(){
     if($(this).prop("checked") == true){
       $('.subtitle_list').fadeIn();
       $('#subtitle-file').fadeIn();
     }
     else if($(this).prop("checked") == false){
      $('.subtitle_list').fadeOut();
      $('#subtitle-file').fadeOut();
    }
  });
  $('input[name="is_protect"]').click(function(){
    if($(this).prop("checked") == true){
      $('.is_protect').fadeIn();
    }
    else if($(this).prop("checked") == false){
      $('.is_protect').fadeOut();
    }
  });
   
  });
</script>


<script>
        $(document).ready(function() {
           var videourl;
            vimeoApiCall();
            $("#vpageTokenNext").on( "click", function( event ) {
                $("#vpageToken").val($("#vpageTokenNext").val());
                vimeoApiCall();
            });
            $("#vpageTokenPrev").on( "click", function( event ) {
                $("#vpageToken").val($("#vpageTokenPrev").val());
                vimeoApiCall();
            });
            $("#vimeo-searchBtn").on( "click", function( event ) {
                vimeoApiCall();
                return false;
            });
            jQuery( "#vimeo-search" ).autocomplete({
              source: function( request, response ) {
                //console.log(request.term);
                var sqValue = [];
                var accesstoken='<?php echo e(env('VIMEO_ACCESS')); ?>';
                var myvimeourl='https://api.vimeo.com/videos?query=videos'+'&access_token=' + accesstoken +'&per_page=1';
                console.log(myvimeourl);
                jQuery.ajax({
                    type: "GET",
                    url: myvimeourl,
                    dataType: 'jsonp',
                    
                    success: function(data){
                        console.log(data[1]);
                        obj = data[1];
                        jQuery.each( obj, function( key, value ) {
                            sqValue.push(value[0]);
                        });
                        response( sqValue);
                    }
                });
              },
              select: function( event, ui ) {
                setTimeout( function () { 
                    vimeoApiCall();
                }, 300);
              }
            });  
        });
function vimeoApiCall(){
  console.log('yeah i am here');
    var accesstoken='<?php echo e(env('VIMEO_ACCESS')); ?>';
    var text=$("#vimeo-search").val();
   var next=  $("#vpageTokenNext").val();
   console.log('jxhh'+next);
   var prev= $("#vpageTokenPrev").val();
    var myvimeourl=null;
   if (next != null && next !='') {
     myvimeourl='https://api.vimeo.com'+next;
   }else if (prev != null && prev !='') {
       myvimeourl='https://api.vimeo.com'+prev;
   }else{
       myvimeourl='https://api.vimeo.com/videos?query='+ text + '&access_token=' + accesstoken+'&per_page=5';
   }
  
   console.log('url'+myvimeourl);
    $.ajax({
        cache: false,
     
        dataType: 'json',
        type: 'GET',
       
        url: myvimeourl,

    })
    .done(function(data) {
      console.log(data);
    // alert('duhjf');
        if ( data.paging.previous === null) {$("#vpageTokenPrev").hide();}else{$("#vpageTokenPrev").show();}
        if ( data.paging.next === null) {$("#vpageTokenNext").hide();}else{$("#vpageTokenNext").show();}
        var items = data.data, videoList = "";
     
        $("#vpageTokenNext").val(data.paging.next);
        $("#vpageTokenPrev").val(data.paging.previous);
        console.log(items);
        $.each(items, function(index,e) {
             
             videourl=e.link;
               // console.log(videourl);
            videoList = videoList 
            + '<li class="hyv-video-list-item" ><div class="hyv-thumb-wrapper"><p class="hyv-thumb-link"><span class="hyv-simple-thumb-wrap"><img alt="'+e.name+'" src="'+e.pictures.sizes[3].link+'" height="90"></span></p></div><div class="hyv-content-wrapper"><p  class="hyv-content-link">'+e.name+'<span class="title">'+e.description.substr(0, 105)+'</span><span class="stat attribution">by <span>'+e.user.name+'</span></span></p><button class="bn btn-info btn-sm inline" onclick=setVideovimeoURl("'+videourl+'")>Add</button></div></li>';
              
          
        });

        $("#vimeo-watch-related").html(videoList);
       
    });

}
</script>
<script>
  $('#movi_id').on('change',function(){
    if ($('#movi_id').is(':checked')){

      $('#txt2').text("Movie Created By Title:");
      $('#mv_t').removeAttr('readonly','readonly');
      $('#mv_i').attr('readonly','readonly');

    }else{
     $('#mv_i').removeAttr('readonly','readonly');
     $('#mv_t').attr('readonly','readonly');
     $('#txt2').text("Movie Created By ID:");
   }
 });

 
</script>


<script>
        $(document).ready(function() {
           var videourl;
            youtubeApiCall();
            $("#pageTokenNext").on( "click", function( event ) {
                $("#pageToken").val($("#pageTokenNext").val());
                youtubeApiCall();
            });
            $("#pageTokenPrev").on( "click", function( event ) {
                $("#pageToken").val($("#pageTokenPrev").val());
                youtubeApiCall();
            });
            $("#hyv-searchBtn").on( "click", function( event ) {
                youtubeApiCall();
                return false;
            });
            jQuery( "#hyv-search" ).autocomplete({
              source: function( request, response ) {
                //console.log(request.term);
                var sqValue = [];
                jQuery.ajax({
                    type: "POST",
                    url: "http://suggestqueries.google.com/complete/search?hl=en&ds=yt&client=youtube&hjson=t&cp=1",
                    dataType: 'jsonp',
                    data: jQuery.extend({
                        q: request.term
                    }, {  }),
                    success: function(data){
                        console.log(data[1]);
                        obj = data[1];
                        jQuery.each( obj, function( key, value ) {
                            sqValue.push(value[0]);
                        });
                        response( sqValue);
                    }
                });
              },
              select: function( event, ui ) {
                setTimeout( function () { 
                    youtubeApiCall();
                }, 300);
              }
            });  
        });
function youtubeApiCall(){
    $.ajax({
        cache: false,
        data: $.extend({
            key: '<?php echo e(env('YOUTUBE_API_KEY')); ?>',
            q: $('#hyv-search').val(),
            part: 'snippet'
        }, {maxResults:15,pageToken:$("#pageToken").val()}),
        dataType: 'json',
        type: 'GET',
        timeout: 5000,
        url: 'https://www.googleapis.com/youtube/v3/search'
    })
    .done(function(data) {
        if (typeof data.prevPageToken === "undefined") {$("#pageTokenPrev").hide();}else{$("#pageTokenPrev").show();}
        if (typeof data.nextPageToken === "undefined") {$("#pageTokenNext").hide();}else{$("#pageTokenNext").show();}
        var items = data.items, videoList = "";
        $("#pageTokenNext").val(data.nextPageToken);
        $("#pageTokenPrev").val(data.prevPageToken);
        // console.log(items);
        $.each(items, function(index,e) {
             
             videourl="https://www.youtube.com/watch?v="+e.id.videoId;
               console.log(videourl);
            videoList = videoList 
            + '<li class="hyv-video-list-item" ><div class="hyv-content-wrapper"><p  class="hyv-content-link" title="'+e.snippet.title+'"><span class="title">'+e.snippet.title+'</span><span class="stat attribution">by <span>'+e.snippet.channelTitle+'</span></span></p><button class="bn btn-info btn-sm inline" onclick=setVideoURl("'+videourl+'")>Add</button></div><div class="hyv-thumb-wrapper"><p class="hyv-thumb-link"><span class="hyv-simple-thumb-wrap"><img alt="'+e.snippet.title+'" src="'+e.snippet.thumbnails.default.url+'" height="90"></span></p></div></li>';
              
          
        });

        $("#hyv-watch-related").html(videoList);
       
    });
}
    </script>
<script type="text/javascript">
  function setVideoURl(videourls){
    console.log(videourls);
  $('#apiUrl').val(videourls); 
    $('#myyoutubeModal').modal("hide");
  }
</script>
<script type="text/javascript">
  function setVideovimeoURl(videourls){
    console.log(videourls);
  $('#apiUrl').val(videourls); 
    $('#myvimeoModal').modal("hide");
  }
</script>
<script type="text/javascript">
  $(document).ready(function(){ 
    $('#selecturl').change(function() {
     $('#apiUrl').val('');  
        var opval = $(this).val(); //Get value from select element
        if(opval=="youtubeapi"){ //Compare it and if true
            $('#myyoutubeModal').modal("show"); //Open Modal
        }
        if(opval=="vimeoapi"){ //Compare it and if true
            $('#myvimeoModal').modal("show"); //Open Modal
        }
    });
});
</script>
<script type="text/javascript">
    $(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/admin/livetv/edit.blade.php ENDPATH**/ ?>