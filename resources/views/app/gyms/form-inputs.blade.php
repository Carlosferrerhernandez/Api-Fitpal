@php $editing = isset($gym) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="name"
            label="Nombre"
            value="{{ old('name', ($editing ? $gym->name : '')) }}"
            maxlength="255"
            placeholder="Nombre"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="phone"
            label="Teléfono"
            value="{{ old('phone', ($editing ? $gym->phone : '')) }}"
            maxlength="255"
            placeholder="Teléfono"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="address"
            label="Dirección"
            value="{{ old('address', ($editing ? $gym->address : '')) }}"
            maxlength="255"
            placeholder="Dirección"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
