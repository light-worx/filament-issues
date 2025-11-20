<?php

use Illuminate\Support\Facades\Route;
use Lightworx\FilamentIssues\Models\HelpDocument;

Route::get('/admin/help-document-json', function () {
    $currentRoute = request()->query('slug');

    // 1. Check for exact route match first
    $helpDoc = HelpDocument::where('slug', $currentRoute)
        ->where('is_published', true)
        ->first();

    if ($helpDoc) {
        return response()->json([
            'title' => $helpDoc->title,
            'content' => $helpDoc->content,
        ]);
    }

    // 2. Try partial matching
    if ($currentRoute) {
        $routeParts = explode('.', $currentRoute);
        // Patterns: last 2 segments, last 3 segments, last 1 segment (e.g., 'resources.index', 'admin.resources.index', 'index')
        $slugPatterns = [
            implode('.', array_slice($routeParts, -2)),
            implode('.', array_slice($routeParts, -3)),
            end($routeParts),
        ];

        foreach ($slugPatterns as $pattern) {
            if (empty($pattern)) continue; // Skip if a part is empty
            
            $helpDoc = HelpDocument::where('slug', $pattern)
                ->where('is_published', true)
                ->first();
                
            if ($helpDoc) {
                return response()->json([
                    'title' => $helpDoc->title,
                    'content' => $helpDoc->content,
                ]);
            }
        }
    }

    // 3. No help document found
    return response()->json([
        'title' => 'Help Not Found',
        'content' => 'No contextual help is available for this page.',
    ], 404); // Return a 404 status when not found
});