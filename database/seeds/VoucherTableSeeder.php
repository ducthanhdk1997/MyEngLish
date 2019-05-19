<?php

use Illuminate\Database\Seeder;

class VoucherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $vouchers = [
            [
                'name' => 'Khuyến mại dịp đầu năm'
            ],
            [
                'name' => 'Khuyến mại dịp mùng 8/3'
            ],

        ];

        foreach ($vouchers as $voucher)
        {
            \App\Voucher::create($voucher);
        }
    }
}
