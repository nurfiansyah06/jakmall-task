<?php

namespace App\Commands;

use LaravelZero\Framework\Commands\Command;
use Illuminate\Console\Scheduling\Schedule;

class ReviewProductCommand extends Command
{
    protected $signature = 'review:product {productId}';
    protected $description = 'Get a product by its ID';

    public function handle()
    {
        // Load review data from JSON files
        $dataReview = __DIR__.'/../../database/reviews.json';
        $dataReviewJson = file_get_contents($dataReview);

        $productId = $this->argument('productId');
        
        $reviews = json_decode($dataReviewJson, true);

        // Initialize the result array
        $result = [
            'total_reviews' => 0,
            'average_ratings' => 0,
            '5_star' => 0,
            '4_star' => 0,
            '3_star' => 0,
            '2_star' => 0,
            '1_star' => 0
        ];

        // Calculate review statistics
        $totalRating = 0;

        foreach ($reviews as $review) {
            if ($review['product_id'] == $productId) {
                $result['total_reviews']++;
                $totalRating += $review['rating'];

                switch ($review['rating']) {
                    case 5:
                        $result['5_star']++;
                        break;
                    case 4:
                        $result['4_star']++;
                        break;
                    case 3:
                        $result['3_star']++;
                        break;
                    case 2:
                        $result['2_star']++;
                        break;
                    case 1:
                        $result['1_star']++;
                        break;
                }
            }
        }

        // Calculate average rating if there are any reviews
        if ($result['total_reviews'] > 0) {
            $result['average_ratings'] = round($totalRating / $result['total_reviews'], 1);
        }

        // Output the result
        $this->info(json_encode($result));
    }

    public function schedule(Schedule $schedule): void
    {
        // Schedule the command if needed
    }
}
