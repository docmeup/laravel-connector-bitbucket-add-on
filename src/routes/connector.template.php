<?php

/**
 * Connector Template
 */

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::prefix('bitbucket')->group(function () {
    Route::get('atlassian-connect.json', function () {
        return config('gitconnector.bitbucket.connector');
    });

    /**
     * Handle user installed app
     */
    Route::post('installed', function(\Illuminate\Http\Request $request){
        if(config('app.debug'))
            Log::info('User installed app on bitbucket', ['request' => $request->toArray()]);

        $connectorSecret = config('gitconnector.bitbucket.client.secret');
        $validator = \Illuminate\Support\Facades\Validator::make(
            $request->toArray(), ['sharedSecret'=> "required|in:{$connectorSecret}"]
        );

        abort_if($validator->fails(), 401, 'Could not authenticate connector.');

        // Do something with the posted request data
        return response('Installed');
    });

    /**
     * Handle user installed app
     */
    Route::post('uninstalled', function(\Illuminate\Http\Request $request){
        if(config('app.debug'))
            Log::info('User uninstalled app on bitbucket', ['request' =>$request->toArray()]);

        // Do something with the posted request data
        return response('Uninstalled');
    });
});
