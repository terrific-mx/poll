<?php

use Livewire\Volt\Component;
use App\Models\Poll;

new class extends Component {
    public string $name = '';
    public array $answers = [];

    public function save()
    {
        $poll = Poll::create([
            'name' => $this->name,
        ]);
        foreach ($this->answers as $answer) {
            $poll->answers()->create(['text' => $answer]);
        }
    }
}; ?>

<div>
    //
</div>
