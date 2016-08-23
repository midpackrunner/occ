<?php

use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('announcements')->insert([
            'title' => 'Current Registration',
            'description' => 'Registration for the next session is now open for classes beginning the week of May 23rd.',
            'publish_on' => Carbon\Carbon::now(),
            'remove_on' => '2016-07-10'
        ]);
        DB::table('announcements')->insert([
            'title' => 'Starting in September 2014',
            'description' => 'we will require all non-Full Members to pay an annual $5 Student Membership fee. This is to comply with IRS requirements that 501C7 Services are offered to members only. Thank you for your understanding',
            'publish_on' => Carbon\Carbon::now(),
            'remove_on' => '2020-07-10'
        ]);
        DB::table('announcements')->insert([
            'title' => '2015 Rally and Obedience',
            'description' => 'Our fall obedience trial will be held October 17th and 18th at Play Dog Excellent: which is located at 4113 Dayton Blvd., Chattanooga, TN 37415.',
            'publish_on' => Carbon\Carbon::now(),
            'remove_on' => '2016-07-10'
        ]);

    }
}
