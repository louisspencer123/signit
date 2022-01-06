<?php

namespace Database\Factories;

use App\Models\Vote;
use Illuminate\Database\Eloquent\Factories\Factory;

class VoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vote::class;

    public function getVoteData() {
        return [
            'visitor_id' => Visitor::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'is_up' => $this->faker->boolean
        ];
    }
    
    public function voteExists($voteData) {
        return Vote::where([
            'visitor_id' => $voteData['visitor_id'],
            'user_id' => $voteData['user_id']
            ])->exists();
    }
        
    public function getValidVoteData() {
        $voteData = false;
        while ($voteData === false) {
            $voteData = $this->getVoteData();
            if ($this->voteExists($voteData)) {
                $voteData = false;
            }
        }
        return $voteData;
    }

    public function definition() {
        return $this->getValidVoteData();
    }
}
