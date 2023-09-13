<form id="decision-form" class="pt-4" method="POST" action="<?php echo e(route('uni.connection.decide')); ?>">
    <?php echo csrf_field(); ?>

    <div class="alert alert-danger d-none" id="tableAlert"></div>
    <div class="alert alert-primary d-none" id="processingAlert">
        Processing your request ...
    </div>
    <div class="alert alert-success d-none" id="requestSuccessAlert">
        Your request has been proceeded successfully.
    </div>

    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('uni.student-table-review', [])->html();
} elseif ($_instance->childHasBeenRendered('c1wjI1R')) {
    $componentId = $_instance->getRenderedChildComponentId('c1wjI1R');
    $componentTag = $_instance->getRenderedChildComponentTagName('c1wjI1R');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('c1wjI1R');
} else {
    $response = \Livewire\Livewire::mount('uni.student-table-review', []);
    $html = $response->html();
    $_instance->logRenderedChild('c1wjI1R', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

    <div class="text-end my-4">
        <button class="btn btn-success submit-pending-btn rounded">Submit Requests</button>
    </div>
</form>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#emailModal">
    Launch demo modal
</button>
<div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h1 class="modal-title fs-5 text-center fw-bold h2 my-3" id="emailModalLabel">
                    Initial <?php echo e(config('app.name')); ?> Email to Students
                    <span id="selected-students-count">(<span id="number">0</span>)</span>
                </h1>
                <h3></h3>
                <div>
                    <p class="mb-3 small fw-bold">
                        Dear [Student Name],
                        <br /><br />
                        Greetings from <?php echo e(config('app.name')); ?>. <?php echo e($uni->name); ?> has reviewed your <?php echo e(config('app.name')); ?> profile and determined you are a competitive candidate for admission and would like to invite you to apply.
                        <br /><br />
                        It is our pleasure to introduce you to <?php echo e($user->first); ?> <?php echo e($user->last); ?><?php echo e($user->title ? ', the ' . $user->title : ''); ?>. You may email them at <?php echo e($user->email); ?>.
                        <br /><br />
                        Here is what you need to know to get started:
                    </p>
                </div>

                <div class="alert alert-danger d-none" id="errorHolder"></div>
                <div class="alert alert-success d-none" id="successHolder">Your requests have been received and will be reviewed promptly!</div>

                <form id="send-connection-form">
                    <div>
                        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.inputs.text','data' => ['name' => 'application_link','type' => 'url','label' => 'Application Link','class' => 'form-control','saved' => ''.e($uni->undergrad_url).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('inputs.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'application_link','type' => 'url','label' => 'Application Link','class' => 'form-control','saved' => ''.e($uni->undergrad_url).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                    </div>

                    <div class="mt-3">
                        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.inputs.date','data' => ['saved' => '2023-09-01','name' => 'upcoming_deadline','label' => 'Upcoming Deadline','class' => 'form-control']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('inputs.date'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['saved' => '2023-09-01','name' => 'upcoming_deadline','label' => 'Upcoming Deadline','class' => 'form-control']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                    </div>

                    <div class="mt-3">
                        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.inputs.text','data' => ['name' => 'cc_emails','placeholder' => 'abcd@mail.com,efjh@mail.com','type' => 'text','label' => 'CC Emails','help' => 'You do not need to cc yourself - this is only to add additional email addresses / colleagues in your office.','class' => 'form-control']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('inputs.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'cc_emails','placeholder' => 'abcd@mail.com,efjh@mail.com','type' => 'text','label' => 'CC Emails','help' => 'You do not need to cc yourself - this is only to add additional email addresses / colleagues in your office.','class' => 'form-control']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                    </div>

                    <div class="row">
                        <div class="col">
                            <button onclick="closeModal()" type="button" class="btn btn-outline-danger rounded mt-3">Cancel</button>
                        </div>
                        <div class="col text-end">
                            <button onclick="sendConnection(event)" type="button" class="btn btn-success btn-green submit-pending-btn rounded mt-3">Request Connection</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let form = document.querySelector('#decision-form')
    let emailModal = document.querySelector('#emailModal')
    let emailModalBtn = document.querySelector('[data-bs-target="#emailModal"]')
    let tableAlert = document.querySelector('#tableAlert')
    let processingAlert = document.querySelector('#processingAlert')
    let requestSuccessAlert = document.querySelector('#requestSuccessAlert')

    form.addEventListener('submit', e => {
        e.preventDefault()

        // Check if we have at least one student selected
        let inputs = getSelectedStudents()
        if (inputs.length === 0) {
            tableAlert.classList.remove('d-none')
            tableAlert.textContent = 'You should select at least 1 student to connect with.';
            window.location = '#top';
            return;
        } else {
            tableAlert.classList.add('d-none')
        }

        let submitButtons = document.querySelectorAll('.submit-pending-btn')

        // Open the modal
        // Only if we have at least one connection
        if (hasConnect(inputs)) {
            emailModalBtn.click()
        } else {
            let url = "<?php echo e(route('uni.connection.decide')); ?>"

            let data = {}

            inputs.forEach(input => {
                data[Object.keys(input)[0]] = input[Object.keys(input)[0]]
            })

            disableSubmitButtons(submitButtons)

            axios.post(url, data)
                .then(res => {
                    document.querySelector('#refresh-records-btn').click()
                    setTimeout(() => enableSubmitButtons(submitButtons), 1000)
                    clearSelectedOptionsStorage()
                })
                .catch(err => {
                    processingAlert.classList.add('d-none')
                    document.querySelector('#tableAlert').textContent = 'Something went wrong.'
                })
        }
    })

    let getSelectedStudents = () => {
        // This codes get just the selected records of the page where you're at
        // let inputs = []
        // Object.values(document.querySelector('#decision-form').elements).forEach(el => {
        //     if (el) {
        //         if ($(el).attr('name') && $(el).attr('name').includes('student_')) {
        //             if (decision = document.querySelector('[name="' + $(el).attr('name') + '"]:checked')) {
        //                 let alreadyExists = false
        //                 inputs.forEach(input => {
        //                     if (Object.keys(input)[0] === $(decision).attr('name')) {
        //                         alreadyExists = true
        //                     }
        //                 })
        //
        //                 if (!alreadyExists) {
        //                     inputs.push({
        //                         [$(decision).attr('name')]: $(decision).attr('value')
        //                     })
        //                 }
        //             }
        //         }
        //     }
        // });

        // Get all the selected records (even on the hidden pages)
        let selectedOptions = JSON.parse(localStorage.getItem('selected_options'))
        let inputs = []

        selectedOptions.forEach(el => {
            inputs.push({
                ['student_' + Object.keys(el)[0]]: Object.values(el)[0]
            })
        })

        // Change the count on the title that's on the pop up
        let countHolder = document.querySelector('#selected-students-count')
        let number = countHolder.querySelector('#number')

        let yesInputs = Object.values(inputs).filter(action => Object.values(action)[0] === 'connect')

        if (inputs.length === 0) {
            countHolder.classList.add('d-none')
        } else {
            countHolder.classList.remove('d-none')
            number.textContent = yesInputs.length + ' selected'
        }

        return inputs;
    }

    let sendConnection = e => {
        e.preventDefault()
        // Execute the ajax request
        let modalForm = document.querySelector('#send-connection-form')
        let errorAlert = document.querySelector('#errorHolder')
        let submitButtons = document.querySelectorAll('.submit-pending-btn')
        // Prepare the request
        let url = "<?php echo e(route('uni.connection.decide')); ?>"

        let data = {
            application_link: modalForm.application_link.value,
            upcoming_deadline: modalForm.upcoming_deadline.value,
            cc_emails: (emails = modalForm.cc_emails.value.split(','))[0] === '' ? [] : emails
        }

        let inputs = getSelectedStudents()

        inputs.forEach(input => {
            data[Object.keys(input)[0]] = input[Object.keys(input)[0]]
        })

        // Disable the submit buttons
        disableSubmitButtons(submitButtons)

        // Send the request
        axios.post(url, data)
            .then(res => {
                clearErrors(data)

                showSuccessAlert()

                document.querySelector('.power-grid-button.refresh-btn').click()

                closeModal()

                setTimeout(hideSuccessAlert(), 3000)

                clearSelectedOptionsStorage()
            })
            .catch(err => {
                let errors = err.response.data.errors
                let message = err.response.data.message
                clearErrors(data)

                errorAlert.classList.remove('d-none')
                errorAlert.textContent = message

                Object.keys(errors).forEach(field => {
                    document.querySelector('#' + field).classList.add('is-invalid')
                })
            })
            .finally(() => enableSubmitButtons(submitButtons))
    }

    let hasConnect = decisions => {
        return decisions.filter(decision => Object.values(decision)[0] === 'connect').length > 0
    }

    let disableSubmitButtons = submitButtons => {
        submitButtons.forEach(button => button.setAttribute('disabled', true))
    }

    let enableSubmitButtons = submitButtons => {
        submitButtons.forEach(button => button.removeAttribute('disabled'))
    }

    let clearErrors = data => {
        // hide the main errors alert
        document.querySelector('#errorHolder').classList.add('d-none')

        Object.keys(data).forEach(field => {
            let input = document.querySelector('#' + field)
            if (input) {
                input.classList.contains('is-invalid')
                    ? input.classList.remove('is-invalid')
                    : null
            }
        })
    }

    let showSuccessAlert = () => {
        document.querySelector('#successHolder').classList.remove('d-none')
    }

    let hideSuccessAlert = () => {
        document.querySelector('#successHolder').classList.add('d-none')
    }

    let closeModal = () => {
        $(emailModal).modal('hide')
    }

    let clearSelectedOptionsStorage = () => {
        localStorage.setItem('selected_options', JSON.stringify([]))
    }
</script>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/_partials/uni/students/pending.blade.php ENDPATH**/ ?>