<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Footer from '../Components/Footer.vue';



const props = defineProps({
  topics: Array,
  canLogin: Boolean,
  canRegister: Boolean,
  laravelVersion: String,
  phpVersion: String,
});

</script>

<template>
  <Head title="Welcome" />

  <div
    class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
    <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
      <Link v-if="$page.props.auth.user" :href="route('dashboard')"
        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
      Dashboard</Link>

      <template v-else>


        <div class="auth">
          <Link :href="route('login')"
            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
          Log in</Link>

          <Link v-if="canRegister" :href="route('register')"
            class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
          Register</Link>

        </div>

      </template>
    </div>
    <!-- BEGINNING -->
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
      <div class="flex justify-center">
        <a href="publier">publier</a>
        <!-- <a href="{{ route('home') }}">  -->


      </div>

      <div class="mt-16">
        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
          <div v-for="topic in topics" :key="topic.id" class="group relative bg-white shadow-[0px_20px_20px_10px_#00000024] rounded-lg">
            <div
              class="min-h-80 aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
              <img :src="topic.image1" :alt="topic.imageAlt"
                class="h-full w-full object-cover object-center lg:h-full lg:w-full" />
            </div>
            <!-- infos -->
            <div class="infos px-3 pb-7 pt-2 ">
              <div class="prix text-center">
              <p class="text-sm font-medium text-gray-900">{{ topic.prix }}</p>
            </div>
            <div class="nomAffaire flex justify-between">
              <div class="nom">
              <h3 class="text-sm text-gray-700">
                <a :href="topic.href">
                  <span aria-hidden="true" class="absolute inset-0" />
                  {{ topic.nom }}
                </a>
              </h3>
            </div>
            <!-- AFFAIRE -->
            <div class="affaire">
              <h3 class="text-sm text-gray-700">
                <a :href="topic.href">
                  <span aria-hidden="true" class="absolute inset-0" />
                  {{ topic.affaire }}
                </a>
              </h3>
            </div>
            </div>
            <div class="region flex justify-between">
              <div class="re">
                <p class="mt-1 text-sm text-gray-500">{{ topic.region }}</p>
              </div>
              <div class="date">
                <p class="mt-1 text-sm text-gray-500">{{ topic.updated_at }}</p>

              </div>
            </div>
            </div>
            


            <!-- <div class="mt-4 flex justify-between">
            <div>
              <h3 class="text-sm text-gray-700">
                <a :href="topic.href">
                  <span aria-hidden="true" class="absolute inset-0" />
                  {{ topic.nom }}
                </a>
              </h3>
              <p class="mt-1 text-sm text-gray-500">{{ topic.region }}</p>
            </div>
            <p class="text-sm font-medium text-gray-900">{{ topic.prix }}</p>
          </div> -->
          </div>
        </div>
      </div>

    </div>
  </div>
   <!-- FOOTER -->

   <div class="#">
              <Footer/>
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
      // produits:[
      //     {index:0,name:"iphone x",prix:26222,date:21/12,ville:"pikine"},
      //     {index:1,name:"Galaxy S22",prix:25222,date:13/12,ville:"Thiaroye"},
      //     {index:3,name:"Xiomi 12s",prix:222,date:23/12,ville:"malika"},
      //     {index:4,name:"Spark 8",prix:2452,date:6/12,ville:"Guediawaye"},
      //     {index:5,name:"iphone x",prix:26222,date:21/12,ville:"pikine"},
      //     {index:7,name:"Galaxy S22",prix:25222,date:13/12,ville:"Thiaroye"},
      //     {index:8,name:"Xiomi 12s",prix:222,date:23/12,ville:"malika"},
      //     {index:6,name:"Spark 8",prix:2452,date:6/12,ville:"Guediawaye"}

      //     ]

    }
  }
}
</script>