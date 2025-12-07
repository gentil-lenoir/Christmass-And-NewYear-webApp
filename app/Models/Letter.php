<?php
// app/Models/Letter.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    protected $fillable = [
        'unique_id',
        'from_name',
        'to_name',
        'title',
        'content',
        'background',
        'recipient_phone',
        'views'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($letter) {
            $letter->unique_id = uniqid('letter_');
        });
    }

    public function getShareLinkAttribute()
    {
        return route('letters.show', $this->unique_id);
    }

    public function getWhatsAppMessageAttribute()
    {
        return "🎄 Bonjour {$this->to_name}! Vous avez reçu une lettre de Noël de {$this->from_name}! 🎁\n\nCliquez sur ce lien pour la découvrir:\n{$this->share_link}\n\nJoyeuses fêtes! ✨";
    }
}