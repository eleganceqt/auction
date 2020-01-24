<template>

    <div class="ui small feed" style="width: 100%;">
        <h4 class="ui header border-bottom">Bids history</h4>

        <!--<div v-if="!bidsHistory.lenth">-->
        <div v-for="bid in bidsHistory" :key="bid.id" class="event">
            <div class="label">
                <img src="/img/avatar.jpg">
            </div>
            <div class="content">
                <div class="summary">
                    <a class="text-primary">{{ bid.buyer.name }}</a> placed a bid with
                    <a class="text-primary">$ {{ parseFloat(bid.offered_price).toFixed(2) }}</a>
                    <div class="date font-weight-bold">{{ relativeDateTime(bid.created_at) }}</div>
                </div>
            </div>
        </div>
        <!--</div>-->

        <!--<div class="ui feed" v-else>-->
        <!--<div class="event">-->
        <!--<div class="label">-->
        <!--<img src="/images/avatar/small/elliot.jpg">-->
        <!--</div>-->
        <!--<div class="content">-->
        <!--You added Elliot Fu to the group <a>Coworkers</a>-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->
    </div>

</template>

<script>

    import moment from 'moment';

    export default {
        props : ['bids'],
        data() {
            return {
                bidsHistory : []
            }
        },
        mounted() {

            this.bidsHistory = this.bids;

            let that = this;

            // setInterval(function() {
            //     bidsHistory.forEach(function(bid) {
            //         bid.
            //     })
            // }, 1000);

            window.EventBus.$on('bid-placed', this.onBidPlaced);
        },
        methods : {

            // offeredPrice : function (bid) {
            //     return parseFloat(bid.offered_price).toFixed(2);
            // },
            relativeDateTime : function (value) {
                const date = moment(value);

                if (moment().diff(date, 'days') > 5) {
                    return 'A long long time ago';
                }

                if (moment().diff(date, 'days') > 1) {
                    return `${moment().diff(date, 'days')} days ago`;
                }

                if (moment().diff(date, 'hours') >= 24) {
                    return 'A day ago';
                }

                if (moment().diff(date, 'hours') > 1) {
                    return `${moment().diff(date, 'hours')} hours ago`;
                }

                if (moment().diff(date, 'minutes') > 59) {
                    return 'An hour ago';
                }

                if (moment().diff(date, 'seconds') > 119) {
                    return `${moment().diff(date, 'minutes')} minutes ago`;
                }

                if (moment().diff(date, 'seconds') >= 60) {
                    return 'A minute ago';
                }

                return 'Just now';
            },
            onBidPlaced : function (bid) {
                this.bidsHistory.unshift(bid);
            }
        }

    }
</script>
