<?php

namespace App\Http\Controllers;

use App\Models\Immobiliers;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        
        // Sitemap principal
        $sitemap .= '<sitemap>';
        $sitemap .= '<loc>' . url('/sitemap-pages.xml') . '</loc>';
        $sitemap .= '<lastmod>' . date('Y-m-d') . '</lastmod>';
        $sitemap .= '</sitemap>';
        
        // Sitemap des annonces immobilières
        $sitemap .= '<sitemap>';
        $sitemap .= '<loc>' . url('/sitemap-immobilier.xml') . '</loc>';
        $sitemap .= '<lastmod>' . date('Y-m-d') . '</lastmod>';
        $sitemap .= '</sitemap>';
        
        $sitemap .= '</sitemapindex>';
        
        return response($sitemap, 200)
            ->header('Content-Type', 'application/xml');
    }
    
    public function pages()
    {
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        
        // Page d'accueil
        $sitemap .= '<url>';
        $sitemap .= '<loc>' . url('/') . '</loc>';
        $sitemap .= '<lastmod>' . date('Y-m-d') . '</lastmod>';
        $sitemap .= '<changefreq>daily</changefreq>';
        $sitemap .= '<priority>1.0</priority>';
        $sitemap .= '</url>';
        
        // Pages de catégories
        $categories = ['villa', 'appartements', 'chambre', 'studio', 'immeuble', 'terrain'];
        foreach ($categories as $category) {
            $sitemap .= '<url>';
            $sitemap .= '<loc>' . url("/categorie/{$category}") . '</loc>';
            $sitemap .= '<lastmod>' . date('Y-m-d') . '</lastmod>';
            $sitemap .= '<changefreq>daily</changefreq>';
            $sitemap .= '<priority>0.8</priority>';
            $sitemap .= '</url>';
        }
        
        $sitemap .= '</urlset>';
        
        return response($sitemap, 200)
            ->header('Content-Type', 'application/xml');
    }
    
    public function immobilier()
    {
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        
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
            $sitemap .= '</url>';
        }
        
        $sitemap .= '</urlset>';
        
        return response($sitemap, 200)
            ->header('Content-Type', 'application/xml');
    }
}

