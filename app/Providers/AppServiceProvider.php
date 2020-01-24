<?php

namespace App\Providers;

use App\Auction;
use App\Bid;
use App\Observers\AuctionObserver;
use App\Observers\BidObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

//        Auction::observe(AuctionObserver::class);

//        Bid::observe(BidObserver::class);
    }
}
