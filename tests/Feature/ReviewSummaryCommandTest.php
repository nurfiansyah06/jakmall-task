<?php

namespace Tests\Feature;

use Tests\TestCase;

class ReviewSummaryCommandTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function will_return_correct_average_ratings_from_all_products(): void
    {
        $output = [
            'total_reviews'   => 500,
            'average_ratings' => 2.9,
            '5_star'          => 62,
            '4_star'          => 117,
            '3_star'          => 126,
            '2_star'          => 123,
            '1_star'          => 72,
        ];
        $result = $this->artisan('review:summary');
        $result->expectsOutput(collect($output)->toJson());
    }
}
