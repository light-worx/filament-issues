@php
    $route = request()->route()?->getName();
@endphp

<button
    type="button"
    class="relative ml-4 -mr-1 rounded-full p-2 text-gray-400 hover:text-gray-500 transition duration-150 ease-in-out dark:text-gray-500 dark:hover:text-gray-400"
    title="Help"
    @click.prevent="
        (async () => {
            const route = '{{ $route }}';
            const res = await fetch('/admin/help-document-json?slug=' + route);
            
            // Handle HTTP errors
            if (!res.ok) {
                console.error('Failed to fetch help document:', res.statusText);
                return; 
            }
            
            const json = await res.json();

            // Dispatch a global event with the data payload
            $dispatch('open-help-slideover', {
                title: json.title ?? 'Help',
                content: json.content ?? 'Help document content is empty.'
            });
        })()
    "
>
    <x-filament::icon
        icon="heroicon-o-question-mark-circle"
        class="h-6 w-6"
    />
</button>