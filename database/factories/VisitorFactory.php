<?php

namespace Database\Factories;

use App\Models\Visitor;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

class VisitorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Visitor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(1)->create()->first(),
            'comments' => $this->faker->realText(500)
        ];
    }
}
