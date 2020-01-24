<template>

    <div class="item-block">
        <div class="row">
            <div class="col-5">
                <div class="item-image">
                    <img :src="`/storage/${auction.product.image}`" class="ui image" alt="">
                </div>
                <div class="item-tabs mt-2">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#specs" role="tab" aria-controls="specs">Specifications</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="home-tab">
                        Description goes here. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa minus perferendis natus, sed numquam quas omnis, fugiat eum veniam doloribus, soluta eos, laboriosam earum at nulla iure totam necessitatibus a eius inventore consequatur magnam. Incidunt dicta neque autem, eum delectus sunt repellat, sapiente dolor nemo harum quibusdam ipsum, id vitae.
                    </div>
                    <div class="tab-pane fade" id="specs" role="tabpanel" aria-labelledby="profile-tab">
                        Specs go here. <br />
                        Specs: <br />
                        Lorem: Ipsum <br />
                        Вolor: Sit <br />
                        Amet: blah
                    </div>
                </div>
            </div>
            <div class="col-7">
                <div class="row">
                    <div class="col-12 mt-2 d-flex align-middle">
                        <h4 class="font-weight-bold">{{ auction.product.name }}</h4>
                        <h5 class="text-muted font-weight-bold ml-2" v-if="reactiveAuction.latest_bid">( Current bid: <span class="badge badge-primary">$ {{ parseFloat(reactiveAuction.latest_bid.offered_price).toFixed(2) }}</span> )</h5>
                    </div>
                </div>

                <auction-cart :auction="auction" :user="user"></auction-cart>

                <div class="row">
                    <div class="col-12 mt-5">
                        <bids-history :bids="auction.bids"></bids-history>
                    </div>
                </div>

            </div>
        </div>
    </div>

</template>

<script>

    import AuctionCart from './AuctionCart'
    import BidsHistory from './BidsHistory';

    export default {

        components : {
            AuctionCart,
            BidsHistory
        },

        props : {
            auction : {
                type : Object,
                required : true
            },
            user : Object
        },
        data() {
            return {
                reactiveAuction : {}
            }
        },
        mounted() {

            let that = this;

            that.reactiveAuction = that.auction;

            window.EventBus.$on('bid-placed', this.onBidPlaced);

        },
        computed: {

        },
        methods : {
            onBidPlaced : function (bid) {
                this.reactiveAuction.latest_bid = bid;
            },
        }
    }
</script>


