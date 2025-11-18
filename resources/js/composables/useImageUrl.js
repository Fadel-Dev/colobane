/**
 * Composable pour gérer les URLs d'images
 * Supporte les URLs externes et les chemins locaux
 */
export function useImageUrl() {
    /**
     * Retourne l'URL complète d'une image
     * @param {string} imagePath - Chemin de l'image (peut être URL externe ou chemin local)
     * @returns {string} URL complète de l'image
     */
    const getImageUrl = (imagePath) => {
        if (!imagePath) {
            return '/storage/default-image.jpg'; // Image par défaut si aucune image
        }
        
        // Si c'est une URL externe (http:// ou https://), retourner tel quel
        if (imagePath.startsWith('http://') || imagePath.startsWith('https://')) {
            return imagePath;
        }
        
        // Si c'est un chemin local, ajouter /storage/
        // Vérifier si le chemin commence déjà par storage/
        if (imagePath.startsWith('storage/') || imagePath.startsWith('/storage/')) {
            return imagePath.startsWith('/') ? imagePath : '/' + imagePath;
        }
        
        // Sinon, ajouter /storage/ devant
        return '/storage/' + imagePath;
    };

    /**
     * Gère les erreurs de chargement d'image
     * @param {Event} event - Événement d'erreur
     */
    const handleImageError = (event) => {
        // Remplacer par une image par défaut en cas d'erreur
        if (event.target) {
            event.target.src = '/storage/default-image.jpg';
            // Ou masquer l'image si l'image par défaut n'existe pas
            event.target.onerror = () => {
                event.target.style.display = 'none';
            };
        }
    };

    return {
        getImageUrl,
        handleImageError
    };
}

