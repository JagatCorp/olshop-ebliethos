<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class DatabaseController extends Controller
{
    public function index()
    {
        $files = Storage::disk('local')->allFiles('backup');
        return view("admin.database.index", compact('files'));
    }
    public function createBackup()
    {
        Artisan::call("database:backup");
        $backupFileName = "backup-" . Carbon::now()->format('Y-m-d-H-i') . ".sql";
        return redirect(url('admin/database'))->with('toast_success', 'Backup database berhasil dibuat: ' . $backupFileName);
    }

    public function database_backup_download($file)
    {
        return response()->download(storage_path('app/backup/' . $file));
    }
    public function database_backup_remove($file)
    {
        unlink(storage_path('/app/backup/' . $file));
        session()->flash('msg_status', 'success');
        session()->flash('msg', "<strong>Berhasil</strong> <br> File Backup Basis Data Berhasil Dihapus.");
        return redirect(url('leader/database'));
    }
}
