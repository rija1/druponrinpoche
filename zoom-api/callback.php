<?php

require_once('include.php');

$zoomAction = $_GET['zoom_action'];
$dkrZoomApi = new DkrZoomAPI($wpdb,ZOOM_CLIENT_ID,ZOOM_CLIENT_SECRET,ZOOM_REDIRECT_URI);

$zoomAction = 'get_past_meet_part';

switch($zoomAction) {
    case 'get_token':
        $dkrZoomApi->requestZoomToken();
        break;
    case 'refresh_token':
        $dkrZoomApi->requestZoomToken();
        break;
    case 'get_past_meet_part':
        $dkrZoomApi->getPastMeetingParticipants('83929546116');
        break;
    case 'list_meet_part':
        $dkrZoomApi->listMeetingParticipants('83929546116');
        break;
    case 'create_meeting':
        $dkrZoomApi->createMeeting('Test Meeting API',2,'2021-05-27T20:30:00',30,'123456');
        break;
    case 'list_meetings':
        $dkrZoomApi->listMeetings();
        break;

}

