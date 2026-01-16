<?php declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;
use App\Models\Company;
use App\Models\RequestType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Requests>
 */
class RequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $requestableModels = collect([
            Customer::class,
            Company::class,
        ]);
        $requestableClass = $requestableModels->random();
        $requestable = $requestableClass::inRandomOrder()->first();
        $requestable_type = $requestableClass;
        $requestable_id = $requestable->id;

        $sender_id = Customer::inRandomOrder()->first()->id;
        $request_type_id = RequestType::inRandomOrder()->first()->id;
        $description = $this->faker->sentence();
        $is_accepted = $this->faker->boolean();

        return [
            'requestable_type' => $requestable_type,
            'requestable_id' => $requestable_id,
            'sender_id' => $sender_id,
            'request_type_id' => $request_type_id,
            'description' => $description,
            'is_accepted' => $is_accepted
        ];
    }
}
