<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Manage It Pro App Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to display the name of the application within the UI
    | or in other locations. Of course, you're free to change the value.
    |
    */

    'name' => env('SERVICE_BASE_NAME',''),


    /*
    |--------------------------------------------------------------------------
    | Manage It Pro App Service Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to display the name of the application within the UI
    | or in other locations. Of course, you're free to change the value.
    |
    */

    'service_name' => env('SERVICE_BASE_SERVICE_NAME',''),


    /*
    |--------------------------------------------------------------------------
    | Manage It Pro App URL
    |--------------------------------------------------------------------------
    |
    | This URL is where users will be directed when they dont have access
    | to the paid servive. You are free to change this URL to
    | any location you wish depending on the needs of your application.
    |
    */

    'url' => env('SERVICE_BASE_URL', '/'),

    /*
    |--------------------------------------------------------------------------
    | Manage It Pro App API KEY
    |--------------------------------------------------------------------------
    |
    | This URL is where users will be directed when they dont have access
    | to the paid servive. You are free to change this URL to
    | any location you wish depending on the needs of your application.
    |
    */

    'api_key' => env('SERVICE_BASE_API_KEY', ''),


];
