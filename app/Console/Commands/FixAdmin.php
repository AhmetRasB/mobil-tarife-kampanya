<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FixAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Admin kullanıcısının yetkilerini düzeltir';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Admin kullanıcısını bulup is_admin değerini 1 olarak ayarla
        $admin = DB::table('users')->where('email', 'admin@admin.com')->first();
        
        if ($admin) {
            DB::table('users')
                ->where('id', $admin->id)
                ->update([
                    'is_admin' => 1
                ]);
                
            $this->info("Admin kullanıcısı güncellendi. ID: {$admin->id}");
        } else {
            $this->error('Admin kullanıcısı bulunamadı.');
        }
        
        // Tüm kullanıcıları göster
        $users = DB::table('users')->get();
        
        $this->info('Sistemdeki kullanıcılar:');
        foreach ($users as $user) {
            $this->line("ID: {$user->id}, Adı: {$user->name}, Email: {$user->email}, Admin: " . ($user->is_admin ? 'Evet' : 'Hayır'));
        }
        
        return Command::SUCCESS;
    }
}
