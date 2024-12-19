<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Review;

class ReviewObserver
{
    /**
     * Handle the Review "created" event.
     */
    public function created(Review $review): void
    {
        $this->updateProductStar($review);
    }

    /**
     * Handle the Review "updated" event.
     */
    public function updated(Review $review): void
    {
        $this->updateProductStar($review);
    }

    /**
     * Handle the Review "deleted" event.
     */
    public function deleted(Review $review): void
    {
        $this->updateProductStar($review);
    }

    /**
     * Handle the Review "restored" event.
     */
    public function restored(Review $review): void
    {
        //
    }

    /**
     * Handle the Review "force deleted" event.
     */
    public function forceDeleted(Review $review): void
    {
        //
    }


    private function updateProductStar(Review $review){
        $productId = $review->reviewable_id;
        
        $averageStar = Review::where('reviewable_id', $productId)
            ->where('reviewable_type', Product::class)
            ->avg('score');

        // Cập nhật lại cột average_star trong bảng products
        Product::where('id', $productId)->update(['average_star' => round($averageStar, 1)]);
    }
}
