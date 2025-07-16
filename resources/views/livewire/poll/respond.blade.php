<?php

use Livewire\Volt\Component;
use App\Models\Response;

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
        Response::create([
            'poll_id' => $this->poll->id,
            'answer_id' => $this->answer_id,
            'contact_email' => $this->contact_email,
        ]);
    }
}; ?>

<div>
    <!-- Minimal implementation for backend test passing -->
</div>
