<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
class RunScheduler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:scheduler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Laravel scheduler in a loop without system cron';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Scheduler started...');

        while (true) {
            Artisan::call('schedule:run');
            sleep(60); // Run every minute (adjust as needed)
        }
    }
}
