@php $editing = isset($statu) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="nombre"
            label="Nombre"
            :value="old('nombre', ($editing ? $statu->nombre : ''))"
            maxlength="255"
            placeholder="Nombre"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="color"
            label="Color"
            :value="old('color', ($editing ? $statu->color : ''))"
            maxlength="25"
            placeholder="Color"
        ></x-inputs.text>
    </x-inputs.group>
</div>
