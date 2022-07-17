@php $editing = isset($trainer) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="first_name"
            label="Nombres"
            value="{{ old('first_name', ($editing ? $trainer->first_name : '')) }}"
            maxlength="255"
            placeholder="Nombres"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="last_name"
            label="Apellidos"
            value="{{ old('last_name', ($editing ? $trainer->last_name : '')) }}"
            maxlength="255"
            placeholder="Apellidos"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="phone"
            label="Teléfono"
            value="{{ old('phone', ($editing ? $trainer->phone : '')) }}"
            maxlength="255"
            placeholder="Teléfono"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
