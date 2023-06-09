
<?php $__env->startSection('title','Currency'); ?>
<?php $__env->startSection('breadcum'); ?>
	<div class="breadcrumbbar">
      <h4 class="page-title"><?php echo e(__('Currency')); ?></h4>
      <div class="breadcrumb-list">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>" title="<?php echo e(__('Dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Currency')); ?></li>
          </ol>
      </div>      
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('maincontent'); ?>

<div class="contentbar"> 
  <div class="row">
      <div class="col-md-12">
          <div class="bg-primary-rgba ml-6 mr-6 mb-6 text-primary">
            <div class="currency-box">
              <form action="<?php echo e(route('currency.exchanges.save')); ?>" method="POST">
                  <?php echo csrf_field(); ?>
                  <div class="form-group">
                    <label class="mb-0"><?php echo e(__('OPEN EXCHANGE RATE KEY')); ?> :  <sup class="text-danger">*</sup></label>
  
                    <small>
                      <a target="__blank" title="Get your keys from here" class="text-primary pull-right"
                        href="https://openexchangerates.org/signup/free" title="Get Your OPEN EXCHANGE RATE
                        KEY From Here"><i class="fa fa-key"></i><?php echo e(__(' Get Your OPEN EXCHANGE RATE KEY From Here')); ?></a>
                    </small>
                    <hr>
                    <div class="row">
                      <div class="col-md-6">
                        <input required id="OPEN_EXCHANGE_RATE_KEY" value="<?php echo e(env('OPEN_EXCHANGE_RATE_KEY')); ?>"
                          name="OPEN_EXCHANGE_RATE_KEY" type="text" class="form-control"
                          placeholder="Enter OPEN EXCHANGE RATE KEY">
                      </div>                    
                      <div class="col-md-6">
                        <div class="form-group">
                          <button type="submit"  class="btn btn-md btn-primary-rgba" title="<?php echo e(__('Save')); ?>">
                                <i class="fa fa-save"></i> <?php echo e(__('Save')); ?>

                          </button>
                        </div>
                      </div>
                    </div>
                      <small class="text-primary">
                        <i class="fa fa-question-circle"></i> <?php echo e(__("It will be used to fetch exchange rates of currenies.")); ?>

                        <br>
                        <i class="fa fa-question-circle"></i> <?php echo e(__("In many countries, the use of a comma or a dot as a decimal separator in currency is determined by local customs and laws. In general, countries that use a comma as a decimal separator also use a dot as a thousands separator, and vice versa.")); ?>

                      </small>
                  </div>
                  
              </form>
          </div>
              
          </div>
      </div>
      <div class="col-md-12 mt-4">
          <div class="card m-b-50">
              <div class="card-header">
          <button type="button"  class="float-right btn btn-success-rgba mr-2"><i class="feather icon-layers mr-2"></i><span id="buttontext"><?php echo e(__('Update Currency Rate')); ?></span></button>
          <button type="button" class="float-right btn btn-primary-rgba mr-2 " data-toggle="modal"
            data-target=".bd-example-modal-md" title="<?php echo e(__('Add New Currency')); ?>"><i class="feather icon-plus mr-2"></i> <?php echo e(__('Add New Currency')); ?> </button>
         
          
              <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleLargeModalLabel"><?php echo e(__("Add New Currency")); ?></h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"  title="<?php echo e(__('Close')); ?>">
                              <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                              
                          <div class="modal-body">
                            <form action="<?php echo e(route("currency.store")); ?>" method="post">
                              <?php echo csrf_field(); ?>
                              <div class="form-group">
                                  <label for="my-input"><?php echo e(__('Currency')); ?> (ISO code 3): <span class="text-danger">*</span> </label>
                                  <input required class="form-control" type="text" name="code">
                              </div>
            
                              <div class="form-group">
                                  <button type="submit" class="btn btn-outline-primary" title="<?php echo e(__('Create')); ?>"><i class="fa fa-plus"></i>
                                      <?php echo e(__("Create")); ?>

                                  </button>
                              </div>
                            </form>
                          </div>
                      </div>
                  </div>
              </div>
          
                  <h5 class="card-title"><?php echo e(__('All Currency')); ?></h5>
                  <h4 class="card-title text-danger"><?php echo e(__('DEFAULT CURRENCY IS')); ?> : <?php echo e(Session::has('changed_language') ? Session::get('changed_language') : ''); ?></h4>
                  
              </div> 

              <div class="card-body">
                  <div class="table-responsive">
                        <table id="currency" class="table table-borderd">

                          <thead>
                              <th> <?php echo e(__('#')); ?></th>
                              <th><?php echo e(__('Name')); ?></th>
                              <th><?php echo e(__('Code')); ?></th>
                              <th><?php echo e(__('Symbol')); ?></th>
                              <th><?php echo e(__('Exchange rate')); ?></th>
                              <th><?php echo e(__("Created at")); ?></th>
                              <th><?php echo e(__("Action")); ?></th>
                          </thead>

                          <tbody>
                              
                          </tbody>
                      </table>                  
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
<?php $__env->stopSection(); ?> 
<?php $__env->startSection('script'); ?>
   
<script>
    

  $(document).ready(function() {
      jQuery.noConflict();
      var table;
      if($.fn.dataTable.isDataTable('#currency')){
        table = $('#currency').DataTable();
      }else{
        table = $('#currency').DataTable({
          lengthChange: false,
          responsive: true,
          serverSide: true,
          ajax: '<?php echo e(route('currency.index')); ?>',
          columns: [

             {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable : false, orderable : false},
            {data : 'name', name : 'currencies.name'},
            {data : 'code', name : 'currencies.code'},
            {data : 'symbol', name : 'currencies.symbol'},
            {data : 'exchange_rate', name : 'currencies.exchange_rate'},
            {data : 'created_at', name : 'currencies.created_at'},
            {data : 'action', name : 'action', searchable : false, orderable : false},
           
          ],
          dom : 'lBfrtip',
          buttons : [
              'csv','excel','pdf','print'
          ],
          order : [[0,'desc']]
        });
      }
        

      table.buttons().container().appendTo('#userstable .col-md-3:eq(0)');
  


      $('.updateRateBtn').on('click',function(){
        $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: '<?php echo e(route("auto.update.rates")); ?>',
            beforeSend: function() {
              $('#buttontext').html('<i class="fa fa-refresh fa-spin fa-fw"></i>');
            },
            success: function(data) {
              table.draw();
              console.log(data);
              $('#msg_div').show();
              $('#res_message').html('');
              $('#res_message').append(data.msg);
              $('#buttontext').html('Update Currency Rate');
              setTimeout(function(){
                  $('#res_message').hide();
                  $('#msg_div').hide();

              },2000);
            
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
              console.log(XMLHttpRequest);
            }
          });
      });
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/admin/currency/index.blade.php ENDPATH**/ ?>