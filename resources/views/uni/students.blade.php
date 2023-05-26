<x-app-layout>
    <div class="min-h-screen mt-5 mx-2 single-student-card">
        <div>
            <div class="row bg-light p-3 rounded border">
                <div class="col-md-3">
                    <p class="detail">
                        <span class="label">High School Name:</span>
                        <br />
                        <span class="info">Tanzania</span>
                    </p>
                    <p class="detail">
                        <span class="label">Affiliations:</span>
                        <br />
                        <span class="info">Tanzania</span>
                    </p>
                    <p class="detail">
                        <span class="label">City, Country of High School:</span>
                        <br />
                        <span class="info">
                            AB Calculus (4), AP Stats (4), Physics (TBD)
                        </span>
                    </p>
                </div>

                <div class="col-md-3">
                    <p class="detail">
                        <span class="label">Place of Birth:</span>
                        <br />
                        <span class="info">NO</span>
                    </p>
                    <p class="detail">
                        <span class="label">Gender:</span>
                        <br />
                        <span class="info">3.1</span>
                    </p>
                    <p class="detail">
                        <span class="label">DOB:</span>
                        <br />
                        <span class="info">3.3</span>
                    </p>
                </div>

                <div class="col-md-3">
                    <p class="detail">
                        <span class="label">Graduation Date:</span>
                        <br />
                        <span class="info">3.5</span>
                    </p>

                    <!-- Line 9 -->
                    @if(true) <!-- American -->
                        <p class="detail">
                            <span class="label">Freshman-year GPA:</span>
                            <br />
                            <span class="info">(qid=143)</span>
                        </p>
                        <p class="detail">
                            <span class="label">Sophomore-year GPA:</span>
                            <br />
                            <span class="info">(qid=150)</span>
                        </p>
                    @elseif(false) <!-- Rwandan -->
                        <p class="detail">
                            <span class="label">Rwandan O-level exam score:</span>
                            <br />
                            <span class="info">(qid=336 or qid=335)</span>
                        </p>
                    @elseif(false) <!-- Ugandan -->
                        <p class="detail">
                            <span class="label">Ugandan O-level exam score:</span>
                            <br />
                            <span class="info">_____</span>
                        </p>
                    @elseif(false) <!-- Kenyan -->
                        <p class="detail">
                            <span class="label">KCPE Exam Score:</span>
                            <br />
                            <span class="info">qid=255</span>
                        </p>
                    @endif
                    <!-- Line 9 -->
                </div>

                <div class="col-md-3">
                    <!-- Line 10 -->
                    @if(true) <!-- American -->
                        <p class="detail">
                            <span class="label">Junior-year GPA:</span>
                            <br />
                            <span class="info">qid=143</span>
                        </p>
                        <p class="detail">
                            <span class="label">Senior-year GPA:</span>
                            <br />
                            <span class="info">qid=150</span>
                        </p>
                    @elseif(false) <!-- IB -->
                        <!-- Determine if the grade is semester, predicted or final -->
                        @if(true) <!-- Semester -->
                            <p class="detail">
                                <span class="label">Class / Semester Grades:</span>
                                <br />
                                <span class="info">(qid=34+qid=36+qid=38+qid=35+qid=33+qid=37 )___ / 42</span>
                            </p>
                        @elseif(false) <!-- Predicted -->
                            <p class="detail">
                                <span class="label">Predicted IB:</span>
                                <br />
                                <span class="info">(qid=34+qid=36+qid=38+qid=35+qid=33+qid=37 )___ / 42</span>
                            </p>
                        @elseif(false) <!-- Final -->
                            <p class="detail">
                                <span class="label">Final IB:</span>
                                <br />
                                <span class="info">(qid=34+qid=36+qid=38+qid=35+qid=33+qid=37 +qid=459 ) ___ / 45</span>
                            </p>
                        @endif
                        <!-- TODO: Complete column IB for line 10 -->

                    @elseif(false) <!-- Cambridge -->
                        <p class="detail">
                            <span class="label">Score Description:</span>
                            <br />
                            <span class="info">Qid=460</span>
                        </p>

                        <p class="detail">
                            <span class="label">A-level Subject 1:</span>
                            <br />
                            <span class="info">Qid=399</span>
                        </p>
                        <p class="detail">
                            <span class="label">Score:</span>
                            <br />
                            <span class="info">Qid=168</span>
                        </p>

                        <p class="detail">
                            <span class="label">A-level Subject 2:</span>
                            <br />
                            <span class="info">Qid=400</span>
                        </p>
                        <p class="detail">
                            <span class="label">Score:</span>
                            <br />
                            <span class="info">Qid=169</span>
                        </p>

                        <p class="detail">
                            <span class="label">A-level Subject 3:</span>
                            <br />
                            <span class="info">Qid=402</span>
                        </p>
                        <p class="detail">
                            <span class="label">Score:</span>
                            <br />
                            <span class="info">Qid=170</span>
                        </p>
                    @elseif(false) <!-- Rwandan -->
                        <p class="detail">
                            <span class="label">Mock Exam Score:</span>
                            <br />
                            <span class="info">___ (Qid=341)</span>
                        </p>
                        <p class="detail">
                            <span class="label">A-level Exam Score:</span>
                            <br />
                            <span class="info">___ (Qid=343)</span>
                        </p>
                    @elseif(false) <!-- Ugandan -->
                        <p class="detail">
                            <span class="label">Mock Exam Score:</span>
                            <br />
                            <span class="info">qid=76</span>
                        </p>
                        <p class="detail">
                            <span class="label">A-level Exam Score:</span>
                            <br />
                            <span class="info">qid=378</span>
                        </p>
                    @elseif(false) <!-- Kenyan -->
                        <p class="detail">
                            <span class="label">Mock KCSE Exam Score:</span>
                            <br />
                            <span class="info">qid=373</span>
                        </p>
                        <p class="detail">
                            <span class="label">KCSE Exam Score:</span>
                            <br />
                            <span class="info">qid=375</span>
                        </p>
                    @else <!-- Other -->
                        <p class="detail">
                            <span class="label">Current Exam Scores:</span>
                            <br />
                            <span class="info">____</span>
                        </p>
                        <p class="detail">
                            <span class="label">Final High School Exam Scores:</span>
                            <br />
                            <span class="info">___ qid=462: qid=325/qid=324</span>
                        </p>
                    @endif
                    <!-- / Line 10 -->

                    <!-- Line 11 -->
                    <p class="detail">
                        <span class="label">Not known yet:</span>
                        <br />
                        <span class="info">Qid=120</span>
                    </p>
                    <!-- / Line 11 -->
                </div>

                <div class="col-12">
                    <div class="alert alert-primary mt-3">
                        "This student is viewable for you because Meto believes that a [input: operative score] in
                        the [student's curriculum] curriculum is roughly equivalent to a [input: selected minimum score]
                        on the [input: reference curriculum], which meets or exceeds the [reference curriculum]
                        standard you set. Agree or disagree? Tell us at bthomsen@meto-intl.org. Change your
                        threshold here [<-link to onboarding page]."
                    </div>
                </div>
            </div>
        </div>

{{--        <h3 class="mt-2 mb-5 display-7">Student Data</h3>--}}

{{--        <ul class="nav nav-tabs" id="myTab" role="tablist">--}}
{{--            <li class="nav-item" role="presentation">--}}
{{--                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Undecided</button>--}}
{{--            </li>--}}
{{--            <li class="nav-item" role="presentation">--}}
{{--                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Requests</button>--}}
{{--            </li>--}}
{{--            <li class="nav-item" role="presentation">--}}
{{--                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Maybe</button>--}}
{{--            </li>--}}
{{--            <li class="nav-item" role="presentation">--}}
{{--                <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane" type="button" role="tab" aria-controls="disabled-tab-pane" aria-selected="false">Archived</button>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--        <div class="tab-content" id="myTabContent">--}}
{{--            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">--}}
{{--                @include('_partials.uni.students.pending')--}}
{{--            </div>--}}
{{--            <div class="tab-pane fade py-4" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">--}}
{{--                @include('_partials.uni.students.request')--}}
{{--            </div>--}}
{{--            <div class="tab-pane fade py-4" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">--}}
{{--                @include('_partials.uni.students.maybe')--}}
{{--            </div>--}}
{{--            <div class="tab-pane fade py-4" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">--}}
{{--                @include('_partials.uni.students.archived')--}}
{{--            </div>--}}
{{--        </div>--}}

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
            axios.get('/uni-student-fetch/' + studentId)
                .then(res => {
                    let data = res.data;

                    card.style.display = 'block'

                    card.querySelector('#name').textContent = data.user.first + ' ' + data.user.last
                    card.querySelector('#age').textContent = data.student.age

                    qas = card.querySelector('#qas')
                    qas.innerHTML = ''
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
