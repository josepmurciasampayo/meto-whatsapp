<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="pt-5 pb-3">
        <div class="alert alert-danger d-none mb-5" id="errorHolder">
            Something went wrong.
        </div>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.connections-table', [])->html();
} elseif ($_instance->childHasBeenRendered('ur6jmTP')) {
    $componentId = $_instance->getRenderedChildComponentId('ur6jmTP');
    $componentTag = $_instance->getRenderedChildComponentTagName('ur6jmTP');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('ur6jmTP');
} else {
    $response = \Livewire\Livewire::mount('admin.connections-table', []);
    $html = $response->html();
    $_instance->logRenderedChild('ur6jmTP', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>

    <script>
        let deletedConnections = 1

        let approveConnection = (btn) => {
            let connectionId = btn.getAttribute('connection_id')
            // Send the request
            disableButton(btn)
            axios.post('/connections/' + connectionId + '/approve')
                .then(res => {
                    document.querySelector('[connection_id="' + connectionId + '"]').parentElement.parentElement.parentElement.parentElement.remove()
                    deletedConnections += 1
                }).catch(err => {
                    document.querySelector('#errorHolder').classList.remove('d-none')
                }).finally(() => enableButton(btn))

            reloadIfThereIsNoConnection()
        }

        let denyConnection = (btn) => {
            let connectionId = btn.getAttribute('connection_id')
            // Send the request
            disableButton(btn)
            axios.post('/connections/' + connectionId + '/deny')
                .then(res => {
                    document.querySelector('[connection_id="' + connectionId + '"]').parentElement.parentElement.parentElement.parentElement.remove()
                    deletedConnections += 1
                }).catch(err => {
                    document.querySelector('#errorHolder').classList.remove('d-none')
                }).finally(() => enableButton(btn))

            reloadIfThereIsNoConnection()
        }

        let reloadIfThereIsNoConnection = () => deletedConnections === 10 ? window.location.reload() : null

        let disableButton = btn => {
            let buttons = document.querySelectorAll('[connection_id="' + btn.getAttribute('connection_id') + '"]')
            buttons.forEach(btn => {
                btn.setAttribute('disabled', true)
            })
        }

        let enableButton = btn => {
            let buttons = document.querySelectorAll('[connection_id="' + btn.getAttribute('connection_id') + '"]')
            buttons.forEach(btn => {
                btn.removeAttribute('disabled')
            })
        }
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/connection/index.blade.php ENDPATH**/ ?>