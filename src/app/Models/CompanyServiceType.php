<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CompanyServiceType extends Model
{
    /** @use HasFactory<\Database\Factories\CompanyServiceTypeFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'is_active'
    ];

    public function services(): HasMany
    {
        return $this->hasMany(CompanyService::class);
    }
}
