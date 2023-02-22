<x-app-layout>


<div class="min-h-screen"><div class="flex justify-between align-items-center">
  <div class="ml-auto w-50">
  </div>

  <div class="flex">
    <x-sidebar-menu :links="[
        ['label' => 'My Profile', 'icon' => 'fa fa-user', 'href' => route('student.profile')],
        ['label' => 'Demographic', 'icon' => 'fa fa-address-card', 'href' => route('student.demographic')],
        ['label' => 'High School', 'icon' => 'fa fa-school', 'href' => route('student.demographic')],
        ['label' => 'Academic', 'icon' => 'fa fa-graduation-cap', 'href' => route('student.academics')],
        ['label' => 'Financial', 'icon' => 'fa fa-money-bill', 'href' => route('student.financial')],
        ['label' => 'Extracurricular', 'icon' => 'fa fa-running', 'href' => route('student.extracurricular')],
        ['label' => 'University Plan', 'icon' => 'fa fa-university', 'href' => route('student.university')],
        ['label' => 'Testing', 'icon' => 'fas fa-clipboard-check', 'href' => route('student.testing')],
        ['label' => 'General', 'icon' => 'fa fa-info-circle', 'href' => route('student.general')],
    ]"/>
    

    <x-invite-friend-popup/>
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
