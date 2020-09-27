<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\PathFinding\PathFinder;
use DateTime;
use Tests\Feature\TestData\DataToTests;
use Tests\Feature\TestData\TraceSearchValidator;

class Test extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testLublinWarsow2020_10_10_hour_12_00()
    {
        $dataToTest = new DataToTests();
        $testValidator = new TraceSearchValidator();
        $dateOfJourney = DateTime::createFromFormat('Y-m-d H:i:s', '2020-10-10 12:00:00');
        $pathFinder = new PathFinder();

        $response = $pathFinder->findPath($dateOfJourney, 'Lublin', 'Warszawa');
        $shouldResponse = $dataToTest->shouldResponseLublinWarsow2020_10_10_hour_12_00;

        $this->assertTrue( $testValidator->checkValidOfData($response, $shouldResponse) );
    }

    public function testRadomWarsow_2020_10_10_hour_12_30(){
        $dataToTest = new DataToTests();
        $testValidator = new TraceSearchValidator();

        $dateOfJourney = DateTime::createFromFormat('Y-m-d H:i:s', '2020-10-10 12:30:00');
        $pathFinder = new PathFinder();
    

        $response = $pathFinder->findPath($dateOfJourney, 'Radom', 'Warszawa');
        $shouldResponse = $dataToTest->shouldResponseRadomWarsow2020_10_10_hour_12_30;

        $this->assertTrue( $testValidator->checkValidOfData($response, $shouldResponse) );
    }

    public function testForNotExistingStations(){
        $dataToTest = new DataToTests();
        $testValidator = new TraceSearchValidator();

        $dateOfJourney = DateTime::createFromFormat('Y-m-d H:i:s', '2020-10-10 12:30:00');
        $pathFinder = new PathFinder();

        $response = $pathFinder->findPath($dateOfJourney, 'adas', 'afdf');
        $valid = false;
        if( count($response) == 0)
            $valid = true;
        
        $this->assertTrue($valid);
    }

    public function testForNotExistingStartStation(){
        $dataToTest = new DataToTests();
        $testValidator = new TraceSearchValidator();

        $dateOfJourney = DateTime::createFromFormat('Y-m-d H:i:s', '2020-10-10 12:30:00');
        $pathFinder = new PathFinder();

        $response = $pathFinder->findPath($dateOfJourney, 'adas', 'Warszawa');
        $valid = false;
        if( count($response) == 0)
            $valid = true;
        
        $this->assertTrue($valid);
    }

    public function testForNotExistingEndStation(){
        $dataToTest = new DataToTests();
        $testValidator = new TraceSearchValidator();

        $dateOfJourney = DateTime::createFromFormat('Y-m-d H:i:s', '2020-10-10 12:30:00');
        $pathFinder = new PathFinder();

        $response = $pathFinder->findPath($dateOfJourney, 'Lublin', 'rnd');
        $valid = false;
        if( count($response) == 0)
            $valid = true;
        
        $this->assertTrue($valid);
    }

    public function testForDateWhichTrainsNotArrive(){
        $dataToTest = new DataToTests();
        $testValidator = new TraceSearchValidator();
        $dateOfJourney = DateTime::createFromFormat('Y-m-d H:i:s', '2040-10-10 12:00:00');
        $pathFinder = new PathFinder();

        $response = $pathFinder->findPath($dateOfJourney, 'Lublin', 'Warszawa');
        $valid = false;
        if( count($response) == 0)
            $valid = true;
        
        $this->assertTrue($valid);
    }
}
