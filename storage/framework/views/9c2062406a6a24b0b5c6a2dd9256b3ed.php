Hi <?php echo e($user->first); ?>,
<br/><br/>
Thank you for beginning your <?php echo e(config('app.name')); ?> profile! Please complete your profile fully to ensure you get the best results from using <?php echo e(config('app.name')); ?>.
<br/><br/>
You can always log in to your account <a href="<?php echo e(route('login')); ?>">here</a> using <?php echo e($user->email); ?> and the password you set. Or, you can reset your password <a href="<?php echo e(route('password.request')); ?>">here</a>.
<br/><br/>
Thank you!
<br/><br/>
<img src="https://app.meto-intl.org/img/meto-logo-dark.jpeg">
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/mail/welcome.blade.php ENDPATH**/ ?>