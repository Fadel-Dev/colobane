<template>
    <div
        class="bg-gradient-to-r from-principal/10 to-secondaire/10 backdrop-blur-sm border border-principal/20 my-8 rounded-3xl p-8 relative overflow-hidden">
        <div class="absolute -right-10 -top-10 w-32 h-32 bg-principal/5 rounded-full"></div>
        <div class="absolute -left-10 -bottom-10 w-40 h-40 bg-secondaire/5 rounded-full"></div>

        <div class="text-center relative z-10">
            <div
                class="flex flex-col md:flex-row items-center justify-center space-y-4 md:space-y-0 md:space-x-6">
                <div>
                                        <span
                                            class="text-secondaire text-2xl md:text-3xl font-bold inline-flex items-center">
                                            <i class="fas fa-rocket mr-3 text-principal"></i>
                                            C'est le moment de vendre
                                        </span>
                </div>
                <a :href="route('publier')"
                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-principal to-secondaire text-white rounded-xl hover:opacity-90 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                    <i class="fas fa-plus mr-2"></i>
                    <span>Déposer une annonce</span>
                </a>
            </div>
        </div>
    </div>

</template>
