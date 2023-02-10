<x-app-layout>
    <div class="p-3">
        <p>Please tell us more about why you aren't interested in applying to Vanderbilt (select all that apply):</p>
        <form method="POST" action="/form">
            @csrf
            <input type="hidden" name="userform_url" id="userform_url" value="<?php echo $url ?>"?>
            <div class="form-group p-6">
                <div class="container my-3 p-4 bg-white" >
                    <div class="container m-2">
                        <?php foreach($options as $value => $option) { ?>
                        <div class="mb-3">
                            <input style="margin-top:0" type="checkbox" class="form-check-input" name="{{ $value }}" id="{{ $value }}" value="{{ $value }}" />
                            <label class="form-check-label" for="{{ $value }}">{{ $option }}</label>
                        </div>
                        <?php } ?>
                    </div>
        <p class="text-sm">This information is sent securely and will only be used to help improve our services and will never be shared without your permission.</p>
                </div>
                <?php } ?>
                <div class="text-center"><button style="font-size: large;" class="btn btn-success px-5 py-2 fs-3" type="submit">Submit</button></div>
            </div>
        </form>
    </div>
</x-app-layout>
