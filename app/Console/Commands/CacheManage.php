<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CacheService;
use Illuminate\Support\Facades\Cache;

class CacheManage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:manage {action} {--pattern=} {--key=} {--ttl=3600}';

    /**
     * The description of the console command.
     *
     * @var string
     */
    protected $description = 'Manage Redis cache: test, flush, stats, etc';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $action = $this->argument('action');

        switch ($action) {
            case 'test':
                return $this->testConnection();
            case 'flush':
                return $this->flushCache();
            case 'stats':
                return $this->showStats();
            case 'info':
                return $this->showInfo();
            case 'get':
                return $this->getKey();
            case 'set':
                return $this->setKey();
            case 'delete':
                return $this->deleteKey();
            case 'warm-up':
                return $this->warmUp();
            default:
                $this->error("Action '$action' not recognized");
                return 1;
        }
    }

    /**
     * Test Redis connection
     */
    protected function testConnection()
    {
        $this->info('Testing Redis connection...');

        if (CacheService::testConnection()) {
            $this->line('<fg=green>✓ Redis is connected</fg=green>');
            
            $info = CacheService::getRedisInfo();
            $this->table(['Property', 'Value'], [
                ['Status', $info['status']],
                ['Version', $info['version']],
                ['Memory', $info['memory_usage']],
                ['Connected Clients', $info['connected_clients']],
                ['Total Commands', $info['total_commands']],
            ]);
            
            return 0;
        }

        $this->error('✗ Redis connection failed');
        return 1;
    }

    /**
     * Flush cache
     */
    protected function flushCache()
    {
        $pattern = $this->option('pattern');

        if ($pattern) {
            if (!$this->confirm("Flush all keys matching pattern '$pattern'?")) {
                $this->line('Cancelled');
                return 0;
            }

            $deleted = CacheService::flushByPattern($pattern);
            $this->info("✓ Flushed $deleted keys matching pattern '$pattern'");
        } else {
            if (!$this->confirm('Flush entire cache? This will remove all cached data.')) {
                $this->line('Cancelled');
                return 0;
            }

            CacheService::flushAll();
            $this->info('✓ Cache flushed completely');
        }

        return 0;
    }

    /**
     * Show cache statistics
     */
    protected function showStats()
    {
        $this->info('Cache Statistics:');

        $stats = CacheService::getStats();

        if (isset($stats['error'])) {
            $this->error('Error: ' . $stats['error']);
            return 1;
        }

        $this->table(['Metric', 'Value'], [
            ['Total Connections', $stats['total_connections_received'] ?? 'N/A'],
            ['Total Commands', $stats['total_commands_processed'] ?? 'N/A'],
            ['Ops/sec', $stats['instantaneous_ops_per_sec'] ?? 'N/A'],
            ['Keys Count', $stats['keys_count'] ?? 'N/A'],
            ['Expires Count', $stats['expires_count'] ?? 'N/A'],
        ]);

        return 0;
    }

    /**
     * Show Redis info
     */
    protected function showInfo()
    {
        $this->info('Redis Information:');

        $info = CacheService::getRedisInfo();

        $this->table(['Property', 'Value'], [
            ['Status', $info['status']],
            ['Version', $info['version']],
            ['Memory Usage', $info['memory_usage']],
            ['Connected Clients', $info['connected_clients']],
            ['Total Commands', $info['total_commands']],
        ]);

        return 0;
    }

    /**
     * Get a cache key
     */
    protected function getKey()
    {
        $key = $this->option('key');

        if (!$key) {
            $key = $this->ask('Enter cache key');
        }

        $value = CacheService::get($key);

        if ($value === null) {
            $this->warn("Key '$key' not found in cache");
            return 1;
        }

        $this->info("Value for key '$key':");
        $this->line(json_encode($value, JSON_PRETTY_PRINT));

        return 0;
    }

    /**
     * Set a cache key
     */
    protected function setKey()
    {
        $key = $this->option('key');
        $value = $this->ask('Enter value');
        $ttl = $this->option('ttl');

        if (!$key) {
            $key = $this->ask('Enter cache key');
        }

        CacheService::put($key, $value, (int)$ttl);
        $this->info("✓ Cache key '$key' set successfully (TTL: $ttl seconds)");

        return 0;
    }

    /**
     * Delete a cache key
     */
    protected function deleteKey()
    {
        $key = $this->option('key');

        if (!$key) {
            $key = $this->ask('Enter cache key to delete');
        }

        if (!$this->confirm("Delete cache key '$key'?")) {
            $this->line('Cancelled');
            return 0;
        }

        CacheService::forget($key);
        $this->info("✓ Cache key '$key' deleted successfully");

        return 0;
    }

    /**
     * Warm up cache
     */
    protected function warmUp()
    {
        $this->info('Warming up cache...');

        try {
            // Réchauffer les catégories
            $this->line('- Warming up categories...');
            // Ajouter votre logique de réchauffage ici

            $this->line('- Warming up popular listings...');
            // Ajouter votre logique de réchauffage ici

            $this->line('- Warming up statistics...');
            // Ajouter votre logique de réchauffage ici

            $this->info('✓ Cache warmed up successfully');
            return 0;
        } catch (\Exception $e) {
            $this->error('Error during cache warm-up: ' . $e->getMessage());
            return 1;
        }
    }
}

