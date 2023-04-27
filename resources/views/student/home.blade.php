<x-app-layout>
    @if ($user->reminder == \App\Enums\General\YesNo::NO())
        <x-popup-redirect
            title="Update Your Academic & Financial Information"
            text="Please update your information to ensure that your records are up-to-date and you can get the best result from Meto."
            btn_text="Update Now"
            btn_href="{{ route('student.academics', ['screen' => 0]) }}"
            btn_icon="fas fa-cloud-upload-alt"
        />
    @endif

  <div class="min-h-screen">
      <div class="flex justify-between align-items-center">
          <div class="ml-auto w-50">
              <!-- <x-progress-bar :progress="rand(1, 100)"/> -->
          </div>

          <div class="flex">
              <x-sidebar-menu :links="[
                  ['label' => 'Basic Information', 'icon' => 'fa fa-user', 'href' => route('student.profile')],
                  ['label' => 'Demographic', 'icon' => 'fa fa-address-card', 'href' => route('student.demographic')],
                  ['label' => 'High School', 'icon' => 'fa fa-school', 'href' => route('student.highschool')],
                  ['label' => 'Academic', 'icon' => 'fa fa-graduation-cap', 'href' => route('student.academics')],
                  ['label' => 'Financial', 'icon' => 'fa fa-money-bill', 'href' => route('student.financial')],
                  ['label' => 'Extracurricular', 'icon' => 'fa fa-running', 'href' => route('student.extracurricular')],
                  ['label' => 'University Plan', 'icon' => 'fa fa-university', 'href' => route('student.university')],
                  ['label' => 'Testing', 'icon' => 'fas fa-clipboard-check', 'href' => route('student.testing')],
                  ['label' => 'General', 'icon' => 'fa fa-info-circle', 'href' => route('student.general')],
              ]"/>

           
         <div class="mt-5 mr-2"><x-invite-friend-popup/></div>
          </div>
           
      </div>

      

      <div class="display-7" style="margin-top: 12px;">Welcome, {{ $user->first }}!</div>

      <div class="flex justify-center" style="margin-top: 12px;margin-bottom: 12px;">
          <x-status-icon-main href="/edit-info" icon="fa fa-edit" text="Edit Profile"/>
          <x-status-icon-main href="#" icon="fas fa-book" text="Resources"/>
      </div>

      <div class="flex justify-center ">
          <div class="w-50 my-10">
              <!-- <x -connection-table/> -->
          </div>
      </div>

      <div class="flex justify-center ">
          <x-button-nav href="{{route('student.home') }}" class="btn btn-outline text-gray-600 hover:text-gray-900 text-xs text-center w-50">
              <i class="fas fa-eye"></i> View all connections
          </x-button-nav>
      </div>
  </div>
</x-app-layout>
