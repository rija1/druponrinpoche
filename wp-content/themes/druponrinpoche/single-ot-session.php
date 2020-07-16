<?php
get_header();
$course = getSessionCourse(get_the_ID());
$userId = get_current_user_id();
$registeredToCourse = isUserRegisteredToCourse($userId, $course->ID);

if ( !is_user_logged_in() || !$registeredToCourse) {
    $curr = UM()->permalinks()->get_current_url();
    $redirect = esc_url( add_query_arg( 'redirect_to', urlencode_deep( $curr ), um_get_core_page( 'login' ) ) );
    exit( wp_redirect( $redirect ) );
}

saveAttendance($userId,get_the_ID(),$course->ID);

$youtubeVideos = rwmb_meta('_youtube_lang_url');
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
                            <h2><?php the_title(); ?></h2>

                            <?php the_content(); ?>
                            <?php foreach ($youtubeVideos as $youtubeVideo): ?>
                                <?php
                                $url = $youtubeVideo[1];
                                preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
                                $youtubeId = $matches[1];
                                $youtubeWidth = '800px';
                                $youtubeHeight = '450px';
                                ?>

                                <span><?php echo $youtubeVideo[0]; ?></span>
                                <iframe width="560" height="315"
                                        src="https://www.youtube.com/embed/<?php echo $youtubeId ?>"
                                        frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>></iframe>
                            <?php endforeach; ?>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div> <!--  END section-blog  -->
<?php get_footer(); ?>