<template>
    <div class="container">
  <div class="row break row-cols-2">
    <div class="col first">
        <div class="centred" style="margin-top:70px;">
                <img src="img/logo.png" alt="" class="logo">
                <div class="name">
                    <p class="eko">EkoMarket </p>
                    <p class="pick">Pickup</p>
                </div>
        </div>
        <div class="centred">
                <Carousel
                    :itemsToShow="1"
                    :wrapAround="true"
                    :autoplay="5000"
                    :transition="300"
                    :itemsToScroll="1"
                >
                    <slide :index="1">

                        <div>
                            <img src="img/slide1.png" alt="" class="slideImage">

                            <div class="slide-words text-left">
                                <p class="title">
                                    <span>Shop with us</span> and get your good deliver at your door steps
                                </p>

                                <p class="desc" style="margin-top: 11px;">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sed id pulvinar ultrices leo urna accumsan imperdiet
                                    mattis. Viverra vestibulum bibendum amet, sed. Gravida ipsum diam mollis morbi vestibulum ornare dolor pharetra
                                    nascetur. Vulputate neque tempus vitae tellus malesuada.
                                </p>
                            </div>

                        </div>


                    </slide>
                    <slide :index="2">
                        <div>
                            <img src="img/slide2.png" alt="" class="slideImage mt-3">

                            <div class="slide-words text-left">
                                <p class="title">
                                    <span>Shop with us</span> and get your good deliver at your door steps
                                </p>

                                <p class="desc">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sed id pulvinar ultrices leo urna accumsan imperdiet
                                    mattis. Viverra vestibulum bibendum amet, sed. Gravida ipsum diam mollis morbi vestibulum ornare dolor pharetra
                                    nascetur. Vulputate neque tempus vitae tellus malesuada.
                                </p>
                            </div>

                        </div>
                    </slide>
                    <slide :index="3">
                        <div>
                            <img src="img/slide3.png" alt="" class="slideImage">

                            <div class="slide-words text-left">
                                <p class="title">
                                    <span>Shop with us</span> and get your good deliver at your door steps
                                </p>

                                <p class="desc">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sed id pulvinar ultrices leo urna accumsan imperdiet
                                    mattis. Viverra vestibulum bibendum amet, sed. Gravida ipsum diam mollis morbi vestibulum ornare dolor pharetra
                                    nascetur. Vulputate neque tempus vitae tellus malesuada.
                                </p>
                            </div>

                        </div>
                    </slide>

                    <template #addons>
                        <pagination />
                    </template>

                </Carousel>
            </div>
    </div>
    <div class="col second">
        <div class="right_container centredH">
                <div>

                    <div class="d-flex again">
                        <img src="img/login.png" alt="">
                        <p class="title ml-2">
                            Login
                        </p>
                    </div>


                    <p class="desc mt-2" style="margin-bottom: 20px;">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem vulputate ac, volutpat cursus.
                    </p>

                    <!-- <head>
                        <meta charset="UTF-8">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                    </head> -->

                    <form method="post" @submit.prevent="logindata">
                        <!-- <csrf-token-input /> -->
                        
                         <div class="row">
                            <!-- <input type="hidden" name="_token" :value="csrf"> -->
                            <input v-model="userData.email" type="email" name="email" placeholder="Email" autocomplete="email" required>
                            <!-- <div class="alert alert-danger" v-if="errors && errors.email"> {{ errors.email[0] }} </div> -->
                                <!-- <br><br> -->
                            <input v-model="userData.password" type="password" name="password" placeholder="Password" autocomplete="password"
                                required>
                                
                            <!-- <div class="alert alert-danger" v-if="errors && errors.password"> {{ errors.password[0] }} </div> -->

                        </div>
                        <p class="desc mt-3 ml-1">
                            Forgot Password?
                        </p>
                        <!-- <Link :href="route('dashboard')" > -->
                        <button class="continue" >Login</button>
                        <!-- </Link> -->
                        
                    </form>
                    <Link :href="route('register')">
                    <p class="desc mt-4 ml-1">
                        <span>Don’t have an account? Register now</span>
                    </p>
                    </Link>



                </div>
            </div>
    </div>
  </div>
</div>

</template>

<script>
// var csrf_token = $('meta[name="csrf-token"]').attr('content');
import { Head, Link } from "@inertiajs/inertia-vue3";
import "vue3-carousel/dist/carousel.css";
import { Carousel, Slide, Pagination, Navigation } from "vue3-carousel";
import axios from "axios";
// import { useRouter} from "vue-router";
// const router = useRouter();
export default {

    name: "Dashboard",

    data() {
        return {
            userData: {
                'email': '',
                'password': '',
            },
            success: false,
            errors: {},

        };
    },

    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
    },
    components: {
        Carousel,
        Slide,
        Pagination,
        Navigation,
        Link
    },
    computed: {},
    methods: {
        logindata() {
            console.log('yes');
            axios.post(route('log'), this.userData).then(response => {
                this.userData = {}
                // router.push(route('dashboard'))
            }).catch(error => {
                if (error.response.status == 422) {
                    this.errors = error.response.data.errors
                }
                console.log(Error);
            });
        }
    },
    mounted() {



    },

    beforeMount() {
    },
}
</script>

<style scoped>
 .first{
        background-color: #FFEDED;
    }
    .desc{
        font-family: 'Poppins';
        font-style: normal;
        font-weight: 400;
        font-size: 16px;
        line-height: 24px;
        color: #263238;
        /* margin-top: 11px; */
    }
     .centred{
        display: flex;
        justify-content: center;
    }
    .logo{
        width: 65.31px;
        height: 60.81px;
    }

    .name{
        font-family: 'Nunito';
        font-style: normal;
        font-weight: 700;
        font-size: 32.5424px;
        line-height: 44px;
        color: #263238;
    }
    .pick{
        font-size: 21.6949px;
        margin-top: -20px;
    }
    .title{
        font-family: 'Poppins';
        font-style: normal;
        font-weight: 500;
        font-size: 27px;
        line-height: 40px;
        /* margin-top: 70px; */
        color: #FF725E;
    } 
    .title > span, .desc > span{
        color: #FF725E;
        
    }
    .slideImage {
    width: 400px;
    height: 266.67px;
    margin: auto;
}
.slide-words {
    width: 90%;
    margin: auto;
}
    .centredH{
        display: flex;
        justify-content: center;
        align-items: center;
        
    }
input {
    width: 95%;
    margin: auto;
    margin-top: 30px;
    border-color: black;

}
    
    .right_container{
        height:100vh;
        width:50%;
        margin:auto;
    }
    .side{
        position: absolute;
        right: -11%;
        top: -5%;
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-bottom: 0;
        border-width: 50px;
        transform: rotate(225deg);
    }

    
    .continue {
    width: 100%;
    margin: auto;
    height: 50px;
    color: white;
    background: #FF725E;
    margin-top: 30px;
    font-family: 'Poppins';
    font-style: normal;
    font-weight: 400;
    font-size: 20px;
    line-height: 30px;
}   
  
   
    @media screen and (max-width: 500px) {
        .break{
            display: flex;
            flex-direction: column;
        }
        .second{
            margin-top: 100px;
           width: 350px;
        }
        input{
            width: 350px;
            margin-left: 20px;
        }
        .again{
            width: 350px;
        }
        .first{
            width: auto;
        }
    }
   
</style>