<?php if($row['curriculum'] == \App\Enums\Student\Curriculum::AMERICAN()): ?> <!-- American -->
<p class="detail">
    <span class="label">Freshman-year GPA:</span>
    <br />
    <span class="info"><?php echo e($row['american_freshman']); ?></span>
</p>
<p class="detail">
    <span class="label">Sophomore-year GPA:</span>
    <br />
    <span class="info"><?php echo e($row['american_sophomore']); ?></span>
</p>

<?php elseif($row['curriculum'] == \App\Enums\Student\Curriculum::RWANDAN()): ?> <!-- Rwandan -->
<p class="detail">
    <span class="label">Rwandan O-level exam score:</span>
    <br />
    <span class="info"><?php echo e($row['rwandan_olevel1'] ?? $row['rwandan_olevel2']); ?></span>
</p>

<?php elseif($row['curriculum'] == \App\Enums\Student\Curriculum::UGANDAN()): ?> <!-- Ugandan -->
<p class="detail">
    <span class="label">Ugandan O-level exam score:</span>
    <br />
    <span class="info"><?php echo e($row['ugandan_A'] ?? $row['ugandan_mock']); ?></span>
</p>

<?php elseif($row['curriculum'] == \App\Enums\Student\Curriculum::KENYAN()): ?> <!-- Kenyan -->
<p class="detail">
    <span class="label">KCPE Exam Score:</span>
    <br />
    <span class="info"><?php echo e($row['kenyan_exam'] ?? $row['kenyan_mock']); ?></span>
</p>
<?php endif; ?>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/_partials/questions/line-9.blade.php ENDPATH**/ ?>