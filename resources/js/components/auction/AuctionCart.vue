<template>
    <div class="row bids mt-3">
        <div class="col-5">
            <div class="title font-weight-bold text-secondary text-center mb-2">Your Bid</div>
            <form class="form d-flex flex-column w-100">
                <div class="form-group">
                    <input type="text" class="form-control text-secondary text-center" :placeholder="minAcceptedBid" :disabled="isFinished" v-model="offered_price">
                    <small class="form-text text-danger" v-if="!isFinished && !isBidValid">Your offered price should be greater or equal than latest bid and less than buyout price.</small>
                </div>
                <button class="btn btn-secondary rounded d-inline-block border w-100" :disabled="isFinished || !isBidValid" @click.prevent="placeBid" v-if="isAuth">Place bid</button>
                <a href="/login" class="btn btn-secondary rounded d-inline-block border w-100" v-else>Place bid</a>
            </form>
        </div>
        <div class="col-3">
            <auction-countdown :auction="auction"></auction-countdown>
        </div>
        <div class="col-4">
            <div class="title font-weight-bold text-secondary text-center mb-2">Buyout Price</div>
            <form class="form d-flex flex-column w-100">
                <div class="form-group">
                    <input type="text" class="form-control text-primary text-center font-weight-bold" :value="buyoutPrice" readonly>
                </div>
                <button class="btn btn-primary rounded d-inline-block border w-100" :disabled="isFinished" @click.prevent="buyoutAuction" v-if="isAuth">Buy now</button>
                <a href="/login" class="btn btn-primary rounded d-inline-block border w-100" v-else>Place bid</a>
            </form>
        </div>
    </div>
</template>

<script>

    import AuctionCountdown from './AuctionCountdown'

    export default {

        components : {
            AuctionCountdown
        },

        props : ['user', 'auction'],
        data : function () {
            return {
                reactiveAuction : [],
                reactiveUser : [],
                offered_price : 0
            }
        },
        mounted() {

            this.reactiveAuction = this.auction;

            this.reactiveUser = this.user;

            this.offered_price = this.minAcceptedBid;

            window.EventBus.$on('bid-placed', this.onBidPlaced);
            window.EventBus.$on('auction-finished', this.onAuctionFinished);

        },
        computed : {
            buyoutPrice : function () {
                return parseFloat(this.reactiveAuction.buyout_price).toFixed(2) + ' $';
            },
            minAcceptedBid : function () {

                let latestPrice = this.reactiveAuction.latest_bid ? this.reactiveAuction.latest_bid.offered_price : this.reactiveAuction.start_price;

                return parseFloat(latestPrice) + parseFloat(this.reactiveAuction.increment);
            },
            isBidValid : function () {

                let latestPrice = this.reactiveAuction.latest_bid ? this.reactiveAuction.latest_bid.offered_price : this.reactiveAuction.start_price;

                let minBid = parseFloat(latestPrice) + parseFloat(this.reactiveAuction.increment);
                let maxBid = parseFloat(this.reactiveAuction.buyout_price);

                return parseFloat(this.offered_price) >= minBid && parseFloat(this.offered_price) < maxBid;
            },
            isLive : function () {
                return this.reactiveAuction.status === 'active'
            },
            isFinished : function () {
                return this.reactiveAuction.status === 'finished'
            },
            isAuth : function () {
                return this.user != null
            }
        },
        methods : {
            placeBid : function () {

                console.log('hhh');

                let that = this;

                let offered_price = this.offered_price;

                axios.post('/place-bid', {
                         auction_id : that.reactiveAuction.id,
                         buyer_id : that.reactiveUser.id,
                         offered_price : offered_price
                     })
                     .then(response => {
                         EventBus.$emit('bid-placed', response.data);
                     });


            },

            buyoutAuction : function () {

                let that = this;

                axios.post('/buyout-auction/' + that.reactiveAuction.id, { buyer_id : that.reactiveUser.id })
                     .then(response => {
                         EventBus.$emit('bid-placed', response.data.bid);
                         EventBus.$emit('auction-finished', response.data.auction);
                     });
                // /buyout-auction/{auction}
            },
            onBidPlaced : function (bid) {

                this.reactiveAuction.latest_bid = bid;

                this.offered_price = this.minAcceptedBid;
            },
            onAuctionFinished : function (auction) {
                if (auction.id === this.reactiveAuction.id) {
                    this.reactiveAuction.status = auction.status;
                }
            }
        }
    }
</script>
