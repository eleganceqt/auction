<template>

    <div class="bids-list">
        <auction-item v-for="auction in auctions" :auction="auction" :key="auction.id"></auction-item>
    </div>

</template>

<script>

    import Echo from 'laravel-echo'

    import AuctionItem from './AuctionItem';

    export default {
        components : {
            AuctionItem
        },

        // props : {
        //     user : {
        //         type : Object,
        //         // required : true
        //     }
        // },
        data() {
            return {
                auctions : []
                // auction : { name : "name" }
            }
        },
        mounted() {
            // console.log(this.user);

            // window.Echo
            //       .channel(`auction-channel`)
            //           .listen('AuctionCreated', (event) => {
            //               console.warn('Echo channel: AuctionCreated');
            //               console.log(event);
            //           })
            //       .listen('AuctionUpdated', (event) => {
            //               console.warn('Echo channel: AuctionUpdated');
            //               console.log(event);
            //           })
            //       .listen('AuctionDeleted', (event) => {
            //                    console.warn('Echo channel: AuctionDeleted');
            //                    console.log(event);
            //                });
            //
            //
            // // add user to this
            // window.Echo.channel(`bid-channel`)
            //     .listen('BidPlaced', (event) => {
            //         console.warn('Echo channel: BidPlaced');
            //        console.log(event);
            //     });
            //
            // console.log('echo initialized');

            window.EventBus.$on('auction-created', this.onAuctionCreate);

        },
        created() {
            this.fetchAuctions();
        },

        methods : {

            fetchAuctions() {
                axios.get('/fetch-auctions')
                     .then((response) => {
                         this.auctions = response.data;
                     });
            },
            onAuctionCreate : function (auction) {
                if (auction.status === 'active') {
                    this.auctions.unshift(auction);
                }
            }
        }
    }
</script>
