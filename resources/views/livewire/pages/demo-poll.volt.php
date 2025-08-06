<?php
use Livewire\Volt\Component;

return new class extends Component {
    public $respuesta = '';
    public $enviado = false;

    public function submit()
    {
        $this->enviado = true;
    }
};
?>

<div>
    @if ($enviado)
        <div class="p-6 text-center text-green-700 dark:text-green-300">
            <strong>¡Gracias por tu respuesta!</strong>
            <div>Así funciona una encuesta demo en Terrific Poll.</div>
        </div>
    @else
        <flux:card class="bg-zinc-50 dark:bg-zinc-800">
            <form wire:submit.prevent="submit" class="space-y-6">
                <flux:radio.group label="¿Qué tan probable es que recomiendes nuestro newsletter a un amigo?">
                    <flux:radio wire:model="respuesta" value="muy_probable" label="Muy probable" />
                    <flux:radio wire:model="respuesta" value="algo_probable" label="Algo probable" />
                    <flux:radio wire:model="respuesta" value="nada_probable" label="Nada probable" />
                </flux:radio.group>

                <flux:button type="submit" variant="primary" :disabled="!$respuesta">Enviar</flux:button>
            </form>
        </flux:card>
    @endif
</div>
