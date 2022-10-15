<button {{ $attributes->merge([
   'type' => 'submit',
   'class' => 'btn btn-outline-success',
   'style' => '
        border-radius: 5px !important;
        transition-duration: .3s;
    '
   ]) }}>
    {{ $slot }}
</button>
