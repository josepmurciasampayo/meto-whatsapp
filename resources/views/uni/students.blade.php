<x-app-layout>
        <h3 class="mt-2 mb-5 display-7">Student Data</h3>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Undecided</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Requests</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Maybe</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane" type="button" role="tab" aria-controls="disabled-tab-pane" aria-selected="false">Archived</button>
            </li>
        </ul>
        <div class="tab-content" id="students-tables">
            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                @include('_partials.uni.students.pending', ['user' => $user, 'uni' => $uni])
            </div>
            <div class="tab-pane fade py-4" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                @include('_partials.uni.students.request')
            </div>
            <div class="tab-pane fade py-4" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                @include('_partials.uni.students.maybe')
            </div>
            <div class="tab-pane fade py-4" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">
                @include('_partials.uni.students.archived')
            </div>
        </div>

        @include('_partials.questions.card')

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

            let card = document.querySelector('.single-student-card')

            let labels = document.querySelectorAll('#students-tables label')

            let selectOption = (label, action = null) => {
                action = action || label.textContent.toLowerCase()
                // Unselect all the labels first
                unselectAllOptions(label)
                // Select the new label
                label.setAttribute('selected_option', true)
                label.classList.add(action)
                // Select the action's radio input
                document.querySelector("input[type='radio'][value='" + action + "'][name='student_" + label.getAttribute('key') + "']").checked = true
                // Handle the unselect event for this button
                label.removeAttribute('onclick')
                if (label.classList.contains(action)) {
                    setTimeout(() => {
                        label.addEventListener('click', () => {
                            if (label.hasAttribute('selected_option') && (label.classList.contains('connect') || label.classList.contains('maybe') || label.classList.contains('archive'))) {
                                label.removeAttribute('selected_option')
                                label.parentElement.querySelector('input').checked = false
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
                axios.get('/uni-student-fetch/' + studentId)
                    .then(res => {
                        let data = res.data;
                        let student = data.data.student;

                        card.style.display = 'block'

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

        setInterval(() => {
            if (el = document.querySelectorAll('[placeholder="Min"]')[1]) {
                el.placeholder !== 'Max' ? el.placeholder = 'Max' : null
            }
        }, 50)
    </script>
</x-app-layout>
