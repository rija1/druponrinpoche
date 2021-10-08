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
                                    <li class="page_item"><a href="#year1"><span class="sp_menu_year">Year 1</span> - Shorter Texts</a></li>
                                    <li class="page_item"><a href="#year2"><span class="sp_menu_year">Year 2</span> - Discipline (Vinaya)</a></li>
                                    <li class="page_item"><a href="#year3"><span class="sp_menu_year">Year 3</span> - Discipline (Vinaya)</a></li>
                                    <li class="page_item"><a href="#year4"><span class="sp_menu_year">Year 4</span> - Metaphysics (Abhidharma)</a></li>
                                    <li class="page_item"><a href="#year5"><span class="sp_menu_year">Year 5</span> - Metaphysics (Abhidharma)</a></li>
                                    <li class="page_item"><a href="#year6"><span class="sp_menu_year">Year 6</span> - Middle Way</a></li>
                                    <li class="page_item"><a href="#year7"><span class="sp_menu_year">Year 7</span> - Middle Way</a></li>
                                    <li class="page_item"><a href="#year8"><span class="sp_menu_year">Year 8</span> - Perfection of Intelligence</a></li>
                                    <li class="page_item"><a href="#year9"><span class="sp_menu_year">Year 9</span> - Perfection of Intelligence</a></li>
                                    <li class="page_item"><a href="#year10"><span class="sp_menu_year">Year 10</span> - Perfection of Intelligence</a></li>
                                </ul>
                            </li>
                            <li class="page_item page_item_has_children"><a href="">Tantra Curriculum</a>
                                <ul class="children">
                                <li class="page_item"><a href="#year11"><span class="sp_menu_year">Year 11</span> - Tantric Preliminaries / Mind Training / Kadam & Mahamudra</a></li>
                                    <li class="page_item"><a href="#year12"><span class="sp_menu_year">Year 12</span> - Masters - Explanatory Tantras</a></li>
                                    <li class="page_item"><a href="#year13"><span class="sp_menu_year">Year 13</span> - Masters - Tantric Pith-Instructions : Mother Tantras / Calm Abiding</a></li>
                                    <li class="page_item"><a href="#year14"><span class="sp_menu_year">Year 14</span> - Doctorate - Tantric Pith-Instructions : Marpa Tradition / Father Tantras</a></li>
                                    <li class="page_item"><a href="#year15"><span class="sp_menu_year">Year 15</span> - Doctorate - Tantric Pith-Instructions : Marpa Tradition / Mother Tantras</a></li>
                                    <li class="page_item"><a href="#year16"><span class="sp_menu_year">Year 16</span> - Postdoctorate - Tantric Pith-Instructions : Marpa Tradition / Mother Tantras</a></li>
                                    <li class="page_item"><a href="#year17"><span class="sp_menu_year">Year 17</span> - Postdoctorate - Tantric Pith-Instructions : Marpa Tradition / Mother Tantras</a></li>
                                    <li class="page_item"><a href="#year18"><span class="sp_menu_year">Year 18</span> - Postdoctorate - Tantric Pith-Instructions : Marpa Tradition / Mother Tantras</a></li>
                                    <li class="page_item"><a href="#year19"><span class="sp_menu_year">Year 19</span> - Postdoctorate - Tantric Pith-Instructions : Marpa’s Tradition / Six Dharmas Completion Stage / Generation & Completion for The Wheel of Time</a></li>
                                    <li class="page_item"><a href="#year20"><span class="sp_menu_year">Year 20</span> - Postdoctorate - Tantric Pith-Instructions : Marpa’s Tradition / Mahamudra</a></li>
                                    <li class="page_item"><a href="#year21"><span class="sp_menu_year">Year 21</span> - Postdoctorate - Tantric Pith-Instructions : Marpa’s Tradition / Mahamudra</a></li>
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
                            <a target="_blank" href="<?php echo site_url().'/21yr_prog_curriculum'; ?>"><div class="sp_tib_version_link">Tibetan version (PDF)</div></a>
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