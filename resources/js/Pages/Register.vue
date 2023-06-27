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

                                <p class="desc">
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

                    <div class="d-flex again mt-40">
                        <img src="img/reg.png" alt="">
                        <p class="title ml-2">
                            Registration
                        </p>
                    </div>


                    <p class="desc mt-2" style="margin-bottom: 20px;">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem vulputate ac, volutpat cursus.
                    </p>

                    <form  method="post" @submit.prevent="submit">
                        <div class="alert alert-success" v-show="success">You have Successfully Registered with us! Kindly proceed to login</div>
                        <div class="row">
                            
                            <input v-model="formData.firstname" type="text" name="firstname" placeholder="FirstName" required>
                            <div class="alert alert-danger" v-if="errors && errors.firstname"> {{ errors.firstname[0] }} </div>

                            <input v-model="formData.lastname" type="text" name="lastname" placeholder="LastName" required>
                            <div class="alert alert-danger" v-if="errors && errors.lastname"> {{ errors.lastname[0] }} </div>

                            <input v-model="formData.email" type="email" name="email" placeholder="Email" required>
                            <div class="alert alert-danger" v-if="errors && errors.email"> {{ errors.email[0] }} </div>

                            <input v-model="formData.phone_number" type="number" name="phone_number" placeholder="Phone Number" required>
                            <div class="alert alert-danger" v-if="errors && errors.phone_number"> {{ errors.phone_number[0] }} </div>

                            <!-- <label for="referral" class="desc"><span>Referral Link</span></label>
                            <input type="text" placeholder="Referral" disabled v-model="referral" class="inputRef"> -->

                            <input v-model="formData.password" type="password" name="password" placeholder="Password" required>
                            <div class="alert alert-danger" v-if="errors && errors.password"> {{ errors.password[0] }} </div>

                            <input v-model="formData.conf_pass" type="password" name="confirm_password" placeholder="Confirm Password" >
                            <div class="alert alert-danger" v-if="errors && errors.confirm_password"> {{ errors.confirm_password[0] }} </div>

                        </div>
                        <!-- <Link :href="route('register')"> -->
                        <button type="submit" class="continue">Register</button>
                        <!-- </Link> -->
                    </form>
                    <Link :href="route('bladelogin')" >
                        <p class="desc mt-4 ml-1">
                            <span>Already have an account ? Login</span>
                        </p>
                    </Link>



                </div>
            </div>
    </div>
  </div>
</div>

</template>
<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import "vue3-carousel/dist/carousel.css";
import { Carousel, Slide, Pagination, Navigation } from "vue3-carousel";
import axios from "axios";
export default {

    name: "Dashboard",
    data() {
        return {
            referral:'https://Ekomarketpickup.com/register/25gsh/8_ksh',
            formData: {
                'firstname': '',
                'lastname': '',
                'email': '',
                'phone_number': '',
                'password': '',
                'confirm_password': '',
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
         submit() {
            axios.post(route('registerprocess', this.formData)).then(response => {
                this.formData = {};
                this.success = true;
            }).catch(error => {
                if(error.response.status == 422){
                    this.errors = error.response.data.errors
                }

                console.log(Error);
            });
            // this.formData
            // this.$inertia.post(route('registerprocess'),this.formData)
        }
    },
    mounted() {
        // $(".inputRef").after("add your smiley here");
        // :action="route('registerprocess')"

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