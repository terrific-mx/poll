<?php

use Livewire\Volt\Component;
use App\Models\Response;
use App\Models\Answer;
use App\Models\Poll;
use Livewire\Attributes\Url;

new class extends Component {
    public Poll $poll;

    public $answer_id;

    #[Url('c')]
    public $contact_email;

    public function rules() {
        return [
            'answer_id' => 'required|exists:answers,id',
            'contact_email' => 'nullable|email',
        ];
    }

    public function submit() {
        $this->validate();
        $answer = Answer::findOrFail($this->answer_id);
        $this->poll->addResponse($answer, $this->contact_email);
    }
}; ?>

<div>
    <!-- Minimal implementation for backend test passing -->
</div>
