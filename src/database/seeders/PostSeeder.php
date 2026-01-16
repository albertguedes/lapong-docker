<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::each(function ($customer) {
            if ($customer->company()->exists()) {
                Post::factory(self::numberOfPosts())->create([
                    "customer_id" => $customer->id,
                ]);
            }
        });
    }

    private function numberOfPosts(): int
    {
        return rand(1, 10);
    }
}
