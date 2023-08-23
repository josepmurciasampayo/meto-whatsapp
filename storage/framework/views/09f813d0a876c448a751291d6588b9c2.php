<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('uni.student-table-archived', [])->html();
} elseif ($_instance->childHasBeenRendered('FC6kkW2')) {
    $componentId = $_instance->getRenderedChildComponentId('FC6kkW2');
    $componentTag = $_instance->getRenderedChildComponentTagName('FC6kkW2');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('FC6kkW2');
} else {
    $response = \Livewire\Livewire::mount('uni.student-table-archived', []);
    $html = $response->html();
    $_instance->logRenderedChild('FC6kkW2', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/_partials/uni/students/archived.blade.php ENDPATH**/ ?>