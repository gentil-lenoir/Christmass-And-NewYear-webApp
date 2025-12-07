<?php
// app/Http\Controllers/PosterController.php

namespace App\Http\Controllers;

use App\Models\Poster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PosterController extends Controller
{
    public function create()
    {
        return view('create-poster');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'names' => 'required|string|max:500',
            'message' => 'nullable|string',
            'year' => 'required|integer',
            'style' => 'required|string',
            'phone' => 'required|string|max:20',
            'multiple_phones' => 'nullable|string',
            'canvas_data' => 'required|string',
            'local_id' => 'nullable|string'
        ]);

        // Convertir le base64 en image et la sauvegarder
        $imageData = $validated['canvas_data'];
        $imageName = 'posters/' . uniqid('poster_') . '.png';
        
        // Extraire le base64
        if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $type)) {
            $imageData = substr($imageData, strpos($imageData, ',') + 1);
            $type = strtolower($type[1]); // jpg, png, gif
            
            if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                throw new \Exception('Type d\'image invalide');
            }
            
            $imageData = base64_decode($imageData);
            
            if ($imageData === false) {
                throw new \Exception('Échec du décodage base64');
            }
        } else {
            throw new \Exception('Format d\'image non supporté');
        }
        
        // Sauvegarder l'image
        Storage::disk('public')->put($imageName, $imageData);
        $imagePath = Storage::url($imageName);

        $poster = Poster::create([
            'title' => $validated['title'],
            'names' => $validated['names'],
            'message' => $validated['message'],
            'year' => $validated['year'],
            'style' => $validated['style'],
            'canvas_data' => asset($imagePath), // Stocker l'URL de l'image
            'recipient_phone' => $validated['phone'],
            'multiple_phones' => $validated['multiple_phones']
        ]);

        // Générer les liens WhatsApp
        $whatsappMessage = urlencode($poster->whatsAppMessage);
        $whatsappUrl = "https://wa.me/{$poster->recipient_phone}?text={$whatsappMessage}";

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $poster->unique_id,
                'local_id' => $validated['local_id'],
                'share_link' => $poster->share_link,
                'image_url' => $poster->image_url,
                'whatsapp_url' => $whatsappUrl
            ],
            'message' => 'Affiche créée avec succès!'
        ]);
    }

    public function show($id)
    {
        $poster = Poster::where('unique_id', $id)->firstOrFail();
        $poster->increment('views');

        return view('view-poster', compact('poster'));
    }

    public function index()
    {
        $posters = Poster::orderBy('created_at', 'desc')
                        ->paginate(12);

        return view('posters.index', compact('posters'));
    }

    public function syncFromLocalStorage(Request $request)
    {
        $localPosters = $request->input('posters', []);
        $syncedIds = [];

        foreach ($localPosters as $localPoster) {
            try {
                // Convertir le base64 en image
                $imageData = $localPoster['canvas_data'];
                $imageName = 'posters/synced_' . uniqid('poster_') . '.png';
                
                if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $type)) {
                    $imageData = substr($imageData, strpos($imageData, ',') + 1);
                    $imageData = base64_decode($imageData);
                    
                    if ($imageData !== false) {
                        Storage::disk('public')->put($imageName, $imageData);
                        $imagePath = Storage::url($imageName);
                    }
                }

                $poster = Poster::create([
                    'title' => $localPoster['title'] ?? 'Affiche de Noël',
                    'names' => $localPoster['names'] ?? 'Famille',
                    'message' => $localPoster['message'] ?? null,
                    'year' => $localPoster['year'] ?? date('Y'),
                    'style' => $localPoster['style'] ?? 'festif',
                    'canvas_data' => $imagePath ?? null,
                    'elements' => $localPoster['elements'] ?? null,
                    'recipient_phone' => $localPoster['phone'] ?? null,
                    'multiple_phones' => $localPoster['multiplePhones'] ?? null,
                    'unique_id' => $localPoster['id'] ?? uniqid('poster_')
                ]);

                $syncedIds[] = $poster->id;
            } catch (\Exception $e) {
                \Log::error('Erreur de synchronisation d\'affiche: ' . $e->getMessage());
                continue;
            }
        }

        return response()->json([
            'success' => true,
            'synced_count' => count($syncedIds),
            'message' => 'Affiches synchronisées avec succès'
        ]);
    }

    // Télécharger l'image
    public function download($id)
    {
        $poster = Poster::where('unique_id', $id)->firstOrFail();
        
        $imageData = $poster->canvas_data;
        
        // Si c'est une URL, récupérer le contenu
        if (filter_var($imageData, FILTER_VALIDATE_URL)) {
            $imageData = file_get_contents($imageData);
        }
        
        return response($imageData)
            ->header('Content-Type', 'image/png')
            ->header('Content-Disposition', 'attachment; filename="affiche-noel-' . $poster->unique_id . '.png"');
    }
}