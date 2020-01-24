<?php

namespace App;

use App\Events\AuctionCreated;
use App\Events\AuctionDeleted;
use App\Events\AuctionUpdated;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $guarded = [];

    protected $dispatchesEvents = [
        'created' => AuctionCreated::class,
        'updated' => AuctionUpdated::class,
        'deleted' => AuctionDeleted::class
    ];

    /**
     * Include only active auctions.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive(Builder $query)
    {
        return $query->where('status', '=', 'active');
    }

    /**
     * Get seller associated to auction.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function seller()
    {
        return $this->hasOne('App\User', 'id', 'seller_id');
    }

    /**
     * Get product associated to auction.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product()
    {
        return $this->hasOne('App\Product', 'id', 'product_id');
    }

    /**
     * Get bids associated to auction.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bids()
    {
        return $this->hasMany('App\Bid', 'auction_id', 'id')->latest();
    }

    /**
     * Get latest bid associated to auction.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function latestBid()
    {
        return $this->hasOne('App\Bid', 'auction_id', 'id')->latest();
    }
}





