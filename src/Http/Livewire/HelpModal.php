<?php

namespace Lightworx\FilamentIssues\Http\Livewire;

use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;
use Lightworx\FilamentIssues\Models\HelpDocument;

class HelpModal extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    public string $activeTab = '';

    // Property to hold the fetched document
    public ?HelpDocument $helpDocument = null; 

    public function mount()
    {
        // 1. Fetch the contextual help document on mount
        // NOTE: Replace this call with your actual Service Provider method call
        $this->helpDocument = $this->getContextualHelp();
    }
    
    // 2. Define the contextual help retrieval logic (or call your SP method here)
    public function getContextualHelp(): ?HelpDocument
    {
        $currentRoute = request()->route()?->getName();

        if (!$currentRoute) {
            return null;
        }

        // Exact match
        $helpDoc = HelpDocument::where('slug', $currentRoute)
            ->where('is_published', true)
            ->first();

        if ($helpDoc) {
            return $helpDoc;
        }

        // Partial matching: last 1-3 segments of route
        $routeParts = explode('.', $currentRoute);
        $slugPatterns = array_filter([
            end($routeParts),
            implode('.', array_slice($routeParts, -2)),
            implode('.', array_slice($routeParts, -3)),
        ]);

        foreach ($slugPatterns as $pattern) {
            $helpDoc = HelpDocument::where('slug', $pattern)
                ->where('is_published', true)
                ->first();
            if ($helpDoc) {
                return $helpDoc;
            }
        }

        return null;
    }

    public function render()
    {
        return view('filament-issues::livewire.help-modal');
    }

    public function issuesAction(): Action
    {
        // Use the title from the help document for the modal heading
        $modalHeading = $this->helpDocument?->title ?? 'Help & Information'; 

        return Action::make('issues')
            ->icon('heroicon-c-question-mark-circle') 
            ->tooltip('View Contextual Help')        
            ->modalHeading($modalHeading)      
            ->modalSubmitAction(false)
            ->modalWidth('xl')                
            ->modalCancelActionLabel('Close')         
            
            // 4. Pass the document content to the modal view
            ->modalContent(function () {
                // Ensure you have a 'content' field on your HelpDocument model
                $helpContent = $this->helpDocument?->help_text ?? 'No content found.'; 

                return view('filament-issues::livewire.help-modal-content', [
                    'content' => $helpContent,
                ]);
            });
    }
}