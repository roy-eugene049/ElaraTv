
<?php $__env->startSection('title', __('Social Logins Settings')); ?>
<?php $__env->startSection('breadcum'); ?>
<div class="breadcrumbbar">
  <h4 class="page-title"><?php echo e(__('Social Login Settings')); ?></h4>
  <div class="breadcrumb-list">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>" title="<?php echo e(__('Dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Social Login Settings')); ?></li>
      </ol>
  </div> 
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('maincontent'); ?>
<div class="contentbar">
  	<div class="row">
    	<div class="col-lg-12">
      		<div class="card m-b-50">
        		<div class="card-header">
          			<h5 class="box-title"><?php echo e(__('Social Logins Settings')); ?></h5>
        		</div>
        		<div class="card-body ml-2">
					<?php if($errors->any()): ?>
						<div class="alert alert-danger">
							<ul>
								<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<li><?php echo e($error); ?></li>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</ul>
						</div>
					<?php endif; ?>
					<div class="row">
			
						<?php
							$fb_login_status = App\Config::select('fb_login')->where('id','=',1)->first();
							$google_login_status = App\Config::select('google_login')->where('id','=',1)->first();
							$gitlab_login_status = App\Config::select('gitlab_login')->where('id','=',1)->first();
							$amazon_login_status = App\Config::select('amazon_login')->where('id','=',1)->first();
						?>
      				</div>
    			</div>
				<div class="row mx-2">
					<!-- ======= Facebook Login start ========== -->
					<div class="col-md-6 col-lg-6 col-xl-6 mb-4">
						<div class="bg-info-rgba ml-6 mr-6 mb-6">
							<div class="card-header text-dark"><h5 class="mb-0"><i class="fa fa-facebook mr-2" aria-hidden="true"></i> <?php echo e(__('Facebook Login Setting ')); ?></h5></div>
							<div class="payment-gateway-block">
								<form action="<?php echo e(route('key.facebook')); ?>" method="POST">
									<?php echo e(csrf_field()); ?>

									<div class="row mx-1 mt-3">
										<div class="col-md-12">
											<div class="form-group">
												<label for=""><?php echo e(__('Enable Facebook Login')); ?> </label>
												<input <?php echo e($fb_login_status->fb_login == 1 ? 'checked' : ""); ?> type="checkbox" class="custom_toggle" name="fb_check" id="fb_check">
												<label for="fb_check"></label>
											</div>
										</div>
									</div>
									<div class="row mx-2 my-3" id="fb_box_dtl" style="<?php echo e($fb_login_status->fb_login == 1 ? '' : "display: none"); ?>">
										<div class="col-md-12 mb-3">
											<label for=""><?php echo e(__('Facebook Client ID')); ?></label>
											<input type="text" value="<?php echo e($env_files['FACEBOOK_CLIENT_ID']); ?>" name="FACEBOOK_CLIENT_ID" class="form-control">
										</div>
										
										<div class="col-md-12 mail-password-input mb-3">
											<label for=""><?php echo e(__('Facebook Secret ID')); ?></label>	
											<input type="password" value="<?php echo e($env_files['FACEBOOK_CLIENT_SECRET']); ?>" name="FACEBOOK_CLIENT_SECRET" class="form-control" id="password-field" >
											<span  toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
										</div>
				
										<div class="col-md-12 mb-4">
											<label for=""><?php echo e(__('Facebook Redirect URL')); ?></label>
											<input type="text" placeholder="https://yoursite.com/login/facebook/callback" value="<?php echo e($env_files['FACEBOOK_CALLBACK']); ?>" name="FACEBOOK_CALLBACK" class="form-control">
										</div>
										<div class="col-md-6 col-lg-6 col-xl-12 form-group">
											<button type="submit" class="btn btn-primary-rgba" title="<?php echo e(__('Save')); ?>"><i class="fa fa-check-circle"></i>
												<?php echo e(__('Save')); ?></button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
						<!-- ======= Facebook Login end ========== -->

						<!-- ======= Google Login start ========== -->
						<div class="col-md-6 col-lg-6 col-xl-6 mb-4">
							<div class="bg-info-rgba ml-6 mr-6 mb-6">
								<div class="card-header text-dark"><h5 class="mb-0"><i class="fa fa-google" aria-hidden="true"></i> <?php echo e(__('Google Login Setting ')); ?></h5></div>
								<div class="payment-gateway-block">
									<form action="<?php echo e(route('key.google')); ?>" method="POST">
										<?php echo e(csrf_field()); ?>

										<div class="row mx-1 mt-3">
											<div class="col-md-12">
												<div class="form-group">
													<label for=""><?php echo e(__('Enable Google Login')); ?> </label>
													<input <?php echo e($google_login_status->google_login == 1 ? 'checked' : ""); ?> type="checkbox" class="custom_toggle" name="google_login" id="google_login" >
													<label for="google_login"></label>
												</div>
											</div>
										</div>
										<div class="row mx-2 my-3" id="g_box_detail" style="<?php echo e($google_login_status->google_login == 1 ? '' : "display: none"); ?>">
											<div class="col-md-12 mb-3">
												<label for=""><?php echo e(__('Google Client ID')); ?></label>
												<input type="text" value="<?php echo e($env_files['GOOGLE_CLIENT_ID']); ?>" name="GOOGLE_CLIENT_ID" class="form-control" >
											</div>
											
											<div class="col-md-12 mail-password-input mb-3">
												<label for=""><?php echo e(__('Google Secret ID')); ?></label>
												<input type="text" value="<?php echo e($env_files['GOOGLE_CLIENT_SECRET']); ?>" name="GOOGLE_CLIENT_SECRET" class="form-control" id="password-field2" >
												<span toggle="#password-field2" class="fa fa-fw fa-eye field-icon toggle-password">
											</div>
					
											<div class="col-md-12 mb-4">
												<label for=""><?php echo e(__('GoogleRedirectURL')); ?></label>
												<input type="text" placeholder="https://yoursite.com/login/google/callback" value="<?php echo e($env_files['GOOGLE_CALLBACK']); ?>" name="GOOGLE_CALLBACK" class="form-control"  >
											</div>
											<div class="col-md-6 col-lg-6 col-xl-12 form-group">
												<button type="submit" class="btn btn-primary-rgba" title="<?php echo e(__('Save')); ?>"><i class="fa fa-check-circle"></i>
													<?php echo e(__('Save')); ?></button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- ======= Google Login end ========== -->

						<!-- ======= GITLAB Login start ========== -->
						<div class="col-md-6 col-lg-6 col-xl-6 mb-4">
							<div class="bg-info-rgba ml-6 mr-6 mb-6">
								<div class="card-header text-dark"><h5 class="mb-0"><i class="fa fa-gitlab" aria-hidden="true"></i> <?php echo e(__('GitLab Login Setting ')); ?></h5></div>
								<div class="payment-gateway-block">
									<form action="<?php echo e(route('key.gitlab')); ?>" method="POST">
										<?php echo e(csrf_field()); ?>

										<div class="row mx-1 mt-3">
											<div class="col-md-12">
												<div class="form-group">
													<label for=""><?php echo e(__('Enable GitLab Login')); ?> </label>
													<input <?php echo e($gitlab_login_status->gitlab_login == 1 ? 'checked' : ""); ?> type="checkbox" class="custom_toggle" name="git_lab_check" id="git_lab_check" >
													<label for="git_lab_check"></label>
												</div>
											</div>
										</div>
										<div class="row mx-2 my-3" id="git_lab_box" style="<?php echo e($gitlab_login_status->gitlab_login == 1 ? '' : "display: none"); ?>">
											<div class="col-md-12 mb-3">
												<label for=""><?php echo e(__('GITLAB Client ID')); ?></label>
												<input type="text" value="<?php echo e($env_files['GITLAB_CLIENT_ID']); ?>" name="GITLAB_CLIENT_ID" class="form-control" >
											</div>
											
											<div class="col-md-12 mail-password-input mb-3">
												<label for=""><?php echo e(__('GITLAB Secret ID')); ?></label>
												<input type="password" value="<?php echo e($env_files['GITLAB_CLIENT_SECRET']); ?>" name="GITLAB_CLIENT_SECRET" class="form-control" id="password-field3" >
												<span toggle="#password-field3" class="fa fa-fw fa-eye field-icon toggle-password">
											</div>
					
											<div class="col-md-12 mb-4">
												<label for=""><?php echo e(__('GITLAB Redirect URL')); ?></label>
												<input type="text" placeholder="https://yoursite.com/login/google/callback" value="<?php echo e($env_files['GITLAB_CALLBACK']); ?>" name="GITLAB_CALLBACK" class="form-control">
											</div>
											<div class="col-md-6 col-lg-6 col-xl-12 form-group">
												<button type="submit" class="btn btn-primary-rgba" title="<?php echo e(__('Save')); ?>"><i class="fa fa-check-circle"></i>
													<?php echo e(__('Save')); ?></button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- ======= GITLAB Login end ========== -->

						<!-- ======= Amazon Login start ========== -->
						<div class="col-md-6 col-lg-6 col-xl-6 mb-4">
							<div class="bg-info-rgba ml-6 mr-6 mb-6">
								<div class="card-header text-dark"><h5 class="mb-0"><i class="fa fa-amazon" aria-hidden="true"></i> <?php echo e(__('Amazon Login Setting ')); ?></h5></div>
								<div class="payment-gateway-block">
									<form action="<?php echo e(route('key.amazon')); ?>" method="POST">
										<?php echo e(csrf_field()); ?>

										<div class="row mx-1 mt-3">
											<div class="col-md-12">
												<div class="form-group">
													<label for=""><?php echo e(__('Enable Amazon Login')); ?> </label>
													<input <?php echo e($amazon_login_status->amazon_login == 1 ? 'checked' : ""); ?> type="checkbox" class="custom_toggle" name="amazon_lab_check" id="amazon_lab_check">
													<label for="amazon_lab_check"></label>
												</div>
											</div>
										</div>
										<div class="row mx-2 my-3" id="amazon_lab_box" style="<?php echo e($amazon_login_status->amazon_login == 1 ? '' : "display: none"); ?>">
											<div class="col-md-12 mb-3">
												<label for=""><?php echo e(__('AMAZON LOGIN ID')); ?></label>
												<input type="text" <?php if(isset($env_files['AMAZON_LOGIN_ID'])): ?>value="<?php echo e($env_files['AMAZON_LOGIN_ID']); ?>" <?php endif; ?> name="AMAZON_LOGIN_ID" class="form-control" >
											</div>
											
											<div class="col-md-12 mail-password-input mb-3">
												<label for=""><?php echo e(__('AMAZON Login Secret')); ?></label>
												<input type="password" <?php if(isset($env_files['AMAZON_LOGIN_SECRET'])): ?>value="<?php echo e($env_files['AMAZON_LOGIN_SECRET']); ?>" <?php endif; ?> name="AMAZON_LOGIN_SECRET" class="form-control" id="amazon-password-field3" >
												<span toggle="#amazon-password-field3" class="fa fa-fw fa-eye field-icon toggle-password">
											</div>
					
											<div class="col-md-12 mb-4">
												<label for=""><?php echo e(__('AMAZON Redirect URL')); ?></label>
												<input type="text" placeholder="https://yoursite.com/auth/amazon/callback" <?php if(isset($env_files['AMAZON_LOGIN_REDIRECT'])): ?> value="<?php echo e($env_files['AMAZON_LOGIN_REDIRECT']); ?>" <?php endif; ?> name="AMAZON_LOGIN_REDIRECT" class="form-control">
											</div>
											<div class="col-md-6 col-lg-6 col-xl-12 form-group">
												<button type="submit" class="btn btn-primary-rgba" title="<?php echo e(__('Save')); ?>"><i class="fa fa-check-circle"></i>
													<?php echo e(__('Save')); ?></button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- ======= Amazon Login end ========== -->
				</div>

  			</div>
		</div>
	</div>

  

<?php $__env->stopSection(); ?> 
<?php $__env->startSection('script'); ?>
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
  
  
	
	$(".toggle-password2").click(function() {
  
	$(this).toggleClass("fa-eye fa-eye-slash");
	var input = $($(this).attr("toggle"));
	if (input.attr("type") == "password") {
	  input.attr("type", "text");
	} else {
	  input.attr("type", "password");
	}
  });
  
  
   $('#fb_check').on('change',function(){
	   if ($('#fb_check').is(':checked')){
			 $('#fb_box_dtl').show('fast');
	  }else{
		  $('#fb_box_dtl').hide('fast');
	  }
   });
  
   $('#google_login').on('change',function(){
	   if ($('#google_login').is(':checked')){
			 $('#g_box_detail').show('fast');
	  }else{
		  $('#g_box_detail').hide('fast');
	  }
   });
  
  
   $('#git_lab_check').on('change',function(){
	   if ($('#git_lab_check').is(':checked')){
			 $('#git_lab_box').show('fast');
	  }else{
		  $('#git_lab_box').hide('fast');
	  }
   });
   $('#amazon_lab_check').on('change',function(){
	   if ($('#amazon_lab_check').is(':checked')){
			 $('#amazon_lab_box').show('fast');
	  }else{
		  $('#amazon_lab_box').hide('fast');
	  }
   });
  
  </script>
  <script>
  (function($){
    $.noConflict();    
  })(jQuery);    
</script>  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/admin/sociallogin/index.blade.php ENDPATH**/ ?>