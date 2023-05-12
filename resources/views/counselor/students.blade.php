<x-app-layout>
    <div class="min-h-screen mt-5 mx-2">
        <x-notes-counselor :notes="$notes"></x-notes-counselor>
        <h3 class="my-2 display-7">Student Data</h3>

        <form method="POST" action="{{ route('student.connection.decide') }}">
            @csrf
            <div class="text-end mb-4">
                <button class="btn btn-success rounded">Submit</button>
            </div>

            <div class="table-container" style="height: 50vh; overflow-y: scroll;">


                <x-dataTable></x-dataTable>
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
                        <td><p class="my-link" data-student-id="{{ $row['student_id'] }}" onclick="showStudentCard(this)">{{ $row['name'] }}</p></td>
                        <td>{{ $row['gender'] }}</td>
                        <td>{{ $row['email'] }}</td>
                        <td>{{ $row['phone'] }}</td>
                        <td>{{ $row['active'] }}</td>
                        <td><a class="my-link" href="{{ route('counselor-student', ['student_id' => $row['student_id']]) }}">{{ $row['matches'] }}</a></td>
                        <td>
                            <input type="radio" id="connect_{{ $row['student_id'] }}" name="student_{{ $row['student_id'] }}" value="connect">
                            <label class="pointer" for="connect_{{ $row['student_id'] }}">Connect</label>

                            <input type="radio" id="maybe_{{ $row['student_id'] }}" name="student_{{ $row['student_id'] }}" value="maybe">
                            <label class="pointer" for="maybe_{{ $row['student_id'] }}">Maybe</label>

                            <input type="radio" id="no_{{ $row['student_id'] }}" name="student_{{ $row['student_id'] }}" value="no">
                            <label class="pointer" for="no_{{ $row['student_id'] }}">No</label>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="text-end mb-4">
                <button class="btn btn-success rounded">Submit</button>
            </div>
        </form>

        <div class="card mt-4 single-student-card">
        <div class="card-body py-4">
            @php
                // TODO: Get the correct student object
                $student = \App\Models\Student::first();
            @endphp
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
</x-app-layout>
