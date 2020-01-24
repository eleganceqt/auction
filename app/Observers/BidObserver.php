<?php

namespace App\Observers;

use App\Bid;

class BidObserver
{
    /**
     * Handle the bid "created" event.
     *
     * @param  \App\Bid  $bid
     * @return void
     */
    public function created(Bid $bid)
    {
        //
    }

    /**
     * Handle the bid "updated" event.
     *
     * @param  \App\Bid  $bid
     * @return void
     */
    public function updated(Bid $bid)
    {
        //
    }

    /**
     * Handle the bid "deleted" event.
     *
     * @param  \App\Bid  $bid
     * @return void
     */
    public function deleted(Bid $bid)
    {
        //
    }

    /**
     * Handle the bid "restored" event.
     *
     * @param  \App\Bid  $bid
     * @return void
     */
    public function restored(Bid $bid)
    {
        //
    }

    /**
     * Handle the bid "force deleted" event.
     *
     * @param  \App\Bid  $bid
     * @return void
     */
    public function forceDeleted(Bid $bid)
    {
        //
    }
}
