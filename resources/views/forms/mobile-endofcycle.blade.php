<x-app-layout>
    <div class="p-3">
        <h4>Please let us know what you’ve decided for each of the <?php echo count($matches) ?> schools we’ve connected you with.</h4>
        <p>This information is sent securely and will only used to help improve our services and will never be shared without your permission.</p>
        <form method="POST" action="/form">
            @csrf
            <input type="hidden" name="userform_url" id="userform_url" value="<?php echo $url ?>"?>
            <div class="form-group p-6">
                <?php $i = 1; ?>
                <?php foreach($matches as $match) { ?>
                <div class="container my-3 p-4 bg-white" >
                    <div class="d-flex justify-content-between">
                        <h4><?php echo $match['name'] ?></h4>
                        <div style="color: rgb(16, 135, 101); margin-right: 10%;"><?php echo $i++ . ' of ' . count($matches) ?></div>
                    </div>
                    <div class="container m-2">
                        <div class="btn-group-vertical " role="group" style="min-width: 90%;">
                            <?php foreach($options as $value => $option) { ?>
                            <?php $optionName = $match['match_id'] . '-' . $value ?>
                            <input type="radio" class="btn-check" autocomplete="off" value="<?php echo $value ?>" name="matches[<?php echo $match['match_id'] ?>]" id="<?php echo $optionName ?>"
                            <?php if ($match['status'] == $value) { echo 'checked '; } ?>
                            >
                            <label class="btn btn-outline-success p-3 fs-6" for="<?php echo $optionName ?>"><?php echo $option ?></label>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div class="text-center"><button style="font-size: large;" class="btn btn-success px-5 py-2 fs-3" type="submit">Submit</button></div>
            </div>
        </form>
    </div>
</x-app-layout>
