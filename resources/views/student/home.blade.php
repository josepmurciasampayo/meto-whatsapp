<x-app-layout>

    <x-popup-notification 
    title="Welcome back!" 
    text="Please remember to update your EFC and grades to ensure you can get the best out of Meto." 
    btn_text='Close' 
    btn_class='popup-close'
    icon="fa fa-times" />

<div class="min-h-screen"><div class="flex justify-between align-items-center">
    <div class="ml-auto w-50">
      <x-progress-bar progress="50"/>
    </div>

    <div class="flex">
      <x-sidebar-menu :links="[          ['label' => 'Dashboard', 'icon' => 'fa fa-tachometer-alt', 'href' => route('login')],
        ['label' => 'Users', 'icon' => 'fa fa-users', 'href' => route('login')],
        ['label' => 'Settings', 'icon' => 'fa fa-cog', 'href' => route('login')],
      ]"/>
      <x-icon-link href="{{ route('login') }}" icon="fa fa-user-plus" text="Invite Friends"/>
    </div>
  </div>

<div class="py-12">
    <div >
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="display-7 p-6 bg-white border-b border-gray-200">
                Welcome, Abraham!
        </div>
<div class="flex justify-center">
    <x-status-icon-main href="#" icon="fa fa-edit" text="Edit Profile"/> 
    <x-status-icon-main href="#" icon="fas fa-book" text="Resources"/> 
    

    

</x-app-layout>
