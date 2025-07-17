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

    <hr>
<div
    x-data="{
        copied: false,
        copyHtml() {
            const html = this.$refs.answersList.outerHTML;
            navigator.clipboard.write([
                new ClipboardItem({ 'text/html': new Blob([html], { type: 'text/html' }) })
            ]).then(() => {
                this.copied = true;
                setTimeout(() => this.copied = false, 1500);
            });
        }
    }"
    class="mt-6"
>
    <button @click="copyHtml" type="button" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring" x-text="copied ? 'Copied!' : 'Copy for Email'"></button>
        <ul class="space-y-4 mt-4" x-ref="answersList">
            @foreach($poll->answers as $answer)
                <li>
                    <a href="{{ route('polls.respond', $poll) }}">{{ $answer->text }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
