

<script>

export default {

    name: "TopBar",
    data() {
        return {};
    },
    props: {},
    components: {},
    computed: {},
    methods: {},
    mounted() { },
    beforeMount() {
    },
}
</script>


<template>
    <nav class="d-flex justify-content-between py-4 navbar fixed-top">
        <div class="toggler-icon" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
            <i class="fa-solid fa-bars"></i>
        </div>
        <div class="nav-menu-icons d-flex justify-content-center">
            <div class="notification-icon bg-black text-whte rounded-circle mr-4 p-2 text-center">
                <i class="fa-regular fa-bell">
    
                </i>
            </div>
            <div class="user-account-icon bg-black text-whte rounded-circle p-2 text-center">
                <i class="fa-regular fa-user"></i>
            </div>
        </div>
    </nav>
</template>

<style scoped>
.navbar {
    width: 100%;
    height: 80px;
    background: #FFDBD7;
    padding-left: 90px;
    padding-right: 90px;
    z-index: 10;
}

.toggler-icon {
    color: #263238;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

.toggler-icon i {
    font-size: 30px;
}

.nav-menu-icons div {
    width: 45px;
    height: 45px;
    /* margin: 0 auto; */
}

.nav-menu-icons div i {
    font-size: 24px;
    color: white
}
</style>

