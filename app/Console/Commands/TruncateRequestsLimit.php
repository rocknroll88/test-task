<?php

namespace App\Console\Commands;

use App\Models\Merchant;
use Illuminate\Console\Command;

class TruncateRequestsLimit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'limits:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily renew limits requests from gateway';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Merchant::where('request_count', '!=', 0)->update(['request_count' => 0]);
    }
}
