<?php

namespace App\Services;

use App\Events\ImportProgress;
use Illuminate\Support\Facades\Cache;

class ImportProgressService
{
    private const CACHE_KEY = 'member_import_progress';
    private const CACHE_TIMEOUT = 3600; // 1 hour

    public function initializeProgress(int $totalRecords): void 
    {
        Cache::put(self::CACHE_KEY, [
            'processed' => 0,
            'total' => $totalRecords,
            'errors' => [],
            'started_at' => now(),
        ], self::CACHE_TIMEOUT);
    }

    public function updateProgress(int $processed, ?string $status = null, array $errors = []): void
    {
        $progress = Cache::get(self::CACHE_KEY);
        
        if (!$progress) {
            return;
        }

        $progress['processed'] = $processed;
        $progress['errors'] = array_merge($progress['errors'], $errors);
        
        Cache::put(self::CACHE_KEY, $progress, self::CACHE_TIMEOUT);

        $percentComplete = round(($processed / $progress['total']) * 100);
        
        broadcast(new ImportProgress(
            $percentComplete,
            $status,
            $processed,
            $progress['total'],
            $progress['errors']
        ))->toOthers();
    }

    public function completeProgress(): void
    {
        $progress = Cache::get(self::CACHE_KEY);
        
        if ($progress) {
            broadcast(new ImportProgress(
                100,
                'Import completed',
                $progress['total'],
                $progress['total'],
                $progress['errors']
            ))->toOthers();
        }

        Cache::forget(self::CACHE_KEY);
    }

    public function failProgress(string $error): void
    {
        $progress = Cache::get(self::CACHE_KEY);
        
        if ($progress) {
            $progress['errors'][] = $error;
            broadcast(new ImportProgress(
                0,
                'Import failed: ' . $error,
                $progress['processed'],
                $progress['total'],
                $progress['errors']
            ))->toOthers();
        }

        Cache::forget(self::CACHE_KEY);
    }
}