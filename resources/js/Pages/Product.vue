<template>
    <SideBar></SideBar>
    <TopBar></TopBar>
    <div class="container-lg mt-7">
        <div class="row">
            <div class="col-12 w-100 d-flex justify-content-between">
                <p class="page-title">Product</p>
                <button class="btn btn-primary p-2">
                    <i class="fa fa-plus"></i> Add Product
                </button>
            </div>
        </div>
    </div>

    <div class="container-lg">

        <!-- Recent orders-->
        <div class="row">
            <div class="d-flex justify-content-between w-100 my-2">
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

                <div class="table-title">
                    <div class="d-flex">
                        <img src="img/frame.png" alt="" class="frame">
                        <img src="img/frame1.png" alt="" class="frame ml-2">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="text-center">
                            <tr class="my-4">
                                <th scope="col">ID</th>
                                <th scope="col">Product Image</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Price (NGN)</th>
                                <th scope="col" class="text-center">Quantity Available/<br> Total Quantity</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>

                        <tbody class="text-center">
                            <tr class="my-4 dash-card">
                                <td scope="col">#2421BN</td>
                                <td scope="col" class="d-flex justify-content-center"><img src="img/shoe.png" alt=""></td>
                                <td scope="col">nike Shoe</td>
                                <td scope="col">16,000.00</td>
                                <td scope="col" >16/20</td>
                                <td scope="col">
                                    <p class="text-danger">Inactive</p>
                                </td>
                                <td scope="col" class="justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                    </svg>

                                </td>

                            </tr>
                            
                            <tr class="my-4 dash-card">
                                <td scope="col">#2421BN</td>
                                <td scope="col" class="d-flex justify-content-center"><img src="img/top.png" alt=""></td>
                                <td scope="col">nike vest</td>
                                <td scope="col">16,000.00</td>
                                <td scope="col" >16/20</td>
                                <td scope="col">
                                    <p class="text-success">Active</p>
                                </td>
                                <td scope="col" class="justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                    </svg>

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
    background: #FF725E;
    color:#FFFFFF
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
</style>




