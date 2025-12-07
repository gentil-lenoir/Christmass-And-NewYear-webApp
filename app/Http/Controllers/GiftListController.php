<?php
// app/Http\Controllers\GiftListController.php

namespace App\Http\Controllers;

use App\Models\GiftList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GiftListController extends Controller
{
    public function create()
    {
        return view('create-giftlist');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'owner' => 'required|string|max:100',
            'title' => 'required|string|max:200',
            'message' => 'nullable|string',
            'theme' => 'required|string',
            'visibility' => 'required|string',
            'gifts' => 'required|array',
            'gifts.*.name' => 'required|string',
            'gifts.*.category' => 'required|string',
            'gifts.*.priority' => 'required|string|in:low,medium,high',
            'gifts.*.price' => 'nullable|numeric|min:0',
            'gifts.*.link' => 'nullable|url',
            'gifts.*.notes' => 'nullable|string',
            'local_id' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();

        $giftList = GiftList::create([
            'owner' => $validated['owner'],
            'title' => $validated['title'],
            'message' => $validated['message'],
            'theme' => $validated['theme'],
            'visibility' => $validated['visibility'],
            'gifts' => $validated['gifts']
        ]);

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $giftList->unique_id,
                'local_id' => $request->input('local_id'),
                'share_link' => $giftList->share_link,
                'whatsapp_message' => $giftList->whatsAppMessage
            ],
            'message' => 'Liste de cadeaux créée avec succès!'
        ]);
    }

    public function show($id)
    {
        $giftList = GiftList::where('unique_id', $id)->firstOrFail();
        
        // Incrémenter le compteur de vues
        $giftList->increment('views');

        return view('view-giftlist', compact('giftList'));
    }

    public function share($id, Request $request)
    {
        $giftList = GiftList::where('unique_id', $id)->firstOrFail();
        $giftList->increment('shares');

        $method = $request->input('method', 'whatsapp');
        $message = $giftList->whatsAppMessage;

        return response()->json([
            'success' => true,
            'data' => [
                'whatsapp_url' => "https://wa.me/?text=" . urlencode($message),
                'email_url' => "mailto:?subject=" . urlencode($giftList->title) . "&body=" . urlencode($message),
                'facebook_url' => "https://www.facebook.com/sharer/sharer.php?u=" . urlencode($giftList->share_link)
            ]
        ]);
    }

    public function reserveGift($listId, $giftIndex, Request $request)
    {
        $giftList = GiftList::where('unique_id', $listId)->firstOrFail();
        $gifts = $giftList->gifts;

        if (!isset($gifts[$giftIndex])) {
            return response()->json([
                'success' => false,
                'message' => 'Cadeau non trouvé'
            ], 404);
        }

        $gifts[$giftIndex]['reserved'] = true;
        $gifts[$giftIndex]['reserved_by'] = $request->input('reserved_by', 'Anonyme');
        $gifts[$giftIndex]['reserved_at'] = now()->toISOString();

        $giftList->gifts = $gifts;
        $giftList->save();

        return response()->json([
            'success' => true,
            'message' => 'Cadeau réservé avec succès'
        ]);
    }

    public function syncFromLocalStorage(Request $request)
    {
        $localLists = $request->input('lists', []);
        $syncedIds = [];

        foreach ($localLists as $localList) {
            try {
                $giftList = GiftList::create([
                    'owner' => $localList['owner'] ?? 'Anonyme',
                    'title' => $localList['title'] ?? 'Ma liste de cadeaux',
                    'message' => $localList['message'] ?? null,
                    'theme' => $localList['theme'] ?? 'classique',
                    'visibility' => $localList['visibility'] ?? 'private',
                    'gifts' => $localList['gifts'] ?? [],
                    'unique_id' => $localList['id'] ?? uniqid('giftlist_')
                ]);

                $syncedIds[] = $giftList->id;
            } catch (\Exception $e) {
                \Log::error('Erreur de synchronisation de liste: ' . $e->getMessage());
                continue;
            }
        }

        return response()->json([
            'success' => true,
            'synced_count' => count($syncedIds),
            'message' => 'Listes synchronisées avec succès'
        ]);
    }

    public function index()
    {
        $giftLists = GiftList::where('visibility', 'public')
                            ->orderBy('created_at', 'desc')
                            ->paginate(12);

        return view('giftlists.index', compact('giftLists'));
    }
}