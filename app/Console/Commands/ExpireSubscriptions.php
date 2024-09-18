<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use Illuminate\Console\Command;

class ExpireSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expire inactive subscriptions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Subscription::expireSubscriptions();
        $this->info('Expired subscriptions have been deactivated.');
    }
}
