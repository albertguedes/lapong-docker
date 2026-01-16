<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_creator_id',
        'title',
        'description',
        'begin',
        'end',
        'is_active'
    ];

    public function creator()
    {
        return $this->belongsTo(Customer::class, 'event_creator_id');
    }

    public function participants()
    {
        return $this->belongsToMany(Customer::class,'event_participants', 'event_id', 'participant_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeToday($query)
    {
        return $query->whereBetween('begin', [now()->startOfDay(), now()->endOfDay()]);
    }
}
