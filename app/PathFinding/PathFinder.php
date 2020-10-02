<?php

namespace App\PathFinding;
use Illuminate\Support\Facades\DB;
use App\Station;
use DateTime;

class PathFinder{

    /** array() to store graph */
    private $graph;
    private $databaseQueries;
    private $visited;
    private $pathsFinded;
    private $arrivesFromTwoDays;
    private $dateOfJourney;
    private $startStation;
    private $path;
    private $founded_arrives;


    /**
     * PathFinder constructor which create graph
     *
     * @param  DateTime  $dateOfJourney, String $trace_begim, String
     */
    public function __construct(){
        $this->pathsFinded = array();
        $this->founded_arrives = collect();
        $this->databaseQueries = new DatabaseQueries;
    }

    public function formatFoundedArrives(){
        foreach( $this->founded_arrives as $founded_arrive )
            foreach( $founded_arrive as $station )
                $station->ID_STATION = $this->databaseQueries->getStationNameForStationID($station->ID_STATION);
    }

    public function findPath($dateOfJourney, $trace_begin, $trace_end){
          $this->dateOfJourney = $dateOfJourney;
          $this->startStation = $this->databaseQueries->getStationsIDSForBeginStation($trace_begin);

          if( count($this->startStation) == 0 )
            return [];
            
          $this->arrivesFromTwoDays = $this->databaseQueries->getArrivesFrom2DaysAfterBeginJourney($dateOfJourney);

          $graphCreator = new ArrivesGraph();
          $graphCreator->setArrivesGraph($dateOfJourney, $trace_begin, $trace_end);
          $this->visited = $graphCreator->getVisitedTable();
          $this->graph = $graphCreator->getArrivesGraph();

          $this->runFindingAllPaths($trace_begin, $trace_end);
          $this->checkPathsWithArriveTable();
          $this->formatFoundedArrives();
          return $this->founded_arrives;
    }

    private function checkPathsWithArriveTable(){
        foreach( $this->pathsFinded as $path )
            $this->checkPathWithArriveTable($path);
    }

    private function getArrivesWhichAreNotFromLastStation($start_arrives){
        $arrives = collect();
        foreach($start_arrives as $arrive){
            $next = $this->databaseQueries->getNextArriveID($arrive);
            if( $arrive->arrive_id == $next )
                $arrives->push($arrive);
        }

        return $arrives;
    }

    private function loopAfterPathElementsAndFoundPossibleArrivesToDestination($path, $founded_arrive){
        $first_flag = true;
        $previous = null;
        $previous_station_name = null;

        foreach( $path as $path_el){
            if( $first_flag )
                $first_flag = false; 
            else{  
                $bestArrives = $this->getBestArrive($previous, $path_el, $previous_station_name);
                foreach( $bestArrives as $bestArrive){
                        array_push( 
                            $founded_arrive,
                            $bestArrive
                        ); 
                }               
            }

            $previous = $founded_arrive[ count($founded_arrive)-1 ];
            if( $previous == null ){
                break;
            }
            $previous_station_name = $path_el;
        }

        if( $previous != null)
            $this->founded_arrives->push( $founded_arrive );

    }

    private function checkPathWithArriveTable($path){
        $start_arrives = $this->findArrivesToUserData();
        $arrives = $this->getArrivesWhichAreNotFromLastStation($start_arrives);
   
        foreach( $arrives as $arrive ){
            $founded_arrive = array();
            array_push(
                $founded_arrive,
                $arrive
            );
            $this->loopAfterPathElementsAndFoundPossibleArrivesToDestination($path, $founded_arrive);
        }
    }

    private function getBestArrive($previous, $station_name, $previous_name){
        $bestArrive = $this->arrivesFromTwoDays
            ->where('id', $previous->id+1)
            ->where('arrive_id', $previous->arrive_id );

        if( $bestArrive->isNotEmpty() ){
            $stationID = array();
            $stationGet = $this->graph[$station_name]['station_trace_id'];
            for($i=0; $i<count($stationGet); $i++){
                array_push(
                    $stationID,
                    $stationGet[$i][0]
                );
            }

            $checkIfThatStation = $bestArrive->whereIn('ID_STATION', $stationID);
            if( $checkIfThatStation->isEmpty() )
                return [null];
            else
                return [$bestArrive->first()];
        }
    

        
        $previous_max_date = new DateTime( 
            $previous->begin_date
        );
        \date_modify($previous_max_date, '+2 hours');
        $previous_date = new DateTime( $previous->begin_date );

        if( $bestArrive->isEmpty() ){ //we looking for best change 
            $stationIDS = $this->databaseQueries->getStationIdsForStationName($previous_name);

            $change = $this->arrivesFromTwoDays
                        ->whereNotIn('arrive_id', [$previous->arrive_id])
                        ->whereIn('ID_STATION', $stationIDS)
                        ->whereBetween('arrive_date', $previous_date, $previous_max_date);

            $curr_station_id = $this->databaseQueries->getStationIdsForStationName($station_name);
            $change = $change->whereIn('ID_STATION', $curr_station_id->map( function($el){
                return $el-1;
            }) );

            if( $change->isEmpty() ){
                return [null];
            }
                    
            $data = $change->where('arrive_date', $change->min('arrive_date') )->first();
            $curr_station = $this->arrivesFromTwoDays->where('arrive_id', $data->arrive_id)->whereIn('ID_STATION', $curr_station_id)->first();

            return [$data, $curr_station];
        }
    }

    private function findArrivesToUserData(){
        $maxDate = new DateTime( 
            $this->dateOfJourney->format('Y-m-d H:i:s') 
        );
        \date_modify($maxDate, '+2 hours');

        $startArrives = $this->arrivesFromTwoDays
            ->whereBetween(
                'begin_date', 
                $this->dateOfJourney, 
                $maxDate
            )
            ->whereIn(
                'ID_STATION',
                $this->startStation 
            );


        return $startArrives;
    }

    public function getArrivesFrom2DaysAfterBeginJourney($dateOfJourney){
        $maxDateOfArrives = new DateTime( $dateOfJourney->format('Y-m-d H:i:s') );
        \date_modify($maxDateOfArrives, '+2 day');

        return DB::table('arrives')
            ->select(
                'id',
                'ID_STATION', 
                'arrive_id',
                'begin_date', 
                'arrive_date'
            )->whereRaw(
                'begin_date >= ? and begin_date <= ?', 
                [$dateOfJourney, $maxDateOfArrives] 
            )->get();
    }
      

    public function runFindingAllPaths($source, $dest){
        $path_index = 0;
        $paths = array();
        $this->findingAllPaths(
            $source, $dest, 
            $path_index, $paths
        );
    }

    private function findingAllPaths($actual, $dest, $path_index, $paths){
        $this->visited[$actual] = true;
        $paths[$path_index] = $actual;
        $path_index++;

        if( $actual == $dest ){
           array_push( $this->pathsFinded, $paths);
        }
        else{
            foreach( $this->graph[$actual]['adjavency_list'] as $adj ){
                if( !$this->visited[$adj] ){
                    $this->findingAllPaths($adj, $dest, $path_index, $paths);
                }
            }
        }

        $path_index--;
        $this->visited[$actual] = false;
    }

}

?>