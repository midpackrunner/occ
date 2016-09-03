<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // clear all previous data
        DB::table('user_profiles')->delete();
        DB::table('users')->delete();
        DB::table('roles')->delete();
        DB::table('membership_types')->delete();
        DB::table('memberships')->delete();
        DB::table('phone_numbers')->delete();
        DB::table('phone_number_user_profile')->delete();
        DB::table('interests')->delete();
        DB::table('interest_user_profile')->delete();
        DB::table('carousels')->delete();
        DB::table('announcements')->delete();
        DB::table('pets')->delete();
        DB::table('classes_details')->delete();
        DB::table('classes_details_prereqs')->delete();
        DB::table('instructors')->delete();
        DB::table('classes')->delete();
        DB::table('biographies')->delete();
        DB::table('classes_instructor')->delete();
        DB::table('breeds')->delete();
        DB::table('special_skills')->delete();
        DB::table('membership_sponsors')->delete();
        DB::table('classes_pet')->delete();
        DB::table('volunteer_hours')->delete();
        DB::table('class_attendances')->delete();
        DB::table('medical_records')->delete();
        DB::table('membership_verified_payments')->delete();
        DB::table('temp_paypal_class_signups')->delete();



        DB::table('user_profiles')->truncate();
        DB::table('users')->truncate();
        DB::table('roles')->truncate();
        DB::table('membership_types')->truncate();
        DB::table('memberships')->truncate();
        DB::table('phone_numbers')->truncate();
        DB::table('phone_number_user_profile')->truncate();
        DB::table('interests')->truncate();
        DB::table('interest_user_profile')->truncate();
        DB::table('carousels')->truncate();
        DB::table('announcements')->truncate();
        DB::table('pets')->truncate();
        DB::table('classes_details')->truncate();
        DB::table('classes_details_prereqs')->truncate();
        DB::table('instructors')->truncate();
        DB::table('classes')->truncate();
        DB::table('biographies')->truncate();
        DB::table('classes_instructor')->truncate();
        DB::table('breeds')->truncate();
        DB::table('special_skills')->truncate();
        DB::table('membership_sponsors')->truncate();
        DB::table('classes_pet')->truncate();
        DB::table('volunteer_hours')->truncate();
        DB::table('class_attendances')->truncate();
        DB::table('medical_records')->truncate();
        DB::table('membership_verified_payments')->truncate();
        DB::table('temp_paypal_class_signups')->truncate();
        


        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        // $this->call(UsersTableSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(UserAndUserProfileSeeder::class);
        $this->call(ProdMemberships::class);            // Prod
        $this->call(ProdUserandUserProfile::class);     // Prod
        $this->call(MembershipSeeder::class);
        $this->call(PhoneNumberSeeder::class);
        $this->call(InterestSeeder::class);
        $this->call(CarouselSeeder::class);
        $this->call(AnnouncementSeeder::class);
        $this->call(PetSeeder::class);
        $this->call(ClassesDetailsSeeder::class);
        $this->call(BiographySeeder::class);
        $this->call(InstructorSeeder::class);           // Prod
        $this->call(ClassSeeder::class);
        $this->call(BreedsSeeder::class);
        $this->call(SpecialSkillSeeder::class);
        $this->call(VolunteerHourSeeder::class);
        $this->call(MedicalRecordSeeder::class);
        $this->call(MembershipVerifiedPaymentsSeeder::class);




    }
}
