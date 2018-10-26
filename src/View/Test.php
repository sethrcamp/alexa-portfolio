<?php

require_once __DIR__."/../Controller/IntentController.php";
require_once __DIR__."/../valid_request.php";

$app->group('/', function() use ($app) {

    $app->post('', function ($request, $response, $args) {
        $body = $request->getParsedBody();


        $valid = validate_request( explode("amzn1.ask.skill.", $body['context']['System']['application']['applicationId'])[1], explode("amzn1.ask.account.", $body['context']['System']['user']['userId'])[1] );

        $res = [
            "version" => "1.0",
            "response" => [
                "outputSpeech" => [
                    "type" => "PlainText",
                    "text" => "Success: ".$valid['success'],
                    "playBehavior" => "REPLACE_ALL"
                ],
                "shouldEndSession" => true
            ]
        ];

        return $response->withJson($res);

        if ( !DEV_MODE && !$valid['success'] )  {
            error_log( 'Request failed: ' . $valid['message'] );
            return $response->withJson(["error" => "the request is not valid"])->withStatus(400);
        }

        if($body['request']['type'] === "SessionEndedRequest") {
            return $response->withJson(["version" => "1.0"]);
        }


        if ($body['request']['type'] === "LaunchRequest") {
            return IntentController::start($request, $response, $args);
        }

        $intent_name = $body['request']['intent']['name'];

        switch ($intent_name) {
            case "about":
                return IntentController::about($request, $response, $args);
            case "project":
                return IntentController::project($request, $response, $args);
            case "work":
                return IntentController::work($request, $response, $args);
            case "more":
                return IntentController::more($request, $response, $args);
            case "AMAZON.HelpIntent":
                return IntentController::more($request, $response, $args);
            case "AMAZON.CancelIntent":
                return IntentController::stop($request, $response, $args);
            case "AMAZON.StopIntent":
                return IntentController::stop($request, $response, $args);
            default:
                {

                    if ($intent_name === "AMAZON.FallbackIntent") {
                        $error_message = "Hmm, I didn't quite understand that. Try asking what Seth is like, about his projects, about his work history, or about where to learn more information.";
                        $should_end_session = false;
                    } else {
                        $error_message = "Unfortunately, I seem to be having problems. Check back later!";
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
