<template>
    <div class="container mx-auto p-4">
        <!-- Section Utilisateurs -->
        <section class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Liste des Utilisateurs</h2>
            <table class="table-auto border-collapse w-full border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Nom</th>
                        <th class="border px-4 py-2">Email</th>
                        <th class="border px-4 py-2">Rôle</th>
                        <th class="border px-4 py-2">Téléphone</th>
                        <th class="border px-4 py-2">Immobiliers</th>
                        <th class="border px-4 py-2">Voitures</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users" :key="user.id">
                        <td class="border px-4 py-2">{{ user.id }}</td>
                        <td class="border px-4 py-2">{{ user.name }}</td>
                        <td class="border px-4 py-2">{{ user.email }}</td>
                        <td class="border px-4 py-2">{{ user.role }}</td>
                        <td class="border px-4 py-2">{{ user.phone }}</td>
                        <td class="border px-4 py-2">{{ user.immobiliers_count }}</td>
                        <td class="border px-4 py-2">{{ user.voitures_count }}</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- Section Immobiliers -->
        <section class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Liste des Immobiliers</h2>
            <table class="table-auto border-collapse w-full border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Nom</th>
                        <th class="border px-4 py-2">Catégorie</th>
                        <th class="border px-4 py-2">Prix</th>
                        <th class="border px-4 py-2">Affaire</th>
                        <th class="border px-4 py-2">Date de création</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in immobiliers" :key="item.id">
                        <td class="border px-4 py-2">{{ item.id }}</td>
                        <td class="border px-4 py-2">{{ item.nom }}</td>
                        <td class="border px-4 py-2">{{ item.categorie }}</td>
                        <td class="border px-4 py-2">{{ item.prix }} €</td>
                        <td class="border px-4 py-2">{{ item.affaire }}</td>
                        <td class="border px-4 py-2">
                            {{ new Date(item.created_at).toLocaleDateString() }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- Section Voitures -->
        <section>
            <h2 class="text-2xl font-bold mb-4">Liste des Voitures</h2>
            <table class="table-auto border-collapse w-full border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Nom</th>
                        <th class="border px-4 py-2">Catégorie</th>
                        <th class="border px-4 py-2">Prix</th>
                        <th class="border px-4 py-2">Affaire</th>
                        <th class="border px-4 py-2">Date de création</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="car in voitures" :key="car.id">
                        <td class="border px-4 py-2">{{ car.id }}</td>
                        <td class="border px-4 py-2">{{ car.nom }}</td>
                        <td class="border px-4 py-2">{{ car.categorie }}</td>
                        <td class="border px-4 py-2">{{ car.prix }} €</td>
                        <td class="border px-4 py-2">{{ car.affaire }}</td>
                        <td class="border px-4 py-2">
                            {{ new Date(car.created_at).toLocaleDateString() }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>
</template>

<script>
export default {
    props: {
        users: Object,
        immobiliers: Object,
        voitures: Object,
    },
};
</script>

<style>
.container {
    max-width: 1200px;
    margin: auto;
}
</style>
