<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('uni.student-table-request', [])->html();
} elseif ($_instance->childHasBeenRendered('jLnfEXY')) {
    $componentId = $_instance->getRenderedChildComponentId('jLnfEXY');
    $componentTag = $_instance->getRenderedChildComponentTagName('jLnfEXY');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('jLnfEXY');
} else {
    $response = \Livewire\Livewire::mount('uni.student-table-request', []);
    $html = $response->html();
    $_instance->logRenderedChild('jLnfEXY', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/_partials/uni/students/request.blade.php ENDPATH**/ ?>