@if ($row['curriculum_id'] == \App\Enums\Student\Curriculum::AMERICAN())
    <!--
    <p class="detail">
        <span class="fw-bold">Freshman-year GPA:</span> <span class="info">{{ $row['american_freshman'] ?? '-' }}</span>
    </p>
    <p class="detail">
        <span class="fw-bold">Sophomore-year GPA:</span> <span class="info">{{ $row['american_sophomore'] ?? '-' }}</span>
    </p>
    -->

@elseif ($row['curriculum_id'] == \App\Enums\Student\Curriculum::RWANDAN())
    <p class="detail">
        <span class="fw-bold">Rwandan O-level exam score:</span> <span class="info">{{ $row['rwandan_olevel1'] ?? $row['rwandan_olevel2'] }}</span>
    </p>

@elseif ($row['curriculum_id'] == \App\Enums\Student\Curriculum::UGANDAN())
    <p class="detail">
        <span class="fw-bold">Ugandan O-level exam score:</span> <span class="info">{{ $row['ugandan_olevel'] }}</span>
    </p>

@elseif ($row['curriculum_id'] == \App\Enums\Student\Curriculum::KENYAN())
    <p class="detail">
        <span class="fw-bold">KCPE Exam Score:</span> <span class="info">{{ $row['kcpe'] }}</span>
    </p>

@endif
