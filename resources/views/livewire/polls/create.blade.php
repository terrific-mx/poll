<?php

use Livewire\Volt\Component;

use App\Models\Poll;
use App\Models\Answer;
use Illuminate\Support\Arr;

new class extends Component {
    public string $name = '';
    public string $question = '';
    public array $answers = [];

    public function mount() {
        if (count($this->answers) < 2) {
            $this->answers = Arr::add($this->answers, 0, '');
            $this->answers = Arr::add($this->answers, 1, '');
        }
    }

    public function addAnswer() {
        $this->answers = Arr::add($this->answers, count($this->answers), '');
    }

    public function removeAnswer($index) {
        Arr::forget($this->answers, $index);

        $this->answers = array_values($this->answers);
    }

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'question' => ['required'],
            'answers' => ['required', 'array', 'min:2'],
            'answers.*' => ['required', 'string'],
        ];
    }

    public function submit()
    {
        $this->validate();

        $poll = Poll::create([
            'name' => $this->name,
            'question' => $this->question,
        ]);

        $poll->answers()->createMany($this->answerData());
    }

    private function answerData()
    {
        return collect($this->answers)
            ->map(fn($answer) => ['text' => $answer])
            ->toArray();
    }
}; ?>

<div class="max-w-md mx-auto">
    <flux:breadcrumbs>
        <flux:breadcrumbs.item :href="route('polls.index')" wire:navigate>Polls</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Create</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <flux:heading level="1" size="xl" class="mt-8">Create Poll</flux:heading>

    <form wire:submit="submit" class="space-y-6 mt-8">
        <flux:input
            type="text"
            wire:model="name"
            label="Poll Name"
        />

        <flux:input
            type="text"
            wire:model="question"
            label="Poll Question"
        />

        <flux:fieldset>
            <flux:legend>Answers</flux:legend>

            <div class="space-y-4">
                @foreach ($answers as $i => $answer)
                    <div wire:key="answer-{{ $i }}">
                        <flux:field>
                            <flux:label>Option {{ $i + 1 }}</flux:label>
                            <div class="flex gap-2">
                                <flux:input wire:model="answers.{{ $i }}" type="text" class="flex-1" />
                                <flux:button wire:click="removeAnswer({{ $i }})">Remove</flux:button>
                            </div>
                        </flux:field>
                    </div>
                @endforeach

                <div>
                    <flux:button wire:click="addAnswer" size="sm" icon="plus">Add Answer</flux:button>
                </div>
            </div>
        </flux:fieldset>

        <flux:error name="answers" />

        <div class="mt-4">
            <flux:button type="submit" variant="primary">Save</flux:button>
        </div>
    </form>
</div>
