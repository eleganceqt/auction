<template>

    <div class="card mb-3 rounded ">
        <div class="row no-gutters">
            <div class="col-md-4">

                <img :src="`/storage/${auction.product.image}`" class="ui image" alt="" v-if="auction.product.image">
                <img src="/img/square-image.png" class="ui image" alt="" v-else>

            </div>
            <div class="col-md-4 vertical-align">
                <div class="card-body">
                    <h4 class="card-title font-weight-bold">{{ auction.product.name }}</h4>
                    <p class="card-text"><strong class="text-muted font-italic">by
                        <a class="text-muted" style="cursor: pointer;">{{ auction.seller.name }}</a></strong>
                    </p>
                    <p class="card-text">
                        <small class="text-muted font-weight-bold">1234, Beach Street, Honolulu</small>
                    </p>
                    <p class="card-text mt-2 ">
                        <small class="font-weight-bold text-muted">Status:</small>
                        <small class="font-weight-bold text-danger">{{ status }}</small>
                    </p>
                </div>
            </div>
            <div class="col-md-4 vertical-align">


                <div class="d-block justify-content-around">
                    <div class="list-group list-group-horizontal no-border text-center">
                        <div class="list-group-item px-4" style="border:none; border-right: 3px lightgrey solid;">
                            <div class="d-block text-muted">
                                <div class="pb-2">
                                    <strong class="mb-5 font-weight-bold">Starting Bid</strong>
                                </div>
                                <div class="pt-2">
                                    <h4 class="font-weight-bold text-muted">$ {{ auction.start_price }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item px-4 align-center" style="border: none">
                            <div class="d-block text-muted">
                                <div class="pb-2">
                                    <strong class="mb-5 font-weight-bold">Latest Bid</strong>
                                </div>
                                <div class="pt-2">
                                    <h4 class="font-weight-bold text-muted fade-in" v-if="auction.latest_bid">$ {{ auction.latest_bid.offered_price }}</h4>
                                    <h4 class="font-weight-bold text-muted" v-else>N / A</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-block mt-3 text-center">
                        <small class="font-weight-bold text-muted">Started {{ started }}</small>
                    </div>
                    <div class="d-block mt-3">
                        <a :href="`/auction/${auction.id}`" class="btn btn-outline-secondary btn-block">More details</a>
                    </div>
                </div>


                <!--<div class="info d-flex align-items-center justify-content-between">-->
                <!--<div class="bid-states d-flex align-items-center">-->
                <!--<div class="starting border border-ptimary px-3 py-1 bg-light bg-faded border-right-0">-->
                <!--<div class="name font-weight-bolder">Starting BID</div>-->
                <!--<div class="state">{{ auction.start_price }} $</div>-->
                <!--</div>-->
                <!--<div class="latest border border-ptimary px-3 py-1 bg-light bg-faded">-->
                <!--<div class="name font-weight-bolder">Latest BID</div>-->
                <!--<div class="state" v-if="auction.latest_bid">{{ auction.latest_bid.offered_price }} $</div>-->
                <!--<div class="state" v-else="">N / A</div>-->
                <!--</div>-->
                <!--</div>-->
                <!--<a href="#" class="btn btn-outline-dark">More Details</a>-->
                <!--</div>-->
            </div>
        </div>
    </div>

</template>

<script>
    import moment from 'moment';

    export default {
        props : ['auction'],
        data() {
            return {
                reactiveAuction : {}
            }
        },
        mounted() {

            let that = this;

            that.reactiveAuction = that.auction;

            window.EventBus.$on('bid-placed', this.onBidPlaced);
            window.EventBus.$on('auction-finished', this.onAuctionFinished);
        },
        computed : {
            status : function () {
                return this.auction.status === 'active' ? 'Live' : 'Finished';
            },
            started : function () {
                return moment(this.reactiveAuction.starts_at).format('DD MMMM YYYY')
            }
        },
        methods : {
            onBidPlaced : function (bid) {
                // console.log(bid);
                if (bid.auction_id === this.reactiveAuction.id) {
                    this.reactiveAuction.latest_bid = bid;
                }
            },
            onAuctionFinished : function (auction) {
                if (auction.id === this.reactiveAuction.id) {
                    this.reactiveAuction.status = auction.status;
                }
            }
        }
    }
</script>
