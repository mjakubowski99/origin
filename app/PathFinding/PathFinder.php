<?php

namespace App\PathFinding;
use Illuminate\Support\Facades\DB;
use App\Station;
use DateTime;

class PathFinder{

    /** array() to store graph */
    private $graph;
    private $visited;
    private $pathsFinded;


    /**
     * PathFinder constructor which create graph
     *
     * @param  DateTime  $dateOfJourney, String $trace_begim, String
     */
    public function __construct($dateOfJourney, $trace_begin, $trace_end){
        $this->graph = array();
        $this->visited = array();
        $this->pathsFinded = array();
    }

    public function findPath($dateOfJourney, $trace_begin, $trace_end){
       $exists = $this->checkIfTraceExists($dateOfJourney, $trace_begin, $trace_end);

       if( $exists ){
           $this->setGraph();
           $this->runFindingAllPaths($trace_begin, $trace_end);
           return true;
       }
       return false;
    }

    private function checkIfTraceExists($dateOfJourney, $trace_begin, $trace_end){
        $userStationIDs = $this->getUserStation($trace_begin);

        if( $this->checkIfEndStationExists($trace_end) && count($userStationIDs) != 0){
            $startStationRecords = $this->getArrivesWithUserStationAndDate(
                    $dateOfJourney, 
                    $userStationIDs
            );
            if( count($startStationRecords) != 0 )
                return true;
        }
        return false;
    }

    private function checkIfEndStationExists($trace_end){
        if( DB::table('stations')->where('NAME', $trace_end)->first() )
            return true;
        return false;
    }

    /**
     * Function return array of id's records from station table which have passed by parameter trace name
     *
     * @param  String & $trace
     * @return array()
     */
    private function getUserStation(&$trace){
        $stationID = DB::table('stations')
                    ->select('id')
                    ->where('NAME', $trace)
                    ->get();

        $stationIDArray = array();

        foreach( $stationID as $station )
            array_push($stationIDArray, $station->id);
                  
        return $stationIDArray;
    }

    /**
     * Function return arrives records which have less than 1 day difference between passed by parameter date and station,
     * this records help to set start station to graph traversal algorithm
     *
     * @param  DateTime & $dateOfJourney, array $stationIDArray
     * @return array()
     */
    private function getArrivesWithUserStationAndDate(&$dateOfJourney, $stationIDArray){
        $date = $dateOfJourney;
        \date_modify($dateOfJourney, '+1 day');
        $stations = DB::table('arrives')
                    ->where('id_station', $stationIDArray)
                    ->whereDate('begin_date', '<=', $dateOfJourney)
                    ->get();

        return $stations;
    }

     /**
     * Initialize graph array. Set 'trace_id' and 'adjavency_list' as array
     *
     * @param  Illuminate\Support\Collection & $allStations
     */
    private function initializeGraphArray(&$allStations){
        for($i=0; $i<count($allStations); $i++){
            $this->graph[ $allStations[$i]->NAME ] = [
                'trace_id' => array(),
                'adjavency_list' => array()
            ];

            $this->visited[$allStations[$i]->NAME] = false;
        }
    }

    public function getArrivesFrom2DaysAfterBeginJourney($dateOfJourney){
        $maxDateOfArrives = $dateOfJourney;
        \date_modify($maxDateOfArrives, '+2 day');

        $dateOfJourney = $dateOfJourney->format('Y-m-d H:i:s');
        $maxDateOfArrives = $maxDateOfArrives->format('Y-m-d H:i:s');
    
        return DB::table('arrives')->whereDate('begin_date', '<=', $dateOfJourney)->get();
    }

    private function setGraph2($starting_point_arrives){

    }

    
     /**
     * Running function which initialize graph and set edges.
     *
     */
    private function setGraph(){
       $allStations = DB::table('stations')->get();
       $this->initializeGraphArray($allStations);

       $arrive_records_to_fit = $starting_point_arrives;

       for($i=0; $i<count($allStations); $i++){
            $stationName = $allStations[$i]->NAME;
            $stationTraceId = $allStations[$i]->ID_TRACE;
            $stationID = $allStations[$i]->ID;

            array_push( 
                $this->graph[$stationName]['trace_id'], 
                $stationTraceId
            ); 

            if( $i+1<count($allStations) ){
                $adjStationName = $allStations[$i+1]->NAME;
                $adjStationTraceId = $allStations[$i+1]->ID_TRACE;
                $adjStationID = $allStations[$i+1]->ID;

                if( $stationTraceId == $adjStationTraceId ){
                    array_push( 
                        $this->graph[ $allStations[$i]->NAME ]['adjavency_list'], 
                        [ $adjStationName, $adjStationTraceId ]
                    );
                }
            }
       } 
    }

    public function runFindingAllPaths($source, $dest){
        $path_index = 0;
        $paths = array();
        $this->findingAllPaths($source, $dest, $path_index, $paths);
        dd( $this->pathsFinded );
    }

    private function findingAllPaths($actual, $dest, $path_index, $paths){
        $this->visited[$actual] = true;
        $paths[$path_index] = $actual;
        $path_index++;

        if( $actual == $dest ){
           array_push( $this->pathsFinded, $paths);
        }
        else{
            foreach($this->graph[$actual]['adjavency_list'] as $adj ){
                if( !$this->visited[ $adj[0] ] ){
                    $this->findingAllPaths( $adj[0], $dest, $path_index, $paths);
                }
            }
        }

        $path_index--;
        $this->visited[$actual] = false;
    }

}

?>