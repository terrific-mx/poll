<?php

use Livewire\Volt\Component;
use App\Models\Poll;

new class extends Component {
    public string $name = '';

    public function save()
    {
        Poll::create([
            'name' => $this->name,
        ]);
    }
}; ?>

<div>
    //
</div>
