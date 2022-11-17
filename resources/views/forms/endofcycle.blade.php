<x-app-layout>
    <div style="max-width: 80%;" class="p-6">
        <h5 style="max-width: 70%">
            Please let us know what you’ve decided for each of the {{ count($matches) }} schools we’ve connected you with. This information is sent securely and will only used to help improve our services and will never be shared without your permission.
        </h5>
        <form method="POST" action="/form">
            @csrf
            <input type="hidden" name="userform_url" id="userform_url" value="<?php echo $url ?>"?>
            <div class="form-group p-6">
                <?php $i = 1; ?>
                <?php foreach($matches as $match) { ?>
                <div class="container my-3 p-4 bg-white" >
                    <div class="d-flex justify-content-between">
                        <h4>{{ $match['name'] }}</h4>
                        <div style="color: rgb(16, 135, 101); margin-right: 10%;"><?php echo $i++ . ' of ' . count($matches) ?></div>
                    </div>
                    <div class="container m-2">
                        <div class="btn-group" role="group" style="min-width: 90%;">
                            <?php foreach($options as $value => $option) { ?>
                                <?php $optionName = $match['match_id'] . '-' . $value ?>
                                <input type="radio" class="btn-check" autocomplete="off" value="{{ $value }}" name="matches[{{ $match['match_id'] }}]" id="{{ $optionName }}"
                                     <?php echo ($match['status_id'] == $value) ? 'checked ' : $match['status'] . ' - ' . strtolower($value) ?> >
                                <label class="btn btn-outline-success p-3 fs-5" for="<?php echo $optionName ?>"><?php echo $option ?></label>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div class="text-end">
                    <x-button>Submit</x-button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
