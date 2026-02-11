<div class="p-4 text-sm text-gray-600 dark:text-gray-400">
    <p>{{ $content }}</p>
    @if (!empty($videoUrl))
        <div style="margin-top: 1rem;">
            @php
                parse_str(parse_url($videoUrl, PHP_URL_QUERY), $query);
                $videoId = $query['v'] ?? null;
                $embedUrl = $videoId
                    ? "https://www.youtube.com/embed/{$videoId}"
                    : $videoUrl;
            @endphp

            <div style="position: relative; width: 100%; padding-bottom: 56.25%;">
                <iframe
                    src="{{ $embedUrl }}"
                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
                    allowfullscreen>
                </iframe>
            </div>
        </div>
    @endif

</div>