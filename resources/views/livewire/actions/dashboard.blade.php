<div>
    <div class="py-12">
        <div class="mx-auto max-w-9xl sm:px-6 lg:px-8">
            <x-partials.card>
                <div class="mt-4 mb-5">
                    <div class="flex flex-wrap justify-between">
                        <div class="md:w-6/12">
                            <form wire:submit.prevent="searchResult">
                                <div class="flex items-center w-full">
                                    <x-inputs.text
                                        name="search"
                                        value="{{ $search ?? '' }}"
                                        wire:model.defer="search"
                                        placeholder="{{ __('crud.common.search') }}"
                                        autocomplete="off"
                                    ></x-inputs.text>

                                    <div class="ml-1">
                                        <button
                                            class="button button-primary"
                                        >
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="pl-5 text-left md:w-2/12">
                            <input type="checkbox" wire:click="filterCompleted" id="completed"><label class="pl-2" for="completed">Mostrar solo completados</label>
                        </div>
                        <div class="text-right md:w-4/12">
                            @can('create', App\Models\Action::class)
                            <a
                                href="#"
                                wire:click="create"
                                class="button button-primary"
                            >
                                <i class="mr-1 icon ion-md-add"></i>
                                @lang('crud.common.create')
                            </a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="hidden">
                    <div class="bg-blue-100"></div>
                    <div class="bg-yellow-100"></div>
                    <div class="bg-sky-100"></div>
                    <div class="bg-green-100"></div>
                    <div class="bg-red-100"></div>
                </div>

                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent">
                        <thead class="text-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.actions.inputs.numero')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.actions.inputs.accion')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.actions.inputs.fecha')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.actions.inputs.descripcion')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.actions.inputs.statu_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.actions.inputs.prioridad_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.actions.inputs.agrupaciones')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.actions.inputs.users')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($actions as $action)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $action->numero ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $action->accion() ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $action->fecha->format('M d, y') ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $action->excerpt() ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left bg-{{ optional($action->statu)->color }}-100">
                                    {{ optional($action->statu)->nombre ?? '-'
                                    }}
                                </td>
                                <td class="px-4 py-3 text-left bg-{{ optional($action->prioridad)->color }}-100">
                                    {{ optional($action->prioridad)->nombre ??
                                    '-' }}
                                </td>
                                <td>
                                    @foreach ($action->agrupacions as $cluster)
                                        <span class="px-2 py-1 text-xs truncate rounded-full bg-gray-50">{{ $cluster->nombre }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($action->users as $user)
                                        <span class="px-2 py-1 text-xs truncate rounded-full bg-pink-50">{{ $user->name }}</span>
                                    @endforeach
                                </td>
                                <td
                                    class="px-4 py-3 text-center"
                                    style="width: 134px;"
                                >
                                    <div
                                        role="group"
                                        aria-label="Row Actions"
                                        class="relative inline-flex align-middle "
                                    >
                                        @can('update', $action)
                                        <a
                                            href="#"
                                            wire:click="edit({{ $action->id }})"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i
                                                    class="icon ion-md-create"
                                                ></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $action)
                                        <form
                                            action="{{ route('actions.destroy', $action) }}"
                                            method="POST"
                                            onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                        >
                                            @csrf @method('DELETE')
                                            <button
                                                type="submit"
                                                class="button"
                                            >
                                                <i
                                                    class="text-red-600 icon ion-md-trash"
                                                ></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                {{ $actions->links() }}
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </x-partials.card>
        </div>
    </div>

    <x-modal wire:model="showingModal">
        <div class="px-6 py-4">
            <div class="text-lg font-bold">{{ $modalTitle }}</div>

            <div class="mt-5">
                <div class="flex flex-wrap">
                    <x-inputs.group class="w-full lg:w-6/12">
                        <x-inputs.text
                            name="numero"
                            label="Numero"
                            wire:model.defer="action.numero"
                            maxlength="255"
                            placeholder="Numero"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="w-full lg:w-6/12">
                        <x-inputs.date
                            name="fecha"
                            label="Fecha límite"
                            wire:model.defer="actionFecha"
                            max="255"
                        ></x-inputs.date>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="accion"
                            label="Accion"
                            wire:model.defer="action.accion"
                            maxlength="255"
                            placeholder="Accion"
                            required
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.textarea
                            name="descripcion"
                            label="Descripcion"
                            wire:model.defer="action.descripcion"
                            ></x-inputs.textarea
                        >
                    </x-inputs.group>

                    <x-inputs.group class="w-full lg:w-6/12">
                        <x-inputs.select name="statu_id" label="Statu" wire:model.defer="action.statu_id" required>
                            <option>Por Favor seleccione el Statu</option>
                            @foreach($status as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="w-full lg:w-6/12">
                        <x-inputs.select name="prioridad_id" wire:model.defer="action.prioridad_id" label="Prioridad" required>
                            <option>Por Favor seleccione la Prioridad</option>
                            @foreach($priorities as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>
                </div>
            </div>
        </div>

        <div class="flex justify-between px-6 py-4 bg-gray-50">
            <button
                type="button"
                class="button"
                wire:click="$toggle('showingModal')"
            >
                <i class="mr-1 icon ion-md-close"></i>
                @lang('crud.common.cancel')
            </button>

            <button
                type="button"
                class="button button-primary"
                wire:click="saveAction"
            >
                <i class="mr-1 icon ion-md-save"></i>
                @lang('crud.common.save')
            </button>
        </div>
    </x-modal>

    <x-modal wire:model="showingModalEdit">
        <div class="px-6 py-4">
            <div class="text-lg font-bold">{{ $modalTitleEdit }}</div>

            <div class="mt-5">
                <div class="flex flex-wrap">
                    <x-inputs.group class="w-full lg:w-6/12">
                        <x-inputs.text
                            name="numero"
                            label="Numero"
                            wire:model.defer="action.numero"
                            maxlength="255"
                            placeholder="Numero"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="w-full lg:w-6/12">
                        <x-inputs.date
                            name="fecha"
                            label="Fecha límite"
                            wire:model.defer="actionFecha"
                            max="255"
                        ></x-inputs.date>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="accion"
                            label="Accion"
                            wire:model.defer="action.accion"
                            maxlength="255"
                            placeholder="Accion"
                            required
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.textarea
                            name="descripcion"
                            label="Descripcion"
                            wire:model.defer="action.descripcion"
                            ></x-inputs.textarea
                        >
                    </x-inputs.group>

                    <x-inputs.group class="w-full lg:w-6/12">
                        <x-inputs.select name="statu_id" label="Statu" wire:model.defer="action.statu_id" required>
                            <option disabled>Please select the Statu</option>
                            @foreach($status as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="w-full lg:w-6/12">
                        <x-inputs.select name="prioridad_id" wire:model.defer="action.prioridad_id" label="Prioridad" required>
                            <option disabled>Please select the Prioridad</option>
                            @foreach($priorities as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>
                    @if ($actionEdit)
                        @can('view-any', App\Models\User::class)
                        <x-partials.card class="w-full lg:w-6/12">
                            <x-slot name="title"> Users </x-slot>

                            <livewire:action-users-detail :action="$actionEdit" :key="$actionEdit->id" />
                        </x-partials.card>
                        @endcan @can('view-any', App\Models\Agrupacion::class)
                        <x-partials.card class="w-full lg:w-6/12">
                            <x-slot name="title"> Agrupacions </x-slot>

                            <livewire:action-agrupacions-detail :action="$actionEdit" :key="$actionEdit->id" />
                        </x-partials.card>
                        @endcan
                    @endif


                </div>
            </div>
        </div>

        <div class="flex justify-between px-6 py-4 bg-gray-50">
            <button
                type="button"
                class="button"
                wire:click="$toggle('showingModalEdit')"
            >
                <i class="mr-1 icon ion-md-close"></i>
                @lang('crud.common.cancel')
            </button>

            <button
                type="button"
                class="button button-primary"
                wire:click="updateAction"
            >
                <i class="mr-1 icon ion-md-save"></i>
                @lang('crud.common.save')
            </button>
        </div>
    </x-modal>

</div>
