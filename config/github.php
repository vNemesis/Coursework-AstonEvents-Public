<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Token used to validate requests from github webhooks
    |--------------------------------------------------------------------------
    |
    */
    'webhook-secret-token' => env('GIT_TOKEN', 'null'),

];
