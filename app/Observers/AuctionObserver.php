<?php

namespace App\Observers;

use App\Auction;

class AuctionObserver
{
    /**
     * Handle the auction "created" event.
     *
     * @param  \App\Auction  $auction
     * @return void
     */
    public function created(Auction $auction)
    {
//        dd($auction);
    }

    /**
     * Handle the auction "updated" event.
     *
     * @param  \App\Auction  $auction
     * @return void
     */
    public function updated(Auction $auction)
    {
//        dd($auction);
    }

    /**
     * Handle the auction "deleted" event.
     *
     * @param  \App\Auction  $auction
     * @return void
     */
    public function deleted(Auction $auction)
    {
        //
    }

    /**
     * Handle the auction "restored" event.
     *
     * @param  \App\Auction  $auction
     * @return void
     */
    public function restored(Auction $auction)
    {
        //
    }

    /**
     * Handle the auction "force deleted" event.
     *
     * @param  \App\Auction  $auction
     * @return void
     */
    public function forceDeleted(Auction $auction)
    {
        //
    }
}
