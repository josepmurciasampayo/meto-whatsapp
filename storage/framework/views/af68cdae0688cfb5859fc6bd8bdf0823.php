<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="my-5">
        <form id="filterForm" class="mb-1 pt-5" action="">
            <div class="row">
                <div class="col-md-5">
                    <label for="efc">EFC</label>
                    <input id="efc" name="efc" type="text" class="form-control" value="<?php echo e(request()->get('efc')); ?>">
                </div>
                <div class="col-md-5">
                    <label for="equivalency">Equivalency</label>
                    <input id="equivalency" name="equivalency" type="text" class="form-control" value="<?php echo e(request()->get('equivalency')); ?>">
                </div>
                <div class="col-md-2 my-auto">
                    <button class="btn btn-green text-white w-100 py-2 mt-4">Submit</button>
                </div>
            </div>
        </form>

        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.students-table', ['efc' => intval(request()->get('efc') ?? 0),'equivalency' => intval(request()->get('equivalency') ?? 0)])->html();
} elseif ($_instance->childHasBeenRendered('vKkkc0Y')) {
    $componentId = $_instance->getRenderedChildComponentId('vKkkc0Y');
    $componentTag = $_instance->getRenderedChildComponentTagName('vKkkc0Y');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('vKkkc0Y');
} else {
    $response = \Livewire\Livewire::mount('admin.students-table', ['efc' => intval(request()->get('efc') ?? 0),'equivalency' => intval(request()->get('equivalency') ?? 0)]);
    $html = $response->html();
    $_instance->logRenderedChild('vKkkc0Y', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

        <div id="student-details-card-holder"></div>
    </div>

    <script>
        let card = document.querySelector('#student-details-card-holder')

        let showStudentCard = el => {
            let studentId = el.getAttribute('data-student-id')
            card.style.display = 'none'
            axios.get('/uni-student-fetch/' + studentId)
                .then(res => {
                    let data = res.data;
                    let student = data.data.student;

                    card.style.display = 'block'
                    card.innerHTML = data.view

                    // card.querySelector('#name').textContent = student.user.first + ' ' + student.user.last
                    // card.querySelector('#age').textContent = student.age

                    // qas = card.querySelector('#qas')
                    // qas.innerHTML = ''
                    // data.qas.forEach(qa => {
                    //     qas.innerHTML += '<div class="p-3 col-md-6">' + '<div class="bg-light p-3 qa rounded mb-3">' +
                    //         '<p class="fw-bold small">#' + qa.question_id + ': ' +  qa.question.text + '</p>' +
                    //         '<p class="small">' + qa.text + '</p>' +
                    //         '</div>' + '</div>'
                    // })
                })
                .catch(err => console.log(err))
        }
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/admin/students-table.blade.php ENDPATH**/ ?>