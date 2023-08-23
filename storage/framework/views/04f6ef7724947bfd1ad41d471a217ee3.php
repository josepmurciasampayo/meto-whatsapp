<div>
    <button
        onclick="decide(this, <?php echo e($studentUniversity->id); ?>)"
        class="btn btn-<?php echo e($studentUniversity->student_response !== 'interested' ? 'outline-' : null); ?>success">
        Interested
    </button>

    <button
        onclick="decide(this, <?php echo e($studentUniversity->id); ?>)"
        class="btn btn-<?php echo e($studentUniversity->student_response !== 'not_sure' ? 'outline-' : null); ?>warning">
        Not Sure
    </button>

    <button
        onclick="decide(this, <?php echo e($studentUniversity->id); ?>)"
        class="btn btn-<?php echo e($studentUniversity->student_response !== 'not_interested' ? 'outline-' : null); ?>secondary">
        Not Interested
    </button>

</div>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/components/student-connection-interest-decision-buttons.blade.php ENDPATH**/ ?>