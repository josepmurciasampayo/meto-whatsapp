<x-app-layout>
  <div class="min-h-screen mt-5 mx-2">
    <div class="bg-gray-100 m-2 p-2">
      <h1 class="display-7 text-center">
      Welcome, {{ Auth::user()->first }}. You are a Counselor at {{ $school->name }}.
  </h1>
  <p class="my-2 text-center">
      Actively Applying: {{ $summaryCounts['active'] }} of {{ $summaryCounts['total'] }} Total Students
  </p></div>
      
      
      <div class="flex justify-center" style="margin-top: 12px;margin-bottom: 12px;">
              <x-status-icon-main href="{{ route('counselor-students', ['highschool_id' => $school->id] ) }}" icon="fa-solid fa-graduation-cap" text="My students"/>
              <x-status-icon-main href="{{ route('counselor-matches', ['highschool_id' => $school->id] ) }}" icon="fa-solid fa-handshake" text="View Matches"/>
          </div>
          <x-notes-counselor :notes="$notes"></x-notes-counselor>
          <?php if (Auth()->user()->isSchoolAdmin()) { ?>
            <div class="flex justify-center gap-4" style="margin-top: 12px; margin-bottom: 12px;">
              <x-button-nav href="{{ route('highschool', ['highschool_id' => $school->id]) }}" class="block text-xl sm:text-2xl lg:text-5xl mb-3 sm:mb-0 sm:w-1/2 lg:w-1/3 px-3 py-2">
                  <i class="fa-solid fa-school-flag"></i> Institution profile
              </x-button-nav>
              <x-button-nav href="{{ route('invite', ['highschool_id' => $school->id]) }}" class="block text-xl sm:text-2xl lg:text-5xl mb-3 sm:mb-0 sm:w-1/2 lg:w-1/3 px-3 py-2">
                  <i class="fa-solid fa-user-plus"></i> Invite new counselors
              </x-button-nav>
          </div>
          <?php } ?>
      </div>
  </div>
</x-app-layout>

