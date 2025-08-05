<?php

use App\Models\Option;
use App\Models\Poll;
use Flux\Flux;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Volt\Component;

new class extends Component {
    public Poll $poll;
    public Collection $options;
    public $selectedOption = null;
    public $selectedResponses = null;
    public array $newsletterServices = [];

    public function mount()
    {
        $this->options = $this->poll->options()->withCount('responses')->get();
        $this->newsletterServices = [
            'beehiiv' => ['label' => 'Beehiiv', 'merge' => '{{email}}'],
            'brevo' => ['label' => 'Brevo', 'merge' => '{{contact.EMAIL}}'],
            'emailoctopus' => ['label' => 'EmailOctopus', 'merge' => '{{EmailAddress}}'],
            'ghost' => ['label' => 'Ghost', 'merge' => '{{email}}'],
            'hubspot' => ['label' => 'HubSpot', 'merge' => '{{personalization_token(\'contact.email\',\'\')}}'],
            'kit' => ['label' => 'Kit', 'merge' => '{{ subscriber.email_address }}'],
            'loops' => ['label' => 'Loops', 'merge' => '{email}'],
            'mailerlite' => ['label' => 'MailerLite', 'merge' => '{$email}'],
            'sendy' => ['label' => 'Sendy', 'merge' => '[Email]'],
        ];
    }

    public function showResponses(Option $option)
    {
        $this->selectedOption = $option;
        $this->selectedResponses = $this->selectedOption->responses()->latest()->get();
        $this->options = $this->poll->options()->withCount('responses')->get();

        Flux::modal('show-responses-modal')->show();
    }
}; ?>

<div class="max-w-5xl mx-auto" x-data="{
    copied: false,
    copyHtml(ref) {
        const html = this.$refs[ref].innerHTML;
        if (navigator.clipboard && window.ClipboardItem) {
            const blob = new Blob([html], { type: 'text/html' });
            const item = new ClipboardItem({ 'text/html': blob });
            navigator.clipboard.write([item]).then(() => {
                this.copied = true;
                setTimeout(() => this.copied = false, 1500);
            });
        }
    }
}">
    <div class="flex items-end justify-between gap-4">
        <flux:heading size="xl">{{ $poll->name }}</flux:heading>
        <div class="flex gap-2">
            <flux:modal.trigger name="embed-newsletter">
                <flux:button>{{ __('Embed in Newsletter') }}</flux:button>
            </flux:modal.trigger>
            <flux:button variant="primary" @click="copyHtml('embed')" x-text="copied ? '{{ __('Copied!') }}' : '{{ __('Copy embed code') }}'">{{ __('Copy embed code') }}</flux:button>
        </div>
    </div>

    <div class="mt-10 hidden" x-ref="embed">
        <div class="font-medium">{{ $poll->question }}</div>
        <ul class="mt-6 text-sm space-y-2 list-disc ml-6">
            @foreach ($poll->options as $option)
                <li><a href="{{ route('polls.vote', ['poll' => $poll, 'option' => $option->id]) }}" class="underline">{{ $option->label }}</a></li>
            @endforeach
        </ul>
    </div>

    <div class="mt-10">
        <flux:heading size="lg">{{ $poll->question }}</flux:heading>

        @if($options->count())
            <flux:table class="mt-2">
                <flux:table.columns>
                    <flux:table.column>{{ __('Option') }}</flux:table.column>
                    <flux:table.column>{{ __('Count') }}</flux:table.column>
                </flux:table.columns>

                <flux:table.rows>
                    @foreach ($options as $option)
                        <flux:table.row>
                            <flux:table.cell variant="strong">{{ $option->label }}</flux:table.cell>
                            <flux:table.cell>{{ $option->responses_count }}</flux:table.cell>
                            <flux:table.cell align="end">
                                <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" inset="top bottom" wire:click="showResponses({{ $option->id }})"></flux:button>
                            </flux:table.cell>
                        </flux:table.row>
                    @endforeach
                </flux:table.rows>
            </flux:table>
        @else
            <flux:text>{{ __('No responses yet.') }}</flux:text>
        @endif
    </div>

    <flux:modal name="show-responses-modal" class="md:w-96" variant="flyout">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Responses for') }} {{ $selectedOption?->label }}</flux:heading>
            </div>

            @if($selectedResponses && $selectedResponses->count())
                <flux:table>
                    <flux:table.columns>
                        <flux:table.column>{{ __('Email') }}</flux:table.column>
                        <flux:table.column>{{ __('Date') }}</flux:table.column>
                    </flux:table.columns>
                    <flux:table.rows>
                        @foreach($selectedResponses as $response)
                            <flux:table.row :key="$response->id">
                                <flux:table.cell>{{ $response->contact_email ?? __('Anonymous') }}</flux:table.cell>
                                <flux:table.cell>{{ $response->created_at->format('Y-m-d') }}</flux:table.cell>
                            </flux:table.row>
                        @endforeach
                    </flux:table.rows>
                </flux:table>
            @else
                <flux:text>{{ __('No responses for this option yet.') }}</flux:text>
            @endif
        </div>
    </flux:modal>

    <flux:modal name="embed-newsletter" class="md:w-96" x-data="{
        copied: false,
        copyNewsletter(ref) {
            const html = this.$refs[ref].innerHTML;

            if (navigator.clipboard && window.ClipboardItem) {
                const blob = new Blob([html], { type: 'text/html' });
                const item = new ClipboardItem({ 'text/html': blob });

                navigator.clipboard.write([item]).then(() => {
                    this.copied = true;
                    setTimeout(() => this.copied = false, 1500);
                });
            }
        }
    }">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Embed in Newsletter') }}</flux:heading>
                <flux:text class="mt-2">{{ __('Copy and paste this markup into your newsletter platform. The links will prepopulate the contact email field for each subscriber.') }}</flux:text>
            </div>
            <flux:tab.group>
                <div class="overflow-x-scroll">
                    <flux:tabs>
                        @foreach ($this->newsletterServices as $key => $service)
                            <flux:tab name="{{ $key }}">{{ $service['label'] }}</flux:tab>
                        @endforeach
                    </flux:tabs>
                </div>
                @foreach ($this->newsletterServices as $key => $service)
                    <flux:tab.panel name="{{ $key }}">
                        <div x-ref="newsletter{{ ucfirst($key) }}">
                            <div class="font-medium">{{ $poll->question }}</div>
                            <ul class="mt-6 text-sm space-y-2 list-disc ml-6">
                                @foreach ($poll->options as $option)
                                    <li>
                                        <a href="{{ route('polls.vote', [
                                            'poll' => $this->poll,
                                            'option' => $option->id,
                                            'contact_email' => $service['merge']
                                        ]) }}" class="underline">
                                            {{ $option->label }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="flex items-center gap-2">
                            <flux:spacer />
                            <flux:button
                                type="button"
                                variant="primary"
                                @click="copyNewsletter('newsletter{{ ucfirst($key) }}')"
                                x-text="copied ? '{{ __('Copied!') }}' : '{{ __('Copy') }}'"
                            >{{ __('Copy') }}</flux:button>
                        </div>
                    </flux:tab.panel>
                @endforeach
            </flux:tab.group>
        </div>
    </flux:modal>
</div>
