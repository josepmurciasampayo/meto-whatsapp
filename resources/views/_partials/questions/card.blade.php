<div class="my-5 mx-2 single-student-card" style="font-size: 14px;">
    <div>
        <div class="row bg-light p-3 rounded border">
            <div class="col-md-3">
                <p class="detail">
                    <!-- User ID: {{ $row['user_id'] }} Student ID: {{ $row['student_id'] }} -->
                    <span class="fw-bold">High School Name:</span>
                    <br />
                    <span class="info">{{ $row['hs'] }}</span>
                </p>
                <p class="detail">
                    <span class="fw-bold">Affiliations:</span>
                    <br />
                    <span class="info">{{ $row['affiliations'] }}</span>
                </p>
                <p class="detail">
                    <span class="fw-bold">City, Country of High School:</span>
                    <br />
                    <span class="info">
                        {{ $row['hs_city'] }}, {{ $row['hs_country'] }}
                    </span>
                </p>
            </div>

            <div class="col-md-3">
                <p class="detail">
                    <span class="fw-bold">Place of Birth:</span>
                    <br />
                    <span class="info">{{ $row['birth_city'] }}, {{ $row['birth_country'] }}</span>
                </p>
                <p class="detail">
                    <span class="fw-bold">DOB:</span>
                    <br />
                    <span class="info">{{ \Carbon\Carbon::parse($row['dob'])->format('M d, Y') }}</span>
                </p>
                <p class="detail">
                    <span class="fw-bold">Gender:</span>
                    <br />
                    <span class="info">{{ $row['gender'] }}</span>
                </p>
            </div>

            <div class="col-md-3">
                <p class="detail">
                    <span class="fw-bold">Graduation Date:</span>
                    <br />
                    @php
                        $grad = match($row['curriculum_id']) {
                            \App\Enums\Student\Curriculum::AMERICAN() => $row['grad_american'],
                            \App\Enums\Student\Curriculum::RWANDAN() => $row['grad_rwandan'],
                            \App\Enums\Student\Curriculum::UGANDAN() => $row['grad_ugandan1'] ?? $row['grad_ugandan2'],
                            \App\Enums\Student\Curriculum::KENYAN() => $row['grad_kenyan'],
                            \App\Enums\Student\Curriculum::OTHER() => $row['grad_other'],
                            \App\Enums\Student\Curriculum::CAMBRIDGE() => $row['grad_cambridge'],
                            \App\Enums\Student\Curriculum::IB() => $row['grad_IB'],
                            default => '-',
                        }
                    @endphp
                    <span class="info">{{ $grad }}</span>
                </p>
                @include('_partials.questions.line-9', ['row' => $row])
            </div>

            <div class="col-md-3">
                @include('_partials.questions.line-10', ['row' => $row])
            </div>

            <div class="col-12">
                <div class="alert alert-primary mt-3">
                    This student is viewable for you because {{ config('app.name') }} believes that their score in
                    the {{ $row['curriculum'] }} meets or exceeds the
                    standard you set in the {{ \App\Enums\Student\Curriculum::descriptions()[$uni->min_grade_curriculum] ?? '' }}. Agree or disagree? Tell us at <a href="mailto:bthomsen@meto-intl.org">bthomsen@meto-intl.org</a>. Change your
                    threshold <a href="{{ route('uni.mingrade') }}">here</a>.
                </div>
            </div>
        </div>
    </div>
</div>
