<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'first_name',
        'middle_name',
        'last_name',
        'birthdate',
        'gender'
    ];

    public function name(): string
    {
        return $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name;
    }

    public function age(){
        return date('Y') - date('Y', strtotime($this->birthdate));
    }

    public function gender_name(): string
    {
        return $this->gender ? 'Male' : 'Female';
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
