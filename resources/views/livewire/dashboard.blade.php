
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
            <small>Created: {{ $poll->created_at }}</small>
        </div>
    @endforeach
</div>
