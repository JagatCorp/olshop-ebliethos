<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use File;

class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup Database';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $filename = "backup-" . Carbon::now()->format('Y-m-d-H-i') . ".sql";
        $command = "mysqldump --user=" . config("database.connections.mysql.username") ." --password=" . config("database.connections.mysql.password") . " --host=" . config("database.connections.mysql.host") . " " . config("database.connections.mysql.database") . " > " .  storage_path() . "/app/backup/" . $filename;
        $returnVar = NULL;
        $output  = NULL;
        exec($command);
    }
}
