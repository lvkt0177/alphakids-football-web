<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CleanupActivityGalleryTemp extends Command
{
    protected $signature = 'activity:cleanup-gallery-temp';

    protected $description = 'Delete activity gallery temp uploads older than 24h that were never saved to an activity';

    public function handle(): int
    {
        $disk = Storage::disk('public');
        $cutoff = now()->subDay()->getTimestamp();
        $deleted = 0;

        foreach ($disk->files('activity/gallery-temp') as $path) {
            if ($disk->lastModified($path) < $cutoff) {
                $disk->delete($path);
                $deleted++;
            }
        }

        $this->info("Deleted {$deleted} abandoned gallery temp upload(s).");

        return self::SUCCESS;
    }
}
