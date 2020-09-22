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


    /**
     * PathFinder constructor which create graph
     *
     * @param  DateTime  $dateOfJourney, String $trace_begim, String
     */
    public function __construct(){
        $this->graph = array();
        $this->visited = array();
        $this->pathsFinded = array();
    }

    public function findPath($dateOfJourney, $trace_begin, $trace_end){
           $this->arrivesFromTwoDays = $this->getArrivesFrom2DaysAfterBeginJourney($dateOfJourney);
           $this->setGraph($trace_begin, $dateOfJourney, $this->arrivesFromTwoDays );
           $this->runFindingAllPaths($trace_begin, $trace_end);
           return true;
    }


     /**
     * Initialize graph array. Set 'trace_id' and 'adjavency_list' as array
     *
     * @param  Illuminate\Support\Collection & $allStations
     */
    private function initializeGraphArray(&$allStations){
        for($i=0; $i<count($allStations); $i++){
            $this->graph[ $allStations[$i]->NAME ] = [
                'arrive_id' => array(),
                'station_id' => array(),
                'adjavency_list' => array()
            ];
        }
    }

    public function getArrivesFrom2DaysAfterBeginJourney($dateOfJourney){
        $maxDateOfArrives = new DateTime( $dateOfJourney->format('Y-m-d H:i:s') );
        \date_modify($maxDateOfArrives, '+2 day');

        return DB::table('arrives')
            ->select(
                'ID_STATION', 
                'arrive_id',
                'begin_date', 
                'arrive_date'
            )->whereRaw(
                'begin_date >= ? and begin_date <= ?', 
                [$dateOfJourney, $maxDateOfArrives] 
            )->get();
    }
      

    
     /**
     * Running function which initialize graph and set edges.
     *
     */
    private function setGraph($startingStationName, $dateOfJourney, $arrivesFromTwoDays){
            $allStations = DB::table('stations')->get();
            $this->initializeGraphArray($allStations);

            $startingStationIDS = $allStations
                ->where('NAME', $startingStationName)
                ->pluck('id');

            $startStationDeparture = $arrivesFromTwoDays
                ->whereIn(
                    'ID_STATION', 
                    $startingStationIDS 
                );

            $maxDate = new DateTime( 
                $dateOfJourney->format('Y-m-d H:i:s') 
            );
            \date_modify($maxDate, '+2 hours');

            
            foreach( $startStationDeparture as $it ){
                $trainArriveDate = new DateTime(
                    $it->arrive_date
                );

                if( $trainArriveDate >= $dateOfJourney && $trainArriveDate <= $maxDate ){
                    array_push( 
                        $this->graph[$startingStationName]['arrive_id'], 
                        $it->arrive_id 
                    ); 
                }
            }

            for($i=0; $i<count($allStations); $i++){
                    $stationName = $allStations[$i]->NAME;
                    $stationTraceId = $allStations[$i]->ID_TRACE;
                    $stationID = $allStations[$i]->id;

                    array_push( 
                        $this->graph[$stationName]['station_id'], 
                        $stationID
                    ); 

                    $this->visited[$stationID] = false;

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

    public function runFindingAllPaths($source, $dest){
        $path_index = 0;
        $paths = array();
        $this->findingAllPaths(
            $source, $dest, $path_index,
            $paths, $this->graph[$source]['station_id'][0], 
            $this->graph[$source]['arrive_id'][0] 
        );
    }

    private function findingAllPaths($actual, $dest, $path_index, $paths, $station_id, $arrive_id){
        $this->visited[$station_id] = true;
        $paths[$path_index] = [$actual, $arrive_id];
        $path_index++;

        if( $actual == $dest ){
           array_push( $this->pathsFinded, $paths);
        }
        else{
            foreach( $this->graph[$actual]['adjavency_list'] as $adj ){
                foreach( $this->graph[$adj]['station_id'] as $station_id ){
                    if( !$this->visited[ $station_id ] ){

                        $neighbour_arrives = $this->arrivesFromTwoDays
                            ->where(
                                'ID_STATION', 
                                $station_id 
                            );

                        $neighbours_with_same_arrive_id = $neighbour_arrives
                            ->whereIn(
                                'arrive_id', 
                                $this->graph[$actual]['arrive_id'] 
                            );

                        $neighbours_with_different_arrive_id = $neighbour_arrives
                            ->whereNotIn(
                                'arrive_id', 
                                $this->graph[$actual]['arrive_id']
                             );

    
                        foreach( $this->graph[$actual]['arrive_id'] as $actual_arrive_id ){
                            foreach( $neighbours_with_same_arrive_id as $arrive ){
                                if( $arrive->arrive_id ==  $actual_arrive_id ){
                                    array_push(
                                         $this->graph[ $adj ]['arrive_id'], 
                                         $arrive->arrive_id
                                    );
                                    $this->findingAllPaths( 
                                        $adj, $dest, 
                                        $path_index, $paths, 
                                        $station_id, $arrive->arrive_id 
                                    );
                                }
                            }
    
                            foreach($neighbours_with_different_arrive_id as $n_with_diff_id ){
    
                                foreach($neighbours_with_same_arrive_id as $n_with_same_id ){
                                    $date = $n_with_same_id->begin_date;
                                    $oneHourPlusDate = new DateTime( $date );
                                    \date_modify($oneHourPlusDate, '+1 hour');
    
                                    $change = $n_with_diff_id
                                        ->whereBetween(
                                            'arrive_date', $date,
                                             $oneHourPlusDate
                                        )
                                        ->pluck('arrive_id');

                                    foreach($change as $ch){
                                        array_push(
                                            $this->graph[ $adj ]['arrive_id'], 
                                            $ch
                                        );
                                        $this->findingAllPaths( $adj, $dest, $path_index,
                                         $paths, $station_id, $ch );
                                    }
                                }
            
                            }
                        }      
                    }
                }
               
            }
        }

        $path_index--;
        $this->visited[$station_id] = false;
    }

}

?>