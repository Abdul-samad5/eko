<template>
    <SideBar></SideBar>
    <TopBar></TopBar>
    <div class="container-lg mt-7">
        <div class="row">
            <div class="col-12 w-100 d-flex justify-content-between">
                <p class="page-title">Withdraw</p>

            </div>
        </div>
    </div>

    <div class="container-lg">

        <!-- Recent orders-->
        <div class="row">
            <div class="col-lg-3 col-md-4 col-12 my-4">
                <div class="earning dash-card px-3 py-4">
                    <div class="pie-chart rounded-circle w-100 d-flex justify-content-center">
                        <div class="pie-chart-text px-3 d-block my-4 w-auto">
                            <div class="pie-chart-img d-flex justify-content-center">
                                <img class="img-fluid" src="/img/earning-1.png" />
                            </div>
                            <div class="pie-chart-price text-center">
                                <span>&#8358;</span>
                                190,000
                            </div>
                            <div class="sub-text text-center">
                                BALANCE
                            </div>

                        </div>
                    </div>

                    <div class="earning-menu">
                        <ul class="earning-menu-list px-3 py-4">
                            <li class="">
                                <div class="d-flex justify-content-between">
                                    <div class="price p-3">
                                        <span>NGN</span>
                                        190,000
                                    </div>
                                    <div class="price-label p-3">
                                        Total Income
                                    </div>
                                </div>
                            </li>
                            <li class="">
                                <div class="d-flex justify-content-between">
                                    <div class="price p-3">
                                        <span>NGN</span>
                                        5,000
                                    </div>
                                    <div class="price-label p-3">
                                        Total Fees
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="withdraw-btn w-100">
                        <button class="btn btn-ecko text-center w-100 text-white" type="button">
                            Withdraw
                        </button>
                    </div>

                    <div class="text-center sub-text my-4">
                        Minimum withdrawal fee is NGN 5,000<br>
                        withdrawak fee is 5%
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-8 col-12 my-3">
                <div class="d-flex justify-content-between w-100 my-2">
                    <div class="table-title">
                        <div class="d-flex">
                            Withdrawal List
                        </div>
                    </div>
                    <div class="table-title">
                        <div class="d-flex">
                            <i class="fa fa-search" v-if="search == ''"></i>
                            <input type="text" name="" v-model="search" placeholder="Search" id="search">

                            <select name="" id="select">
                                <option value="">Filter</option>
                                <option value="">By Date</option>
                                <option value="">By Amount</option>
                            </select>
                        </div>
                    </div>


                </div>
                <div class="col-12 my-2">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="text-center">
                                <tr class="my-4">
                                    <th scope="col">ID</th>
                                    <th scope="col">Amount (NGN)</th>
                                    <th scope="col">Info</th>
                                    <th scope="col">Payout On</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>

                            <tbody class="text-center">
                                <tr class="my-4 dash-card">
                                    <td scope="col">#2421BN</td>
                                    <td scope="col">16,000.00</td>
                                    <td scope="col">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</td>
                                    <td scope="col">June 12, 2022</td>

                                    <td scope="col">
                                        <p class="text-danger">Inactive</p>
                                    </td>


                                </tr>

                                <tr class="my-4 dash-card">
                                    <td scope="col">#2421BN</td>
                                    <td scope="col">16,000.00</td>
                                    <td scope="col">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</td>
                                    <td scope="col">June 12, 2022</td>

                                    <td scope="col">
                                        <p class="text-success">Completed</p>
                                    </td>


                                </tr>

                                <tr class="my-4 dash-card">
                                    <td scope="col">#2421BN</td>
                                    <td scope="col">16,000.00</td>
                                    <td scope="col">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</td>
                                    <td scope="col">June 12, 2022</td>

                                    <td scope="col">
                                        <p class="text-danger">UnCompleted</p>
                                    </td>


                                </tr>

                                <tr class="my-4 dash-card">
                                    <td scope="col">#2421BN</td>
                                    <td scope="col">16,000.00</td>
                                    <td scope="col">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</td>
                                    <td scope="col">June 12, 2022</td>

                                    <td scope="col">
                                        <p class="text-success">Completed</p>
                                    </td>


                                </tr>
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-between">
                            <p class="pagination">Showing 1 to 10 of 38 entries</p>
                            <div class="d-flex">
                                <button class="pag-btn px-2">Previous</button>
                                <button class="pag-number text-white px-2">1</button>
                                <button class="pag-btn px-2">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Recent orders End-->

    </div>

</template>

<script>
    import SideBar from '../Components/Base/SideBar.vue';
    import TopBar from '../Components/Base/TopBar.vue'
    export default {

        name: "Dashboard",
        data() {
            return {
                search:'',
            };
        },
        props: {},
        components: {
            SideBar, TopBar
        },
        computed: {},
        methods: {},
        mounted() {},
        beforeMount() {
        },
    }
</script>

<style scoped>
.dot {
    width: 5px;
    height: 5px;
    background: #3D9C1E;
}

.btn-primary{
    background: #5199E5 !important;
    border-radius: 0px !important;
}
.page-title {
    font-weight: 600;
    font-size: 22px;
    line-height: 33px;
    color: #263238;
}
.mt-7 {
    margin-top: 7rem !important;
}

.fa-search{
    margin-right: -25px;
    margin-left: 10px;
    margin-top: 13px;
    z-index: 1;
    color: rgba(81, 75, 75, 0.5);
}

#search{
    padding-left: 33px;
    background: rgba(228, 228, 228, 0.5);
    border-radius: 2px;
    border:none;
}

#select{
    border-radius: 5px;
    background-color: rgba(228, 228, 228, 0.5);
    border-radius: 2px;
    border:none;
    margin-left:5px;
    color: rgba(24, 22, 22, 0.5);

}

@media screen and (max-width:500px) {
    #search, #select{
        max-width: 100px;
    }

}
.dash-card {
    background: #e4e3e3;
}

thead tr {

background: #263238;
    color:#FFFFFF
}

td{
    max-width: 200px;
}

.frame{
    width:50px;
    height:50px;
}

.pag-btn{
    height: 31px;
    border: 0.586957px solid #565454;
}
.pag-number{
    height: 31px;
    background: #263238;
    border: 0.586957px solid #565454;
}


.pie-chart {
    border: 9px solid #FF725E;
    height: 260px;
}

.pie-chart-text {
    margin: auto 0px;
    padding-top: 20px;
}

.pie-chart-price {
    color: #263238;
    font-weight: 700;
    margin-top: 20px;
    font-size: 25px
}

.pie-chart-price span {
    font-size: 27px
}

.sub-text {
    text-transform: uppercase;
    font-weight: 400;
    font-size: 12px;
    letter-spacing: -0.045em;
    color: #808080;
}

.earning-menu-list {
    list-style-type: disc !important;
}

.earning-menu-list .price-label {
    background: #a8a8a8;
    font-weight: 400;
    font-size: 12.206px;
    letter-spacing: -0.045em;
    color: #707070;
    height: 50px;
    width: 104.93px;
}

.earning-menu-list li {
    display: list-item;
}

.earning-menu-list .price {
    font-weight: 400;
    font-size: 14.0066px;
    letter-spacing: -0.045em;
    color: #000000;
}
</style>




