<?php

namespace Tests\Feature\TestData;

class DataToTests{
    public $shouldResponseLublinWarsow2020_10_10_hour_12_00 = [
        [
           [ "id" =>  6,
            "ID_STATION" => "Lublin",
            "arrive_id" => 1 ,
           ],
           [ "id" =>  7,
            "ID_STATION" => "Radom",
            "arrive_id" => 1 ,
           ],
           [ "id" =>  8,
            "ID_STATION" => "Warszawa",
            "arrive_id" => 1 ,
           ], 
        ],
        [
           [ "id" =>  9,
            "ID_STATION" => "Lublin",
            "arrive_id" => 2 ,
           ],
           [ "id" =>  10,
             "ID_STATION" => "Siedlce",
            "arrive_id" => 2 ,
           ],
           [ "id" =>  11,
             "ID_STATION" => "Siedlce",
             "arrive_id" => 3 ,
           ],
           [ "id" =>  12,
           "ID_STATION" => "Ząbki",
           "arrive_id" => 3 ,
           ],
           [ "id" =>  13,
           "ID_STATION" => "Warszawa",
           "arrive_id" => 3 ,
           ],
        ]
    ];

    public $shouldResponseRadomWarsow2020_10_10_hour_12_30 = [
        [
            [ "id" =>  7,
            "ID_STATION" => "Radom",
            "arrive_id" => 1 ,
           ],
           [ "id" =>  8,
            "ID_STATION" => "Warszawa",
            "arrive_id" => 1 ,
           ], 
        ]
    ];
}