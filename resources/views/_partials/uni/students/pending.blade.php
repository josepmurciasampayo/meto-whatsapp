<form id="decision-form" method="POST" action="{{ route('uni.connection.decide') }}">
    @csrf
    <div class="text-end mb-4">
        <button class="btn btn-success submit-pending-btn rounded mt-4">Submit</button>
    </div>

    <livewire:uni.student-table/>

    <div class="text-end my-4">
        <button class="btn btn-success submit-pending-btn rounded">Submit</button>
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
                <h1 class="modal-title fs-5 text-center fw-bold h2 my-3" id="emailModalLabel">Initial Meto Email to Students</h1>
                <div>
                    <p class="mb-3 small fw-bold">
                        Dear [Student Name],
                        <br /><br />
                        Greetings from {{ config('app.name') }}. {{ $uni->name }} has reviewed your {{ config('app.name') }} profile and determined you are a competitive candidate for admission and would like to invite you to apply.
                        <br /><br />
                        It is our pleasure to introduce you to {{ $user->first }} {{ $user->last }}, the {{ $user->title }}. You may email them at {{ $user->email }}.
                        <br /><br />
                        Here is what you need to know to get started:
                    </p>
                </div>

                <div class="alert alert-danger d-none" id="errorHolder"></div>

                <form id="send-connection-form">
                    <div>
                        <x-inputs.text name="application_link" type="url" label="Application Link" class="form-control" />
                    </div>
                    <div class="mt-3">
                        <x-inputs.date name="upcoming_deadline" label="Upcoming Deadline" class="form-control" />
                    </div>
                    <div class="mt-3">
                        <x-inputs.textarea name="upcoming_webinar_events" label="Upcoming Webinar or Events" />
                    </div>

                    <div class="text-end">
                        <button onclick="sendConnection(event)" type="button" class="btn btn-success btn-green submit-pending-btn rounded mt-3">Request Connection</button>
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

    form.addEventListener('submit', e => {
        e.preventDefault()
        // Open the modal
        // Only if we have at least one connection
        emailModalBtn.click()
    })

    let sendConnection = e => {
        e.preventDefault()
        // Execute the ajax request
        let modalForm = document.querySelector('#send-connection-form')
        // Prepare the request
        let url = "{{ route('uni.connection.decide') }}"
        let data = {
            application_link: modalForm.application_link.value,
            upcoming_deadline: modalForm.upcoming_deadline.value,
            upcoming_webinar_events: modalForm.upcoming_webinar_events.value
        }

        let inputs = []
        Object.values(document.querySelector('#decision-form').elements).forEach(el => {
            if (el) {
                if ($(el).attr('name') && $(el).attr('name').includes('student_')) {
                    if (decision = document.querySelector('[name="' + $(el).attr('name') + '"]:checked')) {
                        let alreadyExists = false
                        inputs.forEach(input => {
                            if (Object.keys(input)[0] === $(decision).attr('name')) {
                                alreadyExists = true
                            }
                        })

                        if (!alreadyExists) {
                            inputs.push({
                                [$(decision).attr('name')]: $(decision).attr('value')
                            })
                        }
                    }
                }
            }
        });

        inputs.forEach(input => {
            data[Object.keys(input)[0]] = input[Object.keys(input)[0]]
        })

        axios.post(url, data)
            .then(res => {
                clearErrors(data)
                showSuccessAlert()
                setTimeout(() => window.location.reload(), 700)
            })
            .catch(err => {
                let errors = err.response.data.errors
                let message = err.response.data.message
                let errorAlert = document.querySelector('#errorHolder')

                clearErrors(data)

                errorAlert.classList.remove('d-none')
                errorAlert.textContent = message

                Object.keys(errors).forEach(field => {
                    document.querySelector('#' + field).classList.add('is-invalid')
                })
            })
    }

    let clearErrors = data => {
        // hide the main errors alert
        document.querySelector('#errorHolder').classList.add('d-none')

        Object.keys(data).forEach(field => {
            let input = document.querySelector('#' + field)
            input.classList.contains('is-invalid')
                ? input.classList.remove('is-invalid')
                : null
        })
    }

    let showSuccessAlert = () => {
        document.querySelector('#successHolder').classList.remove('d-none')
    }
</script>
