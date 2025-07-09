<?php

use Livewire\Volt\Component;
use App\Models\Poll;

new class extends Component {
    public string $name = '';
    public array $answers = [''];

    public function addAnswer()
    {
        $this->answers[] = '';
    }

    public function removeAnswer($index)
    {
        unset($this->answers[$index]);
        $this->answers = array_values($this->answers); // reindex
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'answers' => 'array|min:1',
            'answers.*' => 'required|string',
        ]);

        $poll = Poll::create([
            'name' => $this->name,
        ]);

        foreach ($this->answers as $answer) {
            $poll->answers()->create(['text' => $answer]);
        }

        // Optionally reset form
        $this->name = '';
        $this->answers = [''];
    }
}; ?>

<form wire:submit.prevent="save" class="space-y-6 max-w-lg mx-auto mt-8">
    <flux:input wire:model="name" label="Poll Name" placeholder="Enter poll name" />

    <div class="space-y-1">
        <div class="space-y-6">
            @foreach ($answers as $index => $answer)
                <div class="flex items-center gap-2 mt-2">
                    <flux:input wire:model="answers.{{ $index }}" label="Answer {{ $index + 1 }}" placeholder="Enter answer option" class="flex-1" />
                    <flux:button type="button" variant="danger" size="xs" wire:click="removeAnswer({{ $index }})">Remove</flux:button>
                </div>
            @endforeach
        </div>
        <flux:button type="button" size="sm" class="mt-2" wire:click="addAnswer">Add Answer</flux:button>
    </div>

    <div class="mt-6">
        <flux:button type="submit" variant="primary">Save Poll</flux:button>
    </div>
</form>
