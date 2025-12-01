<?php

namespace App\Http\Controllers;

use App\Models\Immobiliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChatBotController extends Controller
{
    /**
     * Traiter un message du chatbot
     */
    public function processMessage(Request $request)
    {
        $message = $request->input('message', '');
        $preferences = $request->input('preferences', []);
        $conversationHistory = $request->input('conversation_history', []);

        try {
            // Analyser le message pour extraire les informations
            $extractedInfo = $this->extractInformation($message, $preferences);
            
            // Mettre à jour les préférences
            $updatedPreferences = array_merge($preferences, $extractedInfo);
            
            // Générer une réponse intelligente
            $response = $this->generateResponse($message, $updatedPreferences, $conversationHistory);
            
            // Chercher des suggestions de biens si on a assez d'informations
            $suggestions = [];
            if ($this->hasEnoughInfo($updatedPreferences)) {
                $suggestions = $this->findSuggestions($updatedPreferences);
            }

            return response()->json([
                'success' => true,
                'message' => $response,
                'preferences' => $updatedPreferences,
                'suggestions' => $suggestions
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur chatbot: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Désolé, une erreur est survenue. Pouvez-vous reformuler votre question ?'
            ], 500);
        }
    }

    /**
     * Extraire les informations du message de l'utilisateur
     */
    private function extractInformation($message, $currentPreferences)
    {
        $extracted = [];
        $messageLower = mb_strtolower($message, 'UTF-8');

        // Types de biens
        $types = [
            'villa' => ['villa', 'maison', 'villas', 'maisons'],
            'appartement' => ['appartement', 'appart', 'appartements', 'apparts'],
            'chambre' => ['chambre', 'chambres', 'chambre à louer'],
            'studio' => ['studio', 'studios'],
            'immeuble' => ['immeuble', 'immeubles', 'bâtiment'],
            'terrain' => ['terrain', 'terrains', 'parcelle']
        ];

        foreach ($types as $type => $keywords) {
            foreach ($keywords as $keyword) {
                if (strpos($messageLower, $keyword) !== false) {
                    $extracted['type'] = ucfirst($type);
                    break 2;
                }
            }
        }

        // Régions du Sénégal
        $regions = [
            'Dakar', 'Thiès', 'Saint-Louis', 'Kaolack', 'Ziguinchor',
            'Tambacounda', 'Kolda', 'Matam', 'Louga', 'Fatick',
            'Kaffrine', 'Sédhiou', 'Kédougou', 'Diourbel', 'Rufisque'
        ];

        foreach ($regions as $region) {
            if (stripos($messageLower, mb_strtolower($region, 'UTF-8')) !== false) {
                $extracted['region'] = $region;
                break;
            }
        }

        // Prix
        if (preg_match('/(?:budget|prix|coût|maximum|max|jusqu\'?à)\s*(?:de\s*)?(\d+)\s*(?:f|fcfa|francs?)?/i', $message, $matches)) {
            $extracted['prixMax'] = (int) $matches[1];
        }
        if (preg_match('/(?:minimum|min|à partir de|au moins)\s*(?:de\s*)?(\d+)\s*(?:f|fcfa|francs?)?/i', $message, $matches)) {
            $extracted['prixMin'] = (int) $matches[1];
        }
        if (preg_match('/(\d+)\s*(?:000\s*)?(?:f|fcfa|francs?)?\s*(?:par\s*)?(?:mois|mois)?/i', $message, $matches)) {
            if (!isset($extracted['prixMax'])) {
                $extracted['prixMax'] = (int) $matches[1];
            }
        }

        // Surface
        if (preg_match('/(?:surface|m²|m2|mètres? carrés?)\s*(?:de\s*)?(\d+)/i', $message, $matches)) {
            $extracted['surface'] = (int) $matches[1];
        }

        // Nombre de pièces
        if (preg_match('/(\d+)\s*(?:pièces?|chambres?|salles?)/i', $message, $matches)) {
            $extracted['pieces'] = (int) $matches[1];
        }

        return $extracted;
    }

    /**
     * Générer une réponse intelligente
     */
    private function generateResponse($message, $preferences, $conversationHistory)
    {
        $messageLower = mb_strtolower($message, 'UTF-8');

        // Salutations
        if (preg_match('/\b(?:bonjour|salut|hello|bonsoir|bonne\s*(?:soirée|nuit))\b/i', $message)) {
            return "Bonjour ! 😊 Je suis votre assistant NoflayHub. Je peux vous aider à :\n• Trouver un bien immobilier\n• Créer un compte\n• Publier une annonce\n• Utiliser le site\n\nComment puis-je vous aider ?";
        }

        // Questions sur la création de compte / inscription
        if (preg_match('/\b(?:comment|comment\s*faire|créer|crée|inscrire|inscription|s\'?inscrire|compte|enregistrer|enregistrement)\s*(?:un\s*)?(?:compte|profil|account)?\b/i', $message)) {
            return "Pour créer un compte sur NoflayHub, c'est très simple ! 📝\n\n1️⃣ Cliquez sur le bouton \"S'inscrire\" en haut à droite de la page\n2️⃣ Remplissez le formulaire avec vos informations (nom, email, mot de passe)\n3️⃣ Validez votre email si nécessaire\n4️⃣ C'est fait ! Vous pouvez maintenant publier des annonces et sauvegarder vos favoris\n\nSouhaitez-vous que je vous guide vers la page d'inscription ?";
        }

        // Questions sur la connexion
        if (preg_match('/\b(?:se\s*connecter|connexion|connecter|login|se\s*connecter|identifier)\b/i', $message)) {
            return "Pour vous connecter à votre compte NoflayHub : 🔐\n\n1️⃣ Cliquez sur le bouton \"Se connecter\" en haut à droite\n2️⃣ Entrez votre email et votre mot de passe\n3️⃣ Cliquez sur \"Connexion\"\n\nSi vous avez oublié votre mot de passe, vous pouvez le réinitialiser depuis la page de connexion.\n\nBesoin d'aide pour autre chose ?";
        }

        // Questions sur la publication d'annonces
        if (preg_match('/\b(?:publier|publication|annonce|vendre|louer|mettre\s*en\s*vente|mettre\s*en\s*location)\b/i', $message)) {
            return "Pour publier une annonce sur NoflayHub : 📢\n\n1️⃣ Connectez-vous à votre compte (ou créez-en un)\n2️⃣ Cliquez sur \"Publier une annonce\"\n3️⃣ Remplissez le formulaire avec les détails de votre bien\n4️⃣ Ajoutez des photos (minimum 1, maximum 3)\n5️⃣ Soumettez votre annonce\n\nVotre annonce sera vérifiée par notre équipe avant d'être publiée.\n\nAvez-vous d'autres questions ?";
        }

        // Questions sur les favoris
        if (preg_match('/\b(?:favoris|favori|sauvegarder|enregistrer|garder|marquer)\b/i', $message)) {
            return "Les favoris vous permettent de sauvegarder les biens qui vous intéressent ! ❤️\n\nPour ajouter un bien aux favoris :\n1️⃣ Connectez-vous à votre compte\n2️⃣ Cliquez sur l'icône cœur sur un bien qui vous plaît\n3️⃣ Retrouvez tous vos favoris dans \"Mes favoris\" dans le menu utilisateur\n\nC'est pratique pour comparer plusieurs biens !";
        }

        // Questions sur le fonctionnement du site
        if (preg_match('/\b(?:comment\s*ça\s*marche|fonctionnement|utiliser|aide|help|assistance)\b/i', $message)) {
            return "NoflayHub est une plateforme de location et vente immobilière au Sénégal ! 🏠\n\nVoici comment ça marche :\n\n🔍 **Rechercher un bien** : Utilisez la barre de recherche ou parcourez les catégories\n💾 **Sauvegarder** : Ajoutez vos biens préférés aux favoris\n📞 **Contacter** : Cliquez sur un bien pour voir les détails et contacter le propriétaire\n📝 **Publier** : Créez un compte et publiez votre bien gratuitement\n\nBesoin d'aide pour quelque chose de spécifique ?";
        }

        // Questions sur les prix / tarifs
        if (preg_match('/\b(?:prix|tarif|coût|gratuit|payant|payer)\b/i', $message)) {
            return "Sur NoflayHub : 💰\n\n✅ **Gratuit** :\n• Créer un compte\n• Rechercher des biens\n• Contacter les propriétaires\n• Publier une annonce\n• Ajouter aux favoris\n\n💎 **Optionnel - Boost** :\n• Mettre votre annonce en vedette pour plus de visibilité\n\nTout est gratuit pour les utilisateurs de base !";
        }

        // Remerciements
        if (preg_match('/\b(?:merci|thanks?|remerciements?)\b/i', $message)) {
            return "De rien ! 😊 N'hésitez pas si vous avez d'autres questions. Je suis là pour vous aider !";
        }

        // Au revoir
        if (preg_match('/\b(?:au\s*revoir|bye|à\s*bientôt|goodbye)\b/i', $message)) {
            return "Au revoir ! 👋 Bonne recherche et à bientôt sur NoflayHub !";
        }

        // Questions sur les types de biens
        if (preg_match('/\b(?:quel|quels|quelle|quelles|type|types)\s*(?:de\s*)?(?:bien|biens|logement|logements)\b/i', $message)) {
            return "Nous proposons plusieurs types de biens : 🏘️\n\n• 🏡 **Villa** : Maison individuelle avec jardin\n• 🏢 **Appartement** : Logement dans un immeuble\n• 🛏️ **Chambre** : Chambre à louer\n• 🏠 **Studio** : Logement d'une seule pièce\n• 🏗️ **Immeuble** : Bâtiment complet\n• 🌳 **Terrain** : Parcelle à bâtir ou à cultiver\n\nLequel vous intéresse ?";
        }

        // Si on a des préférences, confirmer et demander plus d'infos
        // Mais seulement si le message concerne la recherche de biens
        $isSearchRelated = preg_match('/\b(?:chercher|rechercher|trouver|villa|appartement|chambre|studio|immeuble|terrain|bien|logement|location|louer)\b/i', $message);
        
        if ($isSearchRelated) {
            $missingInfo = [];
            if (empty($preferences['type'])) {
                $missingInfo[] = "le type de bien";
            }
            if (empty($preferences['region'])) {
                $missingInfo[] = "la région";
            }
            if (empty($preferences['prixMax']) && empty($preferences['prixMin'])) {
                $missingInfo[] = "votre budget";
            }

            if (!empty($missingInfo)) {
                $info = implode(', ', array_slice($missingInfo, 0, -1));
                if (count($missingInfo) > 1) {
                    $info .= ' et ' . end($missingInfo);
                } else {
                    $info = $missingInfo[0];
                }
                return "Pour mieux vous aider à trouver un bien, j'aurais besoin de connaître " . $info . ". Pouvez-vous me donner ces informations ?\n\nPar exemple : \"Je cherche une villa à Dakar avec un budget de 500000 FCFA\"";
            }
        }

        // Confirmation des préférences
        $confirmation = "Parfait ! Je comprends que vous recherchez ";
        $parts = [];
        
        if (!empty($preferences['type'])) {
            $parts[] = "un(e) " . strtolower($preferences['type']);
        }
        if (!empty($preferences['region'])) {
            $parts[] = "à " . $preferences['region'];
        }
        if (!empty($preferences['prixMax'])) {
            $parts[] = "avec un budget maximum de " . number_format($preferences['prixMax'], 0, ',', ' ') . " FCFA";
        }
        if (!empty($preferences['pieces'])) {
            $parts[] = $preferences['pieces'] . " pièce(s)";
        }

        if (!empty($parts)) {
            $confirmation .= implode(', ', array_slice($parts, 0, -1));
            if (count($parts) > 1) {
                $confirmation .= ' et ' . end($parts);
            } else {
                $confirmation .= $parts[0];
            }
            $confirmation .= ". Laissez-moi chercher des biens qui correspondent à vos critères...";
        } else {
            $confirmation = "Je vais chercher des biens qui pourraient vous intéresser. Pouvez-vous me donner plus de détails sur ce que vous recherchez ?";
        }

        return $confirmation;
    }

    /**
     * Vérifier si on a assez d'informations pour faire des suggestions
     */
    private function hasEnoughInfo($preferences)
    {
        // Au moins le type ou la région
        return !empty($preferences['type']) || !empty($preferences['region']);
    }

    /**
     * Trouver des suggestions de biens
     */
    private function findSuggestions($preferences)
    {
        $query = Immobiliers::where('status', 'accepter');

        // Filtrer par type
        if (!empty($preferences['type'])) {
            $query->where('type', $preferences['type']);
        }

        // Filtrer par région
        if (!empty($preferences['region'])) {
            $query->where('region', 'like', '%' . $preferences['region'] . '%');
        }

        // Filtrer par prix maximum (prix est un string, on le convertit)
        if (!empty($preferences['prixMax'])) {
            $query->whereRaw('CAST(prix AS UNSIGNED) <= ?', [$preferences['prixMax']]);
        }

        // Filtrer par prix minimum
        if (!empty($preferences['prixMin'])) {
            $query->whereRaw('CAST(prix AS UNSIGNED) >= ?', [$preferences['prixMin']]);
        }

        // Filtrer par surface (surface est un string)
        if (!empty($preferences['surface'])) {
            $query->whereRaw('CAST(surface AS UNSIGNED) >= ?', [$preferences['surface'] * 0.9]); // 10% de tolérance
        }

        // Filtrer par nombre de pièces (npiece est un string)
        if (!empty($preferences['pieces'])) {
            $query->whereRaw('CAST(npiece AS UNSIGNED) >= ?', [$preferences['pieces']]);
        }

        // Limiter à 5 résultats et ordonner par date de création
        $results = $query->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($item) {
                // Déterminer la première image disponible
                $image = null;
                if ($item->image1 && $item->image1 !== 'null' && $item->image1 !== '') {
                    $image = asset('storage/' . $item->image1);
                } elseif ($item->image2 && $item->image2 !== 'null' && $item->image2 !== '') {
                    $image = asset('storage/' . $item->image2);
                } elseif ($item->image3 && $item->image3 !== 'null' && $item->image3 !== '') {
                    $image = asset('storage/' . $item->image3);
                }
                
                return [
                    'id' => $item->id,
                    'nom' => $item->nom,
                    'type' => $item->type,
                    'region' => $item->region,
                    'prix' => (int) $item->prix, // Convertir en entier pour l'affichage
                    'image' => $image,
                ];
            });

        return $results->toArray();
    }
}

