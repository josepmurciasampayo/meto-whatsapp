<button {{ $attributes->merge([
   'type' => 'submit',
   'class' => 'btn button-state-styles',
   'style' => '
        border-radius: 5px !important;
        color: rgb(16, 135, 101) !important;
        background-color: rgb(16, 135, 101) !important;
        border-color: rgb(16, 135, 101) !important;
        color: white !important;
        transition-duration: .3s;
    '
   ]) }}>
    {{ $slot }}
</button>
