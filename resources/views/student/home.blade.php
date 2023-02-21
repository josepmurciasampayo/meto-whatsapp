<x-app-layout>
 

  <div class="min-h-screen">
      <div class="flex justify-between align-items-center">
          <div class="ml-auto w-50">
              <x-progress-bar :progress="rand(1, 100)"/>
          </div>


          <div class="flex">
              <x-sidebar-menu :links="[
                  ['label' => 'My Profile', 'icon' => 'fa fa-user', 'href' => '#'],
                  ['label' => 'Demographic', 'icon' => 'fa fa-address-card', 'href' => '#'],
                  ['label' => 'High School', 'icon' => 'fa fa-school', 'href' => '#'],
                  ['label' => 'Academic', 'icon' => 'fa fa-graduation-cap', 'href' => '#'],
                  ['label' => 'Financial', 'icon' => 'fa fa-money-bill', 'href' => '#'],
                  ['label' => 'Extracurricular', 'icon' => 'fa fa-running', 'href' => '#'],
                  ['label' => 'University Plan', 'icon' => 'fa fa-university', 'href' => '#'],
                  ['label' => 'Testing', 'icon' => 'fas fa-clipboard-check', 'href' => '#'],
                  ['label' => 'General', 'icon' => 'fa fa-info-circle', 'href' => '#'],
              ]"/>

<x-invite-friend-popup/>


          </div>
      </div>

      

      <div class="display-7" style="margin-top: 12px;">Welcome, Abraham!</div>

      <div class="flex justify-center" style="margin-top: 12px;margin-bottom: 12px;">
          <x-status-icon-main href="#" icon="fa fa-edit" text="Edit Profile"/> 
          <x-status-icon-main href="#" icon="fas fa-book" text="Resources"/> 
      </div>

      <div class="flex justify-center ">
          <div class="w-50 my-10">
              <x-connection-table/>
          </div>
      </div>

      <div class="flex justify-center ">
          <x-button-nav href="{{route('student.home') }}" class="btn btn-outline text-gray-600 hover:text-gray-900 text-xs text-center w-50"><i class="fas fa-eye"></i> View all connections</x-button-nav>
      </div>
  </div>
</x-app-layout>
