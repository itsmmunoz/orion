<?php

namespace App\Modules\MoonLaunch\Console\Commands;

use Illuminate\Console\Command;

class LaunchInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'launch:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install and configure moonshine launch package';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔧 Generating application key...');
        $this->call('key:generate');

        $this->info('📦 Running migrations...');
        $this->call('migrate');

        $this->info('🔐 Generating permissions...');
        $this->call('launch:permissions');

        $this->info('👤 Creating Super Admin user...');
        $this->call('moonshine-rbac:user');

        $this->info('✅ MoonLaunch installed successfully.');
    }
}
