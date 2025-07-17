<?php

use App\Models\Poll;
use Livewire\Volt\Component;

new class extends Component {
    public $polls;

    public function mount()
    {
        $this->polls = Poll::with('answers')->get();
    }
}; ?>

<div>
    <ul>
        @foreach($polls as $poll)
            <li>
                <a href="{{ route('polls.show', $poll) }}">{{ $poll->name }}</a>
                <span class="text-muted">({{ $poll->answers->count() }} answers)</span>
            </li>
        @endforeach
    </ul>
</div>
