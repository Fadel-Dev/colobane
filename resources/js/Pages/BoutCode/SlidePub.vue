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
    <div class="custom-slider-container w-full mx-auto bg-secondaire shadow-md rounded-xl overflow-hidden">
        <div class="custom-slider" :style="{ transform: `translateX(-${currentSlide * 100}%)` }">
            <div v-for="(slide, index) in newSlides" :key="index" class="custom-slide">
                <img :src="slide" alt="Slide image" class="w-full h-full object-cover custom-image">
            </div>
        </div>

        <!-- Boutons de navigation spécifiques -->
        <button class="custom-prev" @click="prevSlide">‹</button>
        <button class="custom-next" @click="nextSlide">›</button>
    </div>
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
        startAutoplay() {
            this.autoplay = setInterval(this.nextSlide, 4000); // Change every 4 seconds
        },
        stopAutoplay() {
            clearInterval(this.autoplay);
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
</style>
