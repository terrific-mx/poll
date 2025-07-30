<?php

use Flux\Flux;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {
    public ?Collection $polls = null;

    public $pollName = '';
    public $pollQuestion = '';
    public $pollOptions = [];

    public function mount()
    {
        $this->loadPolls();
    }

    public function createPoll()
    {
        $this->validate([
            'pollName' => 'required|string|max:255',
            'pollQuestion' => 'required|string|max:255',
            'pollOptions.*' => 'required|string|max:255',
        ]);

        $poll = Auth::user()->polls()->create([
            'name' => $this->pollName,
            'question' => $this->pollQuestion,
        ]);

        $poll->options()->createMany(
            collect($this->pollOptions)
                ->map(fn($option) => ['label' => $option])
                ->all()
        );

        $this->loadPolls();

        Flux::modal('create-poll')->close();

        $this->reset('pollName', 'pollQuestion', 'pollOptions');
    }

    private function loadPolls()
    {
        $this->polls = Auth::user()->polls()->get();
    }
}; ?>

<div class="max-w-6xl mx-auto">
    <div class="flex items-end justify-between gap-4">
        <flux:heading size="xl">{{ __('Polls') }}</flux:heading>
        <flux:modal.trigger name="create-poll">
            <flux:button variant="primary">{{ __('Create Poll') }}</flux:button>
        </flux:modal.trigger>
    </div>
    @if($polls)
        <ul>
            @foreach ($polls as $poll)
                <li>
                    @unless($loop->first) <flux:separator /> @endunless
                    <div class="flex items-center justify-between">
                        <div class="flex gap-6 py-6">
                            <div class="space-y-1.5">
                                <div class="text-base/6 font-semibold">{{ $poll->name }}</div>
                                <div class="text-xs/6 text-zinc-500">{{ $poll->question }}</div>
                                <div class="text-xs/6 text-zinc-600">
                                    @if($poll->options && $poll->options->count())
                                        <span class="font-medium">{{ __('Options:') }}</span>
                                        {{ $poll->options->pluck('label')->join(', ') }}
                                    @else
                                        <span class="italic text-zinc-400">{{ __('No options') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <div class="text-center text-zinc-500 py-10">{{ __('No polls found.') }}</div>
    @endif

    <flux:modal name="create-poll" class="md:w-96">
        <form wire:submit="createPoll" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Create a New Poll') }}</flux:heading>
                <flux:text class="mt-2">{{ __('Fill in the details below to create a new poll.') }}</flux:text>
            </div>
            <flux:input wire:model="pollName" :label="__('Poll Name')" />
            <flux:input wire:model="pollQuestion" :label="__('Poll Question')" />
            <flux:input wire:model="pollOptions.0" :label="__('Poll Option 1')" />
            <flux:input wire:model="pollOptions.1" :label="__('Poll Option 2')" />
            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary">{{ __('Create Poll') }}</flux:button>
            </div>
        </form>
    </flux:modal>
</div>
