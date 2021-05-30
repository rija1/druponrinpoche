<?php

require_once('include.php');

$redirectUrl = ZOOM_REDIRECT_URI;
$url = "https://zoom.us/oauth/authorize?response_type=code&client_id=".ZOOM_CLIENT_ID."&redirect_uri=".$redirectUrl;
?>
  
<a href="<?php echo $url.'&zoom_action=get_token'; ?>">Request Token</a><br/>
<a href="<?php echo $url.'&zoom_action=refresh_token'; ?>">Refresh Token</a><br/>
<a href="<?php echo $url.'&zoom_action=create_meeting'; ?>">Create Meeting</a><br/>
<a href="<?php echo $url.'&zoom_action=check_part'; ?>">Get Participants List</a><br/>