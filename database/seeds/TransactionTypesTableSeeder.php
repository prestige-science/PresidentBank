<?php

use Illuminate\Database\Seeder;

class TransactionTypesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $types = [
            'Deposit', 'Funds Transfer', 'Withdrawal'
        ];

        $insert = [];

        foreach ($types as $type) {
            $insert [] = [
                'name' => $type,
            ];
        }

        DB::table('transaction_types')->insert($insert);
    }

}
