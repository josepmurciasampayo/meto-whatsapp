<div>
    <button
        onclick="decide(this, {{ $studentUniversity->id }})"
        class="btn btn-{{ $studentUniversity->student_response !== 'interested' ? 'outline-' : null }}success">
        Interested
    </button>

    <button
        onclick="decide(this, {{ $studentUniversity->id }})"
        class="btn btn-{{ $studentUniversity->student_response !== 'not_sure' ? 'outline-' : null }}warning">
        Not Sure
    </button>

    <button
        onclick="decide(this, {{ $studentUniversity->id }})"
        class="btn btn-{{ $studentUniversity->student_response !== 'not_interested' ? 'outline-' : null }}secondary">
        Not Interested
    </button>

</div>
