<?php if($image = @file_get_contents('../public/images/userS/'.$image)): ?>
    <img <?php $__errorArgs = ['photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        src="<?php echo e(url('images/userS/'.$image)); ?>" style="width:7rem;" alt="profilephoto"
        class="img-responsive img-circle" data-toggle="modal"
        data-target="#exampleStandardModal<?php echo e($id); ?>">
<?php else: ?>
<img <?php $__errorArgs = ['photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        src="<?php echo e(Avatar::create($name)->toBase64()); ?>" style="width:7rem;" alt="profilephoto"
        class="img-responsive img-circle" data-toggle="modal"
        data-target="#exampleStandardModal<?php echo e($id); ?>">

<?php endif; ?><?php /**PATH /home3/elaratvc/elaratv.in/resources/views/admin/users/image.blade.php ENDPATH**/ ?>