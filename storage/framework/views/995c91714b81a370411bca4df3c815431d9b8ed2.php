<div class="dropdown">
    <button
        class="btn btn-light dropdown-toggle"
        type="button"
        data-bs-toggle="dropdown"
        aria-expanded="false"
    >
        <svg
            width="20"
            height="20"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
            />
        </svg>
    </button>
    <ul class="dropdown-menu">
        <?php if(in_array('xlsx', data_get($setUp, 'exportable.type'))): ?>
            <li class="d-flex">
                <div class="dropdown-item">
                    <span style="min-width: 25px;"><?php echo app('translator')->get('XLSX'); ?></span>
                    <a
                        class="text-black-50"
                        wire:click.prevent="exportToXLS"
                        href="#"
                    >
                        <?php echo app('translator')->get('livewire-powergrid::datatable.labels.all'); ?>
                    </a>
                    <?php if($checkbox): ?>
                        /
                        <a
                            class="text-black-50"
                            wire:click.prevent="exportToXLS(true)"
                            href="#"
                        >
                            <?php echo app('translator')->get('livewire-powergrid::datatable.labels.selected'); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </li>
        <?php endif; ?>
        <?php if(in_array('csv', data_get($setUp, 'exportable.type'))): ?>
            <li class="d-flex">
                <div class="dropdown-item">
                    <span><?php echo app('translator')->get('Csv'); ?></span>
                    <a
                        class="text-black-50"
                        wire:click.prevent="exportToCsv"
                        href="#"
                    >
                        <?php echo app('translator')->get('livewire-powergrid::datatable.labels.all'); ?>
                    </a>
                    <?php if($checkbox): ?>
                        /
                        <a
                            class="text-black-50"
                            wire:click.prevent="exportToCsv(true)"
                            href="#"
                        >
                            <?php echo app('translator')->get('livewire-powergrid::datatable.labels.selected'); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </li>
        <?php endif; ?>
    </ul>
</div>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/vendor/livewire-powergrid/components/frameworks/bootstrap5/header/export.blade.php ENDPATH**/ ?>