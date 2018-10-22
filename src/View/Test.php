<?php

require_once __DIR__."/../Controller/IntentController.php";

$app->group('/', function() use ($app) {

    $app->post('', function ($request, $response, $args) {
        $body = $request->getParsedBody();

        if($body['request']['type'] === "LaunchRequest") {
            return IntentController::start($request, $response, $args);
        }

        $intent_name = $body['request']['intent']['name'];

        switch($intent_name) {
            case "about":   return IntentController::about($request, $response, $args);
            case "project": return IntentController::project($request, $response, $args);
            case "work":    return IntentController::work($request, $response, $args);
            case "more":    return IntentController::more($request, $response, $args);
            default: {

                if($intent_name === "AMAZON.FallbackIntent") {
                    $error_message = "Hmm, I didn't quite understand that. Try asking what Seth is like, about his projects, about his work history, or about where to learn more information.";
                    $should_end_session = false;
                } else {
                    $error_message = "Unfortunatly, I seem to be having problems. Check back later!";
                    $should_end_session = true;
                }

                $res = [
                    "version" => "1.0",
                    "response" => [
                        "outputSpeech" => [
                            "type" => "PlainText",
                            "text" => $error_message,
                            "playBehavior" => "REPLACE_ALL"
                        ],
                        "shouldEndSession" => $should_end_session
                    ]
                ];

                return $response->withJson($res);
            }
        }
    });


});
