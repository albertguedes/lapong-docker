<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'value',
        'description',
        'is_active'
    ];

    public function customers(): MorphToMany
    {
        return $this->morphedByMany(Customer::class, 'documentable');
    }

    public function companies(): MorphToMany
    {
        return $this->morphedByMany(Company::class, 'documentable');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
