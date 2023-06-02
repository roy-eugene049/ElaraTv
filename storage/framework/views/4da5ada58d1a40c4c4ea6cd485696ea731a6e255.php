
<?php $__env->startSection('title',__('All Tv Chanel')); ?>
<?php $__env->startSection('breadcum'); ?>
	<div class="breadcrumbbar">
                <h4 class="page-title"><?php echo e(__('All TV Chanel')); ?></h4>
                <div class="breadcrumb-list">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>" title="<?php echo e(__('Dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
                      <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Tv Chanel')); ?></li>
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
          <div class="col-lg-4 col-4">
            <h5 class="card-title"><?php echo e(__('All TV Chanel')); ?>

                 <input class="grand_selectallm ml-3" type="checkbox">
                                        <?php echo e(__('Select All')); ?></h5>
          </div>
          <div class="col-lg-8 col-8">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('livetv.delete')): ?>
              <button type="button" class="float-right btn btn-danger-rgba mr-2 " data-toggle="modal"
              data-target="#bulk_delete" title="<?php echo e(__('Delete Selected')); ?>"><i class="feather icon-trash mr-2"></i> <?php echo e(__('Delete Selected')); ?> </button>
            <?php endif; ?>
            
            <button type="button" class="float-right btn btn-success-rgba mr-2 " data-toggle="modal"
            data-target=".bd-example-modal-lg" title="<?php echo e(__('Import TV Chanel')); ?>"><i class="fa fa-file-excel-o mr-2"></i> <?php echo e(__('Import TV Chanel')); ?> </button>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('livetv.create')): ?>
            <a href="<?php echo e(route('livetv.create')); ?>" class="float-right btn btn-primary-rgba mr-2" title="<?php echo e(__('Add Live TV')); ?>"><i
                class="feather icon-plus mr-2"></i><?php echo e(__('Add TV Chanel')); ?> </a>
            <?php endif; ?>

            
            <div id="bulk_delete" class="delete-modal modal fade" role="dialog">
              <div class="modal-dialog modal-sm">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close"
                        data-dismiss="modal" title="<?php echo e(__('Close')); ?>">&times;</button>
                    <div class="delete-icon"></div>
                  </div>
                  <div class="modal-body text-center">
                    <h4 class="modal-heading"><?php echo e(__('Are You Sure ?')); ?></h4>
                    <p><?php echo e(__('Do you really want to delete selected item names here? This
                          process
                          cannot be undone.')); ?></p>
                  </div>
                  <div class="modal-footer">
                    <?php echo Form::open(['method' => 'POST', 'action' => 'MovieController@bulk_delete', 'id' => 'bulk_delete_form']); ?>

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
                    <h5 class="modal-title" id="exampleLargeModalLabel" title="<?php echo e(__('Bulk Import Live Tv')); ?>"><?php echo e(__("Bulk Import Live TV")); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="col-md-12">
                    <div class="card-header">
                      <a href="<?php echo e(url('files/LiveTv.xlsx')); ?>" class="float-right btn btn-success-rgba mr-2"><i
                            class="fa fa-file-excel-o mr-2"></i><?php echo e(__('Download Example xls/csv File')); ?></a>
                    </div>
                  </div>
                  <div class="card-header">
                    <h6 class="card-title"><?php echo e(__('Choose your xls/csv File :')); ?></h6>
                    <form action="<?php echo e(url('/admin/import/live-tv')); ?>" method="POST" enctype="multipart/form-data">
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
                              <td><?php echo e(__('Enter LiveTV title / name')); ?></td>
                            </tr>
      
                            <tr>
                              <td>2</td>
                              <td> <b><?php echo e(__('selecturl')); ?></b> </td>
                              <td><b><?php echo e(__('No')); ?></b></td>
                              <td><?php echo e(__("Enter actor's DOB")); ?></b></td>
                            </tr>
                            <tr>
                              <td>3</td>
                              <td> <b><?php echo e(__('iframeurl')); ?></b> </td>
                              <td><b><?php echo e(__('No')); ?></b></td>
                              <td><?php echo e(__("Enter actor's DOB")); ?></b></td>
                            </tr>
                            <tr>
                              <td>4</td>
                              <td> <b><?php echo e(__('ready_url')); ?></b> </td>
                              <td><b><?php echo e(__('No')); ?></b></td>
                              <td><?php echo e(__("Enter actor's DOB")); ?></b></td>
                            </tr>
                            
                            <tr>
                              <td>5</td>
                              <td> <b><?php echo e(__('a_language')); ?></b> </td>
                              <td><b><?php echo e(__('No')); ?></b></td>
                              <td><?php echo e(__("Multiple a_language id can be pass here separate by comma")); ?></b></td>
                            </tr>
                            <tr>
                              <td>6</td>
                              <td> <b><?php echo e(__('maturity_rating')); ?></b> </td>
                              <td><b><?php echo e(__('No')); ?></b></td>
                              <td><?php echo e(__("Enter movie maturity ratings (please write one of these :-  all age , 13+, 16+ or 18+)")); ?></b></td>
                            </tr>
                            <tr>
                              <td>7</td>
                              <td> <b><?php echo e(__('thumbnail')); ?></b> </td>
                              <td><b><?php echo e(__('No')); ?></b></td>
                              <td><?php echo e(__('Name your image eg: example.jpg')); ?> <b><?php echo e(__('(Image can be uploaded using Media Manager / LiveTV / thumbnail Tab.)')); ?></b></td>
                            </tr>
                            <tr>
                              <td>8</td>
                              <td> <b><?php echo e(__('poster')); ?></b> </td>
                              <td><b><?php echo e(__('No')); ?></b></td>
                              <td><?php echo e(__('Name your image eg: example.jpg')); ?> <b><?php echo e(__('(Image can be uploaded using Media Manager / LiveTV / poster Tab.)')); ?></b></td>
                            </tr>
                            
                            <tr>
                              <td>9</td>
                              <td> <b><?php echo e(__('featured')); ?></b> </td>
                              <td><b><?php echo e(__('No')); ?></b></td>
                              <td><?php echo e(__("LiveTV featured (1 = enabled, 0 = disabled)")); ?></b></td>
                            </tr>
                            <tr>
                              <td>10</td>
                              <td> <b><?php echo e(__('livetvicon')); ?></b> </td>
                              <td><b><?php echo e(__('No')); ?></b></td>
                              <td><?php echo e(__("LiveTV icon (1 = enabled, 0 = disabled)")); ?></b></td>
                            </tr>
                          
                            
                            <tr>
                              <td>11</td>
                              <td> <b><?php echo e(__('keyword')); ?></b> </td>
                              <td><b><?php echo e(__('No')); ?></b></td>
                              <td><?php echo e(__("Enter LiveTV meta keywords")); ?></td>
                            </tr>
                            <tr>
                              <td>12</td>
                              <td> <b><?php echo e(__('description')); ?></b> </td>
                              <td><b><?php echo e(__('No')); ?></b></td>
                              <td><?php echo e(__("Enter LiveTV meta description")); ?></td>
                            </tr>
                            <tr>
                              <td>13</td>
                              <td> <b><?php echo e(__('menu')); ?></b> </td>
                              <td><b><?php echo e(__('Yes')); ?></b></td>
                              <td><?php echo e(__("Multiple menu id can be pass here separate by comma .")); ?></td>
                            </tr>
                          
                            <tr>
                              <td>14</td>
                              <td> <b><?php echo e(__('genre_id')); ?></b> </td>
                              <td><b><?php echo e(__('Yes')); ?></b></td>
                              <td><?php echo e(__("Multiple genre id can be pass here separate by comma .")); ?></td>
                            </tr>
                          
                            <tr>
                              <td>15</td>
                              <td> <b><?php echo e(__('rating')); ?></b> </td>
                              <td><b><?php echo e(__('No')); ?></b></td>
                              <td><?php echo e(__("Enter LiveTV rating")); ?></td>
                            </tr>
                          
                            <tr>
                              <td>16</td>
                              <td> <b><?php echo e(__('detail')); ?></b> </td>
                              <td><b><?php echo e(__('No')); ?></b></td>
                              <td><?php echo e(__("Enter LiveTV detail")); ?></td>
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
        <section id="movies" class="movies-main-block">
          <div class="row">
            <?php if(isset($movies) && count($movies) > 0): ?>
              <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                  if($item->thumbnail != NULL){
                    $content = @file_get_contents(public_path() .'/images/movies/thumbnails/' . $item->thumbnail); 
                    if($content){
                      $image = public_path() .'/images/movies/thumbnails/' . $item->thumbnail;
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
                          <a class="btn btn-round btn-outline-primary pull-right dropdown-toggle" type="button" id="dropdownMenuButton-<?php echo e($item->id); ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="<?php echo e(__('Settings')); ?>"><i class="feather icon-more-vertical-"></i></a>
                          <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton-<?php echo e($item->id); ?>">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('livetv.view')): ?>
                              <a class="dropdown-item" href="<?php echo e(url('movie/detail', $item->slug)); ?>" target="__blank" title="<?php echo e(__('Preview')); ?>"><i class="feather icon-monitor mr-2"></i> <?php echo e(__('Preview')); ?></a>        
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('livetv.edit')): ?>                                
                              <a class="dropdown-item" href="<?php echo e(route('livetv.edit', $item->id)); ?>" title="<?php echo e(__('Edit')); ?>"><i class="feather icon-edit mr-2"></i> <?php echo e(__('Edit')); ?></a>     
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('livetv.delete')): ?>                                 
                              <a type="button" class="dropdown-item" data-toggle="modal" data-target="#deleteModal<?php echo e($item->id); ?>" title="<?php echo e(__('Delete')); ?>"><i class="feather icon-trash mr-2"></i> <?php echo e(__('Delete')); ?></a>
                            <?php endif; ?>
                          </div>
                      </div>
                      <div id="deleteModal<?php echo e($item->id); ?>" class="delete-modal modal fade card-dropdown-modal" role="dialog">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" title="<?php echo e(__('Close')); ?>">×</button>
                                    <div class="delete-icon"></div>
                                </div>
                                <div class="modal-body text-center">
                                    <h4 class="modal-heading"><?php echo e(__('Are You Sure ?')); ?></h4>
                                    <p><?php echo e(__('Do you really want to delete these records? This process cannot be undone.')); ?></p>
                                </div>
                                <div class="modal-footer">
                                  <form method="POST" action="<?php echo e(route("livetv.destroy", $item->id)); ?>">
                                    <?php echo method_field('DELETE'); ?>
                                    <?php echo csrf_field(); ?>
                                  <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal"><?php echo e(__('No')); ?></button>
                                  <button type="submit" class="btn btn-danger"><?php echo e(__('Yes')); ?></button>
                                  </form>
                                </div>
                            </div>
                        </div>
                    </div>
                      <div class="card-body card-header">
                        <h5 class="card-title"><?php echo e($item->title); ?></h5><br>
                      </div>
                      <div class="card-body">
                          <div class="card-block card-block-ratings">
                              <h6 class="card-body-sub-heading"><?php echo e(__('Ratings')); ?></h6>
                              <?php
                              $rating = ($item->rating)/2;
                              ?>
                             
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
                          <div class="card-block">
                            <h6 class="card-body-sub-heading"><?php echo e(__('Description')); ?></h6>
                            <p><?php echo e(str_limit($item->detail,150)); ?></p>
                          </div>             
                      </div>
                  </div>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <div class="col-md-12 pagination-block">
                <?php echo $movies->appends(request()->query())->links(); ?>

              </div>
              <?php else: ?>
              <div class="col-md-12 text-center">
                <h5><?php echo e(__("Let's start :)")); ?></h5>
                <small><?php echo e(__('Get Started by creating a TV Chanel! All of your  TV Chanel will be displayed on this page.')); ?></small>
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/admin/livetv/index.blade.php ENDPATH**/ ?>