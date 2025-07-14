<?php

use App\Models\Answer;
use App\Models\Poll;
use App\Models\Response;
use Livewire\Volt\Component;

new class extends Component {
    public Poll $poll;
    public $answer;
    public $contact = null;

    public function vote()
    {
        $this->poll->addResponse(
            Answer::find($this->answer), $this->contact
        );
    }
}; ?>

<div>
    //
</div>
