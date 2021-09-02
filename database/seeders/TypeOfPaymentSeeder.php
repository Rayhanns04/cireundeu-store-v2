<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeOfPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_of_payments')->insert(
            [
                [
                    'name' => 'Bank Transfer',
                ],
                [
                    'name' => 'Ovo Payment',
                ],
                [
                    'name' => 'COD (Cash on Delivery)',
                ],
            ]
        );
    }
}
