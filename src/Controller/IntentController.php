<?php

class IntentController {

    public static function get_response_object($message) {
        return $res = [
            "version" => "1.0",
            "response" => [
                "outputSpeech" => [
                    "type" => "PlainText",
                    "text" => $message,
                    "playBehavior" => "REPLACE_ALL"
                ],
                "shouldEndSession" => false
            ]
        ];
    }

    public static function start($request, $response, $args) {
        $message = "Welcome to Seth Campbell's portfolio! Here you can learn about Seth Campbell, ".
                   "his past projects, previous work experience, and hear how to learn more information about Seth!";

        $alexa_response = self::get_response_object($message);
        return $response->withJson($alexa_response);
    }

    public static function about($request, $response, $args) {
        $message = "Seth Campbell is a full-stack developer currently living in Muncie, Indiana and ".
                   "attending Ball State University for Computer Science.".
                   "He is skilled in many programming technologies, such as React.js, React Native, Slim, PDO, and many more.".
                   "Seth is also skilled in several different languages including Java, JavaScript, PHP, HTML, CSS, and MySQL.".
                   "He currently holds the rank of Development Master and Junior Project Manager at the Digital Corps".
                   "If you would like to know more about his previous projects, work history, or where to find more information, just ask!";

        $alexa_response = self::get_response_object($message);
        return $response->withJson($alexa_response);
    }

    public static function project($request, $response, $args) {
        $message = "This intent is not yet implemented";

        $alexa_response = self::get_response_object($message);
        return $response->withJson($alexa_response);
    }

    public static function work($request, $response, $args) {
        $message = "This intent is not yet implemented";

        $alexa_response = self::get_response_object($message);
        return $response->withJson($alexa_response);
    }

    public static function more($request, $response, $args) {
        $message = "This intent is not yet implemented";

        $alexa_response = self::get_response_object($message);
        return $response->withJson($alexa_response);
    }

}