<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestType extends Model
{
    /** @use HasFactory<\Database\Factories\RequestTypeFactory> */
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'title',
        'description',
        'is_active'
    ];

    public function requests()
    {
        return $this->hasMany(Requests::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
