<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicalCaseRecordParticipant extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'medical_case_record_id',
        'participant_id',
        'is_active'
    ];

    public function medicalCaseRecord(): BelongsTo
    {
        return $this->belongsTo(MedicalCaseRecord::class, 'medical_case_record_id');
    }

    public function participant(): BelongsTo
    {
        return $this->belongsTo(Customer::class,'participant_id');
    }
}
