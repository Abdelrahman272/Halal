<?php

namespace App\Console\Commands;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateCouponStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $coupons = Coupon::where('status', 'active')->get();

        foreach ($coupons as $coupon)
        {
            if (Carbon::now()->gt($coupon->end_date))
            {
                $coupon->status = 'expired';
                $coupon->update();
            }
        }
    }
}
