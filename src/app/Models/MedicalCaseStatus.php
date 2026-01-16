<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MedicalCaseStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'is_active'
    ];

    public function cases(): HasMany
    {
        return $this->hasMany(MedicalCase::class, 'medical_case_status_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
