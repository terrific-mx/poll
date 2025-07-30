<?php

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
        $this->polls = Auth::user()->polls()->get();
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
    }
}; ?>

<div class="max-w-5xl mx-auto">
    <flux:heading size="xl">Polls</flux:heading>
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
                                        <span class="font-medium">Options:</span>
                                        {{ $poll->options->pluck('label')->join(', ') }}
                                    @else
                                        <span class="italic text-zinc-400">No options</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <div class="text-center text-zinc-500 py-10">No polls found.</div>
    @endif

    <form wire:submit="createPoll" class="space-y-6">
        <flux:input wire:model="pollName" label="Poll Name" />
        <flux:input wire:model="pollQuestion" label="Poll Question" />
        <flux:input wire:model="pollOptions.0" label="Poll Option 1" />
        <flux:input wire:model="pollOptions.1" label="Poll Option 2" />
        <div>
            <flux:button type="submit">{{ __('Create Poll') }}</flux:button>
        </div>
    </form>
</div>
