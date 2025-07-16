<div></div>
<?php

use App\Models\Poll;
use App\Models\Answer;
use Livewire\Volt\Component;

new class extends Component {
    public $poll;
    public string $name = '';
    public string $question = '';
    public array $answers = [];

    public function mount($poll)
    {
        $this->poll = Poll::findOrFail($poll);
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
        foreach ($this->answers as $answer) {
            $this->poll->answers()->create(['answer' => $answer]);
        }
    }
};
