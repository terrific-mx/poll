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

<div class="mx-auto max-w-5xl">
    <!-- Header Section -->
    <div class="flex flex-wrap items-end justify-between gap-4">
        <div class="max-sm:w-full sm:flex-1">
            <flux:heading size="xl">Polls</flux:heading>
            <!-- <div class="mt-4 flex max-w-xl gap-4">
                <div class="flex-1">
                    <flux:input icon="magnifying-glass" placeholder="Search polls" class="w-full" />
                </div>
                <div>
                    <flux:select name="sort_by" class="w-full">
                        <flux:select.option value="name">Sort by name</flux:select.option>
                        <flux:select.option value="created">Sort by created date</flux:select.option>
                        <flux:select.option value="answers">Sort by answer count</flux:select.option>
                    </flux:select>
                </div>
            </div> -->
        </div>
        <flux:button :href="route('polls.create')" variant="primary" wire:navigate>Create poll</flux:button>
    </div>
    <!-- Polls List Section -->
    <ul class="mt-10">
        @foreach($polls as $poll)
            <li>
                <flux:separator :variant="$loop->index > 0 ? 'subtle' : null" />
                <div class="flex items-center justify-between">
                    <div class="flex gap-6 py-6">
                        <div class="space-y-1.5">
                            <flux:heading size="lg">
                                <a href="{{ route('polls.show', $poll) }}" wire:navigate>{{ $poll->name }}</a>
                            </flux:heading>
                            <flux:text size="sm">
                                {{ $poll->answers->count() }} answers
                                @if(isset($poll->created_at))
                                    <span aria-hidden="true">·</span>
                                    Created {{ $poll->created_at->format('M d, Y') }}
                                @endif
                            </flux:text>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <flux:dropdown align="end">
                            <flux:button icon="ellipsis-vertical" variant="subtle" size="sm" />
                            <flux:menu>
                                <flux:navmenu.item :href="route('polls.show', $poll)">View</flux:navmenu.item>
                                <!-- <flux:navmenu.item>Edit</flux:navmenu.item> -->
                                <!-- <flux:navmenu.item>Delete</flux:navmenu.item> -->
                            </flux:menu>
                        </flux:dropdown>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
