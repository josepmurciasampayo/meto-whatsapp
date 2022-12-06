<x-app-layout>
    <header>
        <style>
          /* Default height for small devices */
          #intro-example {
            height: 400px;
          }
      
          /* Height for devices larger than 992px */
          @media (min-width: 992px) {
            #intro-example {
              height: 600px;
            }
          }
        </style>
      
        <div class="p-0 text-center"
          style="">
          <div class="mask" style="background-color: rgba(26, 74, 51, 0.7);">
            <div class="d-flex justify-content-center align-items-center h-100">
              <div class="text-white">
                <h1 class="mb-3"><div class="p-6 border-gray-200"><strong>Welcome, {{ Auth::user()->first }}. You are a Counselor at {{ $school->name }}.</strong>
                    <p class="my-2">Actively Applying: {{ $summaryCounts['active'] }} of {{ $summaryCounts['total'] }} Total Students</p>
                </div></h1>
            
            <a class="btn btn-outline-light btn-lg" href="{{ route('counselor-students', ['highschool_id' => $school->id] ) }}"
                  role="button" rel="nofollow"><i class="fa-solid fa-graduation-cap"></i> My students</a>
            <a class="btn btn-outline-light btn-lg m-2" href="{{ route('counselor-matches', ['highschool_id' => $school->id] ) }}"
                    role="button" rel="nofollow"><i class="fa-solid fa-handshake"></i> Review Matches</a>
              </div>
            </div>
          </div>
        </div>
      </header>

    <div class="container-md">
        <div class="row">
        </div>             
</div> <br>
    <x-notes-counselor :notes="$notes"></x-notes-counselor>
    <ul class="mb-5">
          <div>
            <?php if (Auth()->user()->isSchoolAdmin()) { ?>
                <div class="mt-2 mb-2"><li><button class="btn btn-success w-25"><i class="fa-solid fa-school-flag"></i> <a href="{{ route('highschool', ['highschool_id' => $school->id]) }}">Institution profile</li></div>
                <div class="mt-2 mb-2"><li><button class="btn btn-success w-25"><i class="fa-solid fa-user-plus"></i> <a href="{{ route('invite', ['highschool_id' => $school->id]) }}">Invite new counselors</a></li></div>
            <?php } ?>
            
            </div>  
        </ul>

</div>
</div>

</x-app-layout>
