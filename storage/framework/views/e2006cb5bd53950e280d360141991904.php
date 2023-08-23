<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('uni.student-table-maybe', [])->html();
} elseif ($_instance->childHasBeenRendered('z3IELb7')) {
    $componentId = $_instance->getRenderedChildComponentId('z3IELb7');
    $componentTag = $_instance->getRenderedChildComponentTagName('z3IELb7');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('z3IELb7');
} else {
    $response = \Livewire\Livewire::mount('uni.student-table-maybe', []);
    $html = $response->html();
    $_instance->logRenderedChild('z3IELb7', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/_partials/uni/students/maybe.blade.php ENDPATH**/ ?>