<?php

namespace Tests\Feature;

use Tests\TestCase;

class ReviewProductCommandTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function will_return_correct_rating_list_for_a_product(): void
    {
        $output = [
            'total_reviews'   => 66,
            'average_ratings' => 2.9,
            '5_star'          => 8,
            '4_star'          => 14,
            '3_star'          => 20,
            '2_star'          => 14,
            '1_star'          => 10,
        ];
        $result = $this->artisan('review:product', ['productId' => 1]);
        $result->expectsOutput(collect($output)->toJson());
    }
}
