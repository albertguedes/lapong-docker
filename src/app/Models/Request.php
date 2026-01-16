<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Request extends Model
{
    /** @use HasFactory<\Database\Factories\RequestsFactory> */
    use HasFactory;

    protected $fillable = [
        'request_type_id',
        'description',
        'is_accepted',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(RequestType::class);
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(Customers::class, 'sender_id', 'id');
    }

    public function customers(): MorphToMany
    {
        return $this->morphedByMany(Customer::class, 'requestable');
    }

    public function companies(): MorphToMany
    {
        return $this->morphedByMany(Company::class, 'requestable');
    }

    public function scopeIsAccepted($query): self
    {
        return $query->where('is_accepted', true);
    }
}
