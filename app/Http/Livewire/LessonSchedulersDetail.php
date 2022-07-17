<?php

namespace App\Http\Livewire;

use App\Models\Lesson;
use Livewire\Component;
use App\Models\Scheduler;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LessonSchedulersDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Lesson $lesson;
    public Scheduler $scheduler;
    public $schedulerStartAt;
    public $schedulerEndAt;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Scheduler';

    protected $rules = [
        'schedulerStartAt' => ['required', 'date'],
        'schedulerEndAt' => ['required', 'date'],
    ];

    public function mount(Lesson $lesson)
    {
        $this->lesson = $lesson;
        $this->resetSchedulerData();
    }

    public function resetSchedulerData()
    {
        $this->scheduler = new Scheduler();

        $this->schedulerStartAt = null;
        $this->schedulerEndAt = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newScheduler()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.lesson_schedulers.new_title');
        $this->resetSchedulerData();

        $this->showModal();
    }

    public function editScheduler(Scheduler $scheduler)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.lesson_schedulers.edit_title');
        $this->scheduler = $scheduler;

        $this->schedulerStartAt = $this->scheduler->start_at->format('Y-m-d H:i');
        $this->schedulerEndAt = $this->scheduler->end_at->format('Y-m-d H:i');

        $this->dispatchBrowserEvent('refresh');

        $this->showModal();
    }

    public function showModal()
    {
        $this->resetErrorBag();
        $this->showingModal = true;
    }

    public function hideModal()
    {
        $this->showingModal = false;
    }

    public function save()
    {
        $this->validate();

        if (!$this->scheduler->lesson_id) {
            $this->authorize('create', Scheduler::class);

            $this->scheduler->lesson_id = $this->lesson->id;
        } else {
            $this->authorize('update', $this->scheduler);
        }

        $this->scheduler->start_at = \Carbon\Carbon::parse(
            $this->schedulerStartAt
        );
        $this->scheduler->end_at = \Carbon\Carbon::parse($this->schedulerEndAt);

        $this->scheduler->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', Scheduler::class);

        Scheduler::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetSchedulerData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->lesson->schedulers as $scheduler) {
            array_push($this->selected, $scheduler->id);
        }
    }

    public function render()
    {
        return view('livewire.lesson-schedulers-detail', [
            'schedulers' => $this->lesson->schedulers()->paginate(20),
        ]);
    }
}
