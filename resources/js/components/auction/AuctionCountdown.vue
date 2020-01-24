<template>
    <div class="ui vertical divider">
        <span class="font-weight-bold" style="font-size: 12px;"><i class="clock outline icon"></i>{{ time }}</span>
    </div>
</template>

<script>

    import moment from 'moment'


    export default {
        props : ['auction'],
        data() {
            return {
                interval : null,
                reactiveAuction : [],
                time : '00:00:00'
            }
        },

        created() {

        },
        mounted() {

            this.reactiveAuction = this.auction;

            window.EventBus.$on('auction-finished', this.onAuctionFinished);

            this.refreshCountdown();

            this.interval = setInterval(this.refreshCountdown, 1000);
        },
        methods : {
            refreshCountdown() {

                var momentDurationFormatSetup = require("moment-duration-format");

                momentDurationFormatSetup(moment);

                let start = moment();

                let end = moment(this.reactiveAuction.finishes_at);

                let duration = moment.duration(end.diff(start));

                if (this.reactiveAuction.status === 'active' && duration._data.seconds > 0) {
                    this.time = duration.format('HH:mm:ss', { trim : false });
                } else {

                    this.time = '00:00:00';

                    clearInterval(this.interval);
                }
            },
            onAuctionFinished : function (auction) {

                if (auction.id === this.reactiveAuction.id) {

                    this.reactiveAuction.status = auction.status;

                    clearInterval(this.interval);

                    this.time = '00:00:00';
                }
            }
        }
    }
</script>
