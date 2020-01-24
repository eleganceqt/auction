import './bootstrap.js';

import Echo from 'laravel-echo';
import Vue  from 'vue';

import AuctionsList   from './components/auctions/AuctionsList';
import AuctionDetails from './components/auction/AuctionDetails';
// import AuctionItem from './components/auctions/AuctionItem';

// const EventBus = new Vue();

new Vue({
            el : '#app',

            components : {
                AuctionsList,
                AuctionDetails
                // AuctionItem,
            },

            created() {

                window.EventBus = new Vue();

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

                window.Echo.channel(`bid-channel`)
                      .listen('BidPlaced', (event) => {
                          console.warn('Echo channel: BidPlaced');
                          console.log(event);
                          window.EventBus.$emit('bid-placed', event.bid);
                      });

                window.Echo.channel(`auction-channel`)
                      .listen('AuctionCreated', (event) => {
                          console.warn('Echo channel: AuctionCreated');
                          console.log(event);
                          window.EventBus.$emit('auction-created', event.auction);
                      });

                window.Echo.channel(`auction-channel`)
                      .listen('AuctionFinished', (event) => {
                          console.warn('Echo channel: AuctionFinished');
                          console.log(event);
                          window.EventBus.$emit('auction-finished', event.auction);
                      });

                // window.


                // console.log('echo initialized');
                // console.log('app.js Created method');
                // let config = {
                //     broadcaster: 'pusher',
                //     key: process.env.MIX_PUSHER_APP_KEY,
                //     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
                //     encrypted: true
                //     // key: window.dashboard.pusherKey,
                //     // wsHost: window.location.hostname,
                //     // wsPath: window.dashboard.clientConnectionPath,
                //     // wsPort: window.dashboard.wsPort,
                //     // disableStats: true,
                // };
                //
                // if (window.dashboard.environment === 'local') {
                //     config.wsPort = 6001;
                // }
                //
                // this.echo = new Echo(config);
            }
        });
