<div></div>
<?php

use Livewire\Volt\Component;

new class extends Component {
    public $poll;
    public string $name = '';
    public string $question = '';
    public array $answers = [];

    public function mount()
    {
        $this->name = $this->poll->name;
        $this->question = $this->poll->question;
        $this->answers = $this->poll->answers()->pluck('answer')->toArray();
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required',
            'question' => 'required',
            'answers' => 'required|array|min:2',
            'answers.*' => 'required|distinct',
        ]);

        $this->poll->update([
            'name' => $this->name,
            'question' => $this->question,
        ]);

        $this->poll->answers()->delete();
        $this->poll->answers()->createMany(
            collect($this->answers)->map(fn($a) => ['answer' => $a])->toArray()
        );
    }
};
