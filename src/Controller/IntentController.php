<?php

class IntentController {

    public static function get_response_object($message, $ssml = "") {
        return $res = [
            "version" => "1.0",
            "response" => [
                "outputSpeech" => [
                    "type" => ($ssml !== "" ? "SSML" : "PlainText"),
                    "text" => $message,
                    "ssml" => $ssml,
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
        $message = "Seth Campbell is a full-stack developer currently living in Muncie Indiana and ".
                   "attending Ball State University for Computer Science. ".
                   "He is skilled in many programming technologies, such as ReactJS, React Native, Slim, PDO, and many more. ".
                   "Seth is also skilled in several different languages including Java, JavaScript, PHP, HTML, CSS, and MySQL. ".
                   "He currently holds the rank of Development Master and Junior Project Manager at the Digital Corps. ".
                   "If you would like to know more about his previous projects, work history, or where to find more information, just ask!";

        $alexa_response = self::get_response_object($message);
        return $response->withJson($alexa_response);
    }

    public static function project($request, $response, $args) {
        $projects = [
            "<speak>
                 <p>Here is a fun one!</p>
                 <p>
                     In 2016, Seth worked on the Equipment Checkout System for internal use at the Digital Corps. 
                     The System is comprised of five total repositories and is a full service solution 
                     that completely automated the once paper-only system, allowing students to create reservations, 
                     and check out various pieces of equipment. The system is also completely integrated with Slack, a messaging software, 
                     so that admins can review reservations, and users can be notified of any important events. The 
                     Equipment Checkout System is an excellent example of one of the full stack solutions Seth has worked on.
                 </p>
                 <p>
                     The following technologies were used on this project:
                     AngularJS,
                     Ajax,
                     SSO,
                     Relational Database Design,
                     PHP,
                     Slim,
                     PDO,
                     JavaScript,
                     Node.js,
                     Slack Integration,
                     LAMP Stack, and
                     MySQL
                 </p>
             </speak>",
            "<speak></speak>",
            "<speak></speak>",
            "<speak></speak>",
            "<speak></speak>"
        ];

        $ssml = $projects[0];

        $alexa_response = self::get_response_object($ssml, $ssml);
        return $response->withJson($alexa_response);
    }

    public static function work($request, $response, $args) {
        $ssml = "<speak>Seth is currently working as a Development Master and Junior Project Manager at the Digital Corps, ".
            "a student run digital production group led by a few Ball State Staff members. Over his time at the ".
            "Digital Corps, Seth has been promoted twice, starting as an Apprentice, then working his way to a ".
            "Specialist before becoming a Master. He has been with the Digital Corps since September of 2016, and ".
            "since then, he has been privileged to work on over 20 projects including work in frontend, backend, ".
            "mobile, <say-as interpret-as='characters'>AR</say-as>, and VR development. He also has had project management experience, once managing a project ".
            "that included over 25 of his peers. To learn more about the projects Seth has worked on, just ask!</speak>";

        $alexa_response = self::get_response_object($ssml, $ssml);
        return $response->withJson($alexa_response);
    }

    public static function more($request, $response, $args) {
        $ssml = "<speak>If you would like to learn more about Seth, you should check out his main portfolio site at seth<break time='0s'/>r<break time='0s'/>camp.com!</speak>";

        $alexa_response = self::get_response_object($ssml, $ssml);
        return $response->withJson($alexa_response);
    }

}
