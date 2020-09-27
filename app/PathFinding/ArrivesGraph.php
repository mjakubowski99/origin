<?php 

namespace App\PathFinding;

class ArrivesGraph{
    private $graph;
    private $visited;

    public function __construct(){
        $this->graph = array();
        $this->visited = array();
    }

    
    private function initializeGraphArray(&$allStations){
        for($i=0; $i<count($allStations); $i++){
            $this->graph[ $allStations[$i]->NAME ] = [
                'station_trace_id' => array(),
                'adjavency_list' => array()
            ];
            $this->visited[ $allStations[$i]->NAME ] = false;
        }
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

}