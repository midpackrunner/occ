<?php

use Illuminate\Database\Seeder;

class ProdFAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\FAQ::create([
			'question' => 'Why should I join the OCC?',
			'answer' => 'Besides receiving a discount off your next class, you will be able register for your next class online before registration opens to the public. After paying for 5 obedience and/or agility classes, obedience classes cost $50 and agility classes cost $55 as long as you are a member. 6 volunteer hours from helping at C matches, Trials, and other club activities equals one free class.',
		]);
        App\FAQ::create([
			'question' => 'I have a new puppy, what class should I take?',
			'answer' => 'Please see our progression charts, located under <a href="/class_info">Our Classes</a>.',
		]);
        App\FAQ::create([
			'question' => 'What if my dog already knows how to sit, down, roll over, etc but has never taken a class?',
			'answer' => 'While most dogs will obey commands they learned at home in their home, most will not obey them consistently when out in public with distractions. So please go by your dog/puppy age and sign up for the beginner course for that age. See Training Course Progression chart on the webpage.',
		]);
        App\FAQ::create([
			'question' => 'I want to register for a class but the course I want is not listed in the Class Schedule Page. What do I do?',
			'answer' => 'Classes are automatically removed from our Class Schedule Page when the class fills up.  You will need to choose another course that is appropriate for your dog according to age and previous courses or wait until the next session.',
		]);
        App\FAQ::create([
			'question' => 'What if I have questions or problems registering online for classes?',
			'answer' => 'Please send email to the Training Director We will look into it and get back to you.',
		]);
        App\FAQ::create([
			'question' => 'What shots does my puppy need to begin classes?',
			'answer' => 'Your puppy must have had 2 set of puppy shots on 2 different dates before starting classes.',
		]);
        App\FAQ::create([
			'question' => 'When does my puppy need a rabies vaccination?',
			'answer' => 'Your puppy must have had a rabies vaccination or before 16 weeks of age.',
		]);
        App\FAQ::create([
			'question' => 'Can I use the puppy health booklet as proof of puppy shots and the rabies vaccination?',
			'answer' => 'No. The OCC requires copies of the invoices from your veterinarian documenting when the shots were given—not reminder dates.',
		]);

        App\FAQ::create([
			'question' => 'What if my dog is not registered with the American Kennel Club?',
			'answer' => 'Registering with AKC is not required. We welcome all dogs.',
		]);
        App\FAQ::create([
			'question' => 'What if I miss the first class?',
			'answer' => 'Most instructors will catch you up. There is a link on the webpage for your instructor and you need to email them to let them know you will miss the first class.',
		]);
        App\FAQ::create([
			'question' => 'When does my puppy need a rabies vaccination?',
			'answer' => 'Your puppy must have had a rabies vaccination or before 16 weeks of age.',
		]);
        App\FAQ::create([
			'question' => 'What if I will miss the first 2 classes?',
			'answer' => 'Please wait and sign up for the next session of classes.',
		]);

        App\FAQ::create([
			'question' => 'Can I miss the 1st BBB class because my puppy needs his second puppy shot?',
			'answer' => 'In this case we encourage the owner to come without the puppy to the first class because a huge amount of valuable information is given out that first night that you do not want to miss.',
		]);
        App\FAQ::create([
			'question' => 'Why is BBB such an important class for a young puppy?',
			'answer' => 'Your puppy must have had a rabies vaccination or before 16 weeks of age.',
		]);
        App\FAQ::create([
			'question' => 'What if I will miss the first 2 classes?',
			'answer' => 'Socialization at this age is so, so important for all puppies so they become less fearful of people (tall, short, wearing hats, wearing raincoats, in uniform, etc.), children, and things they will encounter in daily life.',
		]);

        App\FAQ::create([
			'question' => 'Can my 10 year old child bring his dog to class?',
			'answer' => 'We require children to be at least 12 years of age and then they must be able to control their dog. A parent or guardian must remain at ringside in the building while his child is in a class.',
		]);
        App\FAQ::create([
			'question' => 'How does my dog become a therapy dog?',
			'answer' => 'Your dog must have appropriate obedience training before taking the therapy dog class. Please read the class descriptions on our website with each class\'s prerequisites.',
		]);
        App\FAQ::create([
			'question' => 'My dog has taken classes other places, do I have to start over?',
			'answer' => 'Not necessarily, but our training director may want your dog to be evaluated prior to signing up for a class.',
		]);

        App\FAQ::create([
			'question' => 'My dog is showing signs of aggressive behavior around other people and other dogs.',
			'answer' => ' We are sorry but we do not have classes for these kinds of problems. We will gladly refer you to a behaviorist.',
		]);
        App\FAQ::create([
			'question' => 'If I am not 18 years old, how can I sign up electronically?',
			'answer' => 'You must have a parent or guardian sign up and be with you in class.',
		]);
    }
}
