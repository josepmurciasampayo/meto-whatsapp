<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['href', 'icon', 'text']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['href', 'icon', 'text']); ?>
<?php foreach (array_filter((['href', 'icon', 'text']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<a href="<?php echo e($href); ?>" class="button">
    <div class="icon"><i class="<?php echo e($icon); ?>"></i></div>
    <div class="text"><?php echo e($text); ?></div>
  </a>

  <style>
  .button {
    display: inline-block;
    width: 220px;
    height: 120px;
    margin: 10px;
    background-color: rgb(216, 228, 227);
    border: 2px dotted rgb(22, 66, 22);
    border-radius: 1rem;
    text-align: center;
    transition: background-color 0.3s ease;
    padding: .5rem;
  }

  .button:hover {
    background-color: rgb(192,192,192);
    color: #fff;
  }

  .button .icon {
    font-size: 3rem;
    color: rgb(22, 66, 22);
    margin-bottom: .5rem;
  }

  .button .text {
    font-size: 1.2rem;
    font-weight: bold;
    color: rgb(22, 66, 22);
  }

  </style>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/components/status-icon-main.blade.php ENDPATH**/ ?>