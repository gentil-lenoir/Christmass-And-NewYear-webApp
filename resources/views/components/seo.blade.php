@php
    $appName = "Christmass And NewYear";
    $description = "Application web permettant de créer des lettres, affiches et cartes de vœux de Noël et Nouvel An : cadres photo, listes cadeaux, templates, partage et galerie publique.";
    $keywords = "Noël, cartes, affiches, nouvel an, voeux, templates, créations, couple, cadeaux, affiches personnalisées";
    $canonical = url()->current();
    $image = asset('favicon.ico');
@endphp

<meta name="description" content="{{ $description }}">
<meta name="keywords" content="{{ $keywords }}">
<meta name="robots" content="index, follow">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="canonical" href="{{ $canonical }}">
<link rel="shortcut icon" href="{{ $image }}" type="image/x-icon">

<!-- Open Graph -->
<meta property="og:type" content="website">
<meta property="og:title" content="{{ $appName }} – Créateur d’Affiches et Cartes de Noël">
<meta property="og:description" content="{{ $description }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:site_name" content="{{ $appName }}">
<meta property="og:image" content="{{ $image }}">
<meta property="og:image:alt" content="Aperçu Noël - {{ $appName }}">

{{-- <!-- JSON-LD -->
<script type="application/ld+json">
{!! json_encode([
    "@context" => "https://schema.org",
    "@type" => "WebSite",
    "name" => $appName,
    "url" => url('/'),
    "description" => $description,
    "publisher" => [
        "@type" => "Person",
        "name" => "Gentil Le Noir Maliyamungu B"
    ],
    "potentialAction" => [
        "@type" => "SearchAction",
        "target" => url('/') . "?q={search_term}",
        "query-input" => "required name=search_term"
    ]
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script> --}}
