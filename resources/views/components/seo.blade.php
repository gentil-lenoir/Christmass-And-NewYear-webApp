@props([
    'title' => null,
    'description' => null,
    'keywords' => null,
    'image' => null,
    'url' => null,
    'published' => null,
    'updated' => null,
    'type' => 'website'
])

@php
    $appName = config('app.name') ?? 'ChristMass and NewYear';
    $titleText = $title ? "{$title} | {$appName}" : $appName;
    $descriptionText = $description ?? "Créez et partagez des cartes et affiches de Noël & Nouvel An — lettres, cadres photo, listes cadeaux, templates et plus.";
    $keywordsText = $keywords ?? 'Noël, carte de vœux, affiche, templates, Nouvel An, cartes numériques, partage';
    $imageUrl = $image ? (Str::startsWith($image, ['http://','https://']) ? $image : asset($image)) : asset('images/default-social.png');
    $canonical = $url ?? url()->current();
@endphp

<title>{{ $titleText }}</title>
<meta name="description" content="{{ $descriptionText }}">
<meta name="keywords" content="{{ $keywordsText }}">
<link rel="canonical" href="{{ $canonical }}" />

<!-- Basic meta -->
<meta name="robots" content="index, follow">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Open Graph -->
<meta property="og:locale" content="{{ app()->getLocale() ?? 'fr_FR' }}">
<meta property="og:type" content="{{ $type }}">
<meta property="og:title" content="{{ $titleText }}">
<meta property="og:description" content="{{ $descriptionText }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:site_name" content="{{ $appName }}">
<meta property="og:image" content="{{ $imageUrl }}">
<meta property="og:image:alt" content="{{ $titleText }}">

@if($published)
<meta property="article:published_time" content="{{ \Carbon\Carbon::parse($published)->toIso8601String() }}">
@endif
@if($updated)
<meta property="article:modified_time" content="{{ \Carbon\Carbon::parse($updated)->toIso8601String() }}">
@endif

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $titleText }}">
<meta name="twitter:description" content="{{ $descriptionText }}">
<meta name="twitter:image" content="{{ $imageUrl }}">

<!-- Favicons hint (optionnel) -->
<link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}" sizes="32x32">
<link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}">

<!-- JSON-LD inline (WebSite + WebPage) -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@graph": [
        {
            "@type": "WebSite",
            "@id": "{{ url('/') }}#website",
            "url": "{{ url('/') }}",
            "name": "{{ $appName }}",
            "description": "{{ $descriptionText }}",
            "publisher": {
                "@type": "Organization",
                "name": "{{ $appName }}"
            }
        },
        {
            "@type": "WebPage",
            "@id": "{{ $canonical }}#webpage",
            "url": "{{ $canonical }}",
            "name": "{{ addslashes($titleText) }}",
            "description": "{{ addslashes($descriptionText) }}",
            "inLanguage": "{{ app()->getLocale() ?? 'fr' }}"
            @if($published || $updated)
            ,@if($published)
            "datePublished": "{{ \Carbon\Carbon::parse($published)->toIso8601String() }}"
            @endif
            @if($updated)
            , "dateModified": "{{ \Carbon\Carbon::parse($updated)->toIso8601String() }}"
            @endif
            @endif
        }
    ]
}
</script>
