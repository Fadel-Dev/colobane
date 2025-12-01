<script setup>
import { ref, onMounted, nextTick } from 'vue';
import { router } from '@inertiajs/vue3';

const isOpen = ref(false);
const messages = ref([]);
const inputMessage = ref('');
const isLoading = ref(false);
const userPreferences = ref({
    type: null,
    region: null,
    prixMax: null,
    prixMin: null,
    surface: null,
    pieces: null
});

// Messages d'accueil
const welcomeMessages = [
    "Bonjour ! 👋 Je suis votre assistant virtuel NoflayHub.",
    "Je peux vous aider à trouver le bien immobilier idéal selon vos besoins.",
    "Dites-moi ce que vous recherchez : type de bien, région, budget, etc."
];

onMounted(() => {
    // Ajouter les messages d'accueil
    welcomeMessages.forEach((msg, index) => {
        setTimeout(() => {
            messages.value.push({
                id: Date.now() + index,
                type: 'bot',
                content: msg,
                timestamp: new Date()
            });
        }, index * 1000);
    });
});

const toggleChat = () => {
    isOpen.value = !isOpen.value;
    if (isOpen.value) {
        scrollToBottom();
    }
};

const sendMessage = async () => {
    if (!inputMessage.value.trim() || isLoading.value) return;

    const userMessage = inputMessage.value.trim();
    inputMessage.value = '';
    
    // Ajouter le message de l'utilisateur
    messages.value.push({
        id: Date.now(),
        type: 'user',
        content: userMessage,
        timestamp: new Date()
    });

    scrollToBottom();
    isLoading.value = true;

    try {
        // Envoyer le message au backend
        const response = await fetch('/api/chatbot/message', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                message: userMessage,
                preferences: userPreferences.value,
                conversation_history: messages.value.slice(-10).map(m => ({
                    type: m.type,
                    content: m.content
                }))
            })
        });

        const data = await response.json();

        if (data.success) {
            // Ajouter la réponse du bot
            messages.value.push({
                id: Date.now() + 1,
                type: 'bot',
                content: data.message,
                timestamp: new Date()
            });

            // Mettre à jour les préférences si fournies
            if (data.preferences) {
                Object.assign(userPreferences.value, data.preferences);
            }

            // Afficher les suggestions de biens si disponibles
            if (data.suggestions && data.suggestions.length > 0) {
                setTimeout(() => {
                    messages.value.push({
                        id: Date.now() + 2,
                        type: 'suggestions',
                        suggestions: data.suggestions,
                        timestamp: new Date()
                    });
                    scrollToBottom();
                }, 500);
            }

            // Si la réponse contient des liens vers des pages (inscription, connexion, etc.)
            if (data.message.includes('S\'inscrire') || data.message.includes('inscription')) {
                // On pourrait ajouter un bouton d'action ici si nécessaire
            }
        } else {
            messages.value.push({
                id: Date.now() + 1,
                type: 'bot',
                content: 'Désolé, une erreur est survenue. Pouvez-vous reformuler votre question ?',
                timestamp: new Date()
            });
        }
    } catch (error) {
        console.error('Erreur lors de l\'envoi du message:', error);
        messages.value.push({
            id: Date.now() + 1,
            type: 'bot',
            content: 'Désolé, je rencontre un problème technique. Veuillez réessayer plus tard.',
            timestamp: new Date()
        });
    } finally {
        isLoading.value = false;
        scrollToBottom();
    }
};

const handleSuggestionClick = (suggestion) => {
    // Rediriger vers la page de détail
    router.visit(`/detail/${suggestion.id}`);
    toggleChat();
};

const scrollToBottom = () => {
    nextTick(() => {
        const chatMessages = document.getElementById('chat-messages');
        if (chatMessages) {
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
    });
};

const formatTime = (date) => {
    return new Date(date).toLocaleTimeString('fr-FR', { 
        hour: '2-digit', 
        minute: '2-digit' 
    });
};
</script>

<template>
    <!-- Bouton flottant pour ouvrir le chat -->
    <button
        v-if="!isOpen"
        @click="toggleChat"
        class="fixed bottom-6 right-6 w-16 h-16 bg-teal-600 hover:bg-teal-700 text-white rounded-full shadow-2xl flex items-center justify-center transition-all duration-300 hover:scale-110 z-50"
        aria-label="Ouvrir le chat"
    >
        <svg v-if="!isLoading" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
        </svg>
        <svg v-else class="w-8 h-8 animate-spin" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    </button>

    <!-- Fenêtre de chat -->
    <Transition
        enter-active-class="transition ease-out duration-300"
        enter-from-class="opacity-0 translate-y-4 scale-95"
        enter-to-class="opacity-100 translate-y-0 scale-100"
        leave-active-class="transition ease-in duration-200"
        leave-from-class="opacity-100 translate-y-0 scale-100"
        leave-to-class="opacity-0 translate-y-4 scale-95"
    >
        <div
            v-if="isOpen"
            class="fixed bottom-6 right-6 w-96 h-[600px] bg-white rounded-2xl shadow-2xl flex flex-col z-50 border border-gray-200"
        >
            <!-- Header -->
            <div class="bg-gradient-to-r from-teal-600 to-teal-700 text-white p-4 rounded-t-2xl flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg">Assistant NoflayHub</h3>
                        <p class="text-xs text-teal-100">En ligne</p>
                    </div>
                </div>
                <button
                    @click="toggleChat"
                    class="text-white hover:text-teal-100 transition-colors p-1"
                    aria-label="Fermer le chat"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Messages -->
            <div
                id="chat-messages"
                class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50"
            >
                <div
                    v-for="message in messages"
                    :key="message.id"
                    :class="[
                        'flex',
                        message.type === 'user' ? 'justify-end' : 'justify-start'
                    ]"
                >
                    <!-- Message utilisateur -->
                    <div v-if="message.type === 'user'" class="max-w-[80%]">
                        <div class="bg-teal-600 text-white rounded-2xl rounded-tr-sm px-4 py-2 shadow-md">
                            <p class="text-sm">{{ message.content }}</p>
                        </div>
                        <p class="text-xs text-gray-500 mt-1 text-right">{{ formatTime(message.timestamp) }}</p>
                    </div>

                    <!-- Message bot -->
                    <div v-else-if="message.type === 'bot'" class="max-w-[80%]">
                        <div class="bg-white text-gray-900 rounded-2xl rounded-tl-sm px-4 py-2 shadow-md border border-gray-200">
                            <p class="text-sm whitespace-pre-wrap">{{ message.content }}</p>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">{{ formatTime(message.timestamp) }}</p>
                    </div>

                    <!-- Suggestions de biens -->
                    <div v-else-if="message.type === 'suggestions'" class="w-full">
                        <div class="bg-white rounded-2xl rounded-tl-sm px-4 py-3 shadow-md border border-gray-200">
                            <p class="text-sm font-semibold text-gray-900 mb-3">Voici des biens qui pourraient vous intéresser :</p>
                            <div class="space-y-3">
                                <div
                                    v-for="suggestion in message.suggestions"
                                    :key="suggestion.id"
                                    @click="handleSuggestionClick(suggestion)"
                                    class="border border-gray-200 rounded-lg p-3 hover:border-teal-500 hover:shadow-md transition-all cursor-pointer group"
                                >
                                    <div class="flex items-start space-x-3">
                                        <img
                                            :src="suggestion.image || '/storage/default-property.jpg'"
                                            :alt="suggestion.nom"
                                            class="w-16 h-16 object-cover rounded-lg"
                                            @error="$event.target.src='/storage/default-property.jpg'"
                                        />
                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-semibold text-sm text-gray-900 group-hover:text-teal-600 truncate">
                                                {{ suggestion.nom }}
                                            </h4>
                                            <p class="text-xs text-gray-600 mt-1">
                                                {{ suggestion.type }} • {{ suggestion.region }}
                                            </p>
                                            <p class="text-sm font-bold text-teal-600 mt-1">
                                                {{ new Intl.NumberFormat('fr-FR').format(suggestion.prix) }} FCFA
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">{{ formatTime(message.timestamp) }}</p>
                    </div>
                </div>

                <!-- Indicateur de frappe -->
                <div v-if="isLoading" class="flex justify-start">
                    <div class="bg-white rounded-2xl rounded-tl-sm px-4 py-2 shadow-md border border-gray-200">
                        <div class="flex space-x-1">
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0s"></div>
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Input -->
            <div class="p-4 bg-white border-t border-gray-200 rounded-b-2xl">
                <form @submit.prevent="sendMessage" class="flex items-center space-x-2">
                    <input
                        v-model="inputMessage"
                        type="text"
                        placeholder="Tapez votre message..."
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm"
                        :disabled="isLoading"
                    />
                    <button
                        type="submit"
                        :disabled="!inputMessage.trim() || isLoading"
                        class="w-10 h-10 bg-teal-600 hover:bg-teal-700 disabled:bg-gray-300 disabled:cursor-not-allowed text-white rounded-lg flex items-center justify-center transition-colors"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </Transition>
</template>

<style scoped>
/* Animation pour le scroll */
#chat-messages {
    scroll-behavior: smooth;
}

/* Style pour la barre de défilement */
#chat-messages::-webkit-scrollbar {
    width: 6px;
}

#chat-messages::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

#chat-messages::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 10px;
}

#chat-messages::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>

