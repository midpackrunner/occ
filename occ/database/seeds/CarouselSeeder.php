<?php

use Illuminate\Database\Seeder;

class CarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
        DB::table('carousels')->insert([
            'header' => 'Congratulations',
            'caption' => 'Molly, Bane, Rocko, Chubb and Wilson!'
        ]);

        DB::table('carousels')->insert([
            'header' => 'Congratulations',
            'caption' => 'STAR puppy grads!!!'
        ]);

        DB::table('carousels')->insert([
            'header' => 'Fergie!',
            'caption' => 'The Papillon!!!'
        ]);
    }
}
