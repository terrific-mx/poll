<?php

use Livewire\Volt\Component;
use App\Models\Poll;
use App\Models\Answer;

new class extends Component {
    public string $name = '';
    public string $question = '';
    public array $answers = [];

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
            ->map(fn($answer) => ['answer' => $answer])
            ->toArray();
    }
}; ?>

<div>
    <!-- Minimal implementation for test passing -->
</div>
