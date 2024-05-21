<?php

namespace App\Commands;

use LaravelZero\Framework\Commands\Command;

class ReviewSummaryCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'review:summary';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Summary list of review';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = __DIR__ . '/../../database/reviews.json';
        $jsonContent = file_get_contents($data);
        $reviews = json_decode($jsonContent, true);

        $totalReviews = count($reviews);
        $totalRating = array_sum(array_column($reviews, 'rating'));
        $averageRating = $totalRating / $totalReviews;

        $ratingCounts = array_count_values(array_column($reviews, 'rating'));
        $result = [
            'total_reviews' => $totalReviews,
            'average_ratings' => round($averageRating, 1),
            '5_star' => $ratingCounts[5] ?? 0,
            '4_star' => $ratingCounts[4] ?? 0,
            '3_star' => $ratingCounts[3] ?? 0,
            '2_star' => $ratingCounts[2] ?? 0,
            '1_star' => $ratingCounts[1] ?? 0,
        ];

        $this->info(json_encode($result));
    }
}
