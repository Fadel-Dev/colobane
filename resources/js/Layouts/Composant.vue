<template>
    <div class="bg-gradient-to-r from-principal via-secondaire to-principal text-white py-2">
        <div class="container mx-auto flex justify-between items-center px-4">
            <!-- Numéro de téléphone -->
            <div class="flex items-center  gap-1">
                <i class="fab fa-whatsapp text-green-400 text-xs sm:text-sm md:text-base"></i>
                <a href="https://wa.me/221775266864?text=Exprimez%20vos%20besoins%20:%20trouvez%20votre%20futur%20logement,%20terrain%20ou%20véhicule%20en%20quelques%20clics."
                    target="_blank" rel="noopener noreferrer"
                    class="btn-primary relative text-xs sm:text-sm md:text-base">
                    77 526 68 64
                </a>
            </div>


            <!-- Phrases sans transition -->
            <div class="text-center">
                <span class="text-sm sm:text-base italic block">
                    {{ phrases[currentPhrase] }}
                </span>
            </div>

            <!-- Icônes des réseaux sociaux -->
            <div class="flex items-center gap-4">
                <a v-for="(icon, index) in socialIcons" :key="index" :href="icon.href" target="_blank"
                    rel="noopener noreferrer" class="hover:opacity-80 transition">
                    <i :class="icon.class" class="text-sm sm:text-base md:text-lg"></i>
                </a>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: "TopBanner",
    data() {
        return {
            phrases: [
                "Bienvenue sur Noflayhub !",
                "Trouvez votre logement idéal.",
                "Achetez ou louez votre voiture.",
                "Contactez-nous pour plus d'infos.",
            ],
            currentPhrase: 0,
            intervalId: null,
            socialIcons: [
                { href: "https://www.facebook.com", class: "fab fa-facebook-f" },
                { href: "https://twitter.com", class: "fab fa-twitter" },
                { href: "https://www.instagram.com", class: "fab fa-instagram" },
                { href: "https://www.linkedin.com", class: "fab fa-linkedin-in" },
            ],
        };
    },
    mounted() {
        this.startPhraseRotation();
    },
    beforeUnmount() {
        this.stopPhraseRotation();
    },
    methods: {
        startPhraseRotation() {
            this.intervalId = setInterval(() => {
                this.currentPhrase = (this.currentPhrase + 1) % this.phrases.length;
            }, 4000); // 4-second interval
        },
        stopPhraseRotation() {
            if (this.intervalId) {
                clearInterval(this.intervalId);
            }
        },
    },
};
</script>
