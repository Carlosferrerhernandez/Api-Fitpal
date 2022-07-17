@php $editing = isset($lesson) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.select name="category_id" label="Clase" required>
            @php $selected = old('category_id', ($editing ? $lesson->category_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Por favor seleccione la categoría</option>
            @foreach($categories as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.select name="type" label="Modalidad">
            @php $selected = old('type', ($editing ? $lesson->type : '')) @endphp
            <option value="on-site" {{ $selected == 'on-site' ? 'selected' : '' }} >On site</option>
            <option value="on-line" {{ $selected == 'on-line' ? 'selected' : '' }} >On line</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.select name="trainer_id" label="Entrenador" required>
            @php $selected = old('trainer_id', ($editing ? $lesson->trainer_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Por favor seleccione entrenador</option>
            @foreach($trainers as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.select name="gym_id" label="Gimnasio">
            @php $selected = old('gym_id', ($editing ? $lesson->gym_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Por favor seleccione Gimnasio</option>
            @foreach($gyms as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.number
            name="limit"
            label="Límite de participantes"
            value="{{ old('limit', ($editing ? $lesson->limit : '')) }}"
            min="1"
            max="45"
            placeholder="Límite"
            required
        ></x-inputs.number>
    </x-inputs.group>
</div>
