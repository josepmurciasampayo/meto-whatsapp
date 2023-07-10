@if ($row['curriculum'] == \App\Enums\Student\Curriculum::AMERICAN()) <!-- American -->
    <p class="detail">
        <span class="label">Junior-year GPA:</span>
        <br />
        <span class="info">{{ '' }}</span>
    </p>
    <p class="detail">
        <span class="label">Senior-year GPA:</span>
        <br />
        <span class="info"><!--qid=150--></span>
    </p>

@elseif ($row['curriculum'] == \App\Enums\Student\Curriculum::IB()) <!-- IB -->
    <!-- Determine if the grade is semester, predicted or final -->
    @if(true) <!-- Semester -->
        <p class="detail">
            <span class="label">Class / Semester Grades:</span>
            <br />
            <span class="info">(qid=34+qid=36+qid=38+qid=35+qid=33+qid=37 )___ / 42</span>
        </p>
    @elseif(false) <!-- Predicted -->
        <p class="detail">
            <span class="label">Predicted IB:</span>
            <br />
            <span class="info">(qid=34+qid=36+qid=38+qid=35+qid=33+qid=37 )___ / 42</span>
        </p>
    @elseif(false) <!-- Final -->
        <p class="detail">
            <span class="label">Final IB:</span>
            <br />
            <span class="info">(qid=34+qid=36+qid=38+qid=35+qid=33+qid=37 +qid=459 ) ___ / 45</span>
        </p>
    @endif

    <p class="detail">
        <span class="label">qid=131 (qid=6):</span>
        <br />
        <span class="info">qid=34</span>
    </p>
    <p class="detail">
        <span class="label">qid=149 (qid=8):</span>
        <br />
        <span class="info">qid=36</span>
    </p>
    <p class="detail">
        <span class="label">qid=156 (qid=10):</span>
        <br />
        <span class="info">qid=38</span>
    </p>
    <p class="detail">
        <span class="label">qid=133 (qid=7):</span>
        <br />
        <span class="info">qid=35</span>
    </p>
    <p class="detail">
        <span class="label">qid=129 (qid=5):</span>
        <br />
        <span class="info">qid=33</span>
    </p>
    <p class="detail">
        <span class="label">qid=153 (qid=9):</span>
        <br />
        <span class="info">qid=37</span>
    </p>

@elseif ($row['curriculum'] == \App\Enums\Student\Curriculum::CAMBRIDGE()) <!-- Cambridge -->
    <p class="detail">
        <span class="label">Score Description:</span>
        <br />
        <span class="info">Qid=460</span>
    </p>
    <p class="detail">
        <span class="label">A-level Subject 1:</span>
        <br />
        <span class="info">Qid=399</span>
    </p>
    <p class="detail">
        <span class="label">Score:</span>
        <br />
        <span class="info">Qid=168</span>
    </p>
    <p class="detail">
        <span class="label">A-level Subject 2:</span>
        <br />
        <span class="info">Qid=400</span>
    </p>
    <p class="detail">
        <span class="label">Score:</span>
        <br />
        <span class="info">Qid=169</span>
    </p>
    <p class="detail">
        <span class="label">A-level Subject 3:</span>
        <br />
        <span class="info">Qid=402</span>
    </p>
    <p class="detail">
        <span class="label">Score:</span>
        <br />
        <span class="info">Qid=170</span>
    </p>

@elseif ($row['curriculum'] == \App\Enums\Student\Curriculum::RWANDAN()) <!-- Rwandan -->
    <p class="detail">
        <span class="label">Mock Exam Score:</span>
        <br />
        <span class="info">___ (Qid=341)</span>
    </p>
    <p class="detail">
        <span class="label">A-level Exam Score:</span>
        <br />
        <span class="info">___ (Qid=343)</span>
    </p>

@elseif ($row['curriculum'] == \App\Enums\Student\Curriculum::UGANDAN()) <!-- Ugandan -->
    <p class="detail">
        <span class="label">Mock Exam Score:</span>
        <br />
        <span class="info">qid=76</span>
    </p>
    <p class="detail">
        <span class="label">A-level Exam Score:</span>
        <br />
        <span class="info">qid=378</span>
    </p>

@elseif($row['curriculum'] == \App\Enums\Student\Curriculum::KENYAN()) <!-- Kenyan -->
    <p class="detail">
        <span class="label">Mock KCSE Exam Score:</span>
        <br />
        <span class="info">qid=373</span>
    </p>
    <p class="detail">
        <span class="label">KCSE Exam Score:</span>
        <br />
        <span class="info">qid=375</span>
    </p>

@else <!-- Other -->
    <p class="detail">
        <span class="label">Current Exam Scores:</span>
        <br />
        <span class="info">____</span>
    </p>
    <p class="detail">
        <span class="label">Final High School Exam Scores:</span>
        <br />
        <span class="info">___ qid=462: qid=325/qid=324</span>
    </p>
@endif
