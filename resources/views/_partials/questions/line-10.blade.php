@if ($row['curriculum_id'] == \App\Enums\Student\Curriculum::AMERICAN())
    <p class="detail">
        <span class="fw-bold">Junior-year GPA:</span> <span class="info">{{ $row['american_junior'] }}</span>
    </p>
    <p class="detail">
        <span class="fw-bold">Senior-year GPA:</span> <span class="info">{{ $row['american_senior'] }}</span>
    </p>

@elseif ($row['curriculum_id'] == \App\Enums\Student\Curriculum::CAMBRIDGE())
    <p class="detail">
        <span class="fw-bold">Score Description:</span> <span class="info">{{ $row['cambridge_desc'] }}</span>
    </p>
    <p class="detail">
        <span class="fw-bold">A-level Subject 1:</span> <span class="info">{{ $row['cambridge_A_subj'] }}</span>
    </p>
    <p class="detail">
        <span class="fw-bold">Score:</span> <span class="info">{{ $row['cambridge_A_score'] }}</span>
    </p>
    <p class="detail">
        <span class="fw-bold">A-level Subject 2:</span> <span class="info">{{ $row['cambridge_B_subj'] }}</span>
    </p>
    <p class="detail">
        <span class="fw-bold">Score:</span> <span class="info">{{ $row['cambridge_B_score'] }}</span>
    </p>
    <p class="detail">
        <span class="fw-bold">A-level Subject 3:</span> <span class="info">{{ $row['cambridge_C_subj'] }}</span>
    </p>
    <p class="detail">
        <span class="fw-bold">Score:</span> <span class="info">{{ $row['cambridge_C_score'] }}</span>
    </p>
    @if ($row['cambridge_D_score'])
        <p class="detail">
            <span class="fw-bold">A-level Subject 4:</span> <span class="info">{{ $row['cambridge_D_subject'] }}</span>
        </p>
        <p class="detail">
            <span class="fw-bold">Score:</span> <span class="info">{{ $row['cambridge_D_score'] }}</span>
        </p>
    @endif
    @if ($row['cambridge_E_score'])
        <p class="detail">
            <span class="fw-bold">A-level Subject 5:</span> <span class="info">{{ $row['cambridge_D_subject'] }}</span>
        </p>
        <p class="detail">
            <span class="fw-bold">Score:</span> <span class="info">{{ $row['cambridge_E_score'] }}</span>
        </p>
    @endif
    @if ($row['cambridge_F_score'])
        <p class="detail">
            <span class="fw-bold">A-level Subject 6:</span> <span class="info">{{ $row['cambridge_F_subject'] }}</span>
        </p>
        <p class="detail">
            <span class="fw-bold">Score:</span> <span class="info">{{ $row['cambridge_F_score'] }}</span>
        </p>
    @endif

@elseif ($row['curriculum_id'] == \App\Enums\Student\Curriculum::RWANDAN())
    <p class="detail">
        <span class="fw-bold">Mock Exam Score:</span> <span class="info">{{ $row['rwandan_mock'] }}</span>
    </p>
    <p class="detail">
        <span class="fw-bold">A-level Exam Score:</span> <span class="info">{{ $row['rwandan_A2'] }}</span>
    </p>

@elseif ($row['curriculum_id'] == \App\Enums\Student\Curriculum::UGANDAN())
    <p class="detail">
        <span class="fw-bold">Mock Exam Score:</span> <span class="info">{{ $row['uganadan_mock'] }}</span>
    </p>
    <p class="detail">
        <span class="fw-bold">A-level Exam Score:</span> <span class="info">{{ $row['ugandan_A'] }}</span>
    </p>

@elseif($row['curriculum_id'] == \App\Enums\Student\Curriculum::KENYAN())
    <p class="detail">
        <span class="fw-bold">Mock KCSE Exam Score:</span> <span class="info">{{ $row['kenyan_mock'] }}</span>
    </p>
    <p class="detail">
        <span class="fw-bold">KCSE Exam Score:</span> <span class="info">{{ $row['kenyan_exam'] }}</span>
    </p>

@elseif($row['curriculum_id'] == \App\Enums\Student\Curriculum::OTHER())
    <p class="detail">
        <span class="fw-bold">Current Exam Scores:</span> <span class="info">{{ $row['other_current'] }}>
    </p>
    <p class="detail">
        <span class="fw-bold">Final High School Exam Scores:</span> <span class="info">{{ $row['other_final1'] }} / {{ $row['other_final2'] }}</span>
    </p>

@elseif ($row['curriculum_id'] == \App\Enums\Student\Curriculum::IB())
    <!-- Determine if the grade is semester, predicted or final -->
    @if ($row['which_IB'] == 5926) <!-- Semester -->
    @php $total = $row['IB_1'] + $row['IB_2'] + $row['IB_3'] + $row['IB_4'] + $row['IB_5'] + $row['IB_6'] @endphp
        <p class="detail">
            <span class="fw-bold">Class / Semester Grades:</span> <span class="info">{{ $total }} / 42</span>
        </p>
    @elseif ($row['which_IB'] == 5925) <!-- Predicted -->
    @php $total = $row['IB_1'] + $row['IB_2'] + $row['IB_3'] + $row['IB_4'] + $row['IB_5'] + $row['IB_6'] @endphp
        <p class="detail">
            <span class="fw-bold">Predicted IB:</span> <span class="info">(qid=34+qid=36+qid=38+qid=35+qid=33+qid=37 )___ / 42</span>
        </p>
    @elseif ($row['which _IB'] == 5924) <!-- Final -->
    @php $total = $row['IB_1'] + $row['IB_2'] + $row['IB_3'] + $row['IB_4'] + $row['IB_5'] + $row['IB_6'] + $row['IB_TOK'] @endphp
        <p class="detail">
            <span class="fw-bold">Final IB:</span> <span class="info">(qid=34+qid=36+qid=38+qid=35+qid=33+qid=37 +qid=459 ) ___ / 45</span>
        </p>
    @endif

    <p class="detail">
        <span class="fw-bold">{{$row['IB_S1']}} ({{$row['IB_L1']}}):</span> <span class="info">{{$row['IB_1']}}</span>
    </p>
    <p class="detail">
        <span class="fw-bold">{{$row['IB_S2']}} ({{$row['IB_L2']}}):</span> <span class="info">{{$row['IB_2']}}</span>
    </p>
    <p class="detail">
        <span class="fw-bold">{{$row['IB_S3']}} ({{$row['IB_L3']}}):</span> <span class="info">{{$row['IB_3']}}</span>
    </p>
    <p class="detail">
        <span class="fw-bold">{{$row['IB_S4']}} ({{$row['IB_L4']}}):</span> <span class="info">{{$row['IB_4']}}</span>
    </p>
    <p class="detail">
        <span class="fw-bold">{{$row['IB_S5']}} ({{$row['IB_L5']}}):</span> <span class="info">{{$row['IB_5']}}</span>
    </p>
    <p class="detail">
        <span class="fw-bold">{{$row['IB_S6']}} ({{$row['IB_L6']}}):</span> <span class="info">{{$row['IB_6']}}</span>
    </p>
@elseif ($row['curriculum_id'] == \App\Enums\Student\Curriculum::NEWNATIONAL())
    <p class="detail">
        <span class="fw-bod">Curriculum: </span><span class="info">{{ $row['newnational_curriculum'] }}</span>
    </p>
    <p class="detail">
        <span class="fw-bod">Score Type: </span><span class="info">{{ $row['newnational_scoretype'] }}</span>
    </p>
    <p class="detail">
        <span class="fw-bod">Score Level: </span><span class="info">{{ $row['newnational_scorelevel'] }}</span>
    </p>
    <p class="detail">
        <span class="fw-bod">Student Score: </span><span class="info">{{ $row['newnational_numerator'] }}</span>
    </p>
    <p class="detail">
        <span class="fw-bod">Highest Possible Score: </span><span class="info">{{ $row['newnational_denominator'] }}</span>
    </p>
    <br>
    <p>
        Note: The equivalency score is based on the student's self-reported highest possible score and their actual score in their national system.
        It's a rough estimate meant for sorting purposes. As we gain insights into individual national education contexts, we aim to refine this model.
        If you have expertise in a specific country's curriculum and wish to contribute to Meto's research,
        please reach out to <a href="mailto:tealee@meto-intl.org">tealee@meto-intl.org</a>.
    </p>
@endif
