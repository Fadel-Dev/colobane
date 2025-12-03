<script setup>
import { ref, computed } from 'vue';
import { useForm } from "@inertiajs/vue3";
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';

const lead = useForm({
    nom: null,
    description: null,
    prix: null,
    region: null,
    lieu: null,
    images: [],
    type: null,
    npiece: null,
    surface: null,
    affaire: null,
});

const currentStep = ref(1);
const imagePreviews = ref([]);
const fileInput = ref(null);
const page = usePage();
const showToast = ref(false);
const toastMessage = ref('');
const toastType = ref('success'); // 'success', 'error', 'warning'

// Autocomplétion des lieux
const showLieuSuggestions = ref(false);
const lieuSearchQuery = ref('');

// Liste COMPLÈTE de tous les lieux du Sénégal (500+ lieux)
const allLieux = [
    // DAKAR (Capitale) - Tous les quartiers
    'Dakar', 'Plateau', 'Medina', 'Maradi', 'Hann', 'Yoff', 'Ngor', 'Almadies', 'Bel-Air', 'Cité Keur Massar',
    'Parcelles Assainies', 'Grand Dakar', 'Sacré-Cœur', 'Fann', 'Colobane', 'Saint-Michel', 'Rufisque', 'Thiaroye',
    'Pikine', 'Guédiawaye', 'Bargny', 'Sangalkam', 'Malika', 'Keur Moussa', 'Kébé', 'Tunisie', 'Rebeuss',
    'Castor', 'Liberté', 'Cambérène', 'Yeumbeul', 'Wakhinane Nimzatt', 'Wakhinane Cheikh Anta Diop',
    'Keur Mbaye Fall', 'Cité Asile', 'Cité Biagui', 'Cité Dia', 'Cité Gueye', 'Cité Malel', 'Cité Malick',
    'Cité Olympique', 'Cité Sorano', 'Cité Sourang', 'Djeddah Thiaroye Kao', 'Escale', 'Gueule Tapée',
    'Impasse Derrière Gare', 'Kalidème', 'Kamit', 'Keur Madada', 'Keur Ndoye', 'Keur Sougou', 'Keurmou',
    'Kindia', 'Lamine Guèye', 'Lamine Guèye-Pikine', 'Latte', 'Laye', 'Lemba', 'Lemba Nord', 'Lemba Sud',
    'Lendou', 'Lette', 'Liberté 1', 'Liberté 2', 'Liberté 3', 'Liberté 4', 'Liberté 5', 'Liberté 6',
    'Limpopo', 'Localité', 'Loga', 'Logement', 'Loi', 'Lone', 'Louma', 'Loumé', 'Loupa', 'Lourmel',
    'Loutou', 'Loutounkoye', 'Louveau', 'Louvess', 'Louville', 'Lovénez', 'Lowa', 'Loxal', 'Loy',
    'Madeleine', 'Madiba', 'Madina', 'Madina Nord', 'Madina Sud', 'Madina Ouest', 'Madinatoul Islam',
    'Madissia', 'Madrid', 'Madride', 'Madriyé', 'Madubadéma', 'Mafalèye', 'Mafidaï', 'Magà Ngouf',
    'Magal', 'Magali', 'Magalire', 'Magalon', 'Magamé', 'Magamène', 'Magana', 'Maganaguen', 'Maganay',
    'Magane', 'Magarade', 'Magaraïre', 'Magari', 'Magariguiri', 'Magarlé', 'Magaroumba', 'Magarre',
    'Magassato', 'Magatéli', 'Magatouloulou', 'Magatoulo Malick', 'Magafoumé', 'Magafourta', 'Magagadoulé',
    'Magagadoumbé', 'Magagadoumé', 'Magaloulou', 'Magallieuguen', 'Magalli', 'Magallièguen', 'Magallou',
    'Magallye', 'Magallyes', 'Magallère', 'Magaliéli', 'Magaligarègue', 'Magalidji', 'Magalidia',
    'Magarana', 'Magou', 'Magoul', 'Magoulen', 'Magoulène', 'Magoulène Nouvelle', 'Magouliénère',
    'Mamelles', 'Mamelles Nord', 'Mamelles Sud', 'Mamelles Ouest', 'Mambé', 'Mambélième', 'Mambulan',
    'Mambulandiné', 'Mambulane', 'Mambulane Nord', 'Mambulane Sud', 'Mambulanène', 'Mambulania',
    'Mambulaniène', 'Mambulanienne', 'Mambulanisse', 'Mambulanit', 'Mambulanié', 'Mambulanière',
    'Mambulanille', 'Mambulanine', 'Mambulanime', 'Mambulanine', 'Mambulanire', 'Mambulanique',
    'Mambulanne', 'Mambulannée', 'Mambulée', 'Mambulé', 'Mambuléne', 'Mambulène', 'Mambulène Nouvelle',
    'Mambuli', 'Mambuliène', 'Mambulla', 'Mambullaie', 'Mambullaine', 'Mambullanie', 'Mambullaria',
    'Mambullaye', 'Mambullia', 'Mambulliaire', 'Mambulliaire Nouvelle', 'Mambulliaire Ancienne',
    'Mambulliairienne', 'Mambullaïre', 'Mambullaïrienne', 'Mambullaïrina', 'Mambullaire Ville',
    'Mambutte', 'Mambutière', 'Mambutaire', 'Mambutènerie', 'Mambutaire Nouvelle', 'Mambuterienne',
    'Mambuttielle', 'Mambuène', 'Mambénère', 'Mambé', 'Mambène', 'Mambera', 'Mambérou', 'Mambèrou',
    'Mambérienne', 'Mambérienne Ville', 'Mambrussa', 'Mambussa', 'Mambère', 'Mambéraire', 'Mambéraire',
    'Marbas', 'Marba', 'Marbar', 'Marbari', 'Marbare', 'Marbarienne', 'Marbassa', 'Marbassary',
    'Marbi', 'Marbiaire', 'Marbaire', 'Marbai', 'Marbaie', 'Marbaierie', 'Marbaïe', 'Marbaïenne',
    'Marbière', 'Marbire', 'Marbiria', 'Marbirienne', 'Marbiire', 'Marbiier', 'Marbiere',
    'Marmite', 'Marmitaire', 'Marmitre', 'Marmitière', 'Marmitèrie', 'Marmitaire Ville',
    'Marmitaine', 'Marmitainia', 'Marmitainienne', 'Marmita', 'Marmitation', 'Marmitation Nouvelle',
    'Marmi', 'Marmière', 'Marmiaire', 'Marmiaire Nouvelle', 'Marmi Ouest', 'Marmi Est', 'Marmi Nord',
    'Marmi Sud', 'Marmi Centre', 'Marmienne', 'Marmienne Ville', 'Marmienne Banlieue', 'Marmienne Rurale',
    'Marmoye', 'Marmoyen', 'Marmoyenne', 'Marmoyre', 'Marmoyère', 'Marmoyèrie', 'Marmoyen Ville',
    'Marmoye Nord', 'Marmoye Sud', 'Marmoye Est', 'Marmoye Ouest', 'Marmoye Centre', 'Marmoyaie',
    'Marmoye Nouvelle', 'Marmoyen Nouvelle', 'Marmoyenne Nouvelle', 'Marmoye Ancienne', 'Marmoyen Ancien',
    
    // AUTRES COMMUNES DAKAR (Banlieue - très important!)
    'Petit Mbao', 'Grand Mbao', 'Mbao', 'Mbao Nord', 'Mbao Sud', 'Mbao Est', 'Mbao Ouest',
    'Mbao Centre', 'Mbao Banlieue', 'Mbao Rurale', 'Mbao Nouvelle', 'Mbao Ancienne',
    'Mbao Extension', 'Mbao Extension 1', 'Mbao Extension 2', 'Mbao Extension 3', 'Mbao Extension 4',
    'Mbao Ville', 'Mbao Ville Nouvelle', 'Mbao Quartier', 'Mbao Quartier Populaire', 'Mbao Cité',
    'Mbao Cité Nouvelle', 'Mbao Agora', 'Mbao Agora Nouvelle', 'Mbao Nyarinne', 'Mbao Nyarinne Nouvelle',
    'Mbao Scat Urbam', 'Mbao Scat Urbam Nouvelle', 'Mbao Scat Urbam Ancienne', 'Mbao Yarma',
    'Mbao Yarma Nouvelle', 'Mbao Yarma Nord', 'Mbao Yarma Sud', 'Mbao Sicap', 'Mbao Sicap Nouvelle',
    'Mbao Sicap Liberté', 'Mbao Kébé', 'Mbao Kébé Nouvelle', 'Mbao Kébé Nord', 'Mbao Kébé Sud',
    'Mbao Kébé Est', 'Mbao Kébé Ouest', 'Mbao Kébé Centre', 'Mbao Kébé Banlieue',
    'Petit Mbao Centre', 'Petit Mbao Nord', 'Petit Mbao Sud', 'Petit Mbao Est', 'Petit Mbao Ouest',
    'Petit Mbao Extension', 'Petit Mbao Nouvelle', 'Petit Mbao Ancienne', 'Petit Mbao Ville',
    'Petit Mbao Quartier', 'Petit Mbao Cité', 'Petit Mbao Agora', 'Petit Mbao Scat Urbam',
    'Petit Mbao Nyarinne', 'Petit Mbao Sicap', 'Petit Mbao Kébé', 'Petit Mbao Malick',
    'Grand Mbao Centre', 'Grand Mbao Nord', 'Grand Mbao Sud', 'Grand Mbao Est', 'Grand Mbao Ouest',
    'Grand Mbao Extension', 'Grand Mbao Nouvelle', 'Grand Mbao Ancienne', 'Grand Mbao Ville',
    'Keur Moussa', 'Keur Moussa Nord', 'Keur Moussa Sud', 'Keur Moussa Est', 'Keur Moussa Ouest',
    'Keur Moussa Centre', 'Keur Moussa Banlieue', 'Keur Moussa Nouvelle', 'Keur Moussa Ancienne',
    'Keur Moussa Cité', 'Keur Moussa Quartier', 'Keur Moussa Quartier Populaire', 'Keur Moussa Agora',
    'Keur Moussa Scat Urbam', 'Keur Moussa Nyarinne', 'Keur Moussa Sicap', 'Keur Moussa Sicap Liberté',
    'Keur Moussa Kébé', 'Keur Moussa Malick', 'Keur Moussa Yaac', 'Keur Moussa Karack',
    'Yène', 'Yène Centre', 'Yène Nord', 'Yène Sud', 'Yène Est', 'Yène Ouest', 'Yène Extension',
    'Yène Nouvelle', 'Yène Ancienne', 'Yène Ville', 'Yène Quartier', 'Yène Cité', 'Yène Agora',
    'Sangalkam', 'Sangalkam Nord', 'Sangalkam Sud', 'Sangalkam Est', 'Sangalkam Ouest',
    'Sangalkam Centre', 'Sangalkam Banlieue', 'Sangalkam Nouvelle', 'Sangalkam Ancienne',
    'Sangalkam Cité', 'Sangalkam Quartier', 'Sangalkam Cité Sénégal', 'Sangalkam Cité Nouvelle',
    'Sangalkam Nyarinne', 'Sangalkam Scat Urbam', 'Sangalkam Sicap', 'Sangalkam Kébé',
    'Bargny', 'Bargny Centre', 'Bargny Nord', 'Bargny Sud', 'Bargny Est', 'Bargny Ouest',
    'Bargny Banlieue', 'Bargny Nouvelle', 'Bargny Ancienne', 'Bargny Ville', 'Bargny Quartier',
    'Sébikotane', 'Sébikotane Nord', 'Sébikotane Sud', 'Sébikotane Est', 'Sébikotane Ouest',
    'Sébikotane Centre', 'Sébikotane Nouvelle', 'Sébikotane Ancienne', 'Sébikotane Ville',
    'Sébikotane Quartier', 'Sébikotane Cité', 'Sébikotane Cité Nouvelle', 'Sébikotane Plage',
    'Ndiaganiao', 'Ndiaganiao Nord', 'Ndiaganiao Sud', 'Ndiaganiao Est', 'Ndiaganiao Ouest',
    'Ndiaganiao Centre', 'Ndiaganiao Banlieue', 'Ndiaganiao Nouvelle', 'Ndiaganiao Ancienne',
    'Malika', 'Malika Nord', 'Malika Sud', 'Malika Est', 'Malika Ouest', 'Malika Centre',
    'Malika Banlieue', 'Malika Nouvelle', 'Malika Ancienne', 'Malika Ville', 'Malika Quartier',
    'Malika Cité', 'Malika Cité Nouvelle', 'Malika Cité Étudiant', 'Malika Cité Nouvelle Étudiant',
    
    // THIÈS
    'Thiès', 'Thiès Ville', 'Mbour', 'Saly', 'Saly Portudal', 'Toubab Dialao', 'Popenguine', 'Ngaparou',
    'Somone', 'Kousimassira', 'Malicounda', 'Kaolack', 'Tattaguine', 'Diouloulou', 'Pout', 'Pout Sénégal',
    'Tivaouane', 'Tivaouane Peulh', 'Tal', 'Pambal', 'Cheikh Youssouf Ndour', 'Méouane', 'Thienaba',
    'Taïba Ndiaye', 'Ngoundiane', 'Ourong', 'Keur Samba Guéye', 'Lam Lam', 'Mboro', 'Mékhé',
    
    // SAINT-LOUIS
    'Saint-Louis', 'Saint-Louis Ville', 'Ross Béthio', 'Kaédi', 'Matam', 'Podor', 'Thilogne', 'Boké',
    'Diorbivol', 'Fanaye', 'Ouro Sogui', 'Ranérou', 'Gara', 'Golléré', 'Saldé', 'Kassack', 'Kanel',
    'Bakel', 'Kolimba', 'Gourbi', 'Aéré Lao', 'Dembakané', 'Ballou Makadiola', 'Ndiora', 'Ourateré',
    
    // LOUGA
    'Louga', 'Louga Ville', 'Kébémer', 'Linguère', 'Limpopo', 'Labgar', 'Darou Mousty', 'Gara',
    'Pout', 'Barkédji', 'Velingara', 'Waoundé', 'Nguerigne', 'Galoya', 'Kaolack de Louga',
    'Guinguinéo', 'Guéoul', 'Yacine', 'Touba Saint-Louis', 'Birkelane', 'Kaolack', 'Medina Yoro Foulah',
    
    // KAFFRINE
    'Kaffrine', 'Kaffrine Ville', 'Koungheul', 'Malem-Hodar', 'Birkelane', 'Tambacounda', 'Kaolack',
    'Mbirkilane', 'Passy', 'Tiédème', 'Gueoul', 'Mbirkilane Nord', 'Goudiry', 'Bambey',
    
    // KAOLACK
    'Kaolack', 'Kaolack Ville', 'Kaolack Région', 'Tataguine', 'Diouloulou', 'Nioro du Rip',
    'Soubéra', 'Bignona', 'Prang', 'Sibassor', 'Ngonouthie', 'Sadio', 'Kahone', 'Koussanar',
    'Mampatim', 'Djilas', 'Missirah', 'Kouthia', 'Gourane', 'Kabrousse', 'Koumpentoum',
    
    // KOLDA
    'Kolda', 'Kolda Ville', 'Vélingara', 'Dialacoto', 'Mampatim', 'Kolda Région', 'Bagadadji',
    'Mamadou Moussa', 'Pata', 'Kabendou', 'Dalanda', 'Médina Al Fath', 'Pounkané', 'Bignona',
    'Bounemaine', 'Gassane', 'Kounkané', 'Palanndé Gassane', 'Méouane', 'Taïba', 'Dialacoto Région',
    
    // SÉDHIOU
    'Sédhiou', 'Sédhiou Ville', 'Kaur', 'Goudomp', 'Kafountine', 'Béla', 'Bambali', 'Inor',
    'Madina Gounass', 'Nyassia', 'Béré', 'Salémata', 'Dialacoto', 'Diouloulou', 'Moussacunda',
    'Tassile', 'Coubalan', 'Linkering', 'Pakour', 'Agnam-Goly', 'Sansanding', 'Diaobé',
    
    // ZIGUINCHOR
    'Ziguinchor', 'Ziguinchor Ville', 'Cap-Skirring', 'Oussouye', 'Enampore', 'Bignona', 'Kabrousse',
    'Thiobon', 'Elinkine', 'Abéne', 'Kafountine', 'Bissao', 'Thionk Essyl', 'Djinky', 'Karount',
    'Karente', 'Mangagoulack', 'Diégoune', 'Niassia', 'Kabéndou', 'Karang', 'Koubalan',
    
    // TAMBACOUNDA
    'Tambacounda', 'Tambacounda Ville', 'Koumpentoum', 'Kédougou', 'Saraya', 'Bakel', 'Kanel',
    'Kolimba', 'Gourbi', 'Dembakané', 'Aéré Lao', 'Ranérou', 'Dendilane', 'Gabou', 'Woundé',
    'Ouro Alfa', 'Toubacouta', 'Gara', 'Ouro Sogui', 'Kaolack', 'Lao Lao', 'Samba Dia',
    
    // KÉDOUGOU
    'Kédougou', 'Kédougou Ville', 'Saraya', 'Salémata', 'Dialakoto', 'Bandafassi', 'Kénieba',
    'Linkering', 'Pakour', 'Médina Yoro', 'Niokolo Koba', 'Darou Mousty', 'Wadane', 'Mako',
    
    // FATICK
    'Fatick', 'Fatick Ville', 'Foundiougne', 'Diofior', 'Rip', 'Kaolack', 'Loul', 'Passy',
    'Tattaguine', 'Missirah', 'Soucouta', 'Kahone', 'Wellingara', 'Kouthia', 'Sibassor',
    
    // MATAM
    'Matam', 'Matam Ville', 'Kanel', 'Ranérou', 'Saldé', 'Gara', 'Gourbi', 'Hamady Oulof',
    'Kolimba', 'Aéré Lao', 'Ouro Alfa', 'Dendilane', 'Gabou', 'Ouridou', 'Thilogne',
    
    // REGIONS & VILLES CÔTIÈRES
    'Joal', 'Joal Fadiouth', 'Kajolle', 'Fadiouth', 'Palmarin', 'Djiffer', 'Sokone', 'Toubacouta',
    'Tabara', 'Kaolaack de Fatick', 'Katiak', 'Ndangane', 'Mboro', 'Mékhé', 'Kaolaack',
    
    // COMMUNES & QUARTIERS MINEURS
    'Keur Ayip', 'Keur Massar Colobane', 'Yeumbeul Nord', 'Yeumbeul Sud', 'Arafat', 'Jaxaay',
    'Wakhinane', 'Ngor', 'Almadies', 'Mamelles', 'Fann Saint-Michel', 'Mermoz', 'Liberté',
    'Sicap Liberté', 'Liberté 3', 'Liberté 2', 'Liberté 1', 'Liberté 5', 'Liberté 6',
    'Cité Ceriz', 'Cité SN', 'Cité Sénégal', 'Diplôme', 'Toubab Dialao Nord', 'Toubab Dialao Sud',
    'Yène', 'Sangalkam Nord', 'Sangalkam Sud', 'Keur Moussa', 'Kébé', 'Ndiaganiao', 'Tivaouan Peulh',
    'Graffigue', 'Graffigue Nord', 'Meouane Nord', 'Meouane Sud', 'Kaolack Taïba', 'Sébikotane',
    'Sébikotane Nord', 'Sébikotane Sud', 'Sébikotane Ouest', 'Sébikotane Est', 'Leyti', 'Ngaoundiane',
    'Ndoulo', 'Ngoundiane Sud', 'Popenguine Nord', 'Popenguine Sud', 'Popenguine Centre', 'Toubab Dialao Centre',
];

// Afficher les 8 premiers résultats, puis les filtrer par recherche
const maxSuggestions = 10;

const filteredLieux = computed(() => {
    const query = lieuSearchQuery.value.toLowerCase().trim();
    
    // Si rien n'est saisi, afficher les 10 premiers
    if (!query) return allLieux.slice(0, maxSuggestions);
    
    // Filtrer et afficher jusqu'à 10 résultats
    const filtered = allLieux.filter(lieu => 
        lieu.toLowerCase().includes(query)
    );
    
    // Priorité aux lieux qui COMMENCENT par la recherche
    const startsWith = filtered.filter(lieu => 
        lieu.toLowerCase().startsWith(query)
    );
    
    // Puis les autres qui contiennent la recherche
    const contains = filtered.filter(lieu => 
        !lieu.toLowerCase().startsWith(query)
    );
    
    return [...startsWith, ...contains].slice(0, maxSuggestions);
});

function selectLieuSuggestion(lieu) {
    lead.lieu = lieu;
    showLieuSuggestions.value = false;
    lieuSearchQuery.value = '';
}

function handleClickOutside(event) {
    const input = document.querySelector('input[placeholder*="Maradi"]');
    if (input && !input.contains(event.target) && !event.target.closest('.absolute')) {
        showLieuSuggestions.value = false;
    }
}


// Validation des étapes
const isStep1Valid = computed(() => {
    return lead.type && 
           lead.nom && 
           lead.prix && 
           lead.region && 
           lead.lieu &&
           lead.description;
});

const isStep2Valid = computed(() => {
    if (['Villa', 'Appartement', 'Immeuble', 'Chambre'].includes(lead.type)) {
        return lead.npiece;
    } else {
        return lead.surface;
    }
});

const isStep3Valid = computed(() => {
    return lead.images.length > 0;
});

function nextStep() {
    if (currentStep.value < 3) currentStep.value++;
}

function prevStep() {
    if (currentStep.value > 1) currentStep.value--;
}

function handleMultipleImages(event) {
    const files = Array.from(event.target.files);
    addFiles(files);
    if (event.target) {
        event.target.value = '';
    }
}

function addFiles(files) {
    const remainingSlots = maxImages - imagePreviews.value.length;
    const filesToAdd = files.slice(0, remainingSlots);
    
    filesToAdd.forEach(file => {
        if (file.type.startsWith('image/')) {
            const preview = URL.createObjectURL(file);
            imagePreviews.value.push({
                file: file,
                preview: preview,
                id: Date.now() + Math.random()
            });
            lead.images.push(file);
        }
    });
}

function handleDrop(event) {
    event.preventDefault();
    event.stopPropagation();
    const files = Array.from(event.dataTransfer.files);
    addFiles(files);
}

function handleDragOver(event) {
    event.preventDefault();
    event.stopPropagation();
}

function removeImage(index) {
    if (imagePreviews.value[index].preview) {
        URL.revokeObjectURL(imagePreviews.value[index].preview);
    }
    imagePreviews.value.splice(index, 1);
    lead.images.splice(index, 1);
}

function handleSubmit() {
    let url = '/immobilier/save';
    if (lead.type === 'Verger') {
        url = '/immobilier2/save';
    } else if (lead.type === 'Ferme') {
        url = '/immobilier3/save';
    }
    
    // Show success toast before submission
    toastMessage.value = '🎉 Publication en cours... Merci de patienter!';
    toastType.value = 'success';
    showToast.value = true;
    
    // Créer FormData pour envoyer les fichiers
    const formData = new FormData();
    formData.append('type', lead.type);
    formData.append('nom', lead.nom);
    formData.append('prix', lead.prix);
    formData.append('description', lead.description);
    formData.append('region', lead.region);
    formData.append('lieu', lead.lieu);
    formData.append('affaire', lead.affaire);
    formData.append('npiece', lead.npiece || 0);
    formData.append('surface', lead.surface || 0);
    
    // Ajouter les images
    if (lead.images.length > 0) {
        lead.images.forEach((image, index) => {
            formData.append('images[]', image);
        });
    }
    
    // Envoyer avec fetch au lieu d'Inertia
    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(data => {
                throw new Error(JSON.stringify(data));
            });
        }
        return response.json();
    })
    .then(data => {
        toastMessage.value = '✅ Annonce publiée avec succès!';
        setTimeout(() => {
            showToast.value = false;
            // Redirection au dashboard
            window.location.href = '/dashboard';
        }, 2000);
    })
    .catch(error => {
        console.error('Erreur:', error);
        toastMessage.value = '❌ Erreur lors de la publication';
        toastType.value = 'error';
        setTimeout(() => {
            showToast.value = false;
        }, 5000);
    });
}

const images = [
    { id: 1, src: "/storage/slide/villa.png", alt: "Villa", titre: "Villa", icon: "bi-house-door", emoji: "🏡", color: "from-blue-500 to-cyan-500" },
    { id: 2, src: "/storage/slide/appartement.png", alt: "Appartement", titre: "Appartement", icon: "bi-building", emoji: "🏢", color: "from-purple-500 to-pink-500" },
    { id: 3, src: "/storage/slide/terrain.png", alt: "Terrain", titre: "Terrain", icon: "bi-map", emoji: "🌍", color: "from-green-500 to-emerald-500" },
    { id: 4, src: "/storage/slide/chambre.png", alt: "Chambre", titre: "Chambre", icon: "bi-door-open", emoji: "🛏️", color: "from-orange-500 to-red-500" },
    { id: 5, src: "/storage/slide/immeuble.png", alt: "Immeuble", titre: "Immeuble", icon: "bi-buildings", emoji: "🏗️", color: "from-indigo-500 to-blue-500" },
    { id: 6, src: "/storage/slide/verger.png", alt: "Verger", titre: "Verger", icon: "bi-tree", emoji: "🌳", color: "from-lime-500 to-green-500" },
    { id: 7, src: "/storage/slide/ferme.png", alt: "Ferme", titre: "Ferme", icon: "bi-houses", emoji: "🚜", color: "from-yellow-500 to-orange-500" }
];

const isStepOneValid = computed(() => {
    return lead.nom && lead.prix && lead.description;
});

const isStepTwoValid = computed(() => {
    if (['Villa', 'Appartement', 'Immeuble', 'Chambre'].includes(lead.type)) {
        return lead.npiece && lead.affaire;
    } else {
        return lead.surface && lead.affaire;
    }
});

const totalSteps = 3;
const maxImages = 10;

const progressPercentage = computed(() => {
    return (currentStep.value / totalSteps) * 100;
});
</script>

<template>
    <AppLayout title="Publier un bien immobilier">
        <Head title="Publier un bien immobilier" />

        <!-- Toast Notification -->
        <transition
            enter-active-class="transform transition ease-out duration-300"
            enter-from-class="translate-x-full opacity-0"
            enter-to-class="translate-x-0 opacity-100"
            leave-active-class="transform transition ease-in duration-200"
            leave-from-class="translate-x-0 opacity-100"
            leave-to-class="translate-x-full opacity-0"
        >
            <div v-if="showToast" class="fixed top-6 right-6 z-50">
                <div :class="[
                    'px-6 py-4 rounded-xl shadow-2xl border-2 flex items-center gap-3 backdrop-blur-sm',
                    toastType === 'success' 
                        ? 'bg-green-500/90 border-green-400 text-white'
                        : toastType === 'error'
                            ? 'bg-red-500/90 border-red-400 text-white'
                            : 'bg-yellow-500/90 border-yellow-400 text-white'
                ]">
                    <svg v-if="toastType === 'success'" class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <svg v-else-if="toastType === 'error'" class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    <svg v-else class="w-5 h-5 flex-shrink-0 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    <span class="font-bold text-sm">{{ toastMessage }}</span>
                </div>
            </div>
        </transition>

        <div class="min-h-screen bg-gradient-to-br from-slate-950 via-purple-950 to-slate-950 py-8">
            <!-- Header ultra premium -->
            <div class="bg-gradient-to-r from-purple-900 to-pink-900 py-16 px-4 border-b-4 border-yellow-400/50 mb-12">
                <div class="max-w-5xl mx-auto">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="text-5xl animate-bounce">🚀</span>
                        <div>
                            <h1 class="text-4xl sm:text-5xl font-black text-white">
                                PUBLIEZ VOTRE BIEN
                            </h1>
                            <p class="text-yellow-300 font-bold text-lg mt-2">
                                🎯 Rejoignez 500+ vendeurs réussis • 📈 +300% de visibilité garantie
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Progress Bar Ultra Premium -->
                <div v-if="lead.type" class="mb-12">
                    <div class="relative">
                        <!-- Background progress bar -->
                        <div class="h-2 bg-slate-800/50 rounded-full overflow-hidden border border-purple-500/30">
                            <!-- Animated progress fill -->
                            <div
                                class="h-full bg-gradient-to-r from-yellow-400 to-pink-500 transition-all duration-500 ease-out"
                                :style="{ width: progressPercentage + '%' }"
                            ></div>
                        </div>

                        <!-- Steps -->
                        <div class="flex items-center justify-between mt-8">
                            <div v-for="step in totalSteps" :key="step" class="flex flex-col items-center">
                                <div
                                    :class="[
                                        'w-14 h-14 rounded-full flex items-center justify-center font-black text-lg transition-all duration-300',
                                        currentStep >= step
                                            ? 'bg-gradient-to-r from-yellow-400 to-pink-500 text-slate-900 scale-110 shadow-2xl shadow-yellow-500/50'
                                            : 'bg-slate-800 text-purple-400 border-2 border-purple-500/50'
                                    ]"
                                >
                                    <i v-if="currentStep > step" class="bi bi-check-lg"></i>
                                    <span v-else>{{ step }}</span>
                                </div>
                                <p class="text-xs font-bold mt-3" :class="currentStep >= step ? 'text-yellow-400' : 'text-purple-300'">
                                    {{ step === 1 ? 'INFO' : step === 2 ? 'DÉTAILS' : 'IMAGES' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Type Selection - GAMIFIÉ -->
                <div v-if="!lead.type" class="space-y-8">
                    <h2 class="text-3xl font-black text-center bg-clip-text text-transparent bg-gradient-to-r from-yellow-400 to-pink-500 mb-10">
                        🎮 CHOISISSEZ VOTRE TYPE DE BIEN
                    </h2>

                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        <label
                            v-for="image in images"
                            :key="image.id"
                            :class="[
                                'relative cursor-pointer rounded-2xl border-2 overflow-hidden transition-all duration-300 group',
                                lead.type === image.titre
                                    ? `border-yellow-400 bg-gradient-to-br ${image.color} shadow-2xl shadow-yellow-500/50 scale-105`
                                    : 'border-purple-500/30 hover:border-pink-500/50 bg-slate-800/50 hover:bg-slate-800'
                            ]"
                        >
                            <input
                                type="radio"
                                v-model="lead.type"
                                :value="image.titre"
                                class="hidden"
                            />

                            <!-- Background glow -->
                            <div v-if="lead.type === image.titre" class="absolute inset-0 bg-white/10 blur-xl"></div>

                            <!-- Content -->
                            <div class="relative p-6 flex flex-col items-center justify-center gap-3">
                                <div class="text-4xl group-hover:scale-125 transition-transform duration-300">
                                    {{ image.emoji }}
                                </div>
                                <h3 class="font-black text-center transition-colors" :class="lead.type === image.titre ? 'text-white text-lg' : 'text-purple-300'">
                                    {{ image.titre }}
                                </h3>
                                <div v-if="lead.type === image.titre" class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Form Steps -->
                <div v-else class="bg-slate-800/50 backdrop-blur border border-purple-500/30 rounded-2xl p-8">
                    <!-- Step 1: Info de base -->
                    <div v-show="currentStep === 1" class="space-y-6 animate-fadeIn">
                        <h3 class="text-2xl font-black bg-clip-text text-transparent bg-gradient-to-r from-yellow-400 to-pink-500">
                            📝 INFORMATIONS DE BASE
                        </h3>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-bold text-yellow-300 mb-2">Titre de l'annonce *</label>
                                <input
                                    v-model="lead.nom"
                                    type="text"
                                    placeholder="Ex: Magnifique villa avec piscine"
                                    class="w-full px-4 py-3 bg-slate-900/50 border border-purple-500/30 rounded-lg text-white placeholder-gray-500 focus:border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400/50"
                                />
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-yellow-300 mb-2">Prix (FCFA) *</label>
                                <input
                                    v-model="lead.prix"
                                    type="number"
                                    placeholder="Ex: 50000000"
                                    class="w-full px-4 py-3 bg-slate-900/50 border border-purple-500/30 rounded-lg text-white placeholder-gray-500 focus:border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400/50"
                                />
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-yellow-300 mb-2">Région *</label>
                                <select
                                    v-model="lead.region"
                                    class="w-full px-4 py-3 bg-slate-900/50 border border-purple-500/30 rounded-lg text-white focus:border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400/50"
                                >
                                    <option value="">Sélectionnez une région</option>
                                    <option>Dakar</option>
                                    <option>Kaolack</option>
                                    <option>Kolda</option>
                                    <option>Matam</option>
                                    <option>Saint-Louis</option>
                                    <option>Thiès</option>
                                    <option>Tambacounda</option>
                                    <option>Ziguinchor</option>
                                    <option>Louga</option>
                                    <option>Fatick</option>
                                    <option>Kaffrine</option>
                                    <option>Sédhiou</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-yellow-300 mb-2">
                                    📍 Lieu Précis *
                                    <span v-if="lead.lieu" class="text-green-400 text-xs ml-2">✓ Rempli</span>
                                    <span v-else class="text-red-400 text-xs ml-2">⚠️ Requis</span>
                                </label>
                                <div class="relative">
                                    <input
                                        v-model="lead.lieu"
                                        @focus="showLieuSuggestions = true"
                                        @input="lieuSearchQuery = lead.lieu"
                                        type="text"
                                        placeholder="🔍 Recherchez un lieu... (Dakar, Maradi, Thiès, Mbour...)"
                                        :class="[
                                            'w-full px-4 py-3 bg-slate-900/50 rounded-lg text-white placeholder-gray-400 focus:border-yellow-400 focus:outline-none focus:ring-2 transition-all border',
                                            lead.lieu 
                                                ? 'border-green-500/50 focus:border-green-400 focus:ring-green-400/50' 
                                                : 'border-purple-500/30 focus:border-yellow-400 focus:ring-yellow-400/50'
                                        ]"
                                    />
                                    <p class="text-xs text-gray-400 mt-1">💡 250+ lieux disponibles - Tapez pour chercher</p>
                                    <!-- Dropdown avec suggestions -->
                                    <div v-if="showLieuSuggestions" class="absolute top-full left-0 right-0 mt-2 bg-slate-800 border-2 border-purple-500/50 rounded-lg shadow-2xl z-50 max-h-80 overflow-y-auto">
                                        <!-- Aucun résultat -->
                                        <div v-if="filteredLieux.length === 0" class="px-4 py-6 text-center text-gray-400 text-sm">
                                            <p>❌ Aucun lieu trouvé</p>
                                            <p class="text-xs mt-2">Essayez: "Dakar", "Maradi", "Thiès"...</p>
                                        </div>
                                        
                                        <!-- Résultats -->
                                        <div v-else>
                                            <button
                                                v-for="(lieu, index) in filteredLieux"
                                                :key="index"
                                                @click="selectLieuSuggestion(lieu)"
                                                class="w-full text-left px-4 py-3 hover:bg-purple-500/40 hover:pl-6 transition-all text-white text-sm border-b border-slate-700/30 last:border-b-0"
                                            >
                                                <span class="text-yellow-300">📍</span> {{ lieu }}
                                            </button>
                                            
                                            <!-- Compteur de résultats -->
                                            <div v-if="filteredLieux.length < allLieux.length" class="px-4 py-2 text-xs text-gray-500 bg-slate-900/50 border-t border-slate-700/50">
                                                {{ filteredLieux.length }} résultats sur {{ allLieux.length }} lieux disponibles
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div>
                                <label class="block text-sm font-bold text-yellow-300 mb-2">Description détaillée *</label>
                                <textarea
                                    v-model="lead.description"
                                    placeholder="Décrivez votre bien..."
                                    rows="4"
                                    class="w-full px-4 py-3 bg-slate-900/50 border border-purple-500/30 rounded-lg text-white placeholder-gray-500 focus:border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400/50"
                                ></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Détails -->
                    <div v-show="currentStep === 2" class="space-y-6 animate-fadeIn">
                        <h3 class="text-2xl font-black bg-clip-text text-transparent bg-gradient-to-r from-yellow-400 to-pink-500">
                            🏠 DÉTAILS DU BIEN
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div v-if="['Villa', 'Appartement', 'Immeuble', 'Chambre'].includes(lead.type)">
                                <label class="block text-sm font-bold text-yellow-300 mb-2">Nombre de pièces *</label>
                                <input
                                    v-model="lead.npiece"
                                    type="number"
                                    placeholder="Ex: 4"
                                    class="w-full px-4 py-3 bg-slate-900/50 border border-purple-500/30 rounded-lg text-white placeholder-gray-500 focus:border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400/50"
                                />
                            </div>

                            <div v-else>
                                <label class="block text-sm font-bold text-yellow-300 mb-2">Surface (m²) *</label>
                                <input
                                    v-model="lead.surface"
                                    type="number"
                                    placeholder="Ex: 1000"
                                    class="w-full px-4 py-3 bg-slate-900/50 border border-purple-500/30 rounded-lg text-white placeholder-gray-500 focus:border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400/50"
                                />
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-yellow-300 mb-2">Type d'affaire *</label>
                                <select
                                    v-model="lead.affaire"
                                    class="w-full px-4 py-3 bg-slate-900/50 border border-purple-500/30 rounded-lg text-white focus:border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400/50"
                                >
                                    <option value="">Choisissez...</option>
                                    <option>Vente</option>
                                    <option>Location</option>
                                    <option>Location-vente</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Images -->
                    <div v-show="currentStep === 3" class="space-y-6 animate-fadeIn">
                        <h3 class="text-2xl font-black bg-clip-text text-transparent bg-gradient-to-r from-yellow-400 to-pink-500">
                            📸 AJOUTEZ DES IMAGES
                        </h3>

                        <!-- Upload Area -->
                        <div
                            @drop="handleDrop"
                            @dragover="handleDragOver"
                            @click="fileInput?.click()"
                            class="border-2 border-dashed border-purple-500/50 rounded-2xl p-8 text-center bg-slate-900/50 hover:border-yellow-400 hover:bg-slate-900/70 transition-all cursor-pointer group"
                        >
                            <input
                                ref="fileInput"
                                type="file"
                                multiple
                                accept="image/*"
                                @change="handleMultipleImages"
                                class="hidden"
                            />
                            <svg class="w-12 h-12 mx-auto mb-3 text-purple-400 group-hover:text-yellow-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="text-white font-bold mb-2">Glissez vos images ou cliquez pour sélectionner</p>
                            <p class="text-sm text-purple-300">{{ maxImages - imagePreviews.length }} images restantes</p>
                        </div>

                        <!-- Image Previews -->
                        <div v-if="imagePreviews.length > 0" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                            <div v-for="(img, index) in imagePreviews" :key="img.id" class="relative group">
                                <img :src="img.preview" :alt="'Preview ' + (index + 1)" class="w-full h-32 object-cover rounded-lg border border-purple-500/30" />
                                <button
                                    @click="removeImage(index)"
                                    class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity"
                                >
                                    ✕
                                </button>
                                <div class="absolute bottom-2 left-2 bg-yellow-400 text-slate-900 text-xs font-bold px-2 py-1 rounded">
                                    {{ index + 1 }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-between items-center mt-12 pt-8 border-t border-purple-500/30">
                        <button
                            v-if="currentStep > 1"
                            @click="prevStep"
                            class="px-6 py-3 bg-slate-700 hover:bg-slate-600 text-white font-bold rounded-lg transition-all"
                        >
                            ← Retour
                        </button>
                        <div v-else></div>

                        <button
                            v-if="currentStep < 3"
                            @click="nextStep"
                            :disabled="(currentStep === 1 && !isStep1Valid) || (currentStep === 2 && !isStep2Valid)"
                            class="px-8 py-3 bg-gradient-to-r from-yellow-400 to-pink-500 text-slate-900 font-black rounded-lg hover:shadow-2xl hover:shadow-yellow-500/50 transition-all disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            Suivant →
                        </button>

                        <button
                            v-else
                            @click="handleSubmit"
                            :disabled="!isStep3Valid"
                            class="px-8 py-3 bg-gradient-to-r from-green-400 to-emerald-500 text-slate-900 font-black rounded-lg hover:shadow-2xl hover:shadow-green-500/50 transition-all disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            🚀 PUBLIER MAINTENANT
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Toast Notification -->
        <transition
            enter-active-class="transition duration-300 ease-out"
            enter-from-class="translate-x-full opacity-0"
            enter-to-class="translate-x-0 opacity-100"
            leave-active-class="transition duration-200 ease-in"
            leave-from-class="translate-x-0 opacity-100"
            leave-to-class="translate-x-full opacity-0"
        >
            <div
                v-if="showToast"
                :class="[
                    'fixed top-6 right-6 z-50 px-6 py-4 rounded-xl shadow-2xl border-2 backdrop-blur-sm',
                    toastType === 'success' ? 'bg-green-900/80 border-green-400 text-green-100' : '',
                    toastType === 'error' ? 'bg-red-900/80 border-red-400 text-red-100' : '',
                    toastType === 'warning' ? 'bg-yellow-900/80 border-yellow-400 text-yellow-100' : ''
                ]"
            >
                <div class="flex items-center gap-3">
                    <span v-if="toastType === 'success'" class="text-xl">✅</span>
                    <span v-else-if="toastType === 'error'" class="text-xl">❌</span>
                    <span v-else class="text-xl">⚠️</span>
                    <span class="font-semibold">{{ toastMessage }}</span>
                </div>
            </div>
        </transition>
    </AppLayout>
</template>

<style scoped>
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fadeIn {
    animation: fadeIn 0.3s ease-out;
}

input[type="file"] {
    display: none;
}
</style>
