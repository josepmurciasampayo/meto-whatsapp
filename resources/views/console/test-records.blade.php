Password (for all): password

<h3>High School:</h3>
<pre>
ID: {{ $highSchool['id'] }}
Name: {{ $highSchool['name'] }}
</pre>

<br />
<h3>Admin:</h3>
<pre>
ID: {{ $highSchool->admin['id'] }}
Name: {{ $highSchool->admin->getFullName() }}
Email: {{ $highSchool->admin['email'] }}
</pre>

<br />
<h3>Counselors:</h3>
<pre>
@foreach($highSchool->counselors as $counselor)
ID: {{ $counselor['id'] }}
Email: {{ $counselor->email }}
@if(!$loop->last)
----------------------------------------
@endif
@endforeach
</pre>
<br />

<h3>Students:</h3>
<pre>
@foreach($highSchool->students as $student)
ID: {{ $student['id'] }}
Name: {{ $student->getFullName() }}
Email: {{ $student->email }}
@if(!$loop->last)
----------------------------------------
@endif
<br />
@endforeach
</pre>
