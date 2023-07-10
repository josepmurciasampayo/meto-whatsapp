<div class="my-5 mx-2 single-student-card" style="font-size: 14px;">
    <div>
        <div class="row bg-light p-3 rounded border">
            <div class="col-md-3">
                <p class="detail">
                    <!-- User ID: {{ $row['user_id'] }} Student ID: {{ $row['student_id'] }} --!>
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
                    <span class="info">{{ $row['dob'] }}</span>
                </p>
                <p class="detail">
                    <span class="fw-bold">Gender:</span>
                    <br />
                    <span class="info">{{ $row['gender'] }}</span>
                </p>
            </div>

            <div class="col-md-3">
                <p class="detail">
                    <span class="label">Graduation Date:</span>
                    <br />
                    <span class="info"></span>
                </p>

                  @include('_partials.questions.line-9', ['row' => $row])

            </div>

            <div class="col-md-3">

                 @include('_partials.questions.line-10', ['row' => $row])



            </div>

            <div class="col-12">
                <div class="alert alert-primary mt-3">
                    This student is viewable for you because {{ config('app.name') }} believes that their score in
                    the {{ strtolower(\App\Enums\Student\Curriculum::descriptions()[$uni->min_grade_curriculum] ?? '') }} curriculum meets or exceeds the
                    standard you set. Agree or disagree? Tell us at <a href="mailto:bthomsen@meto-intl.org">bthomsen@meto-intl.org</a>. Change your
                    threshold <a href="{{ route('uni.mingrade') }}">here</a>.
                </div>
            </div>
        </div>
    </div>
</div>
