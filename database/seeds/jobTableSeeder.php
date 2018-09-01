<?php

use Illuminate\Database\Seeder;

class jobTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\trDataJobDesc::class, 6)->create();
    }
}
