<?php

use Illuminate\Database\Seeder;

class DetailVoucherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $voucher = factory(\App\Detail_Voucher::class,30)->state('10')->create();
        $voucher = factory(\App\Detail_Voucher::class,30)->state('15')->create();
        $voucher = factory(\App\Detail_Voucher::class,30)->state('20')->create();
        $voucher = factory(\App\Detail_Voucher::class,30)->state('50')->create();
        $voucher = factory(\App\Detail_Voucher::class,10)->state('100')->create();
    }
}
