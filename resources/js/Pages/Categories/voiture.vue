<script setup>
import { useForm } from "@inertiajs/vue3"
import AppLayout from '@/Layouts/AppLayout.vue';


// LOCATION
const lead = useForm({
    nom: null,
    marque: null,
    prix: null,
    boiteVitesse: null,
    description: null,
    carburant: null,
    place: null,
    region: null,
    image1: null,
    image2: null,
    image3: null,
})

function handleSubmitLocation() {
    lead.post('/voitureLocation/save')
}

// VENTE
const vente = useForm({
    nom: null,
    etat: null,
    marque: null,
    model: null,
    prix: null,
    description: null,
    carburant: null,
    annee: null,
    boiteVitesse: null,
    kilometrage: null,
    place: null,
    region: null,
    image1: null,
    image2: null,
    image3: null,
})

function handleSubmitVente() {
    vente.post('/voitureVente/save')
}
</script>
<template>
    <AppLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                publcation voiture
            </h2>
        </template>
        <div class="w-5/6 my-7 mx-auto rounded-2xl lg:w-2/5 border-2 shadow-lg border-slate-400">
            <h2 class="text-2xl font-bold mb-4 text-center text-gray-800">Sélectionnez une image</h2>
            <div id="menu" class="space-y-4">
                <div v-for="image in images" :key="image.id" class="flex flex-col items-center">
                    <label class="w-full cursor-pointer">
                        <input type="radio" :value="image.titre" v-model="lead.type" class="hidden">
                        <div
                            class="w-full p-4 border border-gray-300 rounded-lg hover:border-gray-500 focus-within:border-indigo-500">
                            <h3 class="text-lg font-semibold text-center text-gray-700 mb-2">{{ image.titre }}</h3>
                            <img :src="image.src" :alt="image.alt" class="rounded-lg shadow-lg w-full">
                        </div>
                    </label>
                </div>
            </div>
        </div>


        <!-- LOCATION -->

        <div v-if="lead.type == 'location'">
            <div class="p-6  w-5/6 m-auto rounded-2xl border-2 shadow-lg border-slate-200  lg:w-2/5 ">
                <h2 class="button my-5 text-white text-center bg-principal rounded-full py-3">Ecrivez votre annonce de
                    location
                </h2>

                <form @submit.prevent="handleSubmitLocation">
                    <div class="titre">
                        <div class="mb-4">
                            <!-- <label class="block text-gray-700 font-bold mb-2"
          for="nom">
              Entrez le titre
          </label> -->
                            <input class="w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none
         focus:border-white focus:ring focus:ring-white focus:ring-opacity-50
        " id="nom" name="nom" type="text" placeholder="Entrez le titre" v-model="lead.nom" required>
                        </div>

                        <div class="mb-4">
                            <!-- <label class="block text-gray-700 font-bold mb-2"
             for="marque">
                 Marque
             </label> -->
                            <select class="w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none
         focus:border-white focus:ring focus:ring-white focus:ring-opacity-50
        " for="marque" name="marque" id="marque" v-model="lead.marque" required>


                                <option>Volvo</option>
                                <option value="renault">Renault</option>
                                <option value="peugeot">Peugeot</option>
                                <option value="citroen">Citroën</option>
                                <option>Mitsubishi</option>
                                <option value="bmw">BMW</option>
                                <option value="audi">Audi</option>
                                <option>Nissan</option>
                                <option value="mercedes-benz">Mercedes-Benz</option>
                                <option value="volkswagen">Volkswagen</option>
                                <option value="toyota">Toyota</option>
                                <option value="ford">Ford</option>
                                <option value="jeep">Jeep</option>
                                <option value="autre">Autes</option>

                            </select>
                        </div>
                    </div>

                    <div class="placePrix">
                        <div class="mb-4">
                            <!-- <label class="block text-gray-700 font-bold mb-2"
          for="place">
              place
          </label> -->
                            <input class="w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none
         focus:border-white focus:ring focus:ring-white focus:ring-opacity-50
        " id="place" name="place" type="text" placeholder="4" v-model="lead.place" required>
                        </div>

                        <div class="mb-4">
                            <!-- <label class="block text-gray-700 font-bold mb-2" for="price">
              Prix
          </label> -->
                            <input class="w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none
         focus:border-white focus:ring focus:ring-white focus:ring-opacity-50
        " id="prix" type="text" placeholder="Entrez le prix" name="prix" v-model="lead.prix" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-500 font-bold mb-2" for="fuel">
                            Boite de vitesse
                        </label>
                        <select class="w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none
         focus:border-white focus:ring focus:ring-white focus:ring-opacity-50
        " id="boiteVitesse" name="boiteVitesse" v-model="lead.boiteVitesse">
                            <option value="automatique">Automatique</option>
                            <option value="manuelle">Manuel</option>
                        </select>
                    </div>




                    <div class="mb-4">
                        <!-- <label class="block text-gray-700 font-bold mb-2" for="description">
              Description
          </label> -->
                        <textarea class="w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none
         focus:border-white focus:ring focus:ring-white focus:ring-opacity-50
        " id="description" rows="5" name="description" v-model="lead.description" placeholder="Entrez la description"
                            required></textarea>
                    </div>
                    <div class="img grid grid-cols-3">
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="image">
                                Image 1
                            </label>
                            <input type="file" @input="lead.image1 = $event.target.files[0]" class="w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none
         focus:border-white focus:ring focus:ring-white focus:ring-opacity-50
        " />
                            <progress v-if="lead.progress" :value="lead.progress.percentage" max="100">
                                {{ lead.progress.percentage }}%
                            </progress>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="image">
                                Image 2
                            </label>
                            <input type="file" @input="lead.image2 = $event.target.files[0]" class="w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none
         focus:border-white focus:ring focus:ring-white focus:ring-opacity-50
        " />
                            <progress v-if="lead.progress" :value="lead.progress.percentage" max="100">
                                {{ lead.progress.percentage }}%
                            </progress>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="image">
                                Image 3
                            </label>
                            <input type="file" @input="lead.image3 = $event.target.files[0]" class="w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none
         focus:border-white focus:ring focus:ring-white focus:ring-opacity-50
        " />
                            <progress v-if="lead.progress" :value="lead.progress.percentage" max="100">
                                {{ lead.progress.percentage }}%
                            </progress>
                        </div>
                    </div>

                    <div class="titre">
                        <div class="carbRegion grid grid-cols-2">
                            <div class="mb-4">
                                <label class="block text-gray-700 font-bold mb-2" for="fuel">
                                    Carburant
                                </label>
                                <select class="w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none
         focus:border-white focus:ring focus:ring-white focus:ring-opacity-50
        " id="carburant" name="carburant" v-model="lead.carburant">
                                    <option value="essence">Essence</option>
                                    <option value="diesel">Diesel</option>
                                </select>
                            </div>




                            <div class="mb-4">
                                <label class="block text-gray-700 font-bold mb-2" for="region">
                                    Region
                                </label>
                                <select class="w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none
         focus:border-white focus:ring focus:ring-white focus:ring-opacity-50
        " name="region" id="region" v-model="lead.region" required>
                                    <option value="Dakar">Dakar</option>
                                    <option value="Diourbel">Diourbel</option>
                                    <option value="Fatick">Fatick</option>
                                    <option value="Kaffrine">Kaffrine</option>
                                    <option value="Kaolack">Kaolack</option>
                                    <option value="Kédougou">Kédougou</option>
                                    <option value="Kolda">Kolda</option>
                                    <option value="Louga">Louga</option>
                                    <option value="Matam">Matam</option>
                                    <option value="Saint-Louis">Saint-Louis</option>
                                    <option value="Sédhiou">Sédhiou</option>
                                    <option value="Tambacounda">Tambacounda</option>
                                    <option value="Thiès">Thiès</option>
                                    <option value="Ziguinchor">Ziguinchor</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="bg-principal text-white px-5 py-1 rounded-2xl">save</button>

                </form>
            </div>
        </div>
        <div v-if="lead.type == 'vente'">
            <div class="p-6  w-5/6 m-auto rounded-2xl border-2 shadow-lg border-slate-200  lg:w-2/5 ">
                <form @submit.prevent="handleSubmitVente">
                    <div class="mb-4">
                        <h2 class="button my-5 text-center text-white bg-principal rounded-full py-3">Ecrivez votre
                            annonce de
                            voiture</h2>

                        <!-- <label class="block text-gray-700 font-bold mb-2"
             for="nom">
                 Titre
             </label> -->
                        <input class="w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none
         focus:border-white focus:ring focus:ring-white focus:ring-opacity-50
        " id="nom" name="nom" type="text" placeholder="Entrez le titre de votre ..." v-model="vente.nom" required>
                    </div>

                    <div class="grid grid-cols-4 gap-2">
                        <div class="">
                            <!-- <label class="block text-gray-700 font-bold mb-2" for="text">Marque</label> -->
                            <select class="w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none
         focus:border-white focus:ring focus:ring-white focus:ring-opacity-50
        " name="marque" id="marque" v-model="vente.marque" required>
                                <option>Acura</option>
                                <option>Alfa Romeo</option>
                                <option>Aston Martin</option>
                                <option>Audi</option>
                                <option>Bentley</option>
                                <option>BMW</option>
                                <option>Bugatti</option>
                                <option>Buick</option>
                                <option>Cadillac</option>
                                <option>Caterham</option>
                                <option>Chevrolet</option>
                                <option>Chrysler</option>
                                <option>Citroën</option>
                                <option>Dacia</option>
                                <option>Daewoo</option>
                                <option>Daihatsu</option>
                                <option>Dodge</option>
                                <option>DS Automobiles</option>
                                <option>Ferrari</option>
                                <option>Fiat</option>
                                <option>Fisker</option>
                                <option>Ford</option>
                                <option>Genesis</option>
                                <option>GMC</option>
                                <option>Holden</option>
                                <option>Honda</option>
                                <option>Hyundai</option>
                                <option>Infiniti</option>
                                <option>Isuzu</option>
                                <option>Jaguar</option>
                                <option>Jeep</option>
                                <option>Kia</option>
                                <option>Koenigsegg</option>
                                <option>Lamborghini</option>
                                <option>Lancia</option>
                                <option>Land Rover</option>
                                <option>Lexus</option>
                                <option>Lincoln</option>
                                <option>Lotus</option>
                                <option>Maserati</option>
                                <option>Mazda</option>
                                <option>McLaren</option>
                                <option>Mercedes-Benz</option>
                                <option>MG</option>
                                <option>Mini</option>
                                <option>Mitsubishi</option>
                                <option>Nissan</option>
                                <option>Opel</option>
                                <option>Pagani</option>
                                <option>Peugeot</option>
                                <option>Polestar</option>
                                <option>Pontiac</option>
                                <option>Porsche</option>
                                <option>RAM</option>
                                <option>Renault</option>
                                <option>Rolls-Royce</option>
                                <option>Saab</option>
                                <option>SEAT</option>
                                <option>Škoda</option>
                                <option>Smart</option>
                                <option>Subaru</option>
                                <option>Suzuki</option>
                                <option>Tesla</option>
                                <option>Toyota</option>
                                <option>Vauxhall</option>
                                <option>Volkswagen</option>
                                <option>Volvo</option>
                                <option>Wiesmann</option>

                            </select>
                        </div>

                        <!--  -->
                        <div class="mb-4 col-span-3">
                            <div class="  mx-auto ">
                                <!-- <label class="block text-gray-700 font-bold mb-2" for="model">
                 Modèle
             </label> -->
                                <input class="w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none
         focus:border-white focus:ring focus:ring-white focus:ring-opacity-50
        " id="model" type="text" name="model" placeholder="Entrez le modèle" v-model="vente.model" required>
                            </div>
                        </div>
                    </div>
                    <div class="prixAnnee grid grid-cols-2 gap-2 ">
                        <div class="mb-4 ">
                            <!-- <label class="block text-gray-700 font-bold mb-2"
             for="annee">
                 Annee
             </label> -->
                            <input class="w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none
         focus:border-white focus:ring focus:ring-white focus:ring-opacity-50
        " id="annee" name="annee" type="text" placeholder="1999" v-model="vente.annee" required>
                        </div>


                        <div class="mb-4">
                            <!-- <label class="block text-gray-700 font-bold mb-2" for="price">
                 Prix
             </label> -->
                            <input class="w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none
         focus:border-white focus:ring focus:ring-white focus:ring-opacity-50
        " id="prix" type="text" placeholder="Entrez le prix" name="prix" v-model="vente.prix" required>
                        </div>
                    </div>
                    <div class="kiloPlace">
                        <div class="mb-4">
                            <!-- <label class="block text-gray-700 font-bold mb-2" for="price">
                 kilometrage
             </label> -->
                            <input class="w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none
         focus:border-white focus:ring focus:ring-white focus:ring-opacity-50
        " id="kilometrage" type="text" placeholder="Entrez le kilometrage" name="kilometrage"
                                v-model="vente.kilometrage" required>
                        </div>

                        <div class="mb-4">
                            <!-- <label class="block text-gray-700 font-bold mb-2" for="price">
                 place
             </label> -->
                            <input class="w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none
         focus:border-white focus:ring focus:ring-white focus:ring-opacity-50
        " id="place" type="text" placeholder="Entrez le place" name="place" v-model="vente.place" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <!-- <label class="block text-gray-700 font-bold mb-2" for="description">
                 Description
             </label> -->
                        <textarea class="w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none
         focus:border-white focus:ring focus:ring-white focus:ring-opacity-50
        " id="description" rows="5" name="description" v-model="vente.description" placeholder="Entrez la description"
                            required></textarea>
                    </div>


                    <div class="carb">
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="fuel">
                                Carburant
                            </label>
                            <select class="w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none
         focus:border-white focus:ring focus:ring-white focus:ring-opacity-50
        " id="carburant" name="carburant" v-model="vente.carburant">
                                <option value="essence">Essence</option>
                                <option value="diesel">Diesel</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="fuel">
                                Boite de vitesse
                            </label>
                            <select class="w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none
         focus:border-white focus:ring focus:ring-white focus:ring-opacity-50
        " id="boiteVitesse" name="boiteVitesse" v-model="vente.boiteVitesse">
                                <option value="automatique">Automatique</option>
                                <option value="manuelle">Manuel</option>
                            </select>
                        </div>
                    </div>

                    <div class="etatRegion">
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="fuel">
                                Etat
                            </label>
                            <select class="w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none
         focus:border-white focus:ring focus:ring-white focus:ring-opacity-50
        " id="etat" name="etat" v-model="vente.etat">
                                <option value="occasion">occasion</option>
                                <option value="neuf">neuf</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="region">
                                Region
                            </label>
                            <select class="w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none
         focus:border-white focus:ring focus:ring-white focus:ring-opacity-50
        " name="region" id="region" v-model="vente.region" required>
                                <option value="dakar">dakar</option>
                                <option value="diourbel">diourbel</option>
                                <option value="fatick">fatick</option>
                                <option value="kaffrine">kaffrine</option>
                                <option value="kaolack">kaolack</option>
                                <option value="kédougou">kédougou</option>
                                <option value="kolda">kolda</option>
                                <option value="louga">louga</option>
                                <option value="matam">matam</option>
                                <option value="saint-louis">saint-louis</option>
                                <option value="sédhiou">sédhiou</option>
                                <option value="tambacounda">tambacounda</option>
                                <option value="thiès">thiès</option>
                                <option value="ziguinchor">ziguinchor</option>
                            </select>
                        </div>
                    </div>
                    <div class="img grid grid-cols-3">
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="image">
                                Image 1
                            </label>
                            <input class="w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none
         focus:border-white focus:ring focus:ring-white focus:ring-opacity-50
        " type="file" @input="vente.image1 = $event.target.files[0]" @change="vente.image1" />
                            <progress v-if="vente.progress" :value="vente.progress.percentage" max="100">
                                {{ vente.progress.percentage }}%
                            </progress>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="image">
                                Image 2
                            </label>
                            <input class="w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none
         focus:border-white focus:ring focus:ring-white focus:ring-opacity-50
        " type="file" @input="vente.image2 = $event.target.files[0]" />
                            <progress v-if="vente.progress" :value="vente.progress.percentage" max="100">
                                {{ vente.progress.percentage }}%
                            </progress>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="image">
                                Image 3
                            </label>
                            <input class="w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none
         focus:border-white focus:ring focus:ring-white focus:ring-opacity-50
        " type="file" @input="vente.image3 = $event.target.files[0]" />
                            <progress v-if="vente.progress" :value="vente.progress.percentage" max="100">
                                {{ vente.progress.percentage }}%
                            </progress>
                        </div>
                    </div>

                    <button type="submit" class="bg-principal text-white px-5 py-1 rounded-2xl">save</button>

                </form>
            </div>
        </div>
    </AppLayout>




</template>

<style>
.kiloPlace,
.carb,
.placePrix {
    display: grid;
    grid-template-columns: 35% 62%;
    grid-gap: 2%;
    margin: auto;
}

.etatRegion,
.titre {
    display: grid;
    grid-template-columns: 62% 35%;
    grid-gap: 2%;
    margin: auto;
}

#titre {
    margin: 0;
    width: 68%;
}

#menu {
    width: 95%;
    margin: auto;
    display: grid;
    grid-template-columns: 48% 48%;
    grid-gap: 4%;
}

#menu img {
    width: 65%;
    margin: auto
}


/* ecrivez une annonce */

.button {
    min-width: 120px;

    position: relative;
    cursor: pointer;

    padding: 12px 17px;
    border: 0;
    border-radius: 7px;

    box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.1);
    background: radial-gradient(ellipse at bottom,
            rgba(235, 45, 83, 1) 0%,
            rgba(235, 45, 83, 1) 45%);

    color: white;

    transition: all 1s cubic-bezier(0.15, 0.83, 0.66, 1);
}

.button::before {
    content: "";
    width: 70%;
    height: 1px;

    position: absolute;
    bottom: 0;
    left: 15%;

    background: rgb(255, 255, 255);

    .element {
        background: linear-gradient(90deg,
                rgba(235, 45, 83, 1) 0%,
                rgba(235, 45, 83, 1) 50%,
                rgba(235, 45, 83, 1) 100%);
        opacity: 0.2;
    }

    transition: all 1s cubic-bezier(0.15, 0.83, 0.66, 1);
}

.button:hover {
    color: rgb(255, 255, 255, 1);
    transform: scale(1.1) translateY(-3px);
}

.button:hover::before {
    opacity: 1;
}
</style>

<script>
export default {
    data() {
        return {
            images: [
                { id: 1, src: "https://img.freepik.com/vecteurs-libre/achat-location-voiture-sport-rapide-nouvelle_3446-651.jpg?w=2000", alt: "Image 1", titre: "vente" },
                { id: 2, src: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ4cbKD05717C87IvUZtFveQS-FOoiwt99H0crhA_M5qaoXJQxCHnQNo2n9v4ZVIAnuYzQ&usqp=CAU", alt: "Image 2", titre: "location" },
            ],
            selectedImage: null
        }
    }
}
</script>
