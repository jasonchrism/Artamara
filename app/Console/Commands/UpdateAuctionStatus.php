<?php

namespace App\Console\Commands;
use App\Models\ProductAuction;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateAuctionStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auction:update-status';
    protected $description = 'Update the status of auctions based on start and end times';

    public function __construct()
    {
        parent::__construct();
    }

        public function handle()
        {
            $now = Carbon::now('Asia/Jakarta');

            // Update auctions that are about to start
            $startingSoonAuctions = ProductAuction::where('status', 'STARTING SOON')
                ->where('start_date', '<=', $now)
                ->where('end_date', '>', $now)
                ->get();

            foreach ($startingSoonAuctions as $auction) {
                $auction->status = 'ON GOING';
                $auction->save();
            }

            // Update auctions that are ongoing and should be ended
            $ongoingAuctions = ProductAuction::where('status', 'ON GOING')
                ->where('end_date', '<=', $now)
                ->get();

            foreach ($ongoingAuctions as $auction) {
                $auction->status = 'CLOSED';
                $auction->save();
            }

            // Update auctions that are paid (this logic should already be handled when an auction is paid)

            $this->info('Auction statuses updated successfully.');
        }
}
