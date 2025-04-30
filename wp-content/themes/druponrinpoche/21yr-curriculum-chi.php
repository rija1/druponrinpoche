<?php /* Template Name: 21yrCurriculum Chinese */ ?>
<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
    <div class="section section-blog twentyone-yr-curriculum">
        <div class="container">
            <div class="blog-columns">
                <div class="sidebar-container">
                    <div class="sp_sticky_menu">
                        <h5>學程</h5>
                        <ul>
                            <li class="page_item"><a href="#Elementary School" aria-current="page">預備課程</a></li>
                            <li class="page_item page_item_has_children"><a href="http://druponrinpoche.local/en/lineage/kagyu-lineage/">顯乘教典</a>
                                <ul class="children">
                                    <li class="page_item"><a href="#year1"><span class="sp_menu_year">第一年</span> - 小論典</a></li>
                                    <li class="page_item"><a href="#year2"><span class="sp_menu_year">第二年</span> - 律典</a></li>
                                    <li class="page_item"><a href="#year3"><span class="sp_menu_year">第三年</span> - 律典</a></li>
                                    <li class="page_item"><a href="#year4"><span class="sp_menu_year">第四年</span> - 俱舍</a></li>
                                    <li class="page_item"><a href="#year5"><span class="sp_menu_year">第五年</span> - 俱舍</a></li>
                                    <li class="page_item"><a href="#year6"><span class="sp_menu_year">第六年</span> - 中觀</a></li>
                                    <li class="page_item"><a href="#year7"><span class="sp_menu_year">第七年</span> - 中觀</a></li>
                                    <li class="page_item"><a href="#year8"><span class="sp_menu_year">第八年</span> - 般若</a></li>
                                    <li class="page_item"><a href="#year9"><span class="sp_menu_year">第九年</span> - 般若</a></li>
                                    <li class="page_item"><a href="#year10"><span class="sp_menu_year">第十年</span> - 般若</a></li>
                                </ul>
                            </li>
                            <li class="page_item page_item_has_children"><a href="">密乘教典</a>
                                <ul class="children">
                                <li class="page_item"><a href="#year11"><span class="sp_menu_year">第十一年</span> - 密續/續部修心、前行及修心、噶當教法、大手印</a></li>
                                    <li class="page_item"><a href="#year12"><span class="sp_menu_year">第十二年</span> - 碩士：密續論典</a></li>
                                    <li class="page_item"><a href="#year13"><span class="sp_menu_year">第十三年</span> - 碩士：密續竅訣——馬爾巴傳承|寂止</a></li>
                                    <li class="page_item"><a href="#year14"><span class="sp_menu_year">第十四年</span> - 博士：密續竅訣——馬爾巴傳承|父續</a></li>
                                    <li class="page_item"><a href="#year15"><span class="sp_menu_year">第十五年</span> - 博士：密續竅訣——馬爾巴傳承|母續</a></li>
                                    <li class="page_item"><a href="#year16"><span class="sp_menu_year">第十六年</span> - 博士後：密續竅訣——馬爾巴傳承|母續</a></li>
                                    <li class="page_item"><a href="#year17"><span class="sp_menu_year">第十七年</span> - 博士後：密續竅訣——馬爾巴傳承|母續</a></li>
                                    <li class="page_item"><a href="#year18"><span class="sp_menu_year">第十八年</span> - 博士後：密續竅訣——馬爾巴傳承|母續</a></li>
                                    <li class="page_item"><a href="#year19"><span class="sp_menu_year">第十九年</span> - 博士後：密續竅訣——馬爾巴傳承|圓滿次第那若六法、時輪金剛生圓次第</a></li>
                                    <li class="page_item"><a href="#year20"><span class="sp_menu_year">第二十年</span> - 博士後：密續竅訣——馬爾巴傳承|大手印</a></li>
                                    <li class="page_item"><a href="#year21"><span class="sp_menu_year">第二十一年</span> - 博士後：密續竅訣——馬爾巴傳承|大手印</a></li>
                                </ul>
                            </li>
                            <li class="page_item page_item_has_children"><a href="https://www.druponrinpoche.org/en/21yr_prog_secular_studies/" target="_blank">語言文化課課綱(PDF)</a>
                        </ul>
                    </div>    
                </div>
                <div class="inner-page-container">
                    <div class="gutter">
                        <div class="section-title">
                            <h1><?php the_title(); ?></h1>
                            <a target="_blank" href="<?php echo site_url().'/21yr_prog_curriculum'; ?>"><div class="sp_tib_version_link">藏文版(PDF)</div></a>
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