<x-app-layout>
    <div style="max-width: 40%" class="p-6">
    <h1>Please let us know the application status for each of the following schools:</h1>
    <form method="POST" action="/form">
        @csrf
        <input type="hidden" name="userform_id" id="userform_id" value="<?php echo $userform_id ?>"?>
        <div class="form-group p-6">
    <?php foreach($matches as $match) { ?>
        <label>
            <?php echo $match['name'] ?>
        <select class="form-select" id="match[<?php echo $match['match_id'] ?>]" name="match[<?php echo $match['match_id'] ?>]" >
            <?php foreach($options as $value => $option) { ?>
            <?php if (($value != $unknown) || ($value == $match['status'])) { ?>
            <option
                value="<?php echo $value ?>"
                <?php if ($match['status'] == $value) { echo 'selected '; } ?>
                ><?php echo $option ?>
            </option>
                <?php } ?>
            <?php } ?>
        </select>
        </label>
        <br/><br/><br/>
    <?php } ?>
    <button class="btn btn-primary" type="submit">
        Submit Update
    </button>
        </div>
    </form>
    </div>
</x-app-layout>
