<template>
      <div>
        <h1>Détails du patient</h1>

        

            <form @submit="handleSubmit">
                <h2>cool</h2>
                <div class="py-12 bg-gray-700 transition duration-150 ease-in-out z-10 absolute top-0 right-0 bottom-0 left-0"
                    id="modal">
                    <div role="alert" class="container mx-auto w-11/12 md:w-2/3 max-w-lg">
                        <div class="relative py-8 px-5 md:px-10 bg-white shadow-md rounded border border-gray-400">


                            <!-- <div class="main flex ">
                                <div class="nom flex-auto">
                                    <span for="name" class="text-gray-800 text-lg font-bold forming-tight tracking-normal">
                                Prenom && Nom
                            </span> <br>


                            <span for="name" class="text-gray-500 text-sm font-bold forming-tight tracking-normal">
                                {{ nomPatient }}
                            </span>
                                </div>

                                <div class="phone">
                                    <span for="name" class="text-gray-800 text-lg font-bold forming-tight tracking-normal">
                                Telephone du Patient
                            </span> <br>


                            <span for="name" class="text-gray-500 text-sm font-bold forming-tight tracking-normal">
                                {{ phonePatient }}
                            </span>
                                </div>
                            </div> -->
                            <label for="email2" class="text-gray-800 text-sm font-bold forming-tight tracking-normal">
                                Modifier l etat</label>
                            <div class="relative mb-5 mt-2">

                                <select
                class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="etat"
            id="etat"
            name="etat"
            v-model="form.status"

            >
            <option value="accepter">Accepter</option>
            <option value="attente">En attente</option>



       </select>
                            </div>
                            <label for="expiry"
                                class="text-gray-800 text-sm font-bold forming-tight tracking-normal">Changer L
                                heure</label>
                            <div class="relative mb-5 mt-2">

                                <input datepicker type="time"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="saisir l'heure hh : mm"
                                     v-model="form.boosted_at">
                            </div>
                            <label for="cvc" class="text-gray-800 text-sm font-bold forming-tight tracking-normal">Changer
                                la date</label>
                            <div class="relative mb-5 mt-2">

                                <div class="relative max-w-sm">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <input datepicker type="date"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="saisir une date date xx/yy/zzzz"
                                        v-model="form.date_fin_booster">
                                </div>
                            </div>


                            <div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Annuler">
					<input type="submit" class="btn btn-success text-black" value="Enregistrer">
				</div>
                        </div>
                    </div>

                </div>

            </form>





       

    </div>
</template>

<script>
</script>
