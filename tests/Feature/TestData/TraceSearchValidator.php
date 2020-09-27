<?php

namespace Tests\Feature\TestData;

class TraceSearchValidator{

    public function checkIfValuesAreSame(&$resp, &$shouldResponse, $i, $j){
        return ( $resp->id != $shouldResponse[$i][$j]['id'] || 
               $resp->ID_STATION != $shouldResponse[$i][$j]['ID_STATION'] || 
               $resp->arrive_id != $shouldResponse[$i][$j]["arrive_id"] );
    }

    public function checkValidOfData($responseData, $shouldResponse){  
        $i=0;
        $j=0;
        $valid = true;

        if( count($shouldResponse) != count($responseData) ){
            return false;
        }

        foreach($responseData as $response){
            if( count($response) != count($shouldResponse[$i]) ){
                return false;     
            }
            foreach($response as $resp){
                if( $this->checkIfValuesAreSame($resp,$shouldResponse,$i,$j) )
                   $valid = false;
                $j++;
            }
            $j=0;
            $i++;
        } 

        return $valid;
    }
}