<script setup>
import { Head, Link } from '@inertiajs/vue3';


defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});

</script>

<template>
    <Head title="Welcome" />

    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</Link>

            <template v-else>
                <Link :href="route('login')" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</Link>

                <Link v-if="canRegister" :href="route('register')" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</Link>
            </template>
        </div>
<!-- BEGINNING -->
        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-center">
                 <a href="publier">publier</a>
                <!-- <a href="{{ route('home') }}"> -->


            </div>

            <div class="mt-16">
                <div class="grid grid-cols-1 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 xsm:grid-cols-1 gap-6 lg:gap-3">
                    <div  v-for="produit in produits">
                        <a href="https://laravel.com/docs" class="scale-100 p-1 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                            <div class="card w-5/5 mt-2 border-b-4 shadow-xl">
                <div class="img">
                    <a href="#">
                    <!-- <img  class="w-full"  src="https://www.notebookcheck.biz/fileadmin/Notebooks/News/_nc3/Samsung_Galaxy_S_Series_Hands_On_29_von_3339.jpg"  alt=""> -->

                    </a>
                </div>
                <div class="infos w-full flex flex-col justify-end content-center bg-gray-100 pb-6">
                    <div class="txt">
                        <h2 class="text-gray-900 text-2xl pl-2">{{produit.name}} </h2>
                        <hr>
                        <p class="text-gray-700 text-gray-900 bg-red-400 text-2xl mx-0 text-center"><a href="#">{{produit.prix}}</a> <span>Fcfa</span> </p>

                    </div>
                  
                    <div class="location h-full flex justify-between pl-2">
                        <p class="text-gray-700">{{produit.ville}} </p>
                        <p class="pr-3">{{produit.date}}</p>
                    </div>
                </div>
            </div>
                        </a>
                        
                    </div>          
                    
                </div>
            </div>

            <div class="flex justify-center mt-16 px-6 sm:items-center sm:justify-between">
                <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-left">
                    <div class="flex items-center gap-4">
                        <a href="https://github.com/sponsors/taylorotwell" class="group inline-flex items-center hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="-mt-px mr-1 w-5 h-5 stroke-gray-400 dark:stroke-gray-600 group-hover:stroke-gray-600 dark:group-hover:stroke-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>
                            Sponsor
                        </a>
                    </div>
                </div>

                <div class="ml-4 text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
                    Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
<script>
export default {
  data() {
    return {
        produits:[
            {index:0,name:"iphone x",prix:26222,date:21/12,ville:"pikine"},
            {index:1,name:"Galaxy S22",prix:25222,date:13/12,ville:"Thiaroye"},
            {index:3,name:"Xiomi 12s",prix:222,date:23/12,ville:"malika"},
            {index:4,name:"Spark 8",prix:2452,date:6/12,ville:"Guediawaye"},
            {index:5,name:"iphone x",prix:26222,date:21/12,ville:"pikine"},
            {index:7,name:"Galaxy S22",prix:25222,date:13/12,ville:"Thiaroye"},
            {index:8,name:"Xiomi 12s",prix:222,date:23/12,ville:"malika"},
            {index:6,name:"Spark 8",prix:2452,date:6/12,ville:"Guediawaye"}

            ]

    }
  }
}
</script>