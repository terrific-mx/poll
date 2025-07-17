<?php

use Livewire\Volt\Component;
use App\Models\Answer;
use App\Models\Poll;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

new #[Layout('components.layouts.poll')] class extends Component {
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
    {{ $poll->title }}
</div>
