<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['href', 'icon', 'text', 'progress' => false]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['href', 'icon', 'text', 'progress' => false]); ?>
<?php foreach (array_filter((['href', 'icon', 'text', 'progress' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<div class="my-2">
    <a href="<?php echo e($href); ?>" class="button">
        <span class="icon"><i class="<?php echo e($icon); ?>"></i></span>
        <div class="text"><?php echo e($text); ?></div>
        <?php if($progress !== false): ?>
            <div class="progress">
              <div class="progress-bar" style="width: <?php echo e($progress); ?>%"><?php echo e($progress); ?>%</div>
            </div>
        <?php endif; ?>
    </a>
</div>

  <style>

  .button {
    display: inline-block;
    width: 180px;
    height: 150px;
    margin: 10px;
    background-color: rgb(216, 228, 227);
    border: 1px dotted rgb(22, 66, 22);
    border-radius: 1rem;
    padding: 0.5rem;
    text-align: center;
    transition: background-color 0.3s ease;
  }

  .button:hover {
    background-color: rgb(192,192,192);
    color: #fff;
  }

  .button .icon {
    font-size: 3rem;
    color: rgb(22, 66, 22);
  }

  .button .text {
    font-size: 1rem;
    font-weight: bold;
    color: rgb(22, 66, 22);
    margin-bottom: 1rem;
  }

  .progress {
    width: 100%;
    height: 1rem;
    background-color: #808b89;
    border-radius: 0.5rem;
    overflow: hidden;
  }

  .progress-bar {
    height: 100%;
    font-size: 0.75rem;
    font-weight: bold;
    color: #fff;
    background-color: rgb(22, 66, 22);
    transition: width 0.3s ease;
  }



  @media (max-width: 600px) {
    .button {
      width: 120px;
      height: 100px;
    }


     .button .icon {
    font-size: 1rem;

  }

  .button .text {
    font-size: .75rem;

  }

  .progress {
    width: 100%;
    height: 1rem;
  }

  .progress-bar {
    height: 100%;
    font-size: 0.65rem;

  }
  }


  </style>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/components/status-icon.blade.php ENDPATH**/ ?>