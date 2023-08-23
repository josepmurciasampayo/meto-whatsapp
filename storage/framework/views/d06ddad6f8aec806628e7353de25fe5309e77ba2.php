<div>
    <style>
        #askQuestionModal<?php echo e($connectionRequest->id); ?> .model-dialog {
            max-width: 64% !important;
        }

        [data-bs-target='#askQuestionModal<?php echo e($connectionRequest->id); ?>']:hover {
            background: #6c757d !important;
            color: white !important;
        }
    </style>

    <a class='btn btn-outline-secondary pointer' data-bs-toggle='modal' data-bs-target='#askQuestionModal<?php echo e($connectionRequest->id); ?>'>Ask Question</a>

    <!-- Ask Question Modal -->
    <div class="modal fade" id="askQuestionModal<?php echo e($connectionRequest->id); ?>" tabindex="-1" aria-labelledby="askQuestionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="askQuestionModalLabel">Ask Question</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form onsubmit="askQuestion(this, event)" request-id="<?php echo e($connectionRequest->id); ?>">
                        <div class="alert alert-success d-none mb-3">
                            <strong>Thank you. Your message has been sent!</strong>
                        </div>
                        <div class="alert alert-danger d-none mb-3">
                            <strong>Something went wrong!</strong>
                        </div>

                        <textarea placeholder="Question" class="form-control" name="question" id="question" rows="5"></textarea>

                        <div class="form-group mt-4">
                            <input type="checkbox" class="form-control" id="email_me_a_copy_<?php echo e($connectionRequest->id); ?>" name="email_me_a_copy"/>
                            <label for="email_me_a_copy_<?php echo e($connectionRequest->id); ?>" class="mx-2 mt-1">Email me a copy</label>
                        </div>

                        <button class="btn btn-success mt-4">Submit question</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/components/ask-question-about-connection-request-modal.blade.php ENDPATH**/ ?>