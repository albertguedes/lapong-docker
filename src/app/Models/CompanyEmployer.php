<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyEmployer extends Model
{
    /** @use HasFactory<\Database\Factories\CompanyEmployerFactory> */
    use HasFactory;

    protected $fillable = [
        'company_id',
        'employer_id',
    ];

    public $timestamps = false;

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function employer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'employer_id');
    }
}
