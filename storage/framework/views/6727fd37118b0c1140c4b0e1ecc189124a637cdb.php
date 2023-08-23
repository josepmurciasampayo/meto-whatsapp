<?php $actionRulesClass = app('PowerComponents\LivewirePowerGrid\Helpers\ActionRules'); ?>

<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'livewire-powergrid::components.table-base','data' => ['theme' => $theme->table,'readyToLoad' => $readyToLoad]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('livewire-powergrid::table-base'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['theme' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($theme->table),'ready-to-load' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($readyToLoad)]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <tr
            class="<?php echo e($theme->table->trClass); ?>"
            style="<?php echo e($theme->table->trStyle); ?>"
        >
            <?php if(data_get($setUp, 'detail.showCollapseIcon')): ?>
                <th
                    scope="col"
                    class="<?php echo e($theme->table->thClass); ?>"
                    style="<?php echo e($theme->table->thStyle); ?>"
                    wire:key="<?php echo e(md5('showCollapseIcon')); ?>"
                >
                </th>
            <?php endif; ?>

            <?php if(isset($setUp['responsive'])): ?>
                <th fixed x-show="hasHiddenElements" class="font-medium p-4 pr-8 pt-0 pb-3 text-slate-200 text-left">
                </th>
            <?php endif; ?>

            <?php if($checkbox): ?>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'livewire-powergrid::components.checkbox-all','data' => ['checkbox' => $checkbox,'theme' => $theme->checkbox]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('livewire-powergrid::checkbox-all'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['checkbox' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($checkbox),'theme' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($theme->checkbox)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            <?php endif; ?>

            <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'livewire-powergrid::components.cols','data' => ['column' => $column,'theme' => $theme,'enabledFilters' => $enabledFilters]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('livewire-powergrid::cols'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['column' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($column),'theme' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($theme),'enabledFilters' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($enabledFilters)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php if(isset($actions) && count($actions)): ?>
                <?php
                    $responsiveActionsColumnName = PowerComponents\LivewirePowerGrid\Responsive::ACTIONS_COLUMN_NAME;

                    $isActionFixedOnResponsive = isset($this->setUp['responsive']) && in_array($responsiveActionsColumnName, data_get($this->setUp, 'responsive.fixedColumns')) ? true : false;
                ?>

                <th
                    <?php if($isActionFixedOnResponsive): ?> fixed <?php endif; ?>
                    class="<?php echo e($theme->table->thClass . ' ' . $theme->table->thActionClass); ?>"
                    scope="col"
                    style="<?php echo e($theme->table->thStyle . ' ' . $theme->table->thActionStyle); ?>"
                    colspan="<?php echo e(count($actions)); ?>"
                    wire:key="<?php echo e(md5('actions')); ?>"
                >
                    <?php echo e(trans('livewire-powergrid::datatable.labels.action')); ?>

                </th>
            <?php endif; ?>
        </tr>
     <?php $__env->endSlot(); ?>

     <?php $__env->slot('loading', null, []); ?> 
        <tr
            class="<?php echo e($theme->table->trBodyClass); ?>"
            style="<?php echo e($theme->table->trBodyStyle); ?>"
        >
            <td
                class="<?php echo e($theme->table->tdBodyEmptyClass); ?>"
                colspan="<?php echo e(($checkbox ? 1 : 0) + (isset($actions) ? 1 : 0) + count($columns)); ?>"
            >
                <?php if($loadingComponent): ?>
                    <?php echo $__env->make($loadingComponent, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php else: ?>
                    <?php echo e(__('Loading')); ?>

                <?php endif; ?>
            </td>
        </tr>
     <?php $__env->endSlot(); ?>

     <?php $__env->slot('rows', null, []); ?> 

        <?php if($this->hasColumnFilters): ?>
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'livewire-powergrid::components.inline-filters','data' => ['checkbox' => $checkbox,'actions' => $actions,'columns' => $columns,'theme' => $theme,'filters' => $filters,'enabledFilters' => $enabledFilters,'tableName' => $tableName,'setUp' => $setUp]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('livewire-powergrid::inline-filters'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['checkbox' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($checkbox),'actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actions),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($columns),'theme' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($theme),'filters' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($filters),'enabledFilters' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($enabledFilters),'tableName' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tableName),'setUp' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($setUp)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
        <?php endif; ?>
        <?php if(is_null($data) || count($data) === 0): ?>
            <th>
                <tr
                    class="<?php echo e($theme->table->trBodyClass); ?>"
                    style="<?php echo e($theme->table->trBodyStyle); ?>"
                >
                    <td
                        class="<?php echo e($theme->table->tdBodyEmptyClass); ?>"
                        style="<?php echo e($theme->table->tdBodyEmptyStyle); ?>"
                        colspan="<?php echo e(($checkbox ? 1 : 0) +
                            (isset($actions) ? 1 : 0) +
                            count($columns) +
                            (data_get($setUp, 'detail.showCollapseIcon') ? 1 : 0)); ?>"
                    >
                        <span><?php echo e(trans('livewire-powergrid::datatable.labels.no_data')); ?></span>
                    </td>
                </tr>
            </th>
        <?php else: ?>
            <?php echo $__env->renderWhen($headerTotalColumn, 'livewire-powergrid::components.table-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $class = $theme->table->trBodyClass;
                    $rules = $actionRulesClass->recoverFromAction('pg:rows', $row);

                    $rowId = $row->{$primaryKey};

                    $ruleSetAttribute = data_get($rules, 'setAttribute');

                    if (filled($ruleSetAttribute)) {
                        foreach ($ruleSetAttribute as $attribute) {
                            if (isset($attribute['attribute'])) {
                                $class .= ' ' . $attribute['value'];
                            }
                        }
                    }
                ?>

                <?php if(isset($setUp['detail'])): ?>
                    <tbody
                        class="<?php echo e($class); ?>"
                        x-data="{ detailState: <?php if ((object) ('setUp.detail.state.' . $row->{$primaryKey}) instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($_instance->id); ?>').entangle('<?php echo e('setUp.detail.state.' . $row->{$primaryKey}->value()); ?>')<?php echo e('setUp.detail.state.' . $row->{$primaryKey}->hasModifier('defer') ? '.defer' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($_instance->id); ?>').entangle('<?php echo e('setUp.detail.state.' . $row->{$primaryKey}); ?>')<?php endif; ?> }"
                        wire:key="<?php echo e(md5($row->{$primaryKey} ?? $loop->index)); ?>"
                    >
                    <?php else: ?>
                        <tr
                            style="<?php echo e($theme->table->trBodyStyle); ?>"
                            class="<?php echo e($class); ?>"
                            wire:key="<?php echo e(md5($row->{$primaryKey} ?? $loop->index)); ?>"
                        >
                <?php endif; ?>

                <?php echo $__env->renderWhen(isset($setUp['responsive']), powerGridThemeRoot().'.toggle-detail-responsive', [
                    'theme' => $theme->table,
                    'rowId' => $rowId,
                    'view' => data_get($setUp, 'detail.viewIcon') ?? null
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

                <?php
                    $ruleRows = $actionRulesClass->recoverFromAction('pg:rows', $row);
                    $ruleDetailView = data_get($ruleRows, 'detailView');
                ?>

                <?php echo $__env->renderWhen(data_get($setUp, 'detail.showCollapseIcon'),
                    powerGridThemeRoot() . '.toggle-detail',
                    [
                        'theme' => $theme->table,
                        'view' => data_get($setUp, 'detail.viewIcon') ?? null,
                    ]
                , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

                <?php if($checkbox): ?>
                    <?php
                        $rules = $actionRulesClass->recoverFromAction('pg:checkbox', $row);
                        $ruleHide = data_get($rules, 'hide');
                        $ruleDisable = data_get($rules, 'disable');
                        $ruleSetAttribute = data_get($rules, 'setAttribute')[0] ?? [];
                    ?>
                    <?php echo $__env->make('livewire-powergrid::components.checkbox-row', [
                        'attribute' => $row->{$checkboxAttribute},
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>

                <?php echo $__env->make('livewire-powergrid::components.row', ['rowIndex' => $loop->index + 1], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'livewire-powergrid::components.actions','data' => ['primaryKey' => $primaryKey,'tableName' => $tableName,'theme' => $theme,'row' => $row,'actions' => $actions]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('livewire-powergrid::actions'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['primary-key' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($primaryKey),'tableName' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tableName),'theme' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($theme),'row' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($row),'actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actions)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                </tr>
                <?php if(isset($setUp['detail'])): ?>
                    <template
                        x-cloak
                        x-if="detailState"
                    >
                        <tr>
                            <td
                                colspan="<?php echo e(($checkbox ? 1 : 0) +
                                    (isset($actions) ? 1 : 0) +
                                    count($columns) +
                                    (data_get($setUp, 'detail.showCollapseIcon') ? 1 : 0)); ?>">
                                <?php if(isset($ruleDetailView[0]['detailView'])): ?>
                                    <?php echo $__env->renderWhen(data_get($setUp, 'detail.state.' . $row->{$primaryKey}),
                                        $ruleDetailView[0]['detailView'],
                                        [
                                            'id' => $row->{$primaryKey},
                                            'options' => array_merge(
                                                data_get($setUp, 'detail.options'),
                                                $ruleDetailView[0]['options']),
                                        ]
                                    , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
                                <?php else: ?>
                                    <?php echo $__env->renderWhen(data_get($setUp, 'detail.state.' . $row->{$primaryKey}),
                                        data_get($setUp, 'detail.view'),
                                        [
                                            'id' => $row->{$primaryKey},
                                            'options' => data_get($setUp, 'detail.options'),
                                        ]
                                    , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </template>
                <?php endif; ?>
                <?php if(isset($setUp['detail'])): ?>
                    </tbody>
                <?php endif; ?>

                <?php echo $__env->renderWhen(isset($setUp['responsive']), 'livewire-powergrid::components.expand-container', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php echo $__env->renderWhen($footerTotalColumn, 'livewire-powergrid::components.table-footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
        <?php endif; ?>
     <?php $__env->endSlot(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/vendor/livewire-powergrid/components/table.blade.php ENDPATH**/ ?>