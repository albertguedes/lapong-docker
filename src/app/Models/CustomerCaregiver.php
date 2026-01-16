<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerCaregiver extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerCaregiverFactory> */
    use HasFactory;

    // Disable standard date and time fields
    // This is done because the primary key of the table is a timestamp field
    public $timestamps = false;

    protected $fillable = [
        'customer_id',
        'caregiver_id'
    ];

    public function caregiver()
    {
        return $this->belongsTo(Customer::class, 'caregiver_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
