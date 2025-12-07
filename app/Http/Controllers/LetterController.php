<?php
// app/Http/Controllers/LetterController.php

namespace App\Http\Controllers;

use App\Models\Letter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LetterController extends Controller
{
    // Afficher le formulaire de création
    public function create()
    {
        return view('create-letter');
    }

    // Sauvegarder la lettre
public function store(Request $request)
{
    $validated = $request->validate([
        'from' => 'required|string|max:100',
        'to' => 'required|string|max:100',
        'title' => 'required|string|max:200',
        'content' => 'required|string',
        'background' => 'required|string',
        'phone' => 'required|string|max:20'
    ]);

    $letter = Letter::create([
        'from_name' => $validated['from'],
        'to_name' => $validated['to'],
        'title' => $validated['title'],
        'content' => $validated['content'],
        'background' => $validated['background'],
        'recipient_phone' => $validated['phone']
    ]);

    // Générer le lien WhatsApp
    $whatsappMessage = urlencode($letter->whatsAppMessage);
    $whatsappUrl = "https://wa.me/{$letter->recipient_phone}?text={$whatsappMessage}";

    return response()->json([
        'success' => true,
        'data' => [
            'id' => $letter->unique_id,
            'local_id' => $request->input('local_id'), // ID du localStorage
            'share_link' => $letter->share_link,
            'whatsapp_url' => $whatsappUrl
        ],
        'message' => 'Lettre créée avec succès!'
    ]);
}

    // Afficher une lettre
    public function show($id)
    {
        $letter = Letter::where('unique_id', $id)->firstOrFail();
        
        // Incrémenter le compteur de vues
        $letter->increment('views');

        return view('view-letter', compact('letter'));
    }

    // Liste des lettres (pour l'admin ou galerie)
    public function index()
    {
        $letters = Letter::orderBy('created_at', 'desc')
                        ->paginate(12);

        return view('letters.index', compact('letters'));
    }

    // API pour récupérer les lettres sauvegardées localement
    public function syncFromLocalStorage(Request $request)
    {
        $localLetters = $request->input('letters', []);
        $syncedIds = [];

        foreach ($localLetters as $localLetter) {
            $letter = Letter::create([
                'from_name' => $localLetter['from'],
                'to_name' => $localLetter['to'],
                'title' => $localLetter['title'],
                'content' => $localLetter['content'],
                'background' => $localLetter['background'],
                'recipient_phone' => $localLetter['phone'] ?? null,
                'unique_id' => $localLetter['id'] ?? uniqid('letter_')
            ]);

            $syncedIds[] = $letter->id;
        }

        return response()->json([
            'success' => true,
            'synced_count' => count($syncedIds),
            'message' => 'Lettres synchronisées avec succès'
        ]);
    }
}