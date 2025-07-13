
<?php
use App\Models\Poll;
use Livewire\Volt\Component;

new class extends Component {
    public $polls;

    public function mount()
    {
        $this->polls = Poll::all();
    }
};
?>

<div>
    <div class="mb-4 flex justify-end">
        <flux:button href="{{ route('polls.create') }}" variant="primary" icon="plus" wire:navigate>
            New Poll
        </flux:button>
    </div>

    @foreach ($polls as $poll)
        <div class="mb-2 p-2 border rounded">
            <strong>{{ $poll->name }}</strong><br>
            <span class="block text-gray-700 mb-1">Question: {{ $poll->question }}</span>
            <small>Created: {{ $poll->created_at }}</small><br>
            <a href="{{ route('polls.vote', $poll) }}" class="text-blue-600 underline text-sm" target="_blank">
            View Public Poll
            </a>
        </div>
    @endforeach
</div>
