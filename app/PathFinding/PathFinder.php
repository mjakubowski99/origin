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
        $this->graph = array();
        $this->visited = array();
        $this->pathsFinded = array();
        $this->founded_arrives = collect();
    }

    public function formatFoundedArrives(){
        foreach( $this->founded_arrives as $founded_arrive ){
            foreach( $founded_arrive as $station ){
                $station->ID_STATION = DB::table('stations')->select('name')->where('id', $station->ID_STATION)->pluck('name')->first();
            }
        }
    }

    public function findPath($dateOfJourney, $trace_begin, $trace_end){
          $this->dateOfJourney = $dateOfJourney;
          $this->startStation = DB::table('stations')->where('name', $trace_begin)->get()->pluck('id')->toArray();
          $this->arrivesFromTwoDays = $this->getArrivesFrom2DaysAfterBeginJourney($dateOfJourney);
          $this->setGraph($trace_begin, $dateOfJourney, $trace_end);
          $this->runFindingAllPaths($trace_begin, $trace_end);
          $this->checkPathsWithArriveTable();
          $this->formatFoundedArrives();
    
          return $this->founded_arrives;
    }

    private function checkPathsWithArriveTable(){
        foreach( $this->pathsFinded as $path ){
            $this->checkPathWithArriveTable($path);
        }
    }
    private function checkPathWithArriveTable($path){
        $arrives = $this->findArrivesToUserData();
       
        foreach( $arrives as $arrive ){
            $first_flag = true;
            $previous = null;
            $previous_station_name = null;
            $founded_arrive = array();
            array_push(
                $founded_arrive,
                $arrive
            );

            foreach( $path as $path_el){
                if( $first_flag ){
                    $first_flag = false;
                } 
                else{  
                    $bestArrives = $this->getBestArrive($previous, $path_el, $previous_station_name, count($founded_arrive)-1);
                    if( count($founded_arrive) == 1 && count($bestArrives) == 2 ){
                        $stationName = DB::table('stations')->select('name')->where('id', [$bestArrives[0]->ID_STATION, $founded_arrive[0]->ID_STATION ])->groupBy('name')->get();
                        if( $stationName->first() == $stationName->last() )
                            $bestArrives = [null];
                    }
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
            if( $previous != null){
                $this->founded_arrives->push( $founded_arrive );
            }
        }
    }

    private function getStationIdsForStationName($name){
       return DB::table('stations')
                ->select('id')
                ->where('name', $name)
                ->get()
                ->pluck('id');
    }

    private function getBestArrive($previous, $station_name, $previous_name, $index){
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

            $stationIDS = $this->getStationIdsForStationName($previous_name);

            $change = $this->arrivesFromTwoDays
                        ->whereNotIn('arrive_id', [$previous->arrive_id])
                        ->whereIn('ID_STATION', $stationIDS)
                        ->whereBetween('arrive_date', $previous_date, $previous_max_date);
                        
            $change_station = $change;
            $change = $change->pluck('arrive_id');

            $change = $change->map( function($el){
                return $el+1;
            });

            $stationPathIDs = $this->getStationIdsForStationName( $station_name );
    
            $arrivesToChange = $this->arrivesFromTwoDays
                    ->whereIn('id', $change)
                    ->whereIn('ID_STATION', $stationPathIDs);
                    
            $data = $arrivesToChange->where('arrive_date', $arrivesToChange->min('arrive_date') );
            return [$change_station->first(), $data->first()];
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

    public function setGraph($dateOfJourney, $trace_begin, $trace_end){
        $allStations = DB::table('stations')->get();
        $this->initializeGraphArray($allStations);

        for($i=0; $i<count($allStations); $i++){
            $stationID = $allStations[$i]->id;
            $stationName = $allStations[$i]->NAME;
            $stationTraceId = $allStations[$i]->ID_TRACE;

            array_push( 
                $this->graph[$stationName]['station_trace_id'], 
                [$stationID, $stationTraceId]
            ); 

            if( $i+1<count($allStations) ){
                $adjStationName = $allStations[$i+1]->NAME;
                $adjStationTraceId = $allStations[$i+1]->ID_TRACE;
                $adjStationID = $allStations[$i+1]->id;

                if( $stationTraceId == $adjStationTraceId ){                      
                    array_push( 
                        $this->graph[ $allStations[$i]->NAME ]['adjavency_list'], 
                        $adjStationName
                    );
                }
            }
        } 

    }


     /**
     * Initialize graph array. Set 'trace_id' and 'adjavency_list' as array
     *
     * @param  Illuminate\Support\Collection & $allStations
     */
    private function initializeGraphArray(&$allStations){
        for($i=0; $i<count($allStations); $i++){
            $this->graph[ $allStations[$i]->NAME ] = [
                'station_trace_id' => array(),
                'adjavency_list' => array()
            ];
            $this->visited[ $allStations[$i]->NAME ] = false;
        }
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