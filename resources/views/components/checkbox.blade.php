@props(['checked' => '', 'options', 'name', 'label', 'pickOne'])
<div class="mt-4">
    <p>{{ $label }}</p>
    @if ($pickOne)
        <p class="text-danger">Please select at least one</p>
    @endif
    <?php $saved = explode(",", $checked); ?>
    <?php foreach ($options as $i => $option) { ?>
        <?php if ($option == 'None') continue ?>
        <?php $checked = in_array($i, $saved) ? "checked" : "" ?>
    <sl-checkbox class="check{{ $name }}" {{ $checked }} name="{{ $name . "[" . $i . "]" }}" id="{{ $name . "[" . $i . "]" }}" value="{{ $i }}" >{{ $option }}</sl-checkbox>
    <br/>
    <?php } ?>
    <script type="text/javascript">
        var boxRequired{{ $name }} = false;
        $('.check{{$name}}').change(function() {
            document.getElementByClassName('check{{ $name }}').forEach(function(el) {
                if (el.checked) {
                    boxRequired{{ $name }} = true;
                }
            });
            document.getElementByClassName('check{{ $name }}').forEach(function(el) {
                if (boxRequired{{ $name }}) {
                    el.removeAttr('required');
                } else {
                    el.attr('required');
                }
            });
        });
    </script>

</div>
