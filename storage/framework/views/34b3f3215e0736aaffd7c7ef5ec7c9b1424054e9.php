<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['title', 'text', 'btn_text', 'btn_href', 'btn_icon']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['title', 'text', 'btn_text', 'btn_href', 'btn_icon']); ?>
<?php foreach (array_filter((['title', 'text', 'btn_text', 'btn_href', 'btn_icon']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#redirectModal">
    Launch demo modal
</button>

<div class="modal fade" id="redirectModal" tabindex="-1" aria-labelledby="redirectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body py-5">
                <h2 class="title text-center"><?php echo e($title); ?></h2>
                <p class="text-muted text-center mb-4"><?php echo e($text); ?></p>
                <div class="w-100 text-center mb-3">
                    <a href="<?php echo e($btn_href); ?>"><?php echo e($btn_text); ?><i class="<?php echo e($btn_icon); ?>"></i></a>
                </div>
                <div class="w-100 text-center">
                    <button onclick="closePopup()" class="popup_close_secondary">Close <i class="far fa-window-close"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let closePopup = () => {
        $('[data-bs-target="#redirectModal"]').click()
    }
</script>

<style>
    #redirectModal .title {
        font-size: 20px;
        margin-top: 0;
        color: rgb(5, 23, 21);
        font-weight: bold;
    }

    #redirectModal p {
        font-size: 15px;
        margin-top: 20px;
    }

    #redirectModal a {
        background: #ea4335 !important;
        color: white !important;
        padding: 6px;
        border-radius: 8px;
    }

    .popup-box {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }

    .popup_secondary {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: #ffffff;
        padding: 20px;
        max-width: 600px;
        text-align: center;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
        position: relative;

    }

    .popup_secondary h2 {
        font-size: 20px;
        margin-top: 0;
        color: rgb(5, 23, 21);
        font-weight: bold;
    }

    .popup_secondary p {
        font-size: 15px;
        margin-top: 20px;
    }

    .popup_secondary a {
        display: inline-block;
        background-color: #ea4335;
        color: #ffffff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 15px;
        font-weight: bold;
        text-decoration: none;
        margin-top: 20px;
        transition: background-color 0.3s ease;
    }

    .popup_secondary a:hover {
        background-color: rgb(5, 23, 21);
    }

    .popup_secondary a i {
        margin-left: 10px;
    }

    .popup_secondary button,
    .popup_secondary a {
        display: inline-block;
        vertical-align: top;
        margin-right: 10px;
    }

    @media (max-width: 768px) {
        .popup_secondary {
            max-width: 300px;
        }

        .popup_secondary h2 {
            font-size: 24px;
        }

        .popup_secondary p {
            font-size: 16px;
        }

        .popup_secondary a {
            font-size: 16px;
            padding: 8px 16px;
        }

        .popup_secondary a i {
            margin-left: 5px;
        }

        .popup_close_secondary {
            max-width: 100px;
        }

    }

    .popup_close_secondary {
        font-size: 15px;
        font-weight: bold;
        color: #fff;
        background-color: rgb(57, 53, 53);
        border: none;
        padding: 2px 10px;
        margin-top: 2px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .popup_close_secondary:hover {
        background-color: rgb(5, 23, 21);
    }

    .popup_close_secondary i {
        vertical-align: middle;
    }
</style>








<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/components/popup-redirect.blade.php ENDPATH**/ ?>