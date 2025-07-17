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
        if (count($this->answers) > 2) {
            Arr::forget($this->answers, $index);

            $this->answers = array_values($this->answers);
        }
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
    <form wire:submit="submit" class="space-y-6">
        <flux:input
            type="text"
            wire:model="name"
            label="Poll Name"
            placeholder="Enter poll name"
        />

        <flux:input
            type="text"
            wire:model="question"
            label="Poll Question"
            placeholder="Enter poll question"
        />

        <div class="space-y-6">
            @foreach ($answers as $i => $answer)
                <div wire:key="answer-{{ $i }}" class="flex items-center gap-2">
                    <flux:input
                        type="text"
                        wire:model="answers.{{ $i }}"
                        label="Answer {{ $i + 1 }}"
                        placeholder="Enter answer {{ $i + 1 }}"
                    />
                    @if (count($answers) > 2)
                        <button type="button" wire:click="removeAnswer({{ $i }})" class="text-red-500 px-2 py-1 rounded hover:bg-red-100">Remove</button>
                    @endif
                </div>
            @endforeach
        </div>

        <div>
            <button type="button" wire:click="addAnswer" class="mt-2 text-blue-600 px-3 py-1 rounded hover:bg-blue-100">+ Add Answer</button>
        </div>

        <flux:error name="answers" />

        <div class="mt-4">
            <flux:button type="submit">Create Poll</flux:button>
        </div>
    </form>
</div>
