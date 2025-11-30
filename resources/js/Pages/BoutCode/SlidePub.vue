<!-- <template>

    <div class=" w-full  mx-auto bg-principal shadow-lg rounded-lg overflow-hidden">
        <img :src="'/storage/slide/design2.png'" alt="Image description">

    </div>



</template>


<style>
#principalee {
    width: 100%;
    height: 10vh;
    object-fit: cover;
}
</style>

<script>
export default {
    name: 'SlidePub',
}


</script> -->
<template>
    <section class="custom-slider-container w-full mx-auto bg-secondaire shadow-md rounded-xl overflow-hidden" 
             role="region" 
             aria-label="Carrousel de publicités"
             @mouseenter="stopAutoplay"
             @mouseleave="startAutoplay">
        <div class="custom-slider" :style="{ transform: `translateX(-${currentSlide * 100}%)` }">
            <div v-for="(slide, index) in newSlides" 
                 :key="index" 
                 class="custom-slide"
                 :aria-hidden="index !== currentSlide">
                <img :src="slide" 
                     :alt="`Slide ${index + 1} de ${newSlides.length}`" 
                     class="w-full h-full object-cover custom-image"
                     loading="eager"
                     decoding="async"
                     :fetchpriority="index === 0 ? 'high' : 'low'">
            </div>
        </div>

        <!-- Boutons de navigation spécifiques -->
        <button 
            class="custom-prev" 
            @click="prevSlide"
            @keydown.enter="prevSlide"
            @keydown.space.prevent="prevSlide"
            aria-label="Slide précédent"
            aria-controls="carousel-slides">
            <span aria-hidden="true">‹</span>
        </button>
        <button 
            class="custom-next" 
            @click="nextSlide"
            @keydown.enter="nextSlide"
            @keydown.space.prevent="nextSlide"
            aria-label="Slide suivant"
            aria-controls="carousel-slides">
            <span aria-hidden="true">›</span>
        </button>

        <!-- Indicateurs de slide -->
        <div class="custom-indicators" role="tablist" aria-label="Indicateurs de slides">
            <button
                v-for="(slide, index) in newSlides"
                :key="index"
                :class="['custom-indicator', { 'active': index === currentSlide }]"
                @click="goToSlide(index)"
                :aria-label="`Aller au slide ${index + 1}`"
                :aria-selected="index === currentSlide"
                role="tab"
            ></button>
        </div>
    </section>
</template>

<script>
export default {
    name: 'SlidePubCustom',
    data() {
        return {
            currentSlide: 0,
            newSlides: [
                '/storage/slide/pub.png',
                '/storage/slide/Hub premium.png',
                '/storage/slide/3.png'
            ]
        };
    },
    methods: {
        nextSlide() {
            this.currentSlide = (this.currentSlide + 1) % this.newSlides.length;
        },
        prevSlide() {
            this.currentSlide =
                (this.currentSlide - 1 + this.newSlides.length) % this.newSlides.length;
        },
        goToSlide(index) {
            this.currentSlide = index;
        },
        startAutoplay() {
            if (this.autoplay) {
                clearInterval(this.autoplay);
            }
            this.autoplay = setInterval(this.nextSlide, 4000); // Change every 4 seconds
        },
        stopAutoplay() {
            if (this.autoplay) {
                clearInterval(this.autoplay);
                this.autoplay = null;
            }
        }
    },
    mounted() {
        this.startAutoplay(); // Start the autoplay when the component is mounted
    },
    beforeDestroy() {
        this.stopAutoplay(); // Clear the interval when the component is destroyed
    }
};
</script>

<style scoped>
.custom-slider-container {
    position: relative;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.custom-slider {
    display: flex;
    transition: transform 0.5s ease-in-out;
}

.custom-slide {
    min-width: 100%;
    height: 100%;
}

.custom-prev,
.custom-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    padding: 1rem;
    cursor: pointer;
}

.custom-prev {
    left: 10px;
}

.custom-next {
    right: 10px;
}

.custom-prev:hover,
.custom-next:hover {
    background-color: rgba(0, 0, 0, 0.8);
}

.custom-prev:focus,
.custom-next:focus {
    outline: 2px solid white;
    outline-offset: 2px;
}

/* Indicateurs de slide */
.custom-indicators {
    position: absolute;
    bottom: 1rem;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 0.5rem;
    z-index: 10;
}

.custom-indicator {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid white;
    background-color: transparent;
    cursor: pointer;
    transition: all 0.3s ease;
    padding: 0;
}

.custom-indicator:hover {
    background-color: rgba(255, 255, 255, 0.5);
    transform: scale(1.2);
}

.custom-indicator.active {
    background-color: white;
    transform: scale(1.3);
}

.custom-indicator:focus {
    outline: 2px solid white;
    outline-offset: 2px;
}

/* Amélioration de la transition */
.custom-slider {
    will-change: transform;
}

.custom-image {
    will-change: transform;
}
</style>
