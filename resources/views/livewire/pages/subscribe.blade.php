<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    public function mount()
    {
        $stripePriceId = config('services.stripe.price_id');

        $this->redirect(Auth::user()->newSubscription('default', $stripePriceId)
            ->trialDays(31)
            ->checkout([
                'success_url' => route('dashboard'),
                'cancel_url' => route('settings.profile'),
            ])->asStripeCheckoutSession()->url);
    }
}; ?>

<div>
    <!-- You are being redirected to Stripe Checkout... -->
</div>
