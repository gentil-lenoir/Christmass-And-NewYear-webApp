<?php
// app/Models/GiftList.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiftList extends Model
{
    protected $fillable = [
        'unique_id',
        'owner',
        'title',
        'message',
        'theme',
        'visibility',
        'gifts',
        'views',
        'shares'
    ];

    protected $casts = [
        'gifts' => 'array'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($giftList) {
            $giftList->unique_id = uniqid('giftlist_');
        });
    }

    public function getShareLinkAttribute()
    {
        return route('giftlists.show', $this->unique_id);
    }

    public function getTotalPriceAttribute()
    {
        return collect($this->gifts)->sum('price');
    }

    public function getGiftsCountAttribute()
    {
        return count($this->gifts);
    }

    public function getHighPriorityCountAttribute()
    {
        return collect($this->gifts)->where('priority', 'high')->count();
    }

    public function getMediumPriorityCountAttribute()
    {
        return collect($this->gifts)->where('priority', 'medium')->count();
    }

    public function getLowPriorityCountAttribute()
    {
        return collect($this->gifts)->where('priority', 'low')->count();
    }

    public function getWhatsAppMessageAttribute()
    {
        return "🎁 Bonjour! {$this->owner} a partagé sa liste de cadeaux de Noël avec vous!\n\n\"{$this->title}\"\n\nCliquez sur ce lien pour la consulter:\n{$this->share_link}\n\nJoyeuses fêtes! ✨";
    }
}