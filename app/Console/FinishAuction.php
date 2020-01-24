<?php

namespace App\Console;


use App\Auction;
use App\Events\AuctionFinished;
use Carbon\Carbon;

class FinishAuction
{
    public function __invoke()
    {
        while (true) {

            $auctions = Auction::active()->where('finishes_at', '<', Carbon::now())->get();

            $auctions->each(function ($auction) {

                $auction->status = 'finished';

                $auction->save();

                broadcast(new AuctionFinished($auction));

            });

//            sleep(1);
        }


        //       dd($auctions->pluck('finishes_at', 'id'));
        //       broadcast()

        //       broadcast()
        //       broadcast()
        //       dd('schedule');
    }
}
