<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactCustomer extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'contact_id',
        'customer_id',
    ];

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'contact_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
