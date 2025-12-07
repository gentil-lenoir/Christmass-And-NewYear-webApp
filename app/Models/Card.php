<?php
// app/Models/Card.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'unique_id',
        'from_name',
        'to_name',
        'title',
        'message',
        'template',
        'emoji',
        'recipient_phone',
        'views'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($card) {
            $card->unique_id = uniqid('card_');
        });
    }

    public function getShareLinkAttribute()
    {
        return route('cards.show', $this->unique_id);
    }

    public function getWhatsAppMessageAttribute()
    {
        return "🎊 Bonjour {$this->to_name}! {$this->from_name} vous a envoyé une carte de vœux pour le Nouvel An! 🎁\n\nCliquez sur ce lien pour découvrir votre carte personnalisée:\n{$this->share_link}\n\n{$this->emoji} Bonne Année 2025! {$this->emoji}";
    }

    public function getTemplateClassAttribute()
    {
        return match($this->template) {
            'classique' => 'template-classique',
            'modern' => 'template-modern',
            'elegant' => 'template-elegant',
            'festif' => 'template-festif',
            'romantic' => 'template-romantic',
            'golden' => 'template-golden',
            default => 'template-classique'
        };
    }
}