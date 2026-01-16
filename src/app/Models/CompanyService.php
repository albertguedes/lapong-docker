<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyService extends Model
{
    /** @use HasFactory<\Database\Factories\CompanyServiceFactory> */
    use HasFactory;

    protected $fillable = [
        'company_id',
        'company_service_type_id',
        'title',
        'description',
        'is_active'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(CompanyServiceType::class);
    }
}
