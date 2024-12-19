<template>
    <div class="bg-gradient-to-r from-principal via-secondaire to-principal text-white py-2">
        <div class="container mx-auto flex justify-between items-center px-4">
            <!-- Numéro de téléphone -->
            <div class="flex items-center gap-2">
                <i class="fas fa-phone-alt"></i>
                <span class="text-sm sm:text-base sm:block">+221 77 526 68 64 </span>
            </div>

            <!-- Phrases animées -->
            <div class="text-center relative">
                <transition name="fade" mode="out-in">
                    <span v-if="phrases.length > 0" :key="currentPhrase" class="text-sm sm:text-base italic block">
                        {{ phrases[currentPhrase] }}
                    </span>
                </transition>
            </div>

            <!-- Icônes des réseaux sociaux -->
            <div class="flex items-center gap-4">
                <a v-for="(icon, index) in socialIcons" :key="index" :href="icon.href" target="_blank"
                    rel="noopener noreferrer" class="hover:opacity-80 transition">
                    <i :class="icon.class"></i>
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
                "Bienvenue sur notre site !",
                "Trouvez votre logement idéal.",
                "Achetez ou louez votre voiture.",
                "Contactez-nous pour plus d'informations.",
            ],
            currentPhrase: 0,
            intervalId: null,
            socialIcons: [
                { href: "https://www.facebook.com/profile.php?id=61569677924703", class: "fab fa-facebook-f" },
                { href: "https://twitter.com", class: "fab fa-twitter" },
                { href: "https://www.instagram.com/noflayhub/", class: "fab fa-instagram" },
                { href: "https://www.linkedin.com/company/98545491/admin/dashboard/", class: "fab fa-linkedin-in" },
            ],
        };
    },
    mounted() {
        this.rotatePhrases();
    },
    beforeDestroy() {
        clearInterval(this.intervalId);
    },
    methods: {
        rotatePhrases() {
            this.intervalId = setInterval(() => {
                this.currentPhrase = (this.currentPhrase + 1) % this.phrases.length;
            }, 4000);
        },
    },
};
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 1s ease-in-out;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>