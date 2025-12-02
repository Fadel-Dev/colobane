<?php

namespace App\Console\Commands;

use App\Models\Immobiliers;
use Illuminate\Console\Command;
use Carbon\Carbon;

class ExpireBoosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'boosts:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Arrêter automatiquement les boosts qui ont expiré (date_fin_booster dépassée)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Trouver les boosts actifs dont la date de fin est passée
        $expiredBoosts = Immobiliers::where('booster', 1)
            ->where('status', 'accepter')
            ->whereNotNull('date_fin_booster')
            ->where('date_fin_booster', '<', now())
            ->get();

        if ($expiredBoosts->isEmpty()) {
            $this->info('✓ Aucun boost expiré à arrêter.');
            return;
        }

        // Arrêter chaque boost expiré
        foreach ($expiredBoosts as $property) {
            $property->update([
                'booster' => false,
                'status' => 'null',
            ]);

            $this->line("✓ Boost arrêté: #{$property->id} - {$property->nom}");
        }

        $this->info("\n✅ Total: {$expiredBoosts->count()} boosts arrêtés automatiquement.");
    }
}
