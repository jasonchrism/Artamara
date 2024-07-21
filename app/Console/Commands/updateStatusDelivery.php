<?php

namespace App\Console\Commands;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class updateStatusDelivery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-status-delivery';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'auto update status order from shipment to delivered after 30 seconds';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $orders = Order::where('status', '=', 'SHIPPING')->get();
        foreach ($orders as $order) {
            $newOrder = Order::find($order->order_id);
            $timestamp = Carbon::parse($newOrder->updated_at);
            $currentTime = Carbon::now();
            $diffInSeconds = $currentTime->diffInSeconds($timestamp, false);
            if($diffInSeconds <= -30){
                $newOrder->status = "DELIVERED";
                $newOrder->save();
            }
        }
    }
}
