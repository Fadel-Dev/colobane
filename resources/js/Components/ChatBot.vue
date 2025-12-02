<script setup>
import { ref, computed } from 'vue';

const isOpen = ref(false);
const messages = ref([
    {
        id: 1,
        text: "Bonjour! 👋 Je suis NoflayBot, votre assistant virtuel. Comment puis-je vous aider?",
        sender: 'bot',
        timestamp: new Date(),
    }
]);
const inputMessage = ref('');
const messageContainer = ref(null);

const quickReplies = [
    { id: 1, text: "Aider moi à publier", icon: "📝" },
    { id: 2, text: "Tarifs & plans", icon: "💰" },
    { id: 3, text: "Contacter support", icon: "📞" },
    { id: 4, text: "FAQ", icon: "❓" },
];

const responses = {
    "publier": "Pour publier une annonce, cliquez sur 'Nouvelle annonce' en haut de la page. Vous pouvez ajouter des photos, une description et fixer le prix. C'est rapide et gratuit!",
    "tarifs": "NoflayHub propose des plans gratuits et payants. Le plan de base est gratuit. Pour plus de visibilité, optez pour nos plans Premium ou Boost!",
    "support": "Vous pouvez nous contacter via le formulaire de contact ou nous envoyer un email à support@noflayhub.com. Nous répondons généralement en 24h.",
    "faq": "Consultez notre FAQ complète sur noflayhub.com/faq pour les questions fréquemment posées.",
    "default": "Je ne suis pas sûr de comprendre votre question. Pouvez-vous reformuler ou cliquer sur une réponse rapide ci-dessus?"
};

const sendMessage = () => {
    if (!inputMessage.value.trim()) return;

    // Add user message
    messages.value.push({
        id: messages.value.length + 1,
        text: inputMessage.value,
        sender: 'user',
        timestamp: new Date(),
    });

    // Simulate bot response
    const userInput = inputMessage.value.toLowerCase();
    let responseText = responses.default;

    if (userInput.includes("publier") || userInput.includes("annonce")) {
        responseText = responses.publier;
    } else if (userInput.includes("tarif") || userInput.includes("prix") || userInput.includes("plan")) {
        responseText = responses.tarifs;
    } else if (userInput.includes("support") || userInput.includes("contact") || userInput.includes("aide")) {
        responseText = responses.support;
    } else if (userInput.includes("faq")) {
        responseText = responses.faq;
    }

    // Add bot response
    setTimeout(() => {
        messages.value.push({
            id: messages.value.length + 1,
            text: responseText,
            sender: 'bot',
            timestamp: new Date(),
        });
        scrollToBottom();
    }, 300);

    inputMessage.value = '';
    scrollToBottom();
};

const handleQuickReply = (reply) => {
    inputMessage.value = reply.text;
    sendMessage();
};

const scrollToBottom = () => {
    if (messageContainer.value) {
        setTimeout(() => {
            messageContainer.value.scrollTop = messageContainer.value.scrollHeight;
        }, 50);
    }
};

const toggleChat = () => {
    isOpen.value = !isOpen.value;
    if (isOpen.value) {
        setTimeout(scrollToBottom, 100);
    }
};
</script>

<template>
    <div class="fixed bottom-6 right-6 z-40">
        <!-- Chat Window -->
        <transition
            enter-active-class="transform transition ease-out duration-300"
            enter-from-class="translate-y-12 opacity-0"
            enter-to-class="translate-y-0 opacity-100"
            leave-active-class="transform transition ease-in duration-200"
            leave-from-class="translate-y-0 opacity-100"
            leave-to-class="translate-y-12 opacity-0"
        >
            <div v-if="isOpen" class="mb-4 bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden flex flex-col h-96 w-96 max-h-screen">
                <!-- Header -->
                <div class="bg-gradient-to-r from-principal to-secondaire p-4 text-white flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <span class="text-lg">🤖</span>
                        </div>
                        <div>
                            <p class="font-bold text-sm">NoflayBot</p>
                            <p class="text-white/80 text-xs">En ligne</p>
                        </div>
                    </div>
                    <button
                        @click="toggleChat"
                        class="p-1 hover:bg-white/20 rounded-lg transition-all"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Messages Container -->
                <div ref="messageContainer" class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50">
                    <div v-for="message in messages" :key="message.id" class="flex" :class="message.sender === 'user' ? 'justify-end' : 'justify-start'">
                        <div :class="[
                            'max-w-xs px-4 py-3 rounded-lg text-sm',
                            message.sender === 'user'
                                ? 'bg-principal text-white rounded-br-none'
                                : 'bg-white text-gray-900 border border-gray-200 rounded-bl-none'
                        ]">
                            {{ message.text }}
                        </div>
                    </div>
                </div>

                <!-- Quick Replies -->
                <div v-if="messages.length === 1" class="px-4 py-3 border-t border-gray-200 bg-white">
                    <p class="text-xs text-gray-600 font-semibold mb-3">Réponses rapides:</p>
                    <div class="grid grid-cols-2 gap-2">
                        <button
                            v-for="reply in quickReplies"
                            :key="reply.id"
                            @click="handleQuickReply(reply)"
                            class="text-left px-3 py-2 bg-gray-100 hover:bg-principal/10 rounded-lg transition-all text-xs font-medium text-gray-700 hover:text-principal"
                        >
                            <span class="mr-1">{{ reply.icon }}</span>
                            {{ reply.text }}
                        </button>
                    </div>
                </div>

                <!-- Input Area -->
                <div class="border-t border-gray-200 p-3 bg-white flex gap-2">
                    <input
                        v-model="inputMessage"
                        @keyup.enter="sendMessage"
                        type="text"
                        placeholder="Votre message..."
                        class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-principal focus:border-transparent text-sm"
                    />
                    <button
                        @click="sendMessage"
                        class="bg-principal text-white px-4 py-2.5 rounded-lg hover:bg-principal/90 transition-all flex items-center justify-center"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                    </button>
                </div>
            </div>
        </transition>

        <!-- Chat Button (Floating) -->
        <button
            @click="toggleChat"
            class="w-14 h-14 bg-gradient-to-br from-principal to-secondaire rounded-full shadow-2xl hover:shadow-3xl transition-all hover:scale-110 transform flex items-center justify-center text-white group relative"
        >
            <div v-if="!isOpen" class="flex items-center justify-center">
                <span class="text-2xl">💬</span>
            </div>
            <!-- Badge notification -->
            <div class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 rounded-full flex items-center justify-center text-white text-xs font-bold animate-pulse">
                1
            </div>
        </button>
    </div>
</template>

<style scoped>
::-webkit-scrollbar {
    width: 6px;
}

::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}
</style>
