<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SeoHeadMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Partager les données SEO avec tous les composants Inertia
        Inertia::share([
            'seo' => function () {
                return $this->generateSeoData($this->detectPageType());
            },
        ]);

        return $next($request);
    }

    /**
     * Détecter le type de page depuis l'URL actuelle
     */
    private function detectPageType()
    {
        $path = request()->path();
        $segments = explode('/', $path);

        if ($path === '/') {
            return 'home';
        } elseif (str_starts_with($path, '/categorie/')) {
            return 'category';
        } elseif (str_starts_with($path, '/publication/')) {
            return 'article';
        } elseif (str_starts_with($path, '/detail/')) {
            return 'immobilier_detail';
        } elseif (str_starts_with($path, '/detailVehi/')) {
            return 'vehicule_detail';
        } elseif (str_starts_with($path, '/p/')) {
            return 'section';
        } elseif ($path === '/about') {
            return 'about';
        } elseif ($path === '/contact') {
            return 'contact';
        } elseif ($path === '/faq') {
            return 'faq';
        } elseif ($path === '/comment-ca-marche') {
            return 'how_it_works';
        }

        return 'default';
    }

    /**
     * Générer les données SEO selon le type de page
     */
    private function generateSeoData($pageType)
    {
        $defaultSeo = [
            'title' => config('seo.defaults.title'),
            'description' => config('seo.defaults.description'),
            'keywords' => config('seo.defaults.keywords'),
            'image' => config('seo.defaults.image'),
            'url' => request()->url(),
            'type' => 'website',
        ];

        switch ($pageType) {
            case 'home':
                return array_merge($defaultSeo, [
                    'title' => 'NoflayHub - Marketplace Immobilier & Automobile au Sénégal',
                    'description' => 'Découvrez NoflayHub, la plateforme N°1 de location et vente immobilière au Sénégal. Villas, appartements, terrains et véhicules à proximité de vous.',
                    'type' => 'website',
                ]);

            case 'category':
                $category = str_replace('categorie/', '', request()->path());
                return array_merge($defaultSeo, [
                    'title' => ucfirst($category) . ' à louer au Sénégal | NoflayHub',
                    'description' => 'Trouvez les meilleures ' . strtolower($category) . ' à louer au Sénégal. Milliers d\'annonces vérifiées avec photos et descriptions détaillées.',
                    'type' => 'website',
                ]);

            case 'article':
                return array_merge($defaultSeo, [
                    'type' => 'article',
                    'title' => 'Article | NoflayHub',
                    'description' => 'Consultez cet article sur NoflayHub, la plateforme immobilière et automobile au Sénégal.',
                ]);

            case 'immobilier_detail':
                return array_merge($defaultSeo, [
                    'type' => 'product',
                    'title' => 'Annonce Immobilière | NoflayHub',
                    'description' => 'Découvrez cette annonce immobilière sur NoflayHub. Détails complets, photos et coordonnées du propriétaire.',
                ]);

            case 'vehicule_detail':
                return array_merge($defaultSeo, [
                    'type' => 'product',
                    'title' => 'Véhicule à Vendre ou à Louer | NoflayHub',
                    'description' => 'Découvrez ce véhicule sur NoflayHub. Spécifications, prix et coordonnées du vendeur ou loueur.',
                ]);

            case 'section':
                $section = str_replace('p/', '', request()->path());
                return array_merge($defaultSeo, [
                    'title' => ucfirst($section) . ' au Sénégal | NoflayHub',
                    'description' => 'Consultez toutes les annonces ' . strtolower($section) . ' au Sénégal sur NoflayHub.',
                ]);

            case 'about':
                return array_merge($defaultSeo, [
                    'title' => 'À propos de NoflayHub | Marketplace de Confiance',
                    'description' => 'Découvrez l\'histoire de NoflayHub, la plateforme de confiance pour l\'immobilier et l\'automobile au Sénégal.',
                ]);

            case 'contact':
                return array_merge($defaultSeo, [
                    'title' => 'Nous Contacter | NoflayHub',
                    'description' => 'Contactez l\'équipe NoflayHub pour toute question ou problème. Nous répondons rapidement à tous les messages.',
                ]);

            case 'faq':
                return array_merge($defaultSeo, [
                    'title' => 'Questions Fréquemment Posées | NoflayHub',
                    'description' => 'Trouvez les réponses à vos questions sur NoflayHub. Comment utiliser la plateforme, publicer, acheter, louer, etc.',
                ]);

            case 'how_it_works':
                return array_merge($defaultSeo, [
                    'title' => 'Comment Ça Marche | NoflayHub',
                    'description' => 'Découvrez comment fonctionne NoflayHub. Étapes simples pour trouver, publier et gérer vos annonces.',
                ]);

            default:
                return $defaultSeo;
        }
    }
}

