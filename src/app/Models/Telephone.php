<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Telephone extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'ddi',
        'ddd',
        'number',
        'is_active'
    ];

    public function customer()
    {
        return $this->morphTo();
    }

    public function company()
    {
        return $this->morphTo();
    }

    public function value(){
        return '+' . $this->ddi . ' ' . $this->ddd . ' ' . substr($this->number, 0, -4) . '-' . substr($this->number, -4);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
