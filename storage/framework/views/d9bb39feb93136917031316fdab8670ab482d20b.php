<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('uni.student-table-archived', [])->html();
} elseif ($_instance->childHasBeenRendered('75JasGj')) {
    $componentId = $_instance->getRenderedChildComponentId('75JasGj');
    $componentTag = $_instance->getRenderedChildComponentTagName('75JasGj');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('75JasGj');
} else {
    $response = \Livewire\Livewire::mount('uni.student-table-archived', []);
    $html = $response->html();
    $_instance->logRenderedChild('75JasGj', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/_partials/uni/students/archived.blade.php ENDPATH**/ ?>