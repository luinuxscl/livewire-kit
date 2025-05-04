<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;
use Symfony\Component\Process\Process;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'likeplatform:db:backup
                            {connection? : Nombre de la conexión de BD (opcional)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Genera un respaldo de la base de datos y lo guarda en storage/app/backups';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $connection = $this->argument('connection') ?? Config::get('database.default');
        $config = Config::get("database.connections.{$connection}");

        $timestamp = now()->format('Ymd_His');
        Storage::disk('local')->makeDirectory('backups');

        if ($config['driver'] === 'sqlite') {
            // Obtener ruta absoluta de SQLite (convierte ruta relativa)
            $dbPath = realpath($config['database']) ?: base_path($config['database']);
            if (! file_exists($dbPath)) {
                $this->error("Archivo SQLite no encontrado: {$dbPath}");
                return 1;
            }
            // Asegurar directorio de respaldos en storage/app/backups
            Storage::disk('local')->makeDirectory('backups');
            $filename = "db_backup_{$connection}_{$timestamp}.sqlite";
            $backupPath = Storage::disk('local')->path("backups/{$filename}");
            copy($dbPath, $backupPath);
            $this->info("Respaldo SQLite creado en {$backupPath}");
            return 0;
        }

        if (in_array($config['driver'], ['mysql', 'pgsql'])) {
            $backupPath = storage_path("app/backups/db_backup_{$connection}_{$timestamp}.sql");
            if ($config['driver'] === 'mysql') {
                $cmd = [
                    'mysqldump',
                    '-h', $config['host'] ?? '127.0.0.1',
                    '-P', $config['port'] ?? '3306',
                    '-u', $config['username'],
                    '-p'.$config['password'],
                    $config['database'],
                    '--single-transaction',
                    '--quick',
                    '--skip-lock-tables',
                    "--result-file={$backupPath}",
                ];
                $process = new Process($cmd);
            } else {
                $process = new Process([
                    'pg_dump',
                    '-h', $config['host'] ?? '127.0.0.1',
                    '-p', $config['port'] ?? '5432',
                    '-U', $config['username'],
                    '-F', 'c',
                    '-b',
                    '-v',
                    '-f', $backupPath,
                    $config['database'],
                ], null, ['PGPASSWORD' => $config['password']]);
            }

            $process->run();
            if (! $process->isSuccessful()) {
                $this->error('Error al generar respaldo: ' . $process->getErrorOutput());
                return 1;
            }

            $this->info("Respaldo {$config['driver']} creado en {$backupPath}");
            return 0;
        }

        $this->error("Driver '{$config['driver']}' no soportado para respaldos.");
        return 1;
    }
}
