<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NotificationType extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'is_active'
    ];

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'notification_type_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
