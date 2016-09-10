<?php

use Illuminate\Database\Seeder;

class ProdRevenueResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\RevenueResource::create([ 'resource' => 'Newspaper']);
        App\RevenueResource::create([ 'resource' => 'Web Site']);
        App\RevenueResource::create([ 'resource' => 'Drive By']);
        App\RevenueResource::create([ 'resource' => 'Vet']);
        App\RevenueResource::create([ 'resource' => 'Word of Mouth']);
        App\RevenueResource::create([ 'resource' => 'Member or Instructor at OCC']);
        App\RevenueResource::create([ 'resource' => 'Other']);

    }
}
