@if ($student->curriculum == \App\Enums\Student\Curriculum::AMERICAN()) <!-- American -->
<p class="detail">
    <span class="label">Freshman-year GPA:</span>
    <br />
    <span class="info">{{ $row['american_freshman'] }}</span>
</p>
<p class="detail">
    <span class="label">Sophomore-year GPA:</span>
    <br />
    <span class="info">{{ $row['american_sophomore'] }}</span>
</p>

@elseif ($student->curriculum == \App\Enums\Student\Curriculum::RWANDAN()) <!-- Rwandan -->
<p class="detail">
    <span class="label">Rwandan O-level exam score:</span>
    <br />
    <span class="info">{{ $row['rwandan_olevel1'] ?? $row['rwandan_olevel2'] }}</span>
</p>

@elseif ($student->curriculum == \App\Enums\Student\Curriculum::UGANDAN()) <!-- Ugandan -->
<p class="detail">
    <span class="label">Ugandan O-level exam score:</span>
    <br />
    <span class="info">{{ $row['ugandan_A'] ?? $row['ugandan_mock'] }}</span>
</p>

@elseif ($student->curriculum == \App\Enums\Student\Curriculum::KENYAN()) <!-- Kenyan -->
<p class="detail">
    <span class="label">KCPE Exam Score:</span>
    <br />
    <span class="info">{{ $row['kenyan_exam'] ?? $row['kenyan_mock'] }}</span>
</p>
@endif
