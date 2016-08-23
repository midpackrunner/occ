<?php

use Illuminate\Database\Seeder;

class ClassesDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create the Classes
		App\ClassesDetail::create([
	        'title' => 'Better Beginning Babies',
	        'description' => 'This class is for puppies 8 weeks to 1 year. It is aimed at building a bond between you and your puppy; laying a foundation for a confident and well-mannered dog; socializing your puppy to other people, places and dogs; introducing basic obedience commands; and solving problems.',
	        'cost' => 80.00,
	        'is_active' => 1,
	        'minimum_age_requirement' => 2.00,
	        'maximum_age_requirement' => 12.00,
		]);

		App\ClassesDetail::create([
	        'title' => 'AKC S.T.A.R. Puppy',
	        'description' => 'This class is for puppies 5 months to 1 year. It is designed to get new puppy owners and their puppies off to a great start by socializing (S) your puppy with other puppies, by training (T) you how to best communicate with your puppy, by teaching you about the amount of exercise and activity (A) your puppy needs, and by teaching you how to be a responsible (R) puppy owner.',
	        'cost' => 80.00,
	        'is_active' => 1,
	        'minimum_age_requirement' => 5.00,
	        'maximum_age_requirement' => 12.00,
		]);

		App\ClassesDetail::create([
	        'title' => 'Advanced Puppy Obedience',
	        'description' => 'This class is for puppies 6 months to 18 months. It is designed to teach leadership, basic obedience (sit, down, come, heel, and stay) and advanced social skills.',
	        'cost' => 80.00,
	        'is_active' => 1,
	        'minimum_age_requirement' => 6.00,
	        'maximum_age_requirement' => 18.00,
		]);
		App\ClassesDetail::create([
	        'title' => 'Beginner Obedience I',
	        'description' => 'This class is for dogs 1 year and older. It introduces you and your dog to the basic obedience commands of sit, down, stay, come, leave it, and walking on a loose leash which make living with your dog easier. You will begin to learn leadership and social skills.',
	        'cost' => 80.00,
	        'is_active' => 1,
	        'minimum_age_requirement' => 12.00,
	        'maximum_age_requirement' => 900.00,
		]);

		App\ClassesDetail::create([
	        'title' => 'Beginner Obedience II',
	        'description' => 'In this class we will continue to work on the relationship between you and your dog. We will also improve your dog\'s ability to sit, down, come, stay, heel on a loose leash, etc. We will begin to ask your dog to perform these behaviors under increasingly distracting circumstances. Dog-handler teams develop skills needed to progress to other classes such as CGC, Rally, Competition Obedience, and Agility.',
	        'cost' => 80.00,
	        'is_active' => 1,
	        'minimum_age_requirement' => 12.00,
	        'maximum_age_requirement' => 900.00,
		]);

		App\ClassesDetail::create([
	        'title' => 'Beginner Rally Obedience',
	        'description' => 'This class will teach you and your dog the skills they need to compete in the AKC Beginner Novice, Pre-Novice and Beginning Rally classes and obtain a title. All skills are on leash except the recall. Rally signs will be introduced and the basic skills that a handler/dog team need in order to compete successfully will be taught, if one wishes to do so. This class is also great for those who simply want to continue to build on the skills that they have learned in previous classes. This skills include loose leash heeling with sits and downs on command, long stays, turns, recalls and sitting for an exam.',
	        'cost' => 80.00,
	        'is_active' => 1,
	        'minimum_age_requirement' => 12.00,
	        'maximum_age_requirement' => 900.00,
		]);

		App\ClassesDetail::create([
	        'title' => 'Rally Obedience Workshop',
	        'description' => 'This class continues to emphasize the enjoyment of teamwork and communication as dog and handler team learns more signs and practices more courses for fun or competition at all levels and is a link from CGC to obedience and agility. We will not only continue to work on heeling and basic Rally coursework but we will also learn the skills needed in order to successfully navigate more advanced Rally courses. Not only will your dogs continue to hone the skills she already knows, but she will begin to learn more novel skills like some distance work and backing up on command. These classes will be taught seminar-style, beginning at 10:30 a.m.; break for lunch and relaxing at 12:00; afternoon class will begin at 1:30 and continue until 3:00pm.',
	        'cost' => 80.00,
	        'is_active' => 1,
	        'minimum_age_requirement' => 12.00,
	        'maximum_age_requirement' => 900.00,
		]);

		App\ClassesDetail::create([
	        'title' => 'Rally Obedience',
	        'description' => 'Need Description',
	        'cost' => 80.00,
	        'is_active' => 1,
	        'minimum_age_requirement' => 12.00,
	        'maximum_age_requirement' => 900.00,
		]);

		App\ClassesDetail::create([
	        'title' => 'Competition Obedience',
	        'description' => 'Need Description',
	        'cost' => 80.00,
	        'is_active' => 1,
	        'minimum_age_requirement' => 12.00,
	        'maximum_age_requirement' => 900.00,
		]);

//
		App\ClassesDetail::create([
	        'title' => 'Canine Good Citizen',
	        'description' => 'This class is for those who would like to earn an AKC Canine Good Citizen (CGC) certification or title. Dog must be at least six months of age to be CGC tested. This class teaches your dog to sit politely for petting and grooming, walk on a loose leash through a crowd, sit and down and stay on command, come when called, behave politely around a stranger or another dog, and be confident when facing distractions or being left with a trusted person. AKC charges $8 to register after passing the test. The OCC charges $10 for non members who are not in the CGC class. NOTE THIS WILL BE A COMBINATION COURSE WITH THERAPY DOG.',
	        'cost' => 80.00,
	        'is_active' => 1,
	        'minimum_age_requirement' => 6.00,
	        'maximum_age_requirement' => 900.00,
		]);

		App\ClassesDetail::create([
	        'title' => 'Therapy Dog',
	        'description' => 'Need description',
	        'cost' => 80.00,
	        'is_active' => 1,
	        'minimum_age_requirement' => 6.00,
	        'maximum_age_requirement' => 900.00,
		]);
		App\ClassesDetail::create([
	        'title' => 'Beginner Agility',
	        'description' => 'Must know sit, stay, come, and OK. Emphasis on fun, exercise, and safety on an agility course while learning how to do tunnels, the tire, hoops, the chute, beginner weave poles, and jumps. New obstacles will include the A-frame, dog walk, teeter, and the table as well as those learned in Fun Circles. Basic obedience will continue to be emphasized. You will be sequencing 3-5 obstacles by the end of this class. Will continue to emphasize basic obedience. (This is a combination of what use to be called Fun Circles and Fun Contacts)',
	        'cost' => 90.00,
	        'is_active' => 1,
	        'minimum_age_requirement' => 6.00,
	        'maximum_age_requirement' => 900.00,
		]);
		App\ClassesDetail::create([
	        'title' => 'Beginner Agility II',
	        'description' => 'to do',
	        'cost' => 90.00,
	        'is_active' => 1,
	        'minimum_age_requirement' => 6.00,
	        'maximum_age_requirement' => 900.00,
		]);
		App\ClassesDetail::create([
	        'title' => 'Intermediate Agility',
	        'description' => 'to do',
	        'cost' => 90.00,
	        'is_active' => 1,
	        'minimum_age_requirement' => 6.00,
	        'maximum_age_requirement' => 900.00,
		]);
		App\ClassesDetail::create([
	        'title' => 'Agility Beginner Comp. A',
	        'description' => 'to do',
	        'cost' => 90.00,
	        'is_active' => 1,
	        'minimum_age_requirement' => 6.00,
	        'maximum_age_requirement' => 900.00,
		]);
		App\ClassesDetail::create([
	        'title' => 'Agility Beginner Comp. B',
	        'description' => 'to do',
	        'cost' => 90.00,
	        'is_active' => 1,
	        'minimum_age_requirement' => 6.00,
	        'maximum_age_requirement' => 900.00,
		]);
		App\ClassesDetail::create([
	        'title' => 'Agility Novice Comp',
	        'description' => 'to do',
	        'cost' => 90.00,
	        'is_active' => 1,
	        'minimum_age_requirement' => 6.00,
	        'maximum_age_requirement' => 900.00,
		]);
		App\ClassesDetail::create([
	        'title' => 'Agility Advanced Comp',
	        'description' => 'to do',
	        'cost' => 90.00,
	        'is_active' => 1,
	        'minimum_age_requirement' => 6.00,
	        'maximum_age_requirement' => 900.00,
		]);
		App\ClassesDetail::create([
	        'title' => 'Agility Master Comp',
	        'description' => 'to do',
	        'cost' => 90.00,
	        'is_active' => 1,
	        'minimum_age_requirement' => 6.00,
	        'maximum_age_requirement' => 900.00,
		]);

		App\ClassesDetail::create([
	        'title' => 'Intermediate Obedience',
	        'description' => 'to do',
	        'cost' => 80.00,
	        'is_active' => 1,
	        'minimum_age_requirement' => 6.00,
	        'maximum_age_requirement' => 900.00,
		]);

		App\ClassesDetail::create([
	        'title' => 'Puppy Agility',
	        'description' => 'to do',
	        'cost' => 90.00,
	        'is_active' => 1,
	        'minimum_age_requirement' => 5.00,
	        'maximum_age_requirement' => 12.00,
		]);

		App\ClassesDetail::create([
	        'title' => 'CGC Prep',
	        'description' => 'to do',
	        'cost' => 80.00,
	        'is_active' => 1,
	        'minimum_age_requirement' => 6.00,
	        'maximum_age_requirement' => 900.00,
		]);

		// attach pre reqs.
		$better_begin = App\ClassesDetail::where('title', '=' , 'Better Beginning Babies')->first();
		$star_pup = App\ClassesDetail::where('title', '=' , 'AKC S.T.A.R. Puppy')->first();
		$star_pup->pre_reqs()->attach($better_begin);

		$adv_pup= App\ClassesDetail::where('title', '=' , 'Advanced Puppy Obedience')->first();
		$adv_pup->pre_reqs()->attach($star_pup);

		$begin_obd_1= App\ClassesDetail::where('title', '=' , 'Beginner Obedience I')->first();
		$begin_obd_2= App\ClassesDetail::where('title', '=' , 'Beginner Obedience II')->first();
		$begin_obd_2->pre_reqs()->attach($begin_obd_1);

		$canine_good_citizen= App\ClassesDetail::where('title', '=' , 'Canine Good Citizen')->first();
		$canine_good_citizen->pre_reqs()->attach($begin_obd_2);

		$therapy_dog= App\ClassesDetail::where('title', '=' , 'Therapy Dog')->first();
		$therapy_dog->pre_reqs()->attach($canine_good_citizen);

		$beg_rally_obed= App\ClassesDetail::where('title', '=' , 'Beginner Rally Obedience')->first();
		$beg_rally_obed->pre_reqs()->attach($begin_obd_2);
		$beg_rally_obed->pre_reqs()->attach($therapy_dog);
		$beg_rally_obed->pre_reqs()->attach($canine_good_citizen);


		$rally_obed = App\ClassesDetail::where('title', '=' , 'Rally Obedience')->first();
		$rally_obed->pre_reqs()->attach($beg_rally_obed);
		
		$comp_obed= App\ClassesDetail::where('title', '=' , 'Competition Obedience')->first();
		$comp_obed->pre_reqs()->attach($rally_obed);
		
		// Agility classes
		$begin_agil_1= App\ClassesDetail::where('title', '=' , 'Beginner Agility')->first();
		$begin_agil_1->pre_reqs()->attach($begin_obd_1);
		$begin_agil_1->pre_reqs()->attach($adv_pup);

		$begin_agil_2= App\ClassesDetail::where('title', '=' , 'Beginner Agility II')->first();
		$begin_agil_2->pre_reqs()->attach($begin_agil_1);

		$inter_agil= App\ClassesDetail::where('title', '=' , 'Intermediate Agility')->first();
		$inter_agil->pre_reqs()->attach($begin_agil_2);

		$agil_begin_comp_a= App\ClassesDetail::where('title', '=' , 'Agility Beginner Comp. A')->first();
		$agil_begin_comp_a->pre_reqs()->attach($inter_agil);

		$agil_begin_comp_b= App\ClassesDetail::where('title', '=' , 'Agility Beginner Comp. B')->first();
		$agil_begin_comp_b->pre_reqs()->attach($agil_begin_comp_a);


		$agil_novice_comp= App\ClassesDetail::where('title', '=' , 'Agility Novice Comp')->first();
		$agil_novice_comp->pre_reqs()->attach($agil_begin_comp_b);

		$agil_adv_comp = App\ClassesDetail::where('title', '=' , 'Agility Advanced Comp')->first();
		$agil_adv_comp->pre_reqs()->attach($agil_novice_comp);

		$agil_master_compp= App\ClassesDetail::where('title', '=' , 'Agility Master Comp')->first();
		$agil_master_compp->pre_reqs()->attach($agil_novice_comp);


		
			
    }
}
