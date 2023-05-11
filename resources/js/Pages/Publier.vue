<template>
    <main class="antialiased max-w-6xl mx-auto my-12 bg-gray-300 px-8">
         
    <div class="relative block md:flex items-center">
      <div class="w-full md:w-1/2 relative z-1 bg-gray-100 rounded shadow-lg overflow-hidden">
        <div class="text-lg font-medium text-green-500 uppercase p-8 text-center border-b border-gray-200 tracking-wide">Pay as you go</div>
        <div class="block sm:flex md:block lg:flex items-center justify-center">
          <div class="mt-8 sm:m-8 md:m-0 md:mt-8 lg:m-8 text-center">
            <div class="inline-flex items-center">
              <span class="text-3xl font-medium">1.4%</span>
              <span class="text-xl text-gray-600 ml-2">+</span>
              <span class="text-xl ml-2">20p</span>
            </div>
            <span class="block text-sm text-gray-600 mt-2">for European cards</span>
          </div>
          <div class="mt-4 mb-8 sm:m-8 md:m-0 md:mt-4 md:mb-8 lg:m-8 text-center">
            <div class="inline-flex items-center">
              <span class="text-3xl font-medium">2.9%</span>
              <span class="text-xl text-gray-600 ml-2">+</span>
              <span class="text-xl ml-2">20p</span>
            </div>
            <span class="block text-sm text-gray-600 mt-2">for non-European cards</span>
          </div>
        </div>
        <div class="flex justify-center mt-3">
          <ul>
            <li class="flex items-center">
              <div class="bg-green-200 rounded-full p-2 fill-current text-green-700">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" ><path class="primary" d="M11 3.05V2a1 1 0 0 1 2 0v1.05A10 10 0 0 1 22 13c0 1.33-2 1.33-2 0a2 2 0 1 0-4 0c0 1.33-2 1.33-2 0a2 2 0 1 0-4 0c0 1.33-2 1.33-2 0a2 2 0 1 0-4 0c0 1.33-2 1.33-2 0a10 10 0 0 1 9-9.95z"/><path class="secondary" d="M11 14a1 1 0 0 1 2 0v5a3 3 0 0 1-6 0 1 1 0 0 1 2 0 1 1 0 0 0 2 0v-5z"/></svg>
              </div>
              <span class="text-gray-700 text-lg ml-3">No setup, monthly, or hidden fees</span>
            </li>
            <li class="flex items-center mt-3">
              <div class="bg-green-200 rounded-full p-2 fill-current text-green-700">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="primary" d="M5 8h14a1 1 0 0 1 1 .92l1 12A1 1 0 0 1 20 22H4a1 1 0 0 1-1-1.08l1-12A1 1 0 0 1 5 8z"/><path class="secondary" d="M9 10a1 1 0 0 1-2 0V7a5 5 0 1 1 10 0v3a1 1 0 0 1-2 0V7a3 3 0 0 0-6 0v3z"/></svg>
              </div>
              <span class="text-gray-700 text-lg ml-3">Pay only for what you use</span>
            </li>
            <li class="flex items-center mt-3">
              <div class="bg-green-200 rounded-full p-2 fill-current text-green-700">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="primary" d="M14 13h6.78a1 1 0 0 1 .97 1.22A10 10 0 1 1 9.78 2.25a1 1 0 0 1 1.22.97V10a3 3 0 0 0 3 3z"/><path class="secondary" d="M20.78 11H14a1 1 0 0 1-1-1V3.22a1 1 0 0 1 1.22-.97c3.74.85 6.68 3.79 7.53 7.53a1 1 0 0 1-.97 1.22z"/></svg>
              </div>
              <span class="text-gray-700 text-lg ml-3">Real-time fee reporting</span>
            </li>
          </ul>
        </div>
        <a class="block flex items-center justify-center bg-gray-200 hover:bg-gray-300 p-8 text-md font-semibold text-gray-800 uppercase mt-16" href="#">
          <span>Create account</span>
          <span class="font-medium text-gray-700 ml-2">➔</span>
        </a>
      </div>
      <div class="w-full md:w-1/2 relative z-0 px-8 md:px-0 md:py-16">
        <div class="border-b-1 grid grid-cols-fluid gap-4 w-main pt-4 font-mainFont mx-auto  text-gray-800   sm:w-mainSm  md:w-mainMd   lg:w-mainLg xl:w-mainXl 2xl:w-main2Xl">
         
         <div class="card w-full bg-white p-5 shadow-lg" id="vehicule">
             <span class="text-2xl w-full p-2 rounded-md bg-gray-400 m-auto  font-bold"><a href="/publication/voiture/">Vehicules</a></span>
        </div>
        
           <div class="card w-full bg-white p-5 shadow-lg" id="immobilier">
             <h2 class="text-2xl font-bold"><a href="/publication/immobilier/">Immobillier</a></h2>
        </div>
         
         </div>
      </div>
    </div>
    </main>  <!--  -->
</template>

<script>
export default {

}
</script>