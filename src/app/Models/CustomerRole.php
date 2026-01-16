<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerRole extends Model
{
    use HasFactory;

    protected $table = 'customer_roles';

    // Disable standard date and time fields
    // This is done because the primary key of the table is a timestamp field
    public $timestamps = false;

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}
