<?php

namespace App\Http\Controllers;

use App\Auction;
use App\Bid;
use App\Events\AuctionFinished;
use App\Events\BidPlaced;
use Illuminate\Http\Request;

class AuctionsController extends Controller
{
    public function getAuctions()
    {
        $auctions = Auction::active()->with(['seller', 'product', 'latestBid'])->latest()->get();

        return response()->json($auctions);
    }

    public function buyoutAuction(Request $request, Auction $auction)
    {
        $attributes = $request->validate(['buyer_id' => 'required']);

        $bid = Bid::create([
                               'auction_id'    => $auction->id,
                               'buyer_id'      => $attributes['buyer_id'],
                               'offered_price' => $auction->buyout_price]
        );

        $bid->load('buyer');

        broadcast(new BidPlaced($bid))->toOthers();

        $auction->status = 'finished';

        $auction->save();

        broadcast(new AuctionFinished($auction));

        return response()->json(['bid' => $bid, 'auction' => $auction]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auctions');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Auction $auction
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Auction $auction)
    {
        $auction->load(['seller', 'product', 'bids.buyer', 'latestBid.buyer']);

        return view('auction')->with(['auction' => $auction]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Auction $auction
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Auction $auction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Auction             $auction
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Auction $auction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Auction $auction
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Auction $auction)
    {
        //
    }
}
