<template>
 


  <div class="min-w-screen min-h-screen bg-yellow-300 flex items-center p-5 lg:p-10 overflow-hidden relative">
    <Navbar />
     <div class="w-full max-w-6xl rounded bg-white shadow-xl p-10 lg:p-20 mx-auto text-gray-800 relative md:text-left">
         <div class="md:flex items-center -mx-10">
             <div class="w-full md:w-1/2 px-10 mb-10 md:mb-0">
               <div class="carousel relative container mx-auto" style="max-width:1600px;">
     <div class="carousel-inner relative overflow-hidden w-full">
         <!--Slide 1  web--> 
         <input class="carousel-open absolute  top-0 bg-inherit " type="radio" id="carousel-1" name="carousel" aria-hidden="true" hidden="" checked="checked">
         <div class="carousel-item absolute opacity-0" style="height:50vh;">
             <div class="block h-full w-full mx-auto flex pt-6 md:pt-0 md:items-center bg-cover bg-right" style="background-image: url('https://cdn.pixabay.com/photo/2019/01/30/07/45/web-3963945_960_720.jpg');">
 
                 <div class="container mx-auto">
                     <div class="flex flex-col w-full lg:w-1/2 md:ml-16 items-center md:items-start px-6 tracking-wide">
                         <p class="text-black text-2xl my-4">Transformez votre idée en réalité avec notre service de développement d'application sur mesure, conçu pour répondre à vos besoins spécifiques..</p>
                         <a class="text-xl inline-block no-underline border-b border-gray-600 leading-relaxed hover:text-black hover:border-black" href="#">Developpement d application</a>
                     </div>
                 </div>
 
             </div>
         </div>
         <label for="carousel-3" class="prev control-1 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900 leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
         <label for="carousel-2" class="next control-1 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900 leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>
 
         <!--Slide 2-->
          <input class="carousel-open absolute top-0 bg-inherit " type="radio" id="carousel-2" name="carousel" aria-hidden="true" hidden="">
         <div class="carousel-item absolute opacity-0 bg-cover bg-right" style="height:50vh;">
             <div class="block h-full w-full mx-auto flex pt-6 md:pt-0 md:items-center bg-cover bg-right" style="background-image: url('https://www.challenge.ma/wp-content/uploads/2022/03/Next-Gen-Ford-Ranger-Raptor-2-1-1024x768.jpg');">
 
                 <div class="container mx-auto">
                     <div class="flex flex-col w-full lg:w-1/2 md:ml-16 items-center md:items-start px-6 tracking-wide">
                         <p class="text-black text-2xl my-4">Captivons votre audience avec des designs uniques et percutants créés sur mesure pour votre entreprise...</p>
                         <a class="text-xl inline-block no-underline border-b border-gray-600 leading-relaxed hover:text-black hover:border-black" href="#">Creation visuelle</a>
                     </div>
                 </div>
 
             </div>
         </div>
         <label for="carousel-1" class="prev control-2 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900  leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
         <label for="carousel-3" class="next control-2 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900  leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>
 
         <!--Slide 3-->
         <input class="carousel-open absolute top-0 bg-inherit " type="radio" id="carousel-3" name="carousel" aria-hidden="true" hidden="">
         <div class="carousel-item absolute opacity-0" style="height:50vh;">
             <div class="block h-full w-full mx-auto flex pt-6 md:pt-0 md:items-center bg-cover bg-bottom" style="background-image: url('https://images.unsplash.com/photo-1519327232521-1ea2c736d34d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1600&q=80');">
 
                 <div class="container mx-auto">
                     <div class="flex flex-col w-full lg:w-1/2 md:ml-16 items-center md:items-start px-6 tracking-wide">
                         <p class="text-black text-2xl my-4">Assurez la stabilité de votre entreprise grâce à notre service de câblage réseau et maintenance informatique professionnelle.</p>
                         <a class="text-xl inline-block no-underline border-b border-gray-600 leading-relaxed hover:text-black hover:border-black" href="#">Services</a>
                     </div>
                 </div>
 
             </div>
         </div>
         <label for="carousel-2" class="prev control-3 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900  leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
         <label for="carousel-1" class="next control-3 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900  leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label> 
 
         <!-- Add additional indicators for each slide-->
         <ol class="carousel-indicators">
             <li class="inline-block mr-3">
                 <label for="carousel-1" class="carousel-bullet cursor-pointer block text-4xl text-gray-400 hover:text-gray-900">•</label>
             </li>
             <li class="inline-block mr-3">
                 <label for="carousel-2" class="carousel-bullet cursor-pointer block text-4xl text-gray-400 hover:text-gray-900">•</label>
             </li>
             <li class="inline-block mr-3">
                 <label for="carousel-3" class="carousel-bullet cursor-pointer block text-4xl text-gray-400 hover:text-gray-900">•</label>
             </li>
         </ol>
 
     </div>
 </div>
             </div>
             <div class="w-full md:w-1/2 px-10">
                 <div class="mb-10">
                     <h1 class="font-bold uppercase text-3xl mb-5">{{ maison.nom }}</h1>
                     <p class="text-lg">{{ maison.description }} <a href="#" class="opacity-50 text-gray-900 hover:opacity-100 inline-block text-xs leading-none border-b border-gray-900">MORE <i class="mdi mdi-arrow-right"></i></a></p>
                 </div>
                 <div>
                     <div class="inline-block align-bottom mr-5">
                         <span class="text-2xl leading-none align-baseline">prix</span>
                         <span class="font-bold text-5xl leading-none align-baseline">{{ maison.prix }}</span>
                         <span class="text-2xl leading-none align-baseline"> Fcfa</span>
                     </div>
                     <div class="flex flex-col ">
                         <button class="bg-yellow-300 opacity-75 hover:opacity-100 text-yellow-900 hover:text-gray-900 rounded-full px-2 py-2 font-semibold m-1 w-2/4"><i class="mdi mdi-cart -ml-2 mr-2"></i> Me contacter sur whatshapp</button>
                         <button class="bg-yellow-300 opacity-75 hover:opacity-100 text-yellow-900 hover:text-gray-900 rounded-full px-2 py-2 font-semibold w-2/4"><i class="mdi mdi-cart -ml-2 mr-2"></i>Afficher mon numero</button>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div> 
 
 <!-- BUY ME A BEER AND HELP SUPPORT OPEN-SOURCE RESOURCES 
  <div class="flex items-end justify-end fixed bottom-0 right-0 mb-4 mr-4 z-10">
     <div>
         <a title="Buy me a beer" href="https://www.buymeacoffee.com/scottwindon" target="_blank" class="block w-16 h-16 rounded-full transition-all shadow hover:shadow-lg transform hover:scale-110 hover:rotate-12">
             <img class="object-cover object-center w-full h-full rounded-full" src="https://i.pinimg.com/originals/60/fd/e8/60fde811b6be57094e0abc69d9c2622a.jpg"/>
         </a>
     </div>
 </div> -->
 
 <Footer />
 
 
 
 </template>
 
 <script>
import Footer from '../Components/Footer.vue'
import Navbar from '../Components/Navbar.vue'
 export default {
  components: { Footer },
   props: {
     maison: Object
   }
 }
 </script>
 
 
 
 
