<?php

use Illuminate\Http\Request;



Route::group([
    'as' => 'api.statistics.',
    'prefix' => 'statistics'
], function ($router) {
   

    Route::middleware(['auth.both:api'])->group(function () {

        Orion::resource('statistics', 'Api\StatisticsController',['only' => ['index', 'show', 'search']]);
        
        Route::resource('vote', 'Api\StatisticsVoteController',['only' => ['index', 'show', 'search']]);

    });

    
    Route::middleware(['auth:api'])->group(function () {

        Orion::resource('statistics', 'Api\StatisticsController',['except' => ['index', 'show', 'search']]);

        Route::resource('vote', 'Api\StatisticsVoteController',['except' => ['index', 'show', 'search']]);

    });


});