<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MedicalCaseRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_case_id',
        'medical_case_record_type_id',
        'title',
        'description',
        'is_active'
    ];

    public function case(): BelongsTo
    {
        return $this->belongsTo(MedicalCase::class, 'medical_case_id');
    }


    /**
     * Get the type of the medical case record.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(
            MedicalCaseRecordType::class,
            'medical_case_record_type_id'
        );
    }

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(
            Customer::class,
            'medical_case_record_participants',
            'medical_case_record_id',
            'participant_id',
        );
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
