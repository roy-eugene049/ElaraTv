
<?php $__env->startSection('title',__('All Tv Series')); ?>
<?php $__env->startSection('breadcum'); ?>
	<div class="breadcrumbbar">
                <h4 class="page-title"><?php echo e(__('All Tv Series')); ?></h4>
                <div class="breadcrumb-list">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
                      <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Tv Series')); ?></li>
                    </ol>
                </div> 
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('maincontent'); ?>
<div class="contentbar permissionTable"> 
  <div class="row">
    <div class="col-md-12">
      <div class="card-header movie-create-heading">
        <div class="row">
          <div class="col-lg-4 col-4 col-md-3">
            <h5 class="card-title"><?php echo e(__('All Tv Series')); ?>

                 <input class="grand_selectallm ml-3" type="checkbox">
                                        <?php echo e(__('Select All')); ?></h5></h5>
          </div>
          <div class="col-lg-8 col-8 col-md-9">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tvseries.delete')): ?>
              <button type="button" class="float-right btn btn-danger-rgba mr-2 " data-toggle="modal"
              data-target="#bulk_delete"><i class="feather icon-trash mr-2"></i> <?php echo e(__('Delete Selected')); ?> </button>
            <?php endif; ?>

            <?php if(Session::has('changed_language')): ?>
            <a href="<?php echo e(route('tmdb_tv_translate')); ?>" class="float-right btn btn-warning-rgba mr-2"><i
                class="fa fa-language"></i><?php echo e(__('Translate All To')); ?> <?php echo e(Session::get('changed_language')); ?> </a>
            <?php endif; ?>
            <button type="button" class="float-right btn btn-success-rgba mr-2 mb-2" data-toggle="modal"
            data-target=".bd-example-modal-lg"><i class="fa fa-file-excel-o mr-2"></i> <?php echo e(__('Import Tv Series')); ?> </button>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tvseries.create')): ?>
            <a href="<?php echo e(route('tvseries.create')); ?>" class="float-right btn btn-primary-rgba mr-2 mb-2"><i
                class="feather icon-plus mr-2"></i><?php echo e(__('Add Tv Series')); ?> </a>
            <?php endif; ?>

            
            <div id="bulk_delete" class="delete-modal modal fade" role="dialog">
              <div class="modal-dialog modal-sm">
                  <!-- Modal content-->
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close"
                              data-dismiss="modal">&times;</button>
                          <div class="delete-icon"></div>
                      </div>
                      <div class="modal-body text-center">
                          <h4 class="modal-heading"><?php echo e(__('Are You Sure ?')); ?></h4>
                          <p><?php echo e(__('Do you really want to delete selected item names here? This
                              process
                              cannot be undone.')); ?></p>
                      </div>
                      <div class="modal-footer">
                        <?php echo Form::open(['method' => 'POST', 'action' => 'TvSeriesController@bulk_delete', 'id' => 'bulk_delete_form']); ?>

                              <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal"><?php echo e(__('No')); ?></button>
                              <button type="submit" class="btn btn-danger"><?php echo e(__('Yes')); ?></button>
                          <?php echo Form::close(); ?>

                      </div>
                  </div>
              </div>
            </div>
            

            
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleLargeModalLabel"><?php echo e(__("Bulk Import Tv Series")); ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                          <div class="col-md-12">
                              <div class="card-header">
                                  <a href="<?php echo e(url('files/Tvseries.xlsx')); ?>" class="float-right btn btn-success-rgba mr-2"><i
                                      class="fa fa-file-excel-o mr-2"></i><?php echo e(__('Download Example xls/csv File')); ?></a>
                              </div>
                          </div>
            
                          <div class="card-header">
                              <h6 class="card-title"><?php echo e(__('Choose your xls/csv File :')); ?></h6>
                              <form action="<?php echo e(url('/admin/import/tv-series')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="form-group<?php echo e($errors->has('file') ? ' has-error' : ''); ?> input-file-block col-md-12">
                                  <?php echo Form::file('file', ['class' => 'input-file', 'id'=>'file']); ?>

                                  <label for="file" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="<?php echo e(__('Choose your xls/csv File')); ?>">
                                    <i class="icon fa fa-check"></i>
                                    <span class="js-fileName"><?php echo e(__('Choose A File')); ?></span>
                                  </label>
                                  <small class="text-danger"><?php echo e($errors->first('file')); ?></small>
              
                                  <button type="submit" class="float-right btn btn-danger-rgba mr-2 "><i class="feather icon-plus mr-2"></i> <?php echo e(__('Import')); ?> </button>
                                </div>
                                  
                              </form>
                          </div> 
                          
                      <div class="modal-body">
                          <div class="box box-danger">
                              <div class="box-header">
                                <div class="box-title"><?php echo e(__('Instructions')); ?></div>
                              </div>
                              <div class="box-body table-responsive">
                                <h6><b><?php echo e(__('Follow the instructions carefully before importing the file.')); ?></b></h6>
                                <small><?php echo e(__('The columns of the file should be in the following order.')); ?></small>
                                <table class="table table-striped table-bordered">
                                  <thead>
                                    <tr>
                                      <th><?php echo e(__('Column No')); ?></th>
                                      <th><?php echo e(__('Column Name')); ?></th>
                                      <th><?php echo e(__('Required')); ?></th>
                                      <th><?php echo e(__('Description')); ?></th>
                                    </tr>
                                  </thead>
                
                                  <tbody>
                                    <tr>
                                      <td>1</td>
                                      <td><b><?php echo e(__('title')); ?></b></td>
                                      <td><b><?php echo e(__('Yes')); ?></b></td>
                                      <td><?php echo e(__('Enter tvseries title / name')); ?></td>
                                    </tr>
                                    <tr>
                                      <td>2</td>
                                      <td> <b><?php echo e(__('keyword')); ?></b> </td>
                                      <td><b><?php echo e(__('No')); ?></b></td>
                                      <td><?php echo e(__("Enter tvseries meta keywords")); ?></td>
                                    </tr>
                                    <tr>
                                      <td>3</td>
                                      <td> <b><?php echo e(__('description')); ?></b> </td>
                                      <td><b><?php echo e(__('No')); ?></b></td>
                                      <td><?php echo e(__("Enter tvseries meta description")); ?></td>
                                    </tr>
                                    <tr>
                                      <td>4</td>
                                      <td> <b><?php echo e(__('thumbnail')); ?></b> </td>
                                      <td><b><?php echo e(__('No')); ?></b></td>
                                      <td><?php echo e(__('Name your image eg: example.jpg')); ?> <b><?php echo e(__('(Image can be uploaded using Media Manager / tvseries / thumbnail Tab.)')); ?></b></td>
                                    </tr>
                                    <tr>
                                      <td>5</td>
                                      <td> <b><?php echo e(__('poster')); ?></b> </td>
                                      <td><b><?php echo e(__('No')); ?></b></td>
                                      <td><?php echo e(__('Name your image eg: example.jpg')); ?> <b><?php echo e(__('(Image can be uploaded using Media Manager / tvseries / poster Tab.)')); ?></b></td>
                                    </tr>
                                    <tr>
                                      <td>6</td>
                                      <td> <b><?php echo e(__('genre_id')); ?></b> </td>
                                      <td><b><?php echo e(__('Yes')); ?></b></td>
                                      <td><?php echo e(__("Multiple genre id can be pass here seprate by comma .")); ?></td>
                                    </tr>
                                    <tr>
                                      <td>7</td>
                                      <td> <b><?php echo e(__('detail')); ?></b> </td>
                                      <td><b><?php echo e(__('No')); ?></b></td>
                                      <td><?php echo e(__("Enter tvseries detail")); ?></td>
                                    </tr>
                                    <tr>
                                      <td>8</td>
                                      <td> <b><?php echo e(__('rating')); ?></b> </td>
                                      <td><b><?php echo e(__('No')); ?></b></td>
                                      <td><?php echo e(__("Enter tvseries rating")); ?></td>
                                    </tr>
                
                                  
                                    <tr>
                                      <td>9</td>
                                      <td> <b><?php echo e(__('maturity_rating')); ?></b> </td>
                                      <td><b><?php echo e(__('No')); ?></b></td>
                                      <td><?php echo e(__("Enter tvseries maturity ratings (please wirte one of these :-  all age , 13+, 16+ or 18+)")); ?></b></td>
                                    </tr>
                                  
                                  
                                    <tr>
                                      <td>10</td>
                                      <td> <b><?php echo e(__('featured')); ?></b> </td>
                                      <td><b><?php echo e(__('No')); ?></b></td>
                                      <td><?php echo e(__("tvseries featured (1 = enabled, 0 = disabled)")); ?></b></td>
                                    </tr>
                                  
                                    
                                    <tr>
                                      <td>11</td>
                                      <td> <b><?php echo e(__('menu')); ?></b> </td>
                                      <td><b><?php echo e(__('Yes')); ?></b></td>
                                      <td><?php echo e(__("Multiple menu id can be pass here seprate by comma .")); ?></td>
                                    </tr>
              
                                    <tr>
                                      <td>12</td>
                                      <td> <b><?php echo e(__('is_upcoming')); ?></b> </td>
                                      <td><b><?php echo e(__('No')); ?></b></td>
                                      <td><?php echo e(__('upcoming tvseries (1 = enabled, 0 = disabled)')); ?></td>
                                    </tr>
                                    <tr>
                                      <td>13</td>
                                      <td> <b><?php echo e(__('upcoming_date')); ?></b> </td>
                                      <td><b><?php echo e(__('No')); ?></b></td>
                                      <td><?php echo e(__('If is_upcoming = 1 , then the pass upcoming date here')); ?></b></td>
                                    </tr>
                
                                    <tr>
                                      <td>14</td>
                                      <td> <b><?php echo e(__('is_custom_label')); ?></b> </td>
                                      <td><b><?php echo e(__('No')); ?></b></td>
                                      <td><?php echo e(__("custom label (1 = enabled, 0 = disabled)")); ?></b></td>
                                    </tr>
                
                                    <tr>
                                      <td>15</td>
                                      <td> <b><?php echo e(__('label_id')); ?></b> </td>
                                      <td><b><?php echo e(__('No')); ?></b></td>
                                      <td><?php echo e(__("If is_custom_label = 1 , then the pass label id here")); ?></b></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                      </div>
                  </div>
              </div>
            </div>
            
          </div>
        </div> 
      </div>

      <div class="card-body">
        <section id="movies" class="movies-main-block tv-series-main-block">
            <div class="row">
              <?php if(isset($tv_serieses) && count($tv_serieses) > 0): ?>
              <?php $__currentLoopData = $tv_serieses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                if($item->thumbnail != NULL){
                  $content = @file_get_contents(public_path() .'/images/tvseries/thumbnails/' . $item->thumbnail); 
                  if($content){
                    $image = public_path() .'/images/tvseries/thumbnails/' . $item->thumbnail;
                  }else{
                    $image = Avatar::create($item->title)->toBase64();
                  }
                }else{
                  $image = Avatar::create($item->title)->toBase64();
                }
    
                $imageData = base64_encode(@file_get_contents($image));
                if($imageData){
                    $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                } 
              ?>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <input class="permissioncheckbox form-check-card-input visibility-visible" form="bulk_delete_form" type="checkbox" value="<?php echo e($item->id); ?>" id="checkbox<?php echo e($item->id); ?>" name="checked[]">         
                    <div class="card">
                      <?php if($src != NULL): ?>
                        <img src="<?php echo e($src); ?>" class="card-img-top" alt="...">
                      <?php endif; ?>
                        <div class="overlay-bg"></div>
                        <div class="dropdown card-dropdown">
                            <a class="btn btn-round btn-outline-primary pull-right dropdown-toggle" type="button" id="dropdownMenuButton-<?php echo e($item->id); ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-vertical-"></i></a>
                            <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton-<?php echo e($item->id); ?>">
                              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tvseries.view')): ?>
                              <?php 
                              $ifseason = App\Season::where('tv_series_id', '=', $item->id)->first(); 
                              ?>
                              <?php if(isset($ifseason) && $item->status == 1): ?>
                                <a class="dropdown-item" href="<?php echo e(url('show/detail', $ifseason->season_slug)); ?>" target="__blank"><i class="feather icon-monitor mr-2"></i> <?php echo e(__('Page Preview')); ?></a>      
                              <?php else: ?>
                                <a style="cursor: not-allowed" data-toggle="tooltip" data-original-title="Create a season first or tvseries is not active yet" class="dropdown-item"><i class="feather icon-monitor mr-2"></i>  <?php echo e(__('Page Preview')); ?></a>
                              <?php endif; ?>  
                              <?php endif; ?>
                              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tvseries.create')): ?>                                
                              <a class="dropdown-item" href="<?php echo e(route('tvseries.show', $item->id)); ?>"><i class="fa fa-gear mr-2"></i> <?php echo e(__('Manage Seasons')); ?></a>     
                              <?php endif; ?>
                              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tvseries.edit')): ?>                                
                                <a class="dropdown-item" href="<?php echo e(route('tvseries.edit', $item->id)); ?>"><i class="feather icon-edit mr-2"></i> <?php echo e(__('Edit')); ?></a>     
                              <?php endif; ?>
                              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tvseries.delete')): ?>                                 
                                <a type="button" class="dropdown-item" data-toggle="modal" data-target="#deleteModal<?php echo e($item->id); ?>"><i class="feather icon-trash mr-2"></i>  <?php echo e(__('Delete')); ?></a>
                              <?php endif; ?>
                            </div>
                        </div>
                        <div id="deleteModal<?php echo e($item->id); ?>" class="delete-modal modal fade card-dropdown-modal" role="dialog">
                          <div class="modal-dialog modal-sm">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">×</button>
                                      <div class="delete-icon"></div>
                                  </div>
                                  <div class="modal-body text-center">
                                      <h4 class="modal-heading">Are You Sure ?</h4>
                                      <p>Do you really want to delete these records? This process cannot be undone.</p>
                                  </div>
                                  <div class="modal-footer">
                                    <form method="POST" action="<?php echo e(route("tvseries.destroy", $item->id)); ?>">
                                      <?php echo method_field('DELETE'); ?>
                                      <?php echo csrf_field(); ?>
                                    <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal"><?php echo e(__('No')); ?></button>
                                    <button type="submit" class="btn btn-danger"><?php echo e(__('Yes')); ?></button>
                                    </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                        <div class="card-header">
                          <h5 class="card-title"><?php echo e($item->title); ?></h5>
                        </div>
                        <div class="card-body">
                          <div class="card-block">
                            <h6 class="card-body-sub-heading"><?php echo e(__('Genre')); ?></h6>
                            <?php
                              $genres = collect();
                                if (isset($item->genre_id)){
                                  $genre_list = explode(',', $item->genre_id);
                                  for ($i = 0; $i < count($genre_list); $i++) {
                                    try {
                                      $genre = App\Genre::find($genre_list[$i])->name;
                                      $genres->push($genre);
                                    } catch (Exception $e) {

                                    }
                                  }
                                }
                              ?>
                          <p>
                            <?php if(count($genres) > 0): ?>
                              <?php for($i = 0; $i < count($genres); $i++): ?>
                                <?php if($i == count($genres)-1): ?>
                                  <?php echo e($genres[$i]); ?>

                                <?php else: ?>
                                  <?php echo e($genres[$i]); ?>,
                                <?php endif; ?>
                                <?php endfor; ?>
                            <?php endif; ?>
                          </p>
                        </div>
                            <div class="card-block card-block-ratings">
                                <h6 class="card-body-sub-heading"><?php echo e(__('Ratings')); ?></h6>
                                <?php
                                $rating = ($item->rating)/2;
                                ?>
                                <!-- <div class="stars stars-example-css">
                                    <div class="br-wrapper br-theme-css-stars">
                                        <select id="rating-css"  name="rating" autocomplete="off" style="display: none;">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div> -->
                                <div class="stars stars-example-css">
                                      <?php for($rating = 1; $rating <= 5; $rating++): ?> <?php if($rating<=$item->rating/2): ?>
                                          <i class='fa fa-star' style='color:#506fe4'></i>
                                          <?php else: ?>
                                          <i class='fa fa-star' style='color:#ccc'></i>
                                          <?php endif; ?>
                                      <?php endfor; ?>
                                  </div>
                                <p><?php echo e($item->rating); ?>/10</p>
                            </div>
                            
                            <div class="card-block row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <h6 class="card-body-sub-heading"><?php echo e(__('Created By')); ?></h6>
                                    <?php 
                                    $username = App\User::find($item->created_by);
                                    ?>
                                    <p><?php echo e(isset($username) && $username != NULL ? $username->name :'user deleted'); ?></p>
                                </div>
                                <div class="col-xs-6 col-md-6 col-md-6">
                                    <h6 class="card-body-sub-heading"><?php echo e(__('Status')); ?></h6>
                                    <p class="status-btn">
                                      <?php if(auth()->guard()->check()): ?>
                                      <?php if(Auth::user()->is_assistant == 1): ?>
                                      <?php if($item->status == 1): ?>
                                            <a href="javascript:void();" class='badge badge-pill badge-success'><?php echo e(__('Active')); ?></a>
                                        <?php else: ?>
                                            <a href="javascript:void();" class='badge badge-pill badge-danger'><?php echo e(__('De Active')); ?></a>
                                      <?php endif; ?>
                                      <?php else: ?>
                                      <?php if($item->status == 1): ?>
                                            <a href="<?php echo e(route('quick.movie.status', $item->id)); ?>" class='badge badge-pill badge-success'><?php echo e(__('Active')); ?></a>
                                        <?php else: ?>
                                            <a href="<?php echo e(route('quick.movie.status', $item->id)); ?>" class='badge badge-pill badge-danger'><?php echo e(__('De Active')); ?></a>
                                      <?php endif; ?>
                                      <?php endif; ?>
                                      <?php endif; ?>
                                    </p>
                                </div>
                            </div>              
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-12 pagination-block text-center">
                  <?php echo $tv_serieses->appends(request()->query())->links(); ?>

                </div>
              <?php else: ?>
                <div class="col-md-12 text-center">
                  <h5><?php echo e(__("Let's start :)")); ?></h5>
                  <small><?php echo e(__('Get Started by creating a tvseries! All of your tvseries will be displayed on this page.')); ?></small>
                </div>
              <?php endif; ?>
            </div>
        </section>
      </div>
    </div>
  </div>
</div>
</div>
<?php $__env->stopSection(); ?> 
<?php $__env->startSection('script'); ?>
   
<script src="<?php echo e(url('assets/js/custom/custom-barrating.js')); ?>"></script>
<script>
  $(function(){
    $('#checkboxAll').on('change', function(){
      if($(this).prop("checked") == true){
        $('.material-checkbox-input').attr('checked', true);
      }
      else if($(this).prop("checked") == false){
        $('.material-checkbox-input').attr('checked', false);
      }
    });
  });
</script>

<script>
  $(function () {
    jQuery.noConflict();
    var table = $('#tvTable').DataTable({
        processing: true,
        serverSide: true,
       responsive: true,
       autoWidth: false,
       scrollCollapse: true,
     
       
        ajax: "<?php echo e(route('tvseries.index')); ?>",
        columns: [
            
            {data: 'checkbox', name: 'checkbox',orderable: false, searchable: false},
            {data: 'thumbnail', name: 'thumbnail'},
            {data: 'title', name: 'title'},
            {data: 'rating', name: 'rating',searchable: false},
            {data: 'tmdb', name: 'tmdb',searchable: false},
            {data: 'featured', name: 'featured',searchable: false},
            {data: 'status', name: 'status',searchable: false},
            {data: 'addedby', name: 'addedby',searchable: false},
            {data: 'action', name: 'action',searchable: false}
           
        ],
        dom : 'lBfrtip',
        buttons : [
          'csv','excel','pdf','print'
        ],
        order : [[0,'desc']]
    });
    
  });
</script>
<script>
  $(function(){
    $('#checkboxAll').on('change', function(){
      if($(this).prop("checked") == true){
        $('.material-checkbox-input').attr('checked', true);
      }
      else if($(this).prop("checked") == false){
        $('.material-checkbox-input').attr('checked', false);
      }
    });
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/admin/tvseries/index.blade.php ENDPATH**/ ?>