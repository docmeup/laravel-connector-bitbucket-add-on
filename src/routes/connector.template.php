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
    Route::post('installed', function (\Illuminate\Http\Request $request) {
        if (config('app.debug'))
            Log::info('User installed app on bitbucket', ['request' => $request->toArray()]);

        $connectorSecret = config('gitconnector.bitbucket.client.secret');
        $validator = \Illuminate\Support\Facades\Validator::make(
            $request->toArray(), ['sharedSecret' => "required|in:{$connectorSecret}"]
        );

        abort_if($validator->fails(), 401, 'Could not authenticate connector.');

        // Do something with the posted request data
        return response('Installed');
    });

    /**
     * Handle user installed app
     */
    Route::post('uninstalled', function (\Illuminate\Http\Request $request) {
        if (config('app.debug'))
            Log::info('User uninstalled app on bitbucket', ['request' => $request->toArray()]);

        // Do something with the posted request data
        return response('Uninstalled');
    });

    Route::get('repo-page/{repoOwner}/{repoName}', function (string $repoOwner, string $repoName, \Illuminate\Http\Request $request) {
        /**
         * @see composer.json:suggested - `composer require firebase/jwt:~5.0.0`
         */
//        try {
//            \Firebase\JWT\JWT::decode(
//                $request->get('jwt'),
//                // Bitbucket actually provides the secret for us to store in the database when a user installs the app
//                // This means we could probably revert to something like Passport for authentication.
//                config('gitconnector.bitbucket.client.secret'),
//                ['HS256']
//            );
//        } catch (Exception $jwtException) {
//            abort(401, 'Could not authenticate');
//        }

        return view('connector.bitbucket.panel');
    });

    Route::get('web-panels/{repoOwner}/{repoName}', function (string $repoOwner, string $repoName, \Illuminate\Http\Request $request) {
        /**
         * @see composer.json:suggested - `composer require firebase/jwt:~5.0.0`
         */
//        try {
//            \Firebase\JWT\JWT::decode(
//                $request->get('jwt'),
//                // Bitbucket actually provides the secret for us to store in the database when a user installs the app
//                // This means we could probably revert to something like Passport for authentication.
//                config('gitconnector.bitbucket.client.secret'),
//                ['HS256']
//            );
//        } catch (Exception $jwtException) {
//            abort(401, 'Could not authenticate');
//        }

        return response()
            ->view('connector.bitbucket.panel');
    });


    Route::get('configure', function (\Illuminate\Http\Request $request) {
        /**
         * @see composer.json:suggested - `composer require firebase/jwt:~5.0.0`
         */
//        try {
//            \Firebase\JWT\JWT::decode(
//                $request->get('jwt'),
//                // Bitbucket actually provides the secret for us to store in the database when a user installs the app
//                // This means we could probably revert to something like Passport for authentication.
//                config('gitconnector.bitbucket.client.secret'),
//                ['HS256']
//            );
//        } catch (Exception $jwtException) {
//            abort(401, 'Could not authenticate.');
//        }

        return response()
            ->view('connector.bitbucket.panel');
    });
});
