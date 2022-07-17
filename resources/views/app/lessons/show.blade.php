@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('lessons.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.lessons.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.lessons.inputs.category_id')</h5>
                    <span>{{ optional($lesson->category)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.lessons.inputs.type')</h5>
                    <span>{{ $lesson->type ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.lessons.inputs.trainer_id')</h5>
                    <span
                        >{{ optional($lesson->trainer)->first_name ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.lessons.inputs.gym_id')</h5>
                    <span>{{ optional($lesson->gym)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.lessons.inputs.limit')</h5>
                    <span>{{ $lesson->limit ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('lessons.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Lesson::class)
                <a href="{{ route('lessons.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    @can('view-any', App\Models\Scheduler::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Horarios</h4>

            <livewire:lesson-schedulers-detail :lesson="$lesson" />
        </div>
    </div>
    @endcan
</div>
@endsection
