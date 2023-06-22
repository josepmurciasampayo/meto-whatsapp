<button {{ $attributes->merge([
   'type' => 'submit',
   'class' => 'btn button-state-styles',
   'style' => '
        border-radius: 5px !important;
        color: rgb(22, 66, 22) !important;
        background-color: rgb(22, 66, 22) !important;
        border-color: ivory !important;
        color: white !important;
        transition-duration: .3s;
        :hover {
            color: black !important;
        }
    '
   ]) }}>
    {{ $slot }}
</button>
