<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;

class ChangePasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'passwords:change';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change user passwords weekly';

    /**
     * Execute the console command.
     */

        public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Mengambil semua pengguna yang memerlukan perubahan kata sandi
        $users = User::all();

        foreach ($users as $user) {
            // Memeriksa apakah sudah seminggu sejak terakhir kali diubah kata sandi
            $lastPasswordChange = $user->password_changed_at;
            $oneWeekAgo = Carbon::now()->subWeek();

            if ($lastPasswordChange === null || $lastPasswordChange < $oneWeekAgo) {
                // Mengubah kata sandi pengguna
                $newPassword = 'generateNewPassword'; // Generate password baru di sini

                $user->password = $newPassword;
                $user->password_changed_at = Carbon::now();
                $user->save();

                // Menambahkan log atau pesan ke dalam log aplikasi
                $this->info("Password changed for user: {$user->email}");
            }
        }

        $this->info('Weekly password change task completed successfully.');
    }
}
