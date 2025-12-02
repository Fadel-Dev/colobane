<?php

namespace App\Http\Controllers;

use App\Models\Immobiliers;
use App\Models\Voitures;
use App\Models\Covoiturages;
use App\Models\Services;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Générer l'index des sitemaps
     */
    public function index()
    {
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        
        // Sitemap des pages statiques
        $sitemap .= '<sitemap>';
        $sitemap .= '<loc>' . url('/sitemap-pages.xml') . '</loc>';
        $sitemap .= '<lastmod>' . date('Y-m-d') . '</lastmod>';
        $sitemap .= '</sitemap>';
        
        // Sitemap des annonces immobilières
        $sitemap .= '<sitemap>';
        $sitemap .= '<loc>' . url('/sitemap-immobilier.xml') . '</loc>';
        $sitemap .= '<lastmod>' . date('Y-m-d') . '</lastmod>';
        $sitemap .= '</sitemap>';
        
        // Sitemap des véhicules
        $sitemap .= '<sitemap>';
        $sitemap .= '<loc>' . url('/sitemap-vehicules.xml') . '</loc>';
        $sitemap .= '<lastmod>' . date('Y-m-d') . '</lastmod>';
        $sitemap .= '</sitemap>';
        
        // Sitemap des services
        $sitemap .= '<sitemap>';
        $sitemap .= '<loc>' . url('/sitemap-services.xml') . '</loc>';
        $sitemap .= '<lastmod>' . date('Y-m-d') . '</lastmod>';
        $sitemap .= '</sitemap>';
        
        $sitemap .= '</sitemapindex>';
        
        return response($sitemap, 200)
            ->header('Content-Type', 'application/xml');
    }
    
    /**
     * Sitemap des pages statiques et catégories
     */
    public function pages()
    {
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"';
        $sitemap .= ' xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"';
        $sitemap .= ' xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">';
        
        $pages = [
            ['url' => '/', 'priority' => '1.0', 'changefreq' => 'daily'],
            ['url' => '/about', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => '/contact', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['url' => '/aide', 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['url' => '/faq', 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['url' => '/comment-ca-marche', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => '/terms', 'priority' => '0.5', 'changefreq' => 'yearly'],
            ['url' => '/privacy', 'priority' => '0.5', 'changefreq' => 'yearly'],
            ['url' => '/cookies', 'priority' => '0.3', 'changefreq' => 'yearly'],
        ];
        
        foreach ($pages as $page) {
            $sitemap .= '<url>';
            $sitemap .= '<loc>' . url($page['url']) . '</loc>';
            $sitemap .= '<lastmod>' . date('Y-m-d') . '</lastmod>';
            $sitemap .= '<changefreq>' . $page['changefreq'] . '</changefreq>';
            $sitemap .= '<priority>' . $page['priority'] . '</priority>';
            $sitemap .= '</url>';
        }
        
        // Catégories immobilières
        $immobilierCategories = ['villa', 'appartements', 'chambre', 'studio', 'immeuble', 'terrain', 'verger'];
        foreach ($immobilierCategories as $category) {
            $sitemap .= '<url>';
            $sitemap .= '<loc>' . url("/categorie/{$category}") . '</loc>';
            $sitemap .= '<lastmod>' . date('Y-m-d') . '</lastmod>';
            $sitemap .= '<changefreq>daily</changefreq>';
            $sitemap .= '<priority>0.9</priority>';
            $sitemap .= '</url>';
        }
        
        // Sections
        $sections = ['immobilier', 'voiture'];
        foreach ($sections as $section) {
            $sitemap .= '<url>';
            $sitemap .= '<loc>' . url("/p/{$section}") . '</loc>';
            $sitemap .= '<lastmod>' . date('Y-m-d') . '</lastmod>';
            $sitemap .= '<changefreq>daily</changefreq>';
            $sitemap .= '<priority>0.85</priority>';
            $sitemap .= '</url>';
        }
        
        $sitemap .= '</urlset>';
        
        return response($sitemap, 200)
            ->header('Content-Type', 'application/xml')
            ->header('Cache-Control', 'public, max-age=3600');
    }
    
    /**
     * Sitemap des annonces immobilières
     */
    public function immobilier()
    {
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"';
        $sitemap .= ' xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';
        
        // Récupérer toutes les annonces acceptées
        $annonces = Immobiliers::where('status', 'accepter')
            ->orderBy('updated_at', 'desc')
            ->get();
        
        foreach ($annonces as $annonce) {
            $sitemap .= '<url>';
            $sitemap .= '<loc>' . url("/detail/{$annonce->id}") . '</loc>';
            $sitemap .= '<lastmod>' . $annonce->updated_at->format('Y-m-d') . '</lastmod>';
            $sitemap .= '<changefreq>weekly</changefreq>';
            $sitemap .= '<priority>0.7</priority>';
            
            // Ajouter les images si disponibles
            if ($annonce->images && !empty($annonce->images)) {
                $images = is_array($annonce->images) ? $annonce->images : json_decode($annonce->images);
                if (is_iterable($images)) {
                    foreach ($images as $image) {
                        $sitemap .= '<image:image>';
                        $sitemap .= '<image:loc>' . $image . '</image:loc>';
                        $sitemap .= '</image:image>';
                    }
                }
            }
            
            $sitemap .= '</url>';
        }
        
        $sitemap .= '</urlset>';
        
        return response($sitemap, 200)
            ->header('Content-Type', 'application/xml')
            ->header('Cache-Control', 'public, max-age=7200');
    }
    
    /**
     * Sitemap des véhicules
     */
    public function vehicules()
    {
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"';
        $sitemap .= ' xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';
        
        // Récupérer tous les véhicules acceptés
        $vehicules = Voitures::where('status', 'accepter')
            ->orWhere('status', 'acceptée')
            ->orderBy('updated_at', 'desc')
            ->get();
        
        foreach ($vehicules as $vehicule) {
            $sitemap .= '<url>';
            $sitemap .= '<loc>' . url("/detailVehi/{$vehicule->id}") . '</loc>';
            $sitemap .= '<lastmod>' . $vehicule->updated_at->format('Y-m-d') . '</lastmod>';
            $sitemap .= '<changefreq>weekly</changefreq>';
            $sitemap .= '<priority>0.7</priority>';
            
            // Ajouter les images si disponibles
            if ($vehicule->images && !empty($vehicule->images)) {
                $images = is_array($vehicule->images) ? $vehicule->images : json_decode($vehicule->images);
                if (is_iterable($images)) {
                    foreach ($images as $image) {
                        $sitemap .= '<image:image>';
                        $sitemap .= '<image:loc>' . $image . '</image:loc>';
                        $sitemap .= '</image:image>';
                    }
                }
            }
            
            $sitemap .= '</url>';
        }
        
        $sitemap .= '</urlset>';
        
        return response($sitemap, 200)
            ->header('Content-Type', 'application/xml')
            ->header('Cache-Control', 'public, max-age=7200');
    }
    
    /**
     * Sitemap des services
     */
    public function services()
    {
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"';
        $sitemap .= ' xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';
        
        // Récupérer tous les services acceptés
        $services = Services::where('status', 'accepter')
            ->orWhere('status', 'acceptée')
            ->orderBy('updated_at', 'desc')
            ->get();
        
        foreach ($services as $service) {
            $sitemap .= '<url>';
            $sitemap .= '<loc>' . url("/detail/{$service->id}") . '</loc>';
            $sitemap .= '<lastmod>' . $service->updated_at->format('Y-m-d') . '</lastmod>';
            $sitemap .= '<changefreq>weekly</changefreq>';
            $sitemap .= '<priority>0.6</priority>';
            $sitemap .= '</url>';
        }
        
        $sitemap .= '</urlset>';
        
        return response($sitemap, 200)
            ->header('Content-Type', 'application/xml')
            ->header('Cache-Control', 'public, max-age=7200');
    }
}

