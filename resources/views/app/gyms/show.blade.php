@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('gyms.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.gimnasios.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.gimnasios.inputs.name')</h5>
                    <span>{{ $gym->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.gimnasios.inputs.phone')</h5>
                    <span>{{ $gym->phone ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.gimnasios.inputs.address')</h5>
                    <span>{{ $gym->address ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('gyms.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Gym::class)
                <a href="{{ route('gyms.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
