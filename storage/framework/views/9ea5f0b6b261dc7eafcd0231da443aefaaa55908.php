<div>
    <div class="tab-content" id="students-tables">
        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <?php echo $__env->make('_partials.uni.students.pending', ['user' => $user, 'uni' => $uni], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="tab-pane fade py-4" id="request-tab-pane" role="tabpanel" aria-labelledby="request-tab" tabindex="0">
            <?php echo $__env->make('_partials.uni.students.request', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="tab-pane fade py-4" id="maybe-tab-pane" role="tabpanel" aria-labelledby="maybe-tab" tabindex="0">
            <?php echo $__env->make('_partials.uni.students.maybe', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="tab-pane fade py-4" id="archived-tab-pane" role="tabpanel" aria-labelledby="archived-tab" tabindex="0">
            <?php echo $__env->make('_partials.uni.students.archived', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>

    <?php $__env->startPush('js'); ?>
        <script>
            let refreshButtons = [
                'refresh-students-records-btn',
                'refresh-students-request-records-btn',
                'refresh-students-maybe-records-btn',
                'refresh-students-archived-records-btn'
            ]
            let tables = document.querySelectorAll('.tab-pane table')
            setInterval(() => {
                refreshButtons.forEach((id, index) => {
                    console.log('The table for ', id, ' is ', tables[index])
                    let btn = document.querySelector('#' + id)
                    if (tables[index].querySelector('#' + id) === null) {
                        tables[index].innerHTML = "<button type='button' id='emit-" + id + "' class='component-refresh-button' wire:click='emitRefreshEvent' class='d-none'></button><button id='" + id + "' type='button' wire:click='refreshRecords' class='d-none'></button>" + tables[index].innerHTML
                    }
                })
            }, 1000)

            Livewire.on('refresh_records', () => {
                // Refresh records for the four tables
                refreshButtons.forEach(btnId => {
                    alert('hello')
                    console.log(document.querySelector('#' + btnId))
                    document.querySelector('#' + btnId).click()
                })
            })
        </script>
    <?php $__env->stopPush(); ?>
</div>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/livewire/all-student-table-components.blade.php ENDPATH**/ ?>