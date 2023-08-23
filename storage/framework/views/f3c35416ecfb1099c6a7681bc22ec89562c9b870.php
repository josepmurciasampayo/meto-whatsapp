<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('uni.student-connections-table', [])->html();
} elseif ($_instance->childHasBeenRendered('rENZ3P2')) {
    $componentId = $_instance->getRenderedChildComponentId('rENZ3P2');
    $componentTag = $_instance->getRenderedChildComponentTagName('rENZ3P2');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('rENZ3P2');
} else {
    $response = \Livewire\Livewire::mount('uni.student-connections-table', []);
    $html = $response->html();
    $_instance->logRenderedChild('rENZ3P2', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/_partials/uni/students/connections.blade.php ENDPATH**/ ?>