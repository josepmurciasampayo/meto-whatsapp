@php $row = ['hs' => null, 'hs_city' => null, 'hs_country' => null, 'birth_city' => null, 'birth_country' => null, 'gender' => null, 'dob' => null, 'affiliations' => null] @endphp
<div class="my-5 mx-2 single-student-card">
    <div>
        <div class="row bg-light p-3 rounded border">
            <div class="col-md-3">
                <p class="detail">
                    <span class="label">High School Name:</span>
                    <br />
                    <span class="info">{{ $row['hs'] }}</span>
                </p>
                <p class="detail">
                    <span class="label">Affiliations:</span>
                    <br />
                    <span class="info">{{ $row['affiliations'] }}</span>
                </p>
                <p class="detail">
                    <span class="label">City, Country of High School:</span>
                    <br />
                    <span class="info">
                        {{ $row['hs_city'] }}, {{ $row['hs_country'] }}
                    </span>
                </p>
            </div>

            <div class="col-md-3">
                <p class="detail">
                    <span class="label">Place of Birth:</span>
                    <br />
                    <span class="info">{{ $row['birth_city'] }}, {{ $row['birth_country'] }}</span>
                </p>
                <p class="detail">
                    <span class="label">Gender:</span>
                    <br />
                    <span class="info">{{ $row['gender'] }}</span>
                </p>
                <p class="detail">
                    <span class="label">DOB:</span>
                    <br />
                    <span class="info">{{ $row['dob'] }}</span>
                </p>
            </div>

            <div class="col-md-3">
                <p class="detail">
                    <span class="label">Graduation Date:</span>
                    <br />
                    <span class="info">3.5</span>
                </p>

                  @include('_partials.questions.line-9', ['student' => $student])

            </div>

            <div class="col-md-3">

                 @include('_partials.questions.line-10', ['student' => $student])

                <p class="detail">
                    <span class="label">Not known yet:</span>
                    <br />
                    <span class="info">Qid=120</span>
                </p>

            </div>

            <div class="col-12">
                <div class="alert alert-primary mt-3">
                    This student is viewable for you because {{ config('app.name') }} believes that their score in
                    the {{ strtolower(\App\Enums\Student\Curriculum::descriptions()[$uni->min_grade_curriculum] ?? '') }} curriculum meets or exceeds the
                    standard you set. Agree or disagree? Tell us at <a href="mailto:bthomsen@meto-intl.org">bthomsen@meto-intl.org</a>. Change your
                    threshold here {{ route('uni.mingrade') }}.
                </div>
            </div>
        </div>
    </div>
</div>
