Hello <?php echo e($toUser->first); ?>,
<br/><br/>
An admin account has been created for you. You can now manage the <?php echo e($highschool->name); ?> <a href="<?php echo e(route('home')); ?>"><?php echo e(config('app.name')); ?></a> account and invite other colleagues to join you.
<br/><br/>
Please use <a href="<?php echo e(route('password.request')); ?>">this link</a> to reset your password and login! Please use <?php echo e($toUser->email); ?> the first time you login. You can change it later if you'd like to.
<br/><br/>
Welcome to <?php echo e(config('app.name')); ?>. You can reply to this email with any questions or problems and a real person will read it and respond.
<br/><br/>
Thank you!
<img src="https://app.meto-intl.org/img/meto-logo-dark.jpeg">
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/mail/inviteCounselorFromAdmin.blade.php ENDPATH**/ ?>