@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('trainers.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.entrenadores.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.entrenadores.inputs.first_name')</h5>
                    <span>{{ $trainer->first_name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.entrenadores.inputs.last_name')</h5>
                    <span>{{ $trainer->last_name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.entrenadores.inputs.phone')</h5>
                    <span>{{ $trainer->phone ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('trainers.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Trainer::class)
                <a href="{{ route('trainers.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
