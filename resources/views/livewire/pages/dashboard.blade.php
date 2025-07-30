<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {
    public $pollName = '';
    public $pollQuestion = '';
    public $pollOptions = [];

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

<form class="space-y-6">
    <flux:input wire:model="pollName" label="Poll Name" />
    <flux:input wire:model="pollQuestion" label="Poll Question" />
    <flux:input wire:model="pollOptions.0" label="Poll Option 1" />
    <flux:input wire:model="pollOptions.1" label="Poll Option 2" />
    <div>
        <flux:button>{{ __('Create Poll') }}</flux:button>
    </div>
</form>
