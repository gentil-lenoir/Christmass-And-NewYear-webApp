<?php
// app/Http/Controllers/CardController.php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function create()
    {
        return view('create-card');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'from' => 'required|string|max:100',
            'to' => 'required|string|max:100',
            'title' => 'required|string|max:200',
            'message' => 'required|string',
            'template' => 'required|string',
            'emoji' => 'required|string',
            'phone' => 'required|string|max:20'
        ]);

        $card = Card::create([
            'from_name' => $validated['from'],
            'to_name' => $validated['to'],
            'title' => $validated['title'],
            'message' => $validated['message'],
            'template' => $validated['template'],
            'emoji' => $validated['emoji'],
            'recipient_phone' => $validated['phone']
        ]);

        // Générer le lien WhatsApp
        $whatsappMessage = urlencode($card->whatsAppMessage);
        $whatsappUrl = "https://wa.me/{$card->recipient_phone}?text={$whatsappMessage}";

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $card->unique_id,
                'local_id' => $request->input('local_id'),
                'share_link' => $card->share_link,
                'whatsapp_url' => $whatsappUrl
            ],
            'message' => 'Carte créée avec succès!'
        ]);
    }

    public function show($id)
    {
        $card = Card::where('unique_id', $id)->firstOrFail();
        $card->increment('views');

        return view('view-card', compact('card'));
    }

    public function index()
    {
        $cards = Card::orderBy('created_at', 'desc')
                    ->paginate(12);

        return view('cards.index', compact('cards'));
    }

    public function syncFromLocalStorage(Request $request)
    {
        $localCards = $request->input('cards', []);
        $syncedIds = [];

        foreach ($localCards as $localCard) {
            $card = Card::create([
                'from_name' => $localCard['from'],
                'to_name' => $localCard['to'],
                'title' => $localCard['title'],
                'message' => $localCard['message'],
                'template' => $localCard['template'],
                'emoji' => $localCard['emoji'],
                'recipient_phone' => $localCard['phone'] ?? null,
                'unique_id' => $localCard['id'] ?? uniqid('card_')
            ]);

            $syncedIds[] = $card->id;
        }

        return response()->json([
            'success' => true,
            'synced_count' => count($syncedIds),
            'message' => 'Cartes synchronisées avec succès'
        ]);
    }
}