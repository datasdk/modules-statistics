<?php


return [
    'name' => 'Statistics',

    'model' => Modules\Statistics\Models\Statistics::class,

    'admin' => [
        /*
        'navigationbar' => [

            "group" => "statistics",

            "link" => ["name" => "Statistics", "icon"=> "fas fa-chart-bar", "link" => "module.statistics.index" ],
         
            "submenu" => [ 
                ["name" => "Statistics", "icon"=> "fas fa-chart-bar", "link" => "module.statistics.index" ],
                ["name" => "Oversigt", "icon"=> "fas fa-chart-bar", "link" => "module.statistics.overview" ]
            ]
              
        
        ],
  */
    ],


    /*
     * default column names that GeoScope will use
     * if none are stated for a model
     */
    'defaults' => [
        'lat-column' => 'latitude',
        'long-column' => 'longitude',
        'units' => 'miles', // miles, kilometers or meters,
    ],

    /*
     * Register model specific settings here
     */
    'models' => [],

    /**
     * Register whitelisted addDistanceFromField() third parameter values (field names) here
     * Defaults to 'distance' if not set
     */
    'whitelisted-distance-from-field-names' => [
        'distance'
    ],
    
];


