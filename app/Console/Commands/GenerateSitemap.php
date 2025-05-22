<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Url;
use App\Models\User;
use App\Models\Immobiliers;
use App\Models\Voitures;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Génère un sitemap segmenté';

    public function handle()
    {
        $sitemaps = [];
        $domain = config('app.url');

        // Fonction pour filtrer les URLs indésirables
        function isValidUrl($url)
        {
            return !preg_match('/\?(C|M|S|D)=/', $url) && !preg_match('/\.json$/', $url);
        }

        // Sitemap général
        $generalSitemap = Sitemap::create();
        $urls = [
            '/',
            '/contact',
            '/a-propos',
            '/conditions',
        ];

        foreach ($urls as $url) {
            $fullUrl = $domain . $url;
            if (isValidUrl($fullUrl)) {
                $generalSitemap->add(Url::create($fullUrl)->setPriority(0.8)->setChangeFrequency('daily'));
            }
        }

        $generalSitemap->writeToFile(public_path('sitemaps/general.xml'));
        $sitemaps[] = 'sitemaps/general.xml';

        // Sitemap des annonces immobilières
        $immobilierSitemap = Sitemap::create();
        foreach (Immobiliers::all() as $annonce) {
            $fullUrl = $domain . '/immobilier/' . $annonce->id;
            if (isValidUrl($fullUrl)) {
                $immobilierSitemap->add(Url::create($fullUrl)->setPriority(0.8)->setChangeFrequency('weekly'));
            }
        }
        $immobilierSitemap->writeToFile(public_path('sitemaps/immobilier.xml'));
        $sitemaps[] = 'sitemaps/immobilier.xml';

        // Sitemap des véhicules
        $vehiculeSitemap = Sitemap::create();
        foreach (Voitures::all() as $vehicule) {
            $fullUrl = $domain . '/vehicule/' . $vehicule->id;
            if (isValidUrl($fullUrl)) {
                $vehiculeSitemap->add(Url::create($fullUrl)->setPriority(0.8)->setChangeFrequency('weekly'));
            }
        }
        $vehiculeSitemap->writeToFile(public_path('sitemaps/vehicules.xml'));
        $sitemaps[] = 'sitemaps/vehicules.xml';

        // Création du fichier index
        $sitemapIndex = SitemapIndex::create();
        foreach ($sitemaps as $sitemap) {
            $sitemapIndex->add($domain . '/' . $sitemap);
        }
        $sitemapIndex->writeToFile(public_path('sitemap.xml'));

        $this->info('✅ Sitemaps générés avec succès !');
    }
}

