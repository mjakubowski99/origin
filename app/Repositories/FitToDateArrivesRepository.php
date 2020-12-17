<?php

namespace App\Repositories;
use App\PathFinding\PathFinder;
use DateTime;

class FitToDateArrivesRepository extends Repository{

    public $dateOfJourney;
    public $traceBegin;
    public $traceEnd;

    public function __construct($data){
            $this->dateOfJourney = $this->convertDate($data['date-input'], $data['hour-input']);
            $this->traceBegin = $data['trace-input-1'];
            $this->traceEnd = $data['trace-input-2'];
    }

    /**
     * Finding path fitting to user data.
     * @return array
     */
    public function arrives(){
        $pathFinder = new PathFinder();

        return $pathFinder->findPath(
            $this->dateOfJourney, 
            $this->traceBegin, 
            $this->traceEnd 
        );
    }

    //Helper private methods
    /**
     * Convert date and hour to DateTime.
     *
     * @param  TicketRequest $request
     * @return DateTime
     */
    private function convertDate($date, $hour){
        $dateOfJourney = $date.' '.$hour.":00";
        return DateTime::createFromFormat('Y-m-d H:i:s', $dateOfJourney);
    }
}