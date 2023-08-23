<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <h3 class="mt-2 mb-5 display-7">Student Data</h3>

    <div style="font-size: 14px">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">To Review</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="request-tab" data-bs-toggle="tab" data-bs-target="#request-tab-pane" type="button" role="tab" aria-controls="request-tab-pane" aria-selected="false">Yes</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="maybe-tab" data-bs-toggle="tab" data-bs-target="#maybe-tab-pane" type="button" role="tab" aria-controls="maybe-tab-pane" aria-selected="false">Maybe</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="archived-tab" data-bs-toggle="tab" data-bs-target="#archived-tab-pane" type="button" role="tab" aria-controls="archived-tab-pane" aria-selected="false">No</button>
            </li>
        </ul>
        <div class="tab-content" id="students-tables">
            <div class="tab-pane fade show active py-4" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                <p class="mb-3">Recommended Use:</p>
                <ul class="list-disc">
                    <li class="my-2 ms-5">PLEASE NOTE: your ‘Yes’, ‘Maybe’, or ‘No’ decisions will NOT save if you filter/sort the table, click to the next page of students, or leave the page before clicking “Submit Requests”. We are working on this issue.</li>
                    <li class="my-2 ms-5">Until it is fixed, please pre-set any filters you would like, select Yes Maybe or No, and click “Submit Requests” BEFORE leaving the page or setting any new filters/sorting</li>
                    <li class="my-2 ms-5">This will submit ‘Yes’ students to Meto for review and move ‘Maybe’ and ‘No’ students to their respective tabs</li>
                    <li class="my-2 ms-5">Connection emails to ‘Yes’ students will typically be sent within 24 hours, unless you would prefer to delay the emails. If you would prefer to delay your connection emails, please email <a href="mailto:bthomsen@meto-intl.org">bthomsen@meto-intl.org</a> and <a href="mailto:julie@meto-intl.org">julie@meto-intl.org</a>.</li>
                    <li class="my-2 ms-5">Please go <a href="<?php echo e(route('uni.mingrade')); ?>">here </a> to change your academic filter and <a href="<?php echo e(route('uni.efc')); ?>">here</a> to change your EFC filter</li>
                </ul>
                <?php echo $__env->make('_partials.uni.students.pending', ['user' => $user, 'uni' => $uni], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="tab-pane fade py-4" id="request-tab-pane" role="tabpanel" aria-labelledby="request-tab" tabindex="0">
                <p class="mb-3">Students will populate this tab once your connection emails have been sent. If you don’t see the students, please click Refresh. Please click Export to download an Excel sheet with this information.</p>
                <?php echo $__env->make('_partials.uni.students.request', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="tab-pane fade py-4" id="maybe-tab-pane" role="tabpanel" aria-labelledby="maybe-tab" tabindex="0">
                <p class="mb-3">Please click Refresh to see all of the students you’ve marked as Maybe. To change a student’s status to Yes or No, please check the box next to the student, click Reset, and return to the To Review tab. Click Refresh on the To Review tab and you will see the student(s).</p>
                <?php echo $__env->make('_partials.uni.students.maybe', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="tab-pane fade py-4" id="archived-tab-pane" role="tabpanel" aria-labelledby="archived-tab" tabindex="0">
                <p class="mb-3">Please click Refresh to see all of the students you’ve marked as No. To change a student’s status to Yes or Maybe, please check the box next to the student, click Reset, and return to the To Review tab. Click Refresh on the To Review tab and you will see the student(s).</p>
                <?php echo $__env->make('_partials.uni.students.archived', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>

        <div id="student-details-card-holder"></div>

        <?php $__env->startPush('js'); ?>
            <script>
                let buttons = document.querySelectorAll('.refresh-btn' )

                setInterval(() => buttons.forEach(btn => btn.type !== 'button' ? btn.type = 'button' : null), 500)

                Livewire.on('refreshRecords', () => {
                    Livewire.emit('refreshOtherComponents')
                })
            </script>
        <?php $__env->stopPush(); ?>

        <script>
            let unstripeTables = () => {
                document.querySelectorAll('table.table-striped').forEach(table => {
                    table.classList.remove('table-striped')

                    let head = table.querySelector('tbody tr')
                    !head.hasAttribute('wire:key')
                        ? head.classList.add('bg-gray')
                        : null
                })
            }

            unstripeTables()
            setInterval(() => unstripeTables(), 500)

            let card = document.querySelector('#student-details-card-holder')

            let labels = document.querySelectorAll('#students-tables label')

            let selectOption = (label, action = null) => {
                action = action || label.getAttribute('target').toLowerCase()
                // Unselect all the labels first
                unselectAllOptions(label)
                // Select the new label
                label.setAttribute('selected_option', true)
                label.classList.add(action)
                // Select the action's radio input
                document.querySelector("input[type='radio'][value='" + action + "'][name='student_" + label.getAttribute('key') + "']").checked = true
                // Handle the unselect event for this button
                label.removeAttribute('onclick')

                // Store the option on the selected options list
                let selected = JSON.parse(localStorage.getItem('selected_options')) ?? []
                if (selected.filter(key => ((key !== (key + ':connect')) || (key !== (key + ':maybe')) || (key !== (key + ':archive')))).length === 0) {
                    selected.push({ [label.getAttribute('key')]: label.getAttribute('target') })
                    localStorage.setItem('selected_options', JSON.stringify(selected))
                } else {
                    selected = selected.filter(key => Object.keys(key)[0] !== label.getAttribute('key'))
                    selected.push({ [label.getAttribute('key')]: label.getAttribute('target') })
                    localStorage.setItem('selected_options', JSON.stringify(selected))
                }

                if (label.classList.contains(action)) {
                    setTimeout(() => {
                        label.addEventListener('click', () => {
                            if (label.hasAttribute('selected_option') && ((label.classList.contains('connect') || label.classList.contains('maybe') || label.classList.contains('archive')))) {
                                label.removeAttribute('selected_option')
                                let puts = document.querySelectorAll('input[name="student_' + label.getAttribute('key') + '"]')

                                puts.forEach(input => {
                                    setTimeout(() => input.checked = false, 200)
                                })
                                label.parentElement.querySelector('input').checked = false

                                // Remove the option from the selected options list
                                let selected = JSON.parse(localStorage.getItem('selected_options')) ?? []
                                selected = selected.filter(key => Object.keys(key)[0] !== label.getAttribute('key'))
                                localStorage.setItem('selected_options', JSON.stringify(selected))
                            }
                            label.setAttribute('onclick', 'selectOption(this)')
                        }, { once: true })
                    }, 500)
                }
            }

            let unselectAllOptions = label => {
                let key = label.getAttribute('key')
                // Uncolor all the labels
                document.querySelectorAll("label[key='" + key + "']").forEach(label => {
                    label.hasAttribute('selected_option') ? label.removeAttribute('selected_option') : null
                })
                // Unselect all the radio inputs
                document.querySelectorAll('input[type="radio"][name="student_' + key + '"]').forEach(radio => radio.checked = false)
            }

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

        let closeStudentCard = () => {
            card.style.display = 'none'
        }

        let selectSavedOptions = (unselect = false) => {
            JSON.parse(localStorage.getItem('selected_options')).forEach(option => {
                let el = document.querySelector('[key="' + Object.keys(option)[0] + '"][target="' + Object.values(option)[0] + '"]')
                if (unselect) {
                    el.click()
                } else  {
                    if (!el.getAttribute('selected_option')) {
                        el.click()
                    }
                }
            })
        }

        setInterval(() => {
            selectSavedOptions()
        }, 500)

        setInterval(() => {
            if (el = document.querySelectorAll('[placeholder="Min"]')[1]) {
                el.placeholder !== 'Max' ? el.placeholder = 'Max' : null
            }
        }, 50)

        setTimeout(() => {
            let btn = document.querySelector('.reset-saved-options-btn')

            btn.type = 'button'

            btn.setAttribute('onclick', 'resetSavedOptions()')
        }, 500)

        let resetSavedOptions = () => {
            selectSavedOptions(true)
            localStorage.setItem('selected_options', JSON.stringify([]))
        }
    </script>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/uni/students.blade.php ENDPATH**/ ?>