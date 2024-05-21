<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payment_methods')->insert([
            [
                'payment_method_id' => '1',
                'name' => 'GoPay',
            ],
            [
                'payment_method_id' => '2',
                'name' => 'ShopeePay',
            ],
            [
                'payment_method_id' => '3',
                'name' => 'QRIS',
            ],
            [
                'payment_method_id' => '4',
                'name' => 'Bank Transfer',
            ],
            [
                'payment_method_id' => '5',
                'name' => 'Virtual Account',
            ],
        ]);
    }
}
