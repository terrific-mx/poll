<?php

use App\Models\Poll;
use Livewire\Volt\Component;

new class extends Component {
    public $name;
    public $question;

    public function save()
    {
        Poll::create([
            'name' => $this->name,
            'question' => $this->question,
        ]);
    }
}; ?>

<div>
    //
</div>
