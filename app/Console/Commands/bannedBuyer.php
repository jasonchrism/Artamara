<?php

namespace App\Console\Commands;

use App\Models\Bid;
use App\Models\ProductAuction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class bannedBuyer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:banned-buyer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'auto update status buyer to inactive after bid and run';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $productAuctions = ProductAuction::where('status', '=', 'CLOSED')->get();
        foreach ($productAuctions as $productAuction) {
            $bid = $productAuction->bid()->orderBy('bid_price', 'desc')->first();
            if (isset($bid)) {
                $buyerWon = $bid->user_id;
                $timestamp = Carbon::parse($productAuction->updated_at);
                $currentTime = Carbon::now();
                $diffInMinutes = $currentTime->diffInMinutes($timestamp, false);
                
                if($diffInMinutes <= -1 && $bid->status != 'PAID'){
                    $buyer = User::find($buyerWon);
                    $buyer->status = 'INACTIVE';
                    $buyer->save();
                }
            }
        }
    }
}
