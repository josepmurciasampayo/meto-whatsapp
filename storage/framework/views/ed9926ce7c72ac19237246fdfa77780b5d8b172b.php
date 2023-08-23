<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('uni.student-table-maybe', [])->html();
} elseif ($_instance->childHasBeenRendered('yV76dZV')) {
    $componentId = $_instance->getRenderedChildComponentId('yV76dZV');
    $componentTag = $_instance->getRenderedChildComponentTagName('yV76dZV');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('yV76dZV');
} else {
    $response = \Livewire\Livewire::mount('uni.student-table-maybe', []);
    $html = $response->html();
    $_instance->logRenderedChild('yV76dZV', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/_partials/uni/students/maybe.blade.php ENDPATH**/ ?>