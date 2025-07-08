<?php

use Livewire\Volt\Component;

new class extends Component {
    public string $name = '';

    public function save()
    {
        \App\Models\Poll::create([
            'name' => $this->name,
        ]);
    }
}; ?>

<div>
    //
</div>
