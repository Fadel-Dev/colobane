<script setup>

const  props = defineProps({
     results:Object,
    });
    surface
</script>

<template>
      <div class="mx-auto bg-gray-200 max-w-2xl px-4 py-16 sm:px-6 sm:py-4 lg:max-w-7xl lg:px-8">
      <h2 class="text-2xl font-bold tracking-tight text-gray-900"> {{ $page.props.auth.user.name}} Vos Publications  </h2>

      <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8">
        <div v-for="result in results" :key="result.id" @click="navigateToBoost(result.id)" class="group relative">
          <div class="min-h-80 aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
            <img :src=" '/storage/' +  result.image1" :alt="result.imageAlt" class="h-full w-full object-cover object-center lg:h-full lg:w-full" />
          </div>
          <div class="mt-4 flex justify-between">


            <div class="space-y-2">
				<div class="space-y-4">
                    <div class="prix flex justify-between">
 <h4 class="text-md font-semibold text-cyan-900 text-justify">
						{{ result.nom }}
					</h4>

                     <h4 class="text-md font-semibold text-cyan-900 text-justify">
						{{ result.prix }} <span class="color-principal" >Fcfa</span>
					</h4>
                    </div>

				</div>

				<div class="flex items-center space-x-4 justify-between">
					<div class="text-grey-500 flex flex-row space-x-1  my-4">
						<p class="text-xs"> 10/dec/2023 </p>
					</div>
					<div class="flex flex-row space-x-1">
						<div
							class="bg-red-500 shadow-lg shadow- shadow-red-600 text-white cursor-pointer px-3 py-1 text-center justify-center items-center rounded-xl flex space-x-2 flex-row">
							<span><a href="www.google.com">Booster</a></span>
						</div>
						<div
							class="text-2 bg-green-500 shadow-lg shadow- shadow-green-600 text-white cursor-pointer px-3 text-center justify-center items-center py-1 rounded-xl flex space-x-2 flex-row">
							<span>deja vendu</span>
						</div>
					</div>
				</div>
			</div>


          </div>
        </div>
      </div>
    </div>
</template>

