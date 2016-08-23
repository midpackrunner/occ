<?php

use App\Lib\RandomGenerator;

/**
 * Test Suite for the RandomGenerator Class
 *
 */
class RandomGeneratorTest extends TestCase
{
    public function testInitiation()
    {
        $random = new RandomGenerator();
    }

    /**
     * Test: length parameters produce the expected
     * total length.
     */
    public function testLengthGeneration()
    {
        $random = new RandomGenerator();

        $result = $random->get_random_user_id(3, 3);
        $this->assertEquals(6, strlen($result));

        $result = $random->get_random_user_id(4, 3);
        $this->assertEquals(7, strlen($result));

        $result = $random->get_random_user_id(4, 5);
        $this->assertEquals(9, strlen($result));
    }

    /**
     * Test for collisions.  Testing shows with 10,000
     * pre-exisiting users it takes, on average, 0.003
     * seconds to generate 10 new unique values.
     * Expected error in rates due to re-seeding
     * in a quick fashion.  Expect better results in
     * live environment 
     */
    public function testNoCollisions()
    {
        $random = new RandomGenerator();

        $result_array = array();

        $mock_db = array();
        // mock database
        for ($i=0; $i < 10000; $i++) { 
            $result = $random->get_random_user_id(5, 5);
            array_push($mock_db, $result);
        }

        $start = microtime();
        for ($i=0; $i < 10; $i++) {
            $has_id = false;
            
            do {
                $result = $random->get_random_user_id(5, 5);
                if (in_array($result, $mock_db)) {
                    $has_id;
                }
            } while($has_id);
            array_push($result_array, $result);
        }
        $end = microtime();
        $time_taken = $start - $end;
        var_dump($time_taken);

        $compare_array = array_unique($result_array);

        // if all values are unique,
        // then both arrays should have the same size
        $this->assertEquals(count($compare_array), count($result_array));
    }
}
