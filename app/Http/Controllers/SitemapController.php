<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    public function index()
    {
        $baseUrl = url('/');
        // Liste d'URLs à inclure dans le sitemap. Ajoute dynamiquement tes pages, contenus, templates, créations publiques, etc.
        $urls = [
            ['loc' => $baseUrl, 'priority' => '1.0', 'changefreq' => 'daily', 'lastmod' => now()->toAtomString()],
            ['loc' => url('/create-letter'), 'priority' => '0.9', 'changefreq' => 'daily', 'lastmod' => now()->toAtomString()],
            ['loc' => url('/create-card'), 'priority' => '0.8', 'changefreq' => 'daily', 'lastmod' => now()->toAtomString()],
            ['loc' => url('/create-giftlist'), 'priority' => '0.3', 'changefreq' => 'yearly', 'lastmod' => now()->toAtomString()],
            // Si tu as des créations publiques, boucles dessus et pousse leur URL ici
        ];

        $content = view('sitemap.xml', compact('urls'))->render();

        return response($content, 200)
            ->header('Content-Type', 'application/xml');
    }
}
