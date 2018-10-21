<?php


$app->group('/', function() use ($app) {

    $app->post('', function ($request, $response, $args) {
        $body = $request->getParsedBody();

        $intent_name = $body['request']['intent']['name'];

        $res = [
            "version" => "1.0",
            "response" => [
                "outputSpeech" => [
                    "type" => "PlainText",
                    "text" => "You are useing the ".$intent_name." intent!",
                    "playBehavior" => "REPLACE_ALL"
                ],
                "shouldEndSession" => false
            ]
        ];

        return $response->withJson($res);
    });


});
