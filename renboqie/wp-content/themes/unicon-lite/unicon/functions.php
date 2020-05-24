<?php
/**
 * Word Count Limit
*/
if ( ! function_exists( 'unicon_lite_excerpt_more' ) ) {
    function unicon_lite_excerpt_more( $more ) {
        return '...';
    }
}
add_filter( 'excerpt_more', 'unicon_lite_excerpt_more' );


/**
 * Letter Count Function
*/
if ( ! function_exists( 'unicon_lite_letter_count' ) ) {
    function unicon_lite_letter_count($content, $limit) {
        $striped_content = strip_tags($content);
        $striped_content = strip_shortcodes($striped_content);
        $limit_content = mb_substr($striped_content, 0, $limit);
        if ($limit_content < $content) {
            $limit_content .= "...";
        }
        return $limit_content;
    }
}


/**
 * Top Header Quick Contact Function Area
*/
if ( ! function_exists( 'unicon_lite_quick_contact_info_top_header' ) ) {
	function unicon_lite_quick_contact_info_top_header() { 
        $unicon_lite_address_icon = get_theme_mod('unicon_lite_address_icon','fa-map-marker');
        $unicon_lite_map_address = get_theme_mod('unicon_lite_map_address', esc_html__('Mathuri Sadan, 5th floor Ravi Bhawan, Kathmandu, Nepal', 'unicon-lite'));
        
        $unicon_lite_start_open_icon = get_theme_mod('unicon_lite_start_open_icon','fa-clock-o');
        $unicon_lite_start_open_time = get_theme_mod('unicon_lite_start_open_time', esc_html__('Mon - Fri : 08:00 - 17:00', 'unicon-lite'));

        $unicon_lite_phone_icon = get_theme_mod('unicon_lite_phone_icon','fa-phone');
        $unicon_lite_phone_number = get_theme_mod('unicon_lite_phone_number', esc_html__('+977-1-4671980', 'unicon-lite'));

        $unicon_lite_email_icon = get_theme_mod('unicon_lite_email_icon','fa-envelope');
        $unicon_lite_email_title = get_theme_mod('unicon_lite_email_title','support@accesspressthemes.com');
        ?>
        <ul>
            <?php if(!empty( $unicon_lite_map_address )) { ?>              
                <li>
                    <span class="<?php if(!empty( $unicon_lite_address_icon )) { echo 'fa '.esc_attr($unicon_lite_address_icon); } ?>">&nbsp;</span>
                    <?php echo esc_html($unicon_lite_map_address); ?>
                </li>
            <?php }  ?>
            
            <?php if(!empty( $unicon_lite_start_open_time )) { ?>              
                <li>
                    <span class="<?php if(!empty( $unicon_lite_start_open_icon )) { echo 'fa '.esc_attr($unicon_lite_start_open_icon); } ?>">&nbsp;</span>
                    <?php echo esc_html($unicon_lite_start_open_time); ?>
                </li>
            <?php }  ?> 
            
            <?php if(!empty( $unicon_lite_phone_number )) { ?>        		
                <li>
                	<span class="<?php if(!empty( $unicon_lite_phone_icon )) { echo 'fa '.esc_attr($unicon_lite_phone_icon); } ?>">&nbsp;</span>
               		<?php echo $unicon_lite_phone_number; ?>
                </li>
            <?php }  ?>

            <?php if(!empty( $unicon_lite_email_title )) { ?>
                <li>
                    <span class="<?php if(!empty( $unicon_lite_email_icon )) { echo 'fa '.esc_attr($unicon_lite_email_icon); } ?>">&nbsp;</span>
                    <a href="mailto:<?php echo $unicon_lite_email_title; ?>"><?php echo esc_html($unicon_lite_email_title); ?></a>
                </li>
            <?php }  ?>               
        </ul>
        <?php 
    }
}
add_filter( 'unicon_lite_quick_contact_info_top_header', 'unicon_lite_quick_contact_info_top_header', 5 );


/**
 * Top Header Social Icon Function Area
*/
if ( ! function_exists( 'unicon_lite_social_icon_top_header' ) ) {
    function unicon_lite_social_icon_top_header() { 
        $unicon_lite_facebook_url = get_theme_mod('unicon_lite_facebook_url');
        $unicon_lite_twitter_url = get_theme_mod('unicon_lite_twitter_url');
        $unicon_lite_google_plus_url = get_theme_mod('unicon_lite_google_plus_url');
        $unicon_lite_linkedin_url = get_theme_mod('unicon_lite_linkedin_url');
        ?>
        <ul>
            <?php if(!empty( $unicon_lite_facebook_url )) { ?>              
                <li>
                    <a href="<?php echo esc_url($unicon_lite_facebook_url); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                </li>
            <?php }  ?>

            <?php if(!empty( $unicon_lite_twitter_url )) { ?>              
                <li>
                    <a href="<?php echo esc_url($unicon_lite_twitter_url); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                </li>
            <?php }  ?>

            <?php if(!empty( $unicon_lite_google_plus_url )) { ?>              
                <li>
                    <a href="<?php echo esc_url($unicon_lite_google_plus_url); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
                </li>
            <?php }  ?>

            <?php if(!empty( $unicon_lite_linkedin_url )) { ?>              
                <li>
                    <a href="<?php echo esc_url($unicon_lite_linkedin_url); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
                </li>
            <?php }  ?> 
        </ul>
        <?php 
    }
}
add_filter( 'unicon_lite_social_icon_top_header', 'unicon_lite_social_icon_top_header', 10 );


/**
 * Front Page Section Title
*/
if ( ! function_exists( 'unicode_lite_front_page_section_title' ) ) {
    function unicode_lite_front_page_section_title($main_title = null, $sub_title = null) { ?>
        <div class="container-wrap">
            <div class="section-title-wrap">
                <header class="section-title">
                    <h2 class="wow fadeInLeft"><?php echo esc_html($main_title); ?></h2>
                    <h3 class="wow fadeInRight"><?php echo esc_html($sub_title); ?></h3>
                </header>
            </div>
        </div>
        <?php
    }
}


/**
 * Front Page About Section
*/
if ( ! function_exists( 'unicon_lite_front_page_about_section' ) ) {
    function unicon_lite_front_page_about_section() {
        $about_options = get_theme_mod( 'unicon_lite_about_section_option', 'show' );

        $about_main_title = get_theme_mod( 'unicon_lite_about_section_main_title', esc_html__('Company', 'unicon-lite') );
        $about_sub_title  = get_theme_mod( 'unicon_lite_about_section_sub_title', esc_html__('We Are Goahead', 'unicon-lite') );
        if(!empty( $about_options ) && $about_options == 'show'){ ?>
            <section class="about-section clearfix">
                <?php unicode_lite_front_page_section_title( $about_main_title, $about_sub_title ); ?>
                <div class="about-content-wrapper">
                    <div class="container-wrap">
                        <div class="about-content">
                            <?php
                                $about_page_id = get_theme_mod( 'unicon_lite_about_section_page', 2 );
                                if( !empty( $about_page_id ) ) {
                                $about_query = new WP_Query( 'page_id='.$about_page_id );
                                    if( $about_query->have_posts() ) { while( $about_query->have_posts() ) { $about_query->the_post();
                                    ?>
                                        <h3><?php the_title(); ?></h3>
                                        <?php the_excerpt(); ?>
                                        <div class="readmore">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php _e('Read More','unicon-lite'); ?>
                                            </a>
                                        </div>
                                    <?php
                                    } } wp_reset_postdata();
                                }
                            ?>
                        </div>

                        <div class="aboutserviceswrap">
                           <?php
                                $about_cat_id = get_theme_mod( 'unicon_lite_team_id', 1 );
                                if( !empty( $about_cat_id ) ) {
                                $about_args = array(
                                    'post_type' => 'post',
                                    'tax_query' => array(
                                        array(
                                            'taxonomy'  => 'category',
                                            'field'     => 'id', 
                                            'terms'     => $about_cat_id                                                                 
                                        )),
                                    'posts_per_page' => -1
                                );

                                $about_query = new WP_Query( $about_args );
                                   if( $about_query->have_posts() ) { while( $about_query->have_posts() ) { $about_query->the_post();
                                   $image_id = get_post_thumbnail_id();
                                   $image_path = wp_get_attachment_image_src( $image_id, 'unicon-lite-about-image', true );                               
                                ?>
                                <div class="aboutservices">
                                <div class="about-image-column">
                                    <?php if( has_post_thumbnail() ) { ?>
                                        <div class="about-image">
                                            <figure><img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php the_title(); ?>" /></figure>
                                        </div>
                                    <?php   } ?>
                                   <h4><?php the_title(); ?></h4>
                                   <?php echo wp_trim_words(get_the_excerpt(), 25); ?>
                                   </div>
                                </div>
                                <?php  } } wp_reset_postdata(); ?>

                            <?php } ?> 
                        </div>
                    </div>
                </div>
            </section>
        <?php   
        }
    }
}
add_action( 'unicon_lite_about_section', 'unicon_lite_front_page_about_section' );


/**
 * Front Page Services Section
*/
if ( ! function_exists( 'unicon_lite_front_page_services_section' ) ) {
    function unicon_lite_front_page_services_section() {
        $services_options = get_theme_mod( 'unicon_lite_services_section_option', 'show' );

        $services_main_title = get_theme_mod( 'unicon_lite_services_section_main_title', esc_html__('Services', 'unicon-lite') );
        $services_sub_title  = get_theme_mod( 'unicon_lite_services_section_sub_title', esc_html__('What We Do', 'unicon-lite') );
        $services_bg_image  = get_theme_mod( 'unicon_lite_services_bg_image' );
        
        if(!empty( $services_options ) && $services_options == 'show'){ ?>
            <section class="unicon-services-section clearfix">
                <?php unicode_lite_front_page_section_title( $services_main_title, $services_sub_title ); ?>
                <div class="container-wrap">
                    <div class="services-area-wrapper img-responsive" <?php if ( !empty( $services_bg_image ) ){ echo 'style="background-image: url(' . esc_url($services_bg_image) . '); "'; } ?>>
                            
                        <div class="servicesrow">

                            <div class="row-items">                            
                                <div class="serviceswrap servicesone wow fadeInLeft">
                                    <div class="item-box">
                                        <?php
                                            $services_one_icon = get_theme_mod( 'unicon_lite_service_icon_0','fa-flag' );
                                            $services_one_page_id = get_theme_mod( 'unicon_lite_service_page_id_0', 2 );
                                            if( !empty( $services_one_page_id ) ) {
                                            $services_one_query = new WP_Query( 'page_id='.intval($services_one_page_id) );
                                                if( $services_one_query->have_posts() ) { while( $services_one_query->have_posts() ) { $services_one_query->the_post();
                                                ?>
                                                    <div class="item-icon fa <?php echo esc_attr($services_one_icon); ?>"></div>
                                                    <div class="item-vertical-line"></div>
                                                    <div class="item-id"><?php echo esc_html__('01', 'unicon-lite'); ?></div>
                                                    <div class="item-title"><?php the_title(); ?></div>
                                                    <div class="item-text"><?php echo wp_trim_words(get_the_excerpt(), 10); ?></div>

                                                <?php
                                                } } wp_reset_postdata();
                                            }
                                        ?>                            
                                    </div>
                                </div>

                                <div class="serviceswrap servicestwo wow fadeInRight">
                                    <div class="item-box">
                                        <?php
                                            $services_two_icon = get_theme_mod( 'unicon_lite_service_icon_1','fa-flag' );
                                            $services_two_page_id = get_theme_mod( 'unicon_lite_service_page_id_1', 2 );
                                            if( !empty( $services_two_page_id ) ) {
                                            $services_two_query = new WP_Query( 'page_id='.intval($services_two_page_id) );
                                                if( $services_two_query->have_posts() ) { while( $services_two_query->have_posts() ) { $services_two_query->the_post();
                                                ?>
                                                    <div class="item-icon fa <?php echo esc_attr($services_two_icon); ?>"></div>
                                                    <div class="item-vertical-line"></div>
                                                    <div class="item-id"><?php echo esc_html__('02', 'unicon-lite'); ?></div>
                                                    <div class="item-title"><?php the_title(); ?></div>
                                                    <div class="item-text"><?php echo wp_trim_words(get_the_excerpt(), 10); ?></div>

                                                <?php
                                                } } wp_reset_postdata();
                                            }
                                        ?>                                   
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="servicesrow">
                            <div class="row-items">
                                <div class="serviceswrap servicesthree wow fadeInLeft">
                                    <div class="item-box">
                                        <?php
                                            $services_three_icon = get_theme_mod( 'unicon_lite_service_icon_2','fa-flag' );
                                            $services_three_page_id = get_theme_mod( 'unicon_lite_service_page_id_2', 2 );
                                            if( !empty( $services_three_page_id ) ) {
                                            $services_three_query = new WP_Query( 'page_id='.intval($services_three_page_id) );
                                                if( $services_three_query->have_posts() ) { while( $services_three_query->have_posts() ) { $services_three_query->the_post();
                                                ?>
                                                    <div class="item-icon fa <?php echo esc_attr($services_three_icon); ?>"></div>
                                                    <div class="item-vertical-line"></div>
                                                    <div class="item-id"><?php echo esc_html__('03', 'unicon-lite'); ?></div>
                                                    <div class="item-title"><?php the_title(); ?></div>
                                                    <div class="item-text"><?php echo wp_trim_words(get_the_excerpt(), 10); ?></div>

                                                <?php
                                                } } wp_reset_postdata();
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="serviceswrap servicesfour wow fadeInRight">
                                    <div class="item-box">
                                        <?php
                                            $services_four_icon = get_theme_mod( 'unicon_lite_service_icon_3','fa-flag' );
                                            $services_four_page_id = get_theme_mod( 'unicon_lite_service_page_id_3', 2 );
                                            if( !empty( $services_four_page_id ) ) {
                                            $services_four_query = new WP_Query( 'page_id='.intval($services_four_page_id) );
                                                if( $services_four_query->have_posts() ) { while( $services_four_query->have_posts() ) { $services_four_query->the_post();
                                                ?>
                                                    <div class="item-icon fa <?php echo esc_attr($services_four_icon); ?>"></div>
                                                    <div class="item-vertical-line"></div>
                                                    <div class="item-id"><?php echo esc_html__('04', 'unicon-lite'); ?></div>
                                                    <div class="item-title"><?php the_title(); ?></div>
                                                    <div class="item-text"><?php echo wp_trim_words(get_the_excerpt(), 10); ?></div>

                                                <?php
                                                } } wp_reset_postdata();
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="servicesrow">
                            <div class="row-items">
                                <div class="serviceswrap servicesfive wow fadeInLeft">
                                    <div class="item-box">
                                        <?php
                                            $services_five_icon = get_theme_mod( 'unicon_lite_service_icon_4','fa-flag' );
                                            $services_five_page_id = intval( get_theme_mod( 'unicon_lite_service_page_id_4', 2 ));
                                            if( !empty( $services_five_page_id ) ) {
                                            $services_five_query = new WP_Query( 'page_id='.intval($services_five_page_id) );
                                                if( $services_five_query->have_posts() ) { while( $services_five_query->have_posts() ) { $services_five_query->the_post();
                                                ?>
                                                    <div class="item-icon fa <?php echo esc_attr($services_five_icon); ?>"></div>
                                                    <div class="item-vertical-line"></div>
                                                    <div class="item-id"><?php echo esc_html__('05', 'unicon-lite'); ?></div>
                                                    <div class="item-title"><?php the_title(); ?></div>
                                                    <div class="item-text"><?php echo wp_trim_words(get_the_excerpt(), 10); ?></div>

                                                <?php
                                                } } wp_reset_postdata();
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="serviceswrap servicessix wow fadeInRight">
                                    <div class="item-box">
                                        <?php
                                            $services_six_icon = get_theme_mod( 'unicon_lite_service_icon_5','fa-flag' );
                                            $services_six_page_id = get_theme_mod( 'unicon_lite_service_page_id_5', 2 );
                                            if( !empty( $services_six_page_id ) ) {
                                            $services_six_query = new WP_Query( 'page_id='.intval($services_six_page_id) );
                                                if( $services_six_query->have_posts() ) { while( $services_six_query->have_posts() ) { $services_six_query->the_post();
                                                ?>
                                                    <div class="item-icon fa <?php echo esc_attr($services_six_icon); ?>"></div>
                                                    <div class="item-vertical-line"></div>
                                                    <div class="item-id"><?php echo esc_html__('06', 'unicon-lite'); ?></div>
                                                    <div class="item-title"><?php the_title(); ?></div>
                                                    <div class="item-text"><?php echo wp_trim_words(get_the_excerpt(), 10); ?></div>

                                                <?php
                                                } } wp_reset_postdata();
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div><!-- .section-content-wrapper -->
                </div>
            </section>
        <?php   
        }
    }
}
add_action( 'unicon_lite_services_section', 'unicon_lite_front_page_services_section' );


/**
 * Front Page Services Section
*/
if ( ! function_exists( 'unicon_lite_front_page_sucess_graph_section' ) ) {
    function unicon_lite_front_page_sucess_graph_section() {
        $sucess_graph_options = get_theme_mod( 'unicon_lite_sucess_graph_section_option', 'show' );

        $sucess_graph_main_title = get_theme_mod( 'unicon_lite_sucess_graph_section_main_title', esc_html__('Sucess', 'unicon-lite') );
        $sucess_graph_sub_title  = get_theme_mod( 'unicon_lite_sucess_graph_section_sub_title', esc_html__('Yearly Graph', 'unicon-lite') );
        
        if(!empty( $sucess_graph_options ) && $sucess_graph_options == 'show'){ ?>
            <section class="unicon-sucess-section clearfix">
                <?php unicode_lite_front_page_section_title( $sucess_graph_main_title, $sucess_graph_sub_title ); ?>
                <div class="container-wrap">
                <div class="sucess-graph-wrap">

                    <div class="sucessgraph" style="width:450px">
                        <canvas id="canvas" height="450" width="600"></canvas>
                    </div>

                </div>
                <div class="sucess-content-wrapper">
                    <?php
                        $sucess_page_id = get_theme_mod( 'unicon_lite_sucess_graph_section_page', 2 );
                        if( !empty( $sucess_page_id ) ) {
                        $about_query = new WP_Query( 'page_id='.intval($sucess_page_id) );
                            if( $about_query->have_posts() ) { while( $about_query->have_posts() ) { $about_query->the_post();
                            ?>
                                <h4><?php the_title(); ?></h4>
                                <h5><?php the_title(); ?></h5>
                                <?php the_excerpt(); ?>
                            <?php
                            } } wp_reset_postdata();
                        }
                    ?>
                </div><!-- .section-content-wrapper -->
                </div><!--container-wrap-->
                
            </section>
        <?php   
        }
    }
}
add_action( 'unicon_lite_sucess_graph_section', 'unicon_lite_front_page_sucess_graph_section' );


/**
 * Front Page Counter Section
*/
if ( ! function_exists( 'unicon_lite_front_page_counter_section' ) ) {
    function unicon_lite_front_page_counter_section() {
        $counter_options = get_theme_mod( 'unicon_lite_counter_section_option', 'show' );

        
        if(!empty( $counter_options ) && $counter_options == 'show'){ ?>
            <section class="unicon-counter-section clearfix">
                <div class="container-wrap">

                    <div class="unicon-counter-wrap">
                        <?php
                            for ( $count = 1; $count <= 4; $count++ ) {

                                $count_title =  get_theme_mod( 'unicon_lite_counter_section_title_'.$count, __('<span>We Have</span> Completed Projects', 'unicon-lite') );
                                $count_number = get_theme_mod( 'unicon_lite_counter_section_number_'.$count, '272' );
                                $count_icon = get_theme_mod( 'unicon_lite_counter_section_icon_'.$count, 'fa-envelope' );
                        ?>                        
                            <div class="unicon-counter count_<?php echo $count; ?>">                                
                                <?php if(!empty($count_title)) { ?>
                                    <h6 class="counter-title title-one">
                                        <?php echo wp_kses_post($count_title); ?>
                                    </h6>
                                <?php } ?>
                                <?php if(!empty($count_number)) { ?><div class="counter counter-one"><?php echo intval($count_number); ?></div><?php } ?>
                                <?php if(!empty($count_icon)) { ?>
                                <span class="counter-icon icon-one">                                    
                                    <i class="fa <?php echo esc_attr($count_icon); ?> fa-2x"></i>
                                </span>                                 
                                <?php } ?>
                            </div>
                        <?php } ?>

                    </div>
                </div>

            </section>                
        <?php   
        }
    }
}
add_action( 'unicon_lite_counter_section', 'unicon_lite_front_page_counter_section' );


/**
 * Front Page Team Section
*/
if ( ! function_exists( 'unicon_lite_front_page_team_section' ) ) {
    function unicon_lite_front_page_team_section() {
        $team_options = get_theme_mod( 'unicon_lite_team_section_option', 'hide' );

        $team_main_title = get_theme_mod( 'unicon_lite_team_section_main_title', esc_html__('Our Team', 'unicon-lite') );
        $team_sub_title  = get_theme_mod( 'unicon_lite_team_section_sub_title', esc_html__('Active Expert', 'unicon-lite') );
       
        if(!empty( $team_options ) && $team_options == 'show'){ ?>
            <section class="team-section clearfix">
                <?php unicode_lite_front_page_section_title( $team_main_title, $team_sub_title ); ?>
                <div class="container-wrap">
                <div class="team-section-content-wrap">
                <div class="teamwrap">
                    <?php
                       $team_cat_id = get_theme_mod( 'unicon_lite_team_team_id', '0');
                       if( !empty( $team_cat_id ) ) {
                        $team_args = array(
                            'post_type' => 'post',
                            'tax_query' => array(
                                array(
                                    'taxonomy'  => 'category',
                                    'field'     => 'id', 
                                    'terms'     => $team_cat_id                                                                 
                                )),
                            'posts_per_page' => -1
                        );

                        $team_query = new WP_Query( $team_args );
                           if( $team_query->have_posts() ) { while( $team_query->have_posts() ) { $team_query->the_post();
                           $image_id = get_post_thumbnail_id();
                           $image_path = wp_get_attachment_image_src( $image_id, 'unicon-lite-team-image', true );                           
                    ?>
                        <div class="teaminfo">
                        <div class="team-info-description">
                            <?php the_excerpt(); ?>
                            <h4><?php the_title(); ?></h4>
                            </div>

                            <?php if( has_post_thumbnail() ) { ?>
                                <div class="team-image">
                                    <figure><img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php the_title(); ?>" /></figure>
                                </div>
                            <?php   } ?> 
                        </div>
                    <?php  } } wp_reset_postdata();  } ?> 
                </div>
                </div>
                </div>
            </section>
        <?php   
        }
    }
}
add_action( 'unicon_lite_team_section', 'unicon_lite_front_page_team_section' );


/**
 * Front Page Video Section
*/
if ( ! function_exists( 'unicon_lite_front_page_video_section' ) ) {
    function unicon_lite_front_page_video_section() {
        $unicon_video_options = get_theme_mod( 'unicon_lite_video_section_option', 'hide' );
        $unicon_video_url = get_theme_mod( 'unicon_lite_video_section_url', 'BsekcY04xvQ');
        $unicon_video_title = get_theme_mod( 'unicon_lite_video_section_main_title', esc_html__('Watch Our Intro Video', 'unicon-lite') );
        $unicon_video_desc  = wp_filter_nohtml_kses( get_theme_mod( 'unicon_lite_video_description', esc_html__('Lorem ipsum dolor sit amet consectetur elit', 'unicon-lite') ) );
       
        if(!empty( $unicon_video_options ) && $unicon_video_options == 'show'){ ?>
            <section class="video-section clearfix">
                <?php
                    if($unicon_video_url){ 
                        $unicon_video_arra = explode('?v=', esc_attr($unicon_video_url));
                        if( !empty( $unicon_video_arra[1] ) ) {
                            $unicon_video_id = $unicon_video_arra[1];
                        }else{
                            $unicon_video_id = 'BsekcY04xvQ';
                        }
                ?>
                    <div id="uniconbgndVideo" class="player" data-property="{videoURL:'<?php echo esc_attr($unicon_video_id) ?>'}">
                    </div>
                <?php }  ?>

                <div id="uniconvideoframe" class="video-wrapper" style="height:400px;">
                    <div class="videoinfo">
                        <?php if(!empty( $unicon_video_title )) { ?>
                            <h3><?php echo esc_html($unicon_video_title); ?></h3>
                        <?php } ?>
                        <?php if(!empty( $unicon_video_desc )) { ?>
                            <p><?php echo esc_html($unicon_video_desc); ?></p>
                        <?php } ?>
                    </div>
                </div>
                <button id="togglePlay" class="play-pause-video"></button>
            </section>
        <?php   
        }
    }
}
add_action( 'unicon_lite_video_section', 'unicon_lite_front_page_video_section' );

/**
 * Front Page Our Works Section
*/
if ( ! function_exists( 'unicon_lite_front_page_works_section' ) ) {
    function unicon_lite_front_page_works_section() {
        $unicon_works_options = get_theme_mod( 'unicon_lite_works_section_option', 'show' );
        $unicon_work_main_title = get_theme_mod( 'unicon_lite_works_section_main_title', esc_html__('Our Works', 'unicon-lite') );
        $unicon_work_sub_title  = get_theme_mod( 'unicon_lite_works_section_sub_title', esc_html__('Project Done', 'unicon-lite') );
       
        if(!empty( $unicon_works_options ) && $unicon_works_options == 'show'){ ?>
            <section class="works-section clearfix">
                <?php unicode_lite_front_page_section_title( $unicon_work_main_title, $unicon_work_sub_title ); ?>
                <div class="scrollPane">
                    <div class="workcontentwrap clear">
                        <?php
                           $unicon_works_cat_id = get_theme_mod( 'unicon_lite_works_team_id', 1 );
                           if( !empty( $unicon_works_cat_id ) ) {
                            $work_args = array(
                                'post_type' => 'post',
                                'tax_query' => array(
                                    array(
                                        'taxonomy'  => 'category',
                                        'field'     => 'id', 
                                        'terms'     => $unicon_works_cat_id                                                                 
                                    )),
                                'posts_per_page' => -1
                            );

                            $work_query = new WP_Query( $work_args );
                               if( $work_query->have_posts() ) { while( $work_query->have_posts() ) { $work_query->the_post();
                               $image_id = get_post_thumbnail_id();
                               $image_path = wp_get_attachment_image_src( $image_id, 'unicon-lite-work-image', true );                           
                        ?>
                            <div class="ourworkwrap">
                                <?php if( has_post_thumbnail() ) { ?>
                                    <div class="works-image">
                                        <figure><img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php the_title(); ?>" /></figure>
                                    </div>
                                <?php   } ?>
                                <div class="wrokswrap-info">
                                <div class="inner-wrokswrap-info">
                                    <?php the_tags( '' ); ?>
                                    <h4><?php the_title(); ?></h4> 
                                </div>
                                </div>                          
                            </div>
                        <?php  } } wp_reset_postdata();  } ?> 
                    </div>
                </div>
                <div class="scroll-bar"></div>
            </section>
        <?php   
        }
    }
}
add_action( 'unicon_lite_works_section', 'unicon_lite_front_page_works_section' );



/**
 * Front Page Call To Action Section
*/
if ( ! function_exists( 'unicon_lite_front_page_call_to_action_section' ) ) {
    function unicon_lite_front_page_call_to_action_section() {
        $call_to_action_options = get_theme_mod( 'unicon_lite_call_to_action_section_option', 'show' );

        $call_to_action_bg = get_theme_mod( 'unicon_lite_call_to_action_bg' );

        $call_action_title = get_theme_mod( 'unicon_lite_call_to_action_section_main_title', esc_html__('Unicon WordPress Theme', 'unicon-lite') );
        $call_action_desc  = get_theme_mod( 'unicon_lite_call_to_action_description', esc_html__('Build promptly, Launch Fast', 'unicon-lite') );
        
        $unicon_first_button_title = get_theme_mod( 'unicon_lite_call_to_action_first_button_title', esc_html('Read More', 'unicon-lite') );
        $unicon_first_button_url = get_theme_mod( 'unicon_lite_call_to_action_first_button_url', esc_url( home_url( '/' ).'#focus' ) );

        $unicon_second_button_title = get_theme_mod( 'unicon_lite_call_to_action_second_button_title', esc_html__('Purchase Now', 'unicon-lite') );
        $unicon_second_button_url = get_theme_mod( 'unicon_lite_call_to_action_second_button_url', esc_url( home_url( '/' ).'#focus' ) );

        if(!empty( $call_to_action_options ) && $call_to_action_options == 'show'){ ?>
            <section class="call-action-section clearfix" <?php if(!empty( $call_to_action_bg )) { ?>style="background-image:url(<?php echo esc_url($call_to_action_bg); ?>); background-size:cover; background-attachment: fixed;<?php } ?>">
            <div class="container-wrap">
                <div class="call-content-wrapper wow slideInDown">
                    <?php if(!empty( $call_action_title )) { ?>
                        <h2>
                            <?php
                                $content_array = explode(" ", $call_action_title);
                                $new2 = array_shift($content_array);
                                $callcontent = implode($content_array, ' ');
                                echo '<span>'.esc_html($new2).'</span>'. esc_html($callcontent);
                            ?>
                        </h2>
                    <?php } ?>
                    <?php if(!empty( $call_action_desc )) { ?>
                        <p><?php echo esc_html($call_action_desc); ?></p>
                    <?php } ?>
                </div>
                <div class="mainbanner-button-wrap">
                    <?php if( !empty( $unicon_first_button_title ) ) { ?>
                        <div class="first-button kr-styleone wow fadeInLeft">
                            <a href="<?php echo esc_url($unicon_first_button_url); ?>">
                                <?php echo esc_html($unicon_first_button_title); ?>
                            </a>
                        </div>
                    <?php } ?>
                    <?php if( !empty( $unicon_second_button_title ) ) { ?>
                        <div class="first-button wow fadeInRight">
                            <a href="<?php echo esc_url($unicon_second_button_url); ?>">
                                <?php echo esc_html($unicon_second_button_title); ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
                </div>
            </section>
        <?php   
        }
    }
}
add_action( 'unicon_lite_call_to_action_section', 'unicon_lite_front_page_call_to_action_section' );

/**
 * Front Page Testimonial Section
*/
if ( ! function_exists( 'unicon_lite_front_page_testimonial_section' ) ) {
    function unicon_lite_front_page_testimonial_section() {
        $testimonial_options = get_theme_mod( 'unicon_lite_testimonial_section_option', 'show' );

        $testimonial_main_title = get_theme_mod( 'unicon_lite_testimonial_section_main_title', esc_html__('Clients', 'unicon-lite') );
        $testimonial_sub_title  = get_theme_mod( 'unicon_lite_testimonial_section_sub_title', esc_html__('Testimonials', 'unicon-lite') );
       
        if(!empty( $testimonial_options ) && $testimonial_options == 'show'){ ?>
            <section class="testimonial-section clearfix">
                <?php unicode_lite_front_page_section_title( $testimonial_main_title, $testimonial_sub_title ); ?>
                <div class="container-wrap">
                <div class="testimonialwrap">
                    <?php
                       $testimonial_cat_id = get_theme_mod( 'unicon_lite_testimonial_team_id', 1 );
                       if( !empty( $testimonial_cat_id ) ) {
                        $testimonial_args = array(
                            'post_type' => 'post',
                            'tax_query' => array(
                                array(
                                    'taxonomy'  => 'category',
                                    'field'     => 'id', 
                                    'terms'     => $testimonial_cat_id                                                                 
                                )),
                            'posts_per_page' => -1
                        );

                        $testimonial_query = new WP_Query( $testimonial_args );
                           if( $testimonial_query->have_posts() ) { while( $testimonial_query->have_posts() ) { $testimonial_query->the_post();
                           $image_id = get_post_thumbnail_id();
                           $image_path = wp_get_attachment_image_src( $image_id, 'medium', true );                           
                    ?>
                        <div class="testimonialinfo">
                            <?php if( has_post_thumbnail() ) { ?>
                                <div class="testimonial-image">
                                    <figure><img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php the_title(); ?>" /></figure>
                                </div>
                            <?php   } ?>
                            <div class="testimonial-info">
                                <h4><?php the_title(); ?></h4>
                                <div class="kr-testimonial-desc">
                                <?php the_excerpt(); ?>
                                </div>
                            </div>                         
                        </div>
                    <?php  } } wp_reset_postdata();  } ?> 
                </div>
                </div>

            </section>
        <?php   
        }
    }
}
add_action( 'unicon_lite_testimonial_section', 'unicon_lite_front_page_testimonial_section' );


/**
 * Front Page Our Partners Section
*/
if ( ! function_exists( 'unicon_lite_front_page_our_partners_section' ) ) {
    function unicon_lite_front_page_our_partners_section() {
        $partners_options = esc_attr( get_theme_mod( 'unicon_lite_our_partners_section_option', 'show' ) );

        $partners_bg = get_theme_mod( 'unicon_lite_our_partners_bg_image' );
        $partners_title = get_theme_mod( 'unicon_lite_our_partners_section_main_title', esc_html__('Our Partners', 'unicon-lite') );
        $partners_desc  = get_theme_mod( 'unicon_lite_our_partners_description', esc_html__('Better security happens when we work together, Get tips on further steps you can take to protect yourself online.', 'unicon-lite') );
   
        if(!empty( $partners_options ) && $partners_options == 'show'){ ?>
            <section class="partners-section clearfix" <?php if(!empty( $partners_bg )) { ?>style="background-image:url(<?php echo esc_url($partners_bg); ?>); background-size:cover; background-attachment: fixed;<?php } ?>">
                <div class="container-wrap">
                <div class="partners-wrapper">
                    <?php if(!empty( $partners_title )) { ?>
                        <h3><?php echo esc_html($partners_title); ?></h3>
                    <?php } ?>
                    <?php if(!empty( $partners_desc )) { ?>
                        <p><?php echo esc_html($partners_desc); ?></p>
                    <?php } ?>
                </div>
                <div class="partners-logoarea">
                    <?php
                        for ( $count = 1; $count <= 5; $count++ ) {

                            $logo = get_theme_mod( 'unicon_lite_our_partners_logo_'.$count );
                    ?>
                        <div class="partners_<?php echo $count; ?>">
                            <img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_html__('Partner Logo', 'unicon-lite'); ?>" />
                        </div>
                    <?php } ?>
                </div>
                </div>
            </section>
        <?php   
        }
    }
}
add_action( 'unicon_lite_partners_section', 'unicon_lite_front_page_our_partners_section' );

/**
 * Front Page Our Blogs Section
*/
if ( ! function_exists( 'unicon_lite_front_page_blogs_section' ) ) {
    function unicon_lite_front_page_blogs_section() {
        $blog_options = get_theme_mod( 'unicon_lite_blog_section_option', 'show' );

        $blog_main_title = get_theme_mod( 'unicon_lite_blog_section_main_title', esc_html__('Recent', 'unicon-lite') );
        $blog_sub_title  = get_theme_mod( 'unicon_lite_blog_section_sub_title', esc_html('Blogs', 'unicon-lite') );
       
        if(!empty( $blog_options ) && $blog_options == 'show'){ ?>
            <section class="blog-section clearfix">
                <?php unicode_lite_front_page_section_title( $blog_main_title, $blog_sub_title ); ?>
                <div class="container-wrap">
                <div class="blogwrap">
                    <?php
                       $blog_cat_id = get_theme_mod( 'unicon_lite_blog_team_id', 1 );
                       if( !empty( $blog_cat_id ) ) {
                        $blog_args = array(
                            'post_type' => 'post',
                            'tax_query' => array(
                                array(
                                    'taxonomy'  => 'category',
                                    'field'     => 'id', 
                                    'terms'     => $blog_cat_id                                                                 
                                )),
                            'posts_per_page' => -1
                        );

                        $blog_query = new WP_Query( $blog_args );
                           if( $blog_query->have_posts() ) { while( $blog_query->have_posts() ) { $blog_query->the_post();
                           $image_id = get_post_thumbnail_id();
                           $image_path = wp_get_attachment_image_src( $image_id, 'unicon-lite-homeblog-image', true );                           
                    ?>
                        <div class="blogsinfo">
                            <?php if( has_post_thumbnail() ) { ?>
                                <div class="blog-image-info-wrap">
                                <div class="blog-image">
                                    <figure>
                                        <a href="<?php the_permalink(); ?>">
                                            <img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php the_title(); ?>" />
                                        </a>
                                    </figure>
                                    <div class="blogtime">
                                        <span><?php echo the_time( 'd' ); ?></span>
                                        <span><?php echo the_time( 'M' ); ?></span>
                                    </div>
                                </div>
                            <?php   } ?>
                            <div class="blog-info">
                                <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                 <?php echo wp_trim_words(get_the_excerpt(), 25); ?>
                                <a href="<?php the_permalink(); ?>"><?php echo esc_html__('Read More','unicon-lite') ?></a>
                            </div> 
                            </div>                        
                        </div>
                    <?php  } } wp_reset_postdata();  } ?> 
                </div>
                </div>
            </section>
        <?php   
        }
    }
}
add_action( 'unicon_lite_blog_section', 'unicon_lite_front_page_blogs_section' );


/**
 * Footer credit function area
*/
if ( ! function_exists( 'unicon_lite_credit' ) ) {
    function unicon_lite_credit() { ?>       

        <div class="site-info">
            <?php $copyright = get_theme_mod( 'unicon_lite_footer_copyright' ); if( !empty( $copyright ) ) { ?>
                <?php echo apply_filters( 'unicon_lite_copyright_text', $copyright ); ?>
            <?php } else { ?>
                <?php echo esc_html( apply_filters( 'unicon_lite_copyright_text', $content = '&copy; ' . date( 'Y' ) . ' ' . get_bloginfo( 'name' ) ) ); ?>
            <?php } ?>
            <?php if ( apply_filters( 'unicon_lite_credit_link', true ) ) { 
                printf( __( '%1$s By %2$s', 'unicon-lite' ), ' - WordPress Theme : Unicon', '<a href=" ' . esc_url('https://accesspressthemes.com/wordpress-themes/unicon/') . ' " title="Premium WordPress Themes & Plugins by AccessPress Themes" target="_blank">AccessPress Themes</a>' ); ?>
            <?php } ?>
        </div><!-- .site-info -->
                
        <?php
    }
}
add_filter('unicon_lite_credit', 'unicon_lite_credit', 5 );

/**
 * Footer buttom menu function area
*/
if ( ! function_exists( 'unicon_lite_buttom_menu' ) ) {
    function unicon_lite_buttom_menu() { ?>       

        <div class="buttom-menu">
            <?php wp_nav_menu( array( 'theme_location' => 'buttom', 'depth' => 1 ) ); ?>
        </div><!-- .buttom-menu -->
                
        <?php
    }
}
add_filter('unicon_lite_buttom_menu', 'unicon_lite_buttom_menu', 10 );



/**
 * Page and Post Page Display Layout Metabox function
*/ 
add_action('add_meta_boxes', 'unicon_lite_metabox_section');
if ( ! function_exists( 'unicon_lite_metabox_section' ) ) {
    
    function unicon_lite_metabox_section(){

        add_meta_box('unicon_lite_display_layout', 
            __( 'Display Layout Options', 'unicon-lite' ), 
            'unicon_lite_display_layout_callback', 
            array('page','post'), 
            'normal', 
            'high'
        );
      
    }
}

$unicon_lite_page_layouts =array(

    'leftsidebar' => array(
        'value'     => 'leftsidebar',
        'label'     => __( 'Left Sidebar', 'unicon-lite' ),
        'thumbnail' => get_template_directory_uri() . '/assets/images/left-sidebar.png',
    ),
    'rightsidebar' => array(
        'value'     => 'rightsidebar',
        'label'     => __( 'Right Sidebar(Default)', 'unicon-lite' ),
        'thumbnail' => get_template_directory_uri() . '/assets/images/right-sidebar.png',
    ),
     'nosidebar' => array(
        'value'     => 'nosidebar',
        'label'     => __( 'Full width', 'unicon-lite' ),
        'thumbnail' => get_template_directory_uri() . '/assets/images/no-sidebar.png',
    ),
    'bothsidebar' => array(
        'value'     => 'bothsidebar',
        'label'     => __( 'Content Centered', 'unicon-lite' ),
        'thumbnail' => get_template_directory_uri() . '/assets/images/both-sidebar.png',
    )
);

/**
 * Function for Page layout meta box
**/
if ( ! function_exists( 'unicon_lite_display_layout_callback' ) ) {
    function unicon_lite_display_layout_callback(){
        global $post, $unicon_lite_page_layouts;
        wp_nonce_field( basename( __FILE__ ), 'unicon_lite_settings_nonce' );
    ?>
        <table class="form-table">
            <tr>
              <td>            
                <?php
                  $i = 0;  
                  foreach ($unicon_lite_page_layouts as $field) {  
                  $unicon_page_metalayouts = get_post_meta( $post->ID, 'unicon_lite_page_layouts', true );
                  $unicon_page_metalayouts = !empty($unicon_page_metalayouts) ? $unicon_page_metalayouts : 'rightsidebar';
                ?>            
                  <div class="radio-image-wrapper slidercat" id="slider-<?php echo $i; ?>" style="float:left; margin-right:30px;">
                    <label class="description">
                        <span>
                          <img src="<?php echo esc_url( $field['thumbnail'] ); ?>" />
                        </span></br>
                        <input type="radio" name="unicon_lite_page_layouts" value="<?php echo $field['value']; ?>" <?php checked( $field['value'], 
                            $unicon_page_metalayouts ); checked($unicon_page_metalayouts, $field['value']); ?>/>
                         <?php echo $field['label']; ?>
                    </label>
                  </div>
                <?php  $i++; }  ?>
              </td>
            </tr>            
        </table>
    <?php
    }
}

/**
 * Save the custom metabox data
*/
if ( ! function_exists( 'unicon_lite_save_page_settings' ) ) {
    function unicon_lite_save_page_settings( $post_id ) { 
        global $unicon_lite_page_layouts, $post; 
        if ( !isset( $_POST[ 'unicon_lite_settings_nonce' ] ) || !wp_verify_nonce( $_POST[ 'unicon_lite_settings_nonce' ], basename( __FILE__ ) ) )
            return;
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
            return;        
        if ('page' == $_POST['post_type']) {  
            if (!current_user_can( 'edit_page', $post_id ) )  
                return $post_id;  
        } elseif (!current_user_can( 'edit_post', $post_id ) ) {  
                return $post_id;  
        }    
        foreach ($unicon_lite_page_layouts as $field) {  
            $old = get_post_meta( $post_id, 'unicon_lite_page_layouts', true); 
            $new = sanitize_text_field($_POST['unicon_lite_page_layouts']);
            if ($new && $new != $old) {  
                update_post_meta($post_id, 'unicon_lite_page_layouts', $new);  
            } elseif ('' == $new && $old) {  
                delete_post_meta($post_id,'unicon_lite_page_layouts', $old);  
            } 
         } 
    }
}
add_action('save_post', 'unicon_lite_save_page_settings');

/**
 * Sucess Graph Data
**/
$unicon_sucess_per = array();
$unicon_sucess_year = array();
for ( $count = 1; $count <= 8; $count++ ) {
    $unicon_sucesspre = get_theme_mod( 'unicon_lite_sucess_graph_percentage_'.$count );
    if( !empty ( $unicon_sucesspre ) ){
        $unicon_sucess_per[] = $unicon_sucesspre;
    }

    $unicon_sucessyear = get_theme_mod( 'unicon_lite_sucess_graph_year_'.$count );
    if( !empty ( $unicon_sucessyear ) ){
        $unicon_sucess_year[] = $unicon_sucessyear;
    }    
}


/**
 * Unicon breadcrumbs function 
*/
if (!function_exists('unicon_lite_breadcrumbs_menu')) {
  function unicon_lite_breadcrumbs_menu() {
        global $post;
        $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
        $delimiter = '<i class="fa fa-long-arrow-right"></i>';      
        $home = __('Home', 'unicon-lite'); // text for the 'Home' link
        $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
        $before = '<span class="current">'; // tag before the current crumb
        $after = '</span>'; // tag after the current crumb
        $homeLink = home_url();
        if (is_front_page()) {

          if ($showOnHome == 1)
            echo '<div id="unicon-breadcrumb"><a href="' . esc_url($homeLink) . '">' . $home . '</a></div></div>';
        } else {
          echo '<div id="unicon-breadcrumb"><a href="' . esc_url($homeLink) . '">' . $home . '</a> ' . $delimiter . ' ';
        if (is_category()) {
          $thisCat = get_category(get_query_var('cat'), false);
          if ($thisCat->parent != 0)
            echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
          echo $before . __('Archive by category','unicon-lite').' "' . get_the_archive_title('', false) . '"' . $after;
        } elseif (is_search()) {
          echo $before . __('Search results for','unicon-lite'). '"' . get_search_query() . '"' . $after;
        } elseif (is_day()) {
          echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
          echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
          echo $before . get_the_time('d') . $after;
        } elseif (is_month()) {
          echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
          echo $before . get_the_time('F') . $after;
        } elseif (is_year()) {
          echo $before . get_the_time('Y') . $after;
        } elseif (is_single() && !is_attachment()) {
          if (get_post_type() != 'post') {
            $post_type = get_post_type_object(get_post_type());
            $slug = $post_type->rewrite;
            echo '<a href="' . esc_url($homeLink) . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
            if ($showCurrent == 1)
              echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
          } else {
            $cat = get_the_category();
            $cat = $cat[0];
            $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
            if ($showCurrent == 0)
              $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
            echo $cats;
            if ($showCurrent == 1)
              echo $before . get_the_title() . $after;
          }
        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
          $post_type = get_post_type_object(get_post_type());
          echo $before . $post_type->labels->singular_name . $after;
        } elseif (is_attachment()) {
          $parent = get_post($post->post_parent);
          $cat = get_the_category($parent->ID);
          $cat = $cat[0];
          echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
          echo '<a href="' . esc_url(get_permalink($parent)) . '">' . $parent->post_title . '</a>';
          if ($showCurrent == 1)
            echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
        } elseif (is_page() && !$post->post_parent) {
          if ($showCurrent == 1)
            echo $before . get_the_title() . $after;
        } elseif (is_page() && $post->post_parent) {
          $parent_id = $post->post_parent;
          $breadcrumbs = array();
          while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<a href="' . esc_url(get_permalink($page->ID)) . '">' . get_the_title($page->ID) . '</a>';
            $parent_id = $page->post_parent;
          }
          $breadcrumbs = array_reverse($breadcrumbs);
          for ($i = 0; $i < count($breadcrumbs); $i++) {
            echo $breadcrumbs[$i];
            if ($i != count($breadcrumbs) - 1)
              echo ' ' . $delimiter . ' ';
          }
          if ($showCurrent == 1)
            echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
        } elseif (is_tag()) {
          echo $before . __('Posts tagged','unicon-lite').' "' . get_the_archive_title('', false) . '"' . $after;
        } elseif (is_author()) {
          global $author;
          $userdata = get_userdata($author);
          echo $before . __('Articles posted by ','unicon-lite'). $userdata->display_name . $after;
        } elseif (is_404()) {
          echo $before . 'Error 404' . $after;
        }

        if (get_query_var('paged')) {
          if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
            echo ' (';
              echo __('Page', 'unicon-lite') . ' ' . get_query_var('paged');
              if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                    echo ')';
      }
      echo '</div>';
    }
  }
}

/**
 * Get categories
*/
$unicon_lite_raw_categories = get_categories();
foreach ( $unicon_lite_raw_categories  as $categories ) {
    $unicon_lite_categories[$categories->slug] = $categories->name;
}

/**
 * All fontawesome icon list
*/
if (!function_exists('unicon_lite_icons_array')) {
    function unicon_lite_icons_array(){
       $kr_icon_list_raw = 'fa-glass, fa-music, fa-search, fa-envelope-o, fa-heart, fa-star, fa-star-o, fa-user, fa-film, fa-th-large, fa-th, fa-th-list, fa-check, fa-times, fa-search-plus, fa-search-minus, fa-power-off, fa-signal, fa-cog, fa-trash-o, fa-home, fa-file-o, fa-clock-o, fa-road, fa-download, fa-arrow-circle-o-down, fa-arrow-circle-o-up, fa-inbox, fa-play-circle-o, fa-repeat, fa-refresh, fa-list-alt, fa-lock, fa-flag, fa-headphones, fa-volume-off, fa-volume-down, fa-volume-up, fa-qrcode, fa-barcode, fa-tag, fa-tags, fa-book, fa-bookmark, fa-print, fa-camera, fa-font, fa-bold, fa-italic, fa-text-height, fa-text-width, fa-align-left, fa-align-center, fa-align-right, fa-align-justify, fa-list, fa-outdent, fa-indent, fa-video-camera, fa-picture-o, fa-pencil, fa-map-marker, fa-adjust, fa-tint, fa-pencil-square-o, fa-share-square-o, fa-check-square-o, fa-arrows, fa-step-backward, fa-fast-backward, fa-backward, fa-play, fa-pause, fa-stop, fa-forward, fa-fast-forward, fa-step-forward, fa-eject, fa-chevron-left, fa-chevron-right, fa-plus-circle, fa-minus-circle, fa-times-circle, fa-check-circle, fa-question-circle, fa-info-circle, fa-crosshairs, fa-times-circle-o, fa-check-circle-o, fa-ban, fa-arrow-left, fa-arrow-right, fa-arrow-up, fa-arrow-down, fa-share, fa-expand, fa-compress, fa-plus, fa-minus, fa-asterisk, fa-exclamation-circle, fa-gift, fa-leaf, fa-fire, fa-eye, fa-eye-slash, fa-exclamation-triangle, fa-plane, fa-calendar, fa-random, fa-comment, fa-magnet, fa-chevron-up, fa-chevron-down, fa-retweet, fa-shopping-cart, fa-folder, fa-folder-open, fa-arrows-v, fa-arrows-h, fa-bar-chart, fa-twitter-square, fa-facebook-square, fa-camera-retro, fa-key, fa-cogs, fa-comments, fa-thumbs-o-up, fa-thumbs-o-down, fa-star-half, fa-heart-o, fa-sign-out, fa-linkedin-square, fa-thumb-tack, fa-external-link, fa-sign-in, fa-trophy, fa-github-square, fa-upload, fa-lemon-o, fa-phone, fa-square-o, fa-bookmark-o, fa-phone-square, fa-twitter, fa-facebook, fa-github, fa-unlock, fa-credit-card, fa-rss, fa-hdd-o, fa-bullhorn, fa-bell, fa-certificate, fa-hand-o-right, fa-hand-o-left, fa-hand-o-up, fa-hand-o-down, fa-arrow-circle-left, fa-arrow-circle-right, fa-arrow-circle-up, fa-arrow-circle-down, fa-globe, fa-wrench, fa-tasks, fa-filter, fa-briefcase, fa-arrows-alt, fa-users, fa-link, fa-cloud, fa-flask, fa-scissors, fa-files-o, fa-paperclip, fa-floppy-o, fa-square, fa-bars, fa-list-ul, fa-list-ol, fa-strikethrough, fa-underline, fa-table, fa-magic, fa-truck, fa-pinterest, fa-pinterest-square, fa-google-plus-square, fa-google-plus, fa-money, fa-caret-down, fa-caret-up, fa-caret-left, fa-caret-right, fa-columns, fa-sort, fa-sort-desc, fa-sort-asc, fa-envelope, fa-linkedin, fa-undo, fa-gavel, fa-tachometer, fa-comment-o, fa-comments-o, fa-bolt, fa-sitemap, fa-umbrella, fa-clipboard, fa-lightbulb-o, fa-exchange, fa-cloud-download, fa-cloud-upload, fa-user-md, fa-stethoscope, fa-suitcase, fa-bell-o, fa-coffee, fa-cutlery, fa-file-text-o, fa-building-o, fa-hospital-o, fa-ambulance, fa-medkit, fa-fighter-jet, fa-beer, fa-h-square, fa-plus-square, fa-angle-double-left, fa-angle-double-right, fa-angle-double-up, fa-angle-double-down, fa-angle-left, fa-angle-right, fa-angle-up, fa-angle-down, fa-desktop, fa-laptop, fa-tablet, fa-mobile, fa-circle-o, fa-quote-left, fa-quote-right, fa-spinner, fa-circle, fa-reply, fa-github-alt, fa-folder-o, fa-folder-open-o, fa-smile-o, fa-frown-o, fa-meh-o, fa-gamepad, fa-keyboard-o, fa-flag-o, fa-flag-checkered, fa-terminal, fa-code, fa-reply-all, fa-star-half-o, fa-location-arrow, fa-crop, fa-code-fork, fa-chain-broken, fa-question, fa-info, fa-exclamation, fa-superscript, fa-subscript, fa-eraser, fa-puzzle-piece, fa-microphone, fa-microphone-slash, fa-shield, fa-calendar-o, fa-fire-extinguisher, fa-rocket, fa-maxcdn, fa-chevron-circle-left, fa-chevron-circle-right, fa-chevron-circle-up, fa-chevron-circle-down, fa-html5, fa-css3, fa-anchor, fa-unlock-alt, fa-bullseye, fa-ellipsis-h, fa-ellipsis-v, fa-rss-square, fa-play-circle, fa-ticket, fa-minus-square, fa-minus-square-o, fa-level-up, fa-level-down, fa-check-square, fa-pencil-square, fa-external-link-square, fa-share-square, fa-compass, fa-caret-square-o-down, fa-caret-square-o-up, fa-caret-square-o-right, fa-eur, fa-gbp, fa-usd, fa-inr, fa-jpy, fa-rub, fa-krw, fa-btc, fa-file, fa-file-text, fa-sort-alpha-asc, fa-sort-alpha-desc, fa-sort-amount-asc, fa-sort-amount-desc, fa-sort-numeric-asc, fa-sort-numeric-desc, fa-thumbs-up, fa-thumbs-down, fa-youtube-square, fa-youtube, fa-xing, fa-xing-square, fa-youtube-play, fa-dropbox, fa-stack-overflow, fa-instagram, fa-flickr, fa-adn, fa-bitbucket, fa-bitbucket-square, fa-tumblr, fa-tumblr-square, fa-long-arrow-down, fa-long-arrow-up, fa-long-arrow-left, fa-long-arrow-right, fa-apple, fa-windows, fa-android, fa-linux, fa-dribbble, fa-skype, fa-foursquare, fa-trello, fa-female, fa-male, fa-gratipay, fa-sun-o, fa-moon-o, fa-archive, fa-bug, fa-vk, fa-weibo, fa-renren, fa-pagelines, fa-stack-exchange, fa-arrow-circle-o-right, fa-arrow-circle-o-left, fa-caret-square-o-left, fa-dot-circle-o, fa-wheelchair, fa-vimeo-square, fa-try, fa-plus-square-o, fa-space-shuttle, fa-slack, fa-envelope-square, fa-wordpress, fa-openid, fa-university, fa-graduation-cap, fa-yahoo, fa-google, fa-reddit, fa-reddit-square, fa-stumbleupon-circle, fa-stumbleupon, fa-delicious, fa-digg, fa-pied-piper-pp, fa-pied-piper-alt, fa-drupal, fa-joomla, fa-language, fa-fax, fa-building, fa-child, fa-paw, fa-spoon, fa-cube, fa-cubes, fa-behance, fa-behance-square, fa-steam, fa-steam-square, fa-recycle, fa-car, fa-taxi, fa-tree, fa-spotify, fa-deviantart, fa-soundcloud, fa-database, fa-file-pdf-o, fa-file-word-o, fa-file-excel-o, fa-file-powerpoint-o, fa-file-image-o, fa-file-archive-o, fa-file-audio-o, fa-file-video-o, fa-file-code-o, fa-vine, fa-codepen, fa-jsfiddle, fa-life-ring, fa-circle-o-notch, fa-rebel, fa-empire, fa-git-square, fa-git, fa-hacker-news, fa-tencent-weibo, fa-qq, fa-weixin, fa-paper-plane, fa-paper-plane-o, fa-history, fa-circle-thin, fa-header, fa-paragraph, fa-sliders, fa-share-alt, fa-share-alt-square, fa-bomb, fa-futbol-o, fa-tty, fa-binoculars, fa-plug, fa-slideshare, fa-twitch, fa-yelp, fa-newspaper-o, fa-wifi, fa-calculator, fa-paypal, fa-google-wallet, fa-cc-visa, fa-cc-mastercard, fa-cc-discover, fa-cc-amex, fa-cc-paypal, fa-cc-stripe, fa-bell-slash, fa-bell-slash-o, fa-trash, fa-copyright, fa-at, fa-eyedropper, fa-paint-brush, fa-birthday-cake, fa-area-chart, fa-pie-chart, fa-line-chart, fa-lastfm, fa-lastfm-square, fa-toggle-off, fa-toggle-on, fa-bicycle, fa-bus, fa-ioxhost, fa-angellist, fa-cc, fa-ils, fa-meanpath, fa-buysellads, fa-connectdevelop, fa-dashcube, fa-forumbee, fa-leanpub, fa-sellsy, fa-shirtsinbulk, fa-simplybuilt, fa-skyatlas, fa-cart-plus, fa-cart-arrow-down, fa-diamond, fa-ship, fa-user-secret, fa-motorcycle, fa-street-view, fa-heartbeat, fa-venus, fa-mars, fa-mercury, fa-transgender, fa-transgender-alt, fa-venus-double, fa-mars-double, fa-venus-mars, fa-mars-stroke, fa-mars-stroke-v, fa-mars-stroke-h, fa-neuter, fa-genderless, fa-facebook-official, fa-pinterest-p, fa-whatsapp, fa-server, fa-user-plus, fa-user-times, fa-bed, fa-viacoin, fa-train, fa-subway, fa-medium, fa-y-combinator, fa-optin-monster, fa-opencart, fa-expeditedssl, fa-battery-full, fa-battery-three-quarters, fa-battery-half, fa-battery-quarter, fa-battery-empty, fa-mouse-pointer, fa-i-cursor, fa-object-group, fa-object-ungroup, fa-sticky-note, fa-sticky-note-o, fa-cc-jcb, fa-cc-diners-club, fa-clone, fa-balance-scale, fa-hourglass-o, fa-hourglass-start, fa-hourglass-half, fa-hourglass-end, fa-hourglass, fa-hand-rock-o, fa-hand-paper-o, fa-hand-scissors-o, fa-hand-lizard-o, fa-hand-spock-o, fa-hand-pointer-o, fa-hand-peace-o, fa-trademark, fa-registered, fa-creative-commons, fa-gg, fa-gg-circle, fa-tripadvisor, fa-odnoklassniki, fa-odnoklassniki-square, fa-get-pocket, fa-wikipedia-w, fa-safari, fa-chrome, fa-firefox, fa-opera, fa-internet-explorer, fa-television, fa-contao, fa-500px, fa-amazon, fa-calendar-plus-o, fa-calendar-minus-o, fa-calendar-times-o, fa-calendar-check-o, fa-industry, fa-map-pin, fa-map-signs, fa-map-o, fa-map, fa-commenting, fa-commenting-o, fa-houzz, fa-vimeo, fa-black-tie, fa-fonticons, fa-reddit-alien, fa-edge, fa-credit-card-alt, fa-codiepie, fa-modx, fa-fort-awesome, fa-usb, fa-product-hunt, fa-mixcloud, fa-scribd, fa-pause-circle, fa-pause-circle-o, fa-stop-circle, fa-stop-circle-o, fa-shopping-bag, fa-shopping-basket, fa-hashtag, fa-bluetooth, fa-bluetooth-b, fa-percent, fa-gitlab, fa-wpbeginner, fa-wpforms, fa-envira, fa-universal-access, fa-wheelchair-alt, fa-question-circle-o, fa-blind, fa-audio-description, fa-volume-control-phone, fa-braille, fa-assistive-listening-systems, fa-american-sign-language-interpreting, fa-deaf, fa-glide, fa-glide-g, fa-sign-language, fa-low-vision, fa-viadeo, fa-viadeo-square, fa-snapchat, fa-snapchat-ghost, fa-snapchat-square, fa-pied-piper, fa-first-order, fa-yoast, fa-themeisle, fa-google-plus-official, fa-font-awesome' ;
       $kr_icon_list = explode( ", " , $kr_icon_list_raw);
       return $kr_icon_list;
    }
}


/**
  * Comment Callback function
*/
if ( ! function_exists( 'unicon_lite_comment' ) ) {
  function unicon_lite_comment($comment, $args, $depth) {
      ?>
      <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
        <div class="comment-wrapper media" id="comment-<?php comment_ID(); ?>">
            <a href="javascript();" class="pull-left">
              <?php echo get_avatar($comment,$size='100'); ?>
            </a>
            <?php if ($comment->comment_approved == '0') : ?>
                 <em><?php _e('Your comment is awaiting moderation.','unicon-lite') ?></em>
                
            <?php endif; ?>
            <div class="media-body">
                    <div>
                        <?php printf(__('<h4 class="media-heading">%s</h4>','unicon-lite'), get_comment_author_link()) ?>
                        <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
                          <?php printf(__('%1$s at %2$s','unicon-lite'), get_comment_date(),  get_comment_time()) ?>
                        </a>
                    </div>
                      <?php comment_text() ?>
                    <div class="fsprorow">
                        <div class="comment-left">
                            <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                        </div>
                    </div>
            </div>
        </div>
      </li>
     <?php
  }
}

/**
 * Unicon pagination function area
*/
if (!function_exists('unicon_lite_pagination')) {
    function unicon_lite_pagination($pages = '', $range = 2){
         $showitems = ($range * 2)+1;  
            global $paged;
         if(empty($paged)) $paged = 1; 
         if($pages == '')
         {
             global $wp_query;
             $pages = $wp_query->max_num_pages;
             if(!$pages)
             {
                 $pages = 1;
             }
         }
         if(1 != $pages){
             echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
             if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>". __('&laquo; First', 'unicon-lite')."</a>";
              if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
      
              for ($i=1; $i <= $pages; $i++)
              {
                  if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
                  {
                      echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
                  }
              }
      
              if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">".__('Next &rsaquo', 'unicon-lite')."</a>";  
              if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>".__('Last &raquo;', 'unicon-lite')."</a>";
              echo "</div>\n";
          }
    }
}