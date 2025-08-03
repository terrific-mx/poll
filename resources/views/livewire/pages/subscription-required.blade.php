<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('components.layouts.auth')] class extends Component {
    //
}; ?>

<div class="mt-4 flex flex-col gap-6">
    <flux:text class="text-center">
        {{ __('You need to subscribe to our service to continue.') }}
    </flux:text>
    <div class="flex flex-col items-center justify-between space-y-3">
        <flux:button href="{{ route('subscribe') }}" variant="primary" class="w-full">
            {{ __('Proceed to Checkout') }}
        </flux:button>
    </div>
</div>
