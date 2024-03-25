<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import decoupe from './decoupe.vue';



const  props = defineProps({
        vehicules:Object,
        habitats:Object,
     results:Object,
     total:Object,
     totalImmobilier:Object,
     totalVehicule:Object,
    //  ARTICLE VENDUS
    totalImmobilierVendu:Object,
    totalVehiculeVendu:Object,
    resultsVendu:Object,
    totalVendu:Object,
    // ARTICLE Actuel

    totalImmobilierActuel:Object,
    totalVehiculeActuel:Object,
    resultsActuel:Object,
    totalActuel:Object,

    //total articles vendus price

    totalVenduSomme:Object,
    sommeHabitatVendu:Object,
    sommeVehiculeVendu:Object,
    });
</script>

<style>
  .custom-grid {
    display: grid;
    grid-template-rows: 20% 80%; /* First column 10%, second column 90% */
  }
</style>

<template>
    <AppLayout title="Dashboard">
        <template>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>
        <div class="custom-grid">


 <!--sidenav -->
 <div class=" left-0  px-5 h-full bg-[#f8f4f3] p-4 z-50 sidebar-menu transition-transform">

        <ul class="mt-4">
            <span class="text-gray-400 font-bold"> Bonjour Cher (e){{ $page.props.auth.user.name }}</span>
            <div class="flex flex-row">


            <li class="mb-1$results->count  group">
                <button class=" font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class="ri-home-2-line mr-3 text-lg"></i>
                    <span class="text-sm"
                    :class="{ 'border-b-2 border-principal': activeTab === 'dashboard' }"
          @click="activeTab = 'dashboard'">Dashboard</span>
                </button>
            </li>
            <li class="mb-1 group">
              <button
          class="  py-2 bg-white text-gray-800 font-semibold"
          :class="{ 'border-b-2 border-principal': activeTab === 'voitures' }"
          @click="activeTab = 'voitures'"
        >
         voitures
        </button>
                <ul class="p$results->count l-7 mt-2 hidden group-[.selected]:block">
                    <li class="mb-4">
                        <a href="" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">All</a>
                    </li>
                    <li class="mb-4">
                        <a href="" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Roles</a>
                    </li>
                </ul>
            </li>

            <!-- IMMOBILIERS -->

            <li class="mb-1 group">
              <button
          class="  py-2 bg-white px-4 text-gray-800 font-semibold"
          :class="{ 'border-b-2 border-principal': activeTab === 'immobiliers' }"
          @click="activeTab = 'immobiliers'"
        >
         Immobilliers
        </button>
                <ul class="pl-7 mt-2 hidden group-[.selected]:block">
                    <li class="mb-4">
                        <a href="" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">All</a>
                    </li>
                    <li class="mb-4">
                        <a href="" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Roles</a>
                    </li>
                </ul>
            </li>
        </div>
        <!-- A SUPPRIMER -->
            <!-- <li class="mb-1 group">
                <a href="" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class='bx bx-list-ul mr-3 text-lg'></i>
                    <span class="text-sm">Activities</span>
                </a>
            </li>
            <span class="text-gray-400 font-bold">BLOG</span>
            <li class="mb-1 group">
                <a href="" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                    <i class='bx bxl-blogger mr-3 text-lg' ></i>
                    <span class="text-sm">Post</span>
                    <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
                </a>
                <ul class="pl-7 mt-2 hidden group-[.selected]:block">
                    <li class="mb-4">
                        <a href="" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">All</a>
                    </li>
                    <li class="mb-4">
                        <a href="" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Categories</a>
                    </li>
                </ul>
            </li>
            <li class="mb-1 group">
                <a href="" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class='bx bx-archive mr-3 text-lg'></i>
                    <span class="text-sm">Archive</span>
                </a>
            </li>
            <span class="text-gray-400 font-bold">PERSONAL</span>
            <li class="mb-1 group">
                <a href="" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class='bx bx-bell mr-3 text-lg' ></i>
                    <span class="text-sm">Notifications</span>
                    <span class=" md:block px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-red-600 bg-red-200 rounded-full">5</span>
                </a>
            </li>
            <li class="mb-1 group">
                <a href="" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class='bx bx-envelope mr-3 text-lg' ></i>
                    <span class="text-sm">Messages</span>
                    <span class=" md:block px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-green-600 bg-green-200 rounded-full">2 New</span>
                </a>
            </li> -->
        </ul>
    </div>
   <!-- CORPS -->

   <div v-show="activeTab === 'dashboard'" class="bg-gray-100">
    <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                    <div class="flex justify-between mb-6">
                        <div>
                            <div class="flex items-center mb-1">
                                               <div class="text-2xl font-semibold"> {{ $page.props.auth.user.name }} </div>
                            </div>
                        <div class="text-sm font-medium text-gray-400">Toutes les Publications </div>
                        </div>
                         <div class="dropdown">
                            <button type="button" class="dropdown-toggle text-gray-400 hover:text-gray-600"><i class="ri-more-fill"></i></button>
                            <ul class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
                                <li>
                                    <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Profile</a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Settings</a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <a href="/gebruikers" class="text-[#f84525] font-medium text-sm hover:text-red-800">{{ total }}  publication </a>
                </div>
                <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                    <div class="flex justify-between mb-4">
                        <div>
                            <div class="flex items-center mb-1">
                                <div class="text-2xl font-semibold">Immobiliers</div>
                                <div class="p-1 rounded bg-emerald-500/10 text-emerald-500 text-[12px] font-semibold leading-none ml-2">+{{ totalImmobilier }}</div>
                            </div>
                            <div class="text-sm font-medium text-gray-400">Article publie {{ totalImmobilier }}</div>
                        </div>
                         <div class="dropdown">
                            <button type="button" class="dropdown-toggle text-gray-400 hover:text-gray-600"><i class="ri-more-fill"></i></button>
                            <ul class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
                                <li>
                                    <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Profile</a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Settings</a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="text-[#f84525] font-medium text-sm hover:text-red-800" @click="activeTab = 'immobiliers'">
                        <span class="bg-red-300">Voir les Articles</span>
                    </div>
                </div>
                <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                    <div class="flex justify-between mb-6">
                        <div>
                            <div class="text-2xl font-semibold mb-1">Voitures <span class="p-1 rounded bg-emerald-500/10 text-emerald-500 text-[12px] font-semibold leading-none ml-2">+{{ totalVehicule }}</span></div>
                            <div class="text-sm font-medium text-gray-400">Article publie {{ totalVehicule }}</div>
                        </div>
                         <div class="dropdown">
                            <button type="button" class="dropdown-toggle text-gray-400 hover:text-gray-600"><i class="ri-more-fill"></i></button>
                            <ul class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
                                <li>
                                    <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Profile</a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Settings</a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="text-[#f84525] font-medium text-sm hover:text-red-800" @click="activeTab = 'voitures'"> <span>Voir les Articles</span></div>
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <div class="p-6 relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
                    <div class="rounded-t mb-0 px-0 border-0">
                      <div class="flex flex-wrap items-center px-4 py-2">
                        <div class="relative w-full max-w-full flex-grow flex-1">
                          <h3 class="font-semibold text-center text-base text-gray-900 dark:text-gray-50">Mes publications + <span class="p-1 rounded bg-emerald-500/10 text-emerald-500 text-[12px] font-semibold leading-none ml-2" >  +{{ total }} </span></h3>
                        </div>
                      </div>
                      <div class="block w-full overflow-x-auto">
                        <table class="items-center w-full bg-transparent border-collapse">
                          <thead>
                            <tr>
                              <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Noms</th>
                              <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Prix</th>
                              <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px">Type</th>
                            </tr>
                          </thead>
                          <tbody v-for="result in results" :key="result.id">
                            <tr class="text-gray-700 dark:text-gray-100">
                              <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">{{ result.nom }}</th>
                              <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-green-400">{{ result.prix }} <span class="text-gray-500">Fcfa</span></td>
                              <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                <div class="flex items-center">
                                  <span class="mr-2">En {{ result.affaire }}</span>

                                </div>
                              </td>
                            </tr>
                            <!-- <tr class="text-gray-700 dark:text-gray-100">
                              <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">User</th>
                              <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">6</td>
                              <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                <div class="flex items-center">
                                  <span class="mr-2">40%</span>
                                  <div class="relative w-full">
                                    <div class="overflow-hidden h-2 text-xs flex rounded bg-blue-200">
                                      <div style="width: 40%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500"></div>
                                    </div>
                                  </div>
                                </div>
                              </td>
                            </tr> -->


                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <!-- ARTICLES VENDUS -->

                        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
                            <div class="flex flex-wrap items-center px-4 py-2">
                        <div class="relative w-full max-w-full flex-grow flex-1">
                          <h3 class="font-semibold text-center text-base text-gray-900 dark:text-gray-50"> Articles deja vendus <span class="p-1 rounded bg-emerald-500/10 text-emerald-500 text-[12px] font-semibold leading-none ml-2" >  +{{ totalVendu }} </span></h3>
                        </div>
                      </div>
                            <table class="w-full min-w-[460px]">

                            <thead>
                                <tr>
                                    <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tl-md rounded-bl-md">Noms</th>
                                    <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">Prix</th>
                                    <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tr-md rounded-br-md">Categorie</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="resultVendu in resultsVendu" :key="resultVendu.id">
                                    <td class="py-2 px-4 border-b border-b-gray-50">
                                        <div class="flex items-center" >
                                            <img src="https://placehold.co/32x32" alt="" class="w-8 h-8 rounded object-cover block">
                                            <a href="#" class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate"> {{ resultVendu.nom }} </a>
                                        </div>
                                    </td>
                                    <td class="py-2 px-4 border-b border-b-gray-50">
                                        <span class="text-[13px] font-medium text-emerald-500">{{ resultVendu.prix }}  <span class="text-gray-500">Fcfa</span></span>
                                    </td>
                                    <td class="py-2 px-4 border-b border-b-gray-50">
                                        <span class="inline-block p-1 rounded bg-emerald-500/10 text-emerald-500 font-medium text-[12px] leading-none">{{ resultVendu.categorie }} / <span class="text-gray-500">{{ resultVendu.affaire }} </span></span>
                                    </td>
                                </tr>



                            </tbody>
                        </table>

                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md lg:col-span-2">
                    <div class="flex justify-between mb-4 items-start">
                        <div class="font-medium">Les Statistiques</div>
                         <div class="dropdown">
                            <button type="button" class="dropdown-toggle text-gray-400 hover:text-gray-600"><i class="ri-more-fill"></i></button>
                            <ul class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
                                <li>
                                    <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Profile</a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Settings</a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
                        <div class="rounded-md border border-dashed border-gray-200 p-4">
                            <div class="flex items-center mb-0.5">
                                <div class="text-xl font-semibold">Total revenu</div>
                                <span class="p-1 rounded text-[12px] font-semibold bg-blue-500/10 text-green-500 leading-none ml-1">{{ totalVendu }} </span>
                            </div>
                            <span class="text-gray-400 text-sm">Chiffre d affaire : <span class="text-green-500" >+{{ totalVenduSomme }}</span>  <span class="text-gray-500" >Fcfa</span> </span>
                        </div>
                        <div class="rounded-md border border-dashed border-gray-200 p-4">
                            <div class="flex items-center mb-0.5">
                                <div class="text-xl font-semibold">Total revenu immobiliere</div>
                                <!-- <span class="p-1 rounded text-[12px] font-semibold bg-emerald-500/10 text-emerald-500 leading-none ml-1">+$469</span> -->
                            </div>
                            <span class="text-gray-400 text-sm">Chiffre d affaire : <span class="text-green-500" >+{{ sommeHabitatVendu }}</span>  <span class="text-gray-500" >Fcfa</span> </span>
                        </div>
                        <div class="rounded-md border border-dashed border-gray-200 p-4">
                            <div class="flex items-center mb-0.5">
                                <div class="text-xl font-semibold">Total revenu Voitures</div>
                                <!-- <span class="p-1 rounded text-[12px] font-semibold bg-rose-500/10 text-rose-500 leading-none ml-1">-$130</span> -->
                            </div>
                            <span class="text-gray-400 text-sm">Chiffre d affaire : <span class="text-green-500" >+{{ sommeVehiculeVendu }}</span>  <span class="text-gray-500" >Fcfa</span> </span>
                        </div>
                    </div>
                    <div>
                        <canvas id="order-chart"></canvas>
                    </div>
                </div>
                <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
                    <div class="flex justify-between mb-4 items-start">
                        <div class="font-medium">Articles en cours</div>

                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[460px]">
                            <thead>
                                <tr>
                                    <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tl-md rounded-bl-md">Noms</th>
                                    <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">Prix</th>
                                    <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tr-md rounded-br-md">Categorie</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="resultActuel in resultsActuel" :key="resultActuel.id">
                                    <td class="py-2 px-4 border-b border-b-gray-50">
                                        <div class="flex items-center">
                                            <img src="https://placehold.co/32x32" alt="" class="w-8 h-8 rounded object-cover block">
                                            <span class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">{{ resultActuel.nom }}</span>
                                        </div>
                                    </td>
                                    <td class="py-2 px-4 border-b border-b-gray-50">
                                        <span class="text-[13px] font-medium text-emerald-500"> {{ resultActuel.prix }} <span class="text-gray-400 text-sm">Fcfa</span> </span>
                                    </td>



                                    <td class="py-2 px-4 border-b border-b-gray-50">
                                        <span class="inline-block p-1 rounded bg-emerald-500/10 text-emerald-500 font-medium text-[12px] leading-none">{{ resultActuel.affaire }} / {{ resultActuel.categorie[2,3,1] }}</span>
                                    </td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
  </div>
<!-- VOITURES -->
<div v-show="activeTab === 'voitures'" class="bg-gray-100 ">

<!-- all articles -->
<div class="flex flex-wrap justify-center mt-20 text-gray-800">
<div v-for="vehicule in vehicules" :key="vehicule.id" class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/4 p-2">
<div class="bg-secondaire rounded-2xl shadow-2xl relative mt-4">
<div class="w-full h-full">
<img :src="'/storage/' + vehicule.image1" :alt="vehicule.imageAlt"  class="w-full h-full object-fill rounded-2xl shadow-lg">

</div>
<img class="mb-3 w-[4rem] h-[4rem] rounded-full shadow-2xl absolute bottom-1/3 right-0" src="https://flowbite.com/docs/images/people/profile-picture-3.jpg" alt="Bonnie image">

<div class="p-4">
  <h3 class="text-lg font-semibold text-white">{{ vehicule.nom }}</h3>
  <p class="text-gray-300">{{ vehicule.affaire }}</p>

  <p class="text-gray-400"> Proposée par {{ total }} <span class="text-gray-600">Fadel</span> </p>
  <p class="text-principal text-lg">{{ vehicule.prix }}<span class="text-principal text-opacity-60"> Fcfa</span></p>
</div>
</div>
</div>
</div>

</div>

<!-- IMMOBILLIERS -->
  <!-- <div v-show="activeTab === 'immobiliers'" class="bg-gray-100"> -->
    <div v-show="activeTab === 'immobiliers'" class="bg-gray-100">




        <div class="immo lg:w-9/12  mx-auto text-gray-800">

<div class="flex flex-wrap justify-center mt-20">
 <div v-for="habitat  in habitats" :key="habitat.id" @click="navigateToDetail(habitat.id)"  class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/4 p-2">
   <div class="bg-secondaire rounded-2xl shadow-2xl relative mt-4">
     <img :src=" '/storage/' + habitat.image1" :alt="habitat.imageAlt" class="w-full h-full object-fill rounded-2xl shadow-lg">

     <div class="p-4">
         <h3 class="text-lg font-semibold text-white">{{ habitat.nom }}</h3>
       <p class="text-gray-300">{{ habitat.affaire }}</p>

       <p class="text-gray-400"> Proposee par  <span class="text-gray-600">Fadel</span> </p>
       <p class="text-principal text-lg">{{ habitat.prix }}<span class="text-principal text-opacity-60"> Fcfa</span></p>

     </div>
   </div>
 </div>
</div>
</div>

      </div>
  </div>


  <!-- </div> -->
<!-- </div> -->


    </AppLayout>



</template>
<script>

export default {
    // import {Head} from '@inertiajs/vue3';

    data () {
        return {
          activeTab: 'dashboard',
        showMenu: false,

        }
    },
    methods: {
        navigateToBoost($id)
        {
            this.$inertia.visit(`/detailArticle/c/${$id}`);
        }
    }
}

    </script>


