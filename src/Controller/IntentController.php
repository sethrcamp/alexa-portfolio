<?php

class IntentController {

    public static function get_response_object($message, $ssml = "", $sessionAttributes = []) {
        return $res = [
            "version" => "1.0",
            "sessionAttributes" => $sessionAttributes,
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
                   "his past projects, previous work experience, and hear how to learn more information about Seth!".
                   "Try asking about what he is like, about a past project, about previous work history, or about more info.";

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
                     NodeJS,
                     Slack Integration,
                     LAMP Stack, and
                     MySQL
                 </p>
             </speak>",
            "<speak>
                 <p>You are in for a treat!</p>
                 <p>
                     In 2017, Seth was the JPM for the BSU Multisite platform.
                     The BSU Multisite is a platform developed to service Ball State faculty and 
                     staff by creating an easy-to-use website creation platform. As the Junior Project 
                     Manager for the project, Seth's roles were to organize a team of over 20 students, 
                     communicate with the client, and insure a timely delivery of the platform to the users.
                 </p>
             </speak>",
            "<speak>
                 <p>This one is very interesting!</p>
                 <p>
                     In 2017, Seth worked on a project for the Career Center at Ball State.
                     The Career Center Certifications System was created for the Ball State University Career Center, 
                     and completely automates the process for both admins and students partaking in their intern and 
                     career ready programs. The system uses ReactJS for both frontends and PHP for the backend. Features 
                     include statistic reporting for admins, organizational tools for the admin approval process, and a 
                     student dashboard to track progress, receive notifications, and submit content for approval.
                 </p>
                 <p>
                     The following technologies were used on this project:
                     ReactJS,
                     Ajax,
                     SSO,
                     Relational Database Design,
                     PHP,
                     Slim,
                     PDO,
                     JavaScript,
                     LAMP Stack, and
                     MySQL
                 </p>
             </speak>",
            "<speak>
                 <p>This one sounds great!</p>
                 <p>
                     In 2017 and 2018, Seth worked on the Ball State Chirper app!
                     The Ball State Chirper app is a React Native app that promotes school pride through the 
                     use of games, a fight song, custom stickers, and of coarse, the classic chirp button! The 
                     app was a revamp of the original, and is a good example of Seth's work with React Native, specifically 
                     his work incorporating native android modules.
                 </p>
                 <p>
                     The following technologies were used on this project:
                     React Native,
                     JavaScript, and
                     Java
                 </p>
             </speak>",
            "<speak>
                 <p>I think you'll like this one!</p>
                 <p>
                     In 2017 and 2018, Seth worked on the Water Project.
                     The Water Project was a joint venture with The Digital Corps, 
                     another group of students called The Blue Roots Project, and a 
                     non-for-profit called The Circle of Blue. The purpose of the web-based 
                     platform is to increase awareness of the world-wide water crisis. The platform utilizes ReactJS, 
                     as well as many JS libraries in order to provide an interactive globe, and content management system. 
                     This project is a prime example of Seth's work with Component-based organization, and data manipulation.
                 </p>
                 <p>
                     The following technologies were used on this project:
                     ReactJS,
                     CesiumJS,
                     Bing Maps,
                     Ajax,
                     Relational Database Design,
                     PHP,
                     Slim,
                     PDO,
                     JavaScript,
                     LAMP Stack, and
                     MySQL
                 </p>
             </speak>"
        ];

        $body = $request->getParsedBody();

        if(isset($body['session']['attributes'])) {
            if($body['session']['attributes']['project_index'] >= sizeof($projects) - 1) {
                $project_index = 0;
            } else {
                $project_index = $body['session']['attributes']['project_index'] + 1;
            }
        } else {
            $project_index = 0;
        }

        $session_attributes = [
            'project_index' => $project_index
        ];

        $ssml = $projects[$project_index];

        $alexa_response = self::get_response_object($ssml, $ssml, $session_attributes);
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
        $ssml = "<speak>
                     If you would like to learn more about Seth, 
                     you should check out his main portfolio site at seth<break time='0s'/>r<break time='0s'/>camp.com or
                     you can ask me what he is like, about his past projects, and his past work history.
                </speak>";

        $alexa_response = self::get_response_object($ssml, $ssml);
        return $response->withJson($alexa_response);
    }

}
