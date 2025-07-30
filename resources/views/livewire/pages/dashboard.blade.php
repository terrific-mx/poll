<?php

use Livewire\Volt\Component;

new class extends Component {
    public $pollName = '';
    public $pollQuestion = '';
    public $pollOptions = [];
}; ?>

<form class="space-y-6">
    <flux:input wire:model="pollName" label="Poll Name" />
    <flux:input wire:model="pollQuestion" label="Poll Question" />
    <flux:input wire:model="pollOptions.0" label="Poll Option 1" />
    <flux:input wire:model="pollOptions.1" label="Poll Option 2" />
    <div>
        <flux:button>{{ __('Create Poll') }}</flux:button>
    </div>
</form>
