<div class="swiper ">
    <div class="swiper-wrapper mt-[10%]">
      <div v-for="immobillierBoost in immobilliersBoost.data" :key="immobillierBoost.id" class=" swiper-slide w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/4 p-2">
                <div class="bg-principal rounded-2xl shadow-2xl relative " id="voiture">
            <div class="w-full h-full">
            <img :src="'/storage/' + immobillierBoost.image1" :alt="immobillierBoost.imageAlt"  class="w-full h-full object-fill rounded-2xl shadow-lg">

            </div>
                    <img class="mb-3 w-[2rem] h-[2rem] rounded-full shadow-2xl absolute bottom-1/3 right-0" src="https://flowbite.com/docs/images/people/profile-picture-3.jpg" alt="Bonnie image">

                    <div class="">
                    <h3 class="text-lg font-semibold text-white text-center">{{ immobillierBoost.nom }}</h3>
                    <p class="text-gray-300 text-center">{{ immobillierBoost.affaire }}</p>

                    <!-- <p class="text-gray-400"> Proposée par <span class="text-gray-600">Fadel</span> </p> -->
                    <p class="text-principal text-lg">{{ immobillierBoost.prix }}<span class="text-principal text-opacity-60"> Fcfa</span></p>
                    </div>
                    <div class="bg-secondaire object-fill rounded-2xl shadow-lg text-white">
                    <span class="text-center">Contactez</span>
                </div>
                </div>

                </div>
    </div>
    <div class="swiper-pagination"></div>
  </div>
