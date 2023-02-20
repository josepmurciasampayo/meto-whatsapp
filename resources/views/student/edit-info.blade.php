<x-app-layout>


<div class="min-h-screen"><div class="flex justify-between align-items-center">
  <div class="ml-auto w-50">
  </div>

  <div class="flex">
    <x-sidebar-menu :links="[  ['label' => 'My Profile', 'icon' => 'fa fa-user', 'href' => '#'],
      ['label' => 'Demographic', 'icon' => 'fa fa-address-card', 'href' => '#'],
      ['label' => 'High School', 'icon' => 'fa fa-school', 'href' => '#'],
      ['label' => 'Academic', 'icon' => 'fa fa-graduation-cap', 'href' => '#'],
      ['label' => 'Financial', 'icon' => 'fa fa-money-bill', 'href' => '#'],
      ['label' => 'Extracurricular', 'icon' => 'fa fa-running', 'href' => '#'],
      ['label' => 'University Plan', 'icon' => 'fa fa-university', 'href' => '#'],
      ['label' => 'Testing', 'icon' => 'fas fa-clipboard-check', 'href' => '#'],
      ['label' => 'General', 'icon' => 'fa fa-info-circle', 'href' => '#'],
    ]"/>
    

    <x-icon-link href="{{ route('login') }}" icon="fa fa-user-plus" text="Invite Friends"/>
  </div>
</div>


  <div class="flex flex-wrap justify-center" style="margin-top: 12px;margin-bottom: 12px;">
<x-status-icon href="#" icon="fa fa-user" text="My Profile" progress="{{ rand(1, 100) }}"/>
<x-status-icon href="#" icon="fa fa-user-friends" text="Demographic" progress="{{ rand(1, 100) }}"/> 
<x-status-icon href="#" icon="fa fa-graduation-cap" text="High School" progress="{{ rand(1, 100) }}"/> 
<x-status-icon href="#" icon="fa fa-book" text="Academic" progress="{{ rand(1, 100) }}"/> 
<x-status-icon href="#" icon="fa fa-dollar-sign" text="Financial" progress="{{ rand(1, 100) }}"/> 
<x-status-icon href="#" icon="fa fa-volleyball-ball" text="Extracurricular" progress="{{ rand(1, 100) }}"/> 
<x-status-icon href="#" icon="fa fa-university" text="University Plan" progress="{{ rand(1, 100) }}"/> 
<x-status-icon href="#" icon="fa fa-file-alt" text="Testing" progress="{{ rand(1, 100) }}"/> 
<x-status-icon href="#" icon="fa fa-info" text="General" progress="{{ rand(1, 100) }}"/> 

  </div>

  
    
  

  

</x-app-layout>
