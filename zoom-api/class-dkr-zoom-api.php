<?php
class DkrZoomAPI {

    protected $_wpdb;
    protected $_clientId;
    protected $_clientSecret;
    protected $_redirectUri;

    public function __construct($wpdb,$clientId,$clientSecret,$redirectUri){
        if(!isset($this->_wpdb)){
            $this->_wpdb = $wpdb;
            $this->_clientId = $clientId;
            $this->_clientSecret = $clientSecret;
            $this->_redirectUri = $redirectUri;
        }
    }

    public function is_table_empty() {
        $result = $this->_wpdb->get_results("SELECT id FROM zoom_token");
        //  echo'<pre>';var_dump(count($result));echo'</pre>';
        if(count($result)) {
            return false;
        }
        return true;
    }
  
    public function get_access_token() {
        $result = $this->_wpdb->get_results("SELECT access_token FROM zoom_token");
        if(count($result)) {
            return json_decode($result[0]->access_token);
        }
        return false;
    }
  
    public function get_refresh_token() {
        $result = $this->get_access_token();
        return $result->refresh_token;
    }
  
    public function update_access_token($token) {
        if($this->is_table_empty()) {
            $this->_wpdb->query("INSERT INTO zoom_token(access_token) VALUES('$token')");
        } else {
            $this->_wpdb->query($this->_wpdb->prepare("UPDATE zoom_token SET access_token = '$token'"));
        }
    }

    public function requestZoomToken() {
        try {
            $client = new GuzzleHttp\Client(['base_uri' => 'https://zoom.us/']);
            $response = $client->request('POST', '/oauth/token', [
                "headers" => [
                    "Authorization" => "Basic ". base64_encode(ZOOM_CLIENT_ID.':'.ZOOM_CLIENT_SECRET)
                ],
                'form_params' => [
                    "grant_type" => "authorization_code",
                    "code" => $_GET['code'],
                    "redirect_uri" => ZOOM_REDIRECT_URI
                ],
            ]);
            $token = json_decode($response->getBody()->getContents(), true);
            if($this->is_table_empty()) {
                $this->update_access_token(json_encode($token));
                echo "Access token inserted successfully.";
            }
        } catch(Exception $e) {
            die($e->getMessage());
            echo $e->getMessage();
        }
    }

    public function refreshZoomToken() {
        try {
            $refresh_token = $this->get_refresh_token();
        
            $client = new GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);
            $response = $client->request('POST', '/oauth/token', [
                "headers" => [
                    "Authorization" => "Basic ". base64_encode(ZOOM_CLIENT_ID.':'.ZOOM_CLIENT_SECRET)
                ],
                'form_params' => [
                    "grant_type" => "refresh_token",
                    "refresh_token" => $refresh_token
                ],
            ]);
            $this->update_access_token($response->getBody());
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    public function doAction($type,$requestBody=false,$requestParams=array(),$extraParams=false) {

        $client = new GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
        $arr_token = $this->get_access_token();
        $accessToken = $arr_token->access_token;

        switch($type) {
            case 'create-meeting':
                $callUrl = '/v2/users/me/meetings';
                $method = 'POST';
                break;
            case 'list-meetings':
                $callUrl = '/v2/users/me/meetings';
                $method = 'GET';
                break;
            case 'get-past-meeting-participants':

                $requestParams = array(
                    'page_size' => 300,
                );
                if(is_array($extraParams) && $extraParams['next_page_token']) {
                    $requestParams['next_page_token']=$extraParams['next_page_token'];
                }
                $callUrl = '/v2/past_meetings/'.$extraParams['meeting_id'].'/participants';
                $callUrl = $callUrl . "?" . http_build_query($requestParams);

                $method = 'GET';
                break;
            // case 'list-meeting-participants':
            //     $callUrl = '/v2/metrics/meetings/'.$extraParams['meeting_id'].'/participants';
            //     $method = 'GET';
            //     break;
        }

        try {
            $requestParams = array();
            $requestParams["headers"] = array("Authorization" => "Bearer $accessToken");
            if($requestBody) {
                $requestParams["json"] = $requestBody;
            }

            $response = $client->request($method, $callUrl, $requestParams);

            return $response;

        } catch(Exception $e) {
            if( 401 == $e->getCode() ) {
                $this->refreshZoomToken();
                $this->doAction($type,$requestBody,$requestBody,$extraParams);   
            } else {
                echo $e->getMessage();
                return false;
            }
        }

    }

    public function listMeetings() {
        if($response = $this->doAction('list-meetings'))
        {
            $data = json_decode($response->getBody());
            if ( !empty($data) ) {
                foreach ( $data->meetings as $d ) {
                    $topic = $d->topic;
                    $join_url = $d->join_url;
                    echo "<h3>Topic: $topic</h3>";
                    echo "Join URL: $join_url";
                }
            }
        }

    }

    public function createMeeting($topic,$type=2,$start_time,$duration,$password) {

        $bodyParams = [
            "topic" => $topic,
            //"topic" => "Let's learn Laravel",
            "type" => $type,
            //"type" => 2,
            "start_time" => $start_time,
            //"start_time" => "2021-03-05T20:30:00",
            "duration" => $duration, // 30 mins
            //"duration" => "30", // 30 mins
            "password" => $password
            //"password" => "123456"
        ];

        if($response = $this->doAction('create-meeting',$bodyParams))
        {
            $data = json_decode($response->getBody());
            echo "Join URL: ". $data->join_url;
            echo "<br>";
            echo "Meeting Password: ". $data->password;
        }
    }

    // public function listMeetingParticipants($meetingId) {
    //     if($response = $this->doAction('list-meeting-participants',false,array(),array('meeting_id' => $meetingId)))
    //     {
    //         $data = json_decode($response->getBody());
    //         if ( !empty($data) ) {
    //             foreach ( $data->participants as $p ) {
    //                 echo '<pre>';
    //                 print_r($p);
    //                 echo '</pre>';
    //                 die();
    //                 $name = $p->name;
    //                 $email = $p->user_email;
    //                 echo "Name: $name";
    //                 echo "Email: $email";
    //             }
    //         }
    //     }
    // }

    public function getPastMeetingParticipants($meetingId) {

        if($response = $this->doAction('get-past-meeting-participants',false,array(),array('meeting_id' => $meetingId)))
        {
            $data = json_decode($response->getBody());


            echo '<pre>';
            print_r($data);
            echo '</pre>';

            if ( !empty($data) ) {
                echo count($data->participants);
                foreach ( $data->participants as $p ) {
                    

                    // $name = $p->name;
                    // $email = $p->user_email;
                    // echo "Name: $name";
                    // echo "Email: $email";
                }
            }
        }

    }
}