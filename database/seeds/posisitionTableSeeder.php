<?php

use Illuminate\Database\Seeder;

class posisitionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\trDataPosisition::class, 3)->create();
    }
}
