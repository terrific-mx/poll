<div></div>
<?php

use Livewire\Volt\Component;

new class extends Component {
    public $poll;
    public string $name = '';
    public string $question = '';

    public function mount()
    {
        $this->name = $this->poll->name;
        $this->question = $this->poll->question;
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required',
            'question' => 'required',
        ]);

        $this->poll->update([
            'name' => $this->name,
            'question' => $this->question,
        ]);
    }
};
