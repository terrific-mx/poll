<?php

use App\Models\Poll;
use Livewire\Volt\Component;

new class extends Component {
    public $name;
    public $question;
    public $answers = [];

    public function save()
    {
        $poll = Poll::create([
            'name' => $this->name,
            'question' => $this->question,
        ]);

        $poll->answers()->createMany($this->answers);
    }
}; ?>

<div class="max-w-sm mx-auto">
    <form wire:submit="save" class="space-y-6">
        <flux:input wire:model="name" label="Name" />
        <flux:input wire:model="question" label="Question" />
        <flux:button type="submit" variant="primary">Save</flux:button>
    </form>
</div>
