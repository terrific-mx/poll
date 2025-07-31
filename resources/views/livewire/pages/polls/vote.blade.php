<?php

use App\Models\Poll;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.guest')] class extends Component {
    public Poll $poll;
}; ?>

<form class="max-w-sm mx-auto space-y-6">
    <flux:heading>{{ $poll->question }}</flux:heading>

    <flux:radio.group wire:model="payment">
        @foreach ($poll->options as $option)
            <flux:radio value="{{ $option->id }}" label="{{ $option->label }}" />
        @endforeach
    </flux:radio.group>

    <flux:button type="submit" variant="primary">
        {{ __('Submit') }}
    </flux:button>
</form>
