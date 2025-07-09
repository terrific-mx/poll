
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
    @foreach ($polls as $poll)
        <div class="mb-2 p-2 border rounded">
            <strong>{{ $poll->name }}</strong><br>
            <small>Created: {{ $poll->created_at }}</small>
        </div>
    @endforeach
</div>
