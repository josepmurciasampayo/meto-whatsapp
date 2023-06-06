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
{{--                @include('_partials.questions.line-9')--}}
                <!-- Line 9 -->
            </div>

            <div class="col-md-3">
                <!-- Line 10 -->
{{--                @include('_partials.questions.line-10')--}}
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
                    "This student is viewable for you because Meto believes that their score in
                    the {{ strtolower(\App\Enums\Student\Curriculum::descriptions()[$uni->min_grade_curriculum]) }} curriculum meets or exceeds the
                    standard you set. Agree or disagree? Tell us at <a href="mailto:bthomsen@meto-intl.org">bthomsen@meto-intl.org</a>. Change your
                    threshold here {{ route('uni.mingrade') }}."
                </div>
            </div>
        </div>
    </div>
</div>
