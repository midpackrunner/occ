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
	        'title' => 'Puppy Agility',
	        'description' => 'Prerequisite:  Puppies must be 8 weeks old and have two sets of puppy shots.  The purpose of this class is to introduce handlers and puppies to the foundation skills needed for beginning agility. The class structure will be based on games to introduce movement and different surfaces. Activities such as targeting, front and rear end awareness, introducing ending behaviors for the contact equipment, flat work skills, beginning work with two by two weaves and basic obedience skills such as sit, down, stay, will be some of the activities offered in the class.
Most work will be on lead, so puppies must be fitted with a flat buckle collar and a six-foot leash. No choke, pinch, gentle leaders or corrective harnesses will be allowed. Owners need to bring lots of soft treats and a crate. Also may want to bring water/Gatorade/PowerAde and a portable fan for dog/puppy crates.  Teams may repeat Puppy Agility or take an obedience course until they reach 5 months in age in order to qualify for the Agility 1 – Foundations.',
	        'cost' => 90.00,
	        'is_active' => 1,
	        'minimum_age_requirement' => 5.00,
	        'maximum_age_requirement' => 12.00,
		]);
		App\ClassesDetail::create([
	        'title' => 'Beginner Obedience 1',
	        'description' => 'This class is for dogs 1 year and older. It introduces you and your dog to the basic obedience commands of sit, down, stay, come, leave it, and walking on a loose leash which make living with your dog easier. You will begin to learn leadership and social skills.',
	        'cost' => 80.00,
	        'is_active' => 1,
	        'minimum_age_requirement' => 12.00,
	        'maximum_age_requirement' => 900.00,
		]);

		App\ClassesDetail::create([
	        'title' => 'Beginner Obedience 2',
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
	        'title' => 'Freestyle',
	        'description' => 'CanineFreestyle DogWork® is a performance activity for dog and human teams. Teams train movement behaviors technically, creatively and artistically. The objective is to illustrate the delight of working as a team and to participate with others in a friendly environment learning to craft DogWork Presentations. This beginning class will teach movement concepts and suggest ways for each team to build a movement vocabulary. Also taught will be basic choreography to begin crafting the DogWork Presentation. Dogs should already be able to heel, come and stay. Off-lead work is ideal, but on-lead is permissible. Handlers should wear close-toed shoes with backs and be prepared to get on the floor. Lots of high-value treats are a must. To see examples of teams performing in this sport visit http://www.canine-freestyle.org/.',
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
	        'title' => 'Agility 1 Foundations',
	        'description' => 'The purpose of this class is to introduce handlers and dogs to basic agility skills and safety. The class structure will be based on shaping behaviors through the use of clicker training. Activities such as targeting, flat work skills, beginning work with two by two weaves, and contact work will be some of the activities offered in the class.  Most work will be on lead, so dogs must be fitted with a flat buckle collar and a six-foot leash. No choke, pinch, gentle leaders or corrective harnesses will be allowed. Owners need to bring lots of soft treats and a crate. Also may want to bring water/Gatorade/PowerAde and a portable fan for dog/puppy crates.',
	        'cost' => 90.00,
	        'is_active' => 1,
	        'minimum_age_requirement' => 6.00,
	        'maximum_age_requirement' => 900.00,
		]);
		App\ClassesDetail::create([
	        'title' => 'Agility 2 Beginner',
	        'description' => 'The purpose of this class is to continue skills learned in Agility Foundation. Along with proofing targeting, contact and flat work skills, the teams will begin short sequences and handling drills.  While some work will be on lead, most of the course work will be off lead, so owners must provide a crate for their dog. Dogs must be fitted with a flat buckle collar and a six-foot leash. No choke, pinch, gentle leaders or corrective harnesses will be allowed.  Owners need to bring lots of soft treats and a crate. Also may want to bring water/Gatorade/PowerAde and a portable fan for dog/puppy crates.  Teams should expect to repeat Agility 2 – Beginning.',
	        'cost' => 90.00,
	        'is_active' => 1,
	        'minimum_age_requirement' => 6.00,
	        'maximum_age_requirement' => 900.00,
		]);
		App\ClassesDetail::create([
	        'title' => 'Agility 3 Intermediate',
	        'description' => 'The purpose of this class is to polish skills learned in Beginning Agility and to ready teams to compete in the AKC ACT 1 and 2 Agility Trials. Sequences, handling skills and course work will be a major portion of this class. This course will be primarily off lead, so owners must provide a crate for their dog. Dogs must be fitted with a flat buckle collar and a six-foot leash. No choke, pinch, gentle leaders or corrective harnesses will be allowed. Owners need to bring lots of soft treats and a crate. Also may want to bring water/Gatorade/PowerAde and a portable fan for dog/puppy crates.  Teams should expect to repeat Agility 3 – Intermediate if they are not able to successfully complete the AKC ACT 1 and 2 trials',
	        'cost' => 90.00,
	        'is_active' => 1,
	        'minimum_age_requirement' => 6.00,
	        'maximum_age_requirement' => 900.00,
		]);
		App\ClassesDetail::create([
	        'title' => 'Competition Agility Novice',
	        'description' => 'The purpose of this class is to ready the agility teams for AKC Novice Agility. Handling skills, contacts, weaves, etc. will be proofed. Sequences and course work will make up the majority of the class. This course is available to all teams that have previously competed in agility trials or successfully competed in the AKC ACT 1 and 2 trials.  This course will be off lead, so owners must provide a crate for their dog. Dogs must be fitted with a flat buckle collar and a six-foot leash. No choke, pinch, gentle leaders or corrective harnesses will be allowed.. Owners need to bring lots of soft treats and a crate. Also may want to bring water/Gatorade/PowerAde and a portable fan for dog/puppy crates',
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
	        'title' => 'Competition Agility Open/Excellence/Masters',
	        'description' => 'Prerequisite: Novice or Open/Excellent/Masters level completion experience. The purpose of this class is to ready the agility teams for AKC Open/Excellent/Master Agility. Handling skills, contacts, weaves, etc. will be proofed. Sequences and course work will make up the majority of the class. This course is available to all teams that have previously competed in agility trials at the Open/Excellent/Masters level or have completed the Novice Competition class.  This course will be off lead, so owners must provide a crate for their dog. Dogs must be fitted with a flat buckle collar and a six-foot leash. No choke, pinch, gentle leaders or corrective harnesses will be allowed.  Owners need to bring lots of soft treats and a crate. Also may want to bring water/Gatorade/PowerAde and a portable fan for dog/puppy crates. ',
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
	        'title' => 'CGC Prep',
	        'description' => '(3 weeks only - first two prep for test and third is the test)
Prerequisite Intermediate Obedience. This class is for those who would like to earn an AKC Canine Good Citizen (CGC) certification or title. This class is strictly designed to provide you the opportunity to work with your dog for two sessions on the test elements prior to taking the CGC Test during the third class.  (Dog must be at least six months of age to be CGC tested. AKC charges $8 to register for the CGC certification after passing the test.  OCC charges $10 for non members who are not in the Intermediate Obedience class.)',
	        'cost' => 55.00,
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

		$pup_agil = App\ClassesDetail::where('title', '=' , 'Puppy Agility')->first();

		$begin_obd_1= App\ClassesDetail::where('title', '=' , 'Beginner Obedience 1')->first();
		$begin_obd_2= App\ClassesDetail::where('title', '=' , 'Beginner Obedience 2')->first();
		$begin_obd_2->pre_reqs()->attach($begin_obd_1);



		$therapy_dog= App\ClassesDetail::where('title', '=' , 'Therapy Dog')->first();

		$beg_rally_obed= App\ClassesDetail::where('title', '=' , 'Beginner Rally Obedience')->first();
		$beg_rally_obed->pre_reqs()->attach($begin_obd_2);
		$beg_rally_obed->pre_reqs()->attach($therapy_dog);



		$rally_obed = App\ClassesDetail::where('title', '=' , 'Rally Obedience')->first();
		$rally_obed->pre_reqs()->attach($beg_rally_obed);
		
		$comp_obed= App\ClassesDetail::where('title', '=' , 'Competition Obedience')->first();
		$comp_obed->pre_reqs()->attach($rally_obed);
		
		// Agility classes
		$agil_1_found= App\ClassesDetail::where('title', '=' , 'Agility 1 Foundations')->first();
		$agil_1_found->pre_reqs()->attach($better_begin);
		$agil_1_found->pre_reqs()->attach($star_pup);
		$agil_1_found->pre_reqs()->attach($begin_obd_1);
		$agil_1_found->pre_reqs()->attach($pup_agil);



		$begin_agil_2= App\ClassesDetail::where('title', '=' , 'Agility 2 Beginner')->first();
		$begin_agil_2->pre_reqs()->attach($agil_1_found);

		$inter_agil= App\ClassesDetail::where('title', '=' , 'Agility 3 Intermediate')->first();
		$inter_agil->pre_reqs()->attach($begin_agil_2);

		$comp_agil_nov= App\ClassesDetail::where('title', '=' , 'Agility 3 Intermediate')->first();
		$comp_agil_nov->pre_reqs()->attach($begin_agil_2);

		$agil_begin_comp_a= App\ClassesDetail::where('title', '=' , 'Competition Agility Novice')->first();
		$agil_begin_comp_a->pre_reqs()->attach($inter_agil);
		
			
    }
}
