<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Customer;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'customer_id',
        'is_published',
        'is_active'
    ];

    public function author()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public static function search(string $query): Collection
    {
        return self::where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%")
                  ->orWhereHas('author.profile', function ($term) use ($query) {
                      $term->where('first_name', 'like', "%{$query}%")
                           ->orWhere('middle_name', 'like', "%{$query}%")
                           ->orWhere('last_name', 'like', "%{$query}%");
                  });
            })
            ->published()
            ->active()
            ->get();
    }
}
