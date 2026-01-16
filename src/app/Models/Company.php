<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'legal_name',
        'trade_name'
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function employers(): BelongsToMany
    {
        return $this->belongsToMany(
            Customer::class,            // <- modelo relacionado
            'company_employers',        // <- nome da tabela pivot
            'company_id',               // <- chave estrangeira da empresa na pivot
            'employer_id'               // <- chave estrangeira do empregado na pivot
        );
    }

    public function addresses(): MorphMany
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function documents(): MorphMany
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    public function emails(): MorphMany
    {
        return $this->morphMany(Email::class, 'emailable');
    }

    public function telephones(): MorphMany
    {
        return $this->morphMany(Telephone::class, 'telephoned');
    }

    public function services(): HasMany
    {
        return $this->hasMany(CompanyService::class);
    }

    public function requests(): MorphMany
    {
        return $this->morphMany(Request::class, 'requested');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }


}
