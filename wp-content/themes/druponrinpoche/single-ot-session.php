<?php
get_header();
$course = getSessionCourse(get_the_ID());
$userId = get_current_user_id();
$registeredToCourse = isUserRegisteredToCourse($userId, $course->ID);

// We check if the user is logged in and registered to the course
if ( !is_user_logged_in() || !$registeredToCourse) {
    $curr = UM()->permalinks()->get_current_url();
    $redirect = esc_url( add_query_arg( 'redirect_to', urlencode_deep( $curr ), um_get_core_page( 'login' ) ) );
    exit( wp_redirect( $redirect ) );
}

saveAttendance($userId,get_the_ID(),$course->ID);

$youtubeVideos = rwmb_meta('_youtube_lang_url');
$zoomMeeting = rwmb_meta('_zoom_meeting');


// ROTATE ZOOM USERS - FOR FOUR DHARMAS OF GAMPOPA COURSE (Hard Coded IDS!!!)
//$sessionId = get_the_ID();
//$sessionZoomGroups = array (
//    '15036' => 'odd',
//    '15037' => 'even',
//    '15038' => 'odd',
//    '15039' => 'even',
//    '15040' => 'odd',
//    '15041' => 'even',
//);
//
//$spanishUsers = array();
//
//if(array_key_exists($sessionId,$sessionZoomGroups)) {
//
//    $thisSessionZoomGroup = $sessionZoomGroups[$sessionId];
//    $showZoom = false;
//
//    //If User
//    if($userId % 2 == 0){
//        if($thisSessionZoomGroup == 'even') {
//            $showZoom = true;
//        }
//    } else{
//        if($thisSessionZoomGroup == 'odd') {
//            $showZoom = true;
//        }
//    }
//}
// END ROTATE ZOOM USERS

?>
    <div class="section section-blog online-teachings">
        <div class="container">
            <div class="blog-columns">
                <?php get_template_part( 'online-teaching-left-menu'); ?>
                <div class="inner-page-container">
                    <div class="section-title">
                        <h1><?php the_title(); ?></h1>
                    </div>
                    <article class="single-post">
                        <div class="article-text">
                            <?php the_content(); ?>
                            <?php // if($showZoom): // ROTATE ZOOM USERS ?>
                            <?php if($zoomMeeting): ?>
                            <h2>Access Teaching via Zoom</h2>
                                <?php
                                $zoomMeetingUrl = $zoomMeeting[0];
                                $zoomMeetingId = $zoomMeeting[1];
                                $zoomMeetingPasscode = $zoomMeeting[2];
                                ?>
                            <p>If you are Zoom set up please join us using the details below. Please also use your actual name (Dharma name for monastics) and have your camera turned on when the teaching starts.</p>
                                <div class="zoom_details">
                                    <div class="details_left"><?php echo pll__(' Join Zoom Meeting'); ?></div><div class="details_right"><a target="_blank" href="<?php echo $zoomMeetingUrl; ?>"><?php echo $zoomMeetingUrl; ?></a></div>
                                    <div class="details_left"><?php echo pll__(' Meeting ID'); ?></div><div class="details_right"><?php echo $zoomMeetingId; ?></div>
                                    <div class="details_left"><?php echo pll__(' Passcode'); ?></div><div class="details_right"><?php echo $zoomMeetingPasscode; ?></div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php // endif; ?>

                            <?php if($youtubeVideos): ?>
                                <h2>Access Teaching via YouTube</h2>
                                <?php foreach ($youtubeVideos as $youtubeVideo): ?>
                                    <?php
                                    $url = $youtubeVideo[1];
                                    preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
                                    $youtubeId = $matches[1];
                                    $youtubeWidth = '800px';
                                    $youtubeHeight = '450px';
                                    ?>
                                    <div class="session_video">
                                        <div class="details_left"><?php $youtubeVideo[0]; ?></div>
                                        <div class="details_right"><a target="_blank" href="<?php echo $url; ?>"><?php echo $url; ?></a></div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div> <!--  END section-blog  -->
<?php get_footer(); ?>