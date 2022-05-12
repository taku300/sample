<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class SpendingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('spendings')->insert([
            'amount' => 500,
            'date' => '2022-01-01',
            'comment' => 'サンプル',
            'type_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ]);
    }
}
