@php $editing = isset($agrupacion) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.textarea name="nombre" label="Nombre" maxlength="255" required
            >{{ old('nombre', ($editing ? $agrupacion->nombre : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
