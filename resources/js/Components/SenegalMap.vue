<template>
    <div class="mb-6 px-2 py-4 bg-white rounded-lg border border-gray-200 shadow-sm">
        <!-- Titre -->
        <h4 class="text-sm font-semibold text-gray-900 mb-3 flex items-center px-2">
            <i class="fas fa-map-location-dot mr-2 text-principal"></i>
            Sélectionner une région
        </h4>
        
        <!-- Carte Leaflet - TAILLE AUGMENTÉE -->
        <div ref="mapContainer" class="w-full h-80 rounded-lg border border-gray-300 overflow-hidden -mx-2"></div>
        
        <!-- Région sélectionnée -->
        <div v-if="selectedCity" class="mt-3 p-2 bg-principal/10 rounded text-sm text-gray-700 mx-2">
            <i class="fas fa-check-circle text-principal mr-2"></i>
            <strong>{{ selectedCity }}</strong> sélectionnée
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

const props = defineProps({
    modelValue: String,
});

const emit = defineEmits(['update:modelValue']);

const mapContainer = ref(null);
let map = null;
let selectedCity = ref(props.modelValue || '');

// Coordonnées des villes principales au Sénégal
const cities = {
    'Dakar': { lat: 14.7167, lng: -17.4674, color: '#E74C3C' },
    'Thiès': { lat: 14.7854, lng: -16.9275, color: '#F39C12' },
    'Kaolack': { lat: 13.9667, lng: -16.0167, color: '#F39C12' },
    'Saint-Louis': { lat: 16.0186, lng: -16.4898, color: '#F39C12' },
    'Tambacounda': { lat: 13.7667, lng: -13.7667, color: '#3498DB' },
    'Kolda': { lat: 13.6667, lng: -14.9667, color: '#3498DB' },
    'Ziguinchor': { lat: 13.5525, lng: -15.5577, color: '#3498DB' },
    'Matam': { lat: 15.6626, lng: -13.2511, color: '#3498DB' },
};

onMounted(() => {
    // Initialiser la carte centrée sur le Sénégal
    map = L.map(mapContainer.value).setView([14.5, -14.5], 7);

    // Ajouter le layer OSM
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 19,
    }).addTo(map);

    // Ajouter des marqueurs pour chaque ville
    Object.entries(cities).forEach(([cityName, coords]) => {
        // Créer une icône personnalisée
        const icon = L.divIcon({
            html: `<div class="flex items-center justify-center w-8 h-8 rounded-full text-white font-bold text-xs shadow-lg" style="background-color: ${coords.color};">
                    <i class="fas fa-map-pin"></i>
                   </div>`,
            iconSize: [32, 32],
            className: '',
        });

        // Créer un marqueur
        const marker = L.marker([coords.lat, coords.lng], { icon })
            .addTo(map)
            .bindPopup(`<div class="text-sm font-semibold text-gray-900">${cityName}</div>`)
            .on('click', () => {
                selectedCity.value = cityName;
                emit('update:modelValue', cityName);
            });
    });

    // Ajouter un contrôle de zoom
    L.control.zoom({ position: 'bottomright' }).addTo(map);
});

</script>

<style scoped>
:deep(.leaflet-container) {
    font-family: inherit;
    z-index: 1;
}

:deep(.leaflet-popup-content) {
    padding: 8px 12px;
    margin: 0;
}

:deep(.leaflet-popup-content-wrapper) {
    border-radius: 6px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

:deep(.leaflet-div-icon) {
    background: transparent;
    border: none;
}

:deep(.leaflet-control-zoom-in,
.leaflet-control-zoom-out) {
    background-color: white !important;
    border: 1px solid #e5e7eb !important;
    color: #374151 !important;
    font-weight: bold;
}

:deep(.leaflet-control-zoom-in:hover,
.leaflet-control-zoom-out:hover) {
    background-color: #f3f4f6 !important;
    color: #1f2937 !important;
}
</style>

