<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ListDatabaseBackups extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'likeplatform:db:list-backups';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listar archivos de respaldo en storage/app/backups';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $files = Storage::disk('local')->files('backups');
        if (empty($files)) {
            $this->info('No se encontraron archivos de respaldo en storage/app/backups.');
            return 0;
        }

        $data = [];
        foreach ($files as $file) {
            $size = Storage::disk('local')->size($file);
            $modified = date('Y-m-d H:i:s', Storage::disk('local')->lastModified($file));
            $data[] = [
                basename($file),
                number_format($size / 1024, 2) . ' KB',
                $modified,
            ];
        }

        $this->table(['Archivo', 'Tamaño', 'Modificado'], $data);
        return 0;
    }
}
