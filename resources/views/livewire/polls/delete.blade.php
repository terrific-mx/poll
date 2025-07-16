<?php

use App\Models\Poll;
use Livewire\Volt\Component;

new class extends Component {
    public Poll $poll;

    public function destroy()
    {
        $this->poll->delete();
    }
}; ?>

<div>
    //
</div>
