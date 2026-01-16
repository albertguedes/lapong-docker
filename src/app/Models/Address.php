<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use App\Models\Customer;
use App\Models\Company;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'postal_code',
        'address_line_1',
        'address_line_2',
        'city',
        'region',
        'state_or_province',
        'country',
        'is_active'
    ];

    public function customers(): MorphToMany
    {
        return $this->morphedByMany(Customer::class, 'addressable');
    }

    public function companies(): MorphToMany
    {
        return $this->morphedByMany(Company::class, 'addressable');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
