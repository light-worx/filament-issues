<x-filament::modal id="help-modal" wire:model="isOpen">
    <div class="p-4">
        {!! $helpText !!}
    </div>
    <x-slot name="footer">
        <x-filament::button wire:click="closeModal">Close</x-filament::button>
    </x-slot>
</x-filament::modal>
