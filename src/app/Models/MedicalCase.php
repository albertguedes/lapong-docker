<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MedicalCase extends Model
{
    use HasFactory;

    protected $fillable = [
        'finished_at',
        'medical_case_status_id',
        'responsible_id',
        'patient_id',
        'title',
        'description',
        'is_active'
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(MedicalCaseStatus::class, 'medical_case_status_id');
    }

    public function responsible(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'responsible_id');
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'patient_id');
    }

    public function records(): HasMany
    {
        return $this->hasMany(MedicalCaseRecord::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
