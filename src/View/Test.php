<?php


$app->group('/', function() use ($app) {

    $app->post('', function ($request, $response, $args) {
        $res = [
            "version" => "1.0",
            "response" => [
                "outputSpeech" => [
                    "type" => "PlainText",
                    "text" => "Hi! This worked!",
                    "playBehavior" => "REPLACE_ALL"
                ]
            ]
        ];

        return $response->withJson($res);
    });


});
