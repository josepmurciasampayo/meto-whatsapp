<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="min-h-screen mt-5 mx-2">
        <?php if (isset($component)) { $__componentOriginal72223c1f24bd75f26e42431424409587 = $component; } ?>
<?php $component = App\View\Components\NotesCounselor::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('notes-counselor'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\NotesCounselor::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['notes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($notes)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal72223c1f24bd75f26e42431424409587)): ?>
<?php $component = $__componentOriginal72223c1f24bd75f26e42431424409587; ?>
<?php unset($__componentOriginal72223c1f24bd75f26e42431424409587); ?>
<?php endif; ?>
        <h3 class="my-2 display-7">Student Data</h3>

        <form method="POST">
            <?php echo csrf_field(); ?>
            <div class="text-end mb-4">
                <button class="btn btn-success rounded">Submit</button>
            </div>

            <div class="table-container" style="height: 50vh; overflow-y: scroll;">


                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dataTable','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('dataTable'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                <table id="dataTable" class="table table-striped bg-white">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actively Applying</th>
                        <th>Matches</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actively Applying</th>
                        <th>Matches</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>

                    <tbody>
                    <?php foreach ($data as $row) { ?>
                    <tr>
                        <td><p class="my-link" data-student-id="<?php echo e($row['student_id']); ?>" onclick="showStudentCard(this)"><?php echo e($row['name']); ?></p></td>
                        <td><?php echo e($row['gender']); ?></td>
                        <td><?php echo e($row['email']); ?></td>
                        <td><?php echo e($row['phone']); ?></td>
                        <td><?php echo e($row['active']); ?></td>
                        <td><a class="my-link" href="<?php echo e(route('counselor-student', ['student_id' => $row['student_id']])); ?>"><?php echo e($row['matches']); ?></a></td>
                        <td>
                            <input type="radio" id="connect_<?php echo e($row['student_id']); ?>" name="student_<?php echo e($row['student_id']); ?>" value="connect">
                            <label class="pointer" for="connect_<?php echo e($row['student_id']); ?>">Connect</label>

                            <input type="radio" id="maybe_<?php echo e($row['student_id']); ?>" name="student_<?php echo e($row['student_id']); ?>" value="maybe">
                            <label class="pointer" for="maybe_<?php echo e($row['student_id']); ?>">Maybe</label>

                            <input type="radio" id="archived_<?php echo e($row['student_id']); ?>" name="student_<?php echo e($row['student_id']); ?>" value="archive">
                            <label class="pointer" for="archived_<?php echo e($row['student_id']); ?>">Archive</label>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="text-end my-4">
                <button class="btn btn-success rounded">Submit</button>
            </div>
        </form>

        <div class="card mt-4 single-student-card">
            <div class="card-body py-4">
                <?php
                    // TODO: Get the correct student object
                    $student = \App\Models\Student::first();
                ?>
                <p>
                    <!-- TODO: Get the alpha 2 code for the country and get the image from the API: https://flagsapi.com/ \App\Enums\Country\Country::getCountryAlphaCode() /flat/64.png -->
                <div class="student-country-flag d-inline-block"
                     style="background-image: url('https://flagsapi.com/BE/flat/64.png');"
                ></div>

                <div class="d-inline-block my-auto">
                    <span class="h3 fw-bold" id="name">Haytam Bakouane</span>
                    <span class="text-muted">(<span id="age">23</span>yo)</span>
                </div>

                <div class="text-end d-inline-block close-btn" onclick="closeStudentCard()">
                    <i class="fa fa-times"></i>
                </div>
                </p>

                <div>
                    <div class="col-md-12 questions rounded p-3 pb-2">
                        <div class="row" id="qas">
                            <div class="bg-light col-md-6 p-3 qa rounded">
                                <p class="fw-bold small">#1: Lorem ipsum ipsum ipsum ipsum ipsum ipsum ipsum?</p>
                                <p class="small">
                                    Lorem ipsum ipsum ipsum ipsum ipsum ipsum ipsum ipsum ipsum ipsum ipsum
                                    ipsum ipsum ipsum ipsum ipsum ipsum ipsum ipsum ipsum ipsum ipsum ipsum ipsum
                                    ipsum ipsum ipsum ipsum ipsum ipsum ipsum.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            let card = document.querySelector('.single-student-card')

            let showStudentCard = el => {
                let studentId = el.getAttribute('data-student-id')
                axios.get('/student/fetch/' + studentId)
                    .then(res => {
                        let data = res.data;

                        card.style.display = 'block'

                        card.querySelector('#name').textContent = data.user.first + ' ' + data.user.last
                        card.querySelector('#age').textContent = data.student.age

                        qas = card.querySelector('#qas')
                        qas.innerHTML = ''
                        console.log(data.qas)
                        data.qas.forEach(qa => {
                            qas.innerHTML += '<div class="p-3 col-md-6">' + '<div class="bg-light p-3 qa rounded mb-3">' +
                                '<p class="fw-bold small">#' + qa.question_id + ': ' +  qa.question.text + '</p>' +
                                '<p class="small">' + qa.text + '</p>' +
                                '</div>' + '</div>'
                        })
                    })
                    .catch(err => console.log(err))
            }

            let closeStudentCard = () => {
                card.style.display = 'none'
            }
        </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/counselor/students.blade.php ENDPATH**/ ?>