<x-app-layout>
    <div class="min-h-screen">
        <div class="flex justify-between align-items-center">
            <div class="ml-auto w-50"></div>
            <div class="flex">
                <x-sidebar-menu :links="[
                    ['label' => 'Basic Information', 'icon' => 'fa fa-user', 'href' => route('student.profile')],
                    ['label' => 'Demographic', 'icon' => 'fa fa-address-card', 'href' => route('student.demographic')],
                    ['label' => 'High School', 'icon' => 'fa fa-school', 'href' => route('student.highschool')],
                    ['label' => 'Academic', 'icon' => 'fa fa-graduation-cap', 'href' => route('student.academics')],
                    ['label' => 'Financial', 'icon' => 'fa fa-money-bill', 'href' => route('student.financial')],
                    ['label' => 'Extracurricular', 'icon' => 'fa fa-running', 'href' => route('student.extracurricular')],
                    ['label' => 'University Plan', 'icon' => 'fa fa-university', 'href' => route('student.university')],
                    ['label' => 'Testing', 'icon' => 'fas fa-clipboard-check', 'href' => route('student.testing')],
                    ['label' => 'General', 'icon' => 'fa fa-info-circle', 'href' => route('student.general')],
                ]"/>

               <div class="mt-5 mr-2"><x-invite-friend-popup/></div>
            </div>
        </div>

        <div class="my-4">
            <div class="alert alert-success d-none" id="mainSuccessAlert">
                <strong>Decision was taken successfully.</strong>
            </div>
            <div class="alert alert-danger d-none" id="mainErrorAlert">
                <strong>Something went wrong.</strong>
            </div>
            <livewire:students.student-connections-table/>
        </div>

        <div class="flex flex-wrap justify-center" style="margin-top: 12px;margin-bottom: 12px;">
            <x-status-icon href="/student-profile" icon="fa fa-user" text="Basic Information" />
            <x-status-icon href="/demographic" icon="fa fa-user-friends" text="Demographic" progress="{{ $demoProgress }}"/>
            <x-status-icon href="/highschool" icon="fa fa-graduation-cap" text="High School" progress="{{ $hsProgress }}"/>
            <x-status-icon href="{{ route('student.academics', ['screen' => 0]) }}" icon="fa fa-book" text="Academic" />
            <x-status-icon href="/financial" icon="fa fa-dollar-sign" text="Financial" progress="{{ $financialProgress }}"/>
            <x-status-icon href="/extracurricular" icon="fa fa-volleyball-ball" text="Extracurricular" progress="{{ $extraProgress }}"/>
            <x-status-icon href="/university" icon="fa fa-university" text="University Plan" progress="{{ $uniProgress }}"/>
            <x-status-icon href="/testing" icon="fa fa-file-alt" text="Testing" progress="{{ $testingProgress }}"/>
            <x-status-icon href="/general" icon="fa fa-info" text="General" progress="{{ $generalProgress }}"/>
        </div>
    </div>

    <script>
        let askQuestion = (form, e)=> {
            e.preventDefault()

            let id = form.getAttribute('request-id')

            let question = form.querySelector('#question')

            form.querySelector('.alert-success').classList.add('d-none')
            form.querySelector('.alert-danger').classList.add('d-none')

            let url = '/connection-request/' + id + '/question/ask'

            form.querySelector('button').setAttribute('disabled', true)

            axios.post(url, {
                question: question.value,
                email_me_a_copy: !!(document.querySelector('#email_me_a_copy_' + id + ':checked'))
            })
                .then(res => {
                    form.querySelector('.alert-success').classList.remove('d-none')
                })
                .catch(err => {
                    let errorAlert = form.querySelector('.alert-danger')

                    errorAlert.classList.remove('d-none')

                    errorAlert.textContent = err.response.data.message
                })
                .finally(() => {
                    form.reset()
                    form.querySelector('button').removeAttribute('disabled')
                })
        }

        let decide = (btn, id) => {
            let successAlert = document.querySelector('#mainSuccessAlert')
            let errorAlert = document.querySelector('#mainErrorAlert')
            let student_decision = btn.textContent.toLowerCase().trim().replace(' ', '_')

            !successAlert.classList.contains('d-none') ? successAlert.classList.add('d-none') : null
            !errorAlert.classList.contains('d-none') ? errorAlert.classList.add('d-none') : null

            let url = '/connection-request/' + id + '/student/decide'

            axios.post(url, { student_decision })
                .then(res => {
                    successAlert.classList.remove('d-none')

                    btn.parentElement.querySelectorAll('button').forEach(divButton => {
                        let classes = ['btn-success', 'btn-warning', 'btn-secondary'];

                        classes.forEach(classValue => {
                            divButton.classList.contains(classValue)
                                ? handleButtonClasses(divButton, classValue, btn)
                                : null
                        })
                    })
                })
                .catch(err => {
                    errorAlert.classList.remove('d-none')
                    errorAlert.querySelector('strong').textContent = err.response.data.message
                })
        }

        let handleButtonClasses = (btn, classValue, btnToActivate) => {
            btn.classList.remove(classValue)
            btn.classList.add('btn-outline-' + classValue.replace('btn-', ''))
            btnToActivate.classList.value = btnToActivate.classList.value.replace('outline-', '')
        }
    </script>
</x-app-layout>
