<?php if($row['curriculum_id'] == \App\Enums\Student\Curriculum::AMERICAN()): ?>
    <p class="detail">
        <span class="fw-bold">Junior-year GPA:</span> <span class="info"><?php echo e($row['american_junior']); ?></span>
    </p>
    <p class="detail">
        <span class="fw-bold">Senior-year GPA:</span> <span class="info"><?php echo e($row['american_senior']); ?></span>
    </p>

<?php elseif($row['curriculum'] == \App\Enums\Student\Curriculum::CAMBRIDGE()): ?>
    <p class="detail">
        <span class="fw-bold">Score Description:</span> <span class="info"><?php echo e($row['cambridge_desc']); ?></span>
    </p>
    <p class="detail">
        <span class="fw-bold">A-level Subject 1:</span> <span class="info"><?php echo e($row['cambridge_A_subj']); ?></span>
    </p>
    <p class="detail">
        <span class="fw-bold">Score:</span> <span class="info"><?php echo e($row['cambridge_A_score']); ?></span>
    </p>
    <p class="detail">
        <span class="fw-bold">A-level Subject 2:</span> <span class="info"><?php echo e($row['cambridge_B_subj']); ?></span>
    </p>
    <p class="detail">
        <span class="fw-bold">Score:</span> <span class="info"><?php echo e($row['cambridge_B_score']); ?></span>
    </p>
    <p class="detail">
        <span class="fw-bold">A-level Subject 3:</span> <span class="info"><?php echo e($row['cambridge_C_subj']); ?></span>
    </p>
    <p class="detail">
        <span class="fw-bold">Score:</span> <span class="info"><?php echo e($row['cambridge_C_score']); ?></span>
    </p>

<?php elseif($row['curriculum_id'] == \App\Enums\Student\Curriculum::RWANDAN()): ?>
    <p class="detail">
        <span class="fw-bold">Mock Exam Score:</span> <span class="info"><?php echo e($row['rwandan_mock']); ?></span>
    </p>
    <p class="detail">
        <span class="fw-bold">A-level Exam Score:</span> <span class="info"><?php echo e($row['rwandan_A']); ?></span>
    </p>

<?php elseif($row['curriculum_id'] == \App\Enums\Student\Curriculum::UGANDAN()): ?>
    <p class="detail">
        <span class="fw-bold">Mock Exam Score:</span> <span class="info"><?php echo e($row['uganadan_mock']); ?></span>
    </p>
    <p class="detail">
        <span class="fw-bold">A-level Exam Score:</span> <span class="info"><?php echo e($row['ugandan_A']); ?></span>
    </p>

<?php elseif($row['curriculum_id'] == \App\Enums\Student\Curriculum::KENYAN()): ?>
    <p class="detail">
        <span class="fw-bold">Mock KCSE Exam Score:</span> <span class="info"><?php echo e($row['kenyan_mock']); ?></span>
    </p>
    <p class="detail">
        <span class="fw-bold">KCSE Exam Score:</span> <span class="info"><?php echo e($row['kenyan_exam']); ?></span>
    </p>

<?php elseif($row['curriculum_id'] == \App\Enums\Student\Curriculum::OTHER()): ?>
    <p class="detail">
        <span class="fw-bold">Current Exam Scores:</span> <span class="info"><?php echo e($row['other_current']); ?>>
    </p>
    <p class="detail">
        <span class="fw-bold">Final High School Exam Scores:</span> <span class="info"><?php echo e($row['other_final1']); ?> / <?php echo e($row['other_final2']); ?></span>
    </p>


<?php elseif($row['curriculum_id'] == \App\Enums\Student\Curriculum::IB()): ?>
    <!-- Determine if the grade is semester, predicted or final -->
    <?php if($row['whichIB'] == 5926): ?> <!-- Semester -->
    <?php $total = $row['IB_1'] + $row['IB_2'] + $row['IB_3'] + $row['IB_4'] + $row['IB_5'] + $row['IB_6'] ?>
        <p class="detail">
            <span class="fw-bold">Class / Semester Grades:</span> <span class="info"><?php echo e($total); ?> / 42</span>
        </p>
    <?php elseif($row['whichIB'] == 5925): ?> <!-- Predicted -->
    <?php $total = $row['IB_1'] + $row['IB_2'] + $row['IB_3'] + $row['IB_4'] + $row['IB_5'] + $row['IB_6'] ?>
        <p class="detail">
            <span class="fw-bold">Predicted IB:</span> <span class="info">(qid=34+qid=36+qid=38+qid=35+qid=33+qid=37 )___ / 42</span>
        </p>
    <?php elseif($row['whichIB'] == 5924): ?> <!-- Final -->
    <?php $total = $row['IB_1'] + $row['IB_2'] + $row['IB_3'] + $row['IB_4'] + $row['IB_5'] + $row['IB_6'] + $row['IB_TOK'] ?>
        <p class="detail">
            <span class="fw-bold">Final IB:</span> <span class="info">(qid=34+qid=36+qid=38+qid=35+qid=33+qid=37 +qid=459 ) ___ / 45</span>
        </p>
    <?php endif; ?>

    <p class="detail">
        <span class="fw-bold"><?php echo e($row['IB_S1']); ?> (<?php echo e($row['IB_L1']); ?>):</span> <span class="info"><?php echo e($row['IB_1']); ?></span>
    </p>
    <p class="detail">
        <span class="fw-bold"><?php echo e($row['IB_S2']); ?> (<?php echo e($row['IB_L2']); ?>):</span> <span class="info"><?php echo e($row['IB_2']); ?></span>
    </p>
    <p class="detail">
        <span class="fw-bold"><?php echo e($row['IB_S3']); ?> (<?php echo e($row['IB_L3']); ?>):</span> <span class="info"><?php echo e($row['IB_3']); ?></span>
    </p>
    <p class="detail">
        <span class="fw-bold"><?php echo e($row['IB_S4']); ?> (<?php echo e($row['IB_L4']); ?>):</span> <span class="info"><?php echo e($row['IB_4']); ?></span>
    </p>
    <p class="detail">
        <span class="fw-bold"><?php echo e($row['IB_S5']); ?> (<?php echo e($row['IB_L5']); ?>):</span> <span class="info"><?php echo e($row['IB_5']); ?></span>
    </p>
    <p class="detail">
        <span class="fw-bold"><?php echo e($row['IB_S6']); ?> (<?php echo e($row['IB_L6']); ?>):</span> <span class="info"><?php echo e($row['IB_6']); ?></span>
    </p>

<?php endif; ?>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/_partials/questions/line-10.blade.php ENDPATH**/ ?>