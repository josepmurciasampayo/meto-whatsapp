<x-app-layout>
    <div style="max-width: 80%" class="p-6">
    <h2>Please let us know what you’ve decided for each of the <?php echo count($matches) ?> schools we’ve matched. This information is sent securely and will only used to help improve our services and will never be shared without your permission.
    </h2>
    <form method="POST" action="/form">
        @csrf
        <input type="hidden" name="userform_url" id="userform_url" value="<?php echo $url ?>"?>
        <div class="form-group p-6">
    <?php foreach($matches as $match) { ?>
        <div class="container">
            <?php echo $match['name'] ?>

            <div class="container">
                <input type="hidden" id="<?php echo $match['match_id'] ?>" name="<?php echo $match['match_id'] ?>" value="<?php echo $match['status'] ?>">
                <div class="btn-group" role="group">

                    <?php foreach($options as $value => $option) { ?>

                <input type="radio" class="btn-check" autocomplete="off"
                    value="<?php echo $value ?>"
                    <?php if ($match['status'] == $value) { echo 'checked '; } ?>
                    >
                        <label class="btn btn-outline-primary" for="btnradio1"><?php echo $option ?></label>

                    <?php } ?>

                </div>
            </div>
            </div>
    <?php } ?>
    <button class="btn btn-primary" type="submit">
        Submit Update
    </button>
        </div>
    </form>
    </div>
</x-app-layout>
