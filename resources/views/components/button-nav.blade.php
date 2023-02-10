<a {{ $attributes->merge([
    'class' => 'btn btn-outline-success',
    'style' => '
    border-radius: 5px !important;
    transition-duration: .3s;
    '
    ]) }}>
    {{ $slot }}
    </a>
 