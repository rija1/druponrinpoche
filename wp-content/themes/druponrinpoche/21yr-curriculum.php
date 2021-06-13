<?php /* Template Name: 21yrCurriculum */ ?>
<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
    <div class="section section-blog twentyone-yr-curriculum">
        <div class="container">
            <div class="blog-columns">
                <div class="sidebar-container">
                    <div class="sp_sticky_menu">
                        <h5>Curriculum</h5>
                        <ul>
                            <li class="page_item"><a href="#elementary_school" aria-current="page">Elementary School</a></li>
                            <li class="page_item page_item_has_children"><a href="http://druponrinpoche.local/en/lineage/kagyu-lineage/">Sutra Curriculum</a>
                                <ul class="children">
                                    <li class="page_item"><a href="#year1">Year 1 - Shorter Texts</a></li>
                                    <li class="page_item"><a href="#year2">Year 2 - Discipline (Vinaya)</a></li>
                                    <li class="page_item"><a href="#year3">Year 3 - Discipline (Vinaya)</a></li>
                                    <li class="page_item"><a href="#year4">Year 4 - Metaphysics (Abhidharma)</a></li>
                                    <li class="page_item"><a href="#year5">Year 5 - Metaphysics (Abhidharma)</a></li>
                                    <li class="page_item"><a href="#year6">Year 6 - Middle Way</a></li>
                                    <li class="page_item"><a href="#year7">Year 7 - Middle Way</a></li>
                                    <li class="page_item"><a href="#year8">Year 8 - Perfection of Intelligence</a></li>
                                    <li class="page_item"><a href="#year9">Year 9 - Perfection of Intelligence</a></li>
                                    <li class="page_item"><a href="#year10">Year 10 - Perfection of Intelligence</a></li>
                                </ul>
                            </li>
                            <li class="page_item page_item_has_children"><a href="">Tantra Curriculum</a>
                                <ul class="children">
                                <li class="page_item"><a href="#year11">Year 11 - Tantric Preliminaries / Mind Training / Kadam & Mahamudra</a></li>
                                    <li class="page_item"><a href="#year12">Year 12 - Masters - Explanatory Tantras</a></li>
                                    <li class="page_item"><a href="#year13">Year 13 - Masters - Tantric Pith-Instructions : Mother Tantras / Calm Abiding</a></li>
                                    <li class="page_item"><a href="#year14">Year 14 - Doctorate - Tantric Pith-Instructions : Marpa Tradition / Father Tantras</a></li>
                                    <li class="page_item"><a href="#year15">Year 15 - Doctorate - Tantric Pith-Instructions : Marpa Tradition / Mother Tantras</a></li>
                                    <li class="page_item"><a href="#year16">Year 16 - Postdoctorate - Tantric Pith-Instructions : Marpa Tradition / Mother Tantras</a></li>
                                    <li class="page_item"><a href="#year17">Year 17 - Postdoctorate - Tantric Pith-Instructions : Marpa Tradition / Mother Tantras</a></li>
                                    <li class="page_item"><a href="#year18">Year 18 - Postdoctorate - Tantric Pith-Instructions : Marpa Tradition / Mother Tantras</a></li>
                                    <li class="page_item"><a href="#year19">Year 19 - Postdoctorate - Tantric Pith-Instructions : Marpa’s Tradition / Six Dharmas Completion Stage / Generation & Completion for The Wheel of Time</a></li>
                                    <li class="page_item"><a href="#year20">Year 20 - Postdoctorate - Tantric Pith-Instructions : Marpa’s Tradition / Mahamudra</a></li>
                                    <li class="page_item"><a href="#year21">Year 21 - Postdoctorate - Tantric Pith-Instructions : Marpa’s Tradition / Mahamudra</a></li>
                                </ul>
                            </li>
                            <li class="page_item page_item_has_children"><a href="https://www.druponrinpoche.org/en/21yr_prog_secular_studies/" target="_blank">Secular Studies Programme (PDF)</a>
                        </ul>
                    </div>    
                </div>
                <div class="inner-page-container">
                    <div class="gutter">
                        <div class="section-title">
                            <h1><?php the_title(); ?></h1>
                        </div>
                        <article class="single-post">
                            <div class="article-text">
                                <?php the_content(); ?>
                            </div>
                            <p><?php posts_nav_link(); ?></p>
                            <div class="padinate-page"><?php wp_link_pages(); ?></div>
                            <div class="comments">
                                <?php comments_template(); ?>
                            </div> <!--  END comments  -->
                        </article>
                    </div>
                </div>
            </div>
        </div> <!--  END container  -->
    </div> <!--  END section-blog  -->
<?php endwhile; ?>
<?php get_footer(); ?>