<x-app-layout>

    <x-popup-notification 
    title="Welcome back!" 
    text="Please remember to update your EFC and grades to ensure you can get the best out of Meto." 
    btn_text='Close' 
    btn_class='popup-close'
    icon="fa fa-times" />

<div class="min-h-screen"><div class="flex justify-between align-items-center">
    <div class="ml-auto w-50">
      <x-progress-bar progress="16"/>
    </div>

    <div class="flex">
      <x-sidebar-menu :links="[['label' => 'Dashboard', 'icon' => 'fa fa-tachometer-alt', 'href' => route('login')],
        ['label' => 'Users', 'icon' => 'fa fa-users', 'href' => route('login')],
        ['label' => 'Settings', 'icon' => 'fa fa-cog', 'href' => route('login')],
      ]"/>

      <x-icon-link href="{{ route('login') }}" icon="fa fa-user-plus" text="Invite Friends"/>
    </div>
  </div>

            <div class="display-7" style="margin-top: 12px;">
                Welcome, Abraham!</div>

<div class="flex justify-center" style="margin-top: 12px;margin-bottom: 12px;">
    <x-status-icon-main href="#" icon="fa fa-edit" text="Edit Profile"/> 
    <x-status-icon-main href="#" icon="fas fa-book" text="Resources"/> </div>

    <div class="flex justify-center ">
        <div class="w-50 my-10">
          <x-connection-table/>
         
        </div>
        
      </div>
      <div class="flex justify-center ">
      <x-button-nav href="{{route('student.home') }}" class="btn btn-outline text-gray-600 hover:text-gray-900 text-xs text-center w-50"><i class="fas fa-eye"></i> View all connections</x-button-nav></div>
    

    

</x-app-layout>
