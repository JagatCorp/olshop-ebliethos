<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DatabaseRestore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:restore';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Restore Database';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        //
        // $username = config("database.connections.mysql.username");
        // $password = config("database.connections.mysql.password");
        // $database = config("database.connections.mysql.database");
        // $files = Storage::disk('local')->allFiles('backup');
        // $filename = $files[0];
        // if(strlen($password) <= 0){
        //     $command = "mysql -u ".$username." backup_one < ".  storage_path() . "/app/" . $filename;
        // }else{
        //     $command = "mysql -u ".$username." -p ".$password." ".$database." < ".  storage_path() . "/app/" . $filename;
        // }
        // exec($command);
    }
}
