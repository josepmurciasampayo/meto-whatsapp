<x-app-layout>

    <x-sidebar-menu :links="[    ['label' => 'Dashboard', 'icon' => 'fa fa-tachometer-alt', 'href' => route('login')],
        ['label' => 'Users', 'icon' => 'fa fa-users', 'href' => route('login')],
        ['label' => 'Settings', 'icon' => 'fa fa-cog', 'href' => route('login')],
    ]" />
    
    <h2>Welcome</h2>
    <h4>Welcome to Meto, the online ‘meeting place’ where you can connect efficiently with good-fit education opportunities.</h4>
    <p>
        You will now be required to answer a series of questions to create your Meto profile. Your answers will determine which universities or programs reach out to you, so please be as thorough and truthful as possible. It will take you 15 minutes.
    </p>
    <a href="{{ route('student.profile') }}">
        <x-button>Let's Get Started!</x-button>
    </a>


    <x-status-icon href="#" icon="fa fa-check" text="Task completed" :progress="75" />

    <x-icon-link href="#" icon="fa fa-check" text="Task completed Task completed Task completed" :progress="75" />

    <x-progress-bar  progress="50"/>

    <x-icon-link href="{{ route('login') }}" icon="fa fa-sign-in" text="Log In"/>


</x-app-layout>
