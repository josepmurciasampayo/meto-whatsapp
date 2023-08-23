<div class="my-5 mx-2 single-student-card" style="font-size: 14px;">
    <div>
        <div class="row bg-light p-3 rounded border">
            <div class="col-md-3">
                <p class="detail">
                    <!-- User ID: <?php echo e($row['user_id']); ?> Student ID: <?php echo e($row['student_id']); ?> -->
                    <span class="fw-bold">High School Name:</span>
                    <br />
                    <span class="info"><?php echo e($row['hs']); ?></span>
                </p>
                <p class="detail">
                    <span class="fw-bold">Affiliations:</span>
                    <br />
                    <span class="info"><?php echo e($row['affiliations']); ?></span>
                </p>
                <p class="detail">
                    <span class="fw-bold">City, Country of High School:</span>
                    <br />
                    <span class="info">
                        <?php echo e($row['hs_city']); ?>, <?php echo e($row['hs_country']); ?>

                    </span>
                </p>
            </div>

            <div class="col-md-3">
                <p class="detail">
                    <span class="fw-bold">Place of Birth:</span>
                    <br />
                    <span class="info"><?php echo e($row['birth_city']); ?>, <?php echo e($row['birth_country']); ?></span>
                </p>
                <p class="detail">
                    <span class="fw-bold">DOB:</span>
                    <br />
                    <span class="info"><?php echo e(\Carbon\Carbon::parse($row['dob'])->format('M d, Y')); ?></span>
                </p>
                <p class="detail">
                    <span class="fw-bold">Gender:</span>
                    <br />
                    <span class="info"><?php echo e($row['gender']); ?></span>
                </p>
            </div>

            <div class="col-md-3">
                <p class="detail">
                    <span class="fw-bold">Graduation Date:</span>
                    <br />
                    <?php
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
                    ?>
                    <span class="info"><?php echo e($grad); ?></span>
                </p>
                <?php echo $__env->make('_partials.questions.line-9', ['row' => $row], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <div class="col-md-3">
                <?php echo $__env->make('_partials.questions.line-10', ['row' => $row], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <div class="col-12">
                <div class="alert alert-primary mt-3">
                    This student is viewable for you because <?php echo e(config('app.name')); ?> believes that their score in
                    the <?php echo e($row['curriculum']); ?> meets or exceeds the
                    standard you set in the <?php echo e(\App\Enums\Student\Curriculum::descriptions()[$uni->min_grade_curriculum] ?? ''); ?>. Agree or disagree? Tell us at <a href="mailto:bthomsen@meto-intl.org">bthomsen@meto-intl.org</a>. Change your
                    threshold <a href="<?php echo e(route('uni.mingrade')); ?>">here</a>.
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/_partials/questions/card.blade.php ENDPATH**/ ?>