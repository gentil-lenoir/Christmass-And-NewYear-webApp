<?php
// app/Models/Poster.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    protected $fillable = [
        'unique_id',
        'title',
        'names',
        'message',
        'year',
        'style',
        'canvas_data',
        'elements',
        'recipient_phone',
        'multiple_phones',
        'views'
    ];

    protected $casts = [
        'elements' => 'array',
        'multiple_phones' => 'array'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($poster) {
            $poster->unique_id = uniqid('poster_');
        });
    }

    public function getShareLinkAttribute()
    {
        return route('posters.show', $this->unique_id);
    }

    public function getImageUrlAttribute()
    {
        return $this->canvas_data; // Retourne le base64 directement
    }

    public function getWhatsAppMessageAttribute()
    {
        $names = $this->names;
        $title = $this->title;
        
        return "🎨 Bonjour! Regardez l'affiche de Noël personnalisée créée pour vous! 🎄\n\n\"{$title}\"\nAvec: {$names}\n\nCliquez sur ce lien pour la voir:\n{$this->share_link}\n\nJoyeuses fêtes! ✨";
    }

    public function getFormattedPhonesAttribute()
    {
        if (!$this->multiple_phones) {
            return [$this->recipient_phone];
        }

        $phones = is_array($this->multiple_phones) 
            ? $this->multiple_phones 
            : explode(',', $this->multiple_phones);

        return array_map('trim', $phones);
    }
}