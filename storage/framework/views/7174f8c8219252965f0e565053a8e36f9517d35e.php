<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['links' => []]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['links' => []]); ?>
<?php foreach (array_filter((['links' => []]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<aside class="sidebar">
    <button class="sidebar-toggle">
        <i class="fa fa-bars"></i>
    </button>
    <ul class="nav flex-column">
        <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="nav-item">
                <a href="<?php echo e($link['href']); ?>" class="nav-link">
                    <i class="<?php echo e($link['icon']); ?>"></i>
                    <span><?php echo e($link['label']); ?></span>
                </a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</aside>

<style>
    .sidebar {
    position: fixed;
    top: 50px;
    left: -250px;
    max-height: 100%;
    width: 250px;
    background-color: rgb(5,23,21);
    transition: all 0.3s ease-in-out;
    margin-top: 5.5rem;
}

@media (max-width: 600px) {
    .sidebar {
    height: 100vh;
}}

.sidebar.show {
    left: 0;
}

.sidebar-toggle {
    position: fixed;
    margin-top: 3.5rem;
    top: 20px;
    left: 10px;
    height: 60px;
    width: 50px;
    background-color: none;
    border: none;
    color: rgb(5,23,21);
    font-size: 20px;
    cursor: pointer;
    transition: transform 0.3s ease-in-out;
}

.sidebar-toggle.clicked i {
  transform: scale(1.3);;
  color: rgb(5,23,21);
}

.sidebar-toggle i {
  font-size: 40px;
}

.nav {
    padding: 20px;
}

.nav-link {
    display: flex;
    align-items: center;
    color: white;
    text-decoration: none;
    font-size: 16px;
    margin-bottom: 10px;
}

.nav-link i {
    margin-right: 10px;
}

</style>

<script>
    const sidebar = document.querySelector('.sidebar');
    const toggleButton = document.querySelector('.sidebar-toggle');

    toggleButton.addEventListener('click', () => {
      sidebar.classList.toggle('show');
    });

    window.addEventListener('scroll', () => {
      if (sidebar.classList.contains('show')) {
        sidebar.classList.toggle('show');
      }
    });

    const sidebarToggle = document.querySelector('.sidebar-toggle');

    window.addEventListener('scroll', () => {
      if (window.scrollY > 40) {
        sidebarToggle.style.display = 'none';
      } else {
        sidebarToggle.style.display = 'block';
      }
    });

    sidebarToggle.addEventListener('click', () => {
      sidebarToggle.classList.add('clicked');
      setTimeout(() => {
        sidebarToggle.classList.remove('clicked');
      }, 200); // Change 300 to match the transition duration (in milliseconds)
    });
</script>


<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/components/sidebar-menu.blade.php ENDPATH**/ ?>