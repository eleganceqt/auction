<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Bid extends Model
{
    protected $guarded = [];

    /**
     * Get auction bid is associated with.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function auction()
    {
        return $this->belongsTo('App\Auction', 'auction_id', 'id');
    }

    /**
     * * Get buyer bid is associated with.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function buyer()
    {
        return $this->hasOne('App\User', 'id', 'buyer_id');
    }
}



