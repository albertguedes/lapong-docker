<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'sender_id',
        'receiver_id',
        'subject',
        'message',
        'is_read',
        'is_deleted'
    ];

    public function sender()
    {
        return $this->belongsTo(Customer::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(Customer::class, 'receiver_id');
    }

    public function parent()
    {
        return $this->belongsTo(Message::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Message::class, 'parent_id');
    }

    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeSaved($query)
    {
        return $query->where('is_read', true)
                     ->where('is_deleted', false);
    }

    public function scopeDeleted($query)
    {
        return $query->where('is_deleted', true);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
