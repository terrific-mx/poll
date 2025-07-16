<?php

use Livewire\Volt\Component;
use App\Models\Response;
use App\Models\Answer;

new class extends Component {
    public $poll;
    public $answer_id;
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
