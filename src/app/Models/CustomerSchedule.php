<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerSchedule extends Model
{
    use HasFactory;

    // Disable standard date and time fields
    // This is done because the primary key of the table is a timestamp field
    public $timestamps = false;

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
