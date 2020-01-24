<?php

namespace App\Http\Controllers;

use App\Auction;
use App\Bid;
use App\Events\BidPlaced;
use Illuminate\Http\Request;

class BidsController extends Controller
{
    public function place(Request $request)
    {
        $attributes = $request->validate([
                                             'auction_id'    => 'required',
                                             'buyer_id'      => 'required',
                                             'offered_price' => 'required'
                                         ]);

        $bid = Bid::create($attributes)Q;

        $bid->load('buyer');

        broadcast(new BidPlaced($bid))->toOthers();

        return $bid;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $attributes = $request->validate([
                                             'auction_id'    => 'required',
                                             'buyer_id'      => 'required',
                                             'offered_price' => 'required'
                                         ]);

        $bid = Auction::create($attributes);

        return response()->json($bid);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bid $bid
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Bid $bid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bid $bid
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Bid $bid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Bid                 $bid
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bid $bid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bid $bid
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bid $bid)
    {
        //
    }
}
