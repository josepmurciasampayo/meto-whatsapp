<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('uni.student-table-request', [])->html();
} elseif ($_instance->childHasBeenRendered('oGKzDsm')) {
    $componentId = $_instance->getRenderedChildComponentId('oGKzDsm');
    $componentTag = $_instance->getRenderedChildComponentTagName('oGKzDsm');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('oGKzDsm');
} else {
    $response = \Livewire\Livewire::mount('uni.student-table-request', []);
    $html = $response->html();
    $_instance->logRenderedChild('oGKzDsm', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/_partials/uni/students/request.blade.php ENDPATH**/ ?>