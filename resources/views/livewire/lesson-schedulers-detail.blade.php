<div>
    <div class="mb-4">
        @can('create', App\Models\Scheduler::class)
        <button class="btn btn-primary" wire:click="newScheduler">
            <i class="icon ion-md-add"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\Scheduler::class)
        <button
            class="btn btn-danger"
             {{ empty($selected) ? 'disabled' : '' }}
            onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
            wire:click="destroySelected"
        >
            <i class="icon ion-md-trash"></i>
            @lang('crud.common.delete_selected')
        </button>
        @endcan
    </div>

    <x-modal id="lesson-schedulers-modal" wire:model="showingModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $modalTitle }}</h5>
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div>
                    <x-inputs.group class="col-sm-12 col-lg-6">
                        <x-inputs.datetime
                            name="scheduler.start_at"
                            label="Inicio"
                            wire:model="schedulerStartAt"
                            max="255"
                        ></x-inputs.datetime>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12 col-lg-6">
                        <x-inputs.datetime
                            name="scheduler.end_at"
                            label="Fin"
                            wire:model="schedulerEndAt"
                            max="255"
                        ></x-inputs.datetime>
                    </x-inputs.group>
                </div>
            </div>

            @if($editing) @endif

            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-light float-left"
                    wire:click="$toggle('showingModal')"
                >
                    <i class="icon ion-md-close"></i>
                    @lang('crud.common.cancel')
                </button>

                <button type="button" class="btn btn-primary" wire:click="save">
                    <i class="icon ion-md-save"></i>
                    @lang('crud.common.save')
                </button>
            </div>
        </div>
    </x-modal>

    <div class="table-responsive">
        <table class="table table-borderless table-hover">
            <thead>
                <tr>
                    <th>
                        <input
                            type="checkbox"
                            wire:model="allSelected"
                            wire:click="toggleFullSelection"
                            title="{{ trans('crud.common.select_all') }}"
                        />
                    </th>
                    <th class="text-left">
                        @lang('crud.lesson_schedulers.inputs.start_at')
                    </th>
                    <th class="text-left">
                        @lang('crud.lesson_schedulers.inputs.end_at')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($schedulers as $scheduler)
                <tr class="hover:bg-gray-100">
                    <td class="text-left">
                        <input
                            type="checkbox"
                            value="{{ $scheduler->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="text-left">{{ $scheduler->start_at->format('d-m-Y H:i') ?? '-' }}</td>
                    <td class="text-left">{{ $scheduler->end_at->format('d-m-Y H:i') ?? '-' }}</td>
                    <td class="text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $scheduler)
                            <button
                                type="button"
                                class="btn btn-light"
                                wire:click="editScheduler({{ $scheduler->id }})"
                            >
                                <i class="icon ion-md-create"></i>
                            </button>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">{{ $schedulers->render() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
