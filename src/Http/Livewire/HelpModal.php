<?php

namespace Lightworx\FilamentIssues\Http\Livewire;

use Livewire\Component;
use Lightworx\FilamentIssues\Models\HelpDocument;

class HelpModal extends Component
{
    public $isOpen = false;
    public $helpText = '';

    protected $listeners = ['openHelpModal'];

    public function openHelpModal($slug = null)
    {
        $slug ??= 'admin';

        $this->helpText = HelpDocument::where('slug', $slug)
            ->first()?->text ?? 'No help available for this page.';

        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function render()
    {
        return view('filament-issues::livewire.help-modal');
    }
}
