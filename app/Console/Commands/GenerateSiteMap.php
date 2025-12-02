<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateSiteMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The description of the console command.
     *
     * @var string
     */
    protected $description = 'Générer les sitemaps XML pour NoflayHub';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Génération des sitemaps en cours...');

        try {
            // Générer les sitemaps en accédant les routes
            $sitemaps = [
                'sitemap.xml' => url('/sitemap.xml'),
                'sitemap-pages.xml' => url('/sitemap-pages.xml'),
                'sitemap-immobilier.xml' => url('/sitemap-immobilier.xml'),
                'sitemap-vehicules.xml' => url('/sitemap-vehicules.xml'),
                'sitemap-services.xml' => url('/sitemap-services.xml'),
            ];

            foreach ($sitemaps as $filename => $url) {
                $this->info("📝 Génération de $filename...");
                
                try {
                    $content = file_get_contents($url);
                    File::put(public_path($filename), $content);
                    $this->info("✅ $filename généré avec succès");
                } catch (\Exception $e) {
                    $this->error("❌ Erreur lors de la génération de $filename: " . $e->getMessage());
                }
            }

            $this->info("\n✨ Génération des sitemaps terminée!");
            $this->info("📍 Les sitemaps sont disponibles à:");
            foreach ($sitemaps as $filename => $url) {
                $this->line("   - $url");
            }

        } catch (\Exception $e) {
            $this->error("❌ Erreur: " . $e->getMessage());
            return 1;
        }

        return 0;
    }
}

