<?php 

namespace App\PathFinding;
use Illuminate\Support\Facades\DB;

class ArrivesGraph{
    private $graph;
    private $visited;

    public function __construct(){
        $this->graph = array();
        $this->visited = array();
    }

    
    private function initializeGraphArray( &$allStations ){

        for($i=0; $i<count($allStations); $i++){
            $this->graph[ $allStations[$i]->NAME ] = [
                'station_trace_id' => array(),
                'adjavency_list' => array()
            ];
            $this->visited[ $allStations[$i]->NAME ] = false;
        }

    }

    public function getVisitedTable(){
        return $this->visited;
    }

    public function getArrivesGraph(){
        return $this->graph;
    }

    public function setArrivesGraph($dateOfJourney, $trace_begin, $trace_end){

        $allStations = DB::table('stations')->get();
        $this->initializeGraphArray($allStations);

        for($i=0; $i<count($allStations); $i++){   

            $stationID = $allStations[$i]->id; //station parameters
            $stationName = $allStations[$i]->NAME;
            $stationTraceId = $allStations[$i]->ID_TRACE;

            array_push( 
                $this->graph[$stationName]['station_trace_id'], 
                [$stationID, $stationTraceId]
            ); 

            if( $i+1<count($allStations) ){ //check if not last station in database

                $adjStationName = $allStations[$i+1]->NAME; //neighbour station parameters
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

}