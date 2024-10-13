<script setup>
const props = defineProps({

    voitures: Object,
    maisons: Object,
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
})

</script>

<template>
    <div class="bg-gray-100 ">
        <nav class="  w-full fixed top-0 left-0 z-10">
            <div
                class="px-11 py-5 mx-auto md:flex md:justify-between md:items-center shadow-xl bg-white text-principal">
                <!-- Branding -->
                <div class="flex items-center justify-between ">
                    <a :href="route('home')">
                        <img width=" 100" class=" m-0 p-0" :src="'/storage/slide/NoflayHub.png'" alt="Image logo">
                    </a> <!-- <button class="button" data-text="Awesome">
                            <span class="actual-text">&nbsp;Noflay&nbsp;</span>
                            <span aria-hidden="true" class="hover-text">&nbsp;Noflay&nbsp;</span>
                            </button> -->


                    <!-- Mobile Menu Button -->
                    <button @click="showMenu = !showMenu" type="button"
                        class="md:hidden text-secondaire hover:text-secondaire focus:outline-none absolute right-4 top-4">
                        <svg viewBox="0 0 24 24" class="w-12 h-12 fill-current">
                            <path
                                d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2z">
                            </path>
                        </svg>
                    </button>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex md:space-x-5 md:items-center  ">
                    <a :href="route('publier')" class="btn-secondary mx-[210px] text-principal ">
                        <button class="sign bg-principal">
                            <div class="arrow-wrapper bg-principal text-principal">
                                <i class="bi bi-plus"></i>
                            </div>
                            Publier une annonce
                        </button>
                    </a>
                    <template v-if="$page.props.auth.user">
                        <a :href="route('publier')" class="btn-primary text-principal">Publier une annonce</a>
                        <a :href="route('dashboard')" class="btn-secondary">Dashboard</a>
                    </template>
                    <!-- For LG -->
                    <template v-else>
                        <a :href="route('publier')" class="btn-primary">Accueil</a>
                        <a :href="route('publier')" class="btn-primary">Contact Us</a>
                        <SwitchBtn />
                        <a :href="route('login')" class="btn-secondary">
                            <button class="sign bg-principal">
                                Se connecter
                                <div class="arrow-wrapper">
                                    <div class="arrow"></div>
                                </div>
                            </button>
                        </a>
                    </template>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div :class="{ 'block': showMenu, 'hidden': !showMenu }" class="md:hidden bg-secondaire text-white mt-4">
                <nav aria-labelledby="header-navigation" class="flex flex-col items-center">
                    <ul class="flex flex-col space-y-4 px-4 py-2">
                        <template v-if="$page.props.auth.user">
                            <li>
                                <a :href="route('publier')" class="btn-primary">Publier une annonce</a>
                            </li>
                            <li>
                                <a :href="route('dashboard')" class="btn-secondary">Dashboard</a>
                            </li>
                        </template>
                        <template v-else>
                            <li>
                                <a :href="route('publier')" class="btn-primary">Accueil</a>
                            </li>
                            <li>
                                <a :href="route('publier')" class="btn-primary">Contact Us</a>
                            </li>
                            <li>
                                <SwitchBtn />
                            </li>
                            <li>
                                <a :href="route('login')" class="btn-secondary">
                                    <button class="sign">
                                        Se connecter
                                        <div class="arrow-wrapper">
                                            <div class="arrow"></div>
                                        </div>
                                    </button>
                                </a>
                            </li>
                        </template>
                    </ul>
                </nav>
            </div>
        </nav>

    </div>
</template>

<style scoped>
#principal {
    margin: 0;
    padding: 0;
    min-height: 105vh;
    /* background: url('https://cdn.pixabay.com/photo/2023/06/11/01/24/flowers-8055013_1280.jpg'); */
    background-size: cover;
}

#card,
#cat,
#transparent {
    background-color: #ffffff30;
    backdrop-filter: blur(16px) saturate(180%);
}


.pub {
    /*  background: url('https://images.unsplash.com/photo-1496181133206-80ce9b88a853?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80'); */
}


.nav {
    z-index: 50;
}

/* === removing default button style ===*/
.button {
    margin: 0;
    height: auto;
    background: transparent;
    padding: 0;
    border: none;
    cursor: pointer;
}

/* button styling */
.button {
    --border-right: 6px;
    --text-stroke-color: rgba(255, 255, 255, 0.6);
    --animation-color:
        rgb(235 45 83 / var(--tw-text-opacity));

    --fs-size: 1.5em;
    /* letter-spacing: 3px; */
    text-decoration: none;
    font-size: var(--fs-size);
    font-family: "Arial";
    position: relative;
    /* text-transform: uppercase; */
    color: transparent;
    -webkit-text-stroke: 1px var(--text-stroke-color);
}

/* this is the text, when you hover on button */
.hover-text {
    position: absolute;
    box-sizing: border-box;
    content: attr(data-text);
    color: var(--animation-color);
    width: 0%;
    inset: 0;
    border-right: var(--border-right) solid var(--animation-color);
    overflow: hidden;
    transition: 0.5s;
    -webkit-text-stroke: 1px var(--animation-color);
}

/* hover */
.button:hover .hover-text {
    width: 100%;
    filter: drop-shadow(0 0 23px var(--animation-color))
}

.card {
    background-color: #ffffff;
    border-radius: 1rem;
    box-shadow: 0 0 1rem rgba(0, 0, 0, 0.1);
}

.fixed-size {
    width: 300px;
    /* Width of the images */
    height: 200px;
    /* Height of the images */
    object-fit: cover;
    /* Ensures the images cover the space without distorting */
}

#swiper {
    margin-top: 10%;
}

/* button sign */

.sign {

    border: 0.3px dotted white;






    --primary-color: #625bff;
    --secondary-color: #fff;
    --hover-color: #eb2d53;
    --arrow-width: 10px;
    --arrow-stroke: 2px;
    box-sizing: border-box;
    /* border: 0; */
    border-radius: 20px;
    color: var(--secondary-color);
    padding: 2px 1.8em;
    /* background: var(--primary-color); */
    display: flex;
    transition: 0.2s background;
    align-items: center;
    gap: 0.6em;
    font-weight: bold;
}

.sign .arrow-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
}

.sign .arrow {
    margin-top: 1px;
    width: var(--arrow-width);
    background: var(--primary-color);
    height: var(--arrow-stroke);
    position: relative;
    transition: 0.2s;
}

.sign .arrow::before {
    content: "";
    box-sizing: border-box;
    position: absolute;
    border: solid var(--secondary-color);
    border-width: 0 var(--arrow-stroke) var(--arrow-stroke) 0;
    display: inline-block;
    top: -3px;
    right: 3px;
    transition: 0.2s;
    padding: 3px;
    transform: rotate(-45deg);
}

.sign:hover {
    background-color: var(--hover-color);
}

.sign:hover .arrow {
    background: var(--secondary-color);
}

.sign:hover .arrow:before {
    right: 0;
}
</style>

<script>



export default {
    data() {
        return {
            activeTab: 'immobilier',
            showMenu: false,
            marques: [
                "tous",
                "volvo",
                "renault",
                "peugeot",
                "citroen",
                "mitsubishi",
                "bmw",
                "audi",
                "nissan",
                "mercedes-benz",
                "volkswagen",
                "Toyota",
                "ford",
                "Jeep",
                "autres"
            ],
            selectedMarque: 'dakar'


        };
    },
    methods: {
        navigateToDetail(id) {
            this.$inertia.visit(`/detail/${id}`);
        },

    },
    mounted() {
        // Initialize Swiper
        new Swiper('.swiper', {
            slidesPerView: 'auto',
            spaceBetween: 20,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
        });

        // Initialize progress bar
        InertiaProgress.init({
            delay: 200,
            color: '#eb2d53',
            includeCSS: true,
            showSpinner: true,
        });
    },
};
</script>
