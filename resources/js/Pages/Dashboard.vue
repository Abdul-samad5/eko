<script>
import SideBar from '../Components/Base/SideBar.vue';
import TopBar from '../Components/Base/TopBar.vue'
export default {

    name: "Dashboard",
    data() {
        return {};
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

<template>
    <SideBar></SideBar>
    <TopBar></TopBar>
    <div class="container-lg mt-7">
        <div class="row">
            <div class="col-12 w-100 d-flex justify-content-start page-title">
                Dashboard
            </div>
        </div>
    </div>
    <div class="container-lg">
        <div class="row">
            <div class="col-md-9 col-12 py-4">

                <!-- Dash cards -->
                <div class="row">
                    <div class="col-lg-4 col-md-6 my-2">
                        <div class="dash-box dash-card d-flex justify-content-between px-3 py-5 shadow">
                            <div class="dash-box-icon">
                                <img class="img-fluid" src="/img/dash-box-1.png" />
                            </div>
                            <div class="dash-box-text d-block">
                                <span>Products</span><br>
                                <strong>124</strong>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 my-2">
                        <div class="dash-box dash-card d-flex justify-content-between px-3 py-5 shadow">
                            <div class="dash-box-icon">
                                <img class="img-fluid" src="/img/dash-box-2.png" />
                            </div>
                            <div class="dash-box-text d-block">
                                <span>Orders</span><br>
                                <strong>99</strong>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12 my-2">
                        <div class="dash-box dash-card d-flex justify-content-between px-3 py-5 shadow">
                            <div class="dash-box-icon">
                                <img class="img-fluid" src="/img/dash-box-3.png" />
                            </div>
                            <div class="dash-box-text d-block">
                                <span>Clients</span><br>
                                <strong>12</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Dash cards End-->

                <!-- Earning & Report -->
                <div class="row">
                    <div class="col-md-4 col-12 my-5">
                        <div class="text-left">
                            Earning
                        </div>
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
                    <div class="col-md-8 col-12 my-5">
                        <div class="text-left">
                           Sales Report
                        </div>
                        <div class="sales-report dash-card px-2 py-4 w-100">
                            graph
                        </div>
                    </div>
                </div>
                <!-- Earning & Report End -->

                <!-- Recent orders-->
                <div class="row">
                    <div class="d-flex justify-content-between w-100 my-2">
                        <div class="table-title">
                            Recent Orders
                        </div>

                        <div class="table-title">
                            <button class="btn btn-ecko p-2">
                                See All
                            </button>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="my-4">
                                        <th scope="col">ID</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Products</th>
                                        <th scope="col">Payments</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Total Amount (NGN)</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr class="my-4 dash-card">
                                        <td scope="col">1</td>
                                        <td scope="col">22 Aug, 2022</td>
                                        <td scope="col">Blend T-shirt (10)</td>
                                        <td scope="col">
                                            <strong class="text-danger">
                                                Paid
                                            </strong>
                                        </td>
                                        <td scope="col" class="d-flex justify-content-start">
                                            <div class="dot rounded-circle mt-2 mr-2"></div>
                                            Delivered
                                        </td>
                                        <td scope="col">20,000</td>
                                        <td scope="col">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                            </svg>

                                        </td>
                                    </tr>

                                    <tr class="my-4 dash-card">
                                        <td scope="col">2</td>
                                        <td scope="col">22 Aug, 2022</td>
                                        <td scope="col">Blend T-shirt (10)</td>
                                        <td scope="col">
                                               Not Paid
                                        </td>
                                        <td scope="col" class="d-flex justify-content-start">
                                            <div class="dot rounded-circle mt-2 mr-2"></div>
                                            In Progress
                                        </td>
                                        <td scope="col">400,000</td>
                                        <td scope="col">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                            </svg>
                                    
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <!-- Recent orders End-->
            </div>
            <div class="col-md-3 col-12 px-2 py-4">
                <div class="recent-activities dash-card shadow-lg w-100 px-4">
                    <div class="block-head text-left pt-5">
                        Recent Activities
                    </div>
                    <div class="block-body mt-4">
                        <ul class="me-auto mb-2 mb-lg-0">
                            <li class="activity my-4">
                                <span class="activity-head">
                                    Lorem ipsum dolor sit amet
                                </span>
                                <p class="activity-body">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ultricies elit ac fermentum praesent tincidunt lobortis
                                    pharetra.
                                </p>
                                <span class="activity-footer d-flex justify-start mt-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="w-4 h-4 mr-2 ">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>

                                    22 Mins Ago

                                </span>
                            </li>

                            <li class="activity my-4">
                                <span class="activity-head">
                                    Lorem ipsum dolor sit amet
                                </span>
                                <p class="activity-body">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ultricies elit ac fermentum praesent tincidunt lobortis
                                    pharetra.
                                </p>
                                <span class="activity-footer d-flex justify-start mt-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="w-4 h-4 mr-2 ">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                            
                                    22 Mins Ago
                            
                                </span>
                            </li>

                            <li class="activity my-4">
                                <span class="activity-head">
                                    Lorem ipsum dolor sit amet
                                </span>
                                <p class="activity-body">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ultricies elit ac fermentum praesent tincidunt lobortis
                                    pharetra.
                                </p>
                                <span class="activity-footer d-flex justify-start mt-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="w-4 h-4 mr-2 ">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                            
                                    22 Mins Ago
                            
                                </span>
                            </li>

                            <li class="activity my-4">
                                <span class="activity-head">
                                    Lorem ipsum dolor sit amet
                                </span>
                                <p class="activity-body">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ultricies elit ac fermentum praesent tincidunt lobortis
                                    pharetra.
                                </p>
                                <span class="activity-footer d-flex justify-start mt-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="w-4 h-4 mr-2 ">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                            
                                    22 Mins Ago
                            
                                </span>
                            </li>

                            <li class="activity my-4">
                                <span class="activity-head">
                                    Lorem ipsum dolor sit amet
                                </span>
                                <p class="activity-body">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ultricies elit ac fermentum praesent tincidunt lobortis
                                    pharetra.
                                </p>
                                <span class="activity-footer d-flex justify-start mt-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="w-4 h-4 mr-2 ">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                            
                                    22 Mins Ago
                            
                                </span>
                            </li>

                            <li class="activity my-4">
                                <span class="activity-head">
                                    Lorem ipsum dolor sit amet
                                </span>
                                <p class="activity-body">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ultricies elit ac fermentum praesent tincidunt lobortis
                                    pharetra.
                                </p>
                                <span class="activity-footer d-flex justify-start mt-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="w-4 h-4 mr-2 ">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                            
                                    22 Mins Ago
                            
                                </span>
                            </li>

                            <li class="activity my-4">
                                <span class="activity-head">
                                    Lorem ipsum dolor sit amet
                                </span>
                                <p class="activity-body">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ultricies elit ac fermentum praesent tincidunt lobortis
                                    pharetra.
                                </p>
                                <span class="activity-footer d-flex justify-start mt-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="w-4 h-4 mr-2 ">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                            
                                    22 Mins Ago
                            
                                </span>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
   
</template>

<style scoped>
.dot {
    width: 5px;
    height: 5px;
    background: #3D9C1E;
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
.dash-card {
    background: #e4e3e3;
}

.block-head {
    font-weight: 400;
    font-size: 22px;
    line-height: 33px;
    color: #263238;
    border-bottom: 1px solid #263238;
}

.activity-head {
    font-weight: 500;
    font-size: 16px;
    line-height: 26px;
    color: #FF725E;
}

.activity-body {
    font-weight: 400;
    font-size: 12px;
    color: #454545;
    text-align: justify;
}

.activity-footer {
    font-weight: 400;
    font-size: 8px;
    color: #263238;
}

.dash-box {
    height: 154px;
}

.dash-box-text {
    font-weight: 500;
    color: #263238;
}

.dash-box-text span {
    font-size: 18px;
}

.dash-box-text  strong {
    font-size: 22.1765px;
}

.dash-box-img {
    width: 100px;
    height: 76px;
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

.sales-report {
    height : 584.03px;
}

thead tr {
    background: #FFEBE9;
}
</style>




