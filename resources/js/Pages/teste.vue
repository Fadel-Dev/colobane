<template>
 <div class="relative">
  <img src="https://stimg.cardekho.com/images/carexteriorimages/930x620/Land-Rover/Range-Rover/9018/1676541159356/front-left-side-47.jpg" alt="Description de l'image" class="cursor-pointer" onclick="ouvrirImage()">
  <div class="hidden absolute inset-0 bg-black bg-opacity-50 flex justify-center items-center" id="image-overlay">
    <img src="https://stimg.cardekho.com/images/carexteriorimages/930x620/Land-Rover/Range-Rover/9018/1676541159356/front-left-side-47.jpg" alt="Description de l'image" class="max-w-full max-h-full">
    <button class="absolute top-0 right-0 m-4 text-white text-2xl" onclick="fermerImage()">
      <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
      </svg>
    </button>
  </div>
</div>

</template>


<style>
  #image-overlay {
    transition: opacity 0.3s;
  }

  #image-overlay.hidden {
    opacity: 0;
    pointer-events: none;
  }
</style>
<script>

export default{
    
}
  


  
</script>



<!-- 


<template>
    <div>
      <img :src="maison.image" alt="Image de la maison">
      <h1>{{ maison.nom }}</h1>
      <p>{{ maison.description }}</p>
    
    </div>
  </template>
  
  <script>
  export default {
    props: {
      maison: Object
    }
  }
  </script>
  



 -->