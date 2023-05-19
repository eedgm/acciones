@php $editing = isset($action) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="numero"
            label="Numero"
            :value="old('numero', ($editing ? $action->numero : ''))"
            maxlength="255"
            placeholder="Numero"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.date
            name="fecha"
            label="Fecha límite"
            value="{{ old('fecha', ($editing ? optional($action->fecha)->format('Y-m-d') : '')) }}"
            max="255"
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="accion"
            label="Accion"
            :value="old('accion', ($editing ? $action->accion : ''))"
            maxlength="255"
            placeholder="Accion"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="descripcion"
            label="Descripcion"
            maxlength="255"
            >{{ old('descripcion', ($editing ? $action->descripcion : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.select name="statu_id" label="Statu" required>
            @php $selected = old('statu_id', ($editing ? $action->statu_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Statu</option>
            @foreach($status as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.select name="prioridad_id" label="Prioridad" required>
            @php $selected = old('prioridad_id', ($editing ? $action->prioridad_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Prioridad</option>
            @foreach($prioridads as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
