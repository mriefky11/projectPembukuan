<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class BackupController extends Controller
{
    public function index()
    {
        $lastBackup = null;

        if (Storage::disk('local')->exists('backups/last_backup.txt')) {
            $lastBackup = Storage::disk('local')->get('backups/last_backup.txt');
        }

        return view('backup.index', compact('lastBackup'));
    }

    public function run(Request $request)
    {
        try {
            $fileName = 'backup-' . date('Y-m-d_H-i-s') . '.sql';
            $path = storage_path('app/backups/' . $fileName);

            $dbHost = env('DB_HOST');
            $dbUser = env('DB_USERNAME');
            $dbPass = env('DB_PASSWORD');
            $dbName = env('DB_DATABASE');

            $mysqlPath = 'C:\xampp\mysql\bin\mysqldump.exe';

            if (!empty($dbPass)) {
                $command = "\"{$mysqlPath}\" -h {$dbHost} -u {$dbUser} -p{$dbPass} {$dbName} > \"{$path}\"";
            } else {
                $command = "\"{$mysqlPath}\" -h {$dbHost} -u {$dbUser} {$dbName} > \"{$path}\"";
            }

            $output = null;
            $returnVar = null;
            exec($command, $output, $returnVar);

            if ($returnVar !== 0) {
                throw new \Exception('Backup gagal. Cek ruang penyimpanan atau hak akses.');
            }

            Storage::disk('local')->put('backups/last_backup.txt', now()->toDateTimeString());

            return response()->download($path)->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            Log::error('Backup gagal: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Backup data gagal. Silakan periksa log sistem atau hubungi administrator.');
        }
    }
}

