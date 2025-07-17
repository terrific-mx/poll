<?php

use App\Models\Poll;
use Livewire\Volt\Component;

new class extends Component {
    public Poll $poll;
}; ?>

<div>
    <h1>Name: {{ $poll->name }}</h1>

    <p>Question: {{ $poll->question }}</p>

    <p>Poll link: <a href="{{ route('polls.respond', $poll) }}">{{ route('polls.respond', $poll) }}</a></p>

    <ul class="space-y-4 mt-6">
        @foreach($poll->answers as $answer)
            <li>
                {{ $answer->text }} — {{ $answer->responsesCount }} responses
            </li>
        @endforeach
    </ul>
</div>
