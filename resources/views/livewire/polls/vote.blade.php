<?php

use App\Models\Poll;
use App\Models\Vote;
use Livewire\Volt\Component;

new class extends Component {
    public Poll $poll;
    public $answer;
    public $contact = null;

    public function vote()
    {
        Vote::create([
            'poll_id' => $this->poll->id,
            'answer_id' => $this->answer,
            'contact' => $this->contact,
        ]);
    }
}; ?>

<div>
    //
</div>
