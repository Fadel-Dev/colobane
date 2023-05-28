<template>
    <div>
      <button @click="toggleUserNumber">{{ showUserNumber ? 'Cacher' : 'Afficher' }}</button>
      <p v-if="showUserNumber">
        Le numéro de l'utilisateur est : {{ userNumber }}
      </p>
      <p v-else>
        Texte sans numéro d'utilisateur
      </p>
    </div>
  </template>

  <script>
  export default {
    data() {
      return {
        showUserNumber: false,
        userNumber: 12345 // Remplacez 12345 par votre numéro d'utilisateur réel
      };
    },
    methods: {
      toggleUserNumber() {
        this.showUserNumber = !this.showUserNumber;
      }
    }
  };
  </script>
